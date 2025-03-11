<header>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <span class="brand-text">
                    <span class="brand-optima">Optima</span><span class="brand-ai">AI</span>
                    <span class="brand-dot"></span>
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Главная</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('services.*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Услуги
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="{{ route('services.consulting-and-training') }}">Консультации и обучение</a></li>
                            <li><a class="dropdown-item" href="{{ route('services.language-models-setup') }}">Настройка языковых моделей</a></li>
                            <li><a class="dropdown-item" href="{{ route('services.ai-business-integration') }}">Интеграция ИИ в бизнес</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact.*') ? 'active' : '' }}" href="{{ route('contact.index') }}">Контакты</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<style>
    .navbar {
        background-color: rgba(15, 23, 42, 0.85);
        backdrop-filter: blur(15px);
        padding: 0.75rem 0;
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(var(--primary-rgb), 0.1);
    }
    
    .navbar.scrolled {
        padding: 0.5rem 0;
        background-color: rgba(15, 23, 42, 0.95);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2), 0 0 15px rgba(var(--primary-rgb), 0.1);
    }
    
    .navbar-brand {
        font-weight: 700;
        position: relative;
        display: flex;
        align-items: center;
    }
    
    .brand-text {
        font-family: 'Outfit', sans-serif;
        font-size: 1.8rem;
        font-weight: 800;
        letter-spacing: -0.5px;
        position: relative;
        display: flex;
        align-items: center;
    }
    
    .brand-optima {
        background: linear-gradient(90deg, #ffffff, #e0e0e0);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
    }
    
    .brand-ai {
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        text-shadow: 0 0 15px rgba(var(--primary-rgb), 0.5);
        position: relative;
    }
    
    .brand-dot {
        position: absolute;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        bottom: 2px;
        right: -10px;
        box-shadow: 0 0 10px rgba(var(--primary-rgb), 0.8);
        animation: pulse-dot 2s infinite;
    }
    
    @keyframes pulse-dot {
        0% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.5);
            opacity: 0.7;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
    
    .navbar-brand:hover .brand-optima {
        text-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
    }
    
    .navbar-brand:hover .brand-ai {
        text-shadow: 0 0 20px rgba(var(--primary-rgb), 0.8);
    }
    
    .navbar-nav .nav-link {
        position: relative;
        padding: 0.5rem 1rem;
        font-weight: 500;
        transition: color 0.3s ease;
    }
    
    .navbar-nav .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 1rem;
        right: 1rem;
        height: 2px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        transform: scaleX(0);
        transition: transform 0.3s ease;
        transform-origin: right;
        box-shadow: 0 0 10px rgba(var(--primary-rgb), 0.7);
    }
    
    .navbar-nav .nav-link:hover::after,
    .navbar-nav .nav-link.active::after {
        transform: scaleX(1);
        transform-origin: left;
    }
    
    .navbar-nav .nav-link:hover {
        color: var(--primary-color);
    }
    
    .navbar-nav .nav-link.active {
        color: var(--primary-color);
        text-shadow: 0 0 5px rgba(var(--primary-rgb), 0.5);
    }
    
    .dropdown-menu {
        border: 1px solid rgba(var(--primary-rgb), 0.1);
        background-color: rgba(15, 23, 42, 0.95);
        backdrop-filter: blur(15px);
        border-radius: var(--border-radius-sm);
        margin-top: 0.5rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2), 0 0 15px rgba(var(--primary-rgb), 0.1);
        overflow: hidden;
    }
    
    .dropdown-item {
        color: var(--text-primary);
        padding: 0.75rem 1.5rem;
        transition: all 0.2s ease;
        position: relative;
    }
    
    .dropdown-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 3px;
        height: 100%;
        background: linear-gradient(to bottom, var(--primary-color), var(--accent-color));
        transform: scaleY(0);
        transition: transform 0.2s ease;
    }
    
    .dropdown-item:hover::before, 
    .dropdown-item:focus::before {
        transform: scaleY(1);
    }
    
    .dropdown-item:hover, 
    .dropdown-item:focus {
        background-color: rgba(var(--primary-rgb), 0.1);
        color: var(--primary-color);
        padding-left: 1.8rem;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.querySelector('.navbar');
        
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Trigger scroll event on page load
        window.dispatchEvent(new Event('scroll'));
    });
</script> 