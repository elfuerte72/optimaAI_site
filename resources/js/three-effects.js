/**
 * Three.js Effects - OptimAI 2030 Edition
 * Футуристические 3D-эффекты с использованием Three.js
 * Оптимизированная версия с адаптацией качества для разных устройств
 */

import * as THREE from 'three';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';
import { EffectComposer } from 'three/examples/jsm/postprocessing/EffectComposer.js';
import { RenderPass } from 'three/examples/jsm/postprocessing/RenderPass.js';
import { UnrealBloomPass } from 'three/examples/jsm/postprocessing/UnrealBloomPass.js';
import { ShaderPass } from 'three/examples/jsm/postprocessing/ShaderPass.js';
import { gsap } from 'gsap';

/**
 * Определение возможностей устройства 
 * для адаптации качества визуальных эффектов
 */
const DeviceCapabilities = {
  // Определяем силу устройства, учитывая различные факторы
  getDeviceTier: function() {
    // Низкопроизводительное устройство: 0, среднее: 1, высокопроизводительное: 2
    let tier = 1; // По умолчанию среднее
    
    // Проверяем, мобильное ли устройство
    const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    if (isMobile) {
      tier = 0; // Мобильные устройства начинают с низкого качества
    }
    
    // Проверяем количество логических процессоров
    if (navigator.hardwareConcurrency) {
      if (navigator.hardwareConcurrency >= 8) {
        tier += 1;
      } else if (navigator.hardwareConcurrency <= 2) {
        tier -= 1;
      }
    }
    
    // Проверяем, поддерживает ли устройство WebGL2
    const canvas = document.createElement('canvas');
    const gl = canvas.getContext('webgl2');
    if (!gl) {
      tier -= 1;
    }
    
    // Ограничиваем диапазон от 0 до 2
    return Math.max(0, Math.min(2, tier));
  },
  
  // Получаем настройки качества на основе уровня устройства
  getQualitySettings: function() {
    const tier = this.getDeviceTier();
    
    // Базовые настройки для разных уровней производительности
    const settings = {
      pixelRatio: Math.min(window.devicePixelRatio, 1),
      particleCount: 500,
      bloomStrength: 0.5,
      bloomRadius: 0.5,
      shadowMapEnabled: false,
      antialias: false,
      maxLights: 2,
      postprocessing: false
    };
    
    if (tier === 1) {
      // Средний уровень
      settings.pixelRatio = Math.min(window.devicePixelRatio, 1.5);
      settings.particleCount = 1000;
      settings.bloomStrength = 1;
      settings.bloomRadius = 0.75;
      settings.shadowMapEnabled = true;
      settings.antialias = true;
      settings.maxLights = 3;
      settings.postprocessing = true;
    } else if (tier === 2) {
      // Высокий уровень
      settings.pixelRatio = Math.min(window.devicePixelRatio, 2);
      settings.particleCount = 2000;
      settings.bloomStrength = 1.5;
      settings.bloomRadius = 1;
      settings.shadowMapEnabled = true;
      settings.antialias = true;
      settings.maxLights = 4;
      settings.postprocessing = true;
    }
    
    return settings;
  }
};

// Получаем настройки качества для текущего устройства
const qualitySettings = DeviceCapabilities.getQualitySettings();
console.log('Настройки качества Three.js:', qualitySettings);

/**
 * Класс для создания 3D-логотипа с эффектами
 */
class AILogoEffect {
  constructor(options = {}) {
    this.options = {
      container: '#logo-container',
      modelPath: '/models/ai-crystal.glb',
      backgroundColor: 0x050510,
      ambientLightColor: 0x404080,
      pointLightColor: 0xb935ff,
      secondPointLightColor: 0x3a8eff,
      ...options
    };
    
    this.container = document.querySelector(this.options.container);
    
    if (!this.container) {
      console.warn('AILogoEffect: Container not found');
      return;
    }
    
    this.width = this.container.offsetWidth;
    this.height = this.container.offsetHeight;
    this.mouseX = 0;
    this.mouseY = 0;
    
    // Применяем настройки качества
    this.qualitySettings = qualitySettings;
    
    this.init();
  }
  
