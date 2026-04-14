<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- START -->
<?php
//echo "<pre>block\n"; var_dump($block); echo "</pre>";

$dev = ($_SERVER['SERVER_NAME'] == "kfs-dev") ? TRUE : FALSE;
$dev = FALSE;
//$dev = TRUE;
$template_dir = get_stylesheet_directory();

//echo "<pre>"; var_dump($template_dir); echo "</pre>";

/*
if ( is_array($block["coords"]) )
{
	$block["coords"] = convert_coords($block["coords"]);
}
else
{
	$block["coords"] = convert_coords(get_field('coords'));
}
*/
//echo "<pre>coords\n"; var_dump($coords); echo "</pre>";

//$genplan_areas = convertToLeafletArray($bender_settings["genplan"]["area"]);
$genplan_areas = convertToLeafletArrayPlace($block["areas"], $block["coords"]["place"], $block["coords"]["shift"]);
$genplan_poi = convertToLeafletArrayPOI($block["poi"], $block["coords"]["poi"], $block["coords"]["shift"]);
$genplan_orders = convertToLeafletArrayOrders($block["orders"], $block["coords"]["orders"], $block["coords"]["shift"]);

//$genplan_areas = convertToLeafletArrayPlace2($block["areas"], $block["view"]["shift"]);


