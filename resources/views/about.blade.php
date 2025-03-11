@extends('layouts.app')

@section('title', 'О компании OptimaAI — нейросетевые решения для бизнеса')
@section('meta_description', 'OptimaAI — экспертный партнёр, предоставляющий индивидуальные нейросетевые решения для бизнеса, образовательных учреждений и госорганизаций.')

@section('content')
    <!-- Hero Section -->
    <section class="hero bg-dark text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">О компании OptimaAI</h1>
                    <p class="lead mb-0">Экспертный партнёр в области нейросетевых решений</p>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="{{ asset('images/about-hero.svg') }}" alt="О компании OptimaAI" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="mb-4">История и миссия</h2>
                    <p class="mb-4">OptimaAI — экспертный партнёр, предоставляющий индивидуальные нейросетевые решения для бизнеса, образовательных учреждений и госорганизаций. Мы экономим ваше время, оптимизируя процессы, и предлагаем сопровождение для постоянного развития.</p>
                    <p>Наша компания была основана группой энтузиастов искусственного интеллекта, которые увидели огромный потенциал в применении нейросетевых технологий для решения бизнес-задач. Мы начали с небольших проектов, но быстро выросли благодаря успешным внедрениям и положительным отзывам клиентов.</p>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h3 class="card-title mb-4">Наши ценности</h3>
                            <ul class="list-unstyled">
                                <li class="d-flex align-items-center mb-3">
                                    <div class="icon-wrapper me-3">
                                        <i class="bi bi-gear-wide-connected fs-4 text-primary"></i>
                                    </div>
                                    <div>
                                        <h4 class="h6 mb-1">Гибкость</h4>
                                        <p class="mb-0">Индивидуальный подход к каждому клиенту и адаптация решений под конкретные задачи.</p>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center mb-3">
                                    <div class="icon-wrapper me-3">
                                        <i class="bi bi-clock-history fs-4 text-primary"></i>
                                    </div>
                                    <div>
                                        <h4 class="h6 mb-1">Экономия времени</h4>
                                        <p class="mb-0">Автоматизация рутинных задач и оптимизация процессов для повышения эффективности.</p>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center mb-3">
                                    <div class="icon-wrapper me-3">
                                        <i class="bi bi-award fs-4 text-primary"></i>
                                    </div>
                                    <div>
                                        <h4 class="h6 mb-1">Экспертность</h4>
                                        <p class="mb-0">Команда специалистов с глубоким пониманием нейросетевых технологий и их применения.</p>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center">
                                    <div class="icon-wrapper me-3">
                                        <i class="bi bi-graph-up-arrow fs-4 text-primary"></i>
                                    </div>
                                    <div>
                                        <h4 class="h6 mb-1">Постоянное развитие</h4>
                                        <p class="mb-0">Непрерывное совершенствование наших решений и следование последним тенденциям в области ИИ.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Location Section -->
    <section class="location py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="mb-4">Наше расположение</h2>
                    <p class="mb-4">Наша компания базируется в Тюмени, но мы работаем с клиентами по всей России и планируем расширение на международный рынок.</p>
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-geo-alt fs-4 text-primary me-3"></i>
                        <p class="mb-0">Тюмень, Россия</p>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-envelope fs-4 text-primary me-3"></i>
                        <p class="mb-0"><a href="mailto:info@optimaai.ru" class="text-decoration-none">info@optimaai.ru</a></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-telephone fs-4 text-primary me-3"></i>
                        <p class="mb-0"><a href="tel:+79123456789" class="text-decoration-none">+7 (912) 345-67-89</a></p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-0">
                            <div class="bg-secondary" style="height: 400px;"></div>
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
                    <h2 class="mb-3">Готовы начать сотрудничество?</h2>
                    <p class="lead mb-0">Оставьте заявку, и мы свяжемся с вами для обсуждения вашего проекта.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <button class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#requestModal">Оставить заявку</button>
                </div>
            </div>
        </div>
    </section>
@endsection 