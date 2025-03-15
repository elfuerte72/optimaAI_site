<template>
  <div class="service-detail">
    <div class="service-icon-wrapper mb-4" ref="iconWrapper">
      <component :is="serviceIcon" />
    </div>
    
    <div class="service-description mb-4" ref="description">
      <p>{{ service.fullDescription || service.description }}</p>
    </div>
    
    <div v-if="service.program" class="service-section mb-4" ref="programSection">
      <h3 class="section-title" ref="programTitle">Программа:</h3>
      <ul class="service-list">
        <li v-for="(item, index) in service.program" :key="index" :ref="el => { if(el) programItems[index] = el }">
          <span v-if="item.includes('ChatGPT')" class="highlight">{{ item }}</span>
          <span v-else>{{ item }}</span>
        </li>
      </ul>
    </div>
    
    <div v-if="service.possibilities" class="service-section mb-4" ref="possibilitiesSection">
      <h3 class="section-title" ref="possibilitiesTitle">Возможности:</h3>
      <p ref="possibilitiesText">{{ service.possibilities }}</p>
    </div>
    
    <div v-if="service.support" class="service-section mb-4" ref="supportSection">
      <h3 class="section-title" ref="supportTitle">Сопровождение:</h3>
      <p ref="supportText">{{ service.support }}</p>
    </div>
    
    <div class="service-section mb-4" ref="resultSection">
      <h3 class="section-title" ref="resultTitle">Результат:</h3>
      <p ref="resultText">{{ service.result }}</p>
    </div>
    
    <div class="service-section" ref="priceSection">
      <h3 class="section-title" ref="priceTitle">Стоимость:</h3>
      <p ref="priceText">{{ service.price }}</p>
    </div>
  </div>
</template>

<script>
import { computed, ref, onMounted, reactive } from 'vue';
import { gsap } from 'gsap';
import { BrainIcon, CodeIcon, NetworkIcon } from './ServiceIcons';

export default {
  name: 'ServiceDetail',
  components: {
    BrainIcon,
    CodeIcon,
    NetworkIcon
  },
  props: {
    service: {
      type: Object,
      required: true
    }
  },
  setup(props) {
    // Определяем иконку в зависимости от ID услуги
    const serviceIcon = computed(() => {
      switch(props.service.id) {
        case 1: return 'BrainIcon';
        case 2: return 'CodeIcon';
        case 3: return 'NetworkIcon';
        default: return 'BrainIcon';
      }
    });
    
    // Рефы для анимации
    const iconWrapper = ref(null);
    const description = ref(null);
    
    // Рефы для секций
    const programSection = ref(null);
    const possibilitiesSection = ref(null);
    const supportSection = ref(null);
    const resultSection = ref(null);
    const priceSection = ref(null);
    
    // Рефы для заголовков и текста внутри секций
    const programTitle = ref(null);
    const possibilitiesTitle = ref(null);
    const possibilitiesText = ref(null);
    const supportTitle = ref(null);
    const supportText = ref(null);
    const resultTitle = ref(null);
    const resultText = ref(null);
    const priceTitle = ref(null);
    const priceText = ref(null);
    
    const programItems = reactive([]);
    
    onMounted(() => {
      // Создаем временную шкалу для последовательной анимации
      const tl = gsap.timeline({ defaults: { ease: 'power2.out' } });
      
      // Анимация иконки
      if (iconWrapper.value) {
        tl.fromTo(iconWrapper.value, 
          { scale: 0.5, opacity: 0 },
          { scale: 1, opacity: 1, duration: 0.6, ease: 'back.out(1.7)' }
        );
      }
      
      // Анимация описания с задержкой
      if (description.value) {
        tl.fromTo(description.value,
          { y: 20, opacity: 0 },
          { y: 0, opacity: 1, duration: 0.5 },
          '-=0.3' // Начинаем немного раньше, чем закончится предыдущая анимация
        );
      }
      
      // Собираем все секции в массив
      const sections = [
        programSection.value, 
        possibilitiesSection.value, 
        supportSection.value, 
        resultSection.value, 
        priceSection.value
      ].filter(Boolean);
      
      // Анимируем каждую секцию последовательно
      if (sections.length > 0) {
        tl.fromTo(sections,
          { y: 30, opacity: 0 },
          { 
            y: 0, 
            opacity: 1, 
            duration: 0.5, 
            stagger: 0.15, // Увеличиваем задержку между элементами
            ease: 'power2.out'
          },
          '-=0.2'
        );
      }
      
      // Анимация заголовков внутри секций
      const titles = [
        programTitle.value,
        possibilitiesTitle.value,
        supportTitle.value,
        resultTitle.value,
        priceTitle.value
      ].filter(Boolean);
      
      if (titles.length > 0) {
        tl.fromTo(titles,
          { x: -15, opacity: 0 },
          { 
            x: 0, 
            opacity: 1, 
            duration: 0.4, 
            stagger: 0.1,
            ease: 'power1.out'
          },
          '-=0.3'
        );
      }
      
      // Анимация текста внутри секций
      const texts = [
        possibilitiesText.value,
        supportText.value,
        resultText.value,
        priceText.value
      ].filter(Boolean);
      
      if (texts.length > 0) {
        tl.fromTo(texts,
          { y: 10, opacity: 0 },
          { 
            y: 0, 
            opacity: 1, 
            duration: 0.4, 
            stagger: 0.1,
            ease: 'power1.out'
          },
          '-=0.2'
        );
      }
      
      // Анимация элементов программы с большей задержкой
      if (programItems.length > 0) {
        tl.fromTo(programItems,
          { x: -20, opacity: 0 },
          { 
            x: 0, 
            opacity: 1, 
            duration: 0.3, 
            stagger: 0.08, // Увеличиваем задержку между элементами списка
            ease: 'power1.out'
          },
          '-=0.1'
        );
      }
    });
    
    return {
      serviceIcon,
      iconWrapper,
      description,
      programSection,
      possibilitiesSection,
      supportSection,
      resultSection,
      priceSection,
      programTitle,
      possibilitiesTitle,
      possibilitiesText,
      supportTitle,
      supportText,
      resultTitle,
      resultText,
      priceTitle,
      priceText,
      programItems
    };
  }
};
</script>

