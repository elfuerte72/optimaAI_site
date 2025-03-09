<div class="chatbot-container" x-data="{ isOpen: false, step: 1, answers: {}, isSubmitting: false }">
    <!-- Кнопка чат-бота -->
    <button 
        class="chatbot-button" 
        x-on:click="isOpen = !isOpen"
        x-bind:class="{ 'active': isOpen }"
    >
        <i class="bi" x-bind:class="isOpen ? 'bi-x-lg' : 'bi-chat-dots-fill'"></i>
    </button>
    
    <!-- Окно чат-бота -->
    <div class="chatbot-window" x-show="isOpen" x-transition>
        <div class="chatbot-header">
            <h5 class="mb-0">ИИ-помощник OptimaAI</h5>
        </div>
        
        <div class="chatbot-body">
            <!-- Шаг 1: Приветствие -->
            <div x-show="step === 1">
                <div class="bot-message">
                    <p>Здравствуйте! Я ИИ-помощник OptimaAI. Я помогу вам подобрать оптимальное решение для вашего бизнеса.</p>
                    <p>Для начала, выберите отрасль вашего бизнеса:</p>
                </div>
                
                <div class="options-container">
                    <button class="option-button" x-on:click="answers.industry = 'Розничная торговля'; step = 2;">Розничная торговля</button>
                    <button class="option-button" x-on:click="answers.industry = 'Производство'; step = 2;">Производство</button>
                    <button class="option-button" x-on:click="answers.industry = 'Услуги'; step = 2;">Услуги</button>
                    <button class="option-button" x-on:click="answers.industry = 'Образование'; step = 2;">Образование</button>
                    <button class="option-button" x-on:click="answers.industry = 'Другое'; step = 2;">Другое</button>
                </div>
            </div>
            
            <!-- Шаг 2: Задачи -->
            <div x-show="step === 2">
                <div class="bot-message">
                    <p>Отлично! Какие задачи вы хотели бы автоматизировать с помощью ИИ?</p>
                </div>
                
                <div class="options-container">
                    <button class="option-button" x-on:click="answers.task = 'Анализ данных'; step = 3;">Анализ данных</button>
                    <button class="option-button" x-on:click="answers.task = 'Автоматизация ответов клиентам'; step = 3;">Автоматизация ответов клиентам</button>
                    <button class="option-button" x-on:click="answers.task = 'Генерация контента'; step = 3;">Генерация контента</button>
                    <button class="option-button" x-on:click="answers.task = 'Оптимизация процессов'; step = 3;">Оптимизация процессов</button>
                    <button class="option-button" x-on:click="answers.task = 'Другое'; step = 3;">Другое</button>
                </div>
            </div>
            
            <!-- Шаг 3: Опыт работы с ИИ -->
            <div x-show="step === 3">
                <div class="bot-message">
                    <p>Есть ли у вас опыт работы с нейросетями?</p>
                </div>
                
                <div class="options-container">
                    <button class="option-button" x-on:click="answers.experience = 'Да, есть опыт'; step = 4;">Да, есть опыт</button>
                    <button class="option-button" x-on:click="answers.experience = 'Нет, но интересно узнать'; step = 4;">Нет, но интересно узнать</button>
                    <button class="option-button" x-on:click="answers.experience = 'Нет, нужно готовое решение'; step = 4;">Нет, нужно готовое решение</button>
                </div>
            </div>
            
            <!-- Шаг 4: Результат и форма -->
            <div x-show="step === 4">
                <div class="bot-message">
                    <p>Спасибо за ответы! На основе вашей информации я могу предложить следующее решение:</p>
                    
                    <div class="recommendation-box">
                        <template x-if="answers.experience === 'Да, есть опыт'">
                            <p>Вам подойдет наша услуга <strong>"Интеграция нейросетей в бизнес-процессы"</strong>. Мы поможем интегрировать ИИ в ваши существующие системы и обучим команду эффективно использовать новые инструменты.</p>
                        </template>
                        
                        <template x-if="answers.experience === 'Нет, но интересно узнать'">
                            <p>Рекомендуем начать с нашей услуги <strong>"Консультации и обучение"</strong>. Вы получите базовые знания о нейросетях и научитесь применять их для решения бизнес-задач.</p>
                        </template>
                        
                        <template x-if="answers.experience === 'Нет, нужно готовое решение'">
                            <p>Оптимальный вариант для вас — <strong>"Настройка языковых моделей под ключ"</strong>. Мы создадим готовое решение, которое будет работать автоматически и не потребует от вас специальных знаний.</p>
                        </template>
                    </div>
                    
                    <p>Оставьте свои контактные данные, и наш специалист свяжется с вами для более детального обсуждения:</p>
                </div>
                
                <form id="chatbotForm" x-on:submit.prevent="submitChatbotForm">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Ваше имя *" x-model="answers.name" required>
                    </div>
                    
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Email *" x-model="answers.email" required>
                    </div>
                    
                    <div class="mb-3">
                        <input type="tel" class="form-control" placeholder="Телефон *" x-model="answers.phone" required>
                    </div>
                    
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="chatbotPrivacyPolicy" x-model="answers.privacy" required>
                        <label class="form-check-label" for="chatbotPrivacyPolicy">
                            Я согласен с <a href="#" target="_blank">политикой конфиденциальности</a>
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100" x-bind:disabled="isSubmitting">
                        <span x-show="!isSubmitting">Отправить</span>
                        <span x-show="isSubmitting">Отправка...</span>
                    </button>
                </form>
            </div>
            
            <!-- Шаг 5: Успешная отправка -->
            <div x-show="step === 5">
                <div class="bot-message">
                    <p>Спасибо за обращение! Ваша заявка успешно отправлена.</p>
                    <p>Наш специалист свяжется с вами в ближайшее время для обсуждения деталей.</p>
                    <p>Если у вас возникнут дополнительные вопросы, вы можете связаться с нами по телефону <a href="tel:+79123456789">+7 (912) 345-67-89</a> или по email <a href="mailto:info@optimaai.ru">info@optimaai.ru</a>.</p>
                </div>
                
                <button class="btn btn-outline-primary w-100 mt-3" x-on:click="isOpen = false">Закрыть</button>
            </div>
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
        width: 350px;
        max-height: 500px;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    
    .chatbot-header {
        background-color: #0a2463;
        color: white;
        padding: 15px;
        font-weight: 600;
    }
    
    .chatbot-body {
        padding: 20px;
        overflow-y: auto;
        max-height: 450px;
    }
    
    .bot-message {
        background-color: #f5f5f5;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 15px;
    }
    
    .bot-message p:last-child {
        margin-bottom: 0;
    }
    
    .options-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 15px;
    }
    
    .option-button {
        background-color: white;
        border: 1px solid #0a2463;
        color: #0a2463;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.2s ease;
        text-align: left;
    }
    
    .option-button:hover {
        background-color: #0a2463;
        color: white;
    }
    
    .recommendation-box {
        background-color: #e6f7ff;
        border-left: 4px solid #0a2463;
        padding: 15px;
        margin: 15px 0;
        border-radius: 0 5px 5px 0;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('chatbotData', () => ({
            isOpen: false,
            step: 1,
            answers: {},
            isSubmitting: false,
            
            submitChatbotForm() {
                this.isSubmitting = true;
                
                // Добавляем данные из анкеты
                const formData = new FormData();
                formData.append('name', this.answers.name);
                formData.append('email', this.answers.email);
                formData.append('phone', this.answers.phone);
                formData.append('message', `Отрасль: ${this.answers.industry}, Задача: ${this.answers.task}, Опыт: ${this.answers.experience}`);
                formData.append('source', 'chatbot');
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                
                // Отправляем данные
                fetch('{{ route("submit-form") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    this.isSubmitting = false;
                    
                    if (data.success) {
                        this.step = 5;
                    } else {
                        alert('Произошла ошибка при отправке формы. Пожалуйста, проверьте введенные данные.');
                    }
                })
                .catch(error => {
                    this.isSubmitting = false;
                    console.error('Error:', error);
                    alert('Произошла ошибка при отправке формы. Пожалуйста, попробуйте позже.');
                });
            }
        }));
    });
</script>
@endpush 