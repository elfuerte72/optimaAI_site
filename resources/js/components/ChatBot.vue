<template>
  <div class="chatbot-container" ref="chatbotContainer">
    <!-- Кнопка чат-бота -->
    <div 
      class="chatbot-button" 
      ref="chatbotButton" 
      @click="toggleChat" 
      @mouseenter="pulseButton"
    >
      <i class="bi bi-chat-dots-fill"></i>
    </div>
    
    <!-- Окно чат-бота -->
    <div 
      v-if="isOpen" 
      class="chatbot-window" 
      ref="chatWindow"
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
          <button class="btn-close" @click="toggleChat">
            <i class="bi bi-x-lg"></i>
          </button>
        </div>
      </div>
      
      <!-- Контент чат-бота -->
      <div class="chatbot-content">
        <div class="chatbot-body" ref="chatBody">
          <div 
            v-for="(message, index) in messages" 
            :key="index" 
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
        </div>
      </div>
      
      <!-- Футер чат-бота -->
      <div class="chatbot-footer">
        <form @submit.prevent="sendMessage">
          <div class="input-group">
            <input 
              type="text" 
              v-model="userInput" 
              placeholder="Введите сообщение..." 
              :disabled="isLoading"
              @keydown.enter="sendMessage"
            >
            <button 
              type="submit" 
              class="send-button" 
              :disabled="!userInput.trim() || isLoading"
              @mouseenter="hoverSendButton(true)"
              @mouseleave="hoverSendButton(false)"
            >
              <i class="bi" :class="isLoading ? 'bi-hourglass-split' : 'bi-send-fill'"></i>
            </button>
          </div>
        </form>
        <div class="chatbot-footer-actions">
          <div class="powered-by">Powered by OptimAI</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { gsap } from 'gsap';
import { ref, onMounted, nextTick } from 'vue';

