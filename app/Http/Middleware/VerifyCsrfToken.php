<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Временно исключаем маршруты чат-бота из проверки CSRF-токена для тестирования
        'chatbot/*',
        'csrf-token',
        'api/chatbot/*',
    ];
} 