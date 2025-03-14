/**
 * Компоненты иконок для услуг
 */

// SVG компонент для иконки "Консультации и обучение"
export const BrainIcon = {
  name: 'BrainIcon',
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

// SVG компонент для иконки "Настройка языковых моделей"
export const CodeIcon = {
  name: 'CodeIcon',
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

// SVG компонент для иконки "Интеграция ИИ в бизнес"
export const NetworkIcon = {
  name: 'NetworkIcon',
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