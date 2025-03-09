<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CaseStudyController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
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

// Главная страница
Route::get('/', [HomeController::class, 'index'])->name('home');

// О компании
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Услуги
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');

// Кейсы
Route::get('/case-studies', [CaseStudyController::class, 'index'])->name('case-studies.index');
Route::get('/case-studies/{caseStudy}', [CaseStudyController::class, 'show'])->name('case-studies.show');

// Блог
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post}', [BlogController::class, 'show'])->name('blog.show');

// Контакты
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Обработка заявок с форм
Route::post('/submit-form', function (\Illuminate\Http\Request $request) {
    // Валидация данных
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'message' => 'nullable|string',
    ]);
    
    // Добавляем источник запроса
    $validated['source'] = $request->input('source', 'popup_form');
    
    // Создаем новый контакт
    $contact = \App\Models\Contact::create($validated);
    
    // Отправляем email с данными заявки
    try {
        Mail::raw("Новая заявка с сайта\n\nИмя: {$validated['name']}\nEmail: {$validated['email']}\nТелефон: {$validated['phone']}\nСообщение: {$validated['message']}\nИсточник: {$validated['source']}", function ($message) {
            $message->to('info@optimaai.ru')
                    ->subject('Новая заявка с сайта OptimaAI');
        });
    } catch (\Exception $e) {
        // Логируем ошибку, но не прерываем выполнение
        \Illuminate\Support\Facades\Log::error('Ошибка отправки email: ' . $e->getMessage());
    }
    
    // Возвращаем JSON-ответ для AJAX-запросов
    return response()->json([
        'success' => true,
        'message' => 'Спасибо за вашу заявку! Мы свяжемся с вами в ближайшее время.'
    ]);
})->name('submit-form');
