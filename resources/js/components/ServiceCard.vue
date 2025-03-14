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
        <button 
          class="details-button" 
          ref="detailsBtn"
          @mouseenter="onButtonEnter"
          @mouseleave="onButtonLeave"
          @click="onDetailsClick"
        >
          <span class="btn-text"><slot name="link-text">Подробнее</slot></span>
          <span class="btn-icon"><i class="bi bi-arrow-right ms-2"></i></span>
          <span class="btn-shine"></span>
        </button>
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
    delay: {
      type: Number,
      default: 0
    }
  },
  emits: ['click-details'],
  setup(props, { emit }) {
    const card = ref(null);
    const cardInner = ref(null);
    const icon = ref(null);
    const title = ref(null);
    const text = ref(null);
    const detailsBtn = ref(null);
    
    // Обработчик клика по кнопке "Подробнее"
    const onDetailsClick = () => {
      // Анимация нажатия
      gsap.to(detailsBtn.value, {
        scale: 0.95,
        duration: 0.1,
        onComplete: () => {
          gsap.to(detailsBtn.value, {
            scale: 1,
            duration: 0.2,
            ease: 'back.out(2)'
          });
        }
      });
      
      // Анимация свечения при клике
      const btnShine = detailsBtn.value.querySelector('.btn-shine');
      if (btnShine) {
        gsap.fromTo(btnShine,
          { opacity: 0.8, scale: 0 },
          { 
            opacity: 0, 
            scale: 1.5, 
            duration: 0.5,
            ease: 'power2.out'
          }
        );
      }
      
      // Вызываем событие для открытия модального окна
      emit('click-details');
    };
    
    // Анимация при наведении на кнопку
    const onButtonEnter = () => {
      gsap.to(detailsBtn.value, {
        backgroundColor: 'rgba(185, 53, 255, 0.8)',
        boxShadow: '0 0 15px rgba(185, 53, 255, 0.7), 0 0 30px rgba(185, 53, 255, 0.4)',
        scale: 1.05,
        duration: 0.3,
        ease: 'power2.out'
      });
      
      // Анимация стрелки
      const arrow = detailsBtn.value.querySelector('.btn-icon');
      if (arrow) {
        gsap.to(arrow, {
          x: 5,
          duration: 0.3,
          ease: 'power2.out'
        });
      }
      
      // Анимация текста
      const btnText = detailsBtn.value.querySelector('.btn-text');
      if (btnText) {
        gsap.to(btnText, {
          fontWeight: 600,
          duration: 0.3
        });
      }
    };
    
    // Возврат кнопки в исходное состояние
    const onButtonLeave = () => {
      gsap.to(detailsBtn.value, {
        backgroundColor: 'rgba(99, 102, 241, 0.2)',
        boxShadow: '0 0 0 rgba(185, 53, 255, 0)',
        scale: 1,
        duration: 0.3,
        ease: 'power2.out'
      });
      
      // Возвращаем стрелку
      const arrow = detailsBtn.value.querySelector('.btn-icon');
      if (arrow) {
        gsap.to(arrow, {
          x: 0,
          duration: 0.3,
          ease: 'power2.out'
        });
      }
      
      // Возвращаем текст
      const btnText = detailsBtn.value.querySelector('.btn-text');
      if (btnText) {
        gsap.to(btnText, {
          fontWeight: 500,
          duration: 0.3
        });
      }
    };
    
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
      
      if (detailsBtn.value) {
        gsap.set(detailsBtn.value, { opacity: 0, y: 10 });
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
      
      if (detailsBtn.value) {
        tl.to(detailsBtn.value, {
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
      detailsBtn,
      onMouseEnter,
      onMouseLeave,
      onMouseMove,
      onButtonEnter,
      onButtonLeave,
      onDetailsClick
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
  margin: 0 auto 1.5rem;
  transition: all 0.3s ease;
}

.card-title {
  font-weight: 600;
  margin-bottom: 1rem;
  color: #fff;
}

.card-text {
  color: rgba(255, 255, 255, 0.7);
  margin-bottom: 1.5rem;
  line-height: 1.6;
}

.details-button {
  display: inline-flex;
  align-items: center;
  background-color: rgba(99, 102, 241, 0.2);
  color: #fff;
  border: none;
  padding: 0.5rem 1.25rem;
  border-radius: 2rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
  z-index: 1;
  will-change: transform, box-shadow, background-color;
}

.details-button::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, rgba(99, 102, 241, 0.5), rgba(185, 53, 255, 0.5));
  z-index: -1;
  transform: scaleX(0);
  transform-origin: right;
  transition: transform 0.5s ease;
}

.details-button:hover::before {
  transform: scaleX(1);
  transform-origin: left;
}

.btn-icon {
  display: inline-block;
  transition: transform 0.3s ease;
}

.btn-text {
  position: relative;
  z-index: 2;
}

.btn-shine {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) scale(0);
  width: 100%;
  height: 100%;
  background: radial-gradient(circle, rgba(255, 255, 255, 0.8) 0%, transparent 70%);
  border-radius: 50%;
  opacity: 0;
  z-index: 0;
  pointer-events: none;
}

.animated-icon {
  animation: float 3s ease-in-out infinite;
}

@keyframes float {
  0% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-10px);
  }
  100% {
    transform: translateY(0);
  }
}
</style> 