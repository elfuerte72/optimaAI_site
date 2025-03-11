<div class="chatbot-container" x-data="chatbotData">
    <!-- Кнопка чат-бота -->
    <button 
        class="chatbot-button animate__animated animate__pulse animate__infinite" 
        x-on:click="toggleChat"
        x-bind:class="{ 'active': isOpen }"
    >
        <i class="bi" x-bind:class="isOpen ? 'bi-x-lg' : 'bi-chat-dots-fill'"></i>
    </button>
    
    <!-- Окно чат-бота -->
    <div 
        class="chatbot-window animate__animated" 
        x-show="isOpen" 
        x-transition:enter="animate__fadeIn animate__faster"
        x-transition:leave="animate__fadeOut animate__faster"
        x-bind:class="{ 'chatbot-window-expanded': isOpen }"
    >
        <div class="chatbot-header">
            <h5 class="mb-0">ИИ-помощник OptimaAI</h5>
            <button class="btn-reset btn-primary-outline" x-on:click="resetChat" title="Начать новый диалог">
                <i class="bi bi-arrow-counterclockwise"></i>
            </button>
        </div>
        
        <div class="chatbot-body" x-ref="chatBody">
            <!-- Сообщения чата -->
            <template x-for="(message, index) in messages" :key="index">
                <div x-bind:class="message.role === 'user' ? 'user-message' : 'bot-message'">
                    <p x-text="message.content"></p>
                </div>
            </template>
            
            <!-- Индикатор загрузки -->
            <div class="bot-message typing-indicator" x-show="isLoading">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        
        <!-- Форма отправки сообщения -->
        <div class="chatbot-footer">
            <form x-on:submit.prevent="sendMessage">
                <div class="input-group">
                    <input 
                        type="text" 
                        class="form-control" 
                        placeholder="Введите ваш вопрос..." 
                        x-model="userInput"
                        x-bind:disabled="isLoading"
                        x-on:keydown.enter="sendMessage"
                    >
                    <button 
                        class="btn btn-primary" 
                        type="submit"
                        x-bind:disabled="isLoading || !userInput.trim()"
                    >
                        <i class="bi bi-send"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    .chatbot-container {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1000;
    }
    
    .chatbot-button {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: #0a2463;
        color: white;
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .chatbot-button:hover {
        background-color: #0d2d7a;
        transform: scale(1.05);
    }
    
    .chatbot-button.active {
        background-color: #3cb371;
    }
    
    .chatbot-window {
        position: absolute;
        bottom: 80px;
        right: 0;
        width: 437px; /* Увеличено на 25% от 350px */
        height: 625px; /* Увеличено на 25% от 500px */
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: all 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        transform-origin: bottom right;
    }
    
    .chatbot-window-expanded {
        animation: expand-chat 0.5s forwards;
    }
    
    @keyframes expand-chat {
        0% { transform: scale(0.8); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }
    
    .chatbot-header {
        background-color: #0a2463;
        color: white;
        padding: 15px;
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .btn-reset {
        background: none;
        border: none;
        color: white;
        font-size: 18px;
        cursor: pointer;
        padding: 8px;
        margin: 0;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .btn-reset:hover {
        background-color: rgba(255, 255, 255, 0.2);
        transform: rotate(-30deg);
    }
    
    .btn-primary-outline {
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    .chatbot-body {
        padding: 20px;
        overflow-y: auto;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .bot-message, .user-message {
        padding: 12px 15px;
        border-radius: 10px;
        max-width: 80%;
        word-wrap: break-word;
        animation: message-appear 0.3s ease-out forwards;
    }
    
    @keyframes message-appear {
        0% { opacity: 0; transform: translateY(10px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    
    .bot-message {
        background-color: #f5f5f5;
        align-self: flex-start;
        border-bottom-left-radius: 0;
    }
    
    .user-message {
        background-color: #0a2463;
        color: white;
        align-self: flex-end;
        border-bottom-right-radius: 0;
    }
    
    .bot-message p, .user-message p {
        margin-bottom: 0;
    }
    
    .chatbot-footer {
        padding: 10px;
        border-top: 1px solid #eee;
    }
    
    .typing-indicator {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        min-height: 20px;
        min-width: 60px;
    }
    
    .typing-indicator span {
        height: 8px;
        width: 8px;
        background-color: #777;
        border-radius: 50%;
        display: inline-block;
        margin-right: 5px;
        animation: typing 1.5s infinite ease-in-out;
    }
    
    .typing-indicator span:nth-child(1) {
        animation-delay: 0s;
    }
    
    .typing-indicator span:nth-child(2) {
        animation-delay: 0.3s;
    }
    
    .typing-indicator span:nth-child(3) {
        animation-delay: 0.6s;
        margin-right: 0;
    }
    
    @keyframes typing {
        0% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
        100% { transform: translateY(0); }
    }
    
    @media (max-width: 576px) {
        .chatbot-window {
            width: 90vw;
            height: 70vh;
            bottom: 80px;
            right: 5vw;
        }
        
        .chatbot-container {
            bottom: 20px;
            right: 20px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('chatbotData', () => ({
            isOpen: false,
            isLoading: false,
            userInput: '',
            messages: [],
            
            init() {
                // Проверяем, есть ли сохраненные сообщения в localStorage
                const savedMessages = localStorage.getItem('chatMessages');
                if (savedMessages) {
                    try {
                        this.messages = JSON.parse(savedMessages);
                    } catch (e) {
                        console.error('Error parsing saved messages:', e);
                        this.messages = [];
                    }
                }
                
                // Если сообщений нет, инициализируем чат с приветственным сообщением
                if (this.messages.length === 0) {
                    this.initializeChat();
                }
                
                // Добавляем Animate.css для анимаций
                if (!document.getElementById('animate-css')) {
                    const link = document.createElement('link');
                    link.id = 'animate-css';
                    link.rel = 'stylesheet';
                    link.href = 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css';
                    document.head.appendChild(link);
                }
            },
            
            initializeChat() {
                this.isLoading = true;
                
                // Имитация загрузки для первого сообщения
                setTimeout(() => {
                    this.messages.push({
                        role: 'assistant',
                        content: 'Здравствуйте! Я виртуальный ассистент OptimaAI. Чем могу помочь? Вы можете задать вопросы о наших услугах, продуктах, условиях работы или контактах.'
                    });
                    this.isLoading = false;
                    this.scrollToBottom();
                    this.saveMessages();
                }, 1000);
            },
            
            toggleChat() {
                this.isOpen = !this.isOpen;
                if (this.isOpen && this.messages.length === 0) {
                    this.initializeChat();
                }
                if (this.isOpen) {
                    this.$nextTick(() => {
                        this.scrollToBottom();
                    });
                }
            },
            
            scrollToBottom() {
                this.$nextTick(() => {
                    const chatBody = this.$refs.chatBody;
                    chatBody.scrollTop = chatBody.scrollHeight;
                });
            },
            
            saveMessages() {
                // Сохраняем сообщения в localStorage для сохранения между сессиями
                localStorage.setItem('chatMessages', JSON.stringify(this.messages));
            },
            
            sendMessage() {
                if (!this.userInput.trim() || this.isLoading) return;
                
                // Добавляем сообщение пользователя
                this.messages.push({
                    role: 'user',
                    content: this.userInput.trim()
                });
                
                const message = this.userInput.trim();
                this.userInput = '';
                this.isLoading = true;
                this.scrollToBottom();
                this.saveMessages();
                
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
                        this.messages.push({
                            role: 'assistant',
                            content: data.message
                        });
                        this.saveMessages();
                    } else {
                        // Обработка ошибки
                        this.messages.push({
                            role: 'assistant',
                            content: 'Извините, произошла ошибка при обработке вашего запроса. Пожалуйста, попробуйте позже или свяжитесь с нами по телефону.'
                        });
                        this.saveMessages();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    this.messages.push({
                        role: 'assistant',
                        content: 'Извините, произошла ошибка при обработке вашего запроса. Пожалуйста, попробуйте позже или свяжитесь с нами по телефону.'
                    });
                    this.saveMessages();
                })
                .finally(() => {
                    this.isLoading = false;
                    this.scrollToBottom();
                });
            },
            
            resetChat() {
                this.isLoading = true;
                
                // Отправляем запрос на сброс истории чата
                fetch('/chatbot/reset', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Очищаем историю сообщений
                        this.messages = [];
                        localStorage.removeItem('chatMessages');
                        // Инициализируем чат заново
                        this.initializeChat();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    this.isLoading = false;
                });
            }
        }));
    });
</script>
@endpush 