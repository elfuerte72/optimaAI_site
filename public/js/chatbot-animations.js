/**
 * OptimaAI - Нейросетевые решения для бизнеса
 * Анимации чат-бота с использованием GSAP 3
 */

// Функция для загрузки GSAP, если он не загружен
const loadGSAP = () => {
  return new Promise((resolve, reject) => {
    if (typeof gsap !== 'undefined') {
      console.log('GSAP уже загружен, используем существующий');
      resolve(gsap);
      return;
    }
    
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
};

// Проверяем, загружен ли GSAP
const checkGSAP = () => {
  if (typeof gsap === 'undefined') {
    console.warn('GSAP не загружен. Анимации чат-бота не будут работать корректно. Пытаемся загрузить динамически...');
    // Пытаемся загрузить GSAP динамически
    return loadGSAP().then(() => {
      console.log('GSAP загружен динамически, инициализируем анимации');
      initChatbotAnimations();
      return true;
    }).catch(error => {
      console.error('Не удалось загрузить GSAP:', error);
      // Показываем уведомление пользователю
      showGSAPLoadError();
      return false;
    });
  }
  return Promise.resolve(true);
};

// Функция для отображения ошибки загрузки GSAP
const showGSAPLoadError = () => {
  // Создаем элемент уведомления
  const notification = document.createElement('div');
  notification.className = 'gsap-load-error';
  notification.innerHTML = `
    <div class="gsap-load-error-content">
      <p>Не удалось загрузить библиотеку анимаций. Некоторые элементы могут отображаться некорректно.</p>
      <button class="gsap-load-error-close">Закрыть</button>
    </div>
  `;
  
  // Добавляем стили
  const style = document.createElement('style');
  style.textContent = `
    .gsap-load-error {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background: rgba(255, 0, 0, 0.1);
      border: 1px solid rgba(255, 0, 0, 0.3);
      border-radius: 8px;
      padding: 15px;
      color: #fff;
      font-size: 14px;
      z-index: 9999;
      backdrop-filter: blur(10px);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }
    .gsap-load-error-content {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 15px;
    }
    .gsap-load-error-close {
      background: rgba(255, 255, 255, 0.2);
      border: none;
      color: white;
      padding: 5px 10px;
      border-radius: 4px;
      cursor: pointer;
      transition: background 0.3s;
    }
    .gsap-load-error-close:hover {
      background: rgba(255, 255, 255, 0.3);
    }
  `;
  
  document.head.appendChild(style);
  document.body.appendChild(notification);
  
  // Добавляем обработчик для кнопки закрытия
  const closeButton = notification.querySelector('.gsap-load-error-close');
  closeButton.addEventListener('click', () => {
    notification.remove();
  });
  
  // Автоматически скрываем через 10 секунд
  setTimeout(() => {
    notification.remove();
  }, 10000);
};

// Инициализация анимаций чат-бота
const initChatbotAnimations = () => {
  // Проверяем GSAP перед инициализацией
  checkGSAP().then(gsapLoaded => {
    if (!gsapLoaded) return;
    
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
  });
};

// Запускаем инициализацию при загрузке DOM
document.addEventListener('DOMContentLoaded', () => {
  // Проверяем наличие GSAP и инициализируем анимации
  initChatbotAnimations();
});

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