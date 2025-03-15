<template>
  <div 
    class="chat-message"
    :class="[
      message.role === 'user' ? 'user-message' : 'bot-message',
      { 'typing-indicator': message.role === 'assistant' && !message.animationComplete }
    ]"
  >
    <div class="message-content">
      <template v-if="message.role === 'assistant' && !message.animationComplete">
        <span></span>
        <span></span>
        <span></span>
      </template>
      <template v-else>
        {{ message.content }}
      </template>
    </div>
    <div class="message-time">{{ formatTime(message.time) }}</div>
  </div>
</template>

<script>
export default {
  name: 'ChatMessage',
  props: {
    message: {
      type: Object,
      required: true
    },
    formatTime: {
      type: Function,
      required: true
    }
  }
}
</script>

<style scoped>
.chat-message {
  margin-bottom: 15px;
  max-width: 85%;
  position: relative;
  transition: all 0.3s ease;
  will-change: transform, opacity;
}

.user-message {
  margin-left: auto;
  background-color: rgba(99, 102, 241, 0.2);
  color: #fff;
  border-radius: 12px 12px 0 12px;
  padding: 12px 15px;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
  align-self: flex-end;
}

.bot-message {
  margin-right: auto;
  background-color: rgba(255, 255, 255, 0.05);
  color: #fff;
  border-radius: 12px 12px 12px 0;
  padding: 12px 15px;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
  align-self: flex-start;
}

.message-content {
  font-size: 14px;
  line-height: 1.5;
  word-wrap: break-word;
}

.message-time {
  font-size: 10px;
  color: rgba(255, 255, 255, 0.5);
  text-align: right;
  margin-top: 5px;
}

/* Стили для индикатора набора текста */
.typing-indicator {
  display: flex;
  align-items: center;
}

.typing-indicator .message-content {
  display: flex;
  align-items: center;
  height: 26px;
}

.typing-indicator span {
  display: inline-block;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background-color: rgba(255, 255, 255, 0.5);
  margin: 0 3px;
  animation: typing 1.2s infinite ease-in-out;
}

.typing-indicator span:nth-child(1) {
  animation-delay: 0s;
}

.typing-indicator span:nth-child(2) {
  animation-delay: 0.4s;
}

.typing-indicator span:nth-child(3) {
  animation-delay: 0.8s;
}

@keyframes typing {
  0%, 100% {
    transform: translateY(0);
    opacity: 0.5;
  }
  50% {
    transform: translateY(-5px);
    opacity: 1;
  }
}

@media (max-width: 768px) {
  .chat-message {
    max-width: 90%;
  }
  
  .message-content {
    font-size: 13px;
  }
  
  .user-message, .bot-message {
    padding: 10px 12px;
  }
}
</style> 