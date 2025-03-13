@extends('layouts.app')

@section('title', 'OptimaAI - Оптимизация бизнеса с помощью искусственного интеллекта')
@section('meta_description', 'OptimaAI предлагает профессиональные услуги по внедрению искусственного интеллекта в бизнес-процессы. Консультации, настройка языковых моделей и интеграция ИИ в бизнес.')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/gsap-animations.css') }}">
@endsection

@section('content')
    <!-- Контейнер для звездного фона -->
    <div id="stars-container" class="stars-container"></div>
    
    <!-- Hero Section -->
    <section class="hero-section position-relative overflow-hidden">
        <div class="neural-bg"></div>
        <div class="container py-5">
            <div class="row align-items-center py-5">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <h1 class="display-3 fw-bold mb-4 text-gradient fade-in">
                        Оптимизация бизнеса с помощью искусственного интеллекта
                    </h1>
                    <p class="lead mb-5 slide-up">
                        Мы помогаем компаниям внедрять современные ИИ-технологии для автоматизации процессов, 
                        повышения эффективности и создания конкурентных преимуществ
                    </p>
                    <div class="d-flex flex-wrap slide-up">
                        <button class="btn btn-accent btn-lg neon-glow me-3 mb-3" data-bs-toggle="modal" data-bs-target="#requestModal">
                            Оставить заявку
                        </button>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="hero-image-container scale-in">
                        <div class="hero-image">
                            <img src="{{ asset('images/hero-ai.svg') }}" alt="AI Optimization" class="img-fluid">
                        </div>
                        <div class="hero-glow"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Advantages Section -->
    <section class="advantages-section py-5 position-relative overflow-hidden">
        <div class="neural-bg"></div>
        <div class="container py-5">
            <div class="row mb-5 text-center">
                <div class="col-lg-8 mx-auto">
                    <h2 class="section-title fw-bold mb-4 fade-in">Преимущества работы с нами</h2>
                    <p class="section-subtitle slide-up">Почему клиенты выбирают OptimaAI для внедрения искусственного интеллекта</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="advantage-card h-100">
                        <div class="advantage-icon pulse-animation">
                            <i class="bi bi-lightning-charge-fill"></i>
                        </div>
                        <h3 class="advantage-title h5 fw-bold mb-3">Быстрый результат</h3>
                        <p class="advantage-text mb-0">Внедрение первых ИИ-решений и получение измеримых результатов в течение 2-4 недель</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="advantage-card h-100">
                        <div class="advantage-icon pulse-animation">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h3 class="advantage-title h5 fw-bold mb-3">Измеримый эффект</h3>
                        <p class="advantage-text mb-0">Прозрачная система метрик и отчетности для оценки эффективности внедрения</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="advantage-card h-100">
                        <div class="advantage-icon pulse-animation">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h3 class="advantage-title h5 fw-bold mb-3">Безопасность данных</h3>
                        <p class="advantage-text mb-0">Строгие протоколы защиты информации и соблюдение требований конфиденциальности</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="advantage-card h-100">
                        <div class="advantage-icon pulse-animation">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h3 class="advantage-title h5 fw-bold mb-3">Экспертная команда</h3>
                        <p class="advantage-text mb-0">Специалисты с опытом внедрения ИИ в различных отраслях бизнеса</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="process-section py-5 position-relative overflow-hidden">
        <div class="neural-bg"></div>
        <div class="container py-5">
            <div class="row mb-5 text-center">
                <div class="col-lg-8 mx-auto">
                    <h2 class="section-title fw-bold mb-4 fade-in">Как мы работаем</h2>
                    <p class="section-subtitle slide-up">Прозрачный процесс внедрения ИИ-решений в ваш бизнес</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="process-timeline">
                        <div class="process-step">
                            <div class="process-step-icon">
                                <i class="bi bi-chat-text-fill"></i>
                                <div class="step-number">1</div>
                            </div>
                            <div class="process-step-content">
                                <h3 class="h5 fw-bold mb-3">Консультация и анализ</h3>
                                <p>Изучаем ваш бизнес, определяем ключевые процессы, которые можно оптимизировать с помощью ИИ, и формируем стратегию внедрения.</p>
                            </div>
                        </div>
                        
                        <div class="process-step">
                            <div class="process-step-icon">
                                <i class="bi bi-gear-fill"></i>
                                <div class="step-number">2</div>
                            </div>
                            <div class="process-step-content">
                                <h3 class="h5 fw-bold mb-3">Разработка решения</h3>
                                <p>Настраиваем и адаптируем нейросетевые модели под специфику вашего бизнеса, интегрируем их с существующими системами.</p>
                            </div>
                        </div>
                        
                        <div class="process-step">
                            <div class="process-step-icon">
                                <i class="bi bi-rocket-takeoff-fill"></i>
                                <div class="step-number">3</div>
                            </div>
                            <div class="process-step-content">
                                <h3 class="h5 fw-bold mb-3">Внедрение и обучение</h3>
                                <p>Запускаем решение в работу, обучаем вашу команду эффективно использовать новые ИИ-инструменты.</p>
                            </div>
                        </div>
                        
                        <div class="process-step">
                            <div class="process-step-icon">
                                <i class="bi bi-graph-up"></i>
                                <div class="step-number">4</div>
                            </div>
                            <div class="process-step-content">
                                <h3 class="h5 fw-bold mb-3">Поддержка и оптимизация</h3>
                                <p>Обеспечиваем техническую поддержку, анализируем результаты и постоянно улучшаем решение для достижения максимальной эффективности.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section py-5 position-relative overflow-hidden">
        <div class="neural-bg"></div>
        <div class="container py-5">
            <div class="row mb-5 text-center">
                <div class="col-lg-8 mx-auto">
                    <h2 class="section-title fw-bold mb-4 fade-in">Наши услуги</h2>
                    <p class="section-subtitle slide-up">Комплексные решения для внедрения искусственного интеллекта в ваш бизнес</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="service-item h-100">
                        <div class="service-icon">
                            <i class="bi bi-person-workspace"></i>
                        </div>
                        <h3 class="h5 fw-bold mb-3">Консультации и обучение</h3>
                        <p>Экспертная помощь в выборе оптимальных нейросетевых решений и обучение вашей команды работе с ИИ-инструментами.</p>
                        <a href="{{ route('services.show', 'consulting-and-training') }}" class="interactive-element">Подробнее <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="service-item h-100">
                        <div class="service-icon">
                            <i class="bi bi-cpu"></i>
                        </div>
                        <h3 class="h5 fw-bold mb-3">Настройка языковых моделей</h3>
                        <p>Профессиональная настройка и fine-tuning нейросетевых моделей под специфику вашей отрасли и задачи.</p>
                        <a href="{{ route('services.show', 'language-models-setup') }}" class="interactive-element">Подробнее <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="service-item h-100">
                        <div class="service-icon">
                            <i class="bi bi-diagram-3"></i>
                        </div>
                        <h3 class="h5 fw-bold mb-3">Интеграция ИИ в бизнес</h3>
                        <p>Комплексное внедрение искусственного интеллекта в рабочие процессы компании с измеримыми результатами.</p>
                        <a href="{{ route('services.show', 'ai-business-integration') }}" class="interactive-element">Подробнее <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5">
                <a href="{{ route('services.index') }}" class="cyber-btn">Все услуги</a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section py-5 position-relative overflow-hidden">
        <div class="neural-bg"></div>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-title fw-bold mb-4 fade-in">Готовы начать работу с нейросетями?</h2>
                    <p class="section-subtitle mb-5 slide-up">Свяжитесь с нами для консультации и обсуждения вашего проекта</p>
                    <button class="cyber-btn btn-lg slide-up" data-bs-toggle="modal" data-bs-target="#requestModal">Оставить заявку</button>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @vite(['resources/js/app.js'])
@endsection 