<?php
// KFS Studio Functions
// Настройки сайта
function get_site_settings()
{
	global $standalone;

	if ( !$standalone )
	{
		
		$ret["template_dir"] = __DIR__;
		$ret["stylesheet_dir"] = __DIR__;
			// Company settings
		$ret["contacts"] 	= get_field("contacts", 'option');
		$ret["company"] 	= get_field("company", 'option');
		$ret["menu"] 		= get_field("menu", 'option');
		$ret["company"]["copyright"] = get_field("copyright", 'option');
		$ret["chat"] 		= get_field("site_chat", 'option');
		$ret["chat"]		= get_field("chats", 'option');

		// Site settings
		$ret["fonts"]		= get_field('fonts', 'option');
		//	$ret["wow_style"]	= get_field('wow_style', 'option');
		$ret["title_style"]	= get_field('title_style', 'option');

		$ret["header"]		= get_field('header', 'option');
		$ret["footer"]		= get_field('footer', 'option');
		$ret["chat"]		= get_field('chat_settings', 'option');
		$ret["colors"]		= get_field('colors', 'option');
		$ret["custom"]		= get_field('custom', 'option');
		$ret["size"]["title"]	= get_field('title_size', 'option');

	}
	else
	{
		$ret["template_dir"] = get_template_directory_uri();
		$ret["stylesheet_dir"]= get_stylesheet_directory();

		$ret["size"]["title"]	= get_field('title_size', 'option');
		$ret["colors"]["site"]["bg"] 		= "rgb(10,0,0)";
		$ret["colors"]["text"]["customize"] = "rgb(0,255,0)";
		$ret["colors"]["text"]["title"] 	= "rgb(255, 255, 255);";
		$ret["colors"]["site"]["text"] 		= "rgb(0,255,255)";
		$ret["title_style"] 	= "ssss";
	}
	
	// $title_color
	return $ret;
}

function getPageIdByShortcut($slug)
{
	// получение ID страницы по имени "ярлыка" страницы. Например по "genplan" для полного URL site.com/genplan/;
	$query = new WP_Query([
		'name' => $slug,
		'post_type' => 'page',
		'post_status' => 'publish',
		'fields' => 'ids', // возвращаем только ID, экономим ресурсы
		'nopaging' => true,
	]);

	if ($query->have_posts()) {
		$page_id = $query->posts[0];
		return $page_id;
	}
}

function getBlockData($blockID, $page_id = null)
{
	$page_id = ($page_id) ? $page_id : get_the_ID();

	$ret = get_field($blockID, $page_id);
	$ret["BlockID"] = $blockID;
	$ret["template_checked"] = checkTemplateExist($ret["template"]);
	
	return $ret;
}

function checkTemplateExist($template)
{

	if (is_file(__DIR__ . '/blocks/' . htmlspecialchars(substr($template, 0, 30)) . '.php'))
	{
		return $template; 
	}
	else
	{
		return "no_template"; 
	}
}



/**
 * Рекурсивное слияние массивов с приоритетом $base
 * @param array $base Базовый массив (имеет приоритет)
 * @param array $source Массив-источник (добавляет отсутствующие ключи)
 * @return array
 */
function array_merge_recursive_priority(array $base, array $source): array {
    $result = $base; // Начинаем с base (его значения приоритетны)
    
    foreach ($source as $key => $value) {
        // Если ключа нет в base — добавляем из source
        if (!array_key_exists($key, $result)) {
            $result[$key] = $value;
        }
        // Если ключ есть в обоих и оба значения — массивы, сливаем рекурсивно
        elseif (is_array($result[$key]) && is_array($value)) {
            $result[$key] = array_merge_recursive_priority($result[$key], $value);
        }
        // Если ключ есть в обоих, но не массивы — оставляем значение из base (приоритет)
        // Ничего не делаем
    }
    
    return $result;
}


function compile_title_style($title_style)
{
	$name = array();
	$data_prop = array();

	if ( @!is_array(@$title_style) ) { return false; }

	foreach ( $title_style as $item)
	{
		if ( $item["active"] )
		{
			if ( $item["name"] ) 		{ $name[] 		= $item["name"]; };
			if ( @$item["data_prop"] ) 	{ $data_prop[] 	= @$item["data_prop"]; };
		}
	}
	$ret["name"] = implode(" ", $name);
	$ret["data"] = implode(" ", $data_prop);

	return $ret;
}

