<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ChatbotRateLimiter
{
    /**
     * Максимальное количество запросов в минуту
     */
    protected $maxAttempts = 10;
    
    /**
     * Время блокировки в минутах при превышении лимита
     */
    protected $decayMinutes = 1;
    
    /**
     * Обработка запроса
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Получаем IP-адрес пользователя
        $key = 'chatbot_' . $request->ip();
        
        // Проверяем, не превышен ли лимит запросов
        if (RateLimiter::tooManyAttempts($key, $this->maxAttempts)) {
            // Логируем попытку превышения лимита
            Log::warning('Chatbot rate limit exceeded', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'available_in' => RateLimiter::availableIn($key)
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Слишком много запросов. Пожалуйста, попробуйте позже.',
                'retry_after' => RateLimiter::availableIn($key)
            ], 429);
        }
        
        // Увеличиваем счетчик запросов
        RateLimiter::hit($key, $this->decayMinutes * 60);
        
        // Добавляем заголовки с информацией о лимите
        $response = $next($request);
        $response->headers->add([
            'X-RateLimit-Limit' => $this->maxAttempts,
            'X-RateLimit-Remaining' => RateLimiter::remaining($key, $this->maxAttempts),
        ]);
        
        return $response;
    }
} 