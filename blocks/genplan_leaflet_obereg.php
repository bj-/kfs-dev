<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- START -->
<?php
$dev = (@$_GET["dev"] == "yep") ? TRUE : FALSE;
//$dev = FALSE;

$genplan_areas = convertToLeafletArrayPlace($block["areas"], $block["view"]["shift"], $block["area_prefix"]);
$genplan_poi = convertToLeafletArrayPOI($block["poi"], $block["view"]["shift"]);
$genplan_orders = convertToLeafletArrayOrders($block["orders"], $block["view"]["shift"]);
$genplan_lines = convertToLeafletArrayLines($block["lines"], $block["view"]["shift"]);


echo "<pre>genplan_lines\n"; var_dump($genplan_lines); echo "</pre>";

if ($dev) 
{
	echo '
	<link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css">
	<script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
	';
}
 //echo "<pre>block\n"; var_dump($block); echo "</pre>";
?>
<style>
#<?= $bUID; ?> { 
	position: relative; background-size: cover !important; background-position: center !important; height: fit-content;
	width: 90vw; margin: 20px auto; 
	& .fade { <?= $fade_style ?> width: 100%; height: 100%; }

	& .title {display:flex; gap:20px;}
	& .title > h2 { font-size: <?= $bender_settings["size"]["title"] ?>; /*line-height: 80px; */ color: <?= $title_color ?>; margin-top: 20px; margin-bottom: 20px; font-weight: normal; }
	& .text,
		& .title > h2 { /* flex: 1 1 0; */ }
	& .text { font-size: 18px; line-height: 32px; max-width: 50%; }
	& .title { justify-content: space-between; }
	& .title,
		& .content {padding-left:clamp(0px, 3vw, 50px); padding-right:clamp(0px, 3vw, 50px); }
	<?php if ( $block["view"]["page"] == "box" ) : ?>
	& .content { height: 80vh; position: relative; max-height: 80vh;}
	<?php endif; ?>
    
	/* Элементы управления */
	& .legend, 
		& .info-panel { position: absolute !important; z-index: 1; backdrop-filter: blur(5px); border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); padding: clamp(2px, 1vw, 10px); border: 1px solid #e0e0e0; pointer-events: auto; background-color: <?= setAlpha($bender_settings["colors"]["site"]["bg"], 0.5) ?>; }

	& .legend { 
		bottom: clamp(2px, 1.5vw, 20px); right: clamp(2px, 5vw, 20px); line-height: 14px; font-weight: 500; cursor: default; 
		display: flex; gap: clamp(5px, 2vw, 20px); flex-wrap: wrap; margin-left: 45px; 
		/* padding-bottom: env(safe-area-inset-bottom, 0px); */
	}

	/* Инфопанель */
    & .info-panel.collapsed > ul { display: none; }
	& .info-panel { top: clamp(2px, 1.5vw, 20px); right: clamp(2px, 2vw, 20px); transition: all 0.3s ease; overflow: hidden;}
	& .info-panel h3 { font-size: clamp(14px, 3.4vw, 22px); margin: 0; cursor: pointer; position: relative; padding-right: 25px; user-select: none; }
    /* Стрелка-индикатор */
    & .info-panel h3::after { content: ''; position: absolute; right: 5px; top: 50%; width: 8px; height: 8px; border-right: 2px solid <?= $title_color ?>; border-bottom: 2px solid <?= $title_color ?>; transform: translateY(-50%) rotate(45deg); transition: transform 0.3s; }
	/* Поворот стрелки при сворачивании */
    & .info-panel.collapsed h3::after { transform: translateY(-50%) rotate(-45deg); }
	& .info-panel > ul { margin-top: 5px; margin-left: clamp(10px, 4vw, 40px);}
	& .info-panel > ul > li { font-size: clamp(11px, 3.3vw, 18px); line-height: normal; }
	& .info-panel > ul > li::marker { content:"— ";}

	/* ===== Плавное скрытие элементов при попапе ===== */
	& .info-panel,
	& .legend,
	& .back-btn {
		transition: opacity 0.25s ease, transform 0.25s ease;
		will-change: opacity, transform;
		transform: translateZ(0);
	}

	/* Стили легенды с фильтрацией */
	& .legend-item { display: flex; align-items: center; padding: 4px 8px; border-radius: 4px; cursor: pointer; transition: all 0.3s; flex: 1 1 0; /* min-width: clamp(150px, 11vw, 200px); */ }
	& .legend-item-long { min-width: clamp(160px, 18vw, 200px); }

	& .legend-item:hover { background: <?= $bender_settings["colors"]["site"]["bg"] ?>; }
	& .legend-item.disabled .legend-color { opacity: 0.3; /* filter: grayscale(100%); */ }
	& .legend-item.disabled .legend-text { text-decoration: line-through; opacity: 0.5; color: #7f8c8d; }
	& .legend-color { width: clamp(14px, 5vw, 24px); height: clamp(14px, 5vw, 24px); border-radius: 4px; margin-right: 10px; border: 1px solid white; display: inline-block; flex-shrink: 0; transition: all 0.2s; }

	& .legend-color.sold { background-color: <?= $block["label_color"]["sold"] ?>; }
	& .legend-color.reserved { background-color: <?= $block["label_color"]["reserved"] ?>; }
	& .legend-color.available { background-color: <?= $block["label_color"]["available"] ?>; }
	& .legend-color.not-available { background-color: <?= $block["label_color"]["not-available"] ?>; }

	& .legend-text { font-weight: lighter; transition: all 0.2s; font-size: clamp(12px, 2vw, 18px); }

	/* Стили попапов */
	
	& .leaflet-popup-close-button {
		font: 30px / 24px Tahoma, Verdana, sans-serif;
		top: 2px;
		right: 5px;
	}
	
	& .leaflet-popup-content {
	margin-top: clamp(5px, 3vw, 13px);
    margin-right: clamp(5px, 3vw, 24px);
    margin-bottom: clamp(5px, 3vw, 13px);
    margin-left: clamp(5px, 3vw, 24px);
	width: max-content !important;
	}

	& .popup-content, 
		& .popup-poi-content { display: flex; gap: clamp(8px, 5vw, 15px); flex-direction: column; width: clamp(200px, 80vw, 350px); }
	& .popup-content-short { width: max-content; }
	& .popup-title { display: flex; justify-content: space-between; }
	& .popup-title-short { margin: 0;}
	& .popup-title > h3,
		& .popup-poi-title > h3 { margin:0; padding:0; color: #2c3e50; /*font-size: 1.3rem;*/ font-size: 20px; }

	& .popup-content .status { display: inline-block; padding: 3px 8px; border-radius: 12px; font-size: 0.85rem; font-weight: 500; font-size: 13px; /* margin-bottom: 8px; */ }
	& .popup-content .status.sold { background-color: <?= $block["label_color"]["sold"] ?>; color: <?= $block["label_color_text"]["sold"] ?>; }
	& .popup-content .status.reserved { background-color: <?= $block["label_color"]["reserved"] ?>; color: <?= $block["label_color_text"]["reserved"] ?>; }
	& .popup-content .status.available { background-color: <?= $block["label_color"]["available"] ?>; color: <?= $block["label_color_text"]["available"] ?>; }
	& .popup-content .status.not-available { background-color: <?= $block["label_color"]["not-available"] ?>; color: <?= $block["label_color_text"]["not-available"] ?>; }

	& .popup-content .desc { color: #278b25; font-style: italic; display: block; text-align: right; font-size: 13px; }

	& .popup-content .project-link,
	& .popup-content .interior-link { /* display: inline-block; /* margin-top: 5px; */ color: #3498db; text-decoration: none; font-weight: 500; }

	& .popup-content .project-link:hover,
		& .popup-content .interior-link:hover { text-decoration: underline; }
		
	& .popup-status { display: flex; justify-content: space-between; gap: 10px; align-items: center; height: 18px;}


	& .popup-content {
		& .popup-prop {
			display: flex; flex-direction: column; gap: 3px;
			
			& .label { font-weight:bold; font-size: 13px; }
			& .value { margin-left: 5px; font-weight: normal; }
		}
		& .popup-img {
			position: relative; height: clamp(150px, 22vw, 200px); background-size: cover !important; background-position: center !important;
			& .link {
				display: block;
				width: 100%;
				height: 100%;
			}
		}
		& .img-fade { 
			position: absolute; width:100%; height:100% 
		}
		& .img-label { 
			position: absolute; bottom: 5px; left: 15px; color: white; font-size: 26px;
			& .link {
				color: white;
			}
		}
	}

	& .area_gallery_item { height:200px;  background-size: cover !important; background-position: center !important; }

	/* Popup POI */
	& .popup-poi-content { width: clamp(200px, 80vw, 250px); 
		& .popup-poi-title {
			margin-right: 18px;
		}
		& .popup-poi-desc {
			font-size: 14px; 
			& .desc { }
		}
		& .popup-poi-img { 
			position: relative; 
			height: clamp(150px, 22vw, 200px); 
			background-size: cover !important; background-position: center !important; 
			width: 100%; 
			/* min-width: clamp(150px, 80vw, 250px); */
			& .link {
				display: block;
				width: 100%;
				height: 100%;
			}
		}

	}
	& .popup-poi-content-short { 
		width: fit-content; 
		& .popup-poi-title {
			margin-right: 18px;
		}
	}

	& .popup-poi-content .img-label { position: absolute; bottom: 5px; left: 15px; color: white; font-size: 26px;}

	/* нопки перемещения карты */
	/* Контейнер для кнопок навигации */
	& .map-navigation-control {
		background: #fff;
		border: 2px solid rgba(0,0,0,0.2);
		border-radius: 4px;
		padding: 5px;
		display: grid;
		grid-template-columns: 40px 40px 40px; /* 3 колонки */
		grid-template-rows: 40px 40px;         /* 2 ряда */
		gap: 5px;
		box-shadow: 0 1px 5px rgba(0,0,0,0.4);
	}

	/* Общий стиль кнопки */
	& .nav-btn {
		background: #fff;
		border: none;
		cursor: pointer;
		font-size: 20px;
		font-weight: bold;
		color: #333;
		border-radius: 2px;
		display: flex;
		align-items: center;
		justify-content: center;
		transition: background 0.2s;
	}

	& .nav-btn:hover { background: #f4f4f4; }

	& .nav-btn:active { background: #e0e0e0; }

	/* Расположение кнопок в сетке */
	& .btn-up    { grid-column: 2; grid-row: 1; }
	& .btn-left  { grid-column: 1; grid-row: 2; }
	& .btn-down  { grid-column: 2; grid-row: 2; }
	& .btn-right { grid-column: 3; grid-row: 2; }

	/* remove logo */
	& .leaflet-control-attribution > a { display:none; }
	
	/* Fancybox */
	& .is-arrow {
		color: rgb(255, 255, 255);
		width: 30px;
		height: 30px;
		& svg {
			stroke-width: 4px;
			filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.6));			
		}
	}
}

/* Положение кнопок зума карты TODO. сделать как вариант навигации */
/* .leaflet-right { right: 10px; top: 50%; transform: translateY(-50%) !important; } */
.leaflet-right { right: 10px; top: 110px; }


#<?= $bUID; ?>_map {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 8px;
	background-color: <?= $bender_settings["colors"]["site"]["bg"] ?>;
}

<?php if ( $block["view"]["page"] == "box" ) : ?>
/* отключение вертикального свайпа для карты */
#<?= $bUID; ?>_map {
    touch-action: pan-y; /* Вертикальные свайпы — скролл страницы, горизонтальные — обрабатываем в JS */
    cursor: grab; /* Опционально: визуальный курсор */
}
#<?= $bUID; ?>_map:active {
    cursor: grabbing;
}
<?php endif; ?>

