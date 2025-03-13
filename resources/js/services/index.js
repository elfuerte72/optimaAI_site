/**
 * Services Page Animations - OptimAI 2030 Edition
 * Футуристические анимации для страницы услуг с использованием Vue 3 и GSAP
 */

import { createApp } from 'vue';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { TextPlugin } from 'gsap/TextPlugin';
import ServicesPage from '../components/ServicesPage.vue';
import StarBackground from '../components/StarBackground.vue';
import '../starfield';
import { AILogoEffect } from '../three-effects';

// Регистрируем плагины GSAP
gsap.registerPlugin(ScrollTrigger, TextPlugin);

// Экспортируем GSAP и плагины для использования в других файлах
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
window.TextPlugin = TextPlugin;

// Инициализация Vue приложения на странице услуг
document.addEventListener('DOMContentLoaded', () => {
  // Проверяем, находимся ли мы на странице услуг
  const servicesPageContainer = document.getElementById('services-page');
  if (servicesPageContainer) {
    // Инициализируем Vue приложение
    const app = createApp(ServicesPage);
    app.mount('#services-page');
  }
  
  // Проверяем, находимся ли мы на подстранице услуг
  const serviceDetailPage = document.querySelector('.service-detail-page');
  if (serviceDetailPage) {
    // Инициализируем звездный фон
    const starsContainer = document.getElementById('stars-container');
    if (starsContainer) {
      const app = createApp(StarBackground);
      app.mount('#stars-container');
    }
    
    // Анимация для подстраниц услуг
    animateServiceSubpages();
  }
  
  // Звездный фон инициализируется автоматически через DOMContentLoaded в starfield.js
  
  // Инициализируем 3D-логотип
  const logoContainer = document.getElementById('logo-container');
  if (logoContainer) {
    const aiLogoEffect = new AILogoEffect({
      container: '#logo-container',
      modelPath: '/models/ai-crystal.glb'
    });
  }
  
  // Анимация заголовка страницы
  animatePageHeader();
  
  // Анимация карточек услуг
  animateServiceCards();
  
  // Анимация интерактивных элементов
  initInteractiveElements();
  
  // Анимация при скролле
  initScrollAnimations();
});

/**
 * Анимация заголовка страницы
 */
function animatePageHeader() {
  const pageTitle = document.querySelector('.services-page-title');
  const pageSubtitle = document.querySelector('.services-page-subtitle');
  const headerSeparator = document.querySelector('.header-separator');
  
  if (pageTitle) {
    // Создаем эффект печатающегося текста
    const originalText = pageTitle.textContent;
    pageTitle.textContent = '';
    
    gsap.to(pageTitle, {
      text: {
        value: originalText,
        delimiter: ''
      },
      duration: 1.5,
      ease: 'power2.inOut',
      onComplete: () => {
        // Добавляем неоновое свечение после завершения анимации
        gsap.to(pageTitle, {
          textShadow: '0 0 10px rgba(185, 53, 255, 0.7), 0 0 20px rgba(185, 53, 255, 0.5)',
          duration: 0.5
        });
      }
    });
  }
  
  if (pageSubtitle) {
    gsap.fromTo(pageSubtitle, 
      { opacity: 0, y: 20 }, 
      { opacity: 1, y: 0, duration: 1, delay: 1, ease: 'power2.out' }
    );
  }
  
  if (headerSeparator) {
    gsap.fromTo(headerSeparator,
      { width: 0, opacity: 0 },
      { width: '80px', opacity: 1, duration: 1, delay: 0.5, ease: 'power2.inOut' }
    );
  }
}

/**
 * Анимация карточек услуг
 */
