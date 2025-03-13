/**
 * OptimaAI - Скрипт анимаций для страницы услуг
 * Современные интерактивные анимации 2025
 */

document.addEventListener('DOMContentLoaded', function() {
    // Логируем успешную загрузку скрипта
    console.log('✅ Скрипт анимаций для услуг загружен');
    
    // Проверяем, есть ли React-контейнеры на странице
    const reactContainers = [
        document.getElementById('react-service-features'),
        document.getElementById('react-process-steps')
    ];
    
    // Логируем наличие контейнеров
    reactContainers.forEach((container, index) => {
        if (container) {
            console.log(`✅ React контейнер #${index + 1} найден`);
        }
    });
    
    // Добавляем анимацию для обычных элементов (не React)
    const animateElements = document.querySelectorAll('.animate-on-scroll');
    
    if (animateElements.length > 0) {
        console.log(`✅ Найдено ${animateElements.length} элементов для анимации при скролле`);
    }
    
    // Функция для проверки видимости элемента
    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.bottom >= 0
        );
    }
    
    // Функция для анимации элементов при скролле
    function animateOnScroll() {
        animateElements.forEach(element => {
            if (isElementInViewport(element) && !element.classList.contains('animated')) {
                const animation = element.dataset.animation || 'fade-up';
                const delay = element.dataset.delay || 0;
                
                setTimeout(() => {
                    element.classList.add('animated', animation);
                }, delay * 1000);
            }
        });
    }
    
    // Запускаем анимацию при загрузке и скролле
    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll();
    
    // Применяем анимацию пульсации к кнопкам "Подробнее"
    const detailButtons = document.querySelectorAll('.btn-modern');
    detailButtons.forEach(button => {
        // Добавляем классы с задержкой для эффекта каскада
        setTimeout(() => {
            button.classList.add('animate-pulse');
            
            // Удаляем анимацию через 3 секунды
            setTimeout(() => {
                button.classList.remove('animate-pulse');
            }, 3000);
        }, Math.random() * 1000);
    });
    
    // Создаем трехмерный эффект при наведении на карточки услуг
    const serviceCards = document.querySelectorAll('.service-card');
    
    serviceCards.forEach(card => {
        card.addEventListener('mousemove', function(e) {
            const cardRect = card.getBoundingClientRect();
            const cardCenterX = cardRect.left + cardRect.width / 2;
            const cardCenterY = cardRect.top + cardRect.height / 2;
            
            // Вычисляем положение курсора относительно центра карточки
            const mouseX = e.clientX - cardCenterX;
            const mouseY = e.clientY - cardCenterY;
            
            // Вычисляем угол наклона (максимум 10 градусов)
            const rotateX = mouseY / (cardRect.height / 2) * -5;
            const rotateY = mouseX / (cardRect.width / 2) * 5;
            
            // Применяем 3D-трансформацию
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateZ(10px)`;
            
            // Добавляем эффект свечения с той стороны, где находится курсор
            const glowX = (mouseX / cardRect.width) * 100 + 50;
            const glowY = (mouseY / cardRect.height) * 100 + 50;
            card.style.background = `radial-gradient(circle at ${glowX}% ${glowY}%, rgba(123, 150, 255, 0.15) 0%, rgba(30, 41, 59, 0.8) 50%)`;
        });
        
        // Возвращаем исходное состояние при уходе курсора
        card.addEventListener('mouseleave', function() {
            card.style.transform = '';
            card.style.background = '';
            
            // Плавная анимация возврата в исходное состояние
            card.style.transition = 'transform 0.5s ease, background 0.5s ease';
            setTimeout(() => {
                card.style.transition = '';
            }, 500);
        });
    });
    
    // Добавляем эффект мерцания для иконок услуг
    const iconWrappers = document.querySelectorAll('.service-icon-wrapper');
    iconWrappers.forEach(wrapper => {
        // Создаем эффект мерцающих частиц внутри иконок
        const numParticles = 5;
        for (let i = 0; i < numParticles; i++) {
            const particle = document.createElement('span');
            particle.className = 'icon-particle';
            particle.style.width = '3px';
            particle.style.height = '3px';
            particle.style.background = 'rgba(123, 150, 255, 0.7)';
            particle.style.borderRadius = '50%';
            particle.style.position = 'absolute';
            particle.style.top = `${Math.random() * 100}%`;
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.opacity = '0';
            particle.style.animation = `particleGlow ${2 + Math.random() * 2}s infinite ${Math.random() * 2}s`;
            wrapper.appendChild(particle);
        }
    });
});

// Анимация свечения частиц
const style = document.createElement('style');
style.textContent = `
@keyframes particleGlow {
    0% { opacity: 0; transform: translateY(0) scale(1); }
    50% { opacity: 0.8; transform: translateY(-10px) scale(1.5); }
    100% { opacity: 0; transform: translateY(-20px) scale(1); }
}

@keyframes fade-up {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.animated {
    animation-duration: 0.8s;
    animation-fill-mode: both;
}

.fade-up {
    animation-name: fade-up;
}
`;
document.head.appendChild(style); 