  init() {
    // Создаем сцену
    this.scene = new THREE.Scene();
    this.scene.background = new THREE.Color(this.options.backgroundColor);
    
    // Создаем камеру
    this.camera = new THREE.PerspectiveCamera(75, this.width / this.height, 0.1, 1000);
    this.camera.position.z = 5;
    
    // Создаем рендерер с учетом возможностей устройства
    this.renderer = new THREE.WebGLRenderer({ 
      antialias: this.qualitySettings.antialias, 
      alpha: true,
      powerPreference: 'high-performance' // Подсказка для выбора GPU на устройствах с несколькими GPU
    });
    this.renderer.setSize(this.width, this.height);
    this.renderer.setPixelRatio(this.qualitySettings.pixelRatio);
    this.renderer.outputEncoding = THREE.sRGBEncoding;
    
    // Настраиваем тонмаппинг в зависимости от производительности
    if (this.qualitySettings.postprocessing) {
      this.renderer.toneMapping = THREE.ACESFilmicToneMapping;
      this.renderer.toneMappingExposure = 1.5;
    } else {
      this.renderer.toneMapping = THREE.ReinhardToneMapping; // Более легкий тонмаппинг
      this.renderer.toneMappingExposure = 1.2;
    }
    
    // Настраиваем тени, если устройство позволяет
    if (this.qualitySettings.shadowMapEnabled) {
      this.renderer.shadowMap.enabled = true;
      this.renderer.shadowMap.type = THREE.PCFSoftShadowMap;
    }
    
    this.container.appendChild(this.renderer.domElement);
    
    // Добавляем освещение
    this.setupLights();
    
    // Загружаем модель
    this.loadModel();
    
    // Настраиваем постобработку только если устройство позволяет
    if (this.qualitySettings.postprocessing) {
      this.setupPostprocessing();
    }
    
    // Добавляем управление с адаптированными параметрами для производительности
    this.controls = new OrbitControls(this.camera, this.renderer.domElement);
    this.controls.enableDamping = true;
    this.controls.dampingFactor = 0.05;
    this.controls.enableZoom = false;
    
    // Ограничиваем частоту обработки событий на мобильных устройствах
    const isLowPerfDevice = this.qualitySettings.particleCount <= 500;
    const resizeThrottle = isLowPerfDevice ? 200 : 100;
    const mouseMoveThrottle = isLowPerfDevice ? 50 : 16;
    
    // Добавляем обработчики событий с throttle
    window.addEventListener('resize', this.throttle(this.handleResize.bind(this), resizeThrottle));
    
    // На мобильных устройствах лучше слушать orientationchange для рендеринга
    if (/Mobi|Android/i.test(navigator.userAgent)) {
      window.addEventListener('orientationchange', this.handleResize.bind(this));
    }
    
    window.addEventListener('mousemove', this.throttle(this.handleMouseMove.bind(this), mouseMoveThrottle));
    
    // Запускаем анимацию с адаптивной частотой кадров
    this.lastTime = 0;
    this.frameLimit = isLowPerfDevice ? 30 : 60; // Ограничиваем FPS на слабых устройствах
    this.frameInterval = 1000 / this.frameLimit;
    
    this.animate();
  }
  
  // Функция для ограничения частоты вызовов (throttle)
  throttle(callback, limit) {
    let waiting = false;
    return function() {
      if (!waiting) {
        callback.apply(this, arguments);
        waiting = true;
        setTimeout(() => {
          waiting = false;
        }, limit);
      }
    };
  }
  
