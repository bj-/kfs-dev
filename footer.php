<?php
/**
 * The template for displaying the footer.
 *
 * @package Go
 */

?>

	</main>
<footer id="site-footer">

<?php
global $bender_settings;

		

//echo 'blocks/' . checkTemplateExist($bender_settings["footer"]["template"]) . '.php';

include 'blocks/anchor.php';	//
include 'blocks/' . checkTemplateExist(@$bender_settings["footer"]["template"]) . '.php';	//
//echo "<pre>"; var_dump($bender_settings["footer"]); echo "</pre>";
?>
</footer>
</div>

<?php
//echo "<pre>"; var_dump($bender_settings["chat"]); echo "</pre>";
//echo "<pre>"; var_dump ($bender_settings["company"]["chat"]); echo "</pre>";

if (@$bender_settings["chat"]["active"])
{
	include 'blocks/' . checkTemplateExist($bender_settings["chat"]["template"]) . '.php';	//
}
?>

	<?php wp_footer(); ?>
	
<script>
// Инициализация разного-всякого на странице

new WOW({
            //boxClass: 'wow',      // класс элементов для анимации
            //animateClass: 'animated', // класс для анимированных элементов
            //offset: 0,            // расстояние от нижней части окна до верхней части элемента
            mobile: true,         // ВАЖНО: разрешить на мобильных!
            live: true,           // отслеживать динамические изменения
            callback: function(box) {
                // console.log("WOW сработал:", box);
            }
        }).init();

/* инит всех fancybox */
Fancybox.bind("[data-fancybox]", {
	// Your custom options
	adaptiveHeight: true
});

/*
$(document).ready(function() {
	// Инициализация WoW после slick-slide т.к. слик ломает дом и вов перестает работать
    
	// Обходим проверку мобильных устройств в WOW.js
	/*
	if (typeof WOW !== 'undefined') {
		WOW.prototype.mobileCheck = function() {
			return true; // Всегда разрешаем анимации (в реальности - нге помогло ничем)
		};
	}
	*/

    // Инициализируем WOW с правильными параметрами для мобильных
/*
    setTimeout(function() {
        new WOW({
            boxClass: 'wow',      // класс элементов для анимации
            animateClass: 'animated', // класс для анимированных элементов
            offset: 0,            // расстояние от нижней части окна до верхней части элемента
            mobile: true,         // ВАЖНО: разрешить на мобильных!
            live: true,           // отслеживать динамические изменения
            callback: function(box) {
                // console.log("WOW сработал:", box);
            }
        }).init();
    }, 300);
});
*/

// Дополнительная проверка при скролле (особенно для мобильных)
/*
let scrollTimer;
$(window).on('scroll', function() {
    clearTimeout(scrollTimer);
    scrollTimer = setTimeout(function() {
        if (typeof WOW !== 'undefined') {
            new WOW().sync();
        }
    }, 50);
});
*/

/*
// Обновляем при переключении слайдов
$('.slick-gallery_photo').on('afterChange', function(event, slick, currentSlide) {
    setTimeout(function() {
        if (typeof WOW !== 'undefined') {
            new WOW().sync();
        }
    }, 100);
});
*/


/*
// Определяем мобильное устройство
function isMobileDevice() {
    return (
        /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ||
        navigator.maxTouchPoints > 1 ||
        window.matchMedia('(hover: none)').matches
    );
}

// Добавляем класс к тегу html если это мобильное устройство
if (isMobileDevice()) {
    document.documentElement.classList.add('is-mobile');
}
*/
</script>

<script src="/scripts/smart-cookies/js/smart-cookies.js"></script>
	
	</body>
</html>
