@extends('layouts.app')

@section('title', 'OptimaAI — нейросетевые решения для вашего бизнеса')

@section('content')
    <!-- Hero Section -->
    <section class="hero bg-dark text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">OptimaAI — нейросетевые решения для вашего бизнеса</h1>
                    <p class="lead mb-4">Мы экономим ваше время, оптимизируя процессы с помощью искусственного интеллекта, и предлагаем сопровождение для постоянного развития.</p>
                    <div class="d-flex gap-3">
                        <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#requestModal">Оставить заявку</button>
                        <a href="{{ route('services.index') }}" class="btn btn-outline-light btn-lg">Наши услуги</a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="{{ asset('images/hero-image.svg') }}" alt="OptimaAI" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Advantages Section -->
    <section class="advantages py-5">
        <div class="container">
            <h2 class="text-center mb-5">Наши преимущества</h2>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-gear-wide-connected fs-1 text-primary"></i>
                            </div>
                            <h3 class="card-title h5">Гибкость</h3>
                            <p class="card-text">Индивидуальный подход к каждому клиенту и адаптация решений под конкретные задачи.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-clock-history fs-1 text-primary"></i>
                            </div>
                            <h3 class="card-title h5">Экономия времени</h3>
                            <p class="card-text">Автоматизация рутинных задач и оптимизация процессов для повышения эффективности.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-award fs-1 text-primary"></i>
                            </div>
                            <h3 class="card-title h5">Экспертность</h3>
                            <p class="card-text">Команда специалистов с глубоким пониманием нейросетевых технологий и их применения.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-graph-up-arrow fs-1 text-primary"></i>
                            </div>
                            <h3 class="card-title h5">Сопровождение</h3>
                            <p class="card-text">Постоянная поддержка и развитие внедренных решений для достижения максимальных результатов.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Основные услуги</h2>
            
            <div class="row g-4">
                @foreach($services as $service)
                    <div class="col-md-4">
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
                @endforeach
            </div>
            
            <div class="text-center mt-5">
                <a href="{{ route('services.index') }}" class="btn btn-primary">Все услуги</a>
            </div>
        </div>
    </section>

    <!-- Case Studies Section -->
    @if(count($caseStudies) > 0)
        <section class="case-studies py-5">
            <div class="container">
                <h2 class="text-center mb-5">Наши кейсы</h2>
                
                <div class="row g-4">
                    @foreach($caseStudies as $caseStudy)
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                @if($caseStudy->image)
                                    <img src="{{ asset($caseStudy->image) }}" class="card-img-top" alt="{{ $caseStudy->title }}">
                                @else
                                    <div class="card-img-top bg-secondary" style="height: 200px;"></div>
                                @endif
                                <div class="card-body">
                                    <h3 class="card-title h5">{{ $caseStudy->title }}</h3>
                                    <p class="card-text">{{ Str::limit($caseStudy->description, 150) }}</p>
                                    <a href="{{ route('case-studies.show', $caseStudy) }}" class="btn btn-outline-primary">Подробнее</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="text-center mt-5">
                    <a href="{{ route('case-studies.index') }}" class="btn btn-primary">Все кейсы</a>
                </div>
            </div>
        </section>
    @endif

    <!-- CTA Section -->
    <section class="cta py-5 bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <h2 class="mb-3">Готовы оптимизировать ваш бизнес с помощью ИИ?</h2>
                    <p class="lead mb-0">Оставьте заявку, и мы свяжемся с вами для обсуждения вашего проекта.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <button class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#requestModal">Оставить заявку</button>
                </div>
            </div>
        </div>
    </section>
@endsection 