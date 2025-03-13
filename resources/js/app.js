/**
 * Main Application JavaScript - OptimAI 2030 Edition
 * Футуристические анимации и эффекты для сайта
 */

import './bootstrap';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { ScrollToPlugin } from 'gsap/ScrollToPlugin';
import { TextPlugin } from 'gsap/TextPlugin';
import { MotionPathPlugin } from 'gsap/MotionPathPlugin';
import StarField from './starfield';

// Регистрируем плагины GSAP
gsap.registerPlugin(ScrollTrigger, ScrollToPlugin, TextPlugin, MotionPathPlugin);

// Глобальные настройки анимаций GSAP
gsap.config({
    nullTargetWarn: false
});

// Инициализация основных анимаций
document.addEventListener('DOMContentLoaded', () => {
    // Инициализируем звездное небо на всех страницах
    initStarField();
    
    // Анимации для главной страницы
    if (document.querySelector('.hero-section')) {
        animateHeroSection();
    }
    
    // Анимации для секции преимуществ
    if (document.querySelector('.advantages-section')) {
        animateAdvantagesSection();
    }
    
    // Анимации для секции процесса
    if (document.querySelector('.process-section')) {
        animateProcessSection();
    }
    
    // Анимации для секции услуг
    if (document.querySelector('.services-section')) {
        animateServicesSection();
    }
    
    // Анимации для секции кейсов
    if (document.querySelector('.cases-section')) {
        animateCasesSection();
    }
    
    // Анимации для секции отзывов
    if (document.querySelector('.testimonials-section')) {
        animateTestimonialsSection();
    }
    
    // Анимации для секции CTA
    if (document.querySelector('.cta-section')) {
        animateCtaSection();
    }
    
    // Инициализация общих анимаций
    initCommonAnimations();
    
    // Инициализация анимаций при скролле
    initScrollAnimations();
    
    // Инициализация интерактивных элементов
    initInteractiveElements();
    
    // Плавная анимация для прокрутки к якорям
    initSmoothScrolling();
    
    // Инициализация 3D-эффектов
    init3DEffects();
    
    // Инициализация частиц фона
    initParticleEffects();
});

/**
 * Инициализация звездного фона
 */
function initStarField() {
    const starsContainers = document.querySelectorAll('.stars-container');
    
    starsContainers.forEach(container => {
        new StarField({
            container: `#${container.id || 'stars-container'}`,
            starCount: 300,
            parallaxIntensity: 0.03
        });
    });
    
    // Если нет контейнера для звезд на странице, создаем его
    if (starsContainers.length === 0) {
        const starsContainer = document.createElement('div');
        starsContainer.className = 'stars-container';
        starsContainer.id = 'stars-container';
        document.body.appendChild(starsContainer);
        
        new StarField({
            container: '#stars-container',
            starCount: 300,
            parallaxIntensity: 0.03
        });
    }
}

/**
 * Анимация для секции героя
 */
function animateHeroSection() {
    const heroSection = document.querySelector('.hero-section');
    const heroTitle = heroSection.querySelector('h1');
    const heroSubtitle = heroSection.querySelector('.lead');
    const heroButtons = heroSection.querySelectorAll('.btn');
    const heroImage = heroSection.querySelector('.hero-image-container');
    
    // Создаем временную шкалу для анимации
    const tl = gsap.timeline();
    
    // Анимируем заголовок
    if (heroTitle) {
        tl.fromTo(heroTitle,
            { opacity: 0, y: 30 },
            { opacity: 1, y: 0, duration: 1, ease: 'power2.out' }
        );
    }
    
    // Анимируем подзаголовок
    if (heroSubtitle) {
        tl.fromTo(heroSubtitle,
            { opacity: 0, y: 20 },
            { opacity: 1, y: 0, duration: 1, ease: 'power2.out' },
            '-=0.7'
        );
    }
    
    // Анимируем кнопки
    if (heroButtons.length > 0) {
        tl.fromTo(heroButtons,
            { opacity: 0, y: 20 },
            { opacity: 1, y: 0, duration: 0.8, stagger: 0.2, ease: 'power2.out' },
            '-=0.7'
        );
    }
    
    // Анимируем изображение
    if (heroImage) {
        tl.fromTo(heroImage,
            { opacity: 0, scale: 0.9 },
            { opacity: 1, scale: 1, duration: 1.2, ease: 'power2.out' },
            '-=1'
        );
        
        // Добавляем постоянную анимацию для изображения
        gsap.to(heroImage, {
            y: 20,
            duration: 3,
            repeat: -1,
            yoyo: true,
            ease: 'sine.inOut'
        });
    }
}

