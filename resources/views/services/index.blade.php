@extends('layouts.app')

@section('title', 'Услуги OptimaAI — нейросетевые решения для бизнеса')
@section('meta_description', 'Мы предлагаем широкий спектр услуг по внедрению нейросетевых технологий: консультации, настройка языковых моделей, интеграция ИИ в бизнес-процессы.')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section position-relative overflow-hidden">
        <div class="neural-bg"></div>
        <div id="stars-container" class="stars-container"></div>
    </section>

    <!-- Services Section -->
    <section class="services-section position-relative py-5 overflow-hidden">
        <div class="container py-5">
            <!-- Services Cards Grid - React Container -->
            <div id="react-service-cards" 
                data-services="{{ json_encode([
                    [
                        'id' => 1,
                        'title' => 'Консультации и обучение',
                        'description' => 'Экспертная помощь в выборе оптимальных нейросетевых решений и обучение вашей команды работе с ИИ-инструментами',
                        'icon' => 'consulting-icon',
                        'url' => route('services.consulting-and-training')
                    ],
                    [
                        'id' => 2,
                        'title' => 'Настройка языковых моделей',
                        'description' => 'Профессиональная настройка и fine-tuning нейросетевых моделей под специфику вашей отрасли и задачи',
                        'icon' => 'models-icon',
                        'url' => route('services.language-models-setup')
                    ],
                    [
                        'id' => 3,
                        'title' => 'Интеграция ИИ в бизнес',
                        'description' => 'Комплексное внедрение искусственного интеллекта в рабочие процессы компании с измеримыми результатами',
                        'icon' => 'integration-icon',
                        'url' => route('services.ai-business-integration')
                    ]
                ]) }}">
                <!-- React will mount here, this is fallback content -->
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Загрузка...</span>
                    </div>
                    <p class="mt-3">Загружаем карточки услуг...</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits-section py-5 position-relative">
        <div class="neural-bg light"></div>
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-title fw-bold mb-4 animate-on-scroll" data-animation="fade-up">Преимущества наших услуг</h2>
                    <p class="section-subtitle animate-on-scroll" data-animation="fade-up" data-delay="0.2">
                        Почему клиенты выбирают OptimaAI для внедрения искусственного интеллекта
                    </p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4 animate-on-scroll" data-animation="fade-up" data-delay="0.1">
                    <div class="benefit-card h-100">
                        <div class="benefit-icon">
                            <i class="ai-icon benefit-icon-expert"></i>
                        </div>
                        <h3 class="h5 mb-3">Экспертная команда</h3>
                        <p>Специалисты с опытом в AI/ML, разработке ПО и бизнес-консалтинге</p>
                    </div>
                </div>
                
                <div class="col-md-4 animate-on-scroll" data-animation="fade-up" data-delay="0.2">
                    <div class="benefit-card h-100">
                        <div class="benefit-icon">
                            <i class="ai-icon benefit-icon-custom"></i>
                        </div>
                        <h3 class="h5 mb-3">Индивидуальный подход</h3>
                        <p>Решения, учитывающие специфику вашей отрасли и бизнес-процессов</p>
                    </div>
                </div>
                
                <div class="col-md-4 animate-on-scroll" data-animation="fade-up" data-delay="0.3">
                    <div class="benefit-card h-100">
                        <div class="benefit-icon">
                            <i class="ai-icon benefit-icon-result"></i>
                        </div>
                        <h3 class="h5 mb-3">Измеримые результаты</h3>
                        <p>Конкретные показатели эффективности и ROI внедряемых решений</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section py-5 position-relative overflow-hidden">
        <div class="neural-bg"></div>
        <div class="container py-4">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-4 mb-lg-0 animate-on-scroll" data-animation="fade-up">
                    <h2 class="mb-3 text-gradient">Готовы обсудить ваш проект?</h2>
                    <p class="lead mb-0">Оставьте заявку, и мы свяжемся с вами для обсуждения деталей</p>
                </div>
                <div class="col-lg-4 text-lg-end animate-on-scroll" data-animation="fade-left">
                    <button class="btn btn-accent btn-lg" data-bs-toggle="modal" data-bs-target="#requestModal">Оставить заявку</button>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('additional_styles')
<style>
    /* Стили для карточек услуг */
    .service-card {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        background: rgba(20, 25, 45, 0.7);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        transition: all 0.4s ease;
    }
    
    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
    }
    
    .service-card-inner {
        padding: 30px;
        position: relative;
        z-index: 2;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .service-icon-wrapper {
        height: 80px;
        width: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(99, 102, 241, 0.2);
        margin-bottom: 20px;
        position: relative;
    }
    
    .service-cta {
        margin-top: auto;
    }
    
    /* Стили для карточек преимуществ */
    .benefit-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        padding: 30px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .benefit-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }
    
    .benefit-icon {
        width: 60px;
        height: 60px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(99, 102, 241, 0.2);
        border-radius: 50%;
    }
    
    /* Стили для временной шкалы */
    .timeline-container {
        position: relative;
        padding: 40px 0;
    }
    
    .timeline-track {
        position: relative;
    }
    
    .timeline-track:before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 40px;
        width: 2px;
        background: linear-gradient(to bottom, 
            rgba(99, 102, 241, 0.1), 
            rgba(99, 102, 241, 0.7), 
            rgba(99, 102, 241, 0.1));
    }
    
    .timeline-item {
        display: flex;
        margin-bottom: 50px;
        position: relative;
    }
    
    .timeline-number {
        width: 80px;
        height: 80px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(99, 102, 241, 0.2);
        color: #6366f1;
        font-weight: bold;
        font-size: 24px;
        z-index: 2;
        transition: all 0.3s ease;
    }
    
    .timeline-content {
        padding-left: 30px;
        padding-top: 10px;
    }
    
    .timeline-item:hover .timeline-number {
        background: rgba(99, 102, 241, 0.8);
        color: white;
        box-shadow: 0 0 20px rgba(99, 102, 241, 0.5);
    }
    
    /* Адаптивность */
    @media (max-width: 992px) {
        .timeline-track:before {
            left: 30px;
        }
        
        .timeline-number {
            width: 60px;
            height: 60px;
            font-size: 18px;
        }
    }
</style>
@endsection

@push('scripts')
<script>
    // Проверка загрузки React
    window.addEventListener('load', function() {
        console.log('Страница услуг загружена');
        
        // Проверяем, загрузился ли React
        setTimeout(function() {
            const reactContainer = document.getElementById('react-service-cards');
            const debugInfo = document.querySelector('.react-debug-info');
            
            if (reactContainer && !debugInfo) {
                console.log('React не загрузился, пробуем загрузить напрямую');
                
                // Если React не загрузился, пробуем загрузить скрипты напрямую
                const script = document.createElement('script');
                script.src = '/build/assets/react-app-BGLecAM5.js';
                script.type = 'module';
                document.body.appendChild(script);
                
                // Также загружаем vendor скрипт
                const vendorScript = document.createElement('script');
                vendorScript.src = '/build/assets/react-vendor-BOZ7xSXu.js';
                vendorScript.type = 'module';
                document.body.appendChild(vendorScript);
                
                // И основной скрипт приложения
                const appScript = document.createElement('script');
                appScript.src = '/build/assets/app-BnSuhvBk.js';
                appScript.type = 'module';
                document.body.appendChild(appScript);
            }
        }, 2000);
    });
</script>
@endpush 