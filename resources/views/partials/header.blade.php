<header class="header py-3 shadow-sm">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="/images/logo.png?v={{ time() }}" alt="OptimaAI" width="300" height="80" style="object-fit: contain; max-width: 100%;">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}" href="{{ route('services.index') }}">Услуги</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('case-studies.*') ? 'active' : '' }}" href="{{ route('case-studies.index') }}">Кейсы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact.*') ? 'active' : '' }}" href="{{ route('contact.index') }}">Контакты</a>
                    </li>
                </ul>
                
                <div class="ms-lg-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#requestModal">
                        Оставить заявку
                    </button>
                </div>
            </div>
        </nav>
    </div>
</header> 