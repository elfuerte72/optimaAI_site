<template>
  <div class="service-detail">
    <div class="service-icon-wrapper mb-4" ref="iconWrapper">
      <component :is="serviceIcon" />
    </div>
    
    <div class="service-description mb-4" ref="description">
      <p>{{ service.description }}</p>
    </div>
    
    <div v-if="service.program" class="service-section mb-4" ref="programSection">
      <h4 class="section-title">Программа:</h4>
      <ul class="service-list">
        <li v-for="(item, index) in service.program" :key="index" :ref="el => { if(el) programItems[index] = el }">
          {{ item }}
        </li>
      </ul>
    </div>
    
    <div v-if="service.possibilities" class="service-section mb-4" ref="possibilitiesSection">
      <h4 class="section-title">Возможности:</h4>
      <p>{{ service.possibilities }}</p>
    </div>
    
    <div v-if="service.support" class="service-section mb-4" ref="supportSection">
      <h4 class="section-title">Сопровождение:</h4>
      <p>{{ service.support }}</p>
    </div>
    
    <div class="service-section mb-4" ref="resultSection">
      <h4 class="section-title">Результат:</h4>
      <p>{{ service.result }}</p>
    </div>
    
    <div class="service-section" ref="priceSection">
      <h4 class="section-title">Стоимость:</h4>
      <p>{{ service.price }}</p>
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
    const programSection = ref(null);
    const possibilitiesSection = ref(null);
    const supportSection = ref(null);
    const resultSection = ref(null);
    const priceSection = ref(null);
    const programItems = reactive([]);
    
    onMounted(() => {
      // Анимация иконки
      if (iconWrapper.value) {
        gsap.fromTo(iconWrapper.value, 
          { scale: 0.5, opacity: 0 },
          { scale: 1, opacity: 1, duration: 0.6, ease: 'back.out(1.7)' }
        );
      }
      
      // Анимация описания
      if (description.value) {
        gsap.fromTo(description.value,
          { y: 20, opacity: 0 },
          { y: 0, opacity: 1, duration: 0.5, delay: 0.2 }
        );
      }
      
      // Анимация секций
      const sections = [
        programSection.value, 
        possibilitiesSection.value, 
        supportSection.value, 
        resultSection.value, 
        priceSection.value
      ].filter(Boolean);
      
      gsap.fromTo(sections,
        { y: 30, opacity: 0 },
        { 
          y: 0, 
          opacity: 1, 
          duration: 0.5, 
          stagger: 0.1,
          delay: 0.3,
          ease: 'power2.out'
        }
      );
      
      // Анимация элементов программы
      if (programItems.length > 0) {
        gsap.fromTo(programItems,
          { x: -20, opacity: 0 },
          { 
            x: 0, 
            opacity: 1, 
            duration: 0.3, 
            stagger: 0.05,
            delay: 0.5,
            ease: 'power1.out'
          }
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
      programItems
    };
  }
};
</script>

<style scoped>
.service-detail {
  color: rgba(255, 255, 255, 0.9);
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
  font-size: 1.1rem;
  margin-bottom: 0.5rem;
  color: var(--neon-purple, #a78bfa);
  font-weight: 600;
}

.service-list {
  list-style-type: none;
  padding-left: 0;
}

.service-list li {
  position: relative;
  padding-left: 1.5rem;
  margin-bottom: 0.5rem;
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
}

.service-section {
  padding: 1rem;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 0.5rem;
  margin-bottom: 1rem;
  transition: all 0.3s ease;
  border: 1px solid transparent;
}

.service-section:hover {
  background: rgba(255, 255, 255, 0.08);
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  border-color: rgba(185, 53, 255, 0.3);
}
</style> 