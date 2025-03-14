<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\CaseStudy;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Создаем администратора
        User::create([
            'name' => 'Admin',
            'email' => 'admin@optimaai.ru',
            'password' => Hash::make('password'),
        ]);

        // Создаем услуги
        $services = [
            [
                'title' => 'Консультации и обучение',
                'slug' => 'consulting-and-training',
                'description' => 'Индивидуальные консультации и семинары для начинающих. Наша программа включает основы нейросетей, применение в бизнесе, практику с ChatGPT, правильные промты и автоматизацию задач.',
                'features' => "- Индивидуальный подход к обучению\n- Практические занятия с реальными кейсами\n- Обучение работе с популярными нейросетями\n- Разработка собственных промтов",
                'results' => "- Клиент получает навыки самостоятельного использования ИИ\n- Повышение эффективности работы сотрудников\n- Автоматизация рутинных задач",
                'price_info' => 'Фиксированная цена за консультацию/семинар, пакетные предложения',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Настройка языковых моделей «под ключ»',
                'slug' => 'language-models-setup',
                'description' => 'Индивидуальная настройка AI-решений для анализа данных, автоматизации ответов, генерации контента. Возможности включают интеграцию с CRM, Notion, Telegram и другими сервисами.',
                'features' => "- Интеграция с CRM-системами\n- Настройка для работы с корпоративными данными\n- Автоматизация ответов клиентам\n- Генерация контента для маркетинга",
                'results' => "- Готовая модель, адаптированная под ваши задачи\n- Снижение нагрузки на сотрудников\n- Повышение качества обслуживания клиентов",
                'price_info' => 'Фиксированная цена за настройку + пакеты с обучением',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Интеграция нейросетей в бизнес-процессы',
                'slug' => 'ai-business-integration',
                'description' => 'Полная интеграция AI в корпоративные сервисы (CRM, финансы, поддержка клиентов). Включает обучение сотрудников, техническую поддержку и доработку решений.',
                'features' => "- Комплексная интеграция во все бизнес-процессы\n- Обучение сотрудников работе с системой\n- Техническая поддержка и сопровождение\n- Регулярные обновления и доработки",
                'results' => "- Автоматизация процессов и самостоятельное управление ИИ\n- Значительное сокращение времени на рутинные операции\n- Повышение конкурентоспособности бизнеса",
                'price_info' => 'Фиксированная цена за интеграцию + абонентское обслуживание',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        // Создаем отзывы
        $testimonials = [
            [
                'client_name' => 'Иван Петров',
                'client_company' => 'ООО "ТехноПром"',
                'client_position' => 'Генеральный директор',
                'content' => 'Благодаря OptimaAI мы смогли автоматизировать обработку заявок клиентов, что сократило время ответа в 3 раза. Отличный результат, рекомендую!',
                'rating' => 5,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'client_name' => 'Елена Сидорова',
                'client_company' => 'Образовательный центр "Знание"',
                'client_position' => 'Руководитель',
                'content' => 'Мы внедрили ИИ-помощника для ответов на типовые вопросы студентов. Это позволило нашим преподавателям сосредоточиться на более сложных задачах. Очень довольны сотрудничеством!',
                'rating' => 5,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'client_name' => 'Алексей Иванов',
                'client_company' => 'Интернет-магазин "ГаджетМаркет"',
                'client_position' => 'Директор по маркетингу',
                'content' => 'Команда OptimaAI помогла нам настроить генерацию описаний товаров с помощью нейросети. Качество текстов на высоте, а скорость наполнения каталога выросла в разы.',
                'rating' => 4,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'client_name' => 'Мария Козлова',
                'client_company' => 'Юридическая фирма "ПравоЭксперт"',
                'client_position' => 'Управляющий партнер',
                'content' => 'Прошли обучение по использованию ИИ в юридической практике. Теперь мы экономим до 30% времени на подготовке типовых документов. Спасибо за профессиональный подход!',
                'rating' => 5,
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }

        // Создаем кейсы
        $caseStudies = [
            [
                'title' => 'Автоматизация поддержки клиентов для интернет-магазина',
                'slug' => 'ecommerce-customer-support-automation',
                'description' => 'Внедрение ИИ-чат-бота для обработки типовых запросов клиентов интернет-магазина электроники.',
                'challenge' => 'Интернет-магазин столкнулся с растущим потоком однотипных запросов от клиентов, что приводило к задержкам в ответах и снижению удовлетворенности покупателей.',
                'solution' => 'Мы разработали и внедрили ИИ-чат-бота, интегрированного с CRM-системой магазина. Бот был обучен на базе исторических диалогов с клиентами и настроен на обработку наиболее частых запросов.',
                'results' => 'Время ответа на типовые запросы сократилось с 2 часов до 2 минут. 70% запросов теперь обрабатываются без участия операторов. Удовлетворенность клиентов выросла на 25%.',
                'client_name' => 'ООО "ЭлектроМаркет"',
                'client_industry' => 'Розничная торговля',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Оптимизация документооборота в юридической фирме',
                'slug' => 'legal-document-management-optimization',
                'description' => 'Внедрение системы автоматической генерации и проверки юридических документов на основе нейросетевых технологий.',
                'challenge' => 'Юридическая фирма тратила значительные ресурсы на подготовку типовых документов и их проверку, что снижало эффективность работы юристов.',
                'solution' => 'Мы разработали систему на основе языковых моделей, которая автоматически генерирует типовые документы и проверяет их на соответствие законодательству и внутренним стандартам фирмы.',
                'results' => 'Время подготовки типовых документов сократилось на 80%. Юристы могут сосредоточиться на более сложных задачах. Количество ошибок в документах снизилось на 60%.',
                'client_name' => 'Юридическая фирма "ПравоЭксперт"',
                'client_industry' => 'Юридические услуги',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Автоматизация анализа данных для производственного предприятия',
                'slug' => 'manufacturing-data-analysis-automation',
                'description' => 'Внедрение системы предиктивной аналитики для оптимизации производственных процессов и снижения издержек.',
                'challenge' => 'Производственное предприятие собирало большие объемы данных о работе оборудования, но не могло эффективно их анализировать для принятия управленческих решений.',
                'solution' => 'Мы разработали систему предиктивной аналитики, которая в режиме реального времени анализирует данные с датчиков оборудования и предсказывает возможные сбои и оптимальные режимы работы.',
                'results' => 'Простои оборудования сократились на 35%. Энергопотребление снизилось на 15%. Общая эффективность производства выросла на 20%.',
                'client_name' => 'АО "ТехноПром"',
                'client_industry' => 'Производство',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($caseStudies as $caseStudy) {
            CaseStudy::create($caseStudy);
        }

        // Создаем статьи блога
        $posts = [
            [
                'title' => 'Как нейросети меняют бизнес-процессы в 2025 году',
                'slug' => 'how-neural-networks-change-business-processes-2025',
                'excerpt' => 'Обзор ключевых тенденций в применении нейросетевых технологий для оптимизации бизнес-процессов в современных компаниях.',
                'content' => "# Как нейросети меняют бизнес-процессы в 2025 году\n\nИскусственный интеллект и нейросетевые технологии продолжают трансформировать бизнес-процессы во всех отраслях. В этой статье мы рассмотрим ключевые тенденции и практические примеры применения нейросетей в бизнесе в 2025 году.\n\n## Автоматизация рутинных задач\n\nОдно из главных преимуществ нейросетей — способность автоматизировать повторяющиеся задачи, которые ранее требовали участия человека. Современные языковые модели могут обрабатывать электронную почту, составлять отчеты, анализировать документы и даже вести переговоры с клиентами.\n\n## Персонализация клиентского опыта\n\nНейросети позволяют создавать индивидуальные предложения для каждого клиента на основе анализа его предпочтений и поведения. Это значительно повышает конверсию и лояльность клиентов.\n\n## Предиктивная аналитика\n\nСовременные нейросети способны анализировать большие объемы данных и предсказывать будущие тренды, что помогает компаниям принимать более обоснованные решения и снижать риски.\n\n## Оптимизация производства\n\nВ производственном секторе нейросети используются для оптимизации процессов, предсказания сбоев оборудования и снижения энергопотребления.\n\n## Заключение\n\nВнедрение нейросетевых технологий становится необходимым условием для сохранения конкурентоспособности в современном бизнесе. Компании, которые активно применяют ИИ, демонстрируют более высокие показатели эффективности и прибыльности.",
                'user_id' => 1,
                'is_published' => true,
                'published_at' => now(),
                'meta_title' => 'Как нейросети меняют бизнес-процессы в 2025 году | OptimaAI',
                'meta_description' => 'Обзор ключевых тенденций в применении нейросетевых технологий для оптимизации бизнес-процессов в современных компаниях.',
            ],
            [
                'title' => 'Топ-5 языковых моделей для бизнеса в 2025 году',
                'slug' => 'top-5-language-models-for-business-2025',
                'excerpt' => 'Сравнительный анализ наиболее эффективных языковых моделей для решения бизнес-задач в 2025 году.',
                'content' => "# Топ-5 языковых моделей для бизнеса в 2025 году\n\nЯзыковые модели стали неотъемлемой частью бизнес-процессов во многих компаниях. В этой статье мы рассмотрим пять наиболее эффективных языковых моделей, которые помогают бизнесу решать различные задачи в 2025 году.\n\n## 1. GPT-5\n\nПоследняя версия модели от OpenAI предлагает беспрецедентные возможности для генерации контента, анализа данных и автоматизации коммуникаций. GPT-5 отличается глубоким пониманием контекста и способностью генерировать высококачественный контент на различных языках.\n\n## 2. Claude 3\n\nМодель от Anthropic специализируется на безопасности и этичности генерируемого контента, что делает ее идеальным выбором для компаний, работающих в регулируемых отраслях.\n\n## 3. Gemini Pro\n\nРазработка Google предлагает отличную интеграцию с другими сервисами компании и специализируется на мультимодальных задачах, объединяя текст, изображения и аудио.\n\n## 4. LLaMA 3\n\nОткрытая модель от Meta, которая отличается высокой производительностью при локальном развертывании, что важно для компаний с высокими требованиями к конфиденциальности данных.\n\n## 5. Mistral Large\n\nЭта модель предлагает оптимальное соотношение производительности и стоимости, что делает ее популярным выбором для малого и среднего бизнеса.\n\n## Заключение\n\nВыбор языковой модели зависит от конкретных задач и требований вашего бизнеса. Важно учитывать такие факторы, как производительность, стоимость, безопасность и возможности интеграции с существующими системами.",
                'user_id' => 1,
                'is_published' => true,
                'published_at' => now()->subDays(2),
                'meta_title' => 'Топ-5 языковых моделей для бизнеса в 2025 году | OptimaAI',
                'meta_description' => 'Сравнительный анализ наиболее эффективных языковых моделей для решения бизнес-задач в 2025 году.',
            ],
            [
                'title' => 'Этические аспекты использования ИИ в бизнесе',
                'slug' => 'ethical-aspects-of-ai-in-business',
                'excerpt' => 'Рассмотрение ключевых этических вопросов, связанных с внедрением искусственного интеллекта в бизнес-процессы.',
                'content' => "# Этические аспекты использования ИИ в бизнесе\n\nПо мере того как искусственный интеллект становится неотъемлемой частью бизнес-процессов, компании сталкиваются с различными этическими вопросами. В этой статье мы рассмотрим ключевые этические аспекты использования ИИ в бизнесе и предложим рекомендации по их решению.\n\n## Прозрачность алгоритмов\n\nОдин из главных этических вопросов связан с прозрачностью работы алгоритмов ИИ. Клиенты и сотрудники должны понимать, когда они взаимодействуют с ИИ, и иметь представление о том, как принимаются решения.\n\n## Конфиденциальность данных\n\nИспользование ИИ часто требует обработки больших объемов персональных данных. Компании должны обеспечивать надежную защиту этих данных и соблюдать все применимые законы о конфиденциальности.\n\n## Предвзятость алгоритмов\n\nАлгоритмы ИИ могут наследовать и усиливать существующие предубеждения, присутствующие в обучающих данных. Компании должны активно работать над выявлением и устранением таких предубеждений.\n\n## Влияние на рынок труда\n\nАвтоматизация с помощью ИИ может привести к сокращению рабочих мест. Компании несут ответственность за переобучение сотрудников и создание новых возможностей для трудоустройства.\n\n## Рекомендации для этичного использования ИИ\n\n1. Разработайте четкую политику этичного использования ИИ в вашей компании.\n2. Обеспечьте прозрачность в отношении того, как и когда используется ИИ.\n3. Регулярно проверяйте алгоритмы на наличие предубеждений.\n4. Инвестируйте в переобучение сотрудников, чьи роли могут быть автоматизированы.\n5. Соблюдайте все применимые законы и нормативные акты.\n\n## Заключение\n\nЭтичное использование ИИ не только помогает избежать репутационных и юридических рисков, но и способствует построению доверительных отношений с клиентами и сотрудниками. Компании, которые уделяют должное внимание этическим аспектам ИИ, получают долгосрочное конкурентное преимущество.",
                'user_id' => 1,
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'meta_title' => 'Этические аспекты использования ИИ в бизнесе | OptimaAI',
                'meta_description' => 'Рассмотрение ключевых этических вопросов, связанных с внедрением искусственного интеллекта в бизнес-процессы.',
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
