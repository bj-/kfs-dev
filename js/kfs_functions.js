function showmenu(){
	if (document.getElementById("mobile-menu").classList.contains('block-active-menu')) 
	{
		document.getElementById("mobile-menu").classList.remove('block-active-menu');
		document.getElementById("mobile-menu").classList.add('block-inactive-menu');
		obj_show(['menu-mobile']); obj_hide(['menu-mobile-close']); 
		//alert('show');
	} 
	else 
	{
		document.getElementById("mobile-menu").classList.remove('block-inactive-menu');
		document.getElementById("mobile-menu").classList.add('block-active-menu');
		obj_show(['menu-mobile-close']); obj_hide(['menu-mobile']);
		//alert('close');
	}
};

function obj_show(arr)
{
	arr.forEach(item => {
		//console.log('I like' + item);
		document.getElementById(item).style.display = 'flex';
	});
}

function obj_hide(arr)
{
	arr.forEach(item => {
		//console.log('I like' + item);
		document.getElementById(item).style.display = 'none';
	});
}

// Функция для инициализации слайдера (в попапах slick-slide имеет 0 ширину т.к. контейнер изначально скрыт при инициализации страницы. функция вызывается из fancybox, после открытия попапа
function initSlickSlider(selector) {
	if ($(selector).hasClass('slick-initialized')) {
		$(selector).slick('unslick'); // Уничтожаем старый слайдер
	}
  
	$(selector).slick({
		dots: true,
		infinite: true,
		speed: 500,
		fade: true,
		cssEase: 'linear',
		// Добавляем, чтобы слайдер корректно работал при скрытии/показе
		accessibility: true,
		adaptiveHeight: true,
	    //arrows: true,
		//prevArrow: $('.prev'),
        //nextArrow: $('.next')
		//prevArrow: '<div class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true">11</i></div>',
		//nextArrow: '<div class="slick-next"><i class="fa fa-angle-right" aria-hidden="true">22</i></div>'
		//prevArrow:"<img class='a-left control-c prev slick-prev' src='YOUR LEFT ARROW IMAGE URL'>",
		//nextArrow:"<img class='a-right control-c next slick-next' src='YOUR RIGHT ARROW IMAGE URL'>"
	});

	// Ждём следующего кадра рендеринга, чтобы контейнер точно получил размеры
	requestAnimationFrame(() => {
		$(selector).slick("refresh").trigger('resize');
	});
}

// проверки на мобилу/десктоп
function isMobileDevice() {
    return (
        typeof window.orientation !== "undefined" || 
        navigator.userAgent.indexOf('IEMobile') !== -1 ||
        /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)
    );
}
function isMac() {
    return (
        typeof window.orientation !== "undefined" || 
        navigator.userAgent.indexOf('IEMobile') !== -1 ||
        /iPhone|iPad|iPod/i.test(navigator.userAgent)
    );
}

function isMobile(){
	let ret = (isMobileDevice()) ? true : false;
	return ret;
}

function isDesktop(){
	let ret = (!isMobileDevice()) ? true : false;
	return ret;
}

function isSmallScreen(){
	return window.innerWidth <= 768;
}
