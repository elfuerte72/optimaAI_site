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
      @click="openModal"
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
          <button class="btn-close" @click.stop="toggleChat">
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

    <!-- Модальное окно на весь экран -->
    <div 
      v-if="isModalOpen && !startInModal" 
      class="chatbot-modal" 
      ref="chatModal"
    >
      <div class="chatbot-modal-content">
        <!-- Заголовок модального окна -->
        <div class="chatbot-header">
          <div class="chatbot-header-left">
            <h5>Виртуальный ассистент</h5>
            <div class="chatbot-status">Онлайн</div>
          </div>
          <div class="chatbot-header-right">
            <button class="btn-close" @click="closeModal">
              <i class="bi bi-x-lg"></i>
            </button>
          </div>
        </div>
        
        <!-- Контент модального окна -->
        <div class="chatbot-content">
          <div class="chatbot-body" ref="modalChatBody">
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
        
        <!-- Футер модального окна -->
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
  </div>
</template>

<script>
import { ref, onMounted, nextTick } from 'vue';

// Функция для динамической загрузки GSAP, если он не доступен
const loadGSAP = () => {
  return new Promise((resolve, reject) => {
    if (typeof gsap !== 'undefined') {
      console.log('GSAP уже загружен в компоненте, используем существующий');
      resolve(gsap);
      return;
    }
    
    // Пытаемся импортировать GSAP динамически
    import('gsap').then(module => {
      console.log('GSAP успешно импортирован динамически');
      resolve(module.gsap);
    }).catch(error => {
      console.warn('Не удалось импортировать GSAP, пробуем загрузить через CDN', error);
      
      // Массив CDN для резервной загрузки
      const cdnSources = [
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.7/gsap.min.js',
        'https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js',
        'https://unpkg.com/gsap@3.12.7/dist/gsap.min.js'
      ];
      
      // Функция для попытки загрузки из следующего источника
      const tryLoadFromNextSource = (sourceIndex) => {
        if (sourceIndex >= cdnSources.length) {
          console.error('Не удалось загрузить GSAP из всех источников');
          reject(new Error('Не удалось загрузить GSAP из всех доступных источников'));
          return;
        }
        
        const script = document.createElement('script');
        script.src = cdnSources[sourceIndex];
        
        script.onload = () => {
          console.log(`GSAP успешно загружен из ${cdnSources[sourceIndex]}`);
          resolve(window.gsap);
        };
        
        script.onerror = () => {
          console.warn(`Не удалось загрузить GSAP из ${cdnSources[sourceIndex]}, пробуем следующий источник`);
          // Пробуем следующий источник
          tryLoadFromNextSource(sourceIndex + 1);
        };
        
        document.head.appendChild(script);
      };
      
      // Начинаем с первого источника
      tryLoadFromNextSource(0);
    });
  });
};

// Переменная для хранения экземпляра GSAP
let gsapInstance = null;