function addBlock($blockInfo, $page_id = NULL, $firstBlock = false)
{
	global $bender_settings;
	
	$page_id = ($page_id) ? $page_id : get_the_ID();
	
	$bUID = $blockInfo["block_id"];
	$blockID = $bUID; // для обратной совместимости. TODO заменить $blockID на $bUID
	$block = getBlockData($bUID, $page_id);

	if ( @is_array(@$block["datapage"]) )
	{
		//echo "<pre>$block[datapage]\n"; var_dump($block["datapage"]); echo "</pre>";
		foreach ( $block["datapage"] as $item)
		{
			$dataPageID = getPageIdByShortcut($item["shortcut"]);
			$data_block = getBlockData($item["block"], $dataPageID);

			if ( $item["importall" ] )
			{
				$block[$item["block"]] = $data_block;
			}
			else
			{
				$fieldNames = array_map('trim', array_column($item['fields'], 'name'));

				// Фильтруем data_block: оставляем только ключи из fields
				$filteredDataBlock = array_intersect_key($data_block, array_flip($fieldNames));

				// Рекурсивное слияние с приоритетом block
				$block = array_merge_recursive_priority($block, $filteredDataBlock);		
			}
		}
		//echo "<pre>block\n"; var_dump($block); echo "</pre>";
		//echo "<pre>merged\n"; var_dump($merged); echo "</pre>";
		//echo "<pre>merged\n"; var_dump($merged); echo "</pre>";
		
	}

	
	//$block = getBlockData($bUID);
	//echo "<pre>"; var_dump($bUID); echo "</pre>";
	//echo "<pre>block"; var_dump($block); echo "</pre>";
	
	$block["bg_style"] = ( @$block['bg']["type"] == "img" ) ? "background: url(" . @$block['bg']["img"] . ");" : "";
	
	// TODO Переделать на данные из настроек сайта (опции)
	$fade = array();
	if ( @$block["bg"]["fade"] && @$block["bg"]["type"] == "img")
	{
		$fade_val = ( @$block["bg"]["fade"] > 0 && @$block["bg"]["fade"] <= 100 ) ? (round(@$block["bg"]["fade"])/100) : 0;
		$fade[] = "background: rgba(7, 15, 31, $fade_val);";
	}
	
	if ( @$block["bg"]["type"] == "img" )
	{
		$fade[] = "padding-top: clamp(50px, 5.8vw, 100px);";
		$fade[] = "padding-bottom: clamp(50px, 5.8vw, 100px);";
	}
	
	$fade_style = implode(" ; ", $fade);
	$fade = (@$fade[0]) ? @$fade[0] : '';

	// ороткие переменные для цветов
	$title_color = ($bender_settings["colors"]["text"]["customize"]) ? $bender_settings["colors"]["text"]["title"] : $bender_settings["colors"]["site"]["text"];
	//$title_font = "";
	
	// вычисляем стиль заголовка
	//echo "<pre>block[title-effect][type]\n"; var_dump($block["title-effect"]["type"]); echo "</pre>";
	//echo "<pre>bender_settings[title_style]\n"; var_dump($bender_settings["title_style"]); echo "</pre>";

	switch ($block["title-effect"]["type"])
	{
		case "Global":
			$compile_title_style = compile_title_style($bender_settings["title_style"]);
			//echo "<pre>compile_title_style\n"; var_dump($compile_title_style); echo "</pre>";
			$block["title-effect"]["style"] = @$compile_title_style["name"];
			$block["title-effect"]["data"]	= @$compile_title_style["data"];
			break;
		case "Static":
			$block["title-effect"]["style"] = "";
			$block["title-effect"]["data"]	= "";
			break;
		case "Custom":
			$block["title-effect"]["style"] = "asdasda";
			$block["title-effect"]["data"]	= "";
			break;
		default:
			$block["title-effect"]["style"] = @$compile_title_style["name"];
			$block["title-effect"]["data"]	= @$compile_title_style["data"];;
	}
	//echo "<pre>block[title-effect]\n"; var_dump($block["title-effect"]); echo "</pre>";

	//$block["title-effect"]["style"]
	
	//echo "include blocks/anchor.php;";	//
	if ( !$firstBlock ) { //  если блок первый - не включаем
		include 'blocks/anchor.php';	//
	}
	//echo "blocks/" . $block["template_checked"] . ".php";	//
	include 'blocks/' . $block["template_checked"] . '.php';	//
}

