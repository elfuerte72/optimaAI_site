/**
 * OptimaAI - Нейросетевые решения для бизнеса
 * Современные анимации для футуристического дизайна 2025
 */

document.addEventListener('DOMContentLoaded', function() {
  // Инициализация библиотек
  initializeLibraries();
  
  // Создание анимированного фона
  createAnimatedBackground();
  
  // Настройка анимаций при скролле
  setupScrollAnimations();
  
  // Настройка параллакс-эффектов
  setupParallaxEffects();
  
  // Настройка 3D-эффектов для карточек
  setup3DCardEffects();
  
  // Анимация логотипа
  animateLogo();
});

/**
 * Инициализация необходимых библиотек
 */
function initializeLibraries() {
  // Проверяем, загружены ли уже библиотеки
  if (typeof gsap === 'undefined') {
    loadScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js');
    loadScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js');
  }
  
  if (typeof THREE === 'undefined') {
    loadScript('https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js');
  }
  
  if (!document.querySelector('script[src*="framer-motion"]')) {
    loadScript('https://unpkg.com/framer-motion@10.16.4/dist/framer-motion.js');
  }
}

/**
 * Загрузка скрипта
 * @param {string} src URL скрипта
 */
function loadScript(src) {
  return new Promise((resolve, reject) => {
    const script = document.createElement('script');
    script.src = src;
    script.async = true;
    script.onload = resolve;
    script.onerror = reject;
    document.head.appendChild(script);
  });
}

/**
 * Создание анимированного фона с частицами
 */
function createAnimatedBackground() {
  // Создаем контейнер для фона
  const backgroundContainer = document.createElement('div');
  backgroundContainer.className = 'animated-background';
  document.body.appendChild(backgroundContainer);
  
  // Ждем загрузки Three.js
  const checkThreeLoaded = setInterval(() => {
    if (typeof THREE !== 'undefined') {
      clearInterval(checkThreeLoaded);
      
      // Настройка сцены
      const scene = new THREE.Scene();
      const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
      
      const renderer = new THREE.WebGLRenderer({ alpha: true });
      renderer.setSize(window.innerWidth, window.innerHeight);
      renderer.setClearColor(0x000000, 0);
      backgroundContainer.appendChild(renderer.domElement);
      
      // Создание частиц
      const particlesGeometry = new THREE.BufferGeometry();
      const particlesCount = 1000;
      
      const posArray = new Float32Array(particlesCount * 3);
      
      for (let i = 0; i < particlesCount * 3; i++) {
        posArray[i] = (Math.random() - 0.5) * 10;
      }
      
      particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));
      
      // Материал для частиц
      const particlesMaterial = new THREE.PointsMaterial({
        size: 0.02,
        color: 0x00f0ff,
        transparent: true,
        opacity: 0.5,
        blending: THREE.AdditiveBlending
      });
      
      // Создание сетки частиц
      const particlesMesh = new THREE.Points(particlesGeometry, particlesMaterial);
      scene.add(particlesMesh);
      
      camera.position.z = 5;
      
      // Анимация
      const animate = () => {
        requestAnimationFrame(animate);
        
        particlesMesh.rotation.x += 0.0005;
        particlesMesh.rotation.y += 0.0005;
        
        renderer.render(scene, camera);
      };
      
      animate();
      
      // Обработка изменения размера окна
      window.addEventListener('resize', () => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
      });
    }
  }, 100);
}

/**
 * Настройка анимаций при скролле
 */
function setupScrollAnimations() {
  // Ждем загрузки GSAP
  const checkGsapLoaded = setInterval(() => {
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
      clearInterval(checkGsapLoaded);
      
      // Регистрируем плагин ScrollTrigger
      gsap.registerPlugin(ScrollTrigger);
      
      // Анимация заголовков
      gsap.utils.toArray('h1, h2').forEach(heading => {
        gsap.fromTo(heading, 
          { opacity: 0, y: 50 },
          { 
            opacity: 1, 
            y: 0, 
            duration: 1,
            ease: "power3.out",
            scrollTrigger: {
              trigger: heading,
              start: "top 80%",
              toggleActions: "play none none none"
            }
          }
        );
      });
      
      // Анимация карточек
      gsap.utils.toArray('.card').forEach((card, i) => {
        gsap.fromTo(card, 
          { opacity: 0, y: 100 },
          { 
            opacity: 1, 
            y: 0, 
            duration: 0.8,
            delay: i * 0.1,
            ease: "power2.out",
            scrollTrigger: {
              trigger: card,
              start: "top 85%",
              toggleActions: "play none none none"
            }
          }
        );
      });
      
      // Анимация секций
      gsap.utils.toArray('section').forEach(section => {
        const elements = section.querySelectorAll('p, .btn, img, .icon-wrapper');
        
        gsap.fromTo(elements, 
          { opacity: 0, y: 30 },
          { 
            opacity: 1, 
            y: 0, 
            duration: 0.8,
            stagger: 0.1,
            ease: "power2.out",
            scrollTrigger: {
              trigger: section,
              start: "top 70%",
              toggleActions: "play none none none"
            }
          }
        );
      });
    }
  }, 100);
}

