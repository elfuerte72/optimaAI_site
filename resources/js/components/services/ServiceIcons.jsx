import React, { useEffect, useRef } from 'react';
import { motion, useAnimation } from 'framer-motion';
// Временно закомментируем GSAP, так как он может вызывать проблемы
// import gsap from 'gsap';

const ConsultingIcon = () => {
    const iconRef = useRef(null);
    
    // Используем framer-motion вместо GSAP для совместимости
    /*
    useEffect(() => {
        if (!iconRef.current) return;
        
        // GSAP анимация для нейронных связей в мозге
        const neuralPaths = iconRef.current.querySelectorAll('.neural-path');
        
        gsap.set(neuralPaths, { 
            strokeDasharray: '8 15',
            strokeDashoffset: 120
        });
        
        const timeline = gsap.timeline({ repeat: -1 });
        
        neuralPaths.forEach((path, index) => {
            timeline.to(path, {
                strokeDashoffset: -120,
                duration: 6,
                ease: 'linear',
                delay: index * 0.4
            }, 0);
        });
        
        // Очистка при размонтировании
        return () => {
            timeline.kill();
        };
    }, []);
    */
    
    return (
        <motion.div
            ref={iconRef}
            whileHover={{ scale: 1.15 }}
            transition={{ type: 'spring', stiffness: 300 }}
        >
            <svg viewBox="0 0 100 100" width="100%" height="100%">
                <g fill="none" stroke="#6366f1" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                    {/* Контур мозга */}
                    <path d="M30,25 Q40,15 50,25 Q60,15 70,25 Q80,35 70,50 Q80,65 70,75 Q60,85 50,75 Q40,85 30,75 Q20,65 30,50 Q20,35 30,25" />
                    
                    {/* Нейронные соединения с анимацией через framer-motion */}
                    <motion.path 
                        d="M40,30 Q50,20 60,30" 
                        strokeDasharray="8 15"
                        animate={{ strokeDashoffset: [120, -120] }}
                        transition={{ duration: 6, repeat: Infinity, ease: "linear" }}
                        opacity="0.8" 
                    />
                    <motion.path 
                        d="M35,40 Q50,30 65,40" 
                        strokeDasharray="8 15"
                        animate={{ strokeDashoffset: [120, -120] }}
                        transition={{ duration: 6, repeat: Infinity, ease: "linear", delay: 0.4 }}
                        opacity="0.8" 
                    />
                    <motion.path 
                        d="M30,50 Q50,45 70,50" 
                        strokeDasharray="8 15"
                        animate={{ strokeDashoffset: [120, -120] }}
                        transition={{ duration: 6, repeat: Infinity, ease: "linear", delay: 0.8 }}
                        opacity="0.8" 
                    />
                    <motion.path 
                        d="M35,60 Q50,70 65,60" 
                        strokeDasharray="8 15"
                        animate={{ strokeDashoffset: [120, -120] }}
                        transition={{ duration: 6, repeat: Infinity, ease: "linear", delay: 1.2 }}
                        opacity="0.8" 
                    />
                    <motion.path 
                        d="M40,70 Q50,80 60,70" 
                        strokeDasharray="8 15"
                        animate={{ strokeDashoffset: [120, -120] }}
                        transition={{ duration: 6, repeat: Infinity, ease: "linear", delay: 1.6 }}
                        opacity="0.8" 
                    />
                    
                    {/* Нейроны (точки) */}
                    <motion.circle cx="40" cy="30" r="3" fill="#6366f1" 
                        animate={{ scale: [1, 1.5, 1], opacity: [0.5, 1, 0.5] }} 
                        transition={{ duration: 2, repeat: Infinity }} 
                    />
                    <motion.circle cx="60" cy="30" r="3" fill="#6366f1" 
                        animate={{ scale: [1, 1.5, 1], opacity: [0.5, 1, 0.5] }} 
                        transition={{ duration: 2, repeat: Infinity, delay: 0.7 }} 
                    />
                    <motion.circle cx="35" cy="40" r="3" fill="#6366f1" 
                        animate={{ scale: [1, 1.5, 1], opacity: [0.5, 1, 0.5] }} 
                        transition={{ duration: 2, repeat: Infinity, delay: 0.2 }} 
                    />
                    <motion.circle cx="65" cy="40" r="3" fill="#6366f1" 
                        animate={{ scale: [1, 1.5, 1], opacity: [0.5, 1, 0.5] }} 
                        transition={{ duration: 2, repeat: Infinity, delay: 0.9 }} 
                    />
                    <motion.circle cx="30" cy="50" r="3" fill="#6366f1" 
                        animate={{ scale: [1, 1.5, 1], opacity: [0.5, 1, 0.5] }} 
                        transition={{ duration: 2, repeat: Infinity, delay: 0.4 }} 
                    />
                    <motion.circle cx="70" cy="50" r="3" fill="#6366f1" 
                        animate={{ scale: [1, 1.5, 1], opacity: [0.5, 1, 0.5] }} 
                        transition={{ duration: 2, repeat: Infinity, delay: 1.1 }} 
                    />
                    <motion.circle cx="35" cy="60" r="3" fill="#6366f1" 
                        animate={{ scale: [1, 1.5, 1], opacity: [0.5, 1, 0.5] }} 
                        transition={{ duration: 2, repeat: Infinity, delay: 0.6 }} 
                    />
                    <motion.circle cx="65" cy="60" r="3" fill="#6366f1" 
                        animate={{ scale: [1, 1.5, 1], opacity: [0.5, 1, 0.5] }} 
                        transition={{ duration: 2, repeat: Infinity, delay: 1.3 }} 
                    />
                    <motion.circle cx="40" cy="70" r="3" fill="#6366f1" 
                        animate={{ scale: [1, 1.5, 1], opacity: [0.5, 1, 0.5] }} 
                        transition={{ duration: 2, repeat: Infinity, delay: 0.8 }} 
                    />
                    <motion.circle cx="60" cy="70" r="3" fill="#6366f1" 
                        animate={{ scale: [1, 1.5, 1], opacity: [0.5, 1, 0.5] }} 
                        transition={{ duration: 2, repeat: Infinity, delay: 1.5 }} 
                    />
                </g>
            </svg>
        </motion.div>
    );
};