function get_page_settings()
{
	$ret = get_field('bloks');
	return $ret;
}

function bender_page_builder()
{
	$arr = get_page_settings();
	//echo "<pre>function bender_page_builder()\n"; var_dump($arr); echo "</pre>";
	
	if ( !is_array($arr) )
	{
		echo "<div style='color:white; background-color:black; position: absolute; top: 50%; width: 100%; padding: 50px;'>
			<h1>Не выполнены настройки сайта.</h1>
			</div>";
		return exit;
	}
	
	$firstBlock = true;
	
	foreach ( $arr as $item )
	{
		if ( $item["show"] )
		{
			//echo "<pre>addBlock($item)\n"; var_dump($item); echo "</pre>";
			addBlock($item, null, $firstBlock);
			$firstBlock = false;
		}
	}
}

function rgba2rgb($colorString) {
    // Удаляем пробелы и приводим к нижнему регистру
    $colorString = preg_replace('/\s+/', '', strtolower($colorString));
    
    // Проверяем формат rgba
    if (preg_match('/^rgba\((\d+),(\d+),(\d+),[\d.]+\)$/', $colorString, $matches)) {
        return sprintf('rgb(%d,%d,%d)', $matches[1], $matches[2], $matches[3]);
    }
    
    // Проверяем формат rgb
    if (preg_match('/^rgb\((\d+),(\d+),(\d+)\)$/', $colorString)) {
        return $colorString; // Уже в формате RGB
    }
    
    // Если формат не распознан, возвращаем исходную строку
    return $colorString;
}

function setAlpha($colorString, $alpha) {
    // Удаляем пробелы и приводим к нижнему регистру
    $colorString = preg_replace('/\s+/', '', strtolower($colorString));
    
    // Проверяем формат rgba
    if (preg_match('/^rgba\((\d+),(\d+),(\d+),[\d.]+\)$/', $colorString, $matches)) {
        return sprintf('rgba(%d,%d,%d,%s)', $matches[1], $matches[2], $matches[3], $alpha);
    }
    
    // Проверяем формат rgb
    if (preg_match('/^rgb\((\d+),(\d+),(\d+)\)$/', $colorString, $matches)) {
        return sprintf('rgba(%d,%d,%d,%s)', $matches[1], $matches[2], $matches[3], $alpha);
    }
    
    // Если формат не распознан, возвращаем исходную строку
    return $colorString;
}

// Leaflet functions START
// Convert to leaflet array
function convertToLeafletCoords ($src, $shift, $type = "poly")
{
	$shiftX = (int)$shift["x"]; // сдвиг координат при изменении линейных размеров карты с сохранением пропорций
	$shiftY = (int)$shift["y"];

		$jsonString = '[' . $src . ']';
		
		// Декодируем JSON
		$coords = json_decode($jsonString, true);
		// Округляем значения до целых и применяем сдвиг если подложка поменялась
		if (is_array($coords)) 
		{
			$coords = array_map(function($point) use ($shiftX, $shiftY, $type) {
				switch ($type)
				{
					case "poly":
						$x = $point[0];
						$y = $point[1];
						return [
								(int)round($x + $shiftX),
								(int)round($y + $shiftY)
						];
						break;
					case "marker":
						$x = $point[1];
						$y = $point[0];
						return [
								(int)round($x + $shiftY), //у маркера инвертированны координаты
								(int)round($y + $shiftX)
						];
						break;
					default:
						$x = $point[0];
						$y = $point[1];
						return [
								(int)round($x + $shiftX),
								(int)round($y + $shiftY)
						];
				}
/*
				return [
						(int)round($x + $shiftX),
						(int)round($y + $shiftY)
				];
				*/
			}, $coords);
		}
		else
		{
			if ( $type == "poly" )
			{
				$coords = array(array(100,100),array(200,100),array(200,200),array(100,200));
			}
			elseif ( $type == "marker" )
			{
				$coords = array(150,150);
			}
		}
	return $coords;
}
function convertToLeafletArrayPlace ($area, $shift, $prefix)
{
	
	if (! is_array($area) )
	{
		return array(); // возвращаем пустой массив если нет данных для конвертации
	}
	
	foreach ($area as $key => $item)
	{
		$id = 'place' . $key;
		$name = $prefix . " " . $item["object"]["ids"]["name"];
		$status = $item["object"]["ids"]["status"];
		//$status = 'not-available';
		$price = $item["object"]["ids"]["price"];
		$desc = $item["object"]["ids"]["desc"];
		$square = $item["object"]["ids"]["square"];
		$projects = $item["object"]["projects"]["project"];
		$interior = $item["object"]["projects"]["interior"];
		$gallery = $item["object"]["gallery"];
		$ico = $item["object"]["ico"];

		$active = $item["object"]["ids"]["active"]; // показывать на карте

		$coords = convertToLeafletCoords($item["object"]["coord"], $shift, "poly");

		if ($active)
		{
			// Итоговый сконвертированный массив для Леафлета
			$ret[] = array(
				"ID" => $id,
				"ico" => $ico,
				"name" => $name,
				"status" => $status,
				"price" => $price,
				"desc" => $desc,
				"square" => $square,
				"projects" => $projects,
				"interior" => $interior,
				"gallery" => $gallery,
				"coords" => $coords
			);	
		};
	}
	return $ret;	
}

