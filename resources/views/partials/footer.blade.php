<footer class="footer py-5 bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <a href="{{ route('home') }}" class="d-inline-block mb-4 text-white text-decoration-none">
                    <h4>OptimaAI</h4>
                </a>
                <p class="mb-4">OptimaAI — экспертный партнёр, предоставляющий индивидуальные нейросетевые решения для бизнеса, образовательных учреждений и госорганизаций.</p>
                <div class="social-links">
                    <a href="#" class="me-3 text-white"><i class="bi bi-telegram"></i></a>
                    <a href="#" class="me-3 text-white"><i class="bi bi-whatsapp"></i></a>
                    <a href="#" class="me-3 text-white"><i class="bi bi-vk"></i></a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                <h5 class="mb-4">Компания</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('home') }}" class="text-white text-decoration-none">Главная</a></li>
                    <li class="mb-2"><a href="{{ route('about') }}" class="text-white text-decoration-none">О компании</a></li>
                    <li class="mb-2"><a href="{{ route('services.index') }}" class="text-white text-decoration-none">Услуги</a></li>
                    <li class="mb-2"><a href="{{ route('case-studies.index') }}" class="text-white text-decoration-none">Кейсы</a></li>
                </ul>
            </div>
            
            <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                <h5 class="mb-4">Информация</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('blog.index') }}" class="text-white text-decoration-none">Блог</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">Политика конфиденциальности</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">Условия использования</a></li>
                </ul>
            </div>
            
            <div class="col-lg-4 col-md-4">
                <h5 class="mb-4">Контакты</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="bi bi-geo-alt me-2"></i> Тюмень, Россия</li>
                    <li class="mb-2"><i class="bi bi-envelope me-2"></i> <a href="mailto:info@optimaai.ru" class="text-white text-decoration-none">info@optimaai.ru</a></li>
                    <li class="mb-2"><i class="bi bi-telephone me-2"></i> <a href="tel:+79123456789" class="text-white text-decoration-none">+7 (912) 345-67-89</a></li>
                </ul>
            </div>
        </div>
        
        <hr class="my-4">
        
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0">&copy; {{ date('Y') }} OptimaAI. Все права защищены.</p>
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <a href="#" class="text-white text-decoration-none me-3">Политика конфиденциальности</a>
                <a href="#" class="text-white text-decoration-none">Условия использования</a>
            </div>
        </div>
    </div>
</footer> 