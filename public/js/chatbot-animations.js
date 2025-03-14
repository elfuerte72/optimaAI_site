/**
 * OptimaAI - Нейросетевые решения для бизнеса
 * Анимации чат-бота с использованием GSAP 3
 */

// Проверяем, загружен ли GSAP
const checkGSAP = () => {
  if (typeof gsap === 'undefined') {
    console.error('GSAP не загружен. Анимации чат-бота не будут работать корректно.');
    return false;
  }
  return true;
};

// Инициализация анимаций чат-бота
const initChatbotAnimations = () => {
  if (!checkGSAP()) return;
  
  // Получаем элементы чат-бота
  const chatbotButton = document.querySelector('.chatbot-button');
  const chatbotWindow = document.querySelector('.chatbot-window');
  
  // Если элементы не найдены, выходим
  if (!chatbotButton) return;
  
  // Анимация появления кнопки чат-бота
  gsap.set(chatbotButton, { scale: 0, opacity: 0 });
  gsap.to(chatbotButton, {
    scale: 1,
    opacity: 1,
    duration: 0.5,
    ease: "back.out(1.7)",
    delay: 0.5
  });
  
  // Добавляем обработчик события для анимации при наведении
  chatbotButton.addEventListener('mouseenter', () => {
    gsap.to(chatbotButton, {
      y: -5,
      boxShadow: '0 10px 30px rgba(0, 240, 255, 0.6)',
      duration: 0.3,
      ease: "power2.out"
    });
  });
  
  chatbotButton.addEventListener('mouseleave', () => {
    gsap.to(chatbotButton, {
      y: 0,
      boxShadow: '0 0 20px rgba(0, 240, 255, 0.4)',
      duration: 0.3,
      ease: "power2.out"
    });
  });
  
  // Функция для шифрования сообщений в localStorage
  const encryptMessage = (message) => {
    // Простое шифрование для демонстрации
    return btoa(JSON.stringify(message));
  };
  
  // Функция для дешифрования сообщений из localStorage
  const decryptMessage = (encryptedMessage) => {
    try {
      // Простое дешифрование для демонстрации
      return JSON.parse(atob(encryptedMessage));
    } catch (e) {
      console.error('Ошибка дешифрования сообщения:', e);
      return null;
    }
  };
  
  // Функция для сохранения сообщений в localStorage с шифрованием
  const saveMessagesToLocalStorage = (messages) => {
    const encryptedMessages = messages.map(msg => encryptMessage(msg));
    localStorage.setItem('chatbot_messages', JSON.stringify(encryptedMessages));
    
    // Анимация шифрования для визуального эффекта
    const messageElements = document.querySelectorAll('.user-message, .bot-message');
    messageElements.forEach(el => {
      el.classList.add('encrypting');
      setTimeout(() => {
        el.classList.remove('encrypting');
      }, 500);
    });
  };
  
  // Функция для загрузки сообщений из localStorage с дешифрованием
  const loadMessagesFromLocalStorage = () => {
    const encryptedMessages = localStorage.getItem('chatbot_messages');
    if (!encryptedMessages) return [];
    
    try {
      const parsedMessages = JSON.parse(encryptedMessages);
      return parsedMessages.map(msg => decryptMessage(msg)).filter(Boolean);
    } catch (e) {
      console.error('Ошибка загрузки сообщений:', e);
      return [];
    }
  };
  
  // Функция для анимации открытия чат-бота
  const animateChatOpen = () => {
    if (!chatbotWindow) return;
    
    // Создаем таймлайн для последовательных анимаций
    const tl = gsap.timeline();
    
    // Анимация появления окна чата
    tl.fromTo(chatbotWindow, 
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
    const chatElements = chatbotWindow.querySelectorAll('.chatbot-header, .chatbot-body, .chatbot-footer');
    
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
    
    // Анимация фона
    const chatBackground = chatbotWindow.querySelector('.chatbot-background');
    if (chatBackground) {
      tl.fromTo(chatBackground,
        { opacity: 0 },
        { opacity: 0.1, duration: 0.5 },
        "-=0.5"
      );
    }
    
    return tl;
  };
  
  // Функция для анимации закрытия чат-бота
  const animateChatClose = () => {
    if (!chatbotWindow) return;
    
    return gsap.to(chatbotWindow, {
      opacity: 0,
      y: 50,
      scale: 0.8,
      duration: 0.3,
      ease: "power2.in"
    });
  };
  
  // Функция для анимации появления нового сообщения
  const animateNewMessage = (messageElement) => {
    if (!messageElement) return;
    
    gsap.fromTo(messageElement, 
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
  
  // Функция для эффекта печатания текста
  const typeWriterEffect = (element, text, speed = 20) => {
    if (!element) return;
    
    let i = 0;
    element.textContent = '';
    
    const typeWriter = () => {
      if (i < text.length) {
        element.textContent += text.charAt(i);
        i++;
        setTimeout(typeWriter, speed);
      }
    };
    
    typeWriter();
  };
  
  // Функция для ограничения количества запросов (защита от спама)
  const rateLimiter = (() => {
    const requestTimes = [];
    const maxRequests = 10; // Максимальное количество запросов
    const timeWindow = 60000; // Временное окно в миллисекундах (1 минута)
    
    return {
      checkLimit: () => {
        const now = Date.now();
        
        // Удаляем устаревшие запросы
        while (requestTimes.length > 0 && requestTimes[0] < now - timeWindow) {
          requestTimes.shift();
        }
        
        // Проверяем, не превышен ли лимит
        if (requestTimes.length >= maxRequests) {
          return false;
        }
        
        // Добавляем текущее время запроса
        requestTimes.push(now);
        return true;
      }
    };
  })();
  
  // Функция для фильтрации XSS в пользовательском вводе
  const sanitizeInput = (input) => {
    const div = document.createElement('div');
    div.textContent = input;
    return div.innerHTML;
  };
  
  // Экспортируем функции для использования в других модулях
  window.chatbotAnimations = {
    animateChatOpen,
    animateChatClose,
    animateNewMessage,
    typeWriterEffect,
    saveMessagesToLocalStorage,
    loadMessagesFromLocalStorage,
    rateLimiter,
    sanitizeInput
  };
};

// Инициализация при загрузке страницы
document.addEventListener('DOMContentLoaded', initChatbotAnimations);

// Функция для проверки первого посещения и автоматического открытия чата
const checkFirstVisit = () => {
  const hasVisited = localStorage.getItem('chatbot_visited');
  if (!hasVisited) {
    // Устанавливаем флаг посещения
    localStorage.setItem('chatbot_visited', 'true');
    
    // Находим кнопку чат-бота
    const chatbotButton = document.querySelector('.chatbot-button');
    
    // Открываем чат автоматически через 3 секунды после загрузки
    if (chatbotButton) {
      setTimeout(() => {
        chatbotButton.click();
      }, 3000);
    }
  }
};

// Вызываем функцию проверки первого посещения
window.addEventListener('load', checkFirstVisit); 