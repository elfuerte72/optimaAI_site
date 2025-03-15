<template>
  <transition name="modal-fade">
    <div v-if="show" class="modal-overlay" @click.self="closeModal" ref="modalOverlay">
      <transition name="modal-slide">
        <div class="modal-container" ref="modalContainer" v-if="show">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title">{{ title }}</h2>
              <button class="modal-close-btn" @click="closeModal" aria-label="Close">
                <i class="bi bi-x-lg"></i>
              </button>
            </div>
            <div class="modal-body">
              <slot></slot>
            </div>
          </div>
        </div>
      </transition>
    </div>
  </transition>
</template>

<script>
import { ref, watch, onMounted, onBeforeUnmount } from 'vue';
import { gsap } from 'gsap';

export default {
  name: 'Modal',
  props: {
    show: {
      type: Boolean,
      default: false
    },
    title: {
      type: String,
      required: true
    }
  },
  emits: ['close'],
  setup(props, { emit }) {
    const modalContainer = ref(null);
    const modalOverlay = ref(null);
    
    const closeModal = () => {
      emit('close');
    };

    // Обработчик нажатия клавиши Esc для закрытия модального окна
    const handleKeyDown = (e) => {
      if (e.key === 'Escape' && props.show) {
        closeModal();
      }
    };

    // Анимация появления модального окна и его содержимого
    const animateModalContent = () => {
      if (!modalContainer.value) return;
      
      // Создаем временную шкалу для последовательной анимации
      const tl = gsap.timeline({ defaults: { ease: 'power2.out' } });
      
      // Анимация фона (оверлея)
      if (modalOverlay.value) {
        tl.fromTo(modalOverlay.value,
          { backdropFilter: 'blur(0px)', background: 'rgba(0, 0, 0, 0)' },
          { backdropFilter: 'blur(5px)', background: 'rgba(0, 0, 0, 0.75)', duration: 0.4 }
        );
      }
      
      // Анимация контейнера
      tl.fromTo(modalContainer.value, 
        { y: -20, opacity: 0 },
        { 
          y: 0, 
          opacity: 1, 
          duration: 0.4, 
          ease: 'power3.out'
        },
        '-=0.2'
      );
      
      // Анимация заголовка
      const modalTitle = modalContainer.value.querySelector('.modal-title');
      if (modalTitle) {
        tl.fromTo(modalTitle,
          { opacity: 0, y: -20 },
          { opacity: 1, y: 0, duration: 0.5 },
          '-=0.2' // Начинаем немного раньше, чем закончится предыдущая анимация
        );
      }
      
      // Анимация кнопки закрытия
      const closeBtn = modalContainer.value.querySelector('.modal-close-btn');
      if (closeBtn) {
        tl.fromTo(closeBtn,
          { opacity: 0, rotate: -90 },
          { opacity: 1, rotate: 0, duration: 0.4 },
          '-=0.4'
        );
      }
      
      // Анимация содержимого
      const modalBody = modalContainer.value.querySelector('.modal-body');
      if (modalBody) {
        tl.fromTo(modalBody,
          { opacity: 0, y: 20 },
          { opacity: 1, y: 0, duration: 0.5 },
          '-=0.2'
        );
      }
      
      // Добавляем пульсацию границы модального окна
      tl.fromTo(modalContainer.value,
        { boxShadow: '0 0 0 rgba(185, 53, 255, 0)' },
        { 
          boxShadow: '0 0 30px rgba(185, 53, 255, 0.5)', 
          duration: 0.8,
          ease: 'power1.inOut'
        },
        '-=0.4'
      );
    };

    // Блокировка прокрутки страницы при открытии модального окна
    watch(() => props.show, (newVal) => {
      if (newVal) {
        document.body.style.overflow = 'hidden';
        document.addEventListener('keydown', handleKeyDown);
        
        // Запускаем анимацию появления модального окна
        setTimeout(() => {
          animateModalContent();
        }, 50); // Небольшая задержка для гарантии, что DOM обновился
      } else {
        document.body.style.overflow = '';
        document.removeEventListener('keydown', handleKeyDown);
      }
    });

    onBeforeUnmount(() => {
      document.removeEventListener('keydown', handleKeyDown);
    });

    return {
      closeModal,
      modalContainer,
      modalOverlay
    };
  }
};
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: var(--modal-overlay-bg, rgba(0, 0, 0, 0.75));
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
  backdrop-filter: blur(5px);
  transition: backdrop-filter 0.4s ease;
}

.modal-container {
  width: 90%;
  max-width: 600px;
  max-height: 80vh;
  background: var(--modal-content-bg, rgba(20, 25, 45, 0.95));
  border: 1px solid var(--modal-border-color, rgba(185, 53, 255, 0.3));
  border-radius: var(--border-radius-lg, 0.75rem);
  box-shadow: var(--modal-shadow, 0 0 30px rgba(185, 53, 255, 0.5));
  overflow: hidden;
  transform-style: preserve-3d;
  perspective: 1000px;
  will-change: transform, opacity;
}

.modal-content {
  display: flex;
  flex-direction: column;
  height: 100%;
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.5rem;
  border-bottom: 1px solid var(--modal-border-color, rgba(185, 53, 255, 0.2));
}

.modal-title {
  margin: 0;
  font-size: 1.5rem;
  font-family: var(--font-secondary, 'Roboto', sans-serif);
  background: linear-gradient(90deg, var(--neon-purple, #a78bfa), var(--neon-blue, #60a5fa));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  text-fill-color: transparent;
}

.modal-close-btn {
  background: transparent;
  border: none;
  color: rgba(255, 255, 255, 0.7);
  font-size: 1.25rem;
  cursor: pointer;
  transition: all var(--transition-normal, 0.3s) ease;
  padding: 0.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  width: 40px;
  height: 40px;
}

.modal-close-btn:hover {
  color: #fff;
  background-color: rgba(185, 53, 255, 0.2);
  transform: rotate(90deg);
}

.modal-body {
  padding: 1.5rem;
  overflow-y: auto;
  max-height: calc(80vh - 5rem);
  font-family: var(--font-secondary, 'Roboto', sans-serif);
}

/* Анимации */
.modal-fade-enter-active,
.modal-fade-leave-active {
  transition: opacity var(--transition-normal, 0.3s) ease;
}

.modal-fade-enter-from,
.modal-fade-leave-to {
  opacity: 0;
}

.modal-slide-enter-active,
.modal-slide-leave-active {
  transition: all var(--transition-normal, 0.3s) ease;
}

.modal-slide-enter-from,
.modal-slide-leave-to {
  opacity: 0;
  transform: translateY(-20px);
}

/* Адаптивность для мобильных устройств */
@media (max-width: 600px) {
  .modal-container {
    width: 95%;
    max-height: 90vh;
  }
  
  .modal-header {
    padding: 1rem;
  }
  
  .modal-body {
    padding: 1rem;
    max-height: calc(90vh - 4rem);
  }
  
  .modal-title {
    font-size: 1.3rem;
  }
}
</style> 