<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Очищаем таблицу услуг перед заполнением
        Service::truncate();
        
        // Создаем услуги
        $services = [
            [
                'title' => 'Консультации и обучение',
                'slug' => 'consulting-and-training',
                'description' => 'Стратегический консалтинг по внедрению ИИ, обучение команды и разработка дорожной карты цифровой трансформации',
                'features' => 'Анализ бизнес-процессов, Оценка готовности к внедрению ИИ, Разработка стратегии, Обучение персонала',
                'results' => 'Повышение компетенций команды, Четкое понимание возможностей ИИ, Готовая дорожная карта внедрения',
                'price_info' => 'От 100 000 ₽',
                'image' => 'images/services/consulting-and-training.svg',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Настройка языковых моделей',
                'slug' => 'language-models-setup',
                'description' => 'Адаптация и тонкая настройка языковых моделей под специфику вашего бизнеса, обучение на корпоративных данных',
                'features' => 'Подбор оптимальной модели, Тонкая настройка на ваших данных, Интеграция с существующими системами, Тестирование и оптимизация',
                'results' => 'Персонализированная языковая модель, Повышение точности ответов, Снижение затрат на поддержку',
                'price_info' => 'От 200 000 ₽',
                'image' => 'images/services/language-models-setup.svg',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Интеграция ИИ в бизнес',
                'slug' => 'ai-business-integration',
                'description' => 'Полный цикл внедрения искусственного интеллекта в бизнес-процессы компании, от аудита до поддержки',
                'features' => 'Комплексный аудит процессов, Разработка и внедрение решений, Интеграция с IT-инфраструктурой, Техническая поддержка',
                'results' => 'Автоматизация рутинных задач, Повышение эффективности, Сокращение издержек, Конкурентное преимущество',
                'price_info' => 'От 500 000 ₽',
                'image' => 'images/services/ai-business-integration.svg',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];
        
        // Добавляем услуги в базу данных
        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