const ModelsIcon = () => {
    const controls = useAnimation();
    
    // Упрощенная анимация для линий кода
    useEffect(() => {
        const animateLines = async () => {
            try {
                // Анимируем последовательно каждую строку кода
                await controls.start('lineOne');
                await new Promise(resolve => setTimeout(resolve, 300));
                await controls.start('lineTwo');
                await new Promise(resolve => setTimeout(resolve, 300));
                await controls.start('lineThree');
                await new Promise(resolve => setTimeout(resolve, 1000));
                await controls.start('reset');
                await new Promise(resolve => setTimeout(resolve, 500));
                
                // Повторяем анимацию
                animateLines();
            } catch (error) {
                console.error('Ошибка анимации кода:', error);
            }
        };
        
        animateLines();
        
        // Очистка при размонтировании
        return () => {
            controls.stop();
        };
    }, [controls]);
    
    return (
        <motion.div
            whileHover={{ scale: 1.15 }}
            transition={{ type: 'spring', stiffness: 300 }}
        >
            <svg viewBox="0 0 100 100" width="100%" height="100%">
                <g stroke="#6366f1" strokeWidth="2" fill="none">
                    {/* Фон редактора кода */}
                    <rect x="15" y="15" width="70" height="70" rx="4" ry="4" fillOpacity="0.1" fill="#6366f1" />
                    
                    {/* Заголовок редактора */}
                    <rect x="15" y="15" width="70" height="10" rx="4" ry="4" fillOpacity="0.3" fill="#6366f1" />
                    
                    {/* Точки меню в заголовке */}
                    <circle cx="22" cy="20" r="2" fill="#6366f1" />
                    <circle cx="30" cy="20" r="2" fill="#6366f1" />
                    <circle cx="38" cy="20" r="2" fill="#6366f1" />
                    
                    {/* Линии кода с анимацией */}
                    <motion.line 
                        x1="25" y1="40" x2="25" y2="40" 
                        variants={{
                            lineOne: { x2: 75 },
                            reset: { x2: 25 }
                        }}
                        initial={{ x2: 25 }}
                        animate={controls}
                        transition={{ duration: 0.5 }}
                    />
                    <motion.line 
                        x1="25" y1="50" x2="25" y2="50" 
                        variants={{
                            lineTwo: { x2: 65 },
                            reset: { x2: 25 }
                        }}
                        initial={{ x2: 25 }}
                        animate={controls}
                        transition={{ duration: 0.4 }}
                    />
                    <motion.line 
                        x1="25" y1="60" x2="25" y2="60" 
                        variants={{
                            lineThree: { x2: 55 },
                            reset: { x2: 25 }
                        }}
                        initial={{ x2: 25 }}
                        animate={controls}
                        transition={{ duration: 0.3 }}
                    />
                    
                    {/* Мигающий курсор */}
                    <motion.rect 
                        x="25" y="70" 
                        width="2" height="10" 
                        fill="#6366f1"
                        animate={{ opacity: [0, 1, 0] }}
                        transition={{ duration: 1, repeat: Infinity }}
                    />
                </g>
            </svg>
        </motion.div>
    );
};