export default {
  name: 'ChatBot',
  setup() {
    // Реактивные состояния
    const isOpen = ref(false);
    const isLoading = ref(false);
    const userInput = ref('');
    const messages = ref([]);
    
    // Ссылки на DOM элементы
    const chatbotContainer = ref(null);
    const chatbotButton = ref(null);
    const chatWindow = ref(null);
    const chatBody = ref(null);
    
    // Проверка, был ли чат уже открыт ранее
    const checkFirstVisit = () => {
      const hasVisited = localStorage.getItem('chatbot_visited');
      if (!hasVisited) {
        // Устанавливаем флаг посещения
        localStorage.setItem('chatbot_visited', 'true');
        // Открываем чат автоматически через 3 секунды после загрузки
        setTimeout(() => {
          toggleChat();
        }, 3000);
      }
    };
    
    // Инициализация чата
    const initializeChat = () => {
      isLoading.value = true;
      
      // Имитация загрузки для первого сообщения
      setTimeout(() => {
        addBotMessage('Здравствуйте! Я виртуальный ассистент OptimAI с искусственным интеллектом. Чем могу помочь? Вы можете задать вопросы о наших услугах, продуктах, условиях работы или контактах.');
      }, 1000);
    };
    
    // Переключение состояния чата
    const toggleChat = () => {
      isOpen.value = !isOpen.value;
      
      if (isOpen.value) {
        if (messages.value.length === 0) {
          initializeChat();
        }
        
        nextTick(() => {
          scrollToBottom();
          animateChatOpen();
        });
      } else {
        animateChatClose();
      }
    };
    
    // Анимация открытия чата
    const animateChatOpen = () => {
      const tl = gsap.timeline();
      
      tl.fromTo(chatWindow.value, 
        { opacity: 0, y: 50, scale: 0.8 },
        { 
          opacity: 1, 
          y: 0, 
          scale: 1,
          duration: 0.5,
          ease: "back.out(1.7)"
        }
      );
      
      // Анимация элементов внутри чата
      const chatElements = chatWindow.value.querySelectorAll('.chatbot-header, .chatbot-body, .chatbot-footer');
      
      tl.fromTo(chatElements, 
        { opacity: 0, y: 20 },
        { 
          opacity: 1, 
          y: 0, 
          duration: 0.3,
          stagger: 0.1,
          ease: "power2.out"
        }, "-=0.3"
      );
    };
    
    // Анимация закрытия чата
    const animateChatClose = () => {
      gsap.to(chatWindow.value, {
        opacity: 0,
        y: 50,
        scale: 0.8,
        duration: 0.3,
        ease: "power2.in"
      });
    };
    
    // Прокрутка чата вниз
    const scrollToBottom = () => {
      nextTick(() => {
        if (chatBody.value) {
          chatBody.value.scrollTop = chatBody.value.scrollHeight;
        }
      });
    };
    
    // Форматирование времени
    const formatTime = (date) => {
      if (!date) return '';
      const d = new Date(date);
      return d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    };
    
    // Добавление сообщения пользователя
    const addUserMessage = (message) => {
      messages.value.push({
        role: 'user',
        content: message,
        time: new Date(),
        animationComplete: true
      });
      
      scrollToBottom();
    };
    
    // Добавление сообщения бота
    const addBotMessage = (message) => {
      isLoading.value = false;
      
      messages.value.push({
        role: 'assistant',
        content: message,
        time: new Date(),
        animationComplete: true
      });
      
      scrollToBottom();
      
      // Анимация появления сообщения
      nextTick(() => {
        animateLastMessage();
      });
    };
    
    // Анимация последнего сообщения
    const animateLastMessage = () => {
      const messageElements = chatBody.value.querySelectorAll('.user-message, .bot-message');
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
    };
    
    // Отправка сообщения
    const sendMessage = () => {
      if (!userInput.value.trim() || isLoading.value) return;
      
      // Сохраняем введенное сообщение
      const message = userInput.value.trim();
      userInput.value = '';
      
      // Добавляем сообщение пользователя
      addUserMessage(message);
      
      // Показываем индикатор загрузки
      isLoading.value = true;
      scrollToBottom();
      
      // Отправляем запрос к API
      fetch('/chatbot/chat', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ message })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Добавляем ответ бота
          addBotMessage(data.message);
        } else {
          // Обрабатываем ошибку
          addBotMessage('Извините, произошла ошибка. Пожалуйста, попробуйте позже.');
          console.error('Chatbot error:', data.message);
        }
      })
      .catch(error => {
        // Обрабатываем ошибку сети
        addBotMessage('Извините, произошла ошибка соединения. Пожалуйста, проверьте подключение к интернету.');
        console.error('Chatbot fetch error:', error);
      })
      .finally(() => {
        isLoading.value = false;
      });
    };
    
    // Анимация пульсации кнопки
    const pulseButton = () => {
      gsap.to(chatbotButton.value, {
        scale: 1.1,
        duration: 0.3,
        ease: "elastic.out(1, 0.3)",
        onComplete: () => {
          gsap.to(chatbotButton.value, {
            scale: 1,
            duration: 0.2,
            ease: "power2.out"
          });
        }
      });
    };
    
    // Анимация при наведении на кнопку отправки
    const hoverSendButton = (enter) => {
      gsap.to('.send-button', {
        scale: enter ? 1.1 : 1,
        duration: 0.3,
        ease: "power2.out"
      });
    };
    
    // Хук жизненного цикла
    onMounted(() => {
      // Проверяем, первое ли это посещение
      checkFirstVisit();
      
      // Инициализируем анимацию кнопки
      gsap.set(chatbotButton.value, { scale: 0, opacity: 0 });
      gsap.to(chatbotButton.value, {
        scale: 1,
        opacity: 1,
        duration: 0.5,
        ease: "back.out(1.7)",
        delay: 0.5
      });
      
      // Добавляем обработчик для закрытия чата по Escape
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && isOpen.value) {
          toggleChat();
        }
      });
    });
    
    return {
      isOpen,
      isLoading,
      userInput,
      messages,
      chatbotContainer,
      chatbotButton,
      chatWindow,
      chatBody,
      toggleChat,
      sendMessage,
      formatTime,
      pulseButton,
      hoverSendButton,
      scrollToBottom
    };
  }
};
</script> 