<style scoped>
.service-detail {
  color: rgba(255, 255, 255, 0.9);
  font-family: var(--font-secondary, 'Roboto', sans-serif);
  line-height: 1.6;
}

.service-icon-wrapper {
  width: 80px;
  height: 80px;
  margin: 0 auto;
  animation: pulse 3s infinite ease-in-out;
}

@keyframes pulse {
  0% {
    filter: drop-shadow(0 0 5px rgba(185, 53, 255, 0.3));
  }
  50% {
    filter: drop-shadow(0 0 15px rgba(185, 53, 255, 0.7));
  }
  100% {
    filter: drop-shadow(0 0 5px rgba(185, 53, 255, 0.3));
  }
}

.section-title {
  font-size: 1.2rem;
  margin-bottom: 0.75rem;
  color: var(--neon-purple, #a78bfa);
  font-weight: 600;
  letter-spacing: 0.5px;
}

.service-description p {
  font-size: 1.05rem;
  margin-bottom: 1rem;
}

.service-list {
  list-style-type: none;
  padding-left: 0;
  margin-bottom: 0;
}

.service-list li {
  position: relative;
  padding-left: 1.5rem;
  margin-bottom: 0.75rem;
  font-size: 1rem;
}

.service-list li::before {
  content: '';
  position: absolute;
  left: 0;
  top: 0.5rem;
  width: 0.5rem;
  height: 0.5rem;
  background: var(--neon-purple, #a78bfa);
  border-radius: 50%;
  box-shadow: 0 0 5px rgba(185, 53, 255, 0.5);
}

.highlight {
  color: var(--success-color, #42b983);
  font-weight: 600;
}

.service-section {
  padding: 1.25rem;
  background: rgba(255, 255, 255, 0.05);
  border-radius: var(--border-radius-md, 0.5rem);
  margin-bottom: 1.25rem;
  transition: all var(--transition-normal, 0.3s) ease;
  border: 1px solid transparent;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.service-section:hover {
  background: rgba(255, 255, 255, 0.08);
  transform: translateY(-2px);
  box-shadow: var(--card-shadow, 0 5px 15px rgba(0, 0, 0, 0.15));
  border-color: var(--modal-border-color, rgba(185, 53, 255, 0.3));
}

.service-section p {
  margin-bottom: 0;
}

/* Адаптивность для мобильных устройств */
@media (max-width: 600px) {
  .service-section {
    padding: 1rem;
  }
  
  .section-title {
    font-size: 1.1rem;
  }
  
  .service-description p {
    font-size: 1rem;
  }
}
</style> 