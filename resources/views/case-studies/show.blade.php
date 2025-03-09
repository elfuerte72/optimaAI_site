@extends('layouts.app')

@section('title', $caseStudy->title . ' — OptimaAI')
@section('meta_description', Str::limit(strip_tags($caseStudy->description), 160))

@section('content')
    <!-- Hero Section -->
    <section class="hero bg-dark text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">{{ $caseStudy->title }}</h1>
                    <p class="lead mb-0">{{ Str::limit($caseStudy->description, 150) }}</p>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    @if($caseStudy->image)
                        <img src="{{ asset($caseStudy->image) }}" alt="{{ $caseStudy->title }}" class="img-fluid">
                    @else
                        <div class="bg-secondary" style="height: 300px;"></div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Case Study Content Section -->
    <section class="case-study-content py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h2 class="mb-4">О проекте</h2>
                            <div class="case-study-description">
                                <p>{{ $caseStudy->description }}</p>
                            </div>
                        </div>
                    </div>
                    
                    @if($caseStudy->challenge)
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <h2 class="mb-4">Задача</h2>
                                <div class="case-study-challenge">
                                    <p>{{ $caseStudy->challenge }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    @if($caseStudy->solution)
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <h2 class="mb-4">Решение</h2>
                                <div class="case-study-solution">
                                    <p>{{ $caseStudy->solution }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    @if($caseStudy->results)
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <h2 class="mb-4">Результаты</h2>
                                <div class="case-study-results">
                                    <p>{{ $caseStudy->results }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h3 class="card-title h5 mb-4">Информация о клиенте</h3>
                            @if($caseStudy->client_name)
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-building fs-5 text-primary me-3"></i>
                                    <span>{{ $caseStudy->client_name }}</span>
                                </div>
                            @endif
                            
                            @if($caseStudy->client_industry)
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-briefcase fs-5 text-primary me-3"></i>
                                    <span>{{ $caseStudy->client_industry }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h3 class="card-title h5 mb-4">Ключевые технологии</h3>
                            <ul class="list-unstyled">
                                <li class="d-flex align-items-center mb-3">
                                    <i class="bi bi-check-circle-fill text-primary me-3"></i>
                                    <span>Нейронные сети</span>
                                </li>
                                <li class="d-flex align-items-center mb-3">
                                    <i class="bi bi-check-circle-fill text-primary me-3"></i>
                                    <span>Машинное обучение</span>
                                </li>
                                <li class="d-flex align-items-center mb-3">
                                    <i class="bi bi-check-circle-fill text-primary me-3"></i>
                                    <span>Обработка естественного языка</span>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-primary me-3"></i>
                                    <span>Интеграция с существующими системами</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title h5 mb-4">Заинтересовал проект?</h3>
                            <p>Свяжитесь с нами для получения дополнительной информации или консультации по вашему проекту.</p>
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#requestModal">Оставить заявку</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Case Studies Section -->
    @if(count($relatedCaseStudies) > 0)
        <section class="related-case-studies py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5">Другие кейсы</h2>
                
                <div class="row g-4">
                    @foreach($relatedCaseStudies as $relatedCaseStudy)
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                @if($relatedCaseStudy->image)
                                    <img src="{{ asset($relatedCaseStudy->image) }}" class="card-img-top" alt="{{ $relatedCaseStudy->title }}">
                                @else
                                    <div class="card-img-top bg-secondary" style="height: 200px;"></div>
                                @endif
                                <div class="card-body">
                                    <div class="mb-3">
                                        <span class="badge bg-primary">{{ $relatedCaseStudy->client_industry }}</span>
                                    </div>
                                    <h3 class="card-title h5">{{ $relatedCaseStudy->title }}</h3>
                                    <p class="card-text">{{ Str::limit($relatedCaseStudy->description, 100) }}</p>
                                    <a href="{{ route('case-studies.show', $relatedCaseStudy) }}" class="btn btn-outline-primary">Подробнее</a>
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