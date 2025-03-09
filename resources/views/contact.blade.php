@extends('layouts.app')

@section('title', 'Контакты OptimaAI — нейросетевые решения для бизнеса')
@section('meta_description', 'Свяжитесь с нами для получения консультации по внедрению нейросетевых технологий в ваш бизнес. Мы находимся в Тюмени и работаем по всей России.')

@section('content')
    <!-- Hero Section -->
    <section class="hero bg-dark text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Контакты</h1>
                    <p class="lead mb-0">Свяжитесь с нами для получения консультации или оставьте заявку на сайте</p>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="{{ asset('images/contact-hero.svg') }}" alt="Контакты OptimaAI" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Info Section -->
    <section class="contact-info py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-geo-alt fs-1 text-primary"></i>
                            </div>
                            <h3 class="card-title h5">Адрес</h3>
                            <p class="card-text">Тюмень, Россия</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-envelope fs-1 text-primary"></i>
                            </div>
                            <h3 class="card-title h5">Email</h3>
                            <p class="card-text"><a href="mailto:info@optimaai.ru" class="text-decoration-none">info@optimaai.ru</a></p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-telephone fs-1 text-primary"></i>
                            </div>
                            <h3 class="card-title h5">Телефон</h3>
                            <p class="card-text"><a href="tel:+79123456789" class="text-decoration-none">+7 (912) 345-67-89</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="contact-form py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="mb-4">Оставьте заявку</h2>
                    <p class="lead">Заполните форму ниже, и мы свяжемся с вами в ближайшее время для обсуждения вашего проекта.</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 p-md-5">
                            @if(session('success'))
                                <div class="alert alert-success mb-4">
                                    {{ session('success') }}
                                </div>
                            @endif
                            
                            <form action="{{ route('contact.store') }}" method="POST" data-ajax="true">
                                @csrf
                                <input type="hidden" name="source" value="contact_page">
                                
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Ваше имя *</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="form-label">Email *</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone" class="form-label">Телефон *</label>
                                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="subject" class="form-label">Тема</label>
                                            <select class="form-select" id="subject" name="subject">
                                                <option value="Консультация">Консультация</option>
                                                <option value="Настройка языковых моделей">Настройка языковых моделей</option>
                                                <option value="Интеграция нейросетей">Интеграция нейросетей</option>
                                                <option value="Другое">Другое</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="message" class="form-label">Сообщение</label>
                                            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5">{{ old('message') }}</textarea>
                                            @error('message')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input @error('privacy_policy') is-invalid @enderror" type="checkbox" id="privacy_policy" name="privacy_policy" required>
                                            <label class="form-check-label" for="privacy_policy">
                                                Я согласен с <a href="#" target="_blank">политикой конфиденциальности</a>
                                            </label>
                                            @error('privacy_policy')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary btn-lg">Отправить заявку</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="mb-4">Наше расположение</h2>
                    <p class="lead">Мы находимся в Тюмени, но работаем с клиентами по всей России.</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-0">
                            <div class="bg-secondary" style="height: 400px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Social Media Section -->
    <section class="social-media py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="mb-4">Мы в социальных сетях</h2>
                    <p class="lead">Следите за нашими новостями и обновлениями в социальных сетях.</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12 text-center">
                    <div class="social-links">
                        <a href="#" class="btn btn-outline-primary btn-lg mx-2 mb-3"><i class="bi bi-telegram"></i> Telegram</a>
                        <a href="#" class="btn btn-outline-primary btn-lg mx-2 mb-3"><i class="bi bi-whatsapp"></i> WhatsApp</a>
                        <a href="#" class="btn btn-outline-primary btn-lg mx-2 mb-3"><i class="bi bi-vk"></i> ВКонтакте</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection 