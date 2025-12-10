document.addEventListener('DOMContentLoaded', function() {
    const vinylRecord = document.getElementById('vinylRecord');
    const recordCase = document.getElementById('recordCase');
    
    // Проверяем, что элементы существуют
    if (!vinylRecord || !recordCase) {
        console.log('Элементы для анимации не найдены');
        return;
    }
    
    // Функция запуска анимации
    function startVinylAnimation() {
        // Сбрасываем предыдущие анимации
        vinylRecord.classList.remove('vinyl-emerge', 'vinyl-spinning');
        recordCase.classList.remove('case-opening');
        
        // Принудительный reflow для перезапуска анимации
        void vinylRecord.offsetWidth;
        void recordCase.offsetWidth;
        
        // Показываем пластинку (изначально она прозрачная)
        vinylRecord.style.opacity = '0';
        
        // Ждем полной загрузки страницы
        if (document.readyState === 'complete') {
            executeAnimation();
        } else {
            window.addEventListener('load', executeAnimation);
        }
    }
    
    // Функция выполнения анимации
    function executeAnimation() {
        // Небольшая задержка перед началом анимации
        setTimeout(() => {
            // Анимируем коробку (легкое движение)
            recordCase.classList.add('case-opening');
            
            // Делаем пластинку видимой
            vinylRecord.style.opacity = '1';
            
            // Запускаем анимацию выезда
            vinylRecord.classList.add('vinyl-emerge');
            
            // После завершения выезда запускаем вращение
            setTimeout(() => {
                vinylRecord.classList.remove('vinyl-emerge');
                vinylRecord.classList.add('vinyl-spinning');
            }, 2500); // Длительность анимации выезда
        }, 800); // Задержка перед началом
    }
    
    // // Функция для перезапуска анимации по клику
    // function setupClickRestart() {
    //     vinylRecord.addEventListener('click', function() {
    //         // Останавливаем текущую анимацию
    //         vinylRecord.classList.remove('vinyl-spinning');
    //         vinylRecord.style.animation = 'none';
            
    //         // Сбрасываем позицию
    //         vinylRecord.style.transform = 'translate(-50%, -50%)';
            
    //         // Перезапускаем через небольшой интервал
    //         setTimeout(() => {
    //             vinylRecord.style.animation = '';
    //             startVinylAnimation();
    //         }, 50);
    //     });
    // }
    
    // // Функция для управления вращением при наведении
    // function setupHoverControls() {
    //     vinylRecord.addEventListener('mouseenter', function() {
    //         if (vinylRecord.classList.contains('vinyl-spinning')) {
    //             vinylRecord.style.animationPlayState = 'paused';
    //         }
    //     });
        
    //     vinylRecord.addEventListener('mouseleave', function() {
    //         if (vinylRecord.classList.contains('vinyl-spinning')) {
    //             vinylRecord.style.animationPlayState = 'running';
    //         }
    //     });
    // }
    
    // Инициализация анимации при загрузке
    startVinylAnimation();
    setupClickRestart();
    setupHoverControls();
    
    // Опционально: запуск анимации при попадании в область видимости
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && 
                    !vinylRecord.classList.contains('vinyl-spinning') && 
                    !vinylRecord.classList.contains('vinyl-emerge')) {
                    // Перезапускаем анимацию, если элемент стал видимым
                    startVinylAnimation();
                }
            });
        }, {
            threshold: 0.3
        });
        
        observer.observe(vinylRecord);
    }
});