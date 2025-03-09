<?php

namespace App\Http\Controllers;

use App\Models\ClientMessage;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    public function submitForm(Request $request)
    {
        try {
            // Валидация данных
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'message' => 'nullable|string',
            ]);
            
            // Добавляем источник запроса
            $validated['source'] = $request->input('source', 'popup_form');
            
            // Логируем данные для отладки
            Log::info('Получены данные формы:', $validated);
            
            // Создаем новый контакт
            $contact = Contact::create($validated);
            Log::info('Создан контакт:', ['id' => $contact->id]);
            
            // Создаем новое сообщение клиента
            $clientMessage = ClientMessage::create($validated);
            Log::info('Создано сообщение клиента:', ['id' => $clientMessage->id]);
            
            // Отправляем email с данными заявки
            try {
                Mail::raw("Новая заявка с сайта\n\nИмя: {$validated['name']}\nEmail: {$validated['email']}\nТелефон: {$validated['phone']}\nСообщение: {$validated['message']}\nИсточник: {$validated['source']}", function ($message) {
                    $message->to('info@optimaai.ru')
                            ->subject('Новая заявка с сайта OptimaAI');
                });
                Log::info('Email отправлен');
            } catch (\Exception $e) {
                // Логируем ошибку, но не прерываем выполнение
                Log::error('Ошибка отправки email: ' . $e->getMessage());
            }
            
            // Возвращаем JSON-ответ для AJAX-запросов
            return response()->json([
                'success' => true,
                'message' => 'Спасибо за вашу заявку! Мы свяжемся с вами в ближайшее время.'
            ]);
        } catch (\Exception $e) {
            Log::error('Ошибка при обработке формы: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Произошла ошибка при отправке формы. Пожалуйста, попробуйте позже.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
