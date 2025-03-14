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
            <service-card 
              :delay="index * 0.2"
              @click-details="openServiceModal(service)"
            >
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
    
    <!-- Модальное окно с подробной информацией об услуге -->
    <modal 
      :show="showModal" 
      :title="selectedService ? selectedService.title : ''" 
      @close="closeModal"
    >
      <service-detail v-if="selectedService" :service="selectedService" />
    </modal>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { TextPlugin } from 'gsap/TextPlugin';
import StarBackground from './StarBackground.vue';
import ServiceCard from './ServiceCard.vue';
import Modal from './Modal.vue';
import ServiceDetail from './ServiceDetail.vue';
import { BrainIcon, CodeIcon, NetworkIcon } from './ServiceIcons';

// Регистрируем плагины GSAP
gsap.registerPlugin(ScrollTrigger, TextPlugin);

export default {
  name: 'ServicesPage',
  components: {
    StarBackground,
    ServiceCard,
    Modal,
    ServiceDetail,
    BrainIcon,
    CodeIcon,
    NetworkIcon
  },
  setup() {
    const pageTitle = ref(null);
    const pageSubtitle = ref(null);
    const headerSeparator = ref(null);
    const showModal = ref(false);
    const selectedService = ref(null);
    
    // Данные для карточек услуг с подробной информацией
    const services = ref([
      {
        id: 1,
        title: 'Консультации и обучение',
        description: 'Экспертная помощь в выборе оптимальных нейросетевых решений и обучение вашей команды работе с ИИ-инструментами',
        icon: BrainIcon,
        fullDescription: 'Индивидуальные консультации и семинары для начинающих.',
        program: [
          'Основы нейросетей',
          'Применение в бизнесе',
          'Практика с ChatGPT',
          'Правильные промты',
          'Автоматизация задач'
        ],
        result: 'Клиент получает навыки самостоятельного использования ИИ.',
        price: 'Фиксированная цена за консультацию/семинар, пакетные предложения.'
      },
      {
        id: 2,
        title: 'Настройка языковых моделей',
        description: 'Профессиональная настройка и fine-tuning нейросетевых моделей под специфику вашей отрасли и задачи',
        icon: CodeIcon,
        fullDescription: 'Индивидуальная настройка AI-решений для анализа данных, автоматизации ответов, генерации контента.',
        possibilities: 'Интеграция с CRM, Notion, Telegram и другими сервисами.',
        result: 'Готовая модель, снижение нагрузки на сотрудников.',
        price: 'Фиксированная цена за настройку + пакеты с обучением.'
      },
      {
        id: 3,
        title: 'Интеграция ИИ в бизнес',
        description: 'Комплексное внедрение искусственного интеллекта в рабочие процессы компании с измеримыми результатами',
        icon: NetworkIcon,
        fullDescription: 'Полная интеграция AI в бизнес-процессы (CRM, финансы, поддержка клиентов).',
        support: 'Обучение сотрудников, техническая поддержка, доработка решений.',
        result: 'Автоматизация процессов и самостоятельное управление ИИ.',
        price: 'Фиксированная цена за интеграцию + абонентское обслуживание.'
      }
    ]);
    
    // Открытие модального окна с информацией об услуге
    const openServiceModal = (service) => {
      selectedService.value = service;
      showModal.value = true;
    };
    
    // Закрытие модального окна
    const closeModal = () => {
      showModal.value = false;
    };
    
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
      headerSeparator,
      showModal,
      selectedService,
      openServiceModal,
      closeModal
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
}

.animated-line {
  height: 2px;
  width: 100%;
  background: linear-gradient(90deg, 
    rgba(99, 102, 241, 0), 
    rgba(99, 102, 241, 0.5), 
    rgba(185, 53, 255, 0.8), 
    rgba(99, 102, 241, 0.5), 
    rgba(99, 102, 241, 0)
  );
  position: relative;
  overflow: hidden;
}

.animated-line::after {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, 
    rgba(99, 102, 241, 0), 
    rgba(255, 255, 255, 0.8), 
    rgba(99, 102, 241, 0)
  );
  animation: shimmer 3s infinite;
}

@keyframes shimmer {
  0% {
    left: -100%;
  }
  100% {
    left: 100%;
  }
}
</style> 