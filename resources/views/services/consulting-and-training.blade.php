@extends('layouts.app')

@section('title', 'Консультации и обучение по ИИ | OptimaAI')
@section('meta_description', 'Профессиональные консультации и обучение по искусственному интеллекту для вашего бизнеса от экспертов OptimaAI.')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/gsap-animations.css') }}">
@endsection

@section('content')
<div class="stars-container" id="stars-container"></div>

<!-- Hero Section -->
<section class="service-hero position-relative overflow-hidden py-5 service-detail-page">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-10 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-4 text-gradient service-detail-title">Консультации и обучение</h1>
                <p class="lead mb-5 service-detail-subtitle">Помогаем разобраться в возможностях ИИ для вашего бизнеса и обучаем команду работе с нейросетями, чтобы вы могли максимально эффективно использовать современные технологии.</p>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-transparent service-section">
    <div class="container py-5">
        <div class="row mb-5 text-center">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title fw-bold mb-4 text-gradient service-section-title">Что включает услуга</h2>
                <p class="section-subtitle">Комплексный подход к обучению и консультированию, адаптированный под ваши бизнес-задачи</p>
            </div>
        </div>
        
        <div class="row g-4">
            <!-- Фича 1 -->
            <div class="col-md-4">
                <div class="service-feature-card h-100">
                    <div class="service-icon-container">
                        <div class="service-icon-wrapper icon-circle">
                            <i class="bi bi-lightbulb-fill"></i>
                        </div>
                    </div>
                    <h3 class="h5 mb-3">Стратегический анализ</h3>
                    <p class="service-list-item">Оценка потребностей вашего бизнеса и определение оптимальных направлений внедрения ИИ-технологий</p>
                </div>
            </div>
            
            <!-- Фича 2 -->
            <div class="col-md-4">
                <div class="service-feature-card h-100">
                    <div class="service-icon-container">
                        <div class="service-icon-wrapper icon-circle">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                    <h3 class="h5 mb-3">Обучение команды</h3>
                    <p class="service-list-item">Практические воркшопы и тренинги по работе с нейросетями для сотрудников разных уровней</p>
                </div>
            </div>
            
            <!-- Фича 3 -->
            <div class="col-md-4">
                <div class="service-feature-card h-100">
                    <div class="service-icon-container">
                        <div class="service-icon-wrapper icon-circle">
                            <i class="bi bi-gear-fill"></i>
                        </div>
                    </div>
                    <h3 class="h5 mb-3">Техническая поддержка</h3>
                    <p class="service-list-item">Постоянное сопровождение и помощь в решении возникающих вопросов при работе с ИИ-инструментами</p>
                </div>
            </div>
            
            <!-- Фича 4 -->
            <div class="col-md-4">
                <div class="service-feature-card h-100">
                    <div class="service-icon-container">
                        <div class="service-icon-wrapper icon-circle">
                            <i class="bi bi-file-earmark-text-fill"></i>
                        </div>
                    </div>
                    <h3 class="h5 mb-3">Документация и гайды</h3>
                    <p class="service-list-item">Разработка подробных руководств и инструкций по использованию ИИ в вашей компании</p>
                </div>
            </div>
            
            <!-- Фича 5 -->
            <div class="col-md-4">
                <div class="service-feature-card h-100">
                    <div class="service-icon-container">
                        <div class="service-icon-wrapper icon-circle">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                    </div>
                    <h3 class="h5 mb-3">Оценка эффективности</h3>
                    <p class="service-list-item">Разработка метрик и регулярный анализ результатов внедрения ИИ в рабочие процессы</p>
                </div>
            </div>
            
            <!-- Фича 6 -->
            <div class="col-md-4">
                <div class="service-feature-card h-100">
                    <div class="service-icon-container">
                        <div class="service-icon-wrapper icon-circle">
                            <i class="bi bi-chat-dots-fill"></i>
                        </div>
                    </div>
                    <h3 class="h5 mb-3">Консультации экспертов</h3>
                    <p class="service-list-item">Доступ к команде специалистов по ИИ для решения сложных вопросов и задач</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="py-5 bg-transparent service-section">
    <div class="container py-5">
        <div class="row mb-5 text-center">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title fw-bold mb-4 text-gradient service-section-title">Как мы работаем</h2>
                <p class="section-subtitle">Прозрачный процесс консультирования и обучения для достижения максимальных результатов</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="process-timeline">
                    <!-- Шаг 1 -->
                    <div class="process-step">
                        <div class="step-number icon-circle">1</div>
                        <div class="process-content">
                            <h3 class="h5 fw-bold mb-3">Первичная консультация</h3>
                            <p class="service-list-item">Проводим встречу для понимания ваших бизнес-процессов, целей и задач, которые вы хотите решить с помощью ИИ</p>
                        </div>
                    </div>
                    
                    <!-- Шаг 2 -->
                    <div class="process-step">
                        <div class="step-number icon-circle">2</div>
                        <div class="process-content">
                            <h3 class="h5 fw-bold mb-3">Анализ потребностей</h3>
                            <p class="service-list-item">Изучаем текущие процессы и определяем, где внедрение ИИ принесет максимальную пользу</p>
                        </div>
                    </div>
                    
                    <!-- Шаг 3 -->
                    <div class="process-step">
                        <div class="step-number icon-circle">3</div>
                        <div class="process-content">
                            <h3 class="h5 fw-bold mb-3">Разработка программы</h3>
                            <p class="service-list-item">Создаем индивидуальную программу обучения и консультирования, адаптированную под ваши потребности</p>
                        </div>
                    </div>
                    
                    <!-- Шаг 4 -->
                    <div class="process-step">
                        <div class="step-number icon-circle">4</div>
                        <div class="process-content">
                            <h3 class="h5 fw-bold mb-3">Проведение обучения</h3>
                            <p class="service-list-item">Организуем серию тренингов и воркшопов для вашей команды с практическими заданиями</p>
                        </div>
                    </div>
                    
                    <!-- Шаг 5 -->
                    <div class="process-step">
                        <div class="step-number icon-circle">5</div>
                        <div class="process-content">
                            <h3 class="h5 fw-bold mb-3">Поддержка и сопровождение</h3>
                            <p class="service-list-item">Обеспечиваем постоянную поддержку и консультации в процессе внедрения ИИ в рабочие процессы</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="py-5 bg-transparent service-section">
    <div class="container py-5">
        <div class="row mb-5 text-center">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title fw-bold mb-4 text-gradient service-section-title">Преимущества работы с нами</h2>
                <p class="section-subtitle">Почему клиенты выбирают наши консультационные услуги и обучение</p>
            </div>
        </div>
        
        <div class="row g-4">
            <!-- Преимущество 1 -->
            <div class="col-md-6">
                <div class="benefit-card">
                    <div class="benefit-icon icon-circle">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <div class="benefit-content">
                        <h3 class="h5 fw-bold mb-2">Экспертиза в области ИИ</h3>
                        <p class="service-list-item">Наша команда состоит из специалистов с многолетним опытом работы в сфере искусственного интеллекта</p>
                    </div>
                </div>
            </div>
            
            <!-- Преимущество 2 -->
            <div class="col-md-6">
                <div class="benefit-card">
                    <div class="benefit-icon icon-circle">
                        <i class="bi bi-puzzle-fill"></i>
                    </div>
                    <div class="benefit-content">
                        <h3 class="h5 fw-bold mb-2">Индивидуальный подход</h3>
                        <p class="service-list-item">Разрабатываем программы обучения с учетом специфики вашего бизнеса и уровня подготовки сотрудников</p>
                    </div>
                </div>
            </div>
            
            <!-- Преимущество 3 -->
            <div class="col-md-6">
                <div class="benefit-card">
                    <div class="benefit-icon icon-circle">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="benefit-content">
                        <h3 class="h5 fw-bold mb-2">Экономия времени</h3>
                        <p class="service-list-item">Помогаем быстро освоить технологии ИИ без длительного самостоятельного изучения</p>
                    </div>
                </div>
            </div>
            
            <!-- Преимущество 4 -->
            <div class="col-md-6">
                <div class="benefit-card">
                    <div class="benefit-icon icon-circle">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="benefit-content">
                        <h3 class="h5 fw-bold mb-2">Повышение ROI</h3>
                        <p class="service-list-item">Обеспечиваем максимальную отдачу от инвестиций в ИИ благодаря правильному внедрению</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-transparent service-section">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="cta-card text-center p-5 animated-border">
                    <h2 class="fw-bold mb-4 service-section-title">Готовы начать обучение?</h2>
                    <p class="mb-4">Свяжитесь с нами для консультации и обсуждения вашего проекта</p>
                    <a href="{{ route('contact') }}" class="cyber-btn btn-lg">Связаться с нами</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
    @vite(['resources/js/services/index.js'])
@endsection 