/**
 * Настройка параллакс-эффектов
 */
function setupParallaxEffects() {
  // Ждем загрузки GSAP
  const checkGsapLoaded = setInterval(() => {
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
      clearInterval(checkGsapLoaded);
      
      // Параллакс для фоновых изображений
      gsap.utils.toArray('[data-parallax]').forEach(element => {
        const depth = element.getAttribute('data-parallax-depth') || 0.2;
        
        gsap.to(element, {
          y: () => -ScrollTrigger.maxScroll(window) * depth,
          ease: "none",
          scrollTrigger: {
            trigger: element,
            start: "top bottom",
            end: "bottom top",
            scrub: true,
            invalidateOnRefresh: true
          }
        });
      });
      
      // Параллакс для элементов hero-секции
      const heroElements = document.querySelectorAll('.hero-content > *');
      
      heroElements.forEach((el, i) => {
        const depth = 0.1 + (i * 0.05);
        
        gsap.to(el, {
          y: () => ScrollTrigger.maxScroll(window) * depth,
          ease: "none",
          scrollTrigger: {
            trigger: el,
            start: "top bottom",
            end: "bottom top",
            scrub: true
          }
        });
      });
    }
  }, 100);
}

/**
 * Настройка 3D-эффектов для карточек
 */
function setup3DCardEffects() {
  const cards = document.querySelectorAll('.card');
  
  cards.forEach(card => {
    card.addEventListener('mousemove', e => {
      const rect = card.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;
      
      const centerX = rect.width / 2;
      const centerY = rect.height / 2;
      
      const rotateX = (y - centerY) / 20;
      const rotateY = (centerX - x) / 20;
      
      card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
      card.style.transition = 'transform 0.1s ease';
      
      // Добавляем эффект свечения
      const glowX = (x / rect.width) * 100;
      const glowY = (y / rect.height) * 100;
      
      card.style.background = `
        rgba(30, 42, 69, 0.3)
        radial-gradient(
          circle at ${glowX}% ${glowY}%, 
          rgba(0, 240, 255, 0.1) 0%, 
          transparent 50%
        )
      `;
    });
    
    card.addEventListener('mouseleave', () => {
      card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale3d(1, 1, 1)';
      card.style.transition = 'transform 0.5s ease, box-shadow 0.5s ease, border-color 0.5s ease';
      card.style.background = 'rgba(30, 42, 69, 0.3)';
    });
  });
}

/**
 * Анимация логотипа при загрузке страницы
 */
function animateLogo() {
  // Ждем загрузки GSAP
  const checkGsapLoaded = setInterval(() => {
    if (typeof gsap !== 'undefined') {
      clearInterval(checkGsapLoaded);
      
      const logo = document.querySelector('.navbar-brand img');
      
      if (logo) {
        gsap.fromTo(logo, 
          { opacity: 0, scale: 0.8, rotation: -10 },
          { 
            opacity: 1, 
            scale: 1, 
            rotation: 0,
            duration: 1.2,
            ease: "elastic.out(1, 0.5)"
          }
        );
      }
    }
  }, 100);
}

/**
 * Modern Animations - 2025 Edition
 * Современные анимации для улучшения пользовательского опыта
 */

document.addEventListener('DOMContentLoaded', () => {
    // Инициализация всех анимаций
    initParallaxEffects();
    initScrollAnimations();
    initHoverEffects();
    initNeuralBackground();
    initSmoothScrolling();
    initTextAnimations();
});

/**
 * Параллакс эффекты
 */
function initParallaxEffects() {
    const parallaxElements = document.querySelectorAll('[data-parallax]');
    
    if (parallaxElements.length === 0) return;
    
    window.addEventListener('mousemove', (e) => {
        const mouseX = e.clientX;
        const mouseY = e.clientY;
        
        parallaxElements.forEach(element => {
            const depth = element.getAttribute('data-parallax-depth') || 0.1;
            const moveX = (mouseX - window.innerWidth / 2) * depth;
            const moveY = (mouseY - window.innerHeight / 2) * depth;
            
            element.style.transform = `translate3d(${moveX}px, ${moveY}px, 0)`;
        });
    });
    
    // Параллакс при скролле
    window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;
        
        document.querySelectorAll('[data-parallax-scroll]').forEach(element => {
            const speed = element.getAttribute('data-parallax-scroll') || 0.1;
            element.style.transform = `translateY(${scrollY * speed}px)`;
        });
    });
}

