@extends('layouts.app')

@section('title', 'Настройка языковых моделей | OptimaAI')
@section('meta_description', 'Профессиональная настройка и адаптация языковых моделей под ваши бизнес-задачи от экспертов OptimaAI.')

@section('content')
<!-- Hero Section -->
<section class="service-hero position-relative overflow-hidden py-5">
    <div class="neural-bg"></div>
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-10 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-4 text-gradient animate-on-scroll" data-animation="fade-up">Настройка языковых моделей</h1>
                <p class="lead mb-5 animate-on-scroll" data-animation="fade-up" data-delay="0.2">Адаптируем нейросети под специфику вашей отрасли и конкретные бизнес-задачи для достижения максимальной эффективности и точности результатов.</p>
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
                <p class="section-subtitle animate-on-scroll" data-animation="fade-up" data-delay="0.2">Комплексный подход к настройке языковых моделей для решения ваших бизнес-задач</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="service-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.1">
                    <div class="service-icon mb-4">
                        <i class="bi bi-gear"></i>
                    </div>
                    <h3 class="service-title h4 fw-bold mb-3">Тонкая настройка моделей</h3>
                    <p class="service-description">Адаптация предобученных языковых моделей под специфику вашей отрасли и конкретные задачи с использованием методов fine-tuning и prompt engineering.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="service-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.2">
                    <div class="service-icon mb-4">
                        <i class="bi bi-database"></i>
                    </div>
                    <h3 class="service-title h4 fw-bold mb-3">Обучение на ваших данных</h3>
                    <p class="service-description">Дообучение моделей на корпоративных данных для повышения точности и релевантности результатов. Создание специализированных векторных баз знаний.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="service-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.3">
                    <div class="service-icon mb-4">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h3 class="service-title h4 fw-bold mb-3">Безопасность и контроль</h3>
                    <p class="service-description">Настройка параметров безопасности, фильтрация нежелательного контента и обеспечение конфиденциальности данных при работе с языковыми моделями.</p>
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
                <p class="section-subtitle animate-on-scroll" data-animation="fade-up" data-delay="0.2">Процесс настройки языковых моделей для достижения максимальной эффективности</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="process-timeline">
                    <div class="process-item animate-on-scroll" data-animation="fade-up" data-delay="0.1">
                        <div class="process-number">01</div>
                        <div class="process-content">
                            <h3 class="process-title h5 fw-bold mb-3">Анализ задач</h3>
                            <p class="process-description mb-0">Определяем конкретные бизнес-задачи, которые должна решать языковая модель, и требования к ее функциональности.</p>
                        </div>
                    </div>
                    
                    <div class="process-item animate-on-scroll" data-animation="fade-up" data-delay="0.2">
                        <div class="process-number">02</div>
                        <div class="process-content">
                            <h3 class="process-title h5 fw-bold mb-3">Подготовка данных</h3>
                            <p class="process-description mb-0">Собираем, очищаем и структурируем данные для обучения модели, создаем специализированные датасеты.</p>
                        </div>
                    </div>
                    
                    <div class="process-item animate-on-scroll" data-animation="fade-up" data-delay="0.3">
                        <div class="process-number">03</div>
                        <div class="process-content">
                            <h3 class="process-title h5 fw-bold mb-3">Настройка и обучение</h3>
                            <p class="process-description mb-0">Проводим тонкую настройку выбранной модели, оптимизируем параметры и дообучаем на корпоративных данных.</p>
                        </div>
                    </div>
                    
                    <div class="process-item animate-on-scroll" data-animation="fade-up" data-delay="0.4">
                        <div class="process-number">04</div>
                        <div class="process-content">
                            <h3 class="process-title h5 fw-bold mb-3">Тестирование и внедрение</h3>
                            <p class="process-description mb-0">Проводим тщательное тестирование настроенной модели, интегрируем ее в бизнес-процессы и обеспечиваем техническую поддержку.</p>
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
                <p class="section-subtitle animate-on-scroll" data-animation="fade-up" data-delay="0.2">Области, где настроенные языковые модели могут принести максимальную пользу</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="service-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.1">
                    <div class="service-icon mb-4">
                        <i class="bi bi-headset"></i>
                    </div>
                    <h3 class="service-title h4 fw-bold mb-3">Клиентская поддержка</h3>
                    <p class="service-description">Автоматизация ответов на типовые вопросы, создание интеллектуальных чат-ботов и виртуальных ассистентов для повышения качества обслуживания клиентов.</p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="service-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.2">
                    <div class="service-icon mb-4">
                        <i class="bi bi-file-text"></i>
                    </div>
                    <h3 class="service-title h4 fw-bold mb-3">Работа с документами</h3>
                    <p class="service-description">Автоматическое создание, анализ и классификация документов, извлечение ключевой информации из текстов, генерация отчетов и резюме.</p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="service-card h-100 animate-on-scroll" data-animation="fade-up" data-delay="0.3">
                    <div class="service-icon mb-4">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <h3 class="service-title h4 fw-bold mb-3">Аналитика данных</h3>
                    <p class="service-description">Анализ текстовых данных, выявление трендов и закономерностей, прогнозирование на основе исторических данных и генерация аналитических отчетов.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="py-5">
    <div class="container py-5">
        <div class="row mb-5 text-center">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title fw-bold mb-4 animate-on-scroll" data-animation="fade-up">Преимущества</h2>
                <p class="section-subtitle animate-on-scroll" data-animation="fade-up" data-delay="0.2">Почему стоит выбрать нашу услугу по настройке языковых моделей</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="benefit-card animate-on-scroll" data-animation="fade-up" data-delay="0.1">
                    <div class="benefit-check">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="benefit-content">
                        <h3 class="benefit-title h5 fw-bold mb-2">Высокая точность</h3>
                        <p class="benefit-text mb-0">Настроенные модели обеспечивают более точные и релевантные результаты по сравнению с общими моделями без настройки.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="benefit-card animate-on-scroll" data-animation="fade-up" data-delay="0.2">
                    <div class="benefit-check">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="benefit-content">
                        <h3 class="benefit-title h5 fw-bold mb-2">Отраслевая специфика</h3>
                        <p class="benefit-text mb-0">Учет терминологии и особенностей вашей отрасли для более эффективного решения специализированных задач.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="benefit-card animate-on-scroll" data-animation="fade-up" data-delay="0.3">
                    <div class="benefit-check">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="benefit-content">
                        <h3 class="benefit-title h5 fw-bold mb-2">Конфиденциальность</h3>
                        <p class="benefit-text mb-0">Обеспечение безопасности и конфиденциальности данных при работе с языковыми моделями, соблюдение требований регуляторов.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="benefit-card animate-on-scroll" data-animation="fade-up" data-delay="0.4">
                    <div class="benefit-check">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="benefit-content">
                        <h3 class="benefit-title h5 fw-bold mb-2">Экономия ресурсов</h3>
                        <p class="benefit-text mb-0">Снижение затрат на обработку информации и автоматизация рутинных задач, требующих анализа и генерации текста.</p>
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
                    <h2 class="cta-title fw-bold mb-4">Готовы повысить эффективность бизнеса?</h2>
                    <p class="cta-text mb-4">Свяжитесь с нами, чтобы обсудить, как настроенные языковые модели могут решить ваши бизнес-задачи и автоматизировать рабочие процессы</p>
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