/**
 * Анимация для секции преимуществ
 */
function animateAdvantagesSection() {
    const advantageCards = document.querySelectorAll('.advantage-card');
    
    advantageCards.forEach((card, index) => {
        const delay = index * 0.2;
        
        ScrollTrigger.create({
            trigger: card,
            start: 'top 80%',
            onEnter: () => {
                gsap.fromTo(card,
                    { opacity: 0, y: 50 },
                    { opacity: 1, y: 0, duration: 0.8, delay, ease: 'power2.out' }
                );
            },
            once: true
        });
        
        // Анимация иконки
        const icon = card.querySelector('.advantage-icon');
        if (icon) {
            gsap.to(icon, {
                y: 10,
                duration: 2,
                repeat: -1,
                yoyo: true,
                ease: 'sine.inOut',
                delay: Math.random() * 1
            });
        }
    });
}

/**
 * Анимация для секции процесса
 */
function animateProcessSection() {
    const processSteps = document.querySelectorAll('.process-step');
    
    processSteps.forEach((step, index) => {
        const delay = index * 0.3;
        
        ScrollTrigger.create({
            trigger: step,
            start: 'top 80%',
            onEnter: () => {
                gsap.fromTo(step,
                    { opacity: 0, x: index % 2 === 0 ? -50 : 50 },
                    { opacity: 1, x: 0, duration: 0.8, delay, ease: 'power2.out' }
                );
            },
            once: true
        });
    });
}

/**
 * Анимация для секции услуг
 */
function animateServicesSection() {
    const serviceCards = document.querySelectorAll('.service-item');
    
    serviceCards.forEach((card, index) => {
        const delay = index * 0.2;
        
        ScrollTrigger.create({
            trigger: card,
            start: 'top 80%',
            onEnter: () => {
                gsap.fromTo(card,
                    { opacity: 0, y: 50 },
                    { opacity: 1, y: 0, duration: 0.8, delay, ease: 'power2.out' }
                );
            },
            once: true
        });
        
        // Добавляем интерактивность при наведении
        card.addEventListener('mouseenter', () => {
            gsap.to(card, {
                y: -10,
                boxShadow: '0 15px 30px rgba(0, 0, 0, 0.2), 0 0 15px rgba(185, 53, 255, 0.3)',
                duration: 0.3,
                ease: 'power2.out'
            });
        });
        
        card.addEventListener('mouseleave', () => {
            gsap.to(card, {
                y: 0,
                boxShadow: '0 5px 15px rgba(0, 0, 0, 0.1)',
                duration: 0.3,
                ease: 'power2.out'
            });
        });
    });
}

/**
 * Анимация для секции кейсов
 */
function animateCasesSection() {
    const caseCards = document.querySelectorAll('.case-card');
    
    caseCards.forEach((card, index) => {
        const delay = index * 0.2;
        
        ScrollTrigger.create({
            trigger: card,
            start: 'top 80%',
            onEnter: () => {
                gsap.fromTo(card,
                    { opacity: 0, y: 50 },
                    { opacity: 1, y: 0, duration: 0.8, delay, ease: 'power2.out' }
                );
            },
            once: true
        });
    });
}

/**
 * Анимация для секции отзывов
 */
function animateTestimonialsSection() {
    const testimonials = document.querySelectorAll('.testimonial-card');
    
    testimonials.forEach((testimonial, index) => {
        const delay = index * 0.2;
        
        ScrollTrigger.create({
            trigger: testimonial,
            start: 'top 80%',
            onEnter: () => {
                gsap.fromTo(testimonial,
                    { opacity: 0, y: 50 },
                    { opacity: 1, y: 0, duration: 0.8, delay, ease: 'power2.out' }
                );
            },
            once: true
        });
    });
}

/**
 * Анимация для секции CTA
 */
