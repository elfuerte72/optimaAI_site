@extends('layouts.app')

@section('title', 'Консультации и обучение по ИИ | OptimaAI')
@section('meta_description', 'Профессиональные консультации и обучение по искусственному интеллекту для вашего бизнеса от экспертов OptimaAI.')

@section('content')
<!-- Hero Section -->
<section class="service-hero position-relative overflow-hidden py-5">
    <div class="neural-bg"></div>
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-10 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-4 text-gradient animate-on-scroll" data-animation="fade-up">Консультации и обучение</h1>
                <p class="lead mb-5 animate-on-scroll" data-animation="fade-up" data-delay="0.2">Помогаем разобраться в возможностях ИИ для вашего бизнеса и обучаем команду работе с нейросетями, чтобы вы могли максимально эффективно использовать современные технологии.</p>
                <button class="btn btn-primary btn-lg animate-on-scroll" data-animation="fade-up" data-delay="0.4" data-bs-toggle="modal" data-bs-target="#requestModal">
                    Оставить заявку
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-dark">
    <div class="container py-5">
        <div class="row mb-5 text-center">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title fw-bold mb-4 animate-on-scroll" data-animation="fade-up">Что включает услуга</h2>
                <p class="section-subtitle animate-on-scroll" data-animation="fade-up" data-delay="0.2">Комплексный подход к обучению и консультированию, адаптированный под ваши бизнес-задачи</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="service-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.1">
                    <div class="service-icon mb-4">
                        <i class="bi bi-lightbulb"></i>
                    </div>
                    <h3 class="service-title h4 fw-bold mb-3">Стратегические консультации</h3>
                    <p class="service-description">Анализ бизнес-процессов и определение областей, где ИИ может принести максимальную пользу. Разработка стратегии внедрения искусственного интеллекта с учетом особенностей вашего бизнеса.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="service-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.2">
                    <div class="service-icon mb-4">
                        <i class="bi bi-people"></i>
                    </div>
                    <h3 class="service-title h4 fw-bold mb-3">Обучение команды</h3>
                    <p class="service-description">Практические воркшопы и тренинги по работе с нейросетями для сотрудников разных уровней. Индивидуальные и групповые занятия с фокусом на практическое применение.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="service-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.3">
                    <div class="service-icon mb-4">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <h3 class="service-title h4 fw-bold mb-3">Оценка эффективности</h3>
                    <p class="service-description">Разработка метрик и KPI для измерения результатов внедрения ИИ в бизнес-процессы. Регулярный мониторинг и корректировка стратегии для достижения максимальных результатов.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="process-section py-5">
    <div class="container py-5">
        <div class="row mb-5 text-center">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title fw-bold mb-4 animate-on-scroll" data-animation="fade-up">Как мы работаем</h2>
                <p class="section-subtitle animate-on-scroll" data-animation="fade-up" data-delay="0.2">Процесс консультирования и обучения, который обеспечивает максимальную эффективность</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="process-timeline">
                    <div class="process-item animate-on-scroll" data-animation="fade-up" data-delay="0.1">
                        <div class="process-number">01</div>
                        <div class="process-content">
                            <h3 class="process-title h5 fw-bold mb-3">Аудит</h3>
                            <p class="process-description mb-0">Анализируем текущие процессы и определяем потребности в обучении. Выявляем ключевые области для внедрения ИИ.</p>
                        </div>
                    </div>
                    
                    <div class="process-item animate-on-scroll" data-animation="fade-up" data-delay="0.2">
                        <div class="process-number">02</div>
                        <div class="process-content">
                            <h3 class="process-title h5 fw-bold mb-3">Программа</h3>
                            <p class="process-description mb-0">Разрабатываем индивидуальную программу обучения и консультаций с учетом специфики вашего бизнеса и уровня подготовки сотрудников.</p>
                        </div>
                    </div>
                    
                    <div class="process-item animate-on-scroll" data-animation="fade-up" data-delay="0.3">
                        <div class="process-number">03</div>
                        <div class="process-content">
                            <h3 class="process-title h5 fw-bold mb-3">Реализация</h3>
                            <p class="process-description mb-0">Проводим обучение и консультации согласно разработанной программе. Обеспечиваем практическое применение полученных знаний.</p>
                        </div>
                    </div>
                    
                    <div class="process-item animate-on-scroll" data-animation="fade-up" data-delay="0.4">
                        <div class="process-number">04</div>
                        <div class="process-content">
                            <h3 class="process-title h5 fw-bold mb-3">Поддержка</h3>
                            <p class="process-description mb-0">Обеспечиваем постоянную поддержку и консультации после завершения основного этапа обучения. Помогаем решать возникающие вопросы.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="py-5 bg-dark">
    <div class="container py-5">
        <div class="row mb-5 text-center">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title fw-bold mb-4 animate-on-scroll" data-animation="fade-up">Преимущества</h2>
                <p class="section-subtitle animate-on-scroll" data-animation="fade-up" data-delay="0.2">Почему стоит выбрать наши консультации и обучение</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="benefit-card animate-on-scroll" data-animation="fade-up" data-delay="0.1">
                    <div class="benefit-check">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="benefit-content">
                        <h3 class="benefit-title h5 fw-bold mb-2">Экспертный опыт</h3>
                        <p class="benefit-text mb-0">Наши специалисты имеют многолетний опыт работы с ИИ и нейросетями в различных отраслях бизнеса.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="benefit-card animate-on-scroll" data-animation="fade-up" data-delay="0.2">
                    <div class="benefit-check">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="benefit-content">
                        <h3 class="benefit-title h5 fw-bold mb-2">Практический подход</h3>
                        <p class="benefit-text mb-0">Фокус на практическом применении знаний и навыков, а не только на теоретических аспектах.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="benefit-card animate-on-scroll" data-animation="fade-up" data-delay="0.3">
                    <div class="benefit-check">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="benefit-content">
                        <h3 class="benefit-title h5 fw-bold mb-2">Индивидуальный подход</h3>
                        <p class="benefit-text mb-0">Адаптация программы обучения и консультаций под конкретные потребности и задачи вашего бизнеса.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="benefit-card animate-on-scroll" data-animation="fade-up" data-delay="0.4">
                    <div class="benefit-check">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="benefit-content">
                        <h3 class="benefit-title h5 fw-bold mb-2">Долгосрочное сотрудничество</h3>
                        <p class="benefit-text mb-0">Мы не просто проводим обучение, но и обеспечиваем поддержку на всех этапах внедрения ИИ в ваш бизнес.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="cta-card text-center p-5 animate-on-scroll" data-animation="scale-up">
                    <h2 class="cta-title fw-bold mb-4">Готовы начать обучение?</h2>
                    <p class="cta-text mb-4">Свяжитесь с нами, чтобы обсудить, как наши консультации и обучение могут помочь вашему бизнесу эффективно использовать искусственный интеллект</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('contact.index') }}" class="btn btn-primary btn-lg">Связаться с нами</a>
                        <button class="btn btn-outline-light btn-lg" data-bs-toggle="modal" data-bs-target="#requestModal">Оставить заявку</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* Service Hero */
    .service-hero {
        padding: 6rem 0;
        background-color: var(--bs-dark);
    }
    
    /* Benefit Cards */
    .benefit-card {
        display: flex;
        align-items: flex-start;
        padding: 1.5rem;
        background: var(--card-bg);
        border-radius: var(--border-radius);
        border: 1px solid var(--border-color);
        margin-bottom: 1.5rem;
        transition: var(--transition-smooth);
    }
    
    .benefit-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--card-shadow-hover);
        border-color: var(--primary-color);
    }
    
    .benefit-check {
        font-size: 1.5rem;
        color: var(--primary-color);
        margin-right: 1rem;
        background: rgba(var(--primary-rgb), 0.1);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        position: relative;
        overflow: hidden;
    }
    
    .benefit-check::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        opacity: 0.2;
        z-index: -1;
    }
    
    .benefit-check i {
        filter: drop-shadow(0 0 5px rgba(var(--primary-rgb), 0.5));
    }
    
    .benefit-content {
        flex: 1;
    }
    
    .benefit-title {
        color: var(--heading-color);
    }
    
    .benefit-text {
        color: var(--text-color);
    }
</style>
@endpush 