<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ChatbotApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Маршруты для чат-бота без проверки CSRF-токена
Route::post('/chatbot/chat', [ChatbotApiController::class, 'chat'])
    ->middleware(\App\Http\Middleware\ChatbotRateLimiter::class)
    ->name('api.chatbot.chat');

Route::post('/chatbot/reset', [ChatbotApiController::class, 'resetChat'])
    ->name('api.chatbot.reset'); 