<?php if ( $block["view"]["page"] == "fullscreen" ) : ?>
/* full viewport */
#<?= $bUID; ?> {
	width: 100vw; position: fixed; margin:0; top: 0px; height: calc(100vh - 0px);
	& .title, & .content { padding: 0; }
	& .title { position: absolute; top: 0; margin-left:clamp(10px, 5vw, 50px); z-index: 500;}
	& .title > h2 { margin: 0;}
	& .content { height: 100%; }
	& .info-panel { top: 100px; right: 60px;}
	& .legend { bottom: clamp(2px, 1.5vw, 20px); left: clamp(2px, 5vw, 20px); right: unset; margin-right: 100px; transition: all 0.1s}
	& .map-bg { 
		background: none; 
		position: fixed; /* Кастомизация Обререг */
		width: 100vw; /* Кастомизация Обререг */
		height: 100vh; /* Кастомизация Обререг */
		}

	/* 2. Псевдоэлемент с фоном */
	& .map-bg::before {
		content: "";
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: url(<?= $block["img"]["url"]; ?>) center center / cover;
		filter: blur(4px)  opacity(0.3); 
		transform: scale(1.03); 
	}
}

/* Кастомизация Клиента FULL SCREEN --- TODO вынести в админку */
#<?= $bUID; ?> {
	& .map-bg { 
		position: fixed;
		width: 100vw;
		height: 100vh;
		}
    & .legend {
        bottom: clamp(80px, 5.5vw, 120px);
	}

	& .img_gradient {
		background: linear-gradient(to bottom, rgba(29, 33, 22, 0.0) 75%, rgba(29, 33, 22, 0.3) 80%, rgba(29, 33, 22, 1) 100%);
	}	
	& .w100h100p {
		width: 100%;
		height: 100%;
	}
	& .btn {
		padding: 0.35rem 1.6rem;
		/* font-size: 18px; */
		font-size: clamp(12px, 3.5vw, 18px);
		margin-right: 18px;
	}
}
.footer { z-index: 500; }

