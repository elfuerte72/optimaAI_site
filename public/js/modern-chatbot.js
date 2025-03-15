/**
 * OptimaAI - Нейросетевые решения для бизнеса
 * Современный чат-бот с анимациями 2025
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

document.addEventListener('alpine:init', () => {
  Alpine.data('modernChatbot', () => ({
    isOpen: false,
    isLoading: false,
    userInput: '',
    messages: [],
    typingTimeout: null,
    animationInProgress: false,
    gsapLoaded: false,
    
    init() {
      // Проверяем, загружен ли GSAP
      if (typeof gsap === 'undefined') {
        console.warn('GSAP не загружен. Пытаемся загрузить динамически...');
        loadGSAP().then(() => {
          console.log('GSAP загружен динамически');
          this.gsapLoaded = true;
          this.initializeFramerMotion();
        }).catch(error => {
          console.error('Не удалось загрузить GSAP:', error);
          showGSAPLoadError();
        });
      } else {
        this.gsapLoaded = true;
        this.initializeFramerMotion();
      }
      
      // Очищаем localStorage при первой загрузке для сброса предыдущих настроек
      localStorage.removeItem('chatMessages');
      
      // Если сообщений нет, инициализируем чат с приветственным сообщением
      if (this.messages.length === 0) {
        this.initializeChat();
      }
      
      // Добавляем обработчик для закрытия чата по Escape
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && this.isOpen) {
          this.toggleChat();
        }
      });
      
      // Инициализация Framer Motion для анимаций
      this.initializeFramerMotion();
    },
    
    initializeFramerMotion() {
      // Проверяем, загружен ли Framer Motion
      const checkFramerLoaded = setInterval(() => {
        if (window.motion) {
          clearInterval(checkFramerLoaded);
          console.log('Framer Motion загружен');
        }
      }, 100);
    },
    
    initializeChat() {
      this.isLoading = true;
      
      // Имитация загрузки для первого сообщения
      setTimeout(() => {
        this.addBotMessage('Здравствуйте! Я виртуальный ассистент OptimaAI с искусственным интеллектом. Чем могу помочь? Вы можете задать вопросы о наших услугах, продуктах, условиях работы или контактах.');
      }, 1000);
    },
    
    toggleChat() {
      this.isOpen = !this.isOpen;
      
      if (this.isOpen) {
        document.body.style.overflow = 'hidden'; // Блокируем прокрутку страницы
        if (this.messages.length === 0) {
          this.initializeChat();
        }
        
        this.$nextTick(() => {
          this.scrollToBottom();
          this.animateChatOpen();
        });
      } else {
        document.body.style.overflow = ''; // Разблокируем прокрутку страницы
        this.animateChatClose();
      }
    },
    
    animateChatOpen() {
      // Анимация открытия чата с использованием GSAP, если доступен
      if (typeof gsap !== 'undefined') {
        const chatWindow = this.$refs.chatWindow;
        
        gsap.fromTo(chatWindow, 
          { opacity: 0, y: 50, scale: 0.9 },
          { 
            opacity: 1, 
            y: 0, 
            scale: 1,
            duration: 0.5,
            ease: "back.out(1.7)"
          }
        );
        
        // Анимация элементов внутри чата
        const chatElements = chatWindow.querySelectorAll('.chatbot-header, .chatbot-body, .chatbot-footer');
        
        gsap.fromTo(chatElements, 
          { opacity: 0, y: 20 },
          { 
            opacity: 1, 
            y: 0, 
            duration: 0.5,
            stagger: 0.1,
            delay: 0.2,
            ease: "power2.out"
          }
        );
      } else {
        // Если GSAP не загружен, пытаемся загрузить его динамически
        loadGSAP().then(gsapInstance => {
          const chatWindow = this.$refs.chatWindow;
          
          gsapInstance.fromTo(chatWindow, 
            { opacity: 0, y: 50, scale: 0.9 },
            { 
              opacity: 1, 
              y: 0, 
              scale: 1,
              duration: 0.5,
              ease: "back.out(1.7)"
            }
          );
          
          // Анимация элементов внутри чата
          const chatElements = chatWindow.querySelectorAll('.chatbot-header, .chatbot-body, .chatbot-footer');
          
          gsapInstance.fromTo(chatElements, 
            { opacity: 0, y: 20 },
            { 
              opacity: 1, 
              y: 0, 
              duration: 0.5,
              stagger: 0.1,
              delay: 0.2,
              ease: "power2.out"
            }
          );
          
          this.gsapLoaded = true;
        }).catch(error => {
          console.error('Не удалось загрузить GSAP для анимации:', error);
          // Если не удалось загрузить GSAP, просто показываем окно без анимации
          const chatWindow = this.$refs.chatWindow;
          chatWindow.style.opacity = 1;
        });
      }
    },
    
    animateChatClose() {
      if (typeof gsap !== 'undefined') {
        gsap.to(this.$refs.chatWindow, {
          opacity: 0,
          y: 50,
          scale: 0.8,
          duration: 0.3,
          ease: "power2.in"
        });
      } else {
        // Если GSAP не загружен, пытаемся загрузить его динамически
        loadGSAP().then(gsapInstance => {
          gsapInstance.to(this.$refs.chatWindow, {
            opacity: 0,
            y: 50,
            scale: 0.8,
            duration: 0.3,
            ease: "power2.in"
          });
        }).catch(error => {
          console.error('Не удалось загрузить GSAP для анимации закрытия:', error);
          // Если не удалось загрузить GSAP, просто скрываем окно без анимации
          this.$refs.chatWindow.style.opacity = 0;
        });
      }
    },
    
    scrollToBottom() {
      this.$nextTick(() => {
        const chatBody = this.$refs.chatBody;
        if (chatBody) {
          chatBody.scrollTop = chatBody.scrollHeight;
        }
      });
    },
    
    saveMessages() {
      // Сохраняем сообщения в localStorage для сохранения между сессиями
      localStorage.setItem('chatMessages', JSON.stringify(this.messages));
    },
    
    formatTime(date) {
      const d = new Date(date);
      return d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    },
    
    addUserMessage(message) {
      // Добавляем сообщение пользователя с анимацией
      this.messages.push({
        role: 'user',
        content: message,
        time: new Date(),
        animationComplete: false
      });
      
      this.saveMessages();
      this.scrollToBottom();
      
      // Анимируем появление сообщения
      this.$nextTick(() => {
        this.animateLastMessage();
      });
    },
    
    addBotMessage(message) {
      this.isLoading = false;
      
      // Добавляем сообщение бота с анимацией "печатания"
      this.messages.push({
        role: 'assistant',
        content: '',
        fullContent: message,
        time: new Date(),
        animationComplete: false
      });
      
      this.saveMessages();
      this.scrollToBottom();
      
      // Анимируем появление сообщения
      this.$nextTick(() => {
        this.animateLastMessage();
        this.typeWriterEffect(this.messages.length - 1);
      });
    },
    
    animateLastMessage() {
      // Анимация последнего сообщения
      const messageElements = this.$refs.chatBody.querySelectorAll('.user-message, .bot-message');
      const lastMessage = messageElements[messageElements.length - 1];
      
      if (lastMessage) {
        if (typeof gsap !== 'undefined') {
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
        } else {
          // Если GSAP не загружен, пытаемся загрузить его динамически
          loadGSAP().then(gsapInstance => {
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
          }).catch(error => {
            console.error('Не удалось загрузить GSAP для анимации сообщения:', error);
            // Если не удалось загрузить GSAP, просто показываем сообщение без анимации
            lastMessage.style.opacity = 1;
          });
        }
      }
    },
    
    typeWriterEffect(messageIndex) {
      // Эффект печатания текста для сообщений бота
      const message = this.messages[messageIndex];
      if (!message || message.role !== 'assistant' || !message.fullContent) return;
      
      let i = 0;
      const fullText = message.fullContent;
      const speed = 20; // скорость печатания (мс)
      
      const typeWriter = () => {
        if (i < fullText.length) {
          message.content = fullText.substring(0, i + 1);
          i++;
          this.scrollToBottom();
          setTimeout(typeWriter, speed);
        } else {
          // Печатание завершено
          message.content = fullText;
          this.saveMessages();
        }
      };
      
      typeWriter();
    },
    
    sendMessage() {
      if (!this.userInput.trim() || this.isLoading) return;
      
      // Сохраняем введенное сообщение
      const message = this.userInput.trim();
      this.userInput = '';
      
      // Добавляем сообщение пользователя
      this.addUserMessage(message);
      
      // Показываем индикатор загрузки
      this.isLoading = true;
      this.scrollToBottom();
      
      // Отправляем запрос к API
      fetch('/chatbot/chat', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ message })
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        if (data.success) {
          // Добавляем ответ от бота
          this.addBotMessage(data.message);
        } else {
          // Обработка ошибки
          this.addBotMessage('Извините, произошла ошибка при обработке вашего запроса. Пожалуйста, попробуйте позже или свяжитесь с нами по телефону.');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        this.addBotMessage('Извините, произошла ошибка при обработке вашего запроса. Пожалуйста, попробуйте позже или свяжитесь с нами по телефону.');
      });
    },
    
    // Эффекты микроанимаций
    pulseButton() {
      if (typeof gsap !== 'undefined' && this.$refs.chatButton) {
        gsap.to(this.$refs.chatButton, {
          scale: 1.1,
          duration: 0.3,
          ease: "elastic.out(1, 0.3)",
          onComplete: () => {
            gsap.to(this.$refs.chatButton, {
              scale: 1,
              duration: 0.2,
              ease: "power2.out"
            });
          }
        });
      } else if (this.$refs.chatButton) {
        // Если GSAP не загружен, пытаемся загрузить его динамически
        loadGSAP().then(gsapInstance => {
          gsapInstance.to(this.$refs.chatButton, {
            scale: 1.1,
            duration: 0.3,
            ease: "elastic.out(1, 0.3)",
            onComplete: () => {
              gsapInstance.to(this.$refs.chatButton, {
                scale: 1,
                duration: 0.2,
                ease: "power2.out"
              });
            }
          });
        }).catch(error => {
          console.error('Не удалось загрузить GSAP для анимации кнопки:', error);
        });
      }
    },
    
    // Анимация при наведении на кнопку отправки
    hoverSendButton(enter) {
      if (typeof gsap !== 'undefined' && this.$refs.sendButton) {
        if (enter) {
          gsap.to(this.$refs.sendButton, {
            scale: 1.1,
            duration: 0.3,
            ease: "power2.out"
          });
        } else {
          gsap.to(this.$refs.sendButton, {
            scale: 1,
            duration: 0.3,
            ease: "power2.out"
          });
        }
      } else if (this.$refs.sendButton) {
        // Если GSAP не загружен, пытаемся загрузить его динамически
        loadGSAP().then(gsapInstance => {
          if (enter) {
            gsapInstance.to(this.$refs.sendButton, {
              scale: 1.1,
              duration: 0.3,
              ease: "power2.out"
            });
          } else {
            gsapInstance.to(this.$refs.sendButton, {
              scale: 1,
              duration: 0.3,
              ease: "power2.out"
            });
          }
        }).catch(error => {
          console.error('Не удалось загрузить GSAP для анимации кнопки отправки:', error);
        });
      }
    }
  }));
}); 