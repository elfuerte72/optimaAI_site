/**
 * Инициализация звезд - OptimAI 2030 Edition
 * Этот файл должен загружаться перед stars-animation.js
 */

// Определяем функцию initStars глобально
window.initStars = function() {
  console.log('Инициализация звезд запущена');
  
  // Находим контейнер для звезд
  const starsContainer = document.querySelector('.stars-container');
  
  if (!starsContainer) {
    console.warn('Контейнер для звезд не найден');
    return;
  }
  
  // Очищаем контейнер перед созданием новых звезд
  starsContainer.innerHTML = '';
  
  // Параметры для звезд
  const starCount = 200;
  const shootingStarCount = 5;
  const nebulaCount = 3;
  
  // Создаем звезды
  for (let i = 0; i < starCount; i++) {
    createStar(starsContainer);
  }
  
  // Создаем падающие звезды
  for (let i = 0; i < shootingStarCount; i++) {
    createShootingStar(starsContainer);
  }
  
  // Создаем туманности
  for (let i = 0; i < nebulaCount; i++) {
    createNebula(starsContainer);
  }
  
  console.log('Звезды успешно инициализированы');
};

/**
 * Создает звезду с случайными параметрами
 */
function createStar(container) {
  const star = document.createElement('div');
  star.classList.add('star');
  
  // Случайные параметры
  const size = Math.random();
  const x = Math.random() * 100;
  const y = Math.random() * 100;
  const depth = Math.random() * 3 + 1;
  const delay = Math.random() * 5;
  const duration = Math.random() * 3 + 2;
  
  // Определяем размер звезды
  if (size < 0.6) {
    star.classList.add('small');
  } else if (size < 0.9) {
    star.classList.add('medium');
  } else {
    star.classList.add('large');
  }
  
  // Устанавливаем позицию
  star.style.left = `${x}%`;
  star.style.top = `${y}%`;
  star.setAttribute('data-depth', depth.toFixed(2));
  
  // Добавляем анимацию мерцания
  star.classList.add('star-twinkle');
  star.style.animationDelay = `${delay}s`;
  star.style.animationDuration = `${duration}s`;
  
  // Добавляем звезду в контейнер
  container.appendChild(star);
}

/**
 * Создает падающую звезду
 */
function createShootingStar(container) {
  const shootingStar = document.createElement('div');
  shootingStar.classList.add('shooting-star');
  
  // Случайные параметры
  const x = Math.random() * 100;
  const y = Math.random() * 50;
  const delay = Math.random() * 15;
  
  // Устанавливаем позицию
  shootingStar.style.left = `${x}%`;
  shootingStar.style.top = `${y}%`;
  
  // Устанавливаем задержку анимации
  shootingStar.style.animationDelay = `${delay}s`;
  
  // Добавляем в контейнер
  container.appendChild(shootingStar);
}

/**
 * Создает туманность
 */
function createNebula(container) {
  const nebula = document.createElement('div');
  nebula.classList.add('nebula');
  
  // Случайные параметры
  const x = Math.random() * 100;
  const y = Math.random() * 100;
  const size = Math.random() * 200 + 100;
  const delay = Math.random() * 5;
  
  // Устанавливаем позицию и размер
  nebula.style.left = `${x}%`;
  nebula.style.top = `${y}%`;
  nebula.style.width = `${size}px`;
  nebula.style.height = `${size}px`;
  
  // Устанавливаем задержку анимации
  nebula.style.animationDelay = `${delay}s`;
  
  // Добавляем в контейнер
  container.appendChild(nebula);
}

// Инициализируем звезды при загрузке страницы
document.addEventListener('DOMContentLoaded', function() {
  window.initStars();
  
  // Пересоздание звезд при изменении размера окна
  window.addEventListener('resize', function() {
    // Используем debounce для оптимизации
    clearTimeout(window.resizeTimer);
    window.resizeTimer = setTimeout(function() {
      window.initStars();
    }, 250);
  });
}); 