@media (max-width: 1279px) {
    #<?= $bUID; ?> {
		& .legend {
			bottom: clamp(60px, 3.5vw, 20px);
		}
    }
}

@media (max-width: 768px) {
	.back-btn {
		top: 1.5rem;
		padding-left: clamp(1px, 2vw, 14px);
		z-index: 5;
	}
}
/* Кастомизация Клиента FULL SCREEN -- END */

<?php endif; ?>


/* Mobile адаптация */
@media (max-width: 1000px) {
    #<?= $bUID; ?> {
		& .legend{ right: unset; justify-self: center; margin-left: unset; }
    }
}

@media (max-width: 900px) {
    #<?= $bUID; ?> {
        width: 97vw; /* transition: all 0.4s */;
    }
	.leaflet-right { right: 0px; }
}
@media (max-width: 500px) {
    #<?= $bUID; ?> {
        width: 100vw;
		& .legend { left: clamp(1px, 0.5vw, 20px); margin-right: 100px; gap: clamp(1px, 0.2vw, 20px);}
		& .legend-item-long { min-width: clamp(110px, 35vw, 200px); }
		& .legend-item { min-width: clamp(110px, 35vw, 200px); }
		& .popup-poi-content { width: clamp(200px, 80vw, 200px);}
	}
}

	.ui-element--popup-open {
		opacity: 0 !important;
		transform: scale(0.98) !important;
		pointer-events: none !important;
	}

@media (max-width: 300px) {
    #<?= $bUID; ?> {
		& .legend-item {
			min-width: 135px;
		}
    }
}

#<?= $bUID; ?> {
	& .ios-bottom { bottom: 150px; }

    & .ios-legend { 
        width: 45px;
        top: 100px;
        right: 5px;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        padding: 10px 0; /* Убираем горизонтальные отступы, текст будет снаружи */
        bottom: unset;
        margin-right: unset;
        justify-self: center;
        margin-left: unset;
        left: unset;
        background-color: rgba(0,0,0,0.5);
        backdrop-filter: blur(5px);
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        z-index: 5;

        & .legend-item {
            position: relative; /* Якорь для абсолютного позиционирования текста */
            min-width: unset;
            padding: 4px 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: row;
            cursor: pointer;
        }
        
        & .legend-color {
            margin-right: unset;
            flex-shrink: 0;
        }
        
        & .legend-text {
            /* Позиционирование слева от иконки */
            position: absolute;
            right: calc(100% + 8px); /* Отступ слева */
            top: 50%;
            transform: translateY(-50%) translateX(-10px);
            white-space: nowrap;
            z-index: 10;
            
            /* Стиль, идентичный контейнеру легенды */
            background-color: rgba(0,0,0,0.5);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(224, 224, 224, 0.6);
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 6px 12px;
            
            font-weight: normal;
            font-size: clamp(14px, 3.5vw, 16px);
            color: #fff;
            
            /* Состояние "скрыто" */
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            will-change: opacity, transform;
            transition: opacity 0.3s ease, transform 0.3s ease, visibility 0.3s ease;
        }
        
        & .legend-text--visible {
            /* Состояние "видимо" */
            opacity: 1;
            visibility: visible;
            transform: translateY(-50%) translateX(0);
        }
		& .legend-item.disabled .legend-text { opacity: 0.7; color: rgb(255, 255, 255); }
	}
}

/* Специфично для iOS: увеличиваем отступ, если обнаружен Safari */
@supports (-webkit-touch-callout: none) {
    & .legend {
        bottom: calc(clamp(2px, 1.5vw, 20px) + env(safe-area-inset-bottom, 0px) + 90px);
    }
    
    /* На больших экранах iPad в ландшафте панель браузера меньше */
    @media (min-width: 768px) and (orientation: landscape) {
        & .legend {
            bottom: calc(clamp(2px, 1.5vw, 20px) + env(safe-area-inset-bottom, 0px) + 60px);
        }
    }
}

/* Кастомизация страницы */
<?= $block["custom"]["styles"];  ?>
</style>
<!-- <?php echo $_SERVER['REQUEST_URI'] ?> -->
<?php if ($_SERVER['REQUEST_URI'] == "/genplan-village/" ): ?>
<a href="/o-posjolke/" class="back-btn back-btn--blur">
	<svg class="back-btn__arrow">
		<use href="/wp-content/themes/obereg/wp-content/themes/assembling/static/images/sprite.svg#arrow-to-left"></use>
	</svg>
	О поселке
</a>
<?php else: ?>
<a href="/genplan-village/" class="back-btn back-btn--blur">
	<svg class="back-btn__arrow">
		<use href="/wp-content/themes/obereg/wp-content/themes/assembling/static/images/sprite.svg#arrow-to-left"></use>
	</svg>
	Общий план
</a>
<?php endif; ?>
	
<div id="<?= $bUID; ?>" class="wide" style="<?= $block["bg_style"] ?>" >
	<div class="fade">
		<div class="title">
			<h2 class="wow fadeInDown slower" data-wow-offset="0"><?= $block['title'] ?></h2>
			<p class="text"><?= $block['text'] ?></p>
		</div>
		<div class="content">
			<div id="<?= $bUID; ?>_map" class="map-bg bg-container"></div>
			<!-- Легенда с фильтрацией (заменяет панель управления) -->
			<div class="legend <?php if (@$_GET["test"] == "ios1" ) { echo "ios-legend"; } ?>">
				<div class="legend-item active" data-status="available">
					<span class="legend-color available"></span>
					<span class="legend-text"><?= $block["status_name"]["available"] ?></span>
				</div>
				<div class="legend-item active" data-status="reserved">
					<span class="legend-color reserved"></span>
					<span class="legend-text"><?= $block["status_name"]["reserved"] ?></span>
				</div>
				<div class="legend-item active" data-status="sold">
					<span class="legend-color sold"></span>
					<span class="legend-text"><?= $block["status_name"]["sold"] ?></span>
				</div>
				<div class="legend-item legend-item-long active" data-status="not-available">
					<span class="legend-color not-available"></span>
					<span class="legend-text"><?= $block["status_name"]["not-available"] ?></span>
				</div>
			</div>
			<!-- Информационная панель -->
			<?php if ( $block["infopanel"]["active"] ): ?>
			<div class="info-panel">
				<h3><?= $block["infopanel"]["title"]; ?></h3>
				<ul>
					<?php foreach ( $block["infopanel"]["items"] as $item ): ?>
					<li><?= $item["name"]; ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php
