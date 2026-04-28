<?php 
/*
* Template Name: Направления деятельности - Направление
*/

$dev = (@$_GET["dev"]) ? TRUE : FALSE;
if (@$dev)
{
	// TODO Конструктор сайтов
	$header		= ($_GET["header"])	? substr($_GET["header"], 0, 20)	: FALSE;
	$first		= ($_GET["first"])	? substr($_GET["first"], 0, 20)		: FALSE;
}
else
{
	
}
//echo "<pre>"; var_dump($_GET); echo "</pre>";
//echo "<pre>"; var_dump($settings); echo "</pre>";

get_header(); ?>

<?php 
// Выбор типов блоков
// Показать активные блоки 
bender_page_builder();

/*
foreach ( @$bender_settings["blocks"] as $item )
{
	//echo "<pre>"; var_dump($item); echo "</pre>"; // exit;
	//if @($isFirst)
	if ( $item["show"] )
	{
		addBlock($item);
	}
}
*/
/*
if ( !is_array(@$bender_settings["blocks"]))
{
	echo "<h1 style='background: black; color: white;'>Отсутствуют и/или не выполнены настройки сайта</h1>";
}
*/
?>

<?php 
get_footer();
//echo "<pre>"; var_dump($bender_settings); echo "</pre>";
//echo "<pre>"; var_dump($bender_settings["genplan"]); echo "</pre>";
?>