//echo "<pre>genplan_areas\n"; var_dump($genplan_areas); echo "</pre>";
//echo "<pre>bender_settings[genplan][area]\n"; var_dump($bender_settings["genplan"]["area"]); echo "</pre>";

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
	& .content { height: 80vh; position: relative; max-height: 100vw;}
    
	/* Элементы управления */
	& .legend, 
		& .info-panel { position: absolute !important; z-index: 900 !important; backdrop-filter: blur(5px); border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); padding: clamp(2px, 1vw, 10px); border: 1px solid #e0e0e0; pointer-events: auto; background-color: <?= setAlpha($bender_settings["colors"]["site"]["bg"], 0.5) ?>; margin-left: 45px; }

	& .legend { bottom: clamp(2px, 1.5vw, 20px); right: clamp(2px, 5vw, 20px); line-height: 14px; font-weight: 500; cursor: default; display: flex; gap: clamp(5px, 2vw, 20px); flex-wrap: wrap; }

	/* нфопанель */
    & .info-panel.collapsed > ul { display: none; }
	& .info-panel { top: clamp(2px, 1.5vw, 20px); right: clamp(2px, 2vw, 20px); transition: all 0.3s ease; overflow: hidden;}
	& .info-panel h3 { font-size: clamp(14px, 4.5vw, 25px);; margin: 0; cursor: pointer; position: relative; padding-right: 25px; user-select: none; }
    /* Стрелка-индикатор */
    & .info-panel h3::after { content: ''; position: absolute; right: 5px; top: 50%; width: 8px; height: 8px; border-right: 2px solid <?= $title_color ?>; border-bottom: 2px solid <?= $title_color ?>; transform: translateY(-50%) rotate(45deg); transition: transform 0.3s; }
	/* Поворот стрелки при сворачивании */
    & .info-panel.collapsed h3::after { transform: translateY(-50%) rotate(-45deg); }
	& .info-panel > ul { margin: 5px 0 0 0;}
	& .info-panel > ul > li { font-size: clamp(11px, 3.3vw, 18px); line-height: normal; }
	& .info-panel > ul > li::marker { content:"— ";}


	/* Стили легенды с фильтрацией */
	& .legend-item { display: flex; align-items: center; padding: 4px 8px; border-radius: 4px; cursor: pointer; transition: all 0.3s; flex: 1 1 0; min-width: clamp(150px, 11vw, 200px); }

	& .legend-item:hover { background: <?= $bender_settings["colors"]["site"]["bg"] ?>; }
	& .legend-item.disabled .legend-color { opacity: 0.3; /* filter: grayscale(100%); */ }
	& .legend-item.disabled .legend-text { text-decoration: line-through; opacity: 0.5; color: #7f8c8d; }
	& .legend-color { width: clamp(14px, 5vw, 24px); height: clamp(14px, 5vw, 24px); border-radius: 4px; margin-right: 10px; border: 1px solid white; display: inline-block; flex-shrink: 0; transition: all 0.2s; }

	& .legend-color.sold { background-color: <?= $block["label_color"]["sold"] ?>; }
	& .legend-color.reserved { background-color: <?= $block["label_color"]["reserved"] ?>; }
	& .legend-color.available { background-color: <?= $block["label_color"]["available"] ?>; }
	& .legend-color.not-available { background-color: <?= $block["label_color"]["not-available"] ?>; }

	& .legend-text { font-weight: 500; transition: all 0.2s; font-size: clamp(12px, 2vw, 18px); }


	/* Стили попапов */
	& .leaflet-popup-content {
	margin-top: clamp(5px, 3vw, 13px);
    margin-right: clamp(5px, 3vw, 24px);
    margin-bottom: clamp(5px, 3vw, 13px);
    margin-left: clamp(5px, 3vw, 24px);
	width: max-content !important;
	}

	& .popup-content, 
		& .popup-poi-content { display: flex; gap: clamp(8px, 5vw, 15px); flex-direction: column; width: clamp(200px, 80vw, 350px);}
	& .popup-content-short { width: max-content; }
	& .popup-title { display: flex; justify-content: space-between; }
	& .popup-title-short { margin: 0;}
	& .popup-title > h3,
		& .popup-poi-title > h3 { margin:0; padding:0; color: #2c3e50; font-size: 1.3rem; }

	& .popup-content .status { display: inline-block; padding: 3px 8px; border-radius: 12px; font-size: 0.85rem; font-weight: 500; /* margin-bottom: 8px; */ }
	& .popup-content .status.sold { background-color: <?= $block["label_color"]["sold"] ?>; color: <?= $block["label_color_text"]["sold"] ?>; }
	& .popup-content .status.reserved { background-color: <?= $block["label_color"]["reserved"] ?>; color: <?= $block["label_color_text"]["reserved"] ?>; }
	& .popup-content .status.available { background-color: <?= $block["label_color"]["available"] ?>; color: <?= $block["label_color_text"]["available"] ?>; }
	& .popup-content .status.not-available { background-color: <?= $block["label_color"]["not-available"] ?>; color: <?= $block["label_color_text"]["not-available"] ?>; }

	& .popup-content .desc { color: #278b25; font-style: italic; display: block; text-align: right; }

	& .popup-content .project-link,
	& .popup-content .interior-link { /* display: inline-block; /* margin-top: 5px; */ color: #3498db; text-decoration: none; font-weight: 500; }

	& .popup-content .project-link:hover,
		& .popup-content .interior-link:hover { text-decoration: underline; }
		
	& .popup-status { display: flex; justify-content: space-between; gap: 10px; align-items: center; height: 18px;}
	& .popup-prop { display: flex; flex-direction: column; gap: 3px; }
	& .popup-content .label {font-weight:bold;}
	& .popup-content .value { margin-left: 5px; font-weight: normal; }

	& .popup-img,
		& .popup-poi-img { position: relative; height: clamp(150px, 22vw, 200px); background-size: cover !important; background-position: center !important; }
	& .popup-content .img-fade { position: absolute; width:100%; height:100% }
	& .popup-content .img-label { position: absolute; bottom: 5px; left: 15px; color: white; font-size: 26px;}

	/* Popup POI */
	& .popup-poi-content { width: fit-content; }
	& .popup-poi-title {}
	& .popup-poi-desc {}
	& .popup-poi-img { width: clamp(150px, 80vw, 250px); }


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
}

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
	width: 100vw; position: relative; margin:0; top: 100px; height: calc(100vh - 100px);
	& .title, & .content { padding: 0; }
	& .title { position: absolute; top: 0; margin-left:clamp(10px, 5vw, 50px); z-index: 500;}
	& .title > h2 { margin: 0;}
	& .content { height: 100%; }
	& .info-panel { top: 100px; }
	& .legend { bottom: clamp(2px, 1.5vw, 20px); left: clamp(2px, 5vw, 20px); right: unset; margin-right: 100px;}
	& .map-bg { background: none; }

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
#footer { display: none; }
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
}
@media (max-width: 500px) {
    #<?= $bUID; ?> {
        width: 100vw;
		& .legend { left: clamp(1px, 0.5vw, 20px); margin-right: 100px; gap: clamp(1px, 0.2vw, 20px);}
		
    }
}
@media (max-width: 300px) {
    #<?= $bUID; ?> {
		& .legend-item {
			min-width: 150px;
		}
    }
}



/* Положение кнопок зума карты TODO. сделать как вариант навигации */
/* .leaflet-right { right: 10px; top: 50%; transform: translateY(-50%) !important; } */
.leaflet-right { right: 10px; top: 20px; }