export default {
  name: 'ChatBot',
  props: {
    startInModal: {
      type: Boolean,
      default: false
    }
  },
  setup(props) {
    // Реактивные состояния
    const isOpen = ref(props.startInModal ? true : false);
    const isLoading = ref(false);
    const userInput = ref('');
    const messages = ref([]);
    const isModalOpen = ref(false); // Всегда начинаем с закрытого модального окна
    const gsapLoaded = ref(false);
    
    // Ссылки на DOM элементы
    const chatbotContainer = ref(null);
    const chatbotButton = ref(null);
    const chatWindow = ref(null);
    const chatBody = ref(null);
    const chatModal = ref(null);
    const modalChatBody = ref(null);
    
    // Проверка, был ли чат уже открыт ранее
    const checkFirstVisit = () => {
      // Если чат запущен в модальном режиме, не открываем автоматически
      if (props.startInModal) return;
      
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
      if (isOpen.value) {
        // Закрываем чат
        animateChatClose();
        // isOpen.value = false; // Это будет установлено в animateChatClose
      } else {
        // Открываем чат
        isOpen.value = true;
        nextTick(() => {
          animateChatOpen();
          scrollToBottom();
        });
      }
    };
    
    // Открытие модального окна
    const openModal = (event) => {
      // Если чат запущен в модальном режиме, не открываем собственное модальное окно
      if (props.startInModal) return;
      
      // Предотвращаем открытие модального окна при клике на кнопку закрытия
      if (event.target.closest('.btn-close')) return;
      
      isModalOpen.value = true;
      
      nextTick(() => {
        scrollToBottomModal();
        animateModalOpen();
      });
    };
    
    // Закрытие модального окна
    const closeModal = () => {
      animateModalClose();
    };
    
    // Анимация открытия модального окна
    const animateModalOpen = () => {
      if (!gsapLoaded.value || !gsapInstance) {
        // Если GSAP не загружен, просто показываем модальное окно без анимации
        if (chatModal.value) {
          chatModal.value.style.opacity = 1;
        }
        return;
      }
      
      const tl = gsapInstance.timeline();
      
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
    
    // Анимация закрытия модального окна
    const animateModalClose = () => {
      if (!gsapLoaded.value || !gsapInstance) {
        // Если GSAP не загружен, просто скрываем модальное окно без анимации
        isModalOpen.value = false;
        return;
      }
      
      const tl = gsapInstance.timeline({
        onComplete: () => {
          isModalOpen.value = false;
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
        ease: "power2.in"
      }, "-=0.1");
    };
    
    // Анимация открытия чата
    const animateChatOpen = () => {
      if (!gsapLoaded.value || !gsapInstance) {
        // Если GSAP не загружен, просто показываем чат без анимации
        if (chatWindow.value) {
          chatWindow.value.style.opacity = 1;
        }
        return;
      }
      
      const tl = gsapInstance.timeline();
      
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
    
    // Анимация закрытия чата
    const animateChatClose = () => {
      if (!gsapLoaded.value || !gsapInstance) {
        // Если GSAP не загружен, просто скрываем чат без анимации
        isOpen.value = false;
        return;
      }
      
      gsapInstance.to(chatWindow.value, {
        opacity: 0,
        y: 50,
        scale: 0.8,
        duration: 0.3,
        ease: "power2.in",
        onComplete: () => {
          isOpen.value = false;
        }
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
    
    // Прокрутка модального чата вниз
    const scrollToBottomModal = () => {
      nextTick(() => {
        if (modalChatBody.value) {
          modalChatBody.value.scrollTop = modalChatBody.value.scrollHeight;
        }
      });
    };
    
    // Форматирование времени
    const formatTime = (date) => {
      if (!date) return '';
      const d = new Date(date);
      return d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    };
    
    // Сохранение сообщений в localStorage
    const saveMessages = () => {
      try {
        localStorage.setItem('chatbot_messages', JSON.stringify(messages.value));
      } catch (error) {
        console.error('Ошибка при сохранении сообщений в localStorage:', error);
      }
    };
    
    // Загрузка сообщений из localStorage
    const loadMessages = () => {
      try {
        const savedMessages = localStorage.getItem('chatbot_messages');
        if (savedMessages) {
          messages.value = JSON.parse(savedMessages);
        }
      } catch (error) {
        console.error('Ошибка при загрузке сообщений из localStorage:', error);
      }
    };
    
    // Добавление сообщения пользователя
    const addUserMessage = (message) => {
      // Добавляем сообщение пользователя
      messages.value.push({
        role: 'user',
        content: message,
        time: new Date()
      });
      
      // Сохраняем сообщения в localStorage
      saveMessages();
      
      // Прокручиваем чат вниз
      scrollToBottom();
      if (isModalOpen.value) {
        scrollToBottomModal();
      }
      
      // Анимируем новое сообщение
      nextTick(() => {
        const messageElements = document.querySelectorAll('.user-message');
        const lastMessage = messageElements[messageElements.length - 1];
        animateUserMessage(lastMessage);
      });
    };
    
    // Добавление сообщения бота
    const addBotMessage = (message) => {
      // Добавляем сообщение бота
      messages.value.push({
        role: 'assistant',
        content: message,
        time: new Date()
      });
      
      // Сохраняем сообщения в localStorage
      saveMessages();
      
      // Прокручиваем чат вниз
      scrollToBottom();
      if (isModalOpen.value) {
        scrollToBottomModal();
      }
      
      // Анимируем новое сообщение
      nextTick(() => {
        const messageElements = document.querySelectorAll('.bot-message');
        const lastMessage = messageElements[messageElements.length - 1];
        animateBotMessage(lastMessage);
      });
    };
    
    // Анимация последнего сообщения
    const animateLastMessage = () => {
      const messageElements = chatBody.value.querySelectorAll('.user-message, .bot-message');
      const lastMessage = messageElements[messageElements.length - 1];
      
      if (lastMessage) {
        gsapInstance.fromTo(lastMessage, 
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
    
    // Анимация последнего сообщения в модальном окне
    const animateLastModalMessage = () => {
      const messageElements = modalChatBody.value.querySelectorAll('.user-message, .bot-message');
      const lastMessage = messageElements[messageElements.length - 1];
      
      if (lastMessage) {
        gsapInstance.fromTo(lastMessage, 
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
      if (isModalOpen.value) {
        scrollToBottomModal();
      }
      
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
    
    // Анимация нового сообщения пользователя
    const animateUserMessage = (messageElement) => {
      if (!gsapLoaded.value || !gsapInstance || !messageElement) return;
      
      gsapInstance.fromTo(messageElement, 
        { opacity: 0, scale: 0.8, y: 20 },
        { 
          opacity: 1, 
          scale: 1, 
          y: 0,
          duration: 0.4,
          ease: "back.out(1.7)"
        }
      );
    };
    
    // Анимация нового сообщения бота
    const animateBotMessage = (messageElement) => {
      if (!gsapLoaded.value || !gsapInstance || !messageElement) return;
      
      gsapInstance.fromTo(messageElement, 
        { opacity: 0, scale: 0.8, y: 20 },
        { 
          opacity: 1, 
          scale: 1, 
          y: 0,
          duration: 0.4,
          ease: "back.out(1.7)"
        }
      );
    };
    
    // Анимация пульсации кнопки
    const pulseButton = () => {
      if (!gsapLoaded.value || !gsapInstance || !chatbotButton.value) return;
      
      gsapInstance.to(chatbotButton.value, {
        scale: 1.1,
        duration: 0.3,
        ease: "elastic.out(1, 0.3)",
        onComplete: () => {
          gsapInstance.to(chatbotButton.value, {
            scale: 1,
            duration: 0.2,
            ease: "power2.out"
          });
        }
      });
    };
    
    // Анимация при наведении на кнопку отправки
    const hoverSendButton = (enter) => {
      if (!gsapLoaded.value || !gsapInstance) return;
      
      gsapInstance.to('.send-button', {
        scale: enter ? 1.1 : 1,
        duration: 0.3,
        ease: "power2.out"
      });
    };
    
    // Хук жизненного цикла
    onMounted(() => {
      // Загружаем сообщения из localStorage
      loadMessages();
      
      // Загружаем GSAP перед использованием
      loadGSAP().then(gsap => {
        // Сохраняем экземпляр GSAP
        gsapInstance = gsap;
        gsapLoaded.value = true;
        
        // Проверяем, первое ли это посещение
        checkFirstVisit();
        
        // Инициализируем анимацию кнопки
        gsapInstance.set(chatbotButton.value, { scale: 0, opacity: 0 });
        gsapInstance.to(chatbotButton.value, {
          scale: 1,
          opacity: 1,
          duration: 0.5,
          ease: "back.out(1.7)",
          delay: 0.5
        });
      }).catch(error => {
        console.error('Не удалось загрузить GSAP в компоненте ChatBot:', error);
        // Показываем кнопку без анимации
        if (chatbotButton.value) {
          chatbotButton.value.style.opacity = 1;
        }
      });
      
      // Добавляем обработчик для закрытия чата по Escape
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
          if (isModalOpen.value) {
            closeModal();
          } else if (isOpen.value) {
            toggleChat();
          }
        }
      });
    });
    
    return {
      isOpen,
      isLoading,
      userInput,
      messages,
      isModalOpen,
      gsapLoaded,
      chatbotContainer,
      chatbotButton,
      chatWindow,
      chatBody,
      chatModal,
      modalChatBody,
      toggleChat,
      openModal,
      closeModal,
      sendMessage,
      formatTime,
      pulseButton,
      hoverSendButton,
      scrollToBottom,
      scrollToBottomModal,
      saveMessages,
      loadMessages,
      animateUserMessage,
      animateBotMessage,
      initializeChat
    };
  }
};
</script>

<style scoped>
/* Стили для модального окна */
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
  background-color: var(--bs-body-bg);
  border-radius: 16px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
  display: flex;
  flex-direction: column;
  overflow: hidden;
  position: relative;
}

.chatbot-modal .chatbot-content {
  flex: 1;
  overflow: hidden;
}

.chatbot-modal .chatbot-body {
  height: 100%;
  overflow-y: auto;
  padding: 20px;
}

/* Медиа-запросы для адаптивности */
@media (max-width: 768px) {
  .chatbot-modal-content {
    width: 100%;
    height: 100%;
    border-radius: 0;
  }
}
</style> 