if ($dev and is_file($bender_settings["stylesheet_dir"] . "/dev/geoman_ui.php")) 
{
	include $bender_settings["stylesheet_dir"] . "/dev/geoman_ui.php";
}
?>

<script>
function isSmallScreen(){
	return window.innerWidth <= 768;
}

var map = null; // Объявляем map в глобальной области видимости
var isPopupOpen = false; // ===== ГЛОБАЛЬНОЕ СОСТОЯНИЕ: открыт ли сейчас любой попап? =====
var isSwitchingPopup = false; // флаг: идёт ли замена попапа на другой

var isLegendShown = false; // ===== открыто описание легенды

// Leaflet
<?php if ( is_array($block["img"]) ): ?>
(function() {

	const topPadding = 200; // Пиксели «воздуха» сверху карты для попапов TODO: не работает

    const imageWidth = <?= $block["img"]["width"]; ?>;
    const imageHeight = <?= $block["img"]["height"]; ?>;
	const imageUrl = '<?= $block["img"]["url"]; ?>';
	
	let bounds = [
		[0, 0], // padding
		[imageHeight, imageWidth], // image dimensions
	];
	
	// Расширенные границы для maxBounds (с «воздухом» сверху)
	// В CRS.Simple: меньший Y = «север» (визуально верх), поэтому вычитаем padding из minY
	const extendedBounds = [
		[-topPadding, 0],              // [minY - padding, minX] - расширение вверх
		[imageHeight, imageWidth]      // [maxY, maxX] - без изменений
	];
	
	let startZoom = (isSmallScreen()) ? <?= $block["view"]["zoom"]["start_mobile"] ?> : <?= $block["view"]["zoom"]["start_desktop"] ?>;
	
	map = L.map("<?= $bUID; ?>_map", {
		crs: L.CRS.Simple,
		maxZoom: <?= $block["view"]["zoom"]["max"] ?>,
		minZoom: <?= $block["view"]["zoom"]["min"] ?>,
		zoomControl: false,
		doubleClickZoom: false, // Отключаем зум по двойному клику
		maxBounds: bounds,
		//maxBounds: extendedBounds,
	});
	
	// Добавить кнопки зума во встраевоемой версии. в full screen - не надо, там зум мышкой/пальцами
	<?php if ( $block["view"]["page"] == "box" ) : ?>
	new L.Control.Zoom({ position: 'topright' }).addTo(map);
	<?php endif; ?>

	L.imageOverlay(imageUrl, bounds).addTo(map);
	map.fitBounds(bounds, { 
		padding: [topPadding + 20, 50] // [vertical, horizontal] - сверху даём больше места
	});

	// Фокусировка краты
	let viewY = <?= round($block["view"]["fosus"]["y"]/100, 2) ?>;
	let viewX = <?= round($block["view"]["fosus"]["x"]/100, 2) ?>;
	map.setView([imageHeight*viewY, imageWidth*viewX], startZoom);

<?php if ( $block["view"]["page"] == "box" ) : ?>
	// ===== HORIZONTAL-ONLY DRAG  - только на мобилах и только если карта в боксе, а не фулскрин =====
	const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

	if (isMobile) {
		const mapContainer = map.getContainer();

		// 1. Отключаем встроенные взаимодействия Leaflet
		map.dragging.disable();
		map.touchZoom.disable();
		map.scrollWheelZoom.disable();
		map.doubleClickZoom.disable();
		map.boxZoom.disable();
		map.keyboard.disable();
		if (map.tap) map.tap.disable();

		// 2. Переменные состояния драга
		let dragState = null;

		function getEventPoint(e) {
			if (e.touches && e.touches[0]) {
				return { x: e.touches[0].clientX, y: e.touches[0].clientY };
			}
			return { x: e.clientX, y: e.clientY };
		}

		function onDragStart(e) {
			// Останавливаем любую текущую анимацию, чтобы не конфликтовала
			map._stop();
			
			const pt = getEventPoint(e);
			dragState = {
				startX: pt.x,
				startY: pt.y,
				lastX: pt.x,
				lastY: pt.y,
				decided: false,
				direction: null
			};
		}

		function onDragMove(e) {
			if (!dragState) return;
			
			const pt = getEventPoint(e);
			const dx = pt.x - dragState.lastX;
			const dy = pt.y - dragState.lastY;
			const totalX = pt.x - dragState.startX;
			const totalY = pt.y - dragState.startY;
			
			dragState.lastX = pt.x;
			dragState.lastY = pt.y;
			
			// Если направление ещё не определено — определяем
			if (!dragState.decided) {
				if (Math.abs(totalX) > 10 || Math.abs(totalY) > 10) {
					dragState.decided = true;
					
					// Если горизонтальное движение преобладает
					if (Math.abs(totalX) > Math.abs(totalY) * 1.5) {
						dragState.direction = 'horizontal';
						// Проверяем, можно ли отменить событие
						if (e.cancelable) {
							e.preventDefault();
						}
					} else {
						// Вертикальный свайп — отдаём управление странице
						dragState.direction = 'vertical';
						dragState = null;
						return;
					}
				} else {
					return;
				}
			}
			
			// Обрабатываем только горизонтальный драг
			if (dragState.direction === 'horizontal') {
				// Снова проверяем cancelable перед preventDefault
				if (e.cancelable) {
					e.preventDefault();
				}
				map.panBy([-dx, 0], { animate: false });
			}
		}

		function onDragEnd() {
			dragState = null;
		}

		// 3. Подвешиваем обработчики (touch + mouse для тестов на десктопе)
		mapContainer.addEventListener('touchstart', onDragStart, { passive: false });
		mapContainer.addEventListener('touchmove', onDragMove, { passive: false });
		mapContainer.addEventListener('touchend', onDragEnd);
		mapContainer.addEventListener('touchcancel', onDragEnd);

		mapContainer.addEventListener('mousedown', onDragStart);
		mapContainer.addEventListener('mousemove', onDragMove);
		mapContainer.addEventListener('mouseup', onDragEnd);
		mapContainer.addEventListener('mouseleave', onDragEnd);

		// Блокируем контекстное меню на карте
		mapContainer.addEventListener('contextmenu', e => e.preventDefault());
	}
<?php endif; ?>

	<?php
	if ($dev and is_file($bender_settings["stylesheet_dir"] . "/dev/geoman_js.php")) 
	{
		include $bender_settings["stylesheet_dir"] . "/dev/geoman_js.php";
	}
	?>
    
    // Функция получения цвета по статусу
    function getColor(status) {
        switch(status) {
            case 'sold': return '<?= $block["polygon_color"]["sold"] ?>';
            case 'reserved': return '<?= $block["polygon_color"]["reserved"] ?>';
            case 'available': return '<?= $block["polygon_color"]["available"] ?>';
            case 'not-available': return '<?= $block["polygon_color"]["not-available"] ?>';
            default: return '<?= $block["polygon_color"]["not-available"] ?>';
        }
    }
    
    // Функция получения текста статуса
    function getStatusText(status) {
        switch(status) {
            case 'sold': return '<?= $block["status_name"]["sold"] ?>';
            case 'reserved': return '<?= $block["status_name"]["reserved"] ?>';
            case 'available': return '<?= $block["status_name"]["available"] ?>';
            case 'not-available': return '<?= $block["status_name"]["not-available"] ?>';
            default: return 'Неизвестный статус';
        }
    }

	// шаблоны попав - подключем необходимые шаблоны
<?php
	function processPopupsRecursive($array, $template_dir, $bUID, $prefix = '')
	{
		//echo "console.log(<pre>" . $block["area_prefix"] . "</pre>);";
		//echo "console.log('$template_dir');";
		
		$result = [];
		$template_dir_real = realpath($template_dir);
		
		foreach ($array as $key => $value) {
			$newKey = $prefix ? $prefix . '_' . $key : $key;
			
			if (is_array($value)) {
				$result = array_merge($result, processPopupsRecursive($value, $template_dir, $bUID, $newKey));
			} elseif (is_string($value)) {
				$fileName = basename($value);
				$filePath = realpath($template_dir . "/blocks/incl/" . $fileName . ".js");
				
				// Проверка безопасности пути
				if ($filePath && 
					strpos($filePath, $template_dir_real) === 0 && 
					is_file($filePath)) {
					require_once($filePath);
				}
				
				$result[$newKey] = $value;
			}
		}
		
		return $result;
	}

	$popupsTypes = processPopupsRecursive($block["popups"] ?? [], $bender_settings["stylesheet_dir"], $bUID, '');
?>
   
    // Функция создания контента попапа Участка
    function createPopupContent(data, type) {
	
		const popupTemplates = <?php echo json_encode($popupsTypes, JSON_UNESCAPED_SLASHES); ?>;
		//console.log(popupTemplates['place_available']);
		
		let key = '';

		switch (type) {
			case 'place':
				let prefix = type == 'place' ? type + '_' : '';
				key = prefix + data.status;
				break;
			case 'order':
				key = type;
				break;
			case 'poi':
				key = type;
				break;
		}

		// Получаем имя функции из массива popupTemplates
		let functionName = popupTemplates[key];

		if (functionName && typeof window[functionName] === 'function') {
			// Динамически вызываем функцию по имени

			return window[functionName](data);
		}
		// Fallback, если функция не найдена
		console.warn(`Popup function not found: ${functionName} (key: ${key})`);
		return `Указанный шаблон поппа отсутвует.<br />Выберите существующий шаблон<br /><br />Template: ${functionName} (key: ${key})`;
		
    }

    // Массив для хранения участков
    const plots = [];
    
    // Функция добавления участка на карту
    function addPlot(data, type) {
        // Координаты:
        const coordsMap = data.coords.map(point => [
            (point[1]),                // X 
            (point[0])                 // Y
        ]);
        
        // Создаем многоугольник с белой рамкой 1px
        const polygon = L.polygon(coordsMap, {
            color: 'white',      // белая рамка
            weight: 1,           // толщина рамки 1px
            fillColor: getColor(data.status),
            //fillOpacity: 0.10
            fillOpacity: 1
        }).addTo(map);
        
<?php if ($dev): ?>
		// GEOMAN START
		// Режим редиктирования текущих полигонов - новые координаты пишутся в инпут poly_coords
		// Подписываем существующий полигон на события Geoman
		polygon.on('pm:edit', updateCoords);
		polygon.on('pm:remove', clearCoords);
		
		// (Опционально) Сохраняем координаты в data-атрибут слоя
		polygon._coords = getPolygonCoords(polygon);
		// GEOMAN END
<?php endif; ?>
	
		// ===== добавляем попап с toggle-логикой =====
		// Создаем попап, но не привязываем его стандартным bindPopup
		const popup = L.popup({
			offset: L.point(0, -10),
			closeButton: true,
			autoClose: false,      // отключаем автозакрытие, чтобы контролировать вручную
			closeOnClick: false,    // отключаем закрытие по клику на карте
	
		}).setContent(createPopupContent(data, type));

		polygon._customPopup = popup; // сохраняем ссылку на попап в слое

		// Обработчик клика с проверкой: если этот же попап уже открыт — закрываем
		polygon.on('click', function(e) {
			L.DomEvent.stopPropagation(e); // предотвращаем всплытие
			
			const mapContainer = document.getElementById('<?= $bUID; ?>_map');
			//const currentOpenPopup = mapContainer ? mapContainer._currentOpenPopup : null;
			
			// Если клик по тому же полигону, у которого попап уже открыт — закрываем
			if (mapContainer?._currentOpenPopup?.layer === this) {
				closeAnyOpenPopup();
				return;
			}

    		// Иначе — Закрываем ЛЮБОЙ другой открытый попап перед открытием нового
			closeAnyOpenPopup();

			// прячем мешающие элементы интерфейса
			isPopupOpen = true;
			setPopupElementsVisibility(true, elementsToHide); // Скрываем интерфейс с анимацией
					
			// Используем точку клика, если она есть, иначе — центр полигона
			const popupPosition = e?.latlng ? e.latlng : this.getBounds().getCenter();
			
			map.openPopup(this._customPopup, popupPosition);
			
			if (mapContainer) {
				mapContainer._currentOpenPopup = {
					popup: this._customPopup,
					layer: this
				};
			}

			// Init mini Gallery in Popup
			const containers = document.querySelectorAll(".genplan-area-carousel-class");
			containers.forEach((container, index) => {
				miniCarouselInit(container.id);

				// Явная инициализация Fancybox для динамически добавленных слайдов
				if (typeof Fancybox !== 'undefined') {
					Fancybox.bind(`#${container.id} [data-fancybox]`, {
						//Thumbs: false,          // Отключить миниатюры внизу (если не нужны)
						Carousel: { sync: false }, // Отключить синхронизацию с каруселью
						// autoFocus: false,     // Раскомментируйте, если есть конфликты с фокусом
					});
				}
			});

			// КАСТОМИЗАЦИЯ КЛИЕНТА: TODO вынести в админку
			// ===== ОБерег. Правка Кнопки "Позвони мне" В ПОПАПЕ КАРТЫ =====
			// Делегирование события для динамически созданных кнопок внутри попапов Leaflet
			document.addEventListener('click', function(e) {
				// Проверяем, что клик был по кнопке с триггером модалки внутри попапа карты
				if (e.target.closest('.leaflet-popup-content button[data-micromodal-trigger="modal-callback"]')) {
					e.preventDefault();
					e.stopPropagation();
					
					// Проверяем, подключена ли библиотека MicroModal
					if (typeof MicroModal !== 'undefined') {
						MicroModal.show('modal-callback');
					} else {
						console.warn('MicroModal не найден');
					}
				}
			});
			// КАСТОМИЗАЦИЯ КЛИЕНТА: END

		});

		/*
		popup.on('close', function() {
			
			// возвращаем спрятанные элементы интерфейса
			setPopupElementsZIndex('restore', true); // true = с анимацией
			//console.log('popUp closed');
			
			const mapContainer = document.getElementById('<?= $bUID; ?>_map');
			if (mapContainer && mapContainer._currentOpenPopup?.popup === this) {
				mapContainer._currentOpenPopup = null;
			}
		});
		*/

		//Используем 'remove' вместо 'close' — т.к. close не срабатывает гарантированно
		popup.on('remove', function() {

			const mapContainer = document.getElementById('<?= $bUID; ?>_map');

			isLegendShown = false;
			setPopupElementsVisibility(true, elementsToHide);
			
			// Проверяем: может, это был переход на другой попап?
			// Если _currentOpenPopup указывает на другой слой — не восстанавливаем интерфейс
			if (!mapContainer?._currentOpenPopup || mapContainer._currentOpenPopup.popup === this) {
				// Попап действительно закрыт (не заменён другим)
				isPopupOpen = false;
				setPopupElementsVisibility(true, elementsToHide);
			}
			
			if (mapContainer && mapContainer._currentOpenPopup?.popup === this) {
				mapContainer._currentOpenPopup = null;
			}
		});

		
        // Сохраняем участок
        plots.push({
            id: data.ID,
            layer: polygon,
			type: type,
            status: data.status,
            data: data
        });
    }

	// ===== ОБРАБОТЧИК КЛИКА ПО ПУСТОЙ ОБЛАСТИ КАРТЫ =====
	map.on('click', function(e) {
		// Проверяем, был ли клик по слою (полигону, маркеру и т.д.)
		
		// Если клик был по слою — ничего не делаем (обработчик полигона сам разберётся)
		if (e.layer) {
			return;
		}
		
		// Если клик по пустой области карты — закрываем открытый попап
		closeAnyOpenPopup();
	});
    
    // ДАННЫЕ ОБ УЧАСТКАХ / очередях
	const plotData = <?= json_encode($genplan_areas, true); ?>;
	const plotDataOrders = <?= json_encode($genplan_orders, true); ?>;
	
    // Добавляем все участки на карту
<?php if ( is_array($genplan_areas) ) : ?>
    plotData.forEach(plot => {
        if (plot.coords && plot.coords.length > 0) {
            addPlot(plot, 'place');
        }
    });
<?php endif; ?>

	// Добавляем все очереди на карту
<?php if ( is_array($genplan_orders) ) : ?>
    plotDataOrders.forEach(plot => {
        if (plot.coords && plot.coords.length > 0) {
            addPlot(plot, 'order');
        }
    });
<?php endif; ?>
    
    // ====================================
    // ===== ФИЛЬТРАЦИЯ ЧЕРЕЗ ЛЕГЕНДУ =====
    // ====================================
    // Изначальное состояние фильтров
    const filterState = {
	    'available': <?= ($block["status_filter_state"]["available"] == "on") ? "true" : "false" ?>,
        'reserved': <?= ($block["status_filter_state"]["reserved"] == "on") ? "true" : "false" ?>,
        'sold': <?= ($block["status_filter_state"]["sold"] == "on") ? "true" : "false" ?>,
        'not-available': <?= ($block["status_filter_state"]["not-available"] == "on") ? "true" : "false" ?>
    };
	// синхронизация визуального состояния фильтров при загрузке
	document.querySelectorAll('#<?= $bUID; ?> .legend-item').forEach(item => {
		const status = item.getAttribute('data-status');
		if (!filterState[status]) {
			item.classList.remove('active');
			item.classList.add('disabled');
		}
	});	


	// Функция обновления видимости слоя по фильтру
	function updateLayerVisibility(plot) {
		const status = plot.status;
		//const shouldBeVisible2 = filterState[status] && 
		//	!(plot.type === 'order' && status === 'not-available' && !filterState['not-available']);
		const shouldBeVisible = (filterState[status]) || (plot.type === 'order' && filterState['not-available']);
		
		if (shouldBeVisible) {
			if (!map.hasLayer(plot.layer)) {
				plot.layer.addTo(map);
			}
		} else {
			if (map.hasLayer(plot.layer)) {
				map.removeLayer(plot.layer);
			}
		}
	}
	
    // Обработчик клика по элементу легенды
    document.querySelectorAll('#<?= $bUID; ?> .legend-item').forEach(item => {
        item.addEventListener('click', function() {
            const status = this.getAttribute('data-status');
            
            // Инвертируем состояние фильтра
            filterState[status] = !filterState[status];
            
            // Обновляем визуальное состояние элемента легенды
            if (filterState[status]) {
                this.classList.add('active');
                this.classList.remove('disabled');
            } else {
                this.classList.remove('active');
                this.classList.add('disabled');
            }
            
            // Обновляем видимость участков
            plots.forEach(plot => {
				const shouldFilter = (plot.status === status) || 
                        (plot.type === 'order' && status === 'not-available');
						
				if (shouldFilter) {
					updateLayerVisibility(plot);
				}
            });
        });
    });
	// После загрузки всех данных применяем фильтр из легенды
	plots.forEach(updateLayerVisibility);
	
    // Отключаем zoom колесом мыши
	<?php if ($block["view"]["mousewheel"] == "scroll" ): ?>
    map.scrollWheelZoom.disable();
	<?php endif; ?>

	// ===== УНИВЕРСАЛЬНОЕ ЗАКРЫТИЕ ЛЮБОГО ПОПАПА =====
	function closeAnyOpenPopup() {
		const mapContainer = document.getElementById('<?= $bUID; ?>_map');
		
		// 1. Закрываем кастомный попап (от полигона/очереди)
		if (mapContainer && mapContainer._currentOpenPopup) {
			// Помечаем, что закрытие программное (для переключения)
			mapContainer._currentOpenPopup.popup._closingForSwitch = true;
			map.closePopup(mapContainer._currentOpenPopup.popup);
			mapContainer._currentOpenPopup = null;
		}
		
		// 2. Закрываем стандартный попап (от маркера), если он открыт
		if (map._popup) {
			map._popup._closingForSwitch = true;
			map.closePopup();
		}
	}

	// ===== ДОБАВЛЕНИЕ ИКОНОК ИНФРАСТРУКТУРЫ =====
<?php if ( is_array($genplan_poi) ) : ?>

	const infrastructureIcons = <?= json_encode($genplan_poi, true); ?>

		// Функция добавления иконки
		function addInfrastructureIcon(iconData) {
			// Берём первую букву названия (кириллица или латиница)
			const firstChar = 'A';
			const ico = iconData.ico;
			
			// Создаём кастомную иконку-кружок
			const icon = L.divIcon({
				className: 'infrastructure-marker',
				html: `<img style="width:clamp(32px, 3vw, 50px); border-radius: clamp(5px, 3vw, 10px); box-shadow: 0 3px 8px rgba(0,0,0,0.3);" src="${ico}" />`,
				iconSize: [32, 32],
				iconAnchor: [16, 16],
				popupAnchor: [0, -16]
			});
			
			// Создаём маркер с попапом
			const marker = L.marker(iconData.coords[0], { icon: icon }).addTo(map);

			// Создаём кастомный попап для маркера (как у полигонов)
			const markerPopup = L.popup({
				offset: L.point(0, -10),
				closeButton: true,
				autoClose: false,
				closeOnClick: false,
			}).setContent(createPopupContent(iconData, 'poi'));

			marker._customPopup = markerPopup;

			marker.on('click', function(e) {
				L.DomEvent.stopPropagation(e);
				
				const mapContainer = document.getElementById('<?= $bUID; ?>_map');
				
				// Если клик по тому же маркеру — закрываем попап
				if (mapContainer?._currentOpenPopup?.layer === this) {
					closeAnyOpenPopup();
					return;
				}
				
				// Закрываем любой другой открытый попап
				closeAnyOpenPopup();
				
				isPopupOpen = true;
				setPopupElementsVisibility(true, elementsToHide);
				
				const popupPosition = e?.latlng ? e.latlng : this.getLatLng();
				
				map.openPopup(markerPopup, popupPosition);
				
				if (mapContainer) {
					mapContainer._currentOpenPopup = {
						popup: markerPopup,
						layer: this
					};
				}
			});

			// Обработчик закрытия (удаления) попапа
			markerPopup.on('remove', function() {
				const mapContainer = document.getElementById('<?= $bUID; ?>_map');
				
				if (!mapContainer?._currentOpenPopup || mapContainer._currentOpenPopup.popup === this) {
					isPopupOpen = false;
					setPopupElementsVisibility(true, elementsToHide);
				}
				
				if (mapContainer && mapContainer._currentOpenPopup?.popup === this) {
					mapContainer._currentOpenPopup = null;
				}
			});

			// ===== Инициализация карусели после открытия попапа =====
			marker.on('popupopen', function() {
				const containers = document.querySelectorAll(".genplan-poi-carousel-class");
				containers.forEach((container) => {
					if (container.id) {
						miniCarouselInit(container.id);
					}
				});
			});

			<?php if ( $dev ): ?>
			// DEV GEOMAN START
			// === Подписываем существующие маркеры на события Geoman ===
			marker.on('pm:edit', updateMarkerCoords);
			marker.on('pm:remove', clearCoords);
			marker._coords = getMarkerCoords(marker);
			
			// === Выводим координаты при клике на маркер ===
			marker.on('click', function() {
				polyCoordsInput.value = getMarkerCoords(this);
			});
			// DEV GEOMAN END
			<?php endif; ?>

			return marker;
		}

		// Добавляем все иконки на карту
		infrastructureIcons.forEach(icon => {
			addInfrastructureIcon(icon);
		});
<?php endif; ?>
})();
<?php else: ?>
// No data in array $block[img]. Leaflet function removed
console.warn(`No data in array $block[img]. Leaflet function removed.`);
<?php endif; ?>


	// ===== УПРАВЛЕНИЕ видимостью элементов ПРИ ОТКРЫТИИ ПОПАПА =====
	const elementsToHide = []; // Массив элементов скрываемых при открытии попата на низких разрешениях
	const elementsToHideAlways = []; // Массив элементов скрываемых при открытии попата всегда
	
	// Инициализация: сохраняем, был ли z-index задан инлайн или в CSS
	// Применить z-index: -1 или восстановить исходный
	function initPopupZIndexManager(selectorList) {
		selectorList.forEach(selector => {
			//console.log(selector)
			const el = document.querySelector(selector);
			if (el) {
				//const inlineZ = el.style.zIndex;
				elementsToHide.push({
					element: el,
					//originalZ: inlineZ && inlineZ !== '' ? inlineZ : null
				});
				//console.log(selector);
			}
		});
	}

	function initPopupZIndexManagerOLD(selectorList) {
		selectorList.forEach(selector => {
			//console.log(selector)
			const el = document.querySelector(selector);
			if (el) {
				const inlineZ = el.style.zIndex;
				elementsToHide.push({
					element: el,
					originalZ: inlineZ && inlineZ !== '' ? inlineZ : null
				});
				//console.log(selector);
			}
		});
	}
	
	// Плавное скрытие/показ элементов с учётом глобального состояния
	function setPopupElementsVisibility(animate = true, elementsToHideArr) {
		//console.log(elementsToHideArr);
		elementsToHideArr.forEach(item => {
			const el = item.element;
			
			if (isPopupOpen || isLegendShown) {
				// ПОПАП ОТКРЫТ: скрываем элементы через класс
				if (animate) {
					// Небольшая задержка для плавного перехода
					requestAnimationFrame(() => {
						el.classList.add('ui-element--popup-open');
					});
				} else {
					el.classList.add('ui-element--popup-open');
				}
			} else {
				// ПОПАП ЗАКРЫТ: показываем элементы
				if (animate) {
					requestAnimationFrame(() => {
						el.classList.remove('ui-element--popup-open');
					});
				} else {
					el.classList.remove('ui-element--popup-open');
				}
			}
		});
	}
	
	// Инициализируем список скрываемых элементов TODO вынести в админку
	initPopupZIndexManager([
		'#<?= $bUID; ?> .info-panel',      // Основная инфопанель
		'.legend',          // Легенда 
		'.back-btn',         // Кнопка "Назад"
		'.leaflet-right',	// zoom карты
		'.logo',		// лого сайта
		'.header' // да и весь хидер
		
	]);

