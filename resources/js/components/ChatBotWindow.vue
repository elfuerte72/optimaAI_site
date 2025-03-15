<template>
  <div 
    class="chatbot-window" 
    ref="chatWindow"
    @click="$emit('open-modal')"
  >
    <!-- Фон чат-бота -->
    <div class="chatbot-background"></div>
    
    <!-- Заголовок чат-бота -->
    <div class="chatbot-header">
      <div class="chatbot-header-left">
        <h5>Виртуальный ассистент</h5>
        <div class="chatbot-status">Онлайн</div>
      </div>
      <div class="chatbot-header-right">
        <button class="btn-close" @click.stop="$emit('close')">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
    </div>
    
    <!-- Контент чат-бота -->
    <div class="chatbot-content">
      <div class="chatbot-body">
        <chat-message
          v-for="(message, index) in messages" 
          :key="index"
          :message="message"
          :format-time="formatTime"
        />
      </div>
    </div>
    
    <!-- Футер чат-бота -->
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
          @click.stop="$emit('reset-chat')" 
          :disabled="isLoading"
          title="Сбросить историю чата"
        >
          <i class="bi bi-arrow-counterclockwise"></i>
        </button>
        <div class="powered-by">Powered by OptimAI</div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, watch } from 'vue';
import { gsap } from 'gsap';
import ChatMessage from './ChatMessage.vue';

export default {
  name: 'ChatBotWindow',
  components: {
    ChatMessage
  },
  props: {
    messages: Array,
    isLoading: Boolean,
    userInput: String,
    formatTime: Function
  },
  emits: ['close', 'open-modal', 'send-message', 'reset-chat', 'update:userInput'],
  setup(props) {
    const chatWindow = ref(null);
    
    onMounted(() => {
      // Анимация открытия окна
      animateChatOpen();
    });
    
    // Анимация для открытия чата
    const animateChatOpen = () => {
      const tl = gsap.timeline();
      
      tl.fromTo(chatWindow.value, 
        { opacity: 0, y: 50, scale: 0.9 },
        { 
          opacity: 1, 
          y: 0, 
          scale: 1,
          duration: 0.5,
          ease: "back.out(1.7)"
        }
      );
      
      tl.fromTo('.chatbot-header, .chatbot-body, .chatbot-footer', 
        { opacity: 0, y: 20 },
        { 
          opacity: 1, 
          y: 0, 
          duration: 0.3,
          stagger: 0.1,
          ease: "power2.out"
        }, "-=0.2"
      );
    };
    
    // Следим за изменениями в сообщениях для анимации новых
    watch(() => props.messages.length, (newLength, oldLength) => {
      if (newLength > oldLength) {
        // Запускаем анимацию для нового сообщения
        setTimeout(() => {
          const messageElements = document.querySelectorAll('.chat-message');
          const lastMessage = messageElements[messageElements.length - 1];
          
          if (lastMessage) {
            gsap.fromTo(lastMessage, 
              { opacity: 0, scale: 0.8, y: 20 },
              { 
                opacity: 1, 
                scale: 1, 
                y: 0,
                duration: 0.4,
                ease: "back.out(1.7)"
              }
            );
          }
        }, 50);
      }
    });
    
    return {
      chatWindow
    };
  }
};
</script>

<style scoped>
.chatbot-window {
  position: fixed;
  bottom: 100px;
  right: 30px;
  width: 350px;
  height: 500px;
  background-color: rgba(20, 20, 35, 0.8);
  border-radius: 16px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
  border: 1px solid rgba(99, 102, 241, 0.2);
  backdrop-filter: blur(10px);
  z-index: 998;
}

.chatbot-background {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: radial-gradient(circle at top right, rgba(99, 102, 241, 0.1), transparent 70%);
  z-index: -1;
}

.chatbot-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px;
  background-color: rgba(30, 30, 50, 0.8);
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.chatbot-header-left {
  display: flex;
  flex-direction: column;
}

.chatbot-header-left h5 {
  margin: 0;
  color: #fff;
  font-size: 16px;
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

.chatbot-body {
  height: 100%;
  overflow-y: auto;
  padding: 15px;
  scroll-behavior: smooth;
}

.chatbot-footer {
  padding: 10px 15px;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
  background-color: rgba(30, 30, 50, 0.8);
}

.input-group {
  display: flex;
  position: relative;
}

.input-group input {
  flex: 1;
  padding: 10px 15px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 8px;
  background-color: rgba(20, 20, 35, 0.5);
  color: #fff;
  font-size: 14px;
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
  right: 5px;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  color: #6366f1;
  font-size: 16px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 5px 10px;
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
  margin-top: 10px;
}

.reset-button {
  background: none;
  border: none;
  color: rgba(255, 255, 255, 0.5);
  font-size: 14px;
  cursor: pointer;
  padding: 3px 8px;
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
  .chatbot-window {
    width: 300px;
    height: 450px;
    bottom: 80px;
    right: 20px;
  }
  
  .chatbot-header-left h5 {
    font-size: 14px;
  }
  
  .chatbot-status, .powered-by {
    font-size: 10px;
  }
  
  .input-group input {
    padding: 8px 12px;
    font-size: 13px;
  }
}

@media (max-width: 480px) {
  .chatbot-window {
    width: calc(100% - 40px);
    right: 20px;
    left: 20px;
  }
}
</style> 