import { nextTick } from 'vue';
import { gsap } from 'gsap';

/**
 * Композабл для логики чат-бота
 * @param {Object} messages - Реактивный массив сообщений
 * @param {Object} userInput - Реактивное поле ввода пользователя
 * @param {Object} isLoading - Реактивный флаг загрузки
 */
export function useChatBot(messages, userInput, isLoading) {
  
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
    
    // Снимаем флаг загрузки
    isLoading.value = false;
  };
  
  // Сброс истории чата
  const resetChat = () => {
    // Показываем индикатор загрузки
    isLoading.value = true;
    
    // Создаем URL для API в зависимости от окружения
    const apiUrl = window.location.hostname === '127.0.0.1' || window.location.hostname === 'localhost' 
      ? 'http://127.0.0.1:8000/api/chatbot/reset' 
      : window.location.origin + '/api/chatbot/reset';
    
    fetch(apiUrl, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
      },
      credentials: 'include'
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Ошибка сети: ' + response.status);
      }
      return response.json();
    })
    .then(data => {
      // Очищаем историю сообщений
      messages.value = [];
      
      // Удаляем сохраненные сообщения из localStorage
      localStorage.removeItem('chatbot_messages');
      
      // Добавляем приветственное сообщение
      addBotMessage('Здравствуйте! Я виртуальный ассистент OptimAI с искусственным интеллектом. Чем могу помочь? Вы можете задать вопросы о наших услугах, продуктах, условиях работы или контактах.');
    })
    .catch(error => {
      console.error('Ошибка при сбросе чата:', error);
      addBotMessage('Извините, произошла ошибка при сбросе чата. Пожалуйста, попробуйте позже.');
    })
    .finally(() => {
      isLoading.value = false;
    });
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
    
    // Создаем URL для API в зависимости от окружения
    const apiUrl = window.location.hostname === '127.0.0.1' || window.location.hostname === 'localhost' 
      ? 'http://127.0.0.1:8000/api/chatbot/chat' 
      : window.location.origin + '/api/chatbot/chat';
    
    fetch(apiUrl, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
      },
      credentials: 'include',
      body: JSON.stringify({ message })
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Ошибка сети: ' + response.status);
      }
      return response.json();
    })
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
      console.error('Chatbot fetch error:', error);
      
      // Добавляем информативное сообщение об ошибке
      if (error.message.includes('404')) {
        addBotMessage('Извините, сервис чат-бота временно недоступен (Ошибка 404). Пожалуйста, попробуйте позже или обратитесь к администратору.');
      } else if (error.message.includes('500')) {
        addBotMessage('Извините, произошла внутренняя ошибка сервера (Ошибка 500). Пожалуйста, попробуйте позже.');
      } else {
        addBotMessage('Извините, произошла ошибка соединения. Пожалуйста, проверьте подключение к интернету и попробуйте снова.');
      }
    })
    .finally(() => {
      isLoading.value = false;
    });
  };
  
  // Анимация пульсации кнопки
  const pulseButton = () => {
    const chatbotButton = document.querySelector('.chatbot-button');
    if (!chatbotButton) return;
    
    gsap.to(chatbotButton, {
      scale: 1.1,
      duration: 0.3,
      ease: "elastic.out(1, 0.3)",
      onComplete: () => {
        gsap.to(chatbotButton, {
          scale: 1,
          duration: 0.2,
          ease: "power2.out"
        });
      }
    });
  };
  
  return {
    formatTime,
    addUserMessage,
    addBotMessage,
    resetChat,
    sendMessage,
    pulseButton
  };
} 