function animateCtaSection() {
    const ctaSection = document.querySelector('.cta-section');
    const ctaTitle = ctaSection.querySelector('h2');
    const ctaText = ctaSection.querySelector('p');
    const ctaButton = ctaSection.querySelector('.btn');
    
    ScrollTrigger.create({
        trigger: ctaSection,
        start: 'top 80%',
        onEnter: () => {
            const tl = gsap.timeline();
            
            if (ctaTitle) {
                tl.fromTo(ctaTitle,
                    { opacity: 0, y: 30 },
                    { opacity: 1, y: 0, duration: 0.8, ease: 'power2.out' }
                );
            }
            
            if (ctaText) {
                tl.fromTo(ctaText,
                    { opacity: 0, y: 20 },
                    { opacity: 1, y: 0, duration: 0.8, ease: 'power2.out' },
                    '-=0.6'
                );
            }
            
            if (ctaButton) {
                tl.fromTo(ctaButton,
                    { opacity: 0, y: 20 },
                    { opacity: 1, y: 0, duration: 0.8, ease: 'power2.out' },
                    '-=0.6'
                );
            }
        },
        once: true
    });
}

/**
 * Инициализация общих анимаций
 */
function initCommonAnimations() {
    // Анимация для интерактивных элементов
    const interactiveElements = document.querySelectorAll('.interactive-element');
    
    interactiveElements.forEach(element => {
        element.addEventListener('mouseenter', () => {
            gsap.to(element, {
                color: 'var(--neon-purple)',
                textShadow: '0 0 10px rgba(185, 53, 255, 0.7)',
                duration: 0.3
            });
            
            // Анимируем иконку, если она есть
            const icon = element.querySelector('i');
            if (icon) {
                gsap.to(icon, {
                    x: 5,
                    duration: 0.3,
                    ease: 'power1.out'
                });
            }
        });
        
        element.addEventListener('mouseleave', () => {
            gsap.to(element, {
                color: '',
                textShadow: 'none',
                duration: 0.3
            });
            
            // Возвращаем иконку в исходное положение
            const icon = element.querySelector('i');
            if (icon) {
                gsap.to(icon, {
                    x: 0,
                    duration: 0.3,
                    ease: 'power1.out'
                });
            }
        });
    });
    
    // Анимация для кнопок
    const buttons = document.querySelectorAll('.cyber-btn');
    
    buttons.forEach(button => {
        button.addEventListener('mouseenter', () => {
            gsap.to(button, {
                boxShadow: '0 0 15px rgba(185, 53, 255, 0.7)',
                textShadow: '0 0 5px rgba(255, 255, 255, 0.5)',
                duration: 0.3
            });
        });
        
        button.addEventListener('mouseleave', () => {
            gsap.to(button, {
                boxShadow: '',
                textShadow: '',
                duration: 0.3
            });
        });
    });
}

/**
 * Инициализация анимаций при скролле
 */
function initScrollAnimations() {
    // Анимация для заголовков
    gsap.utils.toArray('h2, h3:not(.card-title)').forEach(heading => {
        gsap.fromTo(heading, 
            { opacity: 0, y: 30 }, 
            {
                opacity: 1,
                y: 0,
                duration: 0.8,
                scrollTrigger: {
                    trigger: heading,
                    start: 'top 85%',
                    toggleActions: 'play none none none'
                }
            }
        );
    });
    
    // Анимация для параграфов текста
    gsap.utils.toArray('p:not(.card-text)').forEach((paragraph, index) => {
        gsap.fromTo(paragraph, 
            { opacity: 0, y: 20 }, 
            {
                opacity: 1,
                y: 0,
                duration: 0.5,
                delay: index * 0.1,
                scrollTrigger: {
                    trigger: paragraph,
                    start: 'top 85%',
                    toggleActions: 'play none none none'
                }
            }
        );
    });
    
    // Анимация для кнопок и призывов к действию
    gsap.utils.toArray('.btn:not(.btn-link)').forEach(button => {
        gsap.fromTo(button, 
            { opacity: 0, scale: 0.9 }, 
            {
                opacity: 1,
                scale: 1,
                duration: 0.5,
                scrollTrigger: {
                    trigger: button,
                    start: 'top 85%',
                    toggleActions: 'play none none none'
                }
            }
        );
    });
    
    // Анимация для изображений
    gsap.utils.toArray('img:not(.icon)').forEach(img => {
        gsap.fromTo(img, 
            { opacity: 0, scale: 0.8, rotationY: 5 }, 
            {
                opacity: 1,
                scale: 1,
                rotationY: 0,
                duration: 0.8,
                scrollTrigger: {
                    trigger: img,
                    start: 'top 85%',
                    toggleActions: 'play none none none'
                }
            }
        );
    });
    
    // Анимация для секций
    gsap.utils.toArray('.section').forEach(section => {
        gsap.fromTo(section, 
            { opacity: 0, y: 30 }, 
            {
                opacity: 1,
                y: 0,
                duration: 1,
                scrollTrigger: {
                    trigger: section,
                    start: 'top 80%',
                    toggleActions: 'play none none none'
                }
            }
        );
    });
}

