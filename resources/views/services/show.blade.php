@extends('layouts.app')

@section('title', $service->title . ' — OptimaAI')
@section('meta_description', Str::limit(strip_tags($service->description), 160))

@section('content')
    <!-- Hero Section -->
    <section class="hero bg-dark text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">{{ $service->title }}</h1>
                    <p class="lead mb-0">{{ Str::limit($service->description, 150) }}</p>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    @if($service->image)
                        <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" class="img-fluid">
                    @else
                        <div class="bg-secondary" style="height: 300px;"></div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Service Description Section -->
    <section class="service-description py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h2 class="mb-4">Описание услуги</h2>
                            <div class="service-content">
                                {!! $service->description !!}
                            </div>
                        </div>
                    </div>
                    
                    @if($service->features)
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <h2 class="mb-4">Возможности</h2>
                                <div class="service-features">
                                    {!! $service->features !!}
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    @if($service->results)
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <h2 class="mb-4">Результаты</h2>
                                <div class="service-results">
                                    {!! $service->results !!}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h3 class="card-title h5 mb-4">Стоимость</h3>
                            @if($service->price_info)
                                <p>{{ $service->price_info }}</p>
                            @else
                                <p>Стоимость услуги рассчитывается индивидуально в зависимости от сложности проекта и требований клиента.</p>
                            @endif
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#requestModal">Оставить заявку</button>
                        </div>
                    </div>
                    
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h3 class="card-title h5 mb-4">Преимущества</h3>
                            <ul class="list-unstyled">
                                <li class="d-flex align-items-center mb-3">
                                    <i class="bi bi-check-circle-fill text-primary me-3"></i>
                                    <span>Индивидуальный подход к каждому клиенту</span>
                                </li>
                                <li class="d-flex align-items-center mb-3">
                                    <i class="bi bi-check-circle-fill text-primary me-3"></i>
                                    <span>Опытная команда специалистов</span>
                                </li>
                                <li class="d-flex align-items-center mb-3">
                                    <i class="bi bi-check-circle-fill text-primary me-3"></i>
                                    <span>Современные технологии и методики</span>
                                </li>
                                <li class="d-flex align-items-center mb-3">
                                    <i class="bi bi-check-circle-fill text-primary me-3"></i>
                                    <span>Постоянная поддержка и сопровождение</span>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-primary me-3"></i>
                                    <span>Гарантия качества результата</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title h5 mb-4">Остались вопросы?</h3>
                            <p>Свяжитесь с нами для получения дополнительной информации или консультации по услуге.</p>
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-envelope fs-5 text-primary me-3"></i>
                                <a href="mailto:info@optimaai.ru" class="text-decoration-none">info@optimaai.ru</a>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-telephone fs-5 text-primary me-3"></i>
                                <a href="tel:+79123456789" class="text-decoration-none">+7 (912) 345-67-89</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Other Services Section -->
    @if(count($otherServices) > 0)
        <section class="other-services py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5">Другие услуги</h2>
                
                <div class="row g-4">
                    @foreach($otherServices as $otherService)
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                @if($otherService->image)
                                    <img src="{{ asset($otherService->image) }}" class="card-img-top" alt="{{ $otherService->title }}">
                                @else
                                    <div class="card-img-top bg-secondary" style="height: 200px;"></div>
                                @endif
                                <div class="card-body">
                                    <h3 class="card-title h5">{{ $otherService->title }}</h3>
                                    <p class="card-text">{{ Str::limit($otherService->description, 100) }}</p>
                                    <a href="{{ route('services.show', $otherService) }}" class="btn btn-outline-primary">Подробнее</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- CTA Section -->
    <section class="cta py-5 bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <h2 class="mb-3">Готовы начать проект?</h2>
                    <p class="lead mb-0">Оставьте заявку, и мы свяжемся с вами для обсуждения деталей.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <button class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#requestModal">Оставить заявку</button>
                </div>
            </div>
        </div>
    </section>
@endsection 