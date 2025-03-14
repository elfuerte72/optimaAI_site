/**
 * OptimAI - Оптимизированный основной JavaScript файл
 * Высокопроизводительная версия с оптимизацией загрузки и рендеринга
 */

// Импортируем необходимые скрипты
import './bootstrap';
import './starfield'; // Импортируем оптимизированный звездный фон

// Импортируем GSAP и необходимые плагины
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { TextPlugin } from 'gsap/TextPlugin';

// Регистрируем плагины GSAP
gsap.registerPlugin(ScrollTrigger, TextPlugin);

// Делаем GSAP доступным глобально
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
window.TextPlugin = TextPlugin;

// Импортируем GSAP анимации после регистрации плагинов
import './gsap-animations';

// Импортируем Vue и компоненты
import { createApp } from 'vue';
import ChatBot from './components/ChatBot.vue';
import ChatBotIcon from './components/ChatBotIcon.vue';

// Создаем экземпляр Vue приложения
const app = createApp({});

// Регистрируем компоненты
app.component('chat-bot', ChatBot);
app.component('chat-bot-icon', ChatBotIcon);

// Монтируем приложение
app.mount('#app');

// Оптимизация загрузки страницы
document.addEventListener('DOMContentLoaded', function() {
    // Оптимизация изображений - отложенная загрузка
    const lazyImages = document.querySelectorAll('img[loading="lazy"]');
    if ('loading' in HTMLImageElement.prototype) {
        // Браузер поддерживает нативную отложенную загрузку
        lazyImages.forEach(img => {
            if (img.dataset.src) {
                img.src = img.dataset.src;
            }
        });
    } else {
        // Запасной вариант для браузеров без поддержки
        const lazyImageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const lazyImage = entry.target;
                    if (lazyImage.dataset.src) {
                        lazyImage.src = lazyImage.dataset.src;
                    }
                    observer.unobserve(lazyImage);
                }
            });
        });

        lazyImages.forEach(lazyImage => {
            lazyImageObserver.observe(lazyImage);
        });
    }

    // Оптимизация прокрутки
    const scrollLinks = document.querySelectorAll('a[href^="#"]');
    scrollLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                // Используем более производительный метод прокрутки
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});

// Оптимизация производительности при прокрутке
let scrollTimeout;
let lastScrollTop = 0;
const scrollThreshold = 50; // Порог для обработки прокрутки

window.addEventListener('scroll', function() {
    // Проверяем, достаточно ли прокрутили для обработки события
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    if (Math.abs(scrollTop - lastScrollTop) < scrollThreshold) return;
    
    // Обновляем последнюю позицию прокрутки
    lastScrollTop = scrollTop;
    
    // Используем debounce для предотвращения частых вызовов
    clearTimeout(scrollTimeout);
    scrollTimeout = setTimeout(function() {
        // Добавляем класс для элементов, которые должны анимироваться при прокрутке
        const animatedElements = document.querySelectorAll('.animate-on-scroll:not(.animated)');
        animatedElements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            
            if (elementTop < windowHeight * 0.8) {
                element.classList.add('animated');
            }
        });
    }, 100);
}, { passive: true }); // Используем passive: true для улучшения производительности

// Оптимизация загрузки шрифтов
if ('fonts' in document) {
    // Предварительно загружаем критические шрифты
    Promise.all([
        document.fonts.load('1em Space Grotesk'),
        document.fonts.load('1em JetBrains Mono')
    ]).then(() => {
        document.documentElement.classList.add('fonts-loaded');
    });
}

// Оптимизация обработки событий
function throttle(callback, limit) {
    let waiting = false;
    return function() {
        if (!waiting) {
            callback.apply(this, arguments);
            waiting = true;
            setTimeout(() => {
                waiting = false;
            }, limit);
        }
    };
}

// Применяем throttle к обработчикам событий, которые могут вызываться часто
window.addEventListener('resize', throttle(function() {
    // Обработка изменения размера окна
    document.documentElement.style.setProperty('--vh', `${window.innerHeight * 0.01}px`);
}, 100), { passive: true });

// Устанавливаем переменную CSS для корректной высоты на мобильных устройствах
document.documentElement.style.setProperty('--vh', `${window.innerHeight * 0.01}px`);