// ===== УПРАВЛЕНИЕ ИНФО-ПАНЕЛЬЮ (СВОРАЧИВАНИЕ) =====
const infoPanel = document.querySelector('#<?= $bUID; ?> .info-panel');
if (infoPanel) {
    const header = infoPanel.querySelector('h3');
    
    // Функция проверки размера экрана
    function checkScreenSize() {
        if (window.innerWidth <= 1000) {
            // На мобильном сворачиваем
            infoPanel.classList.add('collapsed');
        } else {
            // На десктопе разворачиваем
            infoPanel.classList.remove('collapsed');
        }
    }

    // Клик по заголовку переключает класс
    header.addEventListener('click', function() {
        infoPanel.classList.toggle('collapsed');
    });

    // Слушаем изменение размера окна
    window.addEventListener('resize', checkScreenSize);
    
    // Инициализация при загрузке - вызываем функцию сразу
    checkScreenSize();
}

function miniCarouselInit(id){
	Carousel(
		document.getElementById(id),
		{
		// Your custom options
		},
		{
			Lazyload,
			Arrows,
			Dots
		}
		).init();
}

// IPhone bottom panel fix


function isIOS() {
    return (
        //typeof window.orientation !== "undefined" || 
        //navigator.userAgent.indexOf('IEMobile') !== -1 ||
        /iPhone|iPad|iPod/i.test(navigator.userAgent)
    );
}


