<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CaseStudyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ChatbotController;
use App\Models\Contact;
use App\Models\ClientMessage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Маршрут для проверки здоровья (healthcheck)
Route::get('/health', function () {
    return response()->json(['status' => 'ok', 'timestamp' => time()]);
});

// Главная страница
Route::get('/', [HomeController::class, 'index'])->name('home');

// Услуги
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

// Добавляем новые маршруты для услуг с использованием строковых идентификаторов
Route::get('/services/consulting-and-training', function () {
    return view('services.consulting-and-training');
})->name('services.consulting-and-training');

Route::get('/services/language-models-setup', function () {
    return view('services.language-models-setup');
})->name('services.language-models-setup');

Route::get('/services/ai-business-integration', function () {
    return view('services.ai-business-integration');
})->name('services.ai-business-integration');

// Этот маршрут должен быть последним в группе маршрутов услуг
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');

// Кейсы
Route::get('/case-studies', [CaseStudyController::class, 'index'])->name('case-studies.index');
Route::get('/case-studies/{caseStudy}', [CaseStudyController::class, 'show'])->name('case-studies.show');

// Контакты
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Обработка заявок с форм
Route::post('/submit-form', [FormController::class, 'submitForm'])->name('submit-form');

// Маршруты для чат-бота с OpenAI
Route::post('/chatbot/chat', [ChatbotController::class, 'chat'])->name('chatbot.chat');
Route::post('/chatbot/reset', [ChatbotController::class, 'resetChat'])->name('chatbot.reset');
