<template>
  <div>
    <star-background />
    
    <div class="container py-5">
      <header class="services-header text-center mb-5">
        <h1 class="services-page-title display-4 mb-3" ref="pageTitle">Наши услуги</h1>
        <p class="services-page-subtitle lead mb-4" ref="pageSubtitle">Профессиональная настройка и интеграция нейросетевых решений для вашего бизнеса</p>
        <div class="header-separator mx-auto mb-4" ref="headerSeparator"></div>
        <div class="animated-line mt-4 mb-5"></div>
      </header>

      <section class="services-section">
        <div class="row g-4 justify-content-center">
          <!-- Карточки услуг -->
          <div class="col-md-4" v-for="(service, index) in services" :key="service.id">
            <service-card :link="service.link" :delay="index * 0.2">
              <template #icon>
                <component :is="service.icon" />
              </template>
              <template #title>{{ service.title }}</template>
              <template #text>{{ service.description }}</template>
              <template #link-text>Подробнее</template>
            </service-card>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { TextPlugin } from 'gsap/TextPlugin';
import StarBackground from './StarBackground.vue';
import ServiceCard from './ServiceCard.vue';
import { AILogoEffect } from '../three-effects';

// Регистрируем плагины GSAP
gsap.registerPlugin(ScrollTrigger, TextPlugin);

// SVG компоненты для иконок
const BrainIcon = {
  template: `
    <svg viewBox="0 0 100 100" width="100%" height="100%">
      <g fill="none" stroke="var(--neon-purple)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <!-- Контур мозга -->
        <path class="brain-outline" d="M30,25 Q40,15 50,25 Q60,15 70,25 Q80,35 70,50 Q80,65 70,75 Q60,85 50,75 Q40,85 30,75 Q20,65 30,50 Q20,35 30,25" />
        
        <!-- Нейронные соединения -->
        <path class="neural-path path-1" d="M40,30 Q50,20 60,30" />
        <path class="neural-path path-2" d="M35,40 Q50,30 65,40" />
        <path class="neural-path path-3" d="M30,50 Q50,45 70,50" />
        <path class="neural-path path-4" d="M35,60 Q50,70 65,60" />
        <path class="neural-path path-5" d="M40,70 Q50,80 60,70" />
        
        <!-- Нейроны (точки) -->
        <circle class="neuron neuron-1" cx="40" cy="30" r="3" fill="var(--neon-purple)" />
        <circle class="neuron neuron-2" cx="60" cy="30" r="3" fill="var(--neon-purple)" />
        <circle class="neuron neuron-3" cx="35" cy="40" r="3" fill="var(--neon-purple)" />
        <circle class="neuron neuron-4" cx="65" cy="40" r="3" fill="var(--neon-purple)" />
        <circle class="neuron neuron-5" cx="30" cy="50" r="3" fill="var(--neon-purple)" />
        <circle class="neuron neuron-6" cx="70" cy="50" r="3" fill="var(--neon-purple)" />
        <circle class="neuron neuron-7" cx="35" cy="60" r="3" fill="var(--neon-purple)" />
        <circle class="neuron neuron-8" cx="65" cy="60" r="3" fill="var(--neon-purple)" />
        <circle class="neuron neuron-9" cx="40" cy="70" r="3" fill="var(--neon-purple)" />
        <circle class="neuron neuron-10" cx="60" cy="70" r="3" fill="var(--neon-purple)" />
      </g>
    </svg>
  `
};

const CodeIcon = {
  template: `
    <svg viewBox="0 0 100 100" width="100%" height="100%">
      <g stroke="var(--neon-purple)" stroke-width="2" fill="none">
        <!-- Фон редактора кода -->
        <rect class="editor-bg" x="15" y="15" width="70" height="70" rx="4" ry="4" fill-opacity="0.1" fill="var(--neon-purple)" />
        
        <!-- Заголовок редактора -->
        <rect class="editor-header" x="15" y="15" width="70" height="10" rx="4" ry="4" fill-opacity="0.3" fill="var(--neon-purple)" />
        
        <!-- Точки меню в заголовке -->
        <circle class="menu-dot menu-dot-1" cx="22" cy="20" r="2" fill="var(--neon-purple)" />
        <circle class="menu-dot menu-dot-2" cx="30" cy="20" r="2" fill="var(--neon-purple)" />
        <circle class="menu-dot menu-dot-3" cx="38" cy="20" r="2" fill="var(--neon-purple)" />
        
        <!-- Линии кода -->
        <line class="code-line code-line-1" x1="25" y1="40" x2="75" y2="40" />
        <line class="code-line code-line-2" x1="25" y1="50" x2="65" y2="50" />
        <line class="code-line code-line-3" x1="25" y1="60" x2="55" y2="60" />
        
        <!-- Мигающий курсор -->
        <rect class="cursor" x="25" y="70" width="2" height="10" fill="var(--neon-purple)" />
      </g>
    </svg>
  `
};

