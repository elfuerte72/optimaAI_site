<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('meta_description', 'Профессиональные услуги по внедрению искусственного интеллекта в бизнес-процессы')">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    
    <!-- Оптимизация производительности -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#0a0a1a">
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
    
    <!-- Предзагрузка критических ресурсов -->
    <link rel="preload" href="{{ asset('fonts/SpaceGrotesk-Bold.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/JetBrainsMono-Regular.woff2') }}" as="font" type="font/woff2" crossorigin>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css" media="print" onload="this.media='all'">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Critical CSS inline -->
    <style>
        /* Критические стили для первого экрана */
        :root {
            --primary-color: #b935ff;
            --secondary-color: #3a86ff;
            --dark-bg: #0a0a1a;
            --card-bg: #12121f;
            --text-color: #e0e0ff;
            --vh: 1vh;
        }
        body {
            background-color: var(--dark-bg);
            color: var(--text-color);
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            min-height: 100vh;
            min-height: calc(var(--vh, 1vh) * 100);
        }
        .stars-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
            will-change: transform;
        }
        .cyber-btn {
            background: linear-gradient(45deg, #b935ff, #3a86ff);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: 600;
            transition: all 0.3s ease;
            will-change: transform, box-shadow;
            transform: translateZ(0);
        }
        .cyber-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(185, 53, 255, 0.4);
        }
        #app {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            min-height: calc(var(--vh, 1vh) * 100);
        }
        main {
            flex: 1;
        }
    </style>
    
    <!-- Отложенная загрузка некритических стилей -->
    <link rel="stylesheet" href="{{ asset('css/modern-theme.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('css/modern-fonts.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('css/services-icons.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('css/stars-animation.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('css/modern-buttons.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('css/service-animations.css') }}" media="print" onload="this.media='all'">
    
    @yield('styles')
    
    <!-- Предзагрузка скриптов -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" as="script">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" as="script">
    
    <!-- Scripts в head с defer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
    
    @stack('head-scripts')
    
    <!-- Оптимизация загрузки страницы -->
    <script>
        // Устанавливаем переменную CSS для корректной высоты на мобильных устройствах
        document.documentElement.style.setProperty('--vh', `${window.innerHeight * 0.01}px`);
        
        // Регистрируем обработчик события resize с throttle
        let resizeTimeout;
        window.addEventListener('resize', function() {
            if (!resizeTimeout) {
                resizeTimeout = setTimeout(function() {
                    resizeTimeout = null;
                    document.documentElement.style.setProperty('--vh', `${window.innerHeight * 0.01}px`);
                }, 100);
            }
        }, { passive: true });
    </script>
</head>
<body class="cyber-theme">
    <div id="app">
        @include('partials.header')
        
        <main>
            @yield('content')
        </main>
        
        @include('partials.footer')
        @include('partials.request-modal')
        
        <!-- Компонент чат-бота -->
        <chat-bot></chat-bot>
    </div>
    
    <!-- Scripts в конце body с defer -->
    <script src="{{ asset('js/service-animations.js') }}" defer></script>
    
    @yield('scripts')
    @stack('footer-scripts')
    
    <!-- Скрипт для страницы услуг -->
    @if(request()->is('services'))
        <script type="module" src="{{ Vite::asset('resources/js/services/index.js') }}"></script>
    @endif
    
    <!-- Отложенная загрузка некритических скриптов -->
    <script>
        // Функция для отложенной загрузки скриптов
        function loadScript(src, callback) {
            const script = document.createElement('script');
            script.src = src;
            script.onload = callback;
            document.body.appendChild(script);
        }
        
        // Загружаем скрипты после загрузки страницы
        window.addEventListener('load', function() {
            // Используем requestIdleCallback для загрузки в свободное время
            if ('requestIdleCallback' in window) {
                requestIdleCallback(function() {
                    // Аналитика и другие некритические скрипты могут быть загружены здесь
                });
            } else {
                setTimeout(function() {
                    // Запасной вариант для браузеров без поддержки requestIdleCallback
                }, 2000);
            }
        });
    </script>
    
    <!-- Стили и скрипты для чат-бота -->
    <link rel="stylesheet" href="{{ asset('css/chatbot-animations.css') }}" media="print" onload="this.media='all'">
    <script src="{{ asset('js/chatbot-animations.js') }}" defer></script>
</body>
</html> 