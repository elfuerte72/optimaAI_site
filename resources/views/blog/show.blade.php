@extends('layouts.app')

@section('title', $post->meta_title ?? $post->title . ' — OptimaAI')
@section('meta_description', $post->meta_description ?? Str::limit(strip_tags($post->content), 160))

@section('content')
    <!-- Hero Section -->
    <section class="hero bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 fw-bold mb-4">{{ $post->title }}</h1>
                    <div class="d-flex justify-content-center align-items-center">
                        <span class="me-3"><i class="bi bi-calendar3 me-2"></i>{{ $post->published_at->format('d.m.Y') }}</span>
                        <span><i class="bi bi-person me-2"></i>{{ $post->user->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Post Content Section -->
    <section class="post-content py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 p-md-5">
                            @if($post->image)
                                <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="img-fluid rounded mb-4">
                            @endif
                            
                            <div class="post-content">
                                {!! Str::markdown($post->content) !!}
                            </div>
                            
                            <hr class="my-5">
                            
                            <div class="post-footer d-flex justify-content-between align-items-center">
                                <div class="post-tags">
                                    <span class="text-muted">Теги:</span>
                                    <a href="#" class="badge bg-light text-dark text-decoration-none ms-2">Нейросети</a>
                                    <a href="#" class="badge bg-light text-dark text-decoration-none ms-2">ИИ</a>
                                    <a href="#" class="badge bg-light text-dark text-decoration-none ms-2">Бизнес</a>
                                </div>
                                
                                <div class="post-share">
                                    <span class="text-muted me-2">Поделиться:</span>
                                    <a href="#" class="text-decoration-none me-2"><i class="bi bi-telegram"></i></a>
                                    <a href="#" class="text-decoration-none me-2"><i class="bi bi-vk"></i></a>
                                    <a href="#" class="text-decoration-none"><i class="bi bi-facebook"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Author Section -->
    <section class="author py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="rounded-circle bg-secondary" style="width: 80px; height: 80px;"></div>
                                </div>
                                <div class="flex-grow-1 ms-4">
                                    <h3 class="h5 mb-2">{{ $post->user->name }}</h3>
                                    <p class="text-muted mb-3">Эксперт в области нейросетевых технологий</p>
                                    <p class="mb-0">Специалист с многолетним опытом внедрения ИИ-решений в бизнес-процессы различных компаний. Автор многочисленных статей о применении искусственного интеллекта.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Posts Section -->
    @if(count($relatedPosts) > 0)
        <section class="related-posts py-5">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-lg-8 mx-auto">
                        <h2 class="text-center">Похожие статьи</h2>
                    </div>
                </div>
                
                <div class="row g-4">
                    @foreach($relatedPosts as $relatedPost)
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                @if($relatedPost->image)
                                    <img src="{{ asset($relatedPost->image) }}" class="card-img-top" alt="{{ $relatedPost->title }}">
                                @else
                                    <div class="card-img-top bg-secondary" style="height: 200px;"></div>
                                @endif
                                <div class="card-body">
                                    <div class="mb-3 d-flex justify-content-between align-items-center">
                                        <span class="text-muted">{{ $relatedPost->published_at->format('d.m.Y') }}</span>
                                    </div>
                                    <h3 class="card-title h5">{{ $relatedPost->title }}</h3>
                                    <p class="card-text">{{ $relatedPost->excerpt ?? Str::limit(strip_tags($relatedPost->content), 100) }}</p>
                                    <a href="{{ route('blog.show', $relatedPost) }}" class="btn btn-outline-primary">Читать далее</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Subscribe Section -->
    <section class="subscribe py-5 bg-light">
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