/**
 * Анимации при скролле
 */
function initScrollAnimations() {
    const animatedElements = document.querySelectorAll('.animate-on-scroll');
    
    if (animatedElements.length === 0) return;
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
                
                // Добавляем задержку для элементов с data-delay
                const delay = entry.target.getAttribute('data-delay');
                if (delay) {
                    entry.target.style.animationDelay = `${delay}s`;
                }
                
                // Если элемент должен анимироваться только один раз
                if (entry.target.hasAttribute('data-animate-once')) {
                    observer.unobserve(entry.target);
                }
            } else if (!entry.target.hasAttribute('data-animate-once')) {
                entry.target.classList.remove('animated');
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -10% 0px'
    });
    
    animatedElements.forEach(element => {
        observer.observe(element);
    });
    
    // Анимация для секций
    const sections = document.querySelectorAll('section');
    sections.forEach(section => {
        section.querySelectorAll('h2, .section-title').forEach(title => {
            title.classList.add('animate-on-scroll');
            title.setAttribute('data-animation', 'fade-up');
        });
        
        section.querySelectorAll('.section-subtitle, p.lead').forEach(subtitle => {
            subtitle.classList.add('animate-on-scroll');
            subtitle.setAttribute('data-animation', 'fade-up');
            subtitle.setAttribute('data-delay', '0.2');
        });
    });
    
    // Добавляем классы анимации к элементам
    document.querySelectorAll('[data-animation]').forEach(element => {
        const animation = element.getAttribute('data-animation');
        element.classList.add(`animation-${animation}`);
    });
}

/**
 * Эффекты при наведении
 */
function initHoverEffects() {
    // Эффект свечения для кнопок
    document.querySelectorAll('.btn').forEach(button => {
        button.addEventListener('mousemove', (e) => {
            const rect = button.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            button.style.setProperty('--x-pos', `${x}px`);
            button.style.setProperty('--y-pos', `${y}px`);
        });
    });
    
    // 3D эффект для карточек
    document.querySelectorAll('.service-card, .advantage-card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = (y - centerY) / 20;
            const rotateY = (centerX - x) / 20;
            
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
            card.style.transition = 'transform 0.1s ease';
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale3d(1, 1, 1)';
            card.style.transition = 'transform 0.5s ease';
        });
    });
}

/**
 * Анимированный нейронный фон
 */
function initNeuralBackground() {
    const neuralBg = document.querySelector('.neural-bg');
    
    if (!neuralBg) return;
    
    // Создаем эффект движения фона
    window.addEventListener('mousemove', (e) => {
        const mouseX = e.clientX / window.innerWidth;
        const mouseY = e.clientY / window.innerHeight;
        
        neuralBg.style.transform = `translate(${mouseX * -20}px, ${mouseY * -20}px)`;
    });
}

/**
 * Плавная прокрутка к якорям
 */
function initSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (!targetElement) return;
            
            window.scrollTo({
                top: targetElement.offsetTop - 80, // Учитываем высоту шапки
                behavior: 'smooth'
            });
        });
    });
}

/**
 * Анимации текста
 */
function initTextAnimations() {
    // Анимация градиентного текста
    document.querySelectorAll('.text-gradient').forEach(element => {
        element.style.backgroundSize = '200% auto';
        element.style.animation = 'gradient-shift 3s linear infinite alternate';
    });
    
    // Добавляем стили для анимации
    const style = document.createElement('style');
    style.textContent = `
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }
        
        .animation-fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        
        .animation-fade-up.animated {
            opacity: 1;
            transform: translateY(0);
        }
        
        .animation-fade-in {
            opacity: 0;
            transition: opacity 0.8s ease;
        }
        
        .animation-fade-in.animated {
            opacity: 1;
        }
        
        .animation-scale-up {
            opacity: 0;
            transform: scale(0.8);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        
        .animation-scale-up.animated {
            opacity: 1;
            transform: scale(1);
        }
    `;
    document.head.appendChild(style);
    
    // Добавляем классы анимации к элементам на странице
    document.querySelectorAll('.advantage-card, .service-card').forEach((element, index) => {
        element.classList.add('animate-on-scroll');
        element.setAttribute('data-animation', 'fade-up');
        element.setAttribute('data-delay', (0.1 * index).toString());
    });
    
    document.querySelectorAll('.process-item').forEach((element, index) => {
        element.classList.add('animate-on-scroll');
        element.setAttribute('data-animation', 'fade-up');
        element.setAttribute('data-delay', (0.2 * index).toString());
    });
    
    document.querySelectorAll('.cta-card').forEach(element => {
        element.classList.add('animate-on-scroll');
        element.setAttribute('data-animation', 'scale-up');
    });
} 