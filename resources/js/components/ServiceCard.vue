<template>
  <div class="service-card-wrapper">
    <div 
      class="service-card h-100" 
      ref="card"
      @mouseenter="onMouseEnter"
      @mouseleave="onMouseLeave"
      @mousemove="onMouseMove"
    >
      <div class="service-card-inner" ref="cardInner">
        <div class="service-icon-wrapper animated-icon" ref="icon">
          <slot name="icon"></slot>
        </div>
        <h3 class="card-title h5 mb-3" ref="title">
          <slot name="title"></slot>
        </h3>
        <p class="card-text mb-4" ref="text">
          <slot name="text"></slot>
        </p>
        <a :href="link" class="interactive-element" ref="link">
          <slot name="link-text">Подробнее</slot> <i class="bi bi-arrow-right ms-2"></i>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { gsap } from 'gsap';

export default {
  name: 'ServiceCard',
  props: {
    link: {
      type: String,
      required: true
    },
    delay: {
      type: Number,
      default: 0
    }
  },
  setup(props) {
    const card = ref(null);
    const cardInner = ref(null);
    const icon = ref(null);
    const title = ref(null);
    const text = ref(null);
    const link = ref(null);
    
    const onMouseEnter = () => {
      gsap.to(card.value, {
        y: -10,
        boxShadow: '0 15px 30px rgba(0, 0, 0, 0.2), 0 0 15px rgba(185, 53, 255, 0.7)',
        borderColor: 'rgba(185, 53, 255, 0.7)',
        duration: 0.3,
        ease: 'power2.out'
      });
      
      if (icon.value) {
        gsap.to(icon.value, {
          scale: 1.1,
          filter: 'drop-shadow(0 0 10px rgba(185, 53, 255, 0.7))',
          duration: 0.3
        });
      }
    };
    
    const onMouseLeave = () => {
      gsap.to(card.value, {
        y: 0,
        boxShadow: '0 5px 15px rgba(0, 0, 0, 0.1)',
        borderColor: 'rgba(255, 255, 255, 0.05)',
        duration: 0.3,
        ease: 'power2.out'
      });
      
      gsap.to(cardInner.value, {
        rotateX: 0,
        rotateY: 0,
        duration: 0.5,
        ease: 'power2.out'
      });
      
      // Возвращаем исходный фон
      if (card.value) {
        card.value.style.background = 'rgba(20, 20, 40, 0.7)';
      }
      
      if (icon.value) {
        gsap.to(icon.value, {
          scale: 1,
          filter: 'none',
          duration: 0.3
        });
      }
    };
    
    const onMouseMove = (e) => {
      if (!card.value || !cardInner.value) return;
      
      const cardRect = card.value.getBoundingClientRect();
      const cardCenterX = cardRect.left + cardRect.width / 2;
      const cardCenterY = cardRect.top + cardRect.height / 2;
      
      // Вычисляем положение курсора относительно центра карточки
      const mouseX = e.clientX - cardCenterX;
      const mouseY = e.clientY - cardCenterY;
      
      // Нормализуем значения от -1 до 1
      const rotateX = mouseY / (cardRect.height / 2) * -10; // Инвертируем ось Y
      const rotateY = mouseX / (cardRect.width / 2) * 10;
      
      // Применяем 3D-трансформацию
      gsap.to(cardInner.value, {
        rotateX: rotateX,
        rotateY: rotateY,
        transformPerspective: 1000,
        duration: 0.3,
        ease: 'power2.out'
      });
      
      // Добавляем эффект свечения в направлении курсора
      const gradientX = (e.clientX - cardRect.left) / cardRect.width * 100;
      const gradientY = (e.clientY - cardRect.top) / cardRect.height * 100;
      
      card.value.style.background = `radial-gradient(circle at ${gradientX}% ${gradientY}%, rgba(99, 102, 241, 0.3), rgba(20, 20, 40, 0.7) 70%)`;
    };
    
    onMounted(() => {
      // Начальное состояние
      gsap.set(card.value, { 
        y: 50, 
        opacity: 0,
        boxShadow: '0 5px 15px rgba(0, 0, 0, 0.1)',
        borderColor: 'rgba(255, 255, 255, 0.05)'
      });
      
      if (icon.value) {
        gsap.set(icon.value, { opacity: 0, scale: 0.5 });
      }
      
      if (title.value) {
        gsap.set(title.value, { opacity: 0, x: -20 });
      }
      
      if (text.value) {
        gsap.set(text.value, { opacity: 0 });
      }
      
      if (link.value) {
        gsap.set(link.value, { opacity: 0, y: 10 });
      }
      
      // Анимация появления
      const tl = gsap.timeline({ delay: props.delay });
      
      tl.to(card.value, { 
        y: 0, 
        opacity: 1, 
        duration: 0.8, 
        ease: 'power2.out' 
      });
      
      if (icon.value) {
        tl.to(icon.value, {
          opacity: 1,
          scale: 1,
          duration: 0.6,
          ease: 'back.out(1.7)'
        }, '-=0.6');
        
        // Постоянная анимация для иконки
        gsap.to(icon.value, {
          y: 10,
          duration: 2,
          repeat: -1,
          yoyo: true,
          ease: 'sine.inOut'
        });
      }
      
      if (title.value) {
        tl.to(title.value, {
          opacity: 1,
          x: 0,
          duration: 0.6,
          ease: 'power2.out'
        }, '-=0.4');
      }
      
      if (text.value) {
        tl.to(text.value, {
          opacity: 1,
          duration: 0.6,
          ease: 'power2.out'
        }, '-=0.4');
      }
      
      if (link.value) {
        tl.to(link.value, {
          opacity: 1,
          y: 0,
          duration: 0.6,
          ease: 'power2.out'
        }, '-=0.2');
      }
    });
    
    return {
      card,
      cardInner,
      icon,
      title,
      text,
      link,
      onMouseEnter,
      onMouseLeave,
      onMouseMove
    };
  }
};
</script>

<style scoped>
.service-card-wrapper {
  perspective: 1000px;
}

.service-card {
  position: relative;
  background: rgba(20, 20, 40, 0.7);
  border: 1px solid rgba(255, 255, 255, 0.05);
  border-radius: var(--border-radius-md, 0.5rem);
  padding: 2rem;
  transition: all 0.4s ease;
  overflow: hidden;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  will-change: transform, box-shadow;
  transform-style: preserve-3d;
}

.service-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  transform-style: preserve-3d;
  transition: transform 0.3s ease;
}

.service-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: radial-gradient(circle at center, rgba(185, 53, 255, 0.1) 0%, transparent 70%);
  opacity: 0;
  transition: opacity 0.4s ease;
  z-index: -1;
}

.service-card:hover::before {
  opacity: 1;
}

.service-icon-wrapper {
  width: 80px;
  height: 80px;
  margin-bottom: 1.5rem;
  transition: transform 0.3s ease;
  transform-style: preserve-3d;
  transform: translateZ(20px);
}

.card-title, .card-text {
  transform-style: preserve-3d;
  transform: translateZ(10px);
}

.interactive-element {
  position: relative;
  display: inline-flex;
  align-items: center;
  color: var(--color-text, #fff);
  text-decoration: none;
  transition: color 0.3s ease;
  transform-style: preserve-3d;
  transform: translateZ(15px);
}

.interactive-element:hover {
  color: var(--neon-purple, #b935ff);
}

.interactive-element i {
  transition: transform 0.3s ease;
}

.interactive-element:hover i {
  transform: translateX(5px);
}
</style> 