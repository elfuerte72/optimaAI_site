/**
 * Stars Initialization - OptimAI 2030 Edition
 * Скрипт для инициализации звездного фона
 */

// Проверяем, загружен ли основной скрипт stars-animation.js
document.addEventListener('DOMContentLoaded', function() {
  console.log('Stars initialization script loaded');
  
  // Проверяем, определена ли функция initStars
  if (typeof window.initStars === 'function') {
    console.log('initStars function is available, initializing stars...');
    window.initStars();
  } else {
    console.error('Error: initStars function is not available yet');
    
    // Пытаемся загрузить скрипт динамически, если он не был загружен
    const script = document.createElement('script');
    script.src = '/js/stars-animation.js';
    script.onload = function() {
      console.log('stars-animation.js loaded dynamically');
      if (typeof window.initStars === 'function') {
        console.log('initStars function is now available, initializing stars...');
        window.initStars();
      } else {
        console.error('Error: initStars function is still not available after loading the script');
      }
    };
    document.head.appendChild(script);
  }
  
  // Добавляем обработчик для повторной инициализации звезд при изменении размера окна
  window.addEventListener('resize', function() {
    clearTimeout(window.starsResizeTimer);
    window.starsResizeTimer = setTimeout(function() {
      if (typeof window.initStars === 'function') {
        console.log('Reinitializing stars after resize...');
        window.initStars();
      }
    }, 250);
  });
}); 