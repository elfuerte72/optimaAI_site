@extends('layouts.app')

@section('title', 'Интеграция ИИ в бизнес | OptimaAI')
@section('meta_description', 'Профессиональная интеграция искусственного интеллекта в бизнес-процессы вашей компании от экспертов OptimaAI.')

@section('content')
<!-- Hero Section -->
<section class="service-hero position-relative overflow-hidden py-5">
    <div class="neural-bg"></div>
    <div id="hero-stars-container" class="stars-container"></div>
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-10 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-4 text-gradient neon-text animate-on-scroll" data-animation="fade-up">Интеграция ИИ в бизнес</h1>
                <p class="lead mb-5 animate-on-scroll" data-animation="fade-up" data-delay="0.2">Внедряем искусственный интеллект в рабочие процессы вашей компании для автоматизации рутинных задач, оптимизации процессов и повышения эффективности бизнеса.</p>
                <button class="btn btn-accent btn-lg animate-on-scroll neon-glow" data-animation="fade-up" data-delay="0.4" data-bs-toggle="modal" data-bs-target="#requestModal">
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
                <p class="section-subtitle animate-on-scroll" data-animation="fade-up" data-delay="0.2">Комплексный подход к внедрению искусственного интеллекта в ваш бизнес</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="service-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.1">
                    <div class="service-icon mb-4 pulse-animation">
                        <i class="bi bi-search"></i>
                    </div>
                    <h3 class="service-title h4 fw-bold mb-3">Аудит и анализ</h3>
                    <p class="service-description">Комплексный анализ бизнес-процессов и выявление областей, где внедрение ИИ принесет максимальную пользу. Оценка готовности инфраструктуры и данных.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="service-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.2">
                    <div class="service-icon mb-4 pulse-animation">
                        <i class="bi bi-code-square"></i>
                    </div>
                    <h3 class="service-title h4 fw-bold mb-3">Разработка решений</h3>
                    <p class="service-description">Создание и настройка ИИ-решений под конкретные задачи вашего бизнеса. Интеграция с существующими системами и процессами компании.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="service-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.3">
                    <div class="service-icon mb-4 pulse-animation">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                    <h3 class="service-title h4 fw-bold mb-3">Внедрение и поддержка</h3>
                    <p class="service-description">Плавное внедрение ИИ-решений в рабочие процессы, обучение сотрудников и постоянная техническая поддержка после запуска.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="process-section py-5 position-relative overflow-hidden">
    <div class="neural-bg"></div>
    <div id="process-stars-container" class="stars-container"></div>
    <div class="container py-5">
        <div class="row mb-5 text-center">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title fw-bold mb-4 animate-on-scroll" data-animation="fade-up">Как мы работаем</h2>
                <p class="section-subtitle animate-on-scroll" data-animation="fade-up" data-delay="0.2">Процесс интеграции искусственного интеллекта в ваш бизнес</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="process-timeline">
                    <div class="process-item animate-on-scroll" data-animation="fade-up" data-delay="0.1">
                        <div class="process-number neon-text">01</div>
                        <div class="process-content">
                            <h3 class="process-title h5 fw-bold mb-3">Диагностика</h3>
                            <p class="process-description mb-0">Анализируем текущие бизнес-процессы, выявляем узкие места и определяем возможности для оптимизации с помощью ИИ.</p>
                        </div>
                    </div>
                    
                    <div class="process-item animate-on-scroll" data-animation="fade-up" data-delay="0.2">
                        <div class="process-number neon-text">02</div>
                        <div class="process-content">
                            <h3 class="process-title h5 fw-bold mb-3">Стратегия</h3>
                            <p class="process-description mb-0">Разрабатываем стратегию внедрения ИИ с учетом особенностей вашего бизнеса, определяем ключевые показатели эффективности.</p>
                        </div>
                    </div>
                    
                    <div class="process-item animate-on-scroll" data-animation="fade-up" data-delay="0.3">
                        <div class="process-number neon-text">03</div>
                        <div class="process-content">
                            <h3 class="process-title h5 fw-bold mb-3">Разработка</h3>
                            <p class="process-description mb-0">Создаем и настраиваем ИИ-решения, адаптированные под ваши задачи, интегрируем их с существующими системами.</p>
                        </div>
                    </div>
                    
                    <div class="process-item animate-on-scroll" data-animation="fade-up" data-delay="0.4">
                        <div class="process-number neon-text">04</div>
                        <div class="process-content">
                            <h3 class="process-title h5 fw-bold mb-3">Внедрение</h3>
                            <p class="process-description mb-0">Поэтапно внедряем ИИ-решения в рабочие процессы, обучаем сотрудников и контролируем эффективность.</p>
                        </div>
                    </div>
                    
                    <div class="process-item animate-on-scroll" data-animation="fade-up" data-delay="0.5">
                        <div class="process-number neon-text">05</div>
                        <div class="process-content">
                            <h3 class="process-title h5 fw-bold mb-3">Поддержка</h3>
                            <p class="process-description mb-0">Обеспечиваем техническую поддержку, мониторинг и оптимизацию внедренных решений для достижения максимальной эффективности.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Use Cases Section -->