if ( isIOS() ) {
	const legend = document.querySelector('#<?= $bUID; ?> .legend');
	if (legend && !legend.classList.contains('ios-bottom')) {
		legend.classList.add('ios-bottom');
	}	
}

// ===== ПЛАВНОЕ ПОЯВЛЕНИЕ legend-text В ios-legend =====
//setPopupElementsVisibility(true, elementsToHide);

	const elementsToHideLegend = []; // Массив элементов скрываемых при открытии попата на низких разрешениях

	function initPopupManagerLegend(selectorList) {
		selectorList.forEach(selector => {
			//console.log(selector)
			const el = document.querySelector(selector);
			if (el) {
				//const inlineZ = el.style.zIndex;
				elementsToHideLegend.push({
					element: el,
					//originalZ: inlineZ && inlineZ !== '' ? inlineZ : null
				});
				//console.log(selector);
			}
		});
	}	// Инициализируем список скрываемых элементов TODO вынести в админку
	initPopupManagerLegend([
		'#<?= $bUID; ?> .info-panel'      // Основная инфопанель
	]);
	
(function() {
    const iosLegend = document.querySelector('#<?= $bUID; ?> .ios-legend');
    if (!iosLegend) return;

    const legendTexts = iosLegend.querySelectorAll('.legend-text');
    let hideTimeout = null;
    let clickTimeout = null;

    // Функция показа всех текстов
    function showLegendTexts(duration) {
        // Очистить предыдущие таймауты
        if (hideTimeout) clearTimeout(hideTimeout);
        if (clickTimeout) clearTimeout(clickTimeout);

		isLegendShown = true;
        setPopupElementsVisibility(true, elementsToHideLegend);
		// Показать тексты с плавным переходом
		legendTexts.forEach(text => {
            text.classList.add('legend-text--visible');
        });

        // Скрыть через указанное время
        const timeout = duration || 5000; // по умолчанию 8 секунд
        hideTimeout = setTimeout(() => {
			isLegendShown = false;
			setPopupElementsVisibility(true, elementsToHideLegend);
            legendTexts.forEach(text => {
                text.classList.remove('legend-text--visible');
            });
        }, timeout);
    }

    // 1. При загрузке страницы: показать на 5-10 секунд
    document.addEventListener('DOMContentLoaded', () => {
        // Небольшая задержка, чтобы стили применились
        setTimeout(() => {
            showLegendTexts(5000); // 8 секунд — можно изменить на 5000 или 10000
        }, 300);
    });

    // 2. При клике на фильтр: показать на 1-2 секунды
    iosLegend.querySelectorAll('.legend-item').forEach(item => {
        item.addEventListener('click', function() {
            // Показать текст на короткое время
            showLegendTexts(1500); // 1.5 секунды — можно изменить
        });
    });

    // Опционально: скрыть тексты при скролле или тапе вне легенды
    document.addEventListener('touchstart', function(e) {
        if (!iosLegend.contains(e.target)) {
            if (hideTimeout) clearTimeout(hideTimeout);
            legendTexts.forEach(text => {
                text.classList.remove('legend-text--visible');
            });
        }
    }, { passive: true });

})();


