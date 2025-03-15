<template>
  <div 
    class="chatbot-button" 
    ref="chatbotButton" 
    @click="$emit('toggle')" 
    @mouseenter="$emit('pulse')"
  >
    <i class="bi bi-chat-dots-fill"></i>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { gsap } from 'gsap';

export default {
  name: 'ChatBotButton',
  props: {
    isOpen: {
      type: Boolean,
      default: false
    }
  },
  emits: ['toggle', 'pulse'],
  setup() {
    const chatbotButton = ref(null);
    
    onMounted(() => {
      // Анимация появления кнопки
      gsap.set(chatbotButton.value, { scale: 0, opacity: 0 });
      gsap.to(chatbotButton.value, {
        scale: 1,
        opacity: 1,
        duration: 0.5,
        ease: "back.out(1.7)",
        delay: 0.5
      });
      
      // Добавляем эффект "левитации"
      gsap.to(chatbotButton.value, {
        y: '-=5',
        duration: 1.5,
        repeat: -1,
        yoyo: true,
        ease: "sine.inOut"
      });
    });
    
    return {
      chatbotButton
    };
  }
};
</script>

<style scoped>
.chatbot-button {
  position: fixed;
  bottom: 30px;
  right: 30px;
  width: 60px;
  height: 60px;
  background: linear-gradient(135deg, #6366f1, #b935ff);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 0 5px 15px rgba(99, 102, 241, 0.4);
  z-index: 999;
  transition: transform 0.3s, box-shadow 0.3s;
  will-change: transform, box-shadow;
}

.chatbot-button:hover {
  transform: scale(1.05);
  box-shadow: 0 8px 20px rgba(185, 53, 255, 0.6);
}

.chatbot-button i {
  font-size: 28px;
  color: white;
}

@media (max-width: 768px) {
  .chatbot-button {
    width: 50px;
    height: 50px;
    bottom: 20px;
    right: 20px;
  }
  
  .chatbot-button i {
    font-size: 24px;
  }
}
</style> 