<section class="py-5 bg-dark">
    <div class="container py-5">
        <div class="row mb-5 text-center">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title fw-bold mb-4 animate-on-scroll" data-animation="fade-up">Применение</h2>
                <p class="section-subtitle animate-on-scroll" data-animation="fade-up" data-delay="0.2">Области, где интеграция ИИ приносит максимальную пользу</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="service-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.1">
                    <div class="service-icon mb-4 pulse-animation">
                        <i class="bi bi-headset"></i>
                    </div>
                    <h3 class="service-title h4 fw-bold mb-3">Обслуживание клиентов</h3>
                    <p class="service-description">Автоматизация поддержки клиентов с помощью ИИ-ассистентов, чат-ботов и систем автоматического ответа на запросы для повышения качества обслуживания.</p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="service-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.2">
                    <div class="service-icon mb-4 pulse-animation">
                        <i class="bi bi-clipboard-data"></i>
                    </div>
                    <h3 class="service-title h4 fw-bold mb-3">Аналитика и прогнозирование</h3>
                    <p class="service-description">Использование ИИ для анализа больших объемов данных, выявления трендов и прогнозирования бизнес-показателей для принятия обоснованных решений.</p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="service-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.3">
                    <div class="service-icon mb-4 pulse-animation">
                        <i class="bi bi-robot"></i>
                    </div>
                    <h3 class="service-title h4 fw-bold mb-3">Автоматизация процессов</h3>
                    <p class="service-description">Внедрение ИИ для автоматизации рутинных задач, оптимизации рабочих процессов и повышения производительности сотрудников.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="py-5 position-relative overflow-hidden">
    <div class="neural-bg"></div>
    <div id="benefits-stars-container" class="stars-container"></div>
    <div class="container py-5">
        <div class="row mb-5 text-center">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title fw-bold mb-4 animate-on-scroll" data-animation="fade-up">Преимущества</h2>
                <p class="section-subtitle animate-on-scroll" data-animation="fade-up" data-delay="0.2">Почему стоит выбрать нашу услугу по интеграции ИИ в бизнес</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="benefit-card animate-on-scroll" data-animation="fade-up" data-delay="0.1">
                    <div class="benefit-check pulse-animation">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="benefit-content">
                        <h3 class="benefit-title h5 fw-bold mb-2">Повышение эффективности</h3>
                        <p class="benefit-text mb-0">Автоматизация рутинных задач и оптимизация процессов позволяют сократить затраты времени и ресурсов на 30-50%.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="benefit-card animate-on-scroll" data-animation="fade-up" data-delay="0.2">
                    <div class="benefit-check pulse-animation">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="benefit-content">
                        <h3 class="benefit-title h5 fw-bold mb-2">Улучшение качества</h3>
                        <p class="benefit-text mb-0">ИИ-решения обеспечивают стабильно высокое качество выполнения задач и минимизируют человеческий фактор.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="benefit-card animate-on-scroll" data-animation="fade-up" data-delay="0.3">
                    <div class="benefit-check pulse-animation">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="benefit-content">
                        <h3 class="benefit-title h5 fw-bold mb-2">Масштабируемость</h3>
                        <p class="benefit-text mb-0">ИИ-решения легко масштабируются под растущие потребности бизнеса без пропорционального увеличения затрат.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="benefit-card animate-on-scroll" data-animation="fade-up" data-delay="0.4">
                    <div class="benefit-check pulse-animation">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="benefit-content">
                        <h3 class="benefit-title h5 fw-bold mb-2">Конкурентное преимущество</h3>
                        <p class="benefit-text mb-0">Внедрение ИИ позволяет опередить конкурентов, предлагая клиентам более качественные продукты и услуги.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5 position-relative overflow-hidden">
    <div class="neural-bg"></div>
    <div id="cta-stars-container" class="stars-container"></div>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="cta-card text-center p-5 animate-on-scroll neon-border" data-animation="scale-up">
                    <h2 class="cta-title fw-bold mb-4 neon-text">Готовы трансформировать свой бизнес?</h2>
                    <p class="cta-text mb-4">Свяжитесь с нами, чтобы обсудить, как интеграция искусственного интеллекта может помочь вашему бизнесу стать более эффективным и конкурентоспособным</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('contact.index') }}" class="btn btn-primary btn-lg neon-glow">Связаться с нами</a>
                        <button class="btn btn-accent btn-lg neon-glow" data-bs-toggle="modal" data-bs-target="#requestModal">Оставить заявку</button>
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
        position: relative;
    }
    
    /* Process Section */
    .process-section {
        background-color: var(--bs-dark);
    }
    
    .process-timeline {
        position: relative;
        padding-left: 2rem;
    }
    
    .process-timeline::before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        width: 2px;
        background: linear-gradient(to bottom, var(--primary-color), var(--accent-color));
        box-shadow: 0 0 10px rgba(var(--primary-rgb), 0.5);
    }
    
    .process-item {
        position: relative;
        padding-bottom: 2.5rem;
    }
    
    .process-item:last-child {
        padding-bottom: 0;
    }
    
    .process-number {
        position: absolute;
        left: -2.5rem;
        width: 3rem;
        height: 3rem;
        background: rgba(var(--primary-rgb), 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: var(--primary-color);
        border: 2px solid var(--primary-color);
        box-shadow: 0 0 15px rgba(var(--primary-rgb), 0.5);
    }
    
    .process-content {
        padding-left: 1.5rem;
    }
    
    /* Service Cards */
    .service-card {
        padding: 2rem;
        background: var(--card-bg);
        border-radius: var(--border-radius);
        border: 1px solid var(--border-color);
        transition: var(--transition-smooth);
        text-align: center;
    }
    
    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--card-shadow-hover);
        border-color: var(--primary-color);
    }
    
    .service-icon {
        font-size: 2.5rem;
        color: var(--primary-color);
        margin-bottom: 1.5rem;
        background: rgba(var(--primary-rgb), 0.1);
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        position: relative;
        overflow: hidden;
    }
    
    .service-icon::before {
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
    
    .service-icon i {
        filter: drop-shadow(0 0 5px rgba(var(--primary-rgb), 0.5));
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
    
    /* CTA Section */
    .cta-section {
        background-color: var(--bs-dark);
    }
    
    .cta-card {
        background: rgba(var(--primary-rgb), 0.05);
        border-radius: var(--border-radius);
        border: 1px solid rgba(var(--primary-rgb), 0.2);
        box-shadow: 0 0 20px rgba(var(--primary-rgb), 0.2);
    }
    
    .cta-title {
        color: var(--heading-color);
    }
    
    .cta-text {
        color: var(--text-color);
        font-size: 1.1rem;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Create stars for all containers
        createStarsForContainer('hero-stars-container');
        createStarsForContainer('process-stars-container');
        createStarsForContainer('benefits-stars-container');
        createStarsForContainer('cta-stars-container');
    });
    
    // Function to create stars for a specific container
    function createStarsForContainer(containerId) {
        const starsContainer = document.getElementById(containerId);
        if (!starsContainer) return;
        
        const numberOfStars = 15; // Number of stars
        
        for (let i = 0; i < numberOfStars; i++) {
            const star = document.createElement('div');
            star.classList.add('star');
            
            // Random size between 2px and 4px
            const size = Math.random() * 2 + 2;
            star.style.width = `${size}px`;
            star.style.height = `${size}px`;
            
            // Random position
            const left = Math.random() * 100;
            const top = Math.random() * 100;
            star.style.left = `${left}%`;
            star.style.top = `${top}%`;
            
            // Random travel distance
            const travelX = (Math.random() - 0.5) * 200; // -100px to 100px
            const travelY = (Math.random() - 0.5) * 200; // -100px to 100px
            star.style.setProperty('--travel-x', `${travelX}px`);
            star.style.setProperty('--travel-y', `${travelY}px`);
            
            // Random duration between 5s and 15s
            const duration = Math.random() * 10 + 5;
            star.style.setProperty('--duration', `${duration}s`);
            
            // Random delay
            const delay = Math.random() * 5;
            star.style.animationDelay = `${delay}s`;
            
            starsContainer.appendChild(star);
        }
    }
</script>
@endpush 