/*
function applyIOSBottomFix() {
    if (isIOS()) {
        const legend = document.querySelector('#<?= $bUID; ?> .legend');
        if (legend && !legend.classList.contains('ios-bottom')) {
            legend.classList.add('ios-bottom');
        }
    }
}

// Вызываем после загрузки DOM и инициализации карты
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', applyIOSBottomFix);
} else {
    applyIOSBottomFix();
}

// Перепроверка при изменении ориентации (на всякий случай)
window.addEventListener('orientationchange', applyIOSBottomFix);
*/

/*
function adjustLegendForIOS() {
    if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
        const legend = document.querySelector('#<?= $bUID; ?> .legend');
        if (!legend) return;
        
        // Примерная высота нижней панели Safari
        const safariBottomBar = window.innerHeight > window.screen.availHeight ? 90 : 0;
        const safeAreaBottom = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--sab')) || 0;
        
        legend.style.bottom = `calc(${legend.style.bottom || '20px'} + ${safariBottomBar}px)`;
    }
}

// Вызов после загрузки
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', adjustLegendForIOS);
} else {
    adjustLegendForIOS();
}

// И при изменении ориентации
window.addEventListener('orientationchange', adjustLegendForIOS);

*/
</script>
<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- END -->
<?php //if ( $dev ) { echo "<pre>block\n"; var_dump($block); echo "</pre>"; } ?>
<?php //if ( $dev ) { echo "<pre>genplan_orders\n"; var_dump($genplan_orders); echo "</pre>"; } ?>

<?php
if ( $dev ) 
{ 
echo '<div style="position:absolute; width: 500px; height 500px; z-index:10000;top: 200px;
    left: 200px;
    background: brown;
    color: black;">';
echo do_shortcode('[contact-form-7 id="ebda539" title="Тест"]');
echo '</div>';
} ?>



