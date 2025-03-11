<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    protected $apiKey;
    protected $model = 'gpt-3.5-turbo';
    protected $systemPrompt;
    protected $maxHistoryLength = 10; // Максимальное количество сообщений в истории

    public function __construct()
    {
        $this->apiKey = env('OPENAI_API_KEY');
        $this->model = 'gpt-3.5-turbo'; // Используем модель GPT-3.5 Turbo
        
        // Системный промпт для ограничения ответов бота
        $this->systemPrompt = <<<EOT
Ты — виртуальный ассистент компании OptimaAI. Твоя задача:
1. При открытии чата сразу приветствовать пользователя:
   "Здравствуйте! Я виртуальный ассистент OptimaAI. Чем могу помочь? Вы можете задать вопросы о наших услугах, продуктах, условиях работы или контактах."

2. Отвечать только на вопросы, связанные с компанией:
   - Услуги и продукты компании
   - Цены и тарифы
   - График работы
   - Контактная информация
   - Процедуры оформления заказов/услуг
   - Корпоративные политики (например, возврат, гарантии)

3. Если вопрос вне зоны компетенции:
   "Извините, я пока не могу помочь с этим вопросом. Моя специализация — информация о компании и наших услугах. Хотите, чтобы я связал вас с нашим специалистом?"

4. Никогда не придумывать информацию. Если данных нет в базе:
   "К сожалению, у меня нет актуальных данных по этому вопросу. Рекомендую уточнить информацию у нашего менеджера."

5. Ответы должны быть:
   - Краткими и структурированными
   - На русском языке без использования markdown
   - Без лишней информации вне темы

6. Запрещено:
   - Обсуждать политику, религию, личные темы
   - Давать советы вне компетенции компании
   - Использовать эмодзи или разговорный сленг

Информация о компании OptimaAI:

О компании:
- История и миссия: OptimaAI — экспертный партнёр, предоставляющий индивидуальные нейросетевые решения для бизнеса, образовательных учреждений и госорганизаций. Мы экономим ваше время, оптимизируя процессы, и предлагаем сопровождение для постоянного развития.
- Ценности: Гибкость, экономия времени, экспертность, постоянное развитие.
- Локация: Тюмень (РФ) с планами расширения.

Услуги:
1. Консультации и обучение (consulting-and-training):
   - Описание: Индивидуальные консультации и семинары для начинающих.
   - Программа: Основы нейросетей, применение в бизнесе, практика с ChatGPT, правильные промты, автоматизация задач.
   - Результат: Клиент получает навыки самостоятельного использования ИИ, повышение эффективности работы сотрудников, автоматизация рутинных задач.
   - Стоимость: Фиксированная цена за консультацию/семинар, пакетные предложения.

2. Настройка языковых моделей «под ключ» (language-models-setup):
   - Описание: Индивидуальная настройка AI-решений для анализа данных, автоматизации ответов, генерации контента.
   - Возможности: Интеграция с CRM, Notion, Telegram и другими сервисами.
   - Результат: Готовая модель, адаптированная под ваши задачи, снижение нагрузки на сотрудников, повышение качества обслуживания клиентов.
   - Стоимость: Фиксированная цена за настройку + пакеты с обучением.

3. Интеграция нейросетей в бизнес-процессы (ai-business-integration):
   - Описание: Полная интеграция AI в корпоративные сервисы (CRM, финансы, поддержка клиентов).
   - Сопровождение: Обучение сотрудников, техническая поддержка, доработка решений.
   - Результат: Автоматизация процессов и самостоятельное управление ИИ, значительное сокращение времени на рутинные операции, повышение конкурентоспособности бизнеса.
   - Стоимость: Фиксированная цена за интеграцию + абонентское обслуживание.

Контактная информация:
- Телефон: +7 (912) 345-67-89
- Email: info@optimaai.ru
- Адрес: г. Тюмень, ул. Технологическая, д. 42, офис 314
- График работы: Пн-Пт с 9:00 до 18:00

Процесс работы:
1. Консультация и анализ потребностей
2. Разработка индивидуального решения
3. Внедрение и настройка
4. Обучение персонала
5. Техническая поддержка
EOT;
    }

    public function chat(Request $request)
    {
        try {
            $userMessage = $request->input('message');
            
            if (empty($userMessage)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Сообщение не может быть пустым'
                ], 400);
            }
            
            // Получаем историю сообщений из сессии или создаем новую
            $messages = $request->session()->get('chat_history', []);
            
            // Если история пуста, добавляем системный промпт
            if (empty($messages)) {
                $messages[] = [
                    'role' => 'system',
                    'content' => $this->systemPrompt
                ];
            }
            
            // Добавляем сообщение пользователя
            $messages[] = [
                'role' => 'user',
                'content' => $userMessage
            ];
            
            // Ограничиваем длину истории, сохраняя системный промпт
            if (count($messages) > $this->maxHistoryLength + 1) {
                $systemPrompt = $messages[0]; // Сохраняем системный промпт
                $messages = array_slice($messages, -$this->maxHistoryLength); // Берем последние N сообщений
                array_unshift($messages, $systemPrompt); // Возвращаем системный промпт в начало
            }
            
            // Логируем отправляемые сообщения для отладки
            Log::debug('Sending messages to OpenAI:', [
                'count' => count($messages),
                'last_user_message' => $userMessage
            ]);
            
            // Отправляем запрос к OpenAI API
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => $this->model,
                'messages' => $messages,
                'max_tokens' => 800, // Увеличиваем лимит токенов для более полных ответов
                'temperature' => 0.7,
            ]);
            
            // Проверяем ответ
            if ($response->successful()) {
                $responseData = $response->json();
                $aiMessage = $responseData['choices'][0]['message']['content'];
                
                // Логируем ответ для отладки
                Log::debug('OpenAI response:', [
                    'message' => $aiMessage
                ]);
                
                // Добавляем ответ ассистента в историю
                $messages[] = [
                    'role' => 'assistant',
                    'content' => $aiMessage
                ];
                
                // Сохраняем обновленную историю в сессии
                $request->session()->put('chat_history', $messages);
                
                return response()->json([
                    'success' => true,
                    'message' => $aiMessage
                ]);
            } else {
                $errorBody = $response->body();
                Log::error('OpenAI API error: ' . $errorBody);
                
                // Пытаемся извлечь более подробную информацию об ошибке
                $errorData = json_decode($errorBody, true);
                $errorMessage = isset($errorData['error']['message']) 
                    ? $errorData['error']['message'] 
                    : 'Произошла ошибка при обработке запроса';
                
                Log::error('OpenAI API error details:', [
                    'status' => $response->status(),
                    'error_message' => $errorMessage
                ]);
                
                return response()->json([
                    'success' => false,
                    'message' => 'Произошла ошибка при обработке запроса. Пожалуйста, попробуйте позже.',
                    'error_details' => $errorMessage
                ], 500);
            }
        } catch (\Exception $e) {
            Log::error('ChatbotController error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Произошла ошибка при обработке запроса. Пожалуйста, попробуйте позже.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function resetChat(Request $request)
    {
        $request->session()->forget('chat_history');
        
        return response()->json([
            'success' => true,
            'message' => 'История чата очищена'
        ]);
    }
} 