/**
 * OptimaAI - Скрипт для генерации анимированных звезд на фоне
 */

document.addEventListener('DOMContentLoaded', function() {
    // Инициализация звезд на всех страницах, где есть контейнер
    initStars();
});

/**
 * Инициализация звезд
 */
function initStars() {
    const starsContainers = document.querySelectorAll('.stars-container');
    
    if (starsContainers.length === 0) return;
    
    starsContainers.forEach(container => {
        // Очищаем контейнер, если в нем уже есть звезды
        container.innerHTML = '';
        
        // Определяем количество звезд в зависимости от размера экрана
        const isMobile = window.innerWidth < 768;
        const starsCount = isMobile ? 50 : 150;
        
        // Создаем звезды
        for (let i = 0; i < starsCount; i++) {
            createStar(container);
        }
    });
}

/**
 * Создание одной звезды
 * @param {HTMLElement} container - Контейнер для звезд
 */
function createStar(container) {
    // Создаем элемент звезды
    const star = document.createElement('div');
    star.className = 'star';
    
    // Случайное положение
    const x = Math.random() * 100;
    const y = Math.random() * 100;
    
    // Случайная длительность анимации
    const duration = 3 + Math.random() * 4;
    
    // Случайная задержка анимации
    const delay = Math.random() * 5;
    
    // Случайный размер (маленькая, средняя или большая)
    const sizeRandom = Math.random();
    if (sizeRandom > 0.85) {
        star.classList.add('large');
    } else if (sizeRandom > 0.6) {
        star.classList.add('medium');
    }
    
    // Устанавливаем свойства
    star.style.left = `${x}%`;
    star.style.top = `${y}%`;
    star.style.setProperty('--duration', `${duration}s`);
    star.style.animationDelay = `${delay}s`;
    
    // Добавляем звезду в контейнер
    container.appendChild(star);
}

/**
 * Пересоздание звезд при изменении размера окна
 */
window.addEventListener('resize', function() {
    // Используем debounce для оптимизации
    clearTimeout(window.resizeTimer);
    window.resizeTimer = setTimeout(function() {
        initStars();
    }, 250);
}); 