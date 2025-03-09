@extends('layouts.app')

@section('title', 'Кейсы OptimaAI — успешные внедрения нейросетевых решений')
@section('meta_description', 'Ознакомьтесь с нашими успешными кейсами внедрения нейросетевых технологий в различных отраслях бизнеса.')

@section('content')
    <!-- Hero Section -->
    <section class="hero bg-dark text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Наши кейсы</h1>
                    <p class="lead mb-0">Успешные внедрения нейросетевых решений в различных отраслях</p>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="{{ asset('images/case-studies-hero.svg') }}" alt="Кейсы OptimaAI" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Case Studies Section -->
    <section class="case-studies py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="mb-4">Успешные проекты</h2>
                    <p class="lead">Ознакомьтесь с нашими успешными кейсами внедрения нейросетевых технологий в различных отраслях бизнеса.</p>
                </div>
            </div>
            
            <div class="row g-4">
                @forelse($caseStudies as $caseStudy)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            @if($caseStudy->image)
                                <img src="{{ asset($caseStudy->image) }}" class="card-img-top" alt="{{ $caseStudy->title }}">
                            @else
                                <div class="card-img-top bg-secondary" style="height: 200px;"></div>
                            @endif
                            <div class="card-body">
                                <div class="mb-3">
                                    <span class="badge bg-primary">{{ $caseStudy->client_industry }}</span>
                                </div>
                                <h3 class="card-title h5">{{ $caseStudy->title }}</h3>
                                <p class="card-text">{{ Str::limit($caseStudy->description, 150) }}</p>
                                <a href="{{ route('case-studies.show', $caseStudy) }}" class="btn btn-outline-primary">Подробнее</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            В настоящее время информация о кейсах недоступна. Пожалуйста, загляните позже.
                        </div>
                    </div>
                @endforelse
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $caseStudies->links() }}
            </div>
        </div>
    </section>

    <!-- Industries Section -->
    <section class="industries py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="mb-4">Отрасли, с которыми мы работаем</h2>
                    <p class="lead">Мы имеем опыт внедрения нейросетевых решений в различных отраслях бизнеса.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-shop fs-1 text-primary"></i>
                            </div>
                            <h3 class="card-title h5">Розничная торговля</h3>
                            <p class="card-text">Автоматизация обслуживания клиентов, персонализация предложений, оптимизация запасов.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-building fs-1 text-primary"></i>
                            </div>
                            <h3 class="card-title h5">Производство</h3>
                            <p class="card-text">Предиктивное обслуживание оборудования, оптимизация производственных процессов, контроль качества.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-bank fs-1 text-primary"></i>
                            </div>
                            <h3 class="card-title h5">Финансы</h3>
                            <p class="card-text">Анализ рисков, выявление мошенничества, автоматизация обработки документов.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-book fs-1 text-primary"></i>
                            </div>
                            <h3 class="card-title h5">Образование</h3>
                            <p class="card-text">Персонализированное обучение, автоматическая проверка заданий, виртуальные ассистенты.</p>
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
                    <h2 class="mb-3">Готовы создать свой успешный кейс?</h2>
                    <p class="lead mb-0">Оставьте заявку, и мы свяжемся с вами для обсуждения вашего проекта.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <button class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#requestModal">Оставить заявку</button>
                </div>
            </div>
        </div>
    </section>
@endsection 