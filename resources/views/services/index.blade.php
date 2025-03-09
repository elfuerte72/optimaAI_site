@extends('layouts.app')

@section('title', 'Услуги OptimaAI — нейросетевые решения для бизнеса')
@section('meta_description', 'Мы предлагаем широкий спектр услуг по внедрению нейросетевых технологий: консультации, настройка языковых моделей, интеграция ИИ в бизнес-процессы.')

@section('content')
    <!-- Hero Section -->
    <section class="hero bg-dark text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Наши услуги</h1>
                    <p class="lead mb-0">Индивидуальные нейросетевые решения для вашего бизнеса</p>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="{{ asset('images/services-hero.svg') }}" alt="Услуги OptimaAI" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="mb-4">Что мы предлагаем</h2>
                    <p class="lead">Мы предлагаем комплексные решения для бизнеса, образовательных учреждений и госорганизаций, помогая оптимизировать процессы с помощью искусственного интеллекта.</p>
                </div>
            </div>
            
            <div class="row g-4">
                @forelse($services as $service)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            @if($service->image)
                                <img src="{{ asset($service->image) }}" class="card-img-top" alt="{{ $service->title }}">
                            @else
                                <div class="card-img-top bg-secondary" style="height: 200px;"></div>
                            @endif
                            <div class="card-body">
                                <h3 class="card-title h5">{{ $service->title }}</h3>
                                <p class="card-text">{{ Str::limit($service->description, 150) }}</p>
                                <a href="{{ route('services.show', $service) }}" class="btn btn-outline-primary">Подробнее</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            В настоящее время информация об услугах недоступна. Пожалуйста, свяжитесь с нами для получения подробной информации.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="process py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="mb-4">Как мы работаем</h2>
                    <p class="lead">Наш подход к работе основан на глубоком понимании потребностей клиента и индивидуальном подходе к каждому проекту.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="process-step mb-3">
                                <span class="fs-2 fw-bold text-primary">01</span>
                            </div>
                            <h3 class="card-title h5">Анализ потребностей</h3>
                            <p class="card-text">Мы изучаем ваш бизнес, процессы и задачи, чтобы определить оптимальное решение.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="process-step mb-3">
                                <span class="fs-2 fw-bold text-primary">02</span>
                            </div>
                            <h3 class="card-title h5">Разработка решения</h3>
                            <p class="card-text">Создаем индивидуальное решение, адаптированное под ваши конкретные задачи.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="process-step mb-3">
                                <span class="fs-2 fw-bold text-primary">03</span>
                            </div>
                            <h3 class="card-title h5">Внедрение</h3>
                            <p class="card-text">Интегрируем решение в ваши существующие системы и обучаем сотрудников.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="process-step mb-3">
                                <span class="fs-2 fw-bold text-primary">04</span>
                            </div>
                            <h3 class="card-title h5">Сопровождение</h3>
                            <p class="card-text">Обеспечиваем постоянную поддержку и развитие внедренного решения.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="mb-4">Часто задаваемые вопросы</h2>
                    <p class="lead">Ответы на наиболее распространенные вопросы о наших услугах и процессе работы.</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Сколько времени занимает внедрение ИИ-решения?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Сроки внедрения зависят от сложности проекта и готовности инфраструктуры. Обычно процесс занимает от 2 недель до 3 месяцев. На первом этапе мы проводим анализ и составляем детальный план работ с указанием сроков.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Какие технологии вы используете?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Мы работаем с широким спектром технологий, включая GPT, BERT, различные языковые модели, компьютерное зрение и другие. Выбор технологии зависит от конкретных задач и потребностей клиента.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Как оценить эффективность внедрения ИИ?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Мы разрабатываем индивидуальные KPI для каждого проекта. Это может быть экономия времени сотрудников, повышение точности прогнозов, сокращение ошибок или другие метрики, важные для вашего бизнеса.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Нужны ли специальные знания для работы с вашими решениями?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Нет, наши решения разрабатываются с учетом удобства использования. Мы проводим обучение сотрудников и предоставляем подробную документацию. Кроме того, мы обеспечиваем техническую поддержку на всех этапах работы.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta py-5 bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <h2 class="mb-3">Готовы обсудить ваш проект?</h2>
                    <p class="lead mb-0">Оставьте заявку, и мы свяжемся с вами для обсуждения деталей.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <button class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#requestModal">Оставить заявку</button>
                </div>
            </div>
        </div>
    </section>
@endsection 