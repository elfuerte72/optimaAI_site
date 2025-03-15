<template>
  <div class="chatbot-modal" ref="chatModal">
    <div class="chatbot-modal-content">
      <!-- Заголовок модального окна -->
      <div class="chatbot-header">
        <div class="chatbot-header-left">
          <h5>Виртуальный ассистент</h5>
          <div class="chatbot-status">Онлайн</div>
        </div>
        <div class="chatbot-header-right">
          <button class="btn-close" @click="$emit('close')">
            <i class="bi bi-x-lg"></i>
          </button>
        </div>
      </div>
      
      <!-- Контент модального окна -->
      <div class="chatbot-content">
        <div class="modal-chatbot-body">
          <chat-message
            v-for="(message, index) in messages" 
            :key="index"
            :message="message"
            :format-time="formatTime"
          />
        </div>
      </div>
      
      <!-- Футер модального окна -->
      <div class="chatbot-footer">
        <form @submit.prevent="$emit('send-message')">
          <div class="input-group">
            <input 
              type="text" 
              :value="userInput"
              @input="$emit('update:userInput', $event.target.value)"
              placeholder="Введите сообщение..." 
              :disabled="isLoading"
              @keydown.enter="$emit('send-message')"
            >
            <button 
              type="submit" 
              class="send-button" 
              :disabled="!userInput.trim() || isLoading"
            >
              <i class="bi" :class="isLoading ? 'bi-hourglass-split' : 'bi-send-fill'"></i>
            </button>
          </div>
        </form>
        <div class="chatbot-footer-actions">
          <button 
            class="reset-button" 
            @click="$emit('reset-chat')" 
            :disabled="isLoading"
            title="Сбросить историю чата"
          >
            <i class="bi bi-arrow-counterclockwise"></i>
          </button>
          <div class="powered-by">Powered by OptimAI</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { gsap } from 'gsap';
import ChatMessage from './ChatMessage.vue';

export default {
  name: 'ChatBotModal',
  components: {
    ChatMessage
  },
  props: {
    messages: Array,
    isLoading: Boolean,
    userInput: String,
    formatTime: Function
  },
  emits: ['close', 'send-message', 'reset-chat', 'update:userInput'],
  setup() {
    const chatModal = ref(null);
    
    onMounted(() => {
      // Анимация открытия модального окна
      animateModalOpen();
      
      // Добавляем обработчик клавиши Escape
      document.addEventListener('keydown', handleKeyDown);
    });
    
    // Обработчик нажатия клавиш
    const handleKeyDown = (e) => {
      if (e.key === 'Escape') {
        // Закрываем модальное окно по Escape
        closeModal();
      }
    };
    
    // Закрытие модального окна
    const closeModal = () => {
      // Удаляем обработчик при закрытии модального окна
      document.removeEventListener('keydown', handleKeyDown);
      
      // Анимируем закрытие
      const tl = gsap.timeline({
        onComplete: () => {
          // По завершении анимации эмитим событие закрытия
          setTimeout(() => {
            // Небольшая задержка для завершения анимации
            document.body.style.overflow = 'auto'; // Возвращаем скролл страницы
          }, 50);
        }
      });
      
      tl.to('.chatbot-modal-content', {
        opacity: 0,
        scale: 0.9,
        y: 20,
        duration: 0.3,
        ease: "power2.in"
      });
      
      tl.to(chatModal.value, {
        opacity: 0,
        duration: 0.2,
        ease: "power2.in",
        onComplete: () => {
          // Эмитим событие закрытия
          setTimeout(() => {
            document.removeEventListener('keydown', handleKeyDown);
            document.body.style.overflow = 'auto';
          }, 100);
        }
      }, "-=0.1");
    };
    
    // Анимация открытия модального окна
    const animateModalOpen = () => {
      document.body.style.overflow = 'hidden'; // Блокируем скролл страницы
      
      const tl = gsap.timeline();
      
      tl.fromTo(chatModal.value, 
        { opacity: 0 },
        { 
          opacity: 1, 
          duration: 0.3,
          ease: "power2.out"
        }
      );
      
      tl.fromTo('.chatbot-modal-content', 
        { opacity: 0, scale: 0.9, y: 20 },
        { 
          opacity: 1, 
          scale: 1, 
          y: 0,
          duration: 0.4,
          ease: "back.out(1.7)"
        }, "-=0.1"
      );
    };
    
    return {
      chatModal,
      closeModal
    };
  }
};
</script>

