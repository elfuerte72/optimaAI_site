<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'OptimaAI — нейросетевые решения для вашего бизнеса')</title>
    <meta name="description" content="@yield('meta_description', 'OptimaAI — экспертный партнёр, предоставляющий индивидуальные нейросетевые решения для бизнеса, образовательных учреждений и госорганизаций.')">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ time() }}">
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    @stack('styles')
</head>
<body class="min-vh-100 d-flex flex-column">
    <!-- Header -->
    @include('partials.header')
    
    <!-- Main Content -->
    <main class="flex-grow-1">
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('partials.footer')
    
    <!-- Модальное окно для заявки -->
    @include('partials.request-modal')
    
    <!-- Чат-бот (ИИ-помощник) -->
    @include('partials.chatbot')
    
    @stack('scripts')
</body>
</html> 