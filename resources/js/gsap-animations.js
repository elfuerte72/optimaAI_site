/**
 * GSAP Animations - OptimAI 2030 Edition
 * Оптимизированные анимации для высокой производительности (60+ FPS)
 */

// Импортируем GSAP и необходимые плагины
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { TextPlugin } from 'gsap/TextPlugin';

// Регистрируем плагины GSAP
gsap.registerPlugin(ScrollTrigger, TextPlugin);

// Оптимизированная анимация для процесса работы
function initProcessAnimations() {
  if (!document.querySelector('.process-timeline-2025')) return;
  
  const processCards = gsap.utils.toArray('.process-card');
  
  // Используем will-change для оптимизации рендеринга
  processCards.forEach(card => {
    gsap.set(card, { 
      opacity: 0, 
      y: 50,
      willChange: 'transform, opacity' 
    });
  });
  
  // Используем ScrollTrigger с оптимизированными настройками
  ScrollTrigger.batch(processCards, {
    onEnter: batch => {
      gsap.to(batch, {
        opacity: 1,
        y: 0,
        stagger: { 
          each: 0.15,
          ease: "power2.out"
        },
        duration: 0.7,
        ease: "power3.out",
        onComplete: () => {
          // Удаляем will-change после завершения анимации для освобождения ресурсов
          batch.forEach(card => {
            gsap.set(card, { willChange: 'auto' });
          });
        }
      });
    },
    start: "top 85%",
    once: true
  });
  
  // Оптимизированная анимация иконок
  processCards.forEach(card => {
    const icon = card.querySelector('.process-svg');
    const glow = card.querySelector('.process-icon-glow');
    
    if (icon && glow) {
      // Используем более легкие анимации для иконок
      gsap.to(icon, {
        scale: 1.1,
        duration: 2,
        repeat: -1,
        yoyo: true,
        ease: "sine.inOut"
      });
      
      // Используем transform вместо rotation для лучшей производительности
      gsap.to(glow, {
        rotate: 360,
        duration: 20,
        repeat: -1,
        ease: "none"
      });
    }
  });
}

// Оптимизированная анимация для услуг 2025
function initServiceAnimations() {
  if (document.querySelector('.service-icon-2025')) {
    const serviceItems = gsap.utils.toArray('.service-item');
    
    // Анимация появления карточек услуг
    gsap.set(serviceItems, { 
      opacity: 0, 
      y: 50 
    });
    
    ScrollTrigger.batch(serviceItems, {
      onEnter: batch => {
        gsap.to(batch, {
          opacity: 1,
          y: 0,
          stagger: 0.1,
          duration: 0.8,
          ease: "power3.out"
        });
      },
      start: "top 85%",
      once: true
    });
    
    // Анимация иконок услуг
    serviceItems.forEach(item => {
      const icon = item.querySelector('.service-svg');
      const glow = item.querySelector('.service-icon-glow');
      
      if (icon && glow) {
        // Пульсирующая анимация для иконок
        gsap.to(icon, {
          scale: 1.1,
          duration: 2,
          repeat: -1,
          yoyo: true,
          ease: "sine.inOut"
        });
        
        // Вращающаяся анимация для свечения
        gsap.to(glow, {
          rotation: 360,
          duration: 20,
          repeat: -1,
          ease: "none"
        });
      }
    });
  }
}

// Анимация для кибер-кнопок
function initCyberButtonAnimations() {
  const cyberButtons = gsap.utils.toArray('.cyber-btn');
  
  cyberButtons.forEach(button => {
    // Создаем эффект мерцания для кнопок
    gsap.to(button, {
      boxShadow: '0 0 20px rgba(185, 53, 255, 0.9), 0 0 30px rgba(185, 53, 255, 0.3)',
      duration: 2,
      repeat: -1,
      yoyo: true,
      ease: "sine.inOut"
    });
  });
}

