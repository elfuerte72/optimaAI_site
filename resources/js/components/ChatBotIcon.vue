<template>
  <div class="chatbot-icon-container">
    <!-- Chatbot Icon with hover effect -->
    <div 
      class="chatbot-icon" 
      ref="chatbotIcon"
      @mouseenter="handleHover" 
      @mouseleave="handleMouseLeave"
      @click="toggleModal"
    >
      <div class="icon-inner">
        <i class="bi bi-robot"></i>
      </div>
      <div class="icon-pulse"></div>
    </div>

    <!-- Full-screen Modal -->
    <transition name="modal-fade">
      <div v-if="isModalOpen" class="chatbot-modal-fullscreen">
        <div class="modal-content">
          <!-- Modal Header with close button -->
          <div class="modal-header">
            <h3>Виртуальный ассистент OptimAI</h3>
            <button class="close-button" @click="closeModal">
              <i class="bi bi-x-lg"></i>
            </button>
          </div>

          <!-- Modal Body with chat interface -->
          <div class="modal-body">
            <chat-bot v-if="isModalOpen" :start-in-modal="true" ref="chatBotComponent" />
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, nextTick } from 'vue';
import { useGSAP } from './composables/useGSAP';

// Refs
const chatbotIcon = ref(null);
const chatBotComponent = ref(null);
const isModalOpen = ref(false);
const isHovering = ref(false);
const gsap = ref(null);

// Load GSAP
const { loadGSAP } = useGSAP();

// Initialize animations
onMounted(async () => {
  // Load GSAP
  gsap.value = await loadGSAP();
  
  // Initial animation for the icon
  if (gsap.value) {
    gsap.value.to(chatbotIcon.value, {
      scale: 1,
      opacity: 1,
      duration: 0.5,
      ease: 'back.out(1.7)'
    });
  }
  
  // Add event listener for escape key to close modal
  document.addEventListener('keydown', handleKeyDown);
});

onUnmounted(() => {
  document.removeEventListener('keydown', handleKeyDown);
});

// Handle hover effect
const handleHover = () => {
  isHovering.value = true;
  
  if (gsap.value) {
    // Stop any ongoing animations
    gsap.value.killTweensOf(chatbotIcon.value);
    
    // Hover animation
    gsap.value.to(chatbotIcon.value, {
      scale: 1.1,
      duration: 0.3,
      ease: 'power2.out',
      boxShadow: '0 0 20px rgba(138, 43, 226, 0.8)'
    });
    
    // Pulse animation for the background
    gsap.value.to('.icon-pulse', {
      scale: 1.5,
      opacity: 0,
      duration: 1,
      repeat: -1,
      ease: 'power2.out'
    });
  }
};

// Handle mouse leave
const handleMouseLeave = () => {
  isHovering.value = false;
  
  if (!isModalOpen.value && gsap.value) {
    // Return to normal state
    gsap.value.to(chatbotIcon.value, {
      scale: 1,
      duration: 0.3,
      ease: 'power2.out',
      boxShadow: '0 0 10px rgba(138, 43, 226, 0.5)'
    });
    
    // Stop pulse animation
    gsap.value.killTweensOf('.icon-pulse');
    gsap.value.to('.icon-pulse', {
      scale: 1,
      opacity: 0.5,
      duration: 0.3
    });
  }
};

// Toggle modal
const toggleModal = () => {
  isModalOpen.value = !isModalOpen.value;
  
  if (isModalOpen.value) {
    // Disable body scroll when modal is open
    document.body.style.overflow = 'hidden';
    
    // Инициализируем чат после открытия модального окна
    nextTick(() => {
      if (chatBotComponent.value) {
        // Если есть метод инициализации в компоненте чата, вызываем его
        if (typeof chatBotComponent.value.initializeChat === 'function') {
          chatBotComponent.value.initializeChat();
        }
      }
    });
  } else {
    // Re-enable body scroll when modal is closed
    document.body.style.overflow = '';
    handleMouseLeave();
  }
};

// Close modal
const closeModal = () => {
  isModalOpen.value = false;
  document.body.style.overflow = '';
  handleMouseLeave();
};

