/**
 * OptimaAI - Нейросетевые решения для бизнеса
 * Основные скрипты сайта
 */

document.addEventListener('DOMContentLoaded', function() {
    // Инициализация всплывающих подсказок
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Инициализация всплывающих окон
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Обработка форм
    setupForms();

    // Инициализация чат-бота
    setupChatbot();

    // Анимация при скролле
    setupScrollAnimations();
});

/**
 * Настройка обработки форм
 */
function setupForms() {
    // Получаем все формы на странице
    const forms = document.querySelectorAll('form');

    forms.forEach(form => {
        // Проверяем, что это не форма чат-бота (у нее своя обработка)
        if (form.id !== 'chatbotForm') {
            form.addEventListener('submit', function(e) {
                // Если форма имеет атрибут data-ajax="true", то обрабатываем ее через AJAX
                if (form.getAttribute('data-ajax') === 'true') {
                    e.preventDefault();
                    
                    const formData = new FormData(form);
                    
                    // Показываем индикатор загрузки
                    const submitButton = form.querySelector('button[type="submit"]');
                    const originalButtonText = submitButton.innerHTML;
                    submitButton.disabled = true;
                    submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Отправка...';
                    
                    fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Восстанавливаем кнопку
                        submitButton.disabled = false;
                        submitButton.innerHTML = originalButtonText;
                        
                        if (data.success) {
                            // Очищаем форму
                            form.reset();
                            
                            // Показываем сообщение об успехе
                            showNotification('success', data.message || 'Форма успешно отправлена!');
                            
                            // Если это модальное окно, закрываем его
                            const modal = bootstrap.Modal.getInstance(form.closest('.modal'));
                            if (modal) {
                                modal.hide();
                            }
                        } else {
                            // Показываем ошибки
                            showNotification('error', data.message || 'Произошла ошибка при отправке формы.');
                            
                            // Если есть ошибки валидации, показываем их
                            if (data.errors) {
                                Object.keys(data.errors).forEach(field => {
                                    const input = form.querySelector(`[name="${field}"]`);
                                    if (input) {
                                        input.classList.add('is-invalid');
                                        
                                        // Создаем элемент с сообщением об ошибке
                                        const feedback = document.createElement('div');
                                        feedback.className = 'invalid-feedback';
                                        feedback.textContent = data.errors[field][0];
                                        
                                        // Добавляем после input
                                        input.parentNode.appendChild(feedback);
                                    }
                                });
                            }
                        }
                    })
                    .catch(error => {
                        // Восстанавливаем кнопку
                        submitButton.disabled = false;
                        submitButton.innerHTML = originalButtonText;
                        
                        // Показываем ошибку
                        showNotification('error', 'Произошла ошибка при отправке формы. Пожалуйста, попробуйте позже.');
                        console.error('Error:', error);
                    });
                }
            });
        }
    });
}

/**
 * Настройка чат-бота
 */
function setupChatbot() {
    // Эта функция будет вызвана из Alpine.js
    // Все основные функции чат-бота реализованы в шаблоне partials/chatbot.blade.php
}

/**
 * Настройка анимаций при скролле
 */
function setupScrollAnimations() {
    // Получаем все элементы, которые нужно анимировать
    const animatedElements = document.querySelectorAll('.animate-on-scroll');
    
    // Функция для проверки, виден ли элемент
    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top <= (window.innerHeight || document.documentElement.clientHeight) * 0.8
        );
    }
    
    // Функция для анимации элементов
    function animateElements() {
        animatedElements.forEach(element => {
            if (isElementInViewport(element) && !element.classList.contains('animated')) {
                element.classList.add('animated');
            }
        });
    }
    
    // Запускаем анимацию при загрузке страницы
    animateElements();
    
    // Запускаем анимацию при скролле
    window.addEventListener('scroll', animateElements);
}

/**
 * Показывает уведомление
 * 
 * @param {string} type Тип уведомления (success, error, warning, info)
 * @param {string} message Сообщение
 */
function showNotification(type, message) {
    // Создаем элемент уведомления
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-icon">
            <i class="bi ${type === 'success' ? 'bi-check-circle' : type === 'error' ? 'bi-exclamation-circle' : 'bi-info-circle'}"></i>
        </div>
        <div class="notification-content">
            <p>${message}</p>
        </div>
        <button type="button" class="notification-close" aria-label="Close">
            <i class="bi bi-x"></i>
        </button>
    `;
    
    // Добавляем уведомление на страницу
    document.body.appendChild(notification);
    
    // Показываем уведомление
    setTimeout(() => {
        notification.classList.add('show');
    }, 100);
    
    // Скрываем уведомление через 5 секунд
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 5000);
    
    // Обработка клика по кнопке закрытия
    notification.querySelector('.notification-close').addEventListener('click', () => {
        notification.classList.remove('show');
        setTimeout(() => {
            notification.remove();
        }, 300);
    });
}

/**
 * Стили для уведомлений
 */
const notificationStyles = document.createElement('style');
notificationStyles.textContent = `
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        display: flex;
        align-items: center;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        background-color: white;
        max-width: 350px;
        z-index: 9999;
        transform: translateX(100%);
        opacity: 0;
        transition: transform 0.3s ease, opacity 0.3s ease;
    }
    
    .notification.show {
        transform: translateX(0);
        opacity: 1;
    }
    
    .notification-icon {
        margin-right: 15px;
        font-size: 24px;
    }
    
    .notification-success .notification-icon {
        color: #28a745;
    }
    
    .notification-error .notification-icon {
        color: #dc3545;
    }
    
    .notification-warning .notification-icon {
        color: #ffc107;
    }
    
    .notification-info .notification-icon {
        color: #17a2b8;
    }
    
    .notification-content {
        flex: 1;
    }
    
    .notification-content p {
        margin: 0;
    }
    
    .notification-close {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 18px;
        padding: 0;
        margin-left: 15px;
        color: #6c757d;
    }
    
    @media (max-width: 767.98px) {
        .notification {
            top: auto;
            bottom: 20px;
            left: 20px;
            right: 20px;
            max-width: none;
            transform: translateY(100%);
        }
        
        .notification.show {
            transform: translateY(0);
        }
    }
`;

document.head.appendChild(notificationStyles); 