function convertToLeafletArrayPOI ($area, $shift)
{

	if (! is_array($area) )
	{
		return array(); // возвращаем пустой массив если нет данных для конвертации
	}
	
	foreach ($area as $key => $item)
	{
		$id = 'poi' . $key;
		$name = $item["object"]["ids"]["name"];
		$desc = $item["object"]["ids"]["desc"];
		$gallery = $item["object"]["gallery"];
		$ico = $item["object"]["ico"];

		$active = $item["object"]["ids"]["active"]; // показывать на карте
		
		$coords = convertToLeafletCoords($item["object"]["coord"], $shift, "marker");

		if ($active)
		{
			// Итоговый сконвертированный массив для Леафлета
			$ret[] = array(
				"ID" => 'poi_' . $id,
				"ico" => $ico,
				"name" => $name,
				"desc" => $desc,
				"gallery" => $gallery,
				"coords" => $coords
			);	
		};
	}
	return $ret;	
}
function convertToLeafletArrayOrders ($area, $shift)
{

	if (! is_array($area) )
	{
		return array(); // возвращаем пустой массив если нет данных для конвертации
	}
	
	foreach ($area as $key => $item)
	{
		$id = 'order' . $key;
		$name = $item["object"]["ids"]["name"];
		$status = $item["object"]["ids"]["status"];
		$desc = $item["object"]["ids"]["desc"];
		$link = $item["object"]["link"];
		$gallery = $item["object"]["gallery"];
		$ico = $item["object"]["ico"];
		$fillColor = $item["object"]["fill-color"];
		$borderColor = $item["object"]["fill-color"];

		$active = $item["object"]["ids"]["active"]; // показывать на карте
		
		$coords = convertToLeafletCoords($item["object"]["coord"], $shift, "poly");

		if ($active)
		{
			// Итоговый сконвертированный массив для Леафлета
			$ret[] = array(
				"ID" => $id,
				"ico" => $ico,
				"name" => $name,
				"status" => $status,
				"desc" => $desc,
				"olink" => $link,
				"gallery" => $gallery,
				"coords" => $coords,
				"fillColor" => $fillColor,
				"borderColor" => $borderColor
			);	
		};
	}
	return $ret;	
}
function convertToLeafletArrayLines ($area, $shift)
{

	if (! is_array($area) )
	{
		return array(); // возвращаем пустой массив если нет данных для конвертации
	}
	
	foreach ($area as $key => $item)
	{
		$id = 'line' . $key;
		$name = $item["object"]["ids"]["name"];
		$status = $item["object"]["ids"]["status"];
		$desc = $item["object"]["ids"]["desc"];
		$link = $item["object"]["link"];
		$gallery = $item["object"]["gallery"];
		$ico = $item["object"]["ico"];
		$color = $item["object"]["color"];
		$type = $item["object"]["type"];
		$gage = $item["object"]["gage"];		
		

		$active = $item["object"]["ids"]["active"]; // показывать на карте
		
		$coords = convertToLeafletCoords($item["object"]["coord"], $shift, "poly");

		if ($active)
		{
			// Итоговый сконвертированный массив для Леафлета
			$ret[] = array(
				"ID" => $id,
				"ico" => $ico,
				"name" => $name,
				"status" => $status,
				"desc" => $desc,
				"olink" => $link,
				"gallery" => $gallery,
				"coords" => $coords,
				"color" => $color,
				"type" => $type,
				"gage" => $gage,
			);	
		};
	}
	return $ret;	
}

// Leaflet functions END

// Init
$bender_settings = get_site_settings();

?>