// Handle escape key press
const handleKeyDown = (e) => {
  if (e.key === 'Escape' && isModalOpen.value) {
    closeModal();
  }
};
</script>

<style scoped>
.chatbot-icon-container {
  position: fixed;
  bottom: 30px;
  right: 30px;
  z-index: 999;
}

.chatbot-icon {
  position: relative;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background: linear-gradient(135deg, #4B0082, #8A2BE2);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 0 0 10px rgba(138, 43, 226, 0.5);
  transform: scale(0.9);
  opacity: 0.9;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.icon-inner {
  position: relative;
  z-index: 2;
  color: white;
  font-size: 24px;
}

.icon-pulse {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border-radius: 50%;
  background: linear-gradient(135deg, #4B0082, #8A2BE2);
  opacity: 0.5;
  z-index: 1;
}

/* Modal styles */
.chatbot-modal-fullscreen {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.8);
  backdrop-filter: blur(5px);
  z-index: 1000;
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal-content {
  width: 90%;
  max-width: 1200px;
  height: 90vh;
  background: linear-gradient(135deg, #2D0845, #4B0082);
  border-radius: 16px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  box-shadow: 0 0 30px rgba(138, 43, 226, 0.8), 
              0 0 60px rgba(138, 43, 226, 0.4);
  border: 1px solid rgba(255, 255, 255, 0.1);
}

/* Переопределяем стили для чат-бота внутри нашего модального окна */
:deep(.chatbot-container) {
  position: static;
  width: 100%;
  height: 100%;
}

:deep(.chatbot-button) {
  display: none; /* Скрываем кнопку чат-бота внутри модального окна */
}

:deep(.chatbot-window) {
  position: static;
  width: 100%;
  height: 100%;
  box-shadow: none;
  border-radius: 0;
  max-height: none;
  transform: none !important;
  display: flex;
  flex-direction: column;
}

:deep(.chatbot-header) {
  display: none; /* Скрываем заголовок чат-бота внутри модального окна */
}

:deep(.chatbot-body) {
  max-height: none;
  height: 100%;
  padding-top: 20px; /* Добавляем отступ сверху, так как заголовок скрыт */
}

:deep(.chatbot-content) {
  flex: 1;
  display: flex;
  flex-direction: column;
  height: 100%; /* Обеспечиваем полную высоту */
}

:deep(.chatbot-footer) {
  background-color: rgba(0, 0, 0, 0.2);
}

:deep(.message-content) {
  background-color: rgba(75, 0, 130, 0.6);
  border: 1px solid rgba(138, 43, 226, 0.3);
  box-shadow: 0 0 10px rgba(138, 43, 226, 0.2);
}

:deep(.user-message .message-content) {
  background-color: rgba(58, 134, 255, 0.2);
  border: 1px solid rgba(58, 134, 255, 0.3);
  box-shadow: 0 0 10px rgba(58, 134, 255, 0.2);
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  background-color: rgba(0, 0, 0, 0.2);
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.modal-header h3 {
  color: white;
  margin: 0;
  font-weight: 600;
  text-shadow: 0 0 10px rgba(138, 43, 226, 0.8);
}

.close-button {
  background: transparent;
  border: none;
  color: white;
  font-size: 24px;
  cursor: pointer;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  transition: background-color 0.3s ease;
}

.close-button:hover {
  background-color: rgba(255, 255, 255, 0.1);
}

.modal-body {
  flex: 1;
  overflow: hidden;
  padding: 0;
}

/* Transition animations */
.modal-fade-enter-active,
.modal-fade-leave-active {
  transition: opacity 0.3s ease, transform 0.3s ease;
}

.modal-fade-enter-from,
.modal-fade-leave-to {
  opacity: 0;
  transform: scale(0.95);
}

/* Responsive styles */
@media (max-width: 768px) {
  .chatbot-icon {
    width: 50px;
    height: 50px;
    font-size: 20px;
  }
  
  .modal-content {
    width: 100%;
    height: 100%;
    border-radius: 0;
  }
  
  .chatbot-icon-container {
    bottom: 20px;
    right: 20px;
  }
}
</style> 