function animateServiceCards() {
  const serviceCards = document.querySelectorAll('.service-card');
  
  if (serviceCards.length === 0) return;
  
  // Создаем временную шкалу для анимации карточек
  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: serviceCards[0].closest('.services-section'),
      start: 'top 70%',
      toggleActions: 'play none none reverse'
    }
  });
  
  // Анимируем каждую карточку с задержкой
  serviceCards.forEach((card, index) => {
    // Находим элементы внутри карточки
    const cardIcon = card.querySelector('.service-icon-wrapper');
    const cardTitle = card.querySelector('h3');
    const cardText = card.querySelector('p');
    const cardLink = card.querySelector('a');
    
    // Добавляем анимацию появления карточки
    tl.fromTo(card, 
      { y: 50, opacity: 0 },
      { y: 0, opacity: 1, duration: 0.8, ease: 'power2.out' },
      index * 0.2
    );
    
    // Анимируем иконку
    if (cardIcon) {
      tl.fromTo(cardIcon,
        { opacity: 0, scale: 0.5 },
        { opacity: 1, scale: 1, duration: 0.6, ease: 'back.out(1.7)' },
        `-=0.6`
      );
      
      // Добавляем постоянную анимацию для иконки
      gsap.to(cardIcon, {
        y: 10,
        duration: 2,
        repeat: -1,
        yoyo: true,
        ease: 'sine.inOut'
      });
    }
    
    // Анимируем заголовок
    if (cardTitle) {
      tl.fromTo(cardTitle,
        { opacity: 0, x: -20 },
        { opacity: 1, x: 0, duration: 0.6, ease: 'power2.out' },
        `-=0.4`
      );
    }
    
    // Анимируем текст
    if (cardText) {
      tl.fromTo(cardText,
        { opacity: 0 },
        { opacity: 1, duration: 0.6, ease: 'power2.out' },
        `-=0.4`
      );
    }
    
    // Анимируем ссылку
    if (cardLink) {
      tl.fromTo(cardLink,
        { opacity: 0, y: 10 },
        { opacity: 1, y: 0, duration: 0.6, ease: 'power2.out' },
        `-=0.2`
      );
    }
    
    // Добавляем 3D-эффект при наведении
    const cardInner = card.querySelector('.tilt-card-inner') || card;
    
    card.addEventListener('mousemove', (e) => {
      const cardRect = card.getBoundingClientRect();
      const cardCenterX = cardRect.left + cardRect.width / 2;
      const cardCenterY = cardRect.top + cardRect.height / 2;
      
      // Вычисляем положение курсора относительно центра карточки
      const mouseX = e.clientX - cardCenterX;
      const mouseY = e.clientY - cardCenterY;
      
      // Нормализуем значения от -1 до 1
      const rotateX = mouseY / (cardRect.height / 2) * -10; // Инвертируем ось Y
      const rotateY = mouseX / (cardRect.width / 2) * 10;
      
      // Применяем 3D-трансформацию
      gsap.to(cardInner, {
        rotateX: rotateX,
        rotateY: rotateY,
        transformPerspective: 1000,
        duration: 0.3,
        ease: 'power2.out'
      });
      
      // Добавляем эффект свечения в направлении курсора
      const gradientX = (e.clientX - cardRect.left) / cardRect.width * 100;
      const gradientY = (e.clientY - cardRect.top) / cardRect.height * 100;
      
      card.style.background = `radial-gradient(circle at ${gradientX}% ${gradientY}%, rgba(99, 102, 241, 0.3), rgba(20, 25, 45, 0.7) 70%)`;
    });
    
    card.addEventListener('mouseleave', () => {
      // Возвращаем карточку в исходное положение
      gsap.to(cardInner, {
        rotateX: 0,
        rotateY: 0,
        duration: 0.5,
        ease: 'power2.out'
      });
      
      // Возвращаем исходный фон
      card.style.background = 'rgba(20, 25, 45, 0.7)';
    });
    
    // Добавляем интерактивность при наведении
    card.addEventListener('mouseenter', () => {
      gsap.to(card, {
        y: -10,
        boxShadow: '0 15px 30px rgba(0, 0, 0, 0.2), 0 0 15px rgba(185, 53, 255, 0.7)',
        duration: 0.3,
        ease: 'power2.out'
      });
      
      // Анимация свечения границы
      gsap.to(card, {
        borderColor: 'rgba(185, 53, 255, 0.7)',
        duration: 0.3
      });
      
      // Анимация иконки
      if (cardIcon) {
        gsap.to(cardIcon, {
          scale: 1.1,
          filter: 'drop-shadow(0 0 10px rgba(185, 53, 255, 0.7))',
          duration: 0.3
        });
      }
    });
    
    card.addEventListener('mouseleave', () => {
      gsap.to(card, {
        y: 0,
        boxShadow: '0 5px 15px rgba(0, 0, 0, 0.1)',
        duration: 0.3,
        ease: 'power2.out'
      });
      
      // Возвращаем исходный цвет границы
      gsap.to(card, {
        borderColor: 'rgba(255, 255, 255, 0.05)',
        duration: 0.3
      });
      
      // Возвращаем исходное состояние иконки
      if (cardIcon) {
        gsap.to(cardIcon, {
          scale: 1,
          filter: 'none',
          duration: 0.3
        });
      }
    });
  });
}

/**
 * Инициализация интерактивных элементов
 */
