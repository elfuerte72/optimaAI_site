import React, { useState, useEffect } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import ServiceCard from './ServiceCard';

// Демо-данные для услуг, если не переданы через props
const demoServices = [
    {
        id: 1,
        title: 'Консультации и обучение',
        description: 'Экспертная помощь в выборе оптимальных нейросетевых решений и обучение вашей команды работе с ИИ-инструментами',
        icon: 'consulting-icon',
        url: '/services/consulting-and-training',
    },
    {
        id: 2,
        title: 'Настройка языковых моделей',
        description: 'Профессиональная настройка и fine-tuning нейросетевых моделей под специфику вашей отрасли и задачи',
        icon: 'models-icon',
        url: '/services/language-models-setup',
    },
    {
        id: 3,
        title: 'Интеграция ИИ в бизнес',
        description: 'Комплексное внедрение искусственного интеллекта в рабочие процессы компании с измеримыми результатами',
        icon: 'integration-icon',
        url: '/services/ai-business-integration',
    },
];

const ServiceCards = ({ services = [] }) => {
    // Используем переданные данные или демо-данные
    const serviceData = services.length > 0 ? services : demoServices;
    
    // Состояние для отслеживания видимых карточек
    const [visibleCards, setVisibleCards] = useState([]);
    
    // Эффект для постепенного появления карточек при загрузке
    useEffect(() => {
        // Функция для постепенного добавления карточек с задержкой
        const showCardsWithDelay = () => {
            serviceData.forEach((service, index) => {
                setTimeout(() => {
                    setVisibleCards(prev => [...prev, service.id]);
                }, index * 200); // 200ms задержка между появлениями
            });
        };
        
        // Запускаем отображение карточек через небольшую паузу после монтирования
        const timer = setTimeout(showCardsWithDelay, 100);
        
        // Очистка таймера при размонтировании
        return () => clearTimeout(timer);
    }, [serviceData]);
    
    return (
        <div className="row g-4">
            <AnimatePresence>
                {serviceData.map((service, index) => (
                    <motion.div
                        key={service.id}
                        className="col-md-4"
                        initial={{ opacity: 0, y: 50 }}
                        animate={visibleCards.includes(service.id) ? { 
                            opacity: 1, 
                            y: 0,
                            transition: { 
                                type: 'spring', 
                                stiffness: 100, 
                                damping: 15,
                                delay: index * 0.1 
                            } 
                        } : {}}
                        exit={{ opacity: 0, y: -50 }}
                        whileHover={{ scale: 1.02, y: -5 }}
                    >
                        <ServiceCard service={service} />
                    </motion.div>
                ))}
            </AnimatePresence>
        </div>
    );
};

export default ServiceCards; 