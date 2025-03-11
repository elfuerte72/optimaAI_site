<div class="chatbot-container" x-data="modernChatbot">
    <!-- Кнопка чат-бота -->
    <button 
        class="chatbot-button animate__animated animate__pulse animate__infinite" 
        x-on:click="toggleChat"
        x-bind:class="{ 'active': isOpen }"
        x-on:mouseenter="pulseButton"
        x-ref="chatButton"
    >
        <i class="bi" x-bind:class="isOpen ? 'bi-x-lg' : 'bi-chat-dots-fill'"></i>
    </button>
    
    <!-- Окно чат-бота -->
    <div 
        class="chatbot-window" 
        x-show="isOpen" 
        x-transition:enter="animate__fadeIn animate__faster"
        x-transition:leave="animate__fadeOut animate__faster"
        x-bind:class="{ 'chatbot-window-expanded': isOpen }"
        x-ref="chatWindow"
    >
        <div class="chatbot-background"></div>
        
        <div class="chatbot-header">
            <div class="chatbot-header-left">
                <h5 class="mb-0">ИИ-помощник OptimaAI</h5>
                <span class="chatbot-status">Онлайн</span>
            </div>
            <div class="chatbot-header-right">
                <button class="btn-close" x-on:click="toggleChat" title="Закрыть">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        </div>
        
        <div class="chatbot-content">
            <div class="chatbot-body" x-ref="chatBody">
                <!-- Сообщения чата -->
                <template x-for="(message, index) in messages" :key="index">
                    <div x-bind:class="message.role === 'user' ? 'user-message' : 'bot-message'">
                        <div class="message-content">
                            <p x-html="message.content"></p>
                        </div>
                        <div class="message-time" x-text="formatTime(message.time || new Date())"></div>
                    </div>
                </template>
                
                <!-- Индикатор загрузки -->
                <div class="bot-message typing-indicator" x-show="isLoading">
                    <div class="message-content">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
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
                        class="send-button" 
                        type="submit"
                        x-bind:disabled="isLoading || !userInput.trim()"
                        x-on:mouseenter="hoverSendButton(true)"
                        x-on:mouseleave="hoverSendButton(false)"
                        x-ref="sendButton"
                    >
                        <i class="bi bi-send"></i>
                    </button>
                </div>
                <div class="chatbot-footer-actions">
                    <span class="powered-by">Powered by OptimaAI</span>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('css/modern-chatbot.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/modern-chatbot.js') }}"></script>
@endpush 