  setupLights() {
    // Адаптируем количество источников света в зависимости от производительности
    const maxLights = this.qualitySettings.maxLights;
    
    // Добавляем окружающий свет
    this.ambientLight = new THREE.AmbientLight(this.options.ambientLightColor, 0.5);
    this.scene.add(this.ambientLight);
    
    // Добавляем точечный свет
    this.pointLight = new THREE.PointLight(this.options.pointLightColor, 1, 100);
    this.pointLight.position.set(5, 5, 5);
    
    // Настройка теней для основного света
    if (this.qualitySettings.shadowMapEnabled) {
      this.pointLight.castShadow = true;
      this.pointLight.shadow.mapSize.width = 512; // Для слабых устройств используем меньшее разрешение теней
      this.pointLight.shadow.mapSize.height = 512;
      this.pointLight.shadow.camera.near = 0.5;
      this.pointLight.shadow.camera.far = 50;
    }
    
    this.scene.add(this.pointLight);
    
    // Добавляем второй точечный свет, только если устройство позволяет
    if (maxLights >= 2) {
      this.secondPointLight = new THREE.PointLight(this.options.secondPointLightColor, 1, 100);
      this.secondPointLight.position.set(-5, -5, 5);
      this.scene.add(this.secondPointLight);
    }
    
    // Добавляем дополнительные источники света только для мощных устройств
    if (maxLights >= 3) {
      this.thirdPointLight = new THREE.PointLight(0x00ffff, 0.5, 50);
      this.thirdPointLight.position.set(0, 5, -5);
      this.scene.add(this.thirdPointLight);
    }
    
    if (maxLights >= 4) {
      this.fourthPointLight = new THREE.PointLight(0xff00ff, 0.3, 30);
      this.fourthPointLight.position.set(5, -5, -5);
      this.scene.add(this.fourthPointLight);
    }
  }
  
  loadModel() {
    // Загружаем модель
    const loader = new GLTFLoader();
    
    loader.load(
      this.options.modelPath,
      (gltf) => {
        this.model = gltf.scene;
        this.model.scale.set(1.5, 1.5, 1.5);
        
        // Применяем материалы с эффектом свечения
        this.model.traverse((child) => {
          if (child.isMesh) {
            child.material = new THREE.MeshPhysicalMaterial({
              color: 0xffffff,
              metalness: 0.9,
              roughness: 0.1,
              clearcoat: 1.0,
              clearcoatRoughness: 0.1,
              transmission: 0.5,
              ior: 1.5,
              reflectivity: 1.0,
              thickness: 0.5,
              envMapIntensity: 1.0,
              transparent: true,
              opacity: 0.8
            });
          }
        });
        
        this.scene.add(this.model);
        
        // Анимируем появление модели
        gsap.fromTo(this.model.scale, 
          { x: 0, y: 0, z: 0 }, 
          { x: 1.5, y: 1.5, z: 1.5, duration: 1.5, ease: 'elastic.out(1, 0.5)' }
        );
        
        // Добавляем постоянную анимацию вращения
        gsap.to(this.model.rotation, {
          y: Math.PI * 2,
          duration: 20,
          repeat: -1,
          ease: 'none'
        });
      },
      (xhr) => {
        console.log((xhr.loaded / xhr.total * 100) + '% loaded');
      },
      (error) => {
        console.error('Error loading model:', error);
      }
    );
  }
  
  setupPostprocessing() {
    // Настраиваем постобработку
    this.composer = new EffectComposer(this.renderer);
    
    const renderPass = new RenderPass(this.scene, this.camera);
    this.composer.addPass(renderPass);
    
    // Добавляем эффект свечения
    const bloomPass = new UnrealBloomPass(
      new THREE.Vector2(this.width, this.height),
      1.5,  // сила
      0.4,  // радиус
      0.85  // порог
    );
    this.composer.addPass(bloomPass);
    
    // Добавляем кастомный шейдер для хроматической аберрации
    const chromaticAberrationShader = {
      uniforms: {
        tDiffuse: { value: null },
        resolution: { value: new THREE.Vector2(this.width, this.height) },
        power: { value: 0.02 }
      },
      vertexShader: `
        varying vec2 vUv;
        void main() {
          vUv = uv;
          gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);
        }
      `,
      fragmentShader: `
        uniform sampler2D tDiffuse;
        uniform vec2 resolution;
        uniform float power;
        varying vec2 vUv;
        
        void main() {
          vec2 uv = vUv;
          vec2 direction = normalize(uv - 0.5);
          vec2 aberration = direction * power;
          
          vec4 color = vec4(0.0);
          color.r = texture2D(tDiffuse, uv - aberration).r;
          color.g = texture2D(tDiffuse, uv).g;
          color.b = texture2D(tDiffuse, uv + aberration).b;
          color.a = 1.0;
          
          gl_FragColor = color;
        }
      `
    };
    
    const chromaticAberrationPass = new ShaderPass(chromaticAberrationShader);
    this.composer.addPass(chromaticAberrationPass);
  }
  
