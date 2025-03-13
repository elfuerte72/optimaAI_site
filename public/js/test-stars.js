/**
 * Тестовый скрипт для проверки наличия функции window.initStars
 */
document.addEventListener('DOMContentLoaded', function() {
  console.log('Тестовый скрипт загружен');
  
  // Проверяем, определена ли функция window.initStars
  if (typeof window.initStars === 'function') {
    console.log('Функция window.initStars определена и доступна');
  } else {
    console.error('Ошибка: функция window.initStars не определена');
  }
  
  // Проверяем, есть ли контейнер для звезд
  const starsContainer = document.querySelector('.stars-container');
  if (starsContainer) {
    console.log('Контейнер для звезд найден');
  } else {
    console.warn('Контейнер для звезд не найден на странице');
  }
}); 