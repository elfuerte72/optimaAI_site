import React, { useRef, useState, useEffect } from 'react';
import { motion, useAnimation, useInView } from 'framer-motion';
import ServiceIcons from './ServiceIcons';

// Кастомный хук для 3D эффекта наклона
const use3DTilt = (ref) => {
    const [tiltValues, setTiltValues] = useState({ x: 0, y: 0 });
    
    useEffect(() => {
        if (!ref.current) return;
        
        const handleMouseMove = (e) => {
            if (!ref.current) return;
            
            // Получаем размеры и положение элемента
            const rect = ref.current.getBoundingClientRect();
            
            // Вычисляем координаты курсора относительно центра карточки
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const posX = e.clientX - rect.left;
            const posY = e.clientY - rect.top;
            
            // Рассчитываем наклон (максимум 12 градусов)
            const tiltX = ((posY - centerY) / centerY) * -12;
            const tiltY = ((posX - centerX) / centerX) * 12;
            
            // Обновляем значения
            setTiltValues({ x: tiltX, y: tiltY });
        };
        
        const handleMouseLeave = () => {
            // Плавно возвращаем к начальному состоянию
            setTiltValues({ x: 0, y: 0 });
        };
        
        // Добавляем обработчики событий
        const element = ref.current;
        if (element) {
            element.addEventListener('mousemove', handleMouseMove);
            element.addEventListener('mouseleave', handleMouseLeave);
            
            // Удаляем обработчики при размонтировании
            return () => {
                element.removeEventListener('mousemove', handleMouseMove);
                element.removeEventListener('mouseleave', handleMouseLeave);
            };
        }
    }, [ref]);
    
    return tiltValues;
};

const ServiceCard = ({ service }) => {
    if (!service) {
        console.error('ServiceCard: не переданы данные услуги');
        return <div className="error-card">Ошибка: данные услуги отсутствуют</div>;
    }
    
    const { title, description, icon, url } = service;
    const cardRef = useRef(null);
    const { x, y } = use3DTilt(cardRef);
    
    // Для отслеживания видимости элемента
    const isInView = useInView(cardRef, { once: false, margin: "-100px 0px" });
    const controls = useAnimation();
    
    // Управляем анимацией при появлении в зоне видимости
    useEffect(() => {
        if (isInView) {
            controls.start('visible');
        }
    }, [isInView, controls]);
    
    // Генерируем уникальный ID для градиента
    const gradientId = `gradient-${Math.random().toString(36).substr(2, 9)}`;
    
    return (
        <motion.div
            ref={cardRef}
            className="service-card h-100"
            style={{
                transform: `perspective(1000px) rotateX(${x}deg) rotateY(${y}deg)`,
                transition: 'transform 0.1s ease-out',
            }}
            initial={{ opacity: 0, scale: 0.9 }}
            animate={controls}
            variants={{
                visible: { 
                    opacity: 1, 
                    scale: 1,
                    transition: { 
                        type: 'spring', 
                        stiffness: 100,
                        damping: 15
                    }
                }
            }}
        >
            <svg style={{ position: 'absolute', width: 0, height: 0 }}>
                <defs>
                    <linearGradient id={gradientId} x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stopColor="rgba(179, 0, 255, 0.6)" />
                        <stop offset="100%" stopColor="rgba(0, 195, 255, 0.6)" />
                    </linearGradient>
                </defs>
            </svg>
            
            <div className="service-card-inner">
                {/* Анимация частиц внутри карточки */}
                <motion.div
                    className="particles-container"
                    style={{
                        position: 'absolute',
                        top: 0,
                        left: 0,
                        right: 0,
                        bottom: 0,
                        overflow: 'hidden',
                        zIndex: 0
                    }}
                >
                    {Array.from({ length: 8 }).map((_, i) => (
                        <motion.div
                            key={i}
                            className="particle"
                            style={{
                                position: 'absolute',
                                width: Math.random() * 4 + 2 + 'px',
                                height: Math.random() * 4 + 2 + 'px',
                                borderRadius: '50%',
                                backgroundColor: `rgba(123, 150, 255, ${Math.random() * 0.5 + 0.3})`,
                                opacity: 0,
                                top: Math.random() * 100 + '%',
                                left: Math.random() * 100 + '%'
                            }}
                            animate={{
                                y: [0, -50 - Math.random() * 50],
                                x: [0, (Math.random() - 0.5) * 30],
                                opacity: [0, 0.7, 0],
                                scale: [1, 0.5]
                            }}
                            transition={{
                                duration: 2 + Math.random() * 3,
                                repeat: Infinity,
                                delay: Math.random() * 5
                            }}
                        />
                    ))}
                </motion.div>
                
                <div className="service-icon-wrapper mb-4">
                    {icon === 'consulting-icon' && <ServiceIcons.ConsultingIcon />}
                    {icon === 'models-icon' && <ServiceIcons.ModelsIcon />}
                    {icon === 'integration-icon' && <ServiceIcons.IntegrationIcon />}
                </div>
                
                <motion.h3 
                    className="h4 mb-3"
                    initial={{ opacity: 0, y: 10 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ delay: 0.2 }}
                >
                    {title}
                </motion.h3>
                
                <motion.p 
                    className="mb-4"
                    initial={{ opacity: 0 }}
                    animate={{ opacity: 1 }}
                    transition={{ delay: 0.3 }}
                >
                    {description}
                </motion.p>
                
                <div className="service-cta mt-auto">
                    <motion.a
                        href={url}
                        className="btn btn-outline-primary btn-modern"
                        whileHover={{ 
                            scale: 1.05,
                            textShadow: "0px 0px 8px rgb(255, 255, 255)",
                            boxShadow: "0px 0px 8px rgba(123, 150, 255, 0.6)",
                            color: "#ffffff"
                        }}
                        whileTap={{ scale: 0.95 }}
                        initial={{ opacity: 0, y: 20 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ 
                            delay: 0.4,
                            type: "spring", 
                            stiffness: 400, 
                            damping: 10 
                        }}
                    >
                        <motion.span
                            style={{ display: 'inline-block' }}
                            animate={{ x: [0, 3, 0] }}
                            transition={{
                                duration: 1.5,
                                repeat: Infinity,
                                repeatType: "reverse"
                            }}
                        >
                            Подробнее
                        </motion.span>
                    </motion.a>
                </div>
            </div>
        </motion.div>
    );
};

export default ServiceCard; 