  animate() {
    requestAnimationFrame(this.animate.bind(this));
    
    // Обновляем управление
    this.controls.update();
    
    // Анимируем свет на основе положения мыши
    if (this.pointLight) {
      const normalizedMouseX = (this.mouseX / this.width) * 2 - 1;
      const normalizedMouseY = -(this.mouseY / this.height) * 2 + 1;
      
      this.pointLight.position.x = normalizedMouseX * 5;
      this.pointLight.position.y = normalizedMouseY * 5;
    }
    
    // Рендерим сцену с постобработкой
    this.composer.render();
  }
  
  handleResize() {
    // Обновляем размеры
    this.width = this.container.offsetWidth;
    this.height = this.container.offsetHeight;
    
    // Обновляем камеру
    this.camera.aspect = this.width / this.height;
    this.camera.updateProjectionMatrix();
    
    // Обновляем рендерер
    this.renderer.setSize(this.width, this.height);
    this.composer.setSize(this.width, this.height);
  }
  
  handleMouseMove(event) {
    // Обновляем положение мыши
    this.mouseX = event.clientX;
    this.mouseY = event.clientY;
  }
}

/**
 * Класс для создания фона с частицами
 */
class ParticleBackground {
  constructor(options = {}) {
    this.options = {
      container: '#particle-container',
      particleCount: 500,
      particleColor: 0xb935ff,
      backgroundColor: 0x050510,
      maxDistance: 150,
      ...options
    };
    
    this.container = document.querySelector(this.options.container);
    
    if (!this.container) {
      console.warn('ParticleBackground: Container not found');
      return;
    }
    
    this.width = this.container.offsetWidth;
    this.height = this.container.offsetHeight;
    this.mouseX = 0;
    this.mouseY = 0;
    
    this.init();
  }
  
  init() {
    // Создаем сцену
    this.scene = new THREE.Scene();
    this.scene.background = new THREE.Color(this.options.backgroundColor);
    
    // Создаем камеру
    this.camera = new THREE.PerspectiveCamera(75, this.width / this.height, 0.1, 1000);
    this.camera.position.z = 50;
    
    // Создаем рендерер
    this.renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    this.renderer.setSize(this.width, this.height);
    this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    this.container.appendChild(this.renderer.domElement);
    
    // Создаем частицы
    this.createParticles();
    
    // Добавляем обработчики событий
    window.addEventListener('resize', this.handleResize.bind(this));
    window.addEventListener('mousemove', this.handleMouseMove.bind(this));
    
    // Запускаем анимацию
    this.animate();
  }
  
  createParticles() {
    // Создаем геометрию для частиц
    const particlesGeometry = new THREE.BufferGeometry();
    const particlesCount = this.options.particleCount;
    
    // Создаем массивы для позиций и скоростей частиц
    const positions = new Float32Array(particlesCount * 3);
    const velocities = new Float32Array(particlesCount * 3);
    
    // Заполняем массивы случайными значениями
    for (let i = 0; i < particlesCount * 3; i += 3) {
      // Позиции
      positions[i] = (Math.random() - 0.5) * this.width;
      positions[i + 1] = (Math.random() - 0.5) * this.height;
      positions[i + 2] = (Math.random() - 0.5) * 100;
      
      // Скорости
      velocities[i] = (Math.random() - 0.5) * 0.2;
      velocities[i + 1] = (Math.random() - 0.5) * 0.2;
      velocities[i + 2] = (Math.random() - 0.5) * 0.2;
    }
    
    // Добавляем атрибуты в геометрию
    particlesGeometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
    particlesGeometry.setAttribute('velocity', new THREE.BufferAttribute(velocities, 3));
    
    // Создаем материал для частиц
    const particlesMaterial = new THREE.PointsMaterial({
      color: this.options.particleColor,
      size: 0.5,
      transparent: true,
      opacity: 0.8,
      blending: THREE.AdditiveBlending,
      sizeAttenuation: true
    });
    
    // Создаем систему частиц
    this.particles = new THREE.Points(particlesGeometry, particlesMaterial);
    this.scene.add(this.particles);
    
    // Создаем линии между частицами
    this.linesMaterial = new THREE.LineBasicMaterial({
      color: this.options.particleColor,
      transparent: true,
      opacity: 0.2,
      blending: THREE.AdditiveBlending
    });
    
    this.lines = [];
  }
  