const NetworkIcon = {
  template: `
    <svg viewBox="0 0 100 100" width="100%" height="100%">
      <defs>
        <linearGradient id="connector-gradient" x1="0%" y1="0%" x2="100%" y2="0%">
          <stop offset="0%" stop-color="var(--neon-purple)" stop-opacity="0.2" />
          <stop offset="50%" stop-color="var(--neon-purple)" stop-opacity="1" />
          <stop offset="100%" stop-color="var(--neon-purple)" stop-opacity="0.2" />
        </linearGradient>
      </defs>
      
      <g stroke="var(--neon-purple)" stroke-width="2" fill="none">
        <!-- Основные узлы -->
        <circle class="node node-1" cx="25" cy="25" r="8" fill="rgba(99, 102, 241, 0.2)" />
        <circle class="node node-2" cx="75" cy="25" r="8" fill="rgba(99, 102, 241, 0.2)" />
        <circle class="node node-center" cx="50" cy="50" r="10" fill="rgba(179, 0, 255, 0.2)" />
        <circle class="node node-3" cx="25" cy="75" r="8" fill="rgba(99, 102, 241, 0.2)" />
        <circle class="node node-4" cx="75" cy="75" r="8" fill="rgba(99, 102, 241, 0.2)" />
        
        <!-- Соединительные линии -->
        <line class="connection connection-1" x1="33" y1="25" x2="67" y2="25" stroke-dasharray="2 4" />
        <line class="connection connection-2" x1="25" y1="33" x2="25" y2="67" stroke-dasharray="2 4" />
        <line class="connection connection-3" x1="75" y1="33" x2="75" y2="67" stroke-dasharray="2 4" />
        <line class="connection connection-4" x1="33" y1="75" x2="67" y2="75" stroke-dasharray="2 4" />
        <line class="connection connection-5" x1="33" y1="33" x2="47" y2="47" stroke-dasharray="2 4" />
        <line class="connection connection-6" x1="67" y1="33" x2="53" y2="47" stroke-dasharray="2 4" />
        <line class="connection connection-7" x1="33" y1="67" x2="47" y2="53" stroke-dasharray="2 4" />
        <line class="connection connection-8" x1="67" y1="67" x2="53" y2="53" stroke-dasharray="2 4" />
        
        <!-- Пакеты данных -->
        <circle class="data-packet packet-1" cx="33" cy="25" r="3" fill="var(--neon-purple)" />
        <circle class="data-packet packet-2" cx="25" cy="33" r="3" fill="var(--neon-purple)" />
        <circle class="data-packet packet-3" cx="33" cy="33" r="3" fill="var(--neon-magenta)" />
        <circle class="data-packet packet-4" cx="67" cy="33" r="3" fill="var(--neon-magenta)" />
      </g>
    </svg>
  `
};

export default {
  name: 'ServicesPage',
  components: {
    StarBackground,
    ServiceCard,
    BrainIcon,
    CodeIcon,
    NetworkIcon
  },
  setup() {
    const pageTitle = ref(null);
    const pageSubtitle = ref(null);
    const headerSeparator = ref(null);
    
    // Данные для карточек услуг
    const services = ref([
      {
        id: 1,
        title: 'Консультации и обучение',
        description: 'Экспертная помощь в выборе оптимальных нейросетевых решений и обучение вашей команды работе с ИИ-инструментами',
        link: '/services/consulting-and-training',
        icon: BrainIcon
      },
      {
        id: 2,
        title: 'Настройка языковых моделей',
        description: 'Профессиональная настройка и fine-tuning нейросетевых моделей под специфику вашей отрасли и задачи',
        link: '/services/language-models-setup',
        icon: CodeIcon
      },
      {
        id: 3,
        title: 'Интеграция ИИ в бизнес',
        description: 'Комплексное внедрение искусственного интеллекта в рабочие процессы компании с измеримыми результатами',
        link: '/services/ai-business-integration',
        icon: NetworkIcon
      }
    ]);
    
    onMounted(() => {
      // Анимация заголовка страницы
      if (pageTitle.value) {
        const originalText = pageTitle.value.textContent;
        pageTitle.value.textContent = '';
        
        gsap.to(pageTitle.value, {
          text: {
            value: originalText,
            delimiter: ''
          },
          duration: 1.5,
          ease: 'power2.inOut',
          onComplete: () => {
            gsap.to(pageTitle.value, {
              textShadow: '0 0 10px rgba(185, 53, 255, 0.7), 0 0 20px rgba(185, 53, 255, 0.5)',
              duration: 0.5
            });
          }
        });
      }
      
      // Анимация подзаголовка
      if (pageSubtitle.value) {
        gsap.fromTo(pageSubtitle.value, 
          { opacity: 0, y: 20 }, 
          { opacity: 1, y: 0, duration: 1, delay: 1, ease: 'power2.out' }
        );
      }
      
      // Анимация разделителя
      if (headerSeparator.value) {
        gsap.fromTo(headerSeparator.value,
          { width: 0, opacity: 0 },
          { width: '80px', opacity: 1, duration: 1, delay: 0.5, ease: 'power2.inOut' }
        );
      }
    });
    
    return {
      services,
      pageTitle,
      pageSubtitle,
      headerSeparator
    };
  }
};
</script>

<style scoped>
.services-page-title {
  font-size: 2.5rem;
  margin-bottom: 1rem;
  background: linear-gradient(90deg, var(--neon-purple, #a78bfa), var(--neon-blue, #60a5fa));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  text-fill-color: transparent;
}

.header-separator {
  width: 0;
  height: 3px;
  background: linear-gradient(90deg, var(--neon-purple, #a78bfa), var(--neon-blue, #60a5fa));
  border-radius: 3px;
}

.text-gradient {
  background: linear-gradient(90deg, var(--neon-purple, #a78bfa), var(--neon-blue, #60a5fa));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  text-fill-color: transparent;
}

@media (max-width: 768px) {
  .services-page-title {
    font-size: 2rem;
  }
}
</style> 