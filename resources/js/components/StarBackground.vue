<template>
  <div class="stars-container" ref="starsContainer"></div>
</template>

<script>
import { ref, onMounted, onUnmounted } from 'vue';
import { gsap } from 'gsap';

export default {
  name: 'StarBackground',
  props: {
    starCount: {
      type: Number,
      default: 200
    },
    starSize: {
      type: Object,
      default: () => ({ min: 1, max: 3 })
    },
    parallaxIntensity: {
      type: Number,
      default: 0.05
    }
  },
  setup(props) {
    const starsContainer = ref(null);
    const stars = ref([]);
    let width = window.innerWidth;
    let height = window.innerHeight;
    let mouseX = 0;
    let mouseY = 0;
    
    // Получение случайного числа в диапазоне
    const getRandomInRange = (min, max) => {
      return Math.random() * (max - min) + min;
    };
    
    // Создание звезд
    const createStars = () => {
      if (!starsContainer.value) return;
      
      // Очищаем контейнер
      starsContainer.value.innerHTML = '';
      stars.value = [];
      
      // Создаем новые звезды
      for (let i = 0; i < props.starCount; i++) {
        const star = document.createElement('div');
        star.className = 'star';
        
        // Случайные параметры для звезды
        const size = getRandomInRange(props.starSize.min, props.starSize.max);
        const depth = getRandomInRange(1, 3);
        const x = getRandomInRange(0, width);
        const y = getRandomInRange(0, height);
        const opacity = getRandomInRange(0.1, 1);
        
        // Настраиваем стили звезды
        star.style.width = `${size}px`;
        star.style.height = `${size}px`;
        star.style.left = `${x}px`;
        star.style.top = `${y}px`;
        star.style.opacity = '0'; // Начинаем с прозрачности 0 для плавного появления
        
        // Добавляем звезду в контейнер
        starsContainer.value.appendChild(star);
        
        // Сохраняем данные о звезде
        stars.value.push({
          element: star,
          x,
          y,
          size,
          depth,
          initialX: x,
          initialY: y,
          speed: 0.5 / depth,
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
    };
    
    // Анимация звезд
    const animate = () => {
      // Анимируем каждую звезду
      stars.value.forEach((star, index) => {
        // Параллакс-эффект на основе положения мыши
        const parallaxX = (mouseX - width / 2) * (star.depth * props.parallaxIntensity);
        const parallaxY = (mouseY - height / 2) * (star.depth * props.parallaxIntensity);
        
        // Анимация мерцания с разной скоростью для разных звезд
        gsap.to(star.element, {
          opacity: getRandomInRange(star.opacity * 0.5, star.opacity),
          duration: getRandomInRange(1, 3),
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
          y: `+=${getRandomInRange(-15, 15)}`,
          x: `+=${getRandomInRange(-15, 15)}`,
          duration: 10 + star.depth * 5,
          repeat: -1,
          yoyo: true,
          ease: 'sine.inOut'
        });
      });
    };
    
    // Обработчик изменения размера окна
    const handleResize = () => {
      width = window.innerWidth;
      height = window.innerHeight;
      createStars();
    };
    
    // Обработчик движения мыши
    const handleMouseMove = (event) => {
      gsap.to({
        mouseX,
        mouseY
      }, {
        mouseX: event.clientX,
        mouseY: event.clientY,
        duration: 0.5,
        ease: 'power1.out',
        onUpdate: () => {
          mouseX = event.clientX;
          mouseY = event.clientY;
        }
      });
    };
    
    onMounted(() => {
      createStars();
      animate();
      
      window.addEventListener('resize', handleResize);
      window.addEventListener('mousemove', handleMouseMove);
    });
    
    onUnmounted(() => {
      window.removeEventListener('resize', handleResize);
      window.removeEventListener('mousemove', handleMouseMove);
      
      // Очищаем анимации GSAP
      stars.value.forEach(star => {
        gsap.killTweensOf(star.element);
      });
    });
    
    return {
      starsContainer
    };
  }
};
</script>

<style scoped>
.stars-container {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: -10;
  overflow: hidden;
  pointer-events: none;
  background: radial-gradient(ellipse at center, rgba(20, 20, 40, 0.4) 0%, rgba(10, 10, 25, 0.8) 100%);
}

.star {
  position: absolute;
  background: white;
  border-radius: 50%;
  opacity: 0;
  transform: translateZ(0);
  box-shadow: 0 0 4px rgba(255, 255, 255, 0.8);
  will-change: transform, opacity;
}
</style> 