// Оптимизированная анимация для героя
function initHeroAnimations() {
  const heroSection = document.querySelector('.hero-section');
  
  if (!heroSection) return;
  
  const heroTitle = heroSection.querySelector('h1');
  const heroSubtitle = heroSection.querySelector('p');
  const heroButton = heroSection.querySelector('.cyber-btn');
  
  if (!heroTitle || !heroSubtitle || !heroButton) return;
  
  // Используем will-change для оптимизации рендеринга
  gsap.set([heroTitle, heroSubtitle, heroButton], { 
    willChange: 'transform, opacity' 
  });
  
  const tl = gsap.timeline({ 
    defaults: { ease: "power3.out" },
    onComplete: () => {
      // Удаляем will-change после завершения анимации
      gsap.set([heroTitle, heroSubtitle, heroButton], { 
        willChange: 'auto' 
      });
    }
  });
  
  tl.fromTo(heroTitle, 
    { opacity: 0, y: 30 }, 
    { opacity: 1, y: 0, duration: 0.8 }
  )
  .fromTo(heroSubtitle, 
    { opacity: 0, y: 20 }, 
    { opacity: 1, y: 0, duration: 0.7 }, 
    "-=0.4"
  )
  .fromTo(heroButton, 
    { opacity: 0, y: 15 }, 
    { opacity: 1, y: 0, duration: 0.5 }, 
    "-=0.3"
  );
  
  // Используем более легкую плавающую анимацию
  gsap.to(heroTitle, {
    y: "+=8",
    duration: 2.5,
    repeat: -1,
    yoyo: true,
    ease: "sine.inOut"
  });
}

// Оптимизированная анимация для CTA секции
function initCtaAnimations() {
  const ctaSection = document.querySelector('.bg-gradient-cta');
  
  if (!ctaSection) return;
  
  const ctaTitle = ctaSection.querySelector('h2');
  const ctaText = ctaSection.querySelector('p');
  const ctaButtons = ctaSection.querySelectorAll('.cyber-btn');
  
  if (!ctaTitle || !ctaText || !ctaButtons.length) return;
  
  // Используем will-change для оптимизации рендеринга
  gsap.set([ctaTitle, ctaText, ...ctaButtons], { 
    opacity: 0, 
    y: 20,
    willChange: 'transform, opacity' 
  });
  
  ScrollTrigger.create({
    trigger: ctaSection,
    start: "top 80%",
    onEnter: () => {
      const tl = gsap.timeline({
        onComplete: () => {
          // Удаляем will-change после завершения анимации
          gsap.set([ctaTitle, ctaText, ...ctaButtons], { 
            willChange: 'auto' 
          });
        }
      });
      
      tl.to(ctaTitle, {
        opacity: 1,
        y: 0,
        duration: 0.7,
        ease: "power2.out"
      })
      .to(ctaText, {
        opacity: 1,
        y: 0,
        duration: 0.7,
        ease: "power2.out"
      }, "-=0.5")
      .to(ctaButtons, {
        opacity: 1,
        y: 0,
        stagger: 0.15,
        duration: 0.7,
        ease: "power2.out"
      }, "-=0.5");
    },
    once: true
  });
  
  // Оптимизированная анимация фоновых элементов
  const ctaParticles = ctaSection.querySelector('.cta-particles');
  const ctaGlows = ctaSection.querySelectorAll('.cta-glow-1, .cta-glow-2');
  
  if (ctaParticles) {
    // Используем transform вместо backgroundPosition для лучшей производительности
    gsap.to(ctaParticles, {
      backgroundPosition: "50px 50px",
      duration: 30,
      repeat: -1,
      ease: "none"
    });
  }
  
  if (ctaGlows.length) {
    ctaGlows.forEach((glow, index) => {
      gsap.to(glow, {
        opacity: index === 0 ? 0.6 : 0.4,
        y: index === 0 ? "-4%" : "4%",
        duration: 12 + index * 4,
        repeat: -1,
        yoyo: true,
        ease: "sine.inOut"
      });
    });
  }
}

// Оптимизированная инициализация анимаций с использованием requestAnimationFrame
function initAnimations() {
  // Используем requestAnimationFrame для оптимизации производительности
  requestAnimationFrame(() => {
    // Инициализируем только необходимые анимации
    initHeroAnimations();
    
    // Отложенная инициализация остальных анимаций
    setTimeout(() => {
      initProcessAnimations();
      initServiceAnimations();
      initCyberButtonAnimations();
      initCtaAnimations();
    }, 100);
  });
}

// Оптимизированная загрузка
document.addEventListener('DOMContentLoaded', function() {
  // Проверяем поддержку requestAnimationFrame
  if (window.requestAnimationFrame) {
    initAnimations();
  } else {
    // Запасной вариант для старых браузеров
    initHeroAnimations();
    initProcessAnimations();
    initServiceAnimations();
    initCyberButtonAnimations();
    initCtaAnimations();
  }
});

// Оптимизация прокрутки
let scrollTimeout;
window.addEventListener('scroll', function() {
  // Отменяем предыдущий таймаут
  clearTimeout(scrollTimeout);
  
  // Устанавливаем новый таймаут
  scrollTimeout = setTimeout(function() {
    // Обновляем ScrollTrigger после остановки прокрутки
    ScrollTrigger.refresh();
  }, 200);
}, { passive: true }); // Используем passive: true для улучшения производительности 