const IntegrationIcon = () => {
    return (
        <motion.div
            whileHover={{ scale: 1.15 }}
            transition={{ type: 'spring', stiffness: 300 }}
        >
            <svg viewBox="0 0 100 100" width="100%" height="100%">
                <defs>
                    <linearGradient id="connector-gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stopColor="#6366f1" stopOpacity="0.2" />
                        <stop offset="50%" stopColor="#6366f1" stopOpacity="1" />
                        <stop offset="100%" stopColor="#6366f1" stopOpacity="0.2" />
                    </linearGradient>
                </defs>
                
                <g stroke="#6366f1" strokeWidth="2" fill="none">
                    {/* Основные узлы */}
                    <motion.circle cx="25" cy="25" r="8" 
                        fill="rgba(99, 102, 241, 0.2)"
                        animate={{ 
                            scale: [1, 1.15, 1],
                            fillOpacity: [0.2, 0.5, 0.2]
                        }}
                        transition={{ duration: 3, repeat: Infinity, delay: 0 }}
                    />
                    <motion.circle cx="75" cy="25" r="8" 
                        fill="rgba(99, 102, 241, 0.2)"
                        animate={{ 
                            scale: [1, 1.15, 1],
                            fillOpacity: [0.2, 0.5, 0.2]
                        }}
                        transition={{ duration: 3, repeat: Infinity, delay: 1 }}
                    />
                    <motion.circle cx="50" cy="50" r="10" 
                        fill="rgba(179, 0, 255, 0.2)"
                        animate={{ 
                            scale: [1, 1.2, 1],
                            fillOpacity: [0.2, 0.5, 0.2]
                        }}
                        transition={{ duration: 4, repeat: Infinity, delay: 0.5 }}
                    />
                    <motion.circle cx="25" cy="75" r="8" 
                        fill="rgba(99, 102, 241, 0.2)"
                        animate={{ 
                            scale: [1, 1.15, 1],
                            fillOpacity: [0.2, 0.5, 0.2]
                        }}
                        transition={{ duration: 3, repeat: Infinity, delay: 2 }}
                    />
                    <motion.circle cx="75" cy="75" r="8" 
                        fill="rgba(99, 102, 241, 0.2)"
                        animate={{ 
                            scale: [1, 1.15, 1],
                            fillOpacity: [0.2, 0.5, 0.2]
                        }}
                        transition={{ duration: 3, repeat: Infinity, delay: 3 }}
                    />
                    
                    {/* Соединительные линии с анимацией движения данных */}
                    <motion.line x1="33" y1="25" x2="67" y2="25" stroke="#6366f1" strokeWidth="2"
                        strokeDasharray="2 4"
                        animate={{ strokeDashoffset: [20, 0] }}
                        transition={{ duration: 1.5, repeat: Infinity, ease: 'linear' }}
                    />
                    <motion.line x1="25" y1="33" x2="25" y2="67" stroke="#6366f1" strokeWidth="2"
                        strokeDasharray="2 4"
                        animate={{ strokeDashoffset: [20, 0] }}
                        transition={{ duration: 1.5, repeat: Infinity, ease: 'linear', delay: 0.2 }}
                    />
                    <motion.line x1="75" y1="33" x2="75" y2="67" stroke="#6366f1" strokeWidth="2"
                        strokeDasharray="2 4"
                        animate={{ strokeDashoffset: [20, 0] }}
                        transition={{ duration: 1.5, repeat: Infinity, ease: 'linear', delay: 0.4 }}
                    />
                    <motion.line x1="33" y1="75" x2="67" y2="75" stroke="#6366f1" strokeWidth="2"
                        strokeDasharray="2 4"
                        animate={{ strokeDashoffset: [20, 0] }}
                        transition={{ duration: 1.5, repeat: Infinity, ease: 'linear', delay: 0.6 }}
                    />
                    
                    {/* Диагональные соединения */}
                    <motion.line x1="33" y1="33" x2="47" y2="47" stroke="#6366f1" strokeWidth="2"
                        strokeDasharray="2 4"
                        animate={{ strokeDashoffset: [20, 0] }}
                        transition={{ duration: 1.5, repeat: Infinity, ease: 'linear', delay: 0.8 }}
                    />
                    <motion.line x1="67" y1="33" x2="53" y2="47" stroke="#6366f1" strokeWidth="2"
                        strokeDasharray="2 4"
                        animate={{ strokeDashoffset: [20, 0] }}
                        transition={{ duration: 1.5, repeat: Infinity, ease: 'linear', delay: 1.0 }}
                    />
                    <motion.line x1="33" y1="67" x2="47" y2="53" stroke="#6366f1" strokeWidth="2"
                        strokeDasharray="2 4"
                        animate={{ strokeDashoffset: [20, 0] }}
                        transition={{ duration: 1.5, repeat: Infinity, ease: 'linear', delay: 1.2 }}
                    />
                    <motion.line x1="67" y1="67" x2="53" y2="53" stroke="#6366f1" strokeWidth="2"
                        strokeDasharray="2 4"
                        animate={{ strokeDashoffset: [20, 0] }}
                        transition={{ duration: 1.5, repeat: Infinity, ease: 'linear', delay: 1.4 }}
                    />
                    
                    {/* Пакеты данных, движущиеся по соединениям */}
                    <motion.circle 
                        cx="33" cy="25" r="3" fill="#6366f1"
                        animate={{ 
                            cx: [33, 67],
                            opacity: [0, 1, 0]
                        }}
                        transition={{ duration: 1.5, repeat: Infinity, delay: 0.5 }}
                    />
                    <motion.circle 
                        cx="25" cy="33" r="3" fill="#6366f1"
                        animate={{ 
                            cy: [33, 67],
                            opacity: [0, 1, 0]
                        }}
                        transition={{ duration: 1.5, repeat: Infinity, delay: 1 }}
                    />
                    <motion.circle 
                        cx="33" cy="33" r="3" fill="#b300ff"
                        animate={{ 
                            cx: [33, 47],
                            cy: [33, 47],
                            opacity: [0, 1, 0]
                        }}
                        transition={{ duration: 1, repeat: Infinity, delay: 1.5 }}
                    />
                    <motion.circle 
                        cx="67" cy="33" r="3" fill="#b300ff"
                        animate={{ 
                            cx: [67, 53],
                            cy: [33, 47], 
                            opacity: [0, 1, 0]
                        }}
                        transition={{ duration: 1, repeat: Infinity, delay: 2 }}
                    />
                </g>
            </svg>
        </motion.div>
    );
};

const ServiceIcons = {
    ConsultingIcon,
    ModelsIcon,
    IntegrationIcon
};

export default ServiceIcons; 