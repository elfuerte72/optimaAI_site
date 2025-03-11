import React from 'react';
import { createRoot } from 'react-dom/client';
import ServiceCards from './components/services/ServiceCards';

// Функция для отладки React-приложения
const debugReactApp = () => {
    console.log('🚀 React-приложение инициализируется...');
    
    // Проверяем, загрузились ли все необходимые компоненты
    console.log('✓ React загружен:', typeof React !== 'undefined');
    console.log('✓ ReactDOM загружен:', typeof createRoot !== 'undefined');
    console.log('✓ ServiceCards загружен:', typeof ServiceCards !== 'undefined');
    
    // Находим контейнер для React компонентов
    const serviceCardsContainer = document.getElementById('react-service-cards');
    console.log('✓ Контейнер найден:', serviceCardsContainer !== null);
    
    if (!serviceCardsContainer) {
        console.error('❌ Контейнер #react-service-cards не найден на странице!');
        return;
    }
    
    // Получаем данные из атрибутов data-*
    let servicesData = [];
    try {
        const dataAttribute = serviceCardsContainer.getAttribute('data-services');
        console.log('✓ Атрибут data-services:', dataAttribute ? 'найден' : 'не найден');
        
        if (dataAttribute) {
            servicesData = JSON.parse(dataAttribute);
            console.log('✓ Данные услуг успешно распарсены:', servicesData.length, 'услуг');
        } else {
            console.warn('⚠️ Атрибут data-services пуст или отсутствует');
        }
    } catch (parseError) {
        console.error('❌ Ошибка при парсинге данных услуг:', parseError);
    }
    
    try {
        console.log('🔄 Рендеринг React компонента...');
        
        // Рендерим React компонент в контейнер
        const root = createRoot(serviceCardsContainer);
        root.render(
            <React.StrictMode>
                <div className="react-debug-info" style={{ display: 'none' }}>
                    React успешно запущен!
                </div>
                <ServiceCards services={servicesData} />
            </React.StrictMode>
        );
        
        console.log('✅ React компонент ServiceCards успешно отрендерен!');
    } catch (renderError) {
        console.error('❌ Ошибка при рендеринге React компонента:', renderError);
        
        // В случае ошибки показываем сообщение в контейнере
        serviceCardsContainer.innerHTML = `
            <div class="alert alert-danger">
                <h4>Произошла ошибка при загрузке компонентов</h4>
                <p>${renderError.message}</p>
                <p>Пожалуйста, обновите страницу или свяжитесь с администратором.</p>
            </div>
        `;
    }
};

// Инициализируем React приложение при загрузке DOM
document.addEventListener('DOMContentLoaded', debugReactApp);

// Также пробуем инициализировать через setTimeout для случаев, когда DOMContentLoaded уже произошел
setTimeout(debugReactApp, 1000); 