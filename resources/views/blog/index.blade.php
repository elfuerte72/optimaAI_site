@extends('layouts.app')

@section('title', 'Блог OptimaAI — статьи о нейросетевых технологиях')
@section('meta_description', 'Блог компании OptimaAI с актуальными статьями о нейросетевых технологиях, их применении в бизнесе и последних тенденциях в области искусственного интеллекта.')

@section('content')
    <!-- Hero Section -->
    <section class="hero bg-dark text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Блог</h1>
                    <p class="lead mb-0">Актуальные статьи о нейросетевых технологиях и их применении в бизнесе</p>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="{{ asset('images/blog-hero.svg') }}" alt="Блог OptimaAI" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Posts Section -->
    <section class="blog-posts py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="mb-4">Последние статьи</h2>
                    <p class="lead">Читайте наши статьи о нейросетевых технологиях, их применении в бизнесе и последних тенденциях в области искусственного интеллекта.</p>
                </div>
            </div>
            
            <div class="row g-4">
                @forelse($posts as $post)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            @if($post->image)
                                <img src="{{ asset($post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                            @else
                                <div class="card-img-top bg-secondary" style="height: 200px;"></div>
                            @endif
                            <div class="card-body">
                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                    <span class="text-muted">{{ $post->published_at->format('d.m.Y') }}</span>
                                </div>
                                <h3 class="card-title h5">{{ $post->title }}</h3>
                                <p class="card-text">{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 150) }}</p>
                                <a href="{{ route('blog.show', $post) }}" class="btn btn-outline-primary">Читать далее</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            В настоящее время статьи не опубликованы. Пожалуйста, загляните позже.
                        </div>
                    </div>
                @endforelse
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $posts->links() }}
            </div>
        </div>
    </section>

    <!-- Topics Section -->
    <section class="topics py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="mb-4">Основные темы</h2>
                    <p class="lead">Мы пишем о различных аспектах искусственного интеллекта и его применении в бизнесе.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-cpu fs-1 text-primary"></i>
                            </div>
                            <h3 class="card-title h5">Нейросетевые технологии</h3>
                            <p class="card-text">Обзоры последних достижений в области нейронных сетей и их практического применения.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-graph-up fs-1 text-primary"></i>
                            </div>
                            <h3 class="card-title h5">Бизнес-применение</h3>
                            <p class="card-text">Практические примеры использования ИИ для оптимизации бизнес-процессов и повышения эффективности.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-shield-check fs-1 text-primary"></i>
                            </div>
                            <h3 class="card-title h5">Этика и безопасность</h3>
                            <p class="card-text">Обсуждение этических аспектов использования ИИ и вопросов безопасности данных.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-lightbulb fs-1 text-primary"></i>
                            </div>
                            <h3 class="card-title h5">Тренды и инновации</h3>
                            <p class="card-text">Анализ последних тенденций и инноваций в области искусственного интеллекта.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Subscribe Section -->
    <section class="subscribe py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-4">
                                <h2 class="mb-3">Подпишитесь на нашу рассылку</h2>
                                <p class="lead">Получайте новые статьи и обновления прямо на вашу электронную почту.</p>
                            </div>
                            
                            <form class="row g-3">
                                <div class="col-md-8">
                                    <input type="email" class="form-control form-control-lg" placeholder="Ваш email" required>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary btn-lg w-100">Подписаться</button>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="subscribePrivacy" required>
                                        <label class="form-check-label" for="subscribePrivacy">
                                            Я согласен с <a href="#" target="_blank">политикой конфиденциальности</a>
                                        </label>
                                    </div>
                                </div>
                            </form>
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
                    <h2 class="mb-3">Готовы внедрить ИИ в ваш бизнес?</h2>
                    <p class="lead mb-0">Оставьте заявку, и мы свяжемся с вами для обсуждения вашего проекта.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <button class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#requestModal">Оставить заявку</button>
                </div>
            </div>
        </div>
    </section>
@endsection 