</style>

<div id="<?= $bUID; ?>" class="wide" style="<?= $block["bg_style"] ?>" >
	<div class="fade">
		<div class="title">
			<h2 class="wow fadeInDown slower" data-wow-offset="0"><?= $block['title'] ?></h2>
			<p class="text"><?= $block['text'] ?></p>
		</div>
		<div class="content">
			<div id="<?= $bUID; ?>_map" class="map-bg bg-container"></div>
			<!-- Легенда с фильтрацией (заменяет панель управления) -->
			<div class="legend">
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
				<div class="legend-item active" data-status="not-available">
					<span class="legend-color not-available"></span>
					<span class="legend-text"><?= $block["status_name"]["not-available"] ?></span>
				</div>
			</div>
			<!-- Информационная панель -->
			<!--div class="info-panel">
				<h3>В стоимость домовладения входят:</h3>
				<ul>
					<li>Земельный участок от 17 соток</li>
					<li>Строительство дома</li>
					<li>Полный пакет коммуникаций</li>
					<li>Благоустройство территории</li>
				</ul>
			</div-->
		</div>
	</div>
</div>

<?php
if ($dev and is_file($template_dir . "/dev/geoman_ui.php")) 
{
	include $template_dir . "/dev/geoman_ui.php";
}
?>

<script>
// Объявляем map в глобальной области видимости
var map = null;