function initInteractiveElements() {
  const interactiveElements = document.querySelectorAll('.interactive-element');
  
  interactiveElements.forEach(element => {
    // Добавляем анимацию при наведении
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
}

/**
 * Инициализация анимаций при скролле
 */
function initScrollAnimations() {
  // Анимация секции преимуществ
  const featuresSection = document.querySelector('.features-section');
  if (featuresSection) {
    const featureCards = featuresSection.querySelectorAll('.card');
    
    featureCards.forEach((card, index) => {
      const delay = index * 0.2;
      
      ScrollTrigger.create({
        trigger: card,
        start: 'top 80%',
        onEnter: () => {
          gsap.fromTo(card,
            { y: 50, opacity: 0 },
            { y: 0, opacity: 1, duration: 0.8, delay, ease: 'power2.out' }
          );
        },
        once: true
      });
    });
  }
  
  // Анимация секции с логотипом
  const logoSection = document.querySelector('.logo-section');
  if (logoSection) {
    const textElements = logoSection.querySelectorAll('.slide-left');
    
    textElements.forEach((element, index) => {
      const delay = index * 0.2;
      
      ScrollTrigger.create({
        trigger: element,
        start: 'top 80%',
        onEnter: () => {
          gsap.fromTo(element,
            { x: -50, opacity: 0 },
            { x: 0, opacity: 1, duration: 0.8, delay, ease: 'power2.out' }
          );
        },
        once: true
      });
    });
  }
  
  // Анимация CTA секции
  const ctaSection = document.querySelector('.services-cta');
  if (ctaSection) {
    ScrollTrigger.create({
      trigger: ctaSection,
      start: 'top 80%',
      onEnter: () => {
        gsap.fromTo(ctaSection,
          { y: 50, opacity: 0 },
          { y: 0, opacity: 1, duration: 0.8, ease: 'power2.out' }
        );
        
        // Анимация границы
        gsap.fromTo(ctaSection,
          { backgroundSize: '100% 0' },
          { backgroundSize: '100% 100%', duration: 1, delay: 0.3, ease: 'power2.inOut' }
        );
      },
      once: true
    });
  }
}

/**
 * Анимация для подстраниц услуг
 */
function animateServiceSubpages() {
  // Проверяем, находимся ли мы на подстранице услуг
  const serviceSubpage = document.querySelector('.service-detail-page');
  if (!serviceSubpage) return;
  
  // Заменяем цифры на тематические иконки
  replaceNumbersWithIcons();
  
  // Анимация заголовка
  const pageTitle = document.querySelector('.service-detail-title');
  if (pageTitle) {
    gsap.fromTo(pageTitle,
      { opacity: 0, y: 30 },
      { opacity: 1, y: 0, duration: 1, ease: 'power2.out' }
    );
  }
  
  // Анимация подзаголовка
  const pageSubtitle = document.querySelector('.service-detail-subtitle');
  if (pageSubtitle) {
    gsap.fromTo(pageSubtitle,
      { opacity: 0, y: 20 },
      { opacity: 1, y: 0, duration: 1, delay: 0.2, ease: 'power2.out' }
    );
  }
  
  // Анимация секций
  const sections = document.querySelectorAll('.service-section');
  sections.forEach((section, index) => {
    const delay = index * 0.2;
    
    ScrollTrigger.create({
      trigger: section,
      start: 'top 80%',
      onEnter: () => {
        gsap.fromTo(section,
          { opacity: 0, y: 50 },
          { opacity: 1, y: 0, duration: 0.8, delay, ease: 'power2.out' }
        );
      },
      once: true
    });
  });
  
  // Анимация элементов списка
  const listItems = document.querySelectorAll('.service-list-item');
  listItems.forEach((item, index) => {
    const delay = 0.1 + (index * 0.1);
    
    ScrollTrigger.create({
      trigger: item,
      start: 'top 90%',
      onEnter: () => {
        gsap.fromTo(item,
          { opacity: 0, x: -20 },
          { opacity: 1, x: 0, duration: 0.6, delay, ease: 'power2.out' }
        );
      },
      once: true
    });
  });
  
  // Анимация кнопок
  const buttons = document.querySelectorAll('.service-detail-page .btn, .service-detail-page .cyber-btn');
  buttons.forEach((button, index) => {
    const delay = 0.3 + (index * 0.2);
    
    ScrollTrigger.create({
      trigger: button,
      start: 'top 90%',
      onEnter: () => {
        gsap.fromTo(button,
          { opacity: 0, y: 20 },
          { opacity: 1, y: 0, duration: 0.6, delay, ease: 'power2.out' }
        );
      },
      once: true
    });
  });
}

/**
 * Заменяет цифры на тематические иконки
 */
function replaceNumbersWithIcons() {
  // Карта иконок для разных типов услуг
  const iconMap = {
    'consulting': ['brain', 'lightbulb', 'people', 'graph-up', 'chat-dots'],
    'models': ['cpu', 'code', 'gear', 'diagram-3', 'robot'],
    'integration': ['plug', 'arrow-left-right', 'layers', 'cloud', 'diagram-2']
  };
  
  // Определяем тип услуги по URL
  let serviceType = 'consulting'; // По умолчанию
  const url = window.location.pathname;
  
  if (url.includes('language-models-setup')) {
    serviceType = 'models';
  } else if (url.includes('ai-business-integration')) {
    serviceType = 'integration';
  }
  
  // Находим все элементы с цифрами
  const numberElements = document.querySelectorAll('.step-number, .number-circle');
  
  numberElements.forEach((element, index) => {
    // Получаем иконку из карты или используем стандартную
    const iconName = iconMap[serviceType][index % iconMap[serviceType].length];
    
    // Сохраняем оригинальный текст (цифру)
    const originalText = element.textContent;
    
    // Создаем иконку
    element.innerHTML = `<i class="bi bi-${iconName}" aria-hidden="true"></i><span class="visually-hidden">${originalText}</span>`;
    
    // Добавляем класс для стилизации
    element.classList.add('icon-circle');
    element.classList.remove('number-circle');
    
    // Анимируем иконку
    gsap.to(element.querySelector('i'), {
      rotation: 360,
      duration: 20,
      repeat: -1,
      ease: 'linear'
    });
  });
}