<style scoped>
.chatbot-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  z-index: 9999;
  display: flex;
  justify-content: center;
  align-items: center;
  backdrop-filter: blur(5px);
}

.chatbot-modal-content {
  width: 90%;
  max-width: 1000px;
  height: 90vh;
  background-color: rgba(20, 20, 35, 0.9);
  border-radius: 16px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3), 0 0 20px rgba(99, 102, 241, 0.5);
  display: flex;
  flex-direction: column;
  overflow: hidden;
  position: relative;
  border: 1px solid rgba(99, 102, 241, 0.3);
}

.chatbot-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  background-color: rgba(30, 30, 50, 0.9);
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.chatbot-header-left {
  display: flex;
  flex-direction: column;
}

.chatbot-header-left h5 {
  margin: 0;
  color: #fff;
  font-size: 18px;
  font-weight: 600;
}

.chatbot-status {
  font-size: 12px;
  color: #4ade80;
  display: flex;
  align-items: center;
}

.chatbot-status::before {
  content: '';
  display: inline-block;
  width: 8px;
  height: 8px;
  background-color: #4ade80;
  border-radius: 50%;
  margin-right: 5px;
}

.btn-close {
  background: none;
  border: none;
  color: rgba(255, 255, 255, 0.7);
  font-size: 16px;
  cursor: pointer;
  padding: 5px;
  transition: color 0.3s ease;
}

.btn-close:hover {
  color: #fff;
}

.chatbot-content {
  flex: 1;
  overflow: hidden;
}

.modal-chatbot-body {
  height: 100%;
  overflow-y: auto;
  padding: 20px;
  scroll-behavior: smooth;
}

.chatbot-footer {
  padding: 15px 20px;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
  background-color: rgba(30, 30, 50, 0.9);
}

.input-group {
  display: flex;
  position: relative;
}

.input-group input {
  flex: 1;
  padding: 12px 20px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 8px;
  background-color: rgba(20, 20, 35, 0.5);
  color: #fff;
  font-size: 16px;
  outline: none;
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
  width: 100%;
}

.input-group input:focus {
  border-color: rgba(99, 102, 241, 0.5);
  box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
}

.input-group input::placeholder {
  color: rgba(255, 255, 255, 0.5);
}

.send-button {
  position: absolute;
  right: 8px;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  color: #6366f1;
  font-size: 20px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 8px 12px;
  border-radius: 5px;
  transition: all 0.3s ease;
}

.send-button:hover:not(:disabled) {
  background-color: rgba(99, 102, 241, 0.1);
  transform: translateY(-50%) scale(1.05);
}

.send-button:disabled {
  color: rgba(255, 255, 255, 0.3);
  cursor: not-allowed;
}

.chatbot-footer-actions {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 15px;
}

.reset-button {
  background: none;
  border: none;
  color: rgba(255, 255, 255, 0.5);
  font-size: 14px;
  cursor: pointer;
  padding: 5px 10px;
  border-radius: 5px;
  transition: all 0.3s ease;
}

.reset-button:hover:not(:disabled) {
  color: rgba(255, 255, 255, 0.9);
  background-color: rgba(255, 255, 255, 0.1);
}

.reset-button:disabled {
  opacity: 0.3;
  cursor: not-allowed;
}

.powered-by {
  font-size: 12px;
  color: rgba(255, 255, 255, 0.4);
}

@media (max-width: 768px) {
  .chatbot-modal-content {
    width: 100%;
    height: 100%;
    border-radius: 0;
  }
  
  .chatbot-header {
    padding: 15px;
  }
  
  .chatbot-header-left h5 {
    font-size: 16px;
  }
  
  .modal-chatbot-body {
    padding: 15px;
  }
  
  .input-group input {
    padding: 10px 15px;
    font-size: 14px;
  }
  
  .send-button {
    font-size: 18px;
    padding: 6px 10px;
  }
}
</style> 