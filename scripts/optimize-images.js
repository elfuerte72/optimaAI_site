/**
 * OptimAI - Скрипт оптимизации изображений
 * 
 * Этот скрипт автоматически оптимизирует все изображения в директории public/images,
 * конвертируя их в формат WebP и сжимая для улучшения производительности.
 */

import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';
import sharp from 'sharp';
import { glob } from 'glob';

// Получаем текущую директорию
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// Конфигурация
const config = {
    // Директория с изображениями
    inputDir: path.join(__dirname, '../public/images'),
    // Директория для оптимизированных изображений
    outputDir: path.join(__dirname, '../public/images/optimized'),
    // Качество WebP (0-100)
    webpQuality: 80,
    // Качество JPEG (0-100)
    jpegQuality: 85,
    // Уровень сжатия PNG (0-9)
    pngCompressionLevel: 9,
    // Максимальная ширина для больших изображений
    maxWidth: 1920,
    // Создавать разные размеры для адаптивных изображений
    createResponsiveSizes: true,
    // Размеры для адаптивных изображений
    responsiveSizes: [320, 640, 1024, 1440, 1920]
};

// Создаем выходную директорию, если она не существует
if (!fs.existsSync(config.outputDir)) {
    fs.mkdirSync(config.outputDir, { recursive: true });
    console.log(`Создана директория: ${config.outputDir}`);
}

// Функция для оптимизации изображения
async function optimizeImage(inputPath, outputPath, options = {}) {
    const { width, format, quality } = options;
    
    try {
        let image = sharp(inputPath);
        
        // Получаем метаданные изображения
        const metadata = await image.metadata();
        
        // Изменяем размер, если указана ширина и она меньше оригинальной
        if (width && metadata.width > width) {
            image = image.resize({ width, withoutEnlargement: true });
        }
        
        // Определяем формат вывода и параметры
        switch (format) {
            case 'webp':
                image = image.webp({ quality: quality || config.webpQuality });
                break;
            case 'jpeg':
            case 'jpg':
                image = image.jpeg({ quality: quality || config.jpegQuality });
                break;
            case 'png':
                image = image.png({ compressionLevel: config.pngCompressionLevel });
                break;
            default:
                // По умолчанию используем WebP
                image = image.webp({ quality: quality || config.webpQuality });
        }
        
        // Сохраняем оптимизированное изображение
        await image.toFile(outputPath);
        
        return {
            inputPath,
            outputPath,
            originalSize: fs.statSync(inputPath).size,
            optimizedSize: fs.statSync(outputPath).size
        };
    } catch (error) {
        console.error(`Ошибка при оптимизации ${inputPath}:`, error);
        return null;
    }
}

// Функция для создания адаптивных изображений
async function createResponsiveImages(inputPath, fileName, ext) {
    const results = [];
    
    // Создаем WebP версию в разных размерах
    for (const width of config.responsiveSizes) {
        const outputFileName = `${fileName}-${width}w.webp`;
        const outputPath = path.join(config.outputDir, outputFileName);
        
        const result = await optimizeImage(inputPath, outputPath, {
            width,
            format: 'webp'
        });
        
        if (result) {
            results.push(result);
        }
    }
    
    // Создаем оригинальный формат в разных размерах (для поддержки старых браузеров)
    for (const width of config.responsiveSizes) {
        const outputFileName = `${fileName}-${width}w${ext}`;
        const outputPath = path.join(config.outputDir, outputFileName);
        
        const result = await optimizeImage(inputPath, outputPath, {
            width,
            format: ext.replace('.', '')
        });
        
        if (result) {
            results.push(result);
        }
    }
    
    return results;
}

// Основная функция оптимизации
async function optimizeImages() {
    console.log('Начинаем оптимизацию изображений...');
    
    try {
        // Находим все изображения
        const imageFiles = await glob('**/*.{jpg,jpeg,png,gif}', { cwd: config.inputDir });
        
        if (imageFiles.length === 0) {
            console.log('Изображения не найдены.');
            return;
        }
        
        console.log(`Найдено ${imageFiles.length} изображений для оптимизации.`);
        
        let totalOriginalSize = 0;
        let totalOptimizedSize = 0;
        let successCount = 0;
        
        // Обрабатываем каждое изображение
        for (const file of imageFiles) {
            const inputPath = path.join(config.inputDir, file);
            const parsedPath = path.parse(file);
            const dirPath = path.join(config.outputDir, parsedPath.dir);
            
            // Создаем поддиректории, если они не существуют
            if (!fs.existsSync(dirPath)) {
                fs.mkdirSync(dirPath, { recursive: true });
            }
            
            // Имя файла без расширения
            const fileName = parsedPath.name;
            // Расширение файла
            const ext = parsedPath.ext.toLowerCase();
            
            let results = [];
            
            if (config.createResponsiveSizes) {
                // Создаем адаптивные изображения
                results = await createResponsiveImages(inputPath, fileName, ext);
            } else {
                // Создаем только WebP версию
                const webpOutputPath = path.join(dirPath, `${fileName}.webp`);
                const webpResult = await optimizeImage(inputPath, webpOutputPath, { format: 'webp' });
                
                if (webpResult) {
                    results.push(webpResult);
                }
                
                // Создаем оптимизированную версию в оригинальном формате
                const originalOutputPath = path.join(dirPath, `${fileName}${ext}`);
                const originalResult = await optimizeImage(inputPath, originalOutputPath, { format: ext.replace('.', '') });
                
                if (originalResult) {
                    results.push(originalResult);
                }
            }
            
            // Подсчитываем статистику
            for (const result of results) {
                if (result) {
                    totalOriginalSize += result.originalSize;
                    totalOptimizedSize += result.optimizedSize;
                    successCount++;
                    
                    const savingsPercent = ((result.originalSize - result.optimizedSize) / result.originalSize * 100).toFixed(2);
                    console.log(`Оптимизировано: ${path.basename(result.outputPath)} (сохранено ${savingsPercent}%)`);
                }
            }
        }
        
        // Выводим общую статистику
        const totalSavingsBytes = totalOriginalSize - totalOptimizedSize;
        const totalSavingsPercent = ((totalSavingsBytes) / totalOriginalSize * 100).toFixed(2);
        
        console.log('\nОптимизация завершена!');
        console.log(`Успешно оптимизировано: ${successCount} файлов`);
        console.log(`Общий размер до оптимизации: ${(totalOriginalSize / 1024 / 1024).toFixed(2)} МБ`);
        console.log(`Общий размер после оптимизации: ${(totalOptimizedSize / 1024 / 1024).toFixed(2)} МБ`);
        console.log(`Сохранено: ${(totalSavingsBytes / 1024 / 1024).toFixed(2)} МБ (${totalSavingsPercent}%)`);
        
    } catch (error) {
        console.error('Ошибка при оптимизации изображений:', error);
    }
}

// Запускаем оптимизацию
optimizeImages(); 