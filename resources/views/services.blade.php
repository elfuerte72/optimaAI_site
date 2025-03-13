@extends('layouts.app')

@section('title', 'Услуги OptimAI - Профессиональные услуги по настройке и интеграции нейросетей')

@section('meta')
    <meta name="description" content="Профессиональные услуги по настройке, адаптации и интеграции нейросетевых моделей для бизнеса. Консультации, обучение и техническая поддержка.">
    <meta name="keywords" content="услуги AI, настройка нейросетей, интеграция искусственного интеллекта, консультации по нейросетям">
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/gsap-animations.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stars-animation.css') }}">
@endsection

@push('head-scripts')
    <!-- Загружаем скрипт для звезд в head, чтобы он был доступен раньше -->
    <script src="{{ asset('js/stars-animation.js') }}"></script>
@endpush

@section('content')
    <!-- Контейнер для звездного фона -->
    <div class="stars-container" id="stars-container"></div>
    
    <!-- Vue приложение для страницы услуг -->
    <div id="services-page"></div>
@endsection

@section('scripts')
    @vite(['resources/js/services/index.js'])
    <!-- Инициализация звезд после загрузки страницы -->
    <script src="{{ asset('js/stars-init.js') }}"></script>
@endsection 