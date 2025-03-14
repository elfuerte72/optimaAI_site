<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ChatbotController extends Controller
{
    protected $apiKey;
    protected $model = 'gpt-3.5-turbo';
    protected $systemPrompt;
    protected $maxHistoryLength = 10; // Максимальное количество сообщений в истории

    public function __construct()
    {
        $this->apiKey = env('OPENAI_API_KEY');
        $this->model = env('OPENAI_MODEL', 'gpt-3.5-turbo'); // Используем модель из .env или GPT-3.5 Turbo по умолчанию
        
        // Системный промпт для ограничения ответов бота
        $this->systemPrompt = <<<EOT
Ты профессиональный помощник пользователей интернет-магазина. Отвечай кратко, используй эмодзи и оформляй списки в виде bullet points. Не используй markdown.

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

    /**
     * Обработка запроса чата
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function chat(Request $request)
    {
        try {
            // Валидация входящих данных
            $validator = Validator::make($request->all(), [
                'message' => 'required|string|max:1000',
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ошибка валидации',
                    'errors' => $validator->errors()
                ], 422);
            }
            
            // Фильтрация XSS в пользовательском вводе
            $userMessage = $this->sanitizeInput($request->input('message'));
            
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
            
            // Генерируем уникальный идентификатор запроса для отслеживания
            $requestId = Str::uuid()->toString();
            
            // Отправляем запрос к OpenAI API
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
                'X-Request-ID' => $requestId
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => $this->model,
                'messages' => $messages,
                'max_tokens' => 800, // Увеличиваем лимит токенов для более полных ответов
                'temperature' => 0.7,
                'user' => $this->getUserIdentifier($request), // Добавляем идентификатор пользователя для отслеживания
            ]);
            
            // Проверяем ответ
            if ($response->successful()) {
                $responseData = $response->json();
                $aiMessage = $responseData['choices'][0]['message']['content'];
                
                // Логируем ответ для отладки
                Log::debug('OpenAI response:', [
                    'request_id' => $requestId,
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
                Log::error('OpenAI API error: ' . $errorBody, [
                    'request_id' => $requestId
                ]);
                
                // Пытаемся извлечь более подробную информацию об ошибке
                $errorData = json_decode($errorBody, true);
                $errorMessage = isset($errorData['error']['message']) 
                    ? $errorData['error']['message'] 
                    : 'Произошла ошибка при обработке запроса';
                
                Log::error('OpenAI API error details:', [
                    'request_id' => $requestId,
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
    
    /**
     * Сброс истории чата
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetChat(Request $request)
    {
        $request->session()->forget('chat_history');
        
        return response()->json([
            'success' => true,
            'message' => 'История чата очищена'
        ]);
    }
    
    /**
     * Фильтрация XSS в пользовательском вводе
     *
     * @param  string  $input
     * @return string
     */
    protected function sanitizeInput($input)
    {
        // Удаляем HTML-теги
        $sanitized = strip_tags($input);
        
        // Экранируем специальные символы
        $sanitized = htmlspecialchars($sanitized, ENT_QUOTES, 'UTF-8');
        
        return $sanitized;
    }
    
    /**
     * Получение уникального идентификатора пользователя
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function getUserIdentifier(Request $request)
    {
        // Используем сессионный идентификатор или IP-адрес
        return $request->session()->getId() ?: $request->ip();
    }
} 