  updateParticles() {
    // Обновляем позиции частиц
    const positions = this.particles.geometry.attributes.position.array;
    const velocities = this.particles.geometry.attributes.velocity.array;
    
    // Удаляем старые линии
    this.lines.forEach(line => {
      this.scene.remove(line);
    });
    this.lines = [];
    
    // Обновляем позиции и создаем новые линии
    for (let i = 0; i < positions.length; i += 3) {
      // Обновляем позиции
      positions[i] += velocities[i];
      positions[i + 1] += velocities[i + 1];
      positions[i + 2] += velocities[i + 2];
      
      // Проверяем границы
      if (positions[i] < -this.width / 2 || positions[i] > this.width / 2) {
        velocities[i] = -velocities[i];
      }
      
      if (positions[i + 1] < -this.height / 2 || positions[i + 1] > this.height / 2) {
        velocities[i + 1] = -velocities[i + 1];
      }
      
      if (positions[i + 2] < -50 || positions[i + 2] > 50) {
        velocities[i + 2] = -velocities[i + 2];
      }
      
      // Влияние мыши
      const mouseX = (this.mouseX / this.width) * 2 - 1;
      const mouseY = -(this.mouseY / this.height) * 2 + 1;
      
      const dx = mouseX * this.width / 2 - positions[i];
      const dy = mouseY * this.height / 2 - positions[i + 1];
      const distance = Math.sqrt(dx * dx + dy * dy);
      
      if (distance < 100) {
        velocities[i] += dx * 0.0001;
        velocities[i + 1] += dy * 0.0001;
      }
      
      // Создаем линии между близкими частицами
      for (let j = i + 3; j < positions.length; j += 3) {
        const dx = positions[i] - positions[j];
        const dy = positions[i + 1] - positions[j + 1];
        const dz = positions[i + 2] - positions[j + 2];
        const distance = Math.sqrt(dx * dx + dy * dy + dz * dz);
        
        if (distance < this.options.maxDistance) {
          const lineGeometry = new THREE.BufferGeometry().setFromPoints([
            new THREE.Vector3(positions[i], positions[i + 1], positions[i + 2]),
            new THREE.Vector3(positions[j], positions[j + 1], positions[j + 2])
          ]);
          
          const line = new THREE.Line(lineGeometry, this.linesMaterial);
          this.scene.add(line);
          this.lines.push(line);
        }
      }
    }
    
    // Обновляем атрибуты
    this.particles.geometry.attributes.position.needsUpdate = true;
    this.particles.geometry.attributes.velocity.needsUpdate = true;
  }
  
  animate() {
    requestAnimationFrame(this.animate.bind(this));
    
    // Обновляем частицы
    this.updateParticles();
    
    // Вращаем систему частиц
    this.particles.rotation.y += 0.001;
    
    // Рендерим сцену
    this.renderer.render(this.scene, this.camera);
  }
  
  handleResize() {
    // Обновляем размеры
    this.width = this.container.offsetWidth;
    this.height = this.container.offsetHeight;
    
    // Обновляем камеру
    this.camera.aspect = this.width / this.height;
    this.camera.updateProjectionMatrix();
    
    // Обновляем рендерер
    this.renderer.setSize(this.width, this.height);
  }
  
  handleMouseMove(event) {
    // Обновляем положение мыши
    this.mouseX = event.clientX;
    this.mouseY = event.clientY;
  }
}

// Экспортируем классы
export { AILogoEffect, ParticleBackground }; 