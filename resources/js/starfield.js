/**
 * StarField - Футуристическая анимация звездного фона с параллакс-эффектом
 * OptimAI 2030 Edition
 */

import { gsap } from 'gsap';

class StarField {
  constructor(options = {}) {
    this.options = {
      container: '.stars-container',
      starCount: 200,
      starSize: { min: 1, max: 3 },
      starColor: { r: 255, g: 255, b: 255 },
      depth: 3,
      speed: 0.5,
      parallaxIntensity: 0.05,
      ...options
    };
    
    this.container = document.querySelector(this.options.container);
    this.stars = [];
    this.width = window.innerWidth;
    this.height = window.innerHeight;
    this.mouseX = 0;
    this.mouseY = 0;
    
    if (!this.container) {
      console.warn('StarField: Container not found');
      return;
    }
    
    this.init();
  }
  
  init() {
    // Создаем звезды
    this.createStars();
    
    // Добавляем обработчики событий
    window.addEventListener('resize', this.handleResize.bind(this));
    window.addEventListener('mousemove', this.handleMouseMove.bind(this));
    
    // Запускаем анимацию
    this.animate();
  }
  
  createStars() {
    // Очищаем контейнер
    this.container.innerHTML = '';
    this.stars = [];
    
    // Создаем новые звезды
    for (let i = 0; i < this.options.starCount; i++) {
      const star = document.createElement('div');
      star.className = 'star';
      
      // Случайные параметры для звезды
      const size = this.getRandomInRange(this.options.starSize.min, this.options.starSize.max);
      const depth = this.getRandomInRange(1, this.options.depth);
      const x = this.getRandomInRange(0, this.width);
      const y = this.getRandomInRange(0, this.height);
      const opacity = this.getRandomInRange(0.1, 1);
      
      // Настраиваем стили звезды
      star.style.width = `${size}px`;
      star.style.height = `${size}px`;
      star.style.left = `${x}px`;
      star.style.top = `${y}px`;
      star.style.opacity = '0'; // Начинаем с прозрачности 0 для плавного появления
      
      // Добавляем звезду в контейнер
      this.container.appendChild(star);
      
      // Сохраняем данные о звезде
      this.stars.push({
        element: star,
        x,
        y,
        size,
        depth,
        initialX: x,
        initialY: y,
        speed: this.options.speed / depth,
        opacity
      });
      
      // Анимируем появление звезды с задержкой
      gsap.to(star, {
        opacity,
        duration: 2,
        delay: i * 0.01,
        ease: 'power2.inOut'
      });
    }
  }
  
  animate() {
    // Анимируем каждую звезду
    this.stars.forEach((star, index) => {
      // Параллакс-эффект на основе положения мыши
      const parallaxX = (this.mouseX - this.width / 2) * (star.depth * this.options.parallaxIntensity);
      const parallaxY = (this.mouseY - this.height / 2) * (star.depth * this.options.parallaxIntensity);
      
      // Анимация мерцания с разной скоростью для разных звезд
      gsap.to(star.element, {
        opacity: this.getRandomInRange(star.opacity * 0.5, star.opacity),
        duration: this.getRandomInRange(1, 3),
        repeat: -1,
        yoyo: true,
        ease: 'sine.inOut',
        delay: index * 0.01 % 1 // Разные задержки для более естественного эффекта
      });
      
      // Анимация движения с параллаксом
      gsap.to(star.element, {
        x: parallaxX,
        y: parallaxY,
        duration: 1.5 - (star.depth * 0.3), // Звезды на разной глубине двигаются с разной скоростью
        ease: 'power1.out'
      });
      
      // Добавляем легкое движение звезд для создания эффекта космоса
      gsap.to(star.element, {
        y: `+=${this.getRandomInRange(-15, 15)}`,
        x: `+=${this.getRandomInRange(-15, 15)}`,
        duration: 10 + star.depth * 5,
        repeat: -1,
        yoyo: true,
        ease: 'sine.inOut'
      });
    });
  }
  
  handleResize() {
    // Обновляем размеры
    this.width = window.innerWidth;
    this.height = window.innerHeight;
    
    // Пересоздаем звезды
    this.createStars();
  }
  
  handleMouseMove(event) {
    // Обновляем положение мыши с плавным переходом
    gsap.to(this, {
      mouseX: event.clientX,
      mouseY: event.clientY,
      duration: 0.5,
      ease: 'power1.out'
    });
  }
  
  getRandomInRange(min, max) {
    return Math.random() * (max - min) + min;
  }
}

// Экспортируем класс
export default StarField; 