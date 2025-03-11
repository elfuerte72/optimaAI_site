@extends('layouts.app')

@section('title', 'OptimaAI - Оптимизация бизнеса с помощью искусственного интеллекта')
@section('meta_description', 'OptimaAI предлагает профессиональные услуги по внедрению искусственного интеллекта в бизнес-процессы. Консультации, настройка языковых моделей и интеграция ИИ в бизнес.')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section position-relative overflow-hidden">
        <div class="neural-bg"></div>
        <div class="container py-5">
            <div class="row align-items-center py-5">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <h1 class="display-3 fw-bold mb-4 text-gradient animate-on-scroll" data-animation="fade-up">
                        Оптимизация бизнеса с помощью искусственного интеллекта
                    </h1>
                    <p class="lead mb-5 animate-on-scroll" data-animation="fade-up" data-delay="0.2">
                        Мы помогаем компаниям внедрять современные ИИ-технологии для автоматизации процессов, 
                        повышения эффективности и создания конкурентных преимуществ
                    </p>
                    <div class="d-flex flex-wrap animate-on-scroll" data-animation="fade-up" data-delay="0.4">
                        <button class="btn btn-accent btn-lg neon-glow me-3 mb-3" data-bs-toggle="modal" data-bs-target="#requestModal">
                            Оставить заявку
                        </button>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="hero-image-container animate-on-scroll" data-animation="fade-left">
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
        <div id="stars-container" class="stars-container"></div>
        <div class="container py-5">
            <div class="row mb-5 text-center">
                <div class="col-lg-8 mx-auto">
                    <h2 class="section-title fw-bold mb-4 animate-on-scroll" data-animation="fade-up">Преимущества работы с нами</h2>
                    <p class="section-subtitle animate-on-scroll" data-animation="fade-up" data-delay="0.2">Почему клиенты выбирают OptimaAI для внедрения искусственного интеллекта</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="advantage-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.1">
                        <div class="advantage-icon pulse-animation">
                            <i class="bi bi-lightning-charge-fill"></i>
                        </div>
                        <h3 class="advantage-title h5 fw-bold mb-3">Быстрый результат</h3>
                        <p class="advantage-text mb-0">Внедрение первых ИИ-решений и получение измеримых результатов в течение 2-4 недель</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="advantage-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.2">
                        <div class="advantage-icon pulse-animation">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h3 class="advantage-title h5 fw-bold mb-3">Измеримый эффект</h3>
                        <p class="advantage-text mb-0">Прозрачная система метрик и отчетности для оценки эффективности внедрения</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="advantage-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.3">
                        <div class="advantage-icon pulse-animation">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h3 class="advantage-title h5 fw-bold mb-3">Безопасность данных</h3>
                        <p class="advantage-text mb-0">Строгие протоколы защиты информации и соблюдение требований конфиденциальности</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="advantage-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.4">
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
        <div id="process-stars-container" class="stars-container"></div>
        <div class="container py-5">
            <div class="row mb-5 text-center">
                <div class="col-lg-8 mx-auto">
                    <h2 class="section-title fw-bold mb-4 animate-on-scroll neon-text" data-animation="fade-up">Как мы работаем</h2>
                    <p class="section-subtitle animate-on-scroll" data-animation="fade-up" data-delay="0.2">Наш подход к внедрению искусственного интеллекта в бизнес</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="process-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.1">
                        <div class="process-icon pulse-animation">
                            <i class="bi bi-search"></i>
                        </div>
                        <h3 class="process-title h5 fw-bold mb-3">Анализ потребностей</h3>
                        <p class="process-description mb-4">Изучаем ваш бизнес, определяем ключевые процессы и выявляем области, где внедрение ИИ принесет максимальную пользу</p>
                        <div class="process-details">
                            <button class="btn btn-sm btn-outline-light process-details-toggle">
                                <span class="toggle-text">Подробнее</span>
                                <i class="bi bi-chevron-down toggle-icon"></i>
                            </button>
                            <div class="process-details-content">
                                <ul class="mt-3">
                                    <li>Аудит текущих бизнес-процессов</li>
                                    <li>Выявление узких мест и возможностей</li>
                                    <li>Оценка готовности инфраструктуры</li>
                                    <li>Определение приоритетных направлений</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="process-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.2">
                        <div class="process-icon pulse-animation">
                            <i class="bi bi-diagram-3"></i>
                        </div>
                        <h3 class="process-title h5 fw-bold mb-3">Разработка стратегии</h3>
                        <p class="process-description mb-4">Создаем детальный план внедрения ИИ с учетом особенностей вашего бизнеса, бюджета и временных рамок</p>
                        <div class="process-details">
                            <button class="btn btn-sm btn-outline-light process-details-toggle">
                                <span class="toggle-text">Подробнее</span>
                                <i class="bi bi-chevron-down toggle-icon"></i>
                            </button>
                            <div class="process-details-content">
                                <ul class="mt-3">
                                    <li>Формирование дорожной карты</li>
                                    <li>Определение ключевых показателей</li>
                                    <li>Расчет ROI и сроков окупаемости</li>
                                    <li>Планирование ресурсов и команды</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="process-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.3">
                        <div class="process-icon pulse-animation">
                            <i class="bi bi-rocket"></i>
                        </div>
                        <h3 class="process-title h5 fw-bold mb-3">Пилотный проект</h3>
                        <p class="process-description mb-4">Реализуем пилотное внедрение ИИ на ограниченном участке для демонстрации эффективности и сбора обратной связи</p>
                        <div class="process-details">
                            <button class="btn btn-sm btn-outline-light process-details-toggle">
                                <span class="toggle-text">Подробнее</span>
                                <i class="bi bi-chevron-down toggle-icon"></i>
                            </button>
                            <div class="process-details-content">
                                <ul class="mt-3">
                                    <li>Разработка прототипа решения</li>
                                    <li>Тестирование на ограниченной выборке</li>
                                    <li>Сбор и анализ обратной связи</li>
                                    <li>Корректировка подхода при необходимости</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="process-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.4">
                        <div class="process-icon pulse-animation">
                            <i class="bi bi-gear-wide-connected"></i>
                        </div>
                        <h3 class="process-title h5 fw-bold mb-3">Полномасштабное внедрение</h3>
                        <p class="process-description mb-4">Расширяем использование ИИ на все целевые процессы, обучаем персонал и интегрируем решения с существующими системами</p>
                        <div class="process-details">
                            <button class="btn btn-sm btn-outline-light process-details-toggle">
                                <span class="toggle-text">Подробнее</span>
                                <i class="bi bi-chevron-down toggle-icon"></i>
                            </button>
                            <div class="process-details-content">
                                <ul class="mt-3">
                                    <li>Масштабирование решения</li>
                                    <li>Интеграция с существующими системами</li>
                                    <li>Обучение персонала</li>
                                    <li>Настройка процессов мониторинга</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="process-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.5">
                        <div class="process-icon pulse-animation">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h3 class="process-title h5 fw-bold mb-3">Поддержка и развитие</h3>
                        <p class="process-description mb-4">Обеспечиваем техническую поддержку, мониторинг эффективности и постоянное совершенствование внедренных решений</p>
                        <div class="process-details">
                            <button class="btn btn-sm btn-outline-light process-details-toggle">
                                <span class="toggle-text">Подробнее</span>
                                <i class="bi bi-chevron-down toggle-icon"></i>
                            </button>
                            <div class="process-details-content">
                                <ul class="mt-3">
                                    <li>Техническая поддержка 24/7</li>
                                    <li>Регулярный анализ эффективности</li>
                                    <li>Обновление и оптимизация моделей</li>
                                    <li>Расширение функциональности</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="process-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.6">
                        <div class="process-icon pulse-animation">
                            <i class="bi bi-mortarboard"></i>
                        </div>
                        <h3 class="process-title h5 fw-bold mb-3">Обучение и адаптация</h3>
                        <p class="process-description mb-4">Проводим обучение сотрудников и помогаем адаптировать рабочие процессы для максимальной эффективности использования ИИ</p>
                        <div class="process-details">
                            <button class="btn btn-sm btn-outline-light process-details-toggle">
                                <span class="toggle-text">Подробнее</span>
                                <i class="bi bi-chevron-down toggle-icon"></i>
                            </button>
                            <div class="process-details-content">
                                <ul class="mt-3">
                                    <li>Разработка обучающих материалов</li>
                                    <li>Проведение тренингов и воркшопов</li>
                                    <li>Сопровождение в период адаптации</li>
                                    <li>Сбор обратной связи от пользователей</li>
                                </ul>
                            </div>
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
                        <h2 class="cta-title fw-bold mb-4">Готовы оптимизировать свой бизнес с помощью ИИ?</h2>
                        <p class="cta-text mb-4">Свяжитесь с нами, чтобы обсудить, как искусственный интеллект может помочь вашему бизнесу стать более эффективным и конкурентоспособным</p>
                        <div class="d-flex justify-content-center">
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
    /* Hero Section */
    .hero-section {
        padding: 6rem 0;
        background-color: var(--bs-dark);
        position: relative;
    }
    
    .neural-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: none;
        opacity: 0;
    }
    
    .text-gradient {
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        display: inline-block;
    }
    
    .hero-image-container {
        position: relative;
        z-index: 1;
    }
    
    .hero-glow {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(var(--primary-rgb), 0.3) 0%, transparent 70%);
        filter: blur(30px);
        z-index: -1;
    }
    
    /* Advantages Section */
    .advantages-section {
        background-color: var(--bs-dark);
        position: relative;
    }
    
    /* Stars Animation */
    .stars-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 0;
    }
    
    .star {
        position: absolute;
        background-color: #fff;
        border-radius: 50%;
        opacity: 0;
        z-index: 1;
        animation: twinkle var(--duration) ease-in-out infinite;
        box-shadow: 0 0 10px 0 rgba(255, 255, 255, 0.7);
    }
    
    @keyframes twinkle {
        0% {
            opacity: 0;
            transform: translateY(0) translateX(0);
        }
        10% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        100% {
            opacity: 0;
            transform: translateY(var(--travel-y)) translateX(var(--travel-x));
        }
    }
    
    /* Pulse Animation for Icons */
    .pulse-animation {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(var(--primary-rgb), 0.7);
        }
        70% {
            transform: scale(1.05);
            box-shadow: 0 0 0 10px rgba(var(--primary-rgb), 0);
        }
        100% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(var(--primary-rgb), 0);
        }
    }
    
    .advantage-card {
        padding: 2rem;
        background: var(--card-bg);
        border-radius: var(--border-radius);
        border: 1px solid var(--border-color);
        transition: var(--transition-smooth);
        text-align: center;
    }
    
    .advantage-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--card-shadow-hover);
        border-color: var(--primary-color);
    }
    
    .advantage-icon {
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
    
    .advantage-icon::before {
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
    
    .advantage-icon i {
        filter: drop-shadow(0 0 5px rgba(var(--primary-rgb), 0.5));
    }
    
    .advantage-title {
        color: var(--heading-color);
    }
    
    .advantage-text {
        color: var(--text-color);
    }
    
    /* Process Section */
    .process-section {
        background-color: var(--bs-dark);
        position: relative;
    }
    
    .process-card {
        padding: 2rem;
        background: var(--card-bg);
        border-radius: var(--border-radius);
        border: 1px solid var(--border-color);
        transition: var(--transition-smooth);
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .process-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--card-shadow-hover);
        border-color: var(--primary-color);
    }
    
    .process-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.5s ease;
    }
    
    .process-card:hover::after {
        transform: scaleX(1);
    }
    
    .process-icon {
        font-size: 2.5rem;
        color: var(--primary-color);
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
    
    .process-icon::before {
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
    
    .process-icon i {
        filter: drop-shadow(0 0 5px rgba(var(--primary-rgb), 0.5));
    }
    
    .process-title {
        color: var(--heading-color);
    }
    
    .process-description {
        color: var(--text-color);
    }
    
    .process-details-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s ease, opacity 0.5s ease;
        opacity: 0;
    }
    
    .process-details-content.active {
        max-height: 300px;
        opacity: 1;
    }
    
    .process-details-toggle {
        position: relative;
        overflow: hidden;
        z-index: 1;
    }
    
    .process-details-toggle::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
        z-index: -1;
    }
    
    .process-details-toggle:hover::before {
        left: 100%;
    }
    
    .toggle-icon {
        transition: transform 0.3s ease;
    }
    
    .toggle-icon.active {
        transform: rotate(180deg);
    }
    
    .process-details-content ul {
        list-style: none;
        padding-left: 0;
    }
    
    .process-details-content li {
        position: relative;
        padding-left: 1.5rem;
        margin-bottom: 0.5rem;
        color: var(--text-color);
        text-align: left;
    }
    
    .process-details-content li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    }
    
    /* CTA Section */
    .cta-section {
        background-color: var(--bs-dark);
        position: relative;
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
    }
    
    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes slideUp {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    
    @keyframes scaleUp {
        from { transform: scale(0.8); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    
    [data-animation="fade-up"] {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }
    
    [data-animation="fade-up"].animate {
        opacity: 1;
        transform: translateY(0);
    }
    
    [data-animation="scale-up"] {
        opacity: 0;
        transform: scale(0.8);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }
    
    [data-animation="scale-up"].animate {
        opacity: 1;
        transform: scale(1);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Intersection Observer for animations
        const animateElements = document.querySelectorAll('[data-animation]');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const delay = el.getAttribute('data-delay') || 0;
                    
                    setTimeout(() => {
                        el.classList.add('animate');
                    }, delay * 1000);
                    
                    observer.unobserve(el);
                }
            });
        }, {
            threshold: 0.1
        });
        
        animateElements.forEach(el => {
            observer.observe(el);
        });
        
        // Create stars for the advantages section
        createStars('stars-container');
        
        // Create stars for the process section
        createStars('process-stars-container');
        
        // Toggle process details
        const toggleButtons = document.querySelectorAll('.process-details-toggle');
        
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const content = this.nextElementSibling;
                const icon = this.querySelector('.toggle-icon');
                const textSpan = this.querySelector('.toggle-text');
                
                content.classList.toggle('active');
                icon.classList.toggle('active');
                
                if (content.classList.contains('active')) {
                    textSpan.textContent = 'Скрыть';
                } else {
                    textSpan.textContent = 'Подробнее';
                }
            });
        });
    });
    
    // Function to create stars for a specific container
    function createStars(containerId) {
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