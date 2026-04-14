<?php 
/*
* Template Name: Генплан
*/
get_header(); 

//echo "<pre>"; var_dump($bender_settings["blocks"]["genplan"]); echo "</pre>";
//$page = get_page_by_path( "genplan/" );
//echo "<pre>linked_page\n"; var_dump($page); echo "</pre>";
//$front_page_id = get_option('page_on_front');

//echo "<pre>page_title\n"; var_dump($page); echo "</pre>";

bender_page_builder();

//echo "<pre>bender_page_settings\n"; var_dump($bender_page_settings); echo "</pre>";

get_footer(); ?>
