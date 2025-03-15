<template>
  <div class="chatbot-container" ref="chatbotContainer">
    <!-- Кнопка чат-бота -->
    <chat-bot-button 
      :isOpen="isOpen" 
      @toggle="toggleChat" 
      @pulse="pulseButton"
    />
    
    <!-- Окно чат-бота -->
    <chat-bot-window 
      v-if="isOpen && !startInModal" 
      :messages="messages" 
      :isLoading="isLoading" 
      :userInput="userInput" 
      :formatTime="formatTime"
      @close="toggleChat"
      @open-modal="openModal"
      @send-message="sendMessage"
      @reset-chat="resetChat"
      @update:userInput="userInput = $event"
    />

    <!-- Модальное окно на весь экран -->
    <chat-bot-modal
      v-if="isModalOpen && !startInModal" 
      :messages="messages" 
      :isLoading="isLoading" 
      :userInput="userInput" 
      :formatTime="formatTime"
      @close="closeModal"
      @send-message="sendMessage"
      @reset-chat="resetChat"
      @update:userInput="userInput = $event"
    />
  </div>
</template>

<script>
import { ref, onMounted, nextTick, defineAsyncComponent } from 'vue';
import { useChatBot } from './composables/useChatBot';

// Используем динамический импорт для компонентов, чтобы ускорить загрузку
const ChatBotButton = defineAsyncComponent(() => import('./ChatBotButton.vue'));
const ChatBotWindow = defineAsyncComponent(() => import('./ChatBotWindow.vue'));
const ChatBotModal = defineAsyncComponent(() => import('./ChatBotModal.vue'));

export default {
  name: 'ChatBot',
  components: {
    ChatBotButton,
    ChatBotWindow,
    ChatBotModal
  },
  props: {
    startInModal: {
      type: Boolean,
      default: false
    }
  },
  setup(props) {
    // Основные состояния
    const isOpen = ref(props.startInModal ? true : false);
    const isLoading = ref(false);
    const userInput = ref('');
    const messages = ref([]);
    const isModalOpen = ref(false);
    
    // Ссылки на DOM элементы
    const chatbotContainer = ref(null);
    
    // Используем композабл с логикой чат-бота
    const { 
      sendMessage, 
      addBotMessage, 
      resetChat, 
      formatTime,
      pulseButton
    } = useChatBot(messages, userInput, isLoading);
    
    // Проверяем, был ли чат уже открыт ранее
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
      isOpen.value = !isOpen.value;
      
      if (isOpen.value) {
        // Открываем чат
        nextTick(() => {
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
      });
    };
    
    // Закрытие модального окна
    const closeModal = () => {
      isModalOpen.value = false;
    };
    
    // Прокрутка чата вниз
    const scrollToBottom = () => {
      nextTick(() => {
        const chatBody = document.querySelector('.chatbot-body');
        if (chatBody) {
          chatBody.scrollTop = chatBody.scrollHeight;
        }
      });
    };
    
    // Прокрутка модального чата вниз
    const scrollToBottomModal = () => {
      nextTick(() => {
        const modalChatBody = document.querySelector('.modal-chatbot-body');
        if (modalChatBody) {
          modalChatBody.scrollTop = modalChatBody.scrollHeight;
        }
      });
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
    
    onMounted(() => {
      // Загружаем сохраненные сообщения
      loadMessages();
      
      // Если нет сообщений, инициализируем чат
      if (messages.value.length === 0) {
        initializeChat();
      }
      
      // Проверяем, первый ли визит
      checkFirstVisit();
    });
    
    return {
      isOpen,
      isLoading,
      userInput,
      messages,
      isModalOpen,
      chatbotContainer,
      sendMessage,
      resetChat,
      toggleChat,
      openModal,
      closeModal,
      formatTime,
      pulseButton
    };
  }
};
</script>

<style>
/* Стили перенесем в отдельный файл */
</style> 