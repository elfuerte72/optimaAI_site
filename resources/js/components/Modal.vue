<template>
  <transition name="modal-fade">
    <div v-if="show" class="modal-overlay" @click.self="closeModal">
      <div class="modal-container" ref="modalContainer">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">{{ title }}</h3>
            <button class="modal-close-btn" @click="closeModal">
              <i class="bi bi-x-lg"></i>
            </button>
          </div>
          <div class="modal-body">
            <slot></slot>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
import { ref, watch, onMounted } from 'vue';
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
    
    const closeModal = () => {
      emit('close');
    };

    // Блокировка прокрутки страницы при открытии модального окна
    watch(() => props.show, (newVal) => {
      if (newVal) {
        document.body.style.overflow = 'hidden';
        
        // Анимация появления модального окна
        if (modalContainer.value) {
          gsap.fromTo(modalContainer.value, 
            { scale: 0.9, opacity: 0 },
            { 
              scale: 1, 
              opacity: 1, 
              duration: 0.4, 
              ease: 'back.out(1.7)',
              clearProps: 'all'
            }
          );
          
          // Анимация заголовка и содержимого
          const modalTitle = modalContainer.value.querySelector('.modal-title');
          const modalBody = modalContainer.value.querySelector('.modal-body');
          
          if (modalTitle) {
            gsap.fromTo(modalTitle,
              { opacity: 0, y: -20 },
              { opacity: 1, y: 0, duration: 0.5, delay: 0.2 }
            );
          }
          
          if (modalBody) {
            gsap.fromTo(modalBody,
              { opacity: 0, y: 20 },
              { opacity: 1, y: 0, duration: 0.5, delay: 0.3 }
            );
          }
        }
      } else {
        document.body.style.overflow = '';
      }
    });

    return {
      closeModal,
      modalContainer
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
  background: rgba(0, 0, 0, 0.75);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
  backdrop-filter: blur(5px);
}

.modal-container {
  width: 90%;
  max-width: 600px;
  max-height: 90vh;
  background: rgba(20, 25, 45, 0.95);
  border: 1px solid rgba(185, 53, 255, 0.3);
  border-radius: 0.75rem;
  box-shadow: 0 0 30px rgba(185, 53, 255, 0.5);
  overflow: hidden;
  transform-style: preserve-3d;
  perspective: 1000px;
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
  border-bottom: 1px solid rgba(185, 53, 255, 0.2);
}

.modal-title {
  margin: 0;
  font-size: 1.5rem;
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
  transition: color 0.3s ease;
  padding: 0.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal-close-btn:hover {
  color: var(--neon-purple, #a78bfa);
}

.modal-body {
  padding: 1.5rem;
  overflow-y: auto;
  max-height: calc(90vh - 5rem);
}

/* Анимации */
.modal-fade-enter-active,
.modal-fade-leave-active {
  transition: all 0.3s ease;
}

.modal-fade-enter-from {
  opacity: 0;
}

.modal-fade-leave-to {
  opacity: 0;
}
</style> 