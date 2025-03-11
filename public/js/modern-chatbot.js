/**
 * OptimaAI - Нейросетевые решения для бизнеса
 * Современный чат-бот с анимациями 2025
 */

document.addEventListener('alpine:init', () => {
  Alpine.data('modernChatbot', () => ({
    isOpen: false,
    isLoading: false,
    userInput: '',
    messages: [],
    typingTimeout: null,
    animationInProgress: false,
    
    init() {
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
      }
    },
    
    animateChatClose() {
      // Анимация закрытия чата
      if (typeof gsap !== 'undefined' && this.$refs.chatWindow) {
        gsap.to(this.$refs.chatWindow, {
          opacity: 0,
          y: 50,
          scale: 0.9,
          duration: 0.3,
          ease: "power2.in"
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
      // Анимация появления последнего сообщения с использованием GSAP
      if (typeof gsap !== 'undefined') {
        const messageElements = this.$refs.chatBody.querySelectorAll('.user-message, .bot-message');
        const lastMessage = messageElements[messageElements.length - 1];
        
        if (lastMessage) {
          gsap.fromTo(lastMessage, 
            { opacity: 0, scale: 0.8, y: 20 },
            { 
              opacity: 1, 
              scale: 1, 
              y: 0,
              duration: 0.4,
              ease: "back.out(1.7)",
              onComplete: () => {
                // Отмечаем, что анимация завершена
                const index = this.messages.length - 1;
                if (this.messages[index]) {
                  this.messages[index].animationComplete = true;
                }
              }
            }
          );
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
          yoyo: true,
          repeat: 1
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
            ease: "back.out(1.7)"
          });
        } else {
          gsap.to(this.$refs.sendButton, {
            scale: 1,
            duration: 0.2,
            ease: "power2.out"
          });
        }
      }
    }
  }));
}); 