// Leaflet
<?php if ( is_array($block["img"]) ): ?>
(function() {

    const imageWidth = <?= $block["img"]["width"]; ?>;
    const imageHeight = <?= $block["img"]["height"]; ?>;
	const imageUrl = '<?= $block["img"]["url"]; ?>';
	
	let bounds = [
		[0, 0], // padding
		[imageHeight, imageWidth], // image dimensions
	];
	
	let startZoom = (isSmallScreen()) ? <?= $block["view"]["zoom"]["start_mobile"] ?> : <?= $block["view"]["zoom"]["start_desktop"] ?>;
	
	map = L.map("<?= $bUID; ?>_map", {
		crs: L.CRS.Simple,
		maxZoom: <?= $block["view"]["zoom"]["max"] ?>,
		minZoom: <?= $block["view"]["zoom"]["min"] ?>,
		// zoom: 5, // в сет вью устанавливается
		//dragging: false,  // вместо драга добавим Кнопки прокрутки карты
		zoomControl: false,
		doubleClickZoom: false, // Отключаем зум по двойному клику
		maxBounds: bounds,
	});
	
	new L.Control.Zoom({ position: 'topright' }).addTo(map);

	L.imageOverlay(imageUrl, bounds).addTo(map);
	map.fitBounds(bounds);

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

/*
// Вроже тоже рабочий вариант

// Только ПОСЛЕ установки view вешаем обработчики
let startY; // В CRS.Simple "широта" — это Y (первая координата)

map.on('move', function() {
    var center = map.getCenter();
    
    // Защита: если центр ещё не валиден — пропускаем
    if (!center || center.lat === undefined || startY === undefined) {
        return;
    }
    
    // В CRS.Simple: lat = Y, lng = X. Блокируем изменение Y.
    // Используем допуск, чтобы избежать дребезга из-за float-погрешностей
    if (Math.abs(center.lat - startY) > 0.001) {
        map.panTo([startY, center.lng], { animate: false, noMoveStart: true });
    }
});

// Инициализируем startY после того, как карта точно готова
map.once('load', function() {
    var center = map.getCenter();
    if (center) {
        startY = center.lat;
    }
});

// На всякий случай обновляем startY при зуме (чтобы не "срывало" позицию)
map.on('zoomend', function() {
    var center = map.getCenter();
    if (center) {
        startY = center.lat;
    }
});
*/
//=======================


	<?php
	if ($dev and is_file($template_dir . "/dev/geoman_js.php")) 
	{
		include $template_dir . "/dev/geoman_js.php";
	}
	?>
    
    // Функция получения цвета по статусу
    function getColor(status) {
        switch(status) {
            //case 'sold': return '#e74c3c';
            //case 'booked': return '#f39c12';
            //case 'available': return '#2ecc71';
            //case 'not-available': return '#95a5a6';
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
	function processPopupsRecursive($array, $template_dir, $prefix = '')
	{
		$result = [];
		$template_dir_real = realpath($template_dir);
		
		foreach ($array as $key => $value) {
			$newKey = $prefix ? $prefix . '_' . $key : $key;
			
			if (is_array($value)) {
				$result = array_merge($result, processPopupsRecursive($value, $template_dir, $newKey));
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

	$popupsTypes = processPopupsRecursive($block["popups"] ?? [], $template_dir);
	
	//echo "<pre>popupsTypes\n"; var_dump($popupsTypes); echo "</pre>";
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
        // Преобразуем координаты: инвертируем Y
        const coordsMap = data.coords.map(point => [
            //(imageHeight - point[1]), // Инверсия Y. И поправки по координатам т.к. исходные в другом масштабе
            (point[1]),                // X без изменений. И поправки по координатам т.к. исходные в другом масштабе
            (point[0])                 // Инверсия Y. И поправки по координатам т.к. исходные в другом масштабе
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
			autoClose: false,      // Важно: отключаем автозакрытие, чтобы контролировать вручную
			closeOnClick: false    // Важно: отключаем закрытие по клику на карте
		}).setContent(createPopupContent(data, type));

		polygon._customPopup = popup; // сохраняем ссылку на попап в слое

		// Обработчик клика с проверкой: если этот же попап уже открыт — закрываем
		polygon.on('click', function(e) {
			L.DomEvent.stopPropagation(e); // предотвращаем всплытие
			
			const mapContainer = document.getElementById('<?= $bUID; ?>_map');
			const currentOpenPopup = mapContainer ? mapContainer._currentOpenPopup : null;
			
			// Если клик по тому же полигону, у которого попап уже открыт — закрываем
			if (currentOpenPopup && currentOpenPopup.layer === this) {
				map.closePopup(currentOpenPopup.popup);
				mapContainer._currentOpenPopup = null;
				return;
			}
			
			// Иначе — закрываем любой другой открытый попап и открываем новый
			if (currentOpenPopup) {
				map.closePopup(currentOpenPopup.popup);
			}
			
			// Используем точку клика, если она есть, иначе — центр полигона
			const popupPosition = e?.latlng ? e.latlng : this.getBounds().getCenter();
			
			map.openPopup(this._customPopup, popupPosition);
			mapContainer._currentOpenPopup = {
				popup: this._customPopup,
				layer: this
			};
		});

		// Очищаем ссылку при закрытии попапа (крестик, клик вне, ESC)
		popup.on('close', function() {
			const mapContainer = document.getElementById('<?= $bUID; ?>_map');
			if (mapContainer && mapContainer._currentOpenPopup?.popup === this) {
				mapContainer._currentOpenPopup = null;
			}
		});
		
		
		/*
		// ===== ДИНАМИЧЕСКОЕ НАПРАВЛЕНИЕ ПОПАПА =====
		// Сохраняем данные для использования в обработчиках
		polygon.options.data = data;
		
		// Обработчик клика для определения позиции
		polygon.on('click', function(e) {
			// Сохраняем информацию о позиции клика относительно контейнера карты
			const point = map.latLngToContainerPoint(e.latlng);
			const mapHeight = map.getSize().y;
			
			// Запоминаем, был ли клик в верхней половине экрана
			this._isClickInTopHalf = point.y < (mapHeight / 2);
		});

		// Корректировка направления попапа при открытии
		polygon.on('popupopen', function(e) {
			const popup = e.popup;
			
			// Если клик был в верхней половине экрана, открываем попап вниз
			if (this._isClickInTopHalf) {
				popup.options.direction = 'bottom';
				popup.setOffset(L.point(0, 40)); // Смещение вниз
			} else {
				// Для нижней части экрана оставляем стандартное направление
				popup.options.direction = 'top';
				popup.setOffset(L.point(0, -40)); // Стандартное смещение вверх
			}
			
			// Принудительно обновляем позицию попапа
			popup._updatePosition();
		});
		// ===== КОНЕЦ ДОБАВЛЕННОГО КОДА =====
		*/
		/*
		popup.options.direction = 'bottom';
		popup.setOffset(L.point(0, 40)); // Смещение вниз
        // Принудительно обновляем позицию попапа
        popup._updatePosition();
		*/
        
        // Сохраняем участок
        plots.push({
            id: data.ID,
            layer: polygon,
            status: data.status,
            data: data
        });
    }

	// ===== ОБРАБОТЧИК КЛИКА ПО ПУСТОЙ ОБЛАСТИ КАРТЫ =====
	map.on('click', function(e) {
		// Проверяем, был ли клик по слою (полигону, маркеру и т.д.)
		// Если e.originalEvent.target — это контейнер карты или его потомок, но не слой Leaflet
		const clickedLayer = e.layer; // Leaflet автоматически добавляет слой в событие, если клик был по нему
		
		// Если клик был по слою — ничего не делаем (обработчик полигона сам разберётся)
		if (clickedLayer) {
			return;
		}
		
		// Если клик по пустой области карты — закрываем открытый попап
		const mapContainer = document.getElementById('<?= $bUID; ?>_map');
		if (mapContainer && mapContainer._currentOpenPopup) {
			map.closePopup(mapContainer._currentOpenPopup.popup);
			mapContainer._currentOpenPopup = null;
		}
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
    
    // ===== ФИЛЬТРАЦИЯ ЧЕРЕЗ ЛЕГЕНДУ =====
    // Состояние фильтров: изначально все включены
    const filterState = {
        'available': true,
        'reserved': true,
        'sold': true,
        'not-available': true
    };
	
		/* TODO - если сделать так - то первый клик по фильтру игнорируется да и false не приводит к изначальному отключению фильтра
	    'available': <?= ($block["status_filter_state"]["available"] == "on") ? "true" : "false" ?>,
        'reserved': <?= ($block["status_filter_state"]["reserved"] == "on") ? "true" : "false" ?>,
        'sold': <?= ($block["status_filter_state"]["sold"] == "on") ? "true" : "false" ?>,
        'not-available': <?= ($block["status_filter_state"]["not-available"] == "on") ? "true" : "false" ?>
		*/
	
	
	
    
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
                if (plot.status === status) {
                    if (filterState[status]) {
                        // Показываем участок
                        if (!map.hasLayer(plot.layer)) {
                            plot.layer.addTo(map);
                        }
                    } else {
                        // Скрываем участок
                        if (map.hasLayer(plot.layer)) {
                            map.removeLayer(plot.layer);
                        }
                    }
                }
            });
        });
    });
	
    // Отключаем zoom колесом мыши
<?php if ($block["view"]["mousewheel"] == "scroll" ): ?>
    map.scrollWheelZoom.disable();
<?php endif; ?>
	

	// ===== ДОБАВЛЕНИЕ ИКОНОК ИНФРАСТРУКТУРЫ =====
	//const infrastructureIcons = <?php //echo json_encode($genplan_poi, JSON_UNESCAPED_SLASHES); ?>;
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
			const marker = L.marker(iconData.coords[0], { icon: icon })
				.bindPopup(createPopupContent(iconData, 'poi'))
				.addTo(map);
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


</script>
<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- END -->

<?php
/*

	JS: 
	// Кнопки прокрутки карты при запрещенном драге
	// 1. Создаем класс кастомного контрола
	var NavigationControl = L.Control.extend({
		onAdd: function(map) {
			// Создаем контейнер
			var container = L.DomUtil.create('div', 'map-navigation-control');
			
			// Создаем кнопки
			var btnUp = this._createButton('↑', container, function() {
				map.panBy([0, -50]); // Двигаем вверх на 50 пикселей
			});
			
			var btnDown = this._createButton('↓', container, function() {
				map.panBy([0, 50]); // Двигаем вниз
			});
			
			var btnLeft = this._createButton('←', container, function() {
				map.panBy([-50, 0]); // Двигаем влево
			});
			
			var btnRight = this._createButton('→', container, function() {
				map.panBy([50, 0]); // Двигаем вправо
			});

			// Блокируем передачу событий мыши на карту при клике на кнопки
			// (чтобы карта не дергалась под кнопками)
			L.DomEvent.disableClickPropagation(container);

			return container;
		},

		_createButton: function(html, container, fn) {
			var btn = L.DomUtil.create('button', 'nav-btn', container);
			btn.innerHTML = html;
			btn.title = "Переместить карту";
			
			// Добавляем событие клика
			L.DomEvent
				.on(btn, 'mousedown', L.DomEvent.stopPropagation)
				.on(btn, 'dblclick', L.DomEvent.stopPropagation)
				.on(btn, 'click', L.DomEvent.stop)
				.on(btn, 'click', fn, this);

			return btn;
		}
	});
	new NavigationControl({ position: 'topright' }).addTo(map);
	// Кнопки прокрутки карты при запрещенном драге END
*/


?>