/**
 * Инициализация интерактивных элементов
 */
function initInteractiveElements() {
    // Анимация для кнопок
    const buttons = document.querySelectorAll('.btn');
    
    buttons.forEach(button => {
        button.addEventListener('mouseenter', () => {
            gsap.to(button, { 
                scale: 1.05, 
                boxShadow: '0 0 15px rgba(185, 53, 255, 0.7)', 
                duration: 0.3 
            });
        });
        
        button.addEventListener('mouseleave', () => {
            gsap.to(button, { 
                scale: 1, 
                boxShadow: 'none', 
                duration: 0.3 
            });
        });
        
        button.addEventListener('mousedown', () => {
            gsap.to(button, { scale: 0.95, duration: 0.1 });
        });
        
        button.addEventListener('mouseup', () => {
            gsap.to(button, { scale: 1.05, duration: 0.1 });
        });
    });
    
    // Анимация для интерактивных элементов
    const interactiveElements = document.querySelectorAll('.interactive-element');
    
    interactiveElements.forEach(element => {
        element.addEventListener('mouseenter', () => {
            gsap.to(element, {
                color: 'var(--neon-purple)',
                textShadow: '0 0 10px rgba(185, 53, 255, 0.7)',
                duration: 0.3
            });
        });
        
        element.addEventListener('mouseleave', () => {
            gsap.to(element, {
                color: '',
                textShadow: 'none',
                duration: 0.3
            });
        });
    });
}

/**
 * Инициализация плавной прокрутки к якорям
 */
function initSmoothScrolling() {
    const smoothScrollLinks = document.querySelectorAll('a[href^="#"]:not([href="#"])');
    
    smoothScrollLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            
            const targetId = link.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                gsap.to(window, {
                    duration: 1,
                    scrollTo: {
                        y: targetElement,
                        offsetY: 50
                    },
                    ease: 'power2.inOut'
                });
            }
        });
    });
}

/**
 * Инициализация 3D-эффектов
 */
function init3DEffects() {
    const tiltCards = document.querySelectorAll('.tilt-card');
    
    tiltCards.forEach(card => {
        const cardInner = card.querySelector('.tilt-card-inner');
        
        if (!cardInner) return;
        
        // Добавляем обработчики событий для 3D-эффекта
        card.addEventListener('mousemove', e => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = (y - centerY) / 10;
            const rotateY = (centerX - x) / 10;
            
            gsap.to(cardInner, {
                rotateX: rotateX,
                rotateY: rotateY,
                duration: 0.5,
                ease: 'power2.out'
            });
        });
        
        card.addEventListener('mouseleave', () => {
            gsap.to(cardInner, {
                rotateX: 0,
                rotateY: 0,
                duration: 0.5,
                ease: 'power2.out'
            });
        });
    });
}

/**
 * Инициализация эффектов частиц
 */
function initParticleEffects() {
    const particleContainers = document.querySelectorAll('.particle-container');
    
    particleContainers.forEach(container => {
        const particleCount = container.dataset.particleCount || 20;
        
        // Создаем частицы
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            
            // Случайные параметры для частицы
            const size = Math.random() * 5 + 2;
            const x = Math.random() * 100;
            const y = Math.random() * 100;
            const duration = Math.random() * 20 + 10;
            const delay = Math.random() * 5;
            
            // Настраиваем стили частицы
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.left = `${x}%`;
            particle.style.top = `${y}%`;
            particle.style.opacity = Math.random() * 0.5 + 0.1;
            
            // Добавляем частицу в контейнер
            container.appendChild(particle);
            
            // Анимируем частицу
            gsap.to(particle, {
                x: `+=${Math.random() * 100 - 50}`,
                y: `+=${Math.random() * 100 - 50}`,
                rotation: Math.random() * 360,
                duration: duration,
                delay: delay,
                repeat: -1,
                yoyo: true,
                ease: 'sine.inOut'
            });
            
            // Анимация мерцания
            gsap.to(particle, {
                opacity: 0,
                duration: Math.random() * 2 + 1,
                delay: Math.random() * 5,
                repeat: -1,
                yoyo: true,
                ease: 'sine.inOut'
            });
        }
    });
}

// Экспортируем GSAP глобально для доступа из других модулей
window.gsap = gsap;
