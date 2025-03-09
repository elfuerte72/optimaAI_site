<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CaseStudyController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FormController;
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
    return response()->json(['status' => 'ok']);
});

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
Route::post('/submit-form', [FormController::class, 'submitForm'])->name('submit-form');
