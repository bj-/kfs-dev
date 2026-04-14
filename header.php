<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="site-content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Go
 */

//$header_flex_class = in_array( get_theme_mod( 'header_variation', \Go\Core\get_default_header_variation() ), array( 'header-6' ), true ) ? '' : ' flex';

global $bender_settings;


?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--link rel="profile" href="https://gmpg.org/xfn/11" /-->
	<?php wp_head(); ?>
<!--
	<link rel="preload" href="/fonts/made-theartist-sans.woff" as="font">
	<link rel="preload" href="/fonts/made-theartist-script.woff" as="font">
	<link rel="preload" href="/fonts/made_theartist_script_extras.woff" as="font">
	<link rel="preload" href="/fonts/tt-ricordi-allegria-light.woff" as="font">
	<link rel="preload" href="/fonts/tt-ricordi-allegria-regular.woff" as="font">
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <script type="text/javascript" src="slick/slick.min.js"></script>
    <link rel="stylesheet" href="/genplan/leaflet.css"/>
    <script src="/genplan/leaflet.js"></script>


-->

	<!-- Frameworks -->
    <!--script src="/scripts/jquery/jquery-4.0.0.slim.min"></script-->
	<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	<!-- Functions -->
    <script src="<?= get_template_directory_uri(); ?>/js/kfs_functions.js"></script>

	<!-- Slick slide -->
	<script type="text/javascript" src="/scripts/slick/slick.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/scripts/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="/scripts/slick/slick-theme.css"/>
    <!--script type="text/javascript" src="/scripts/slick/slick.min.js"></script-->

	<!-- Leaflet -->
    <link rel="stylesheet" href="/scripts/leaflet/leaflet.css"/>
    <script src="/scripts/leaflet/leaflet.js"></script>
	<link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />
	<script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
	

	<!-- fancybox -->
	<link rel="stylesheet" href="/scripts/fancyapp/fancybox/fancybox.css" />
	<link rel="stylesheet" href="/scripts/fancyapp/carousel/carousel.css" />
	<link rel="stylesheet" href="/scripts/fancyapp/carousel/carousel.lazyload.css" />
	<link rel="stylesheet" href="/scripts/fancyapp/carousel/carousel.arrows.css" />
	<link rel="stylesheet" href="/scripts/fancyapp/carousel/carousel.thumbs.css" />
	<link rel="stylesheet" href="/scripts/fancyapp/carousel/carousel.dots.css" />
	<link rel="stylesheet" href="/scripts/fancyapp/carousel/carousel.autoplay.css" />
	<script src="/scripts/fancyapp/fancybox/fancybox.umd.js"></script>
	<script src="/scripts/fancyapp/carousel/carousel.umd.js"></script>
	<script src="/scripts/fancyapp/carousel/carousel.lazyload.umd.js"></script>
	<script src="/scripts/fancyapp/carousel/carousel.arrows.umd.js"></script>
	<script src="/scripts/fancyapp/carousel/carousel.thumbs.umd.js"></script>
	<script src="/scripts/fancyapp/carousel/carousel.dots.umd.js"></script>
	<script src="/scripts/fancyapp/carousel/carousel.autoplay.umd.js"></script>
	<script src="/scripts/fancyapp/carousel/carousel.autoscroll.umd.js"></script>
   
    <!-- Smart Cookies -->
	<link rel="stylesheet" href="/scripts/smart-cookies/css/smart-cookies.css" />
	
	<!-- WOW -->
	<link rel="stylesheet" href="/scripts/animate/animate.min.css">
    <script src="/scripts/animate/wow.js"></script>
    <script src="/scripts/animate/wow.min.js"></script>


<!-- Yandex.Metrika counter -->
<!-- /Yandex.Metrika counter -->

<script type="text/javascript">
function onLoad() {
	// Page Animation
	// === BG
	document.getElementById("bg_animation_UnderFade").style.backgroundSize = "cover";
}



</script>
</head>
<style>
body {background: <?= $bender_settings["colors"]["site"]["bg"] ?>; color: <?= $bender_settings["colors"]["site"]["text"] ?>;}

.link_color, .link_color_second {text-decoration:none;}
.link_color {color: <?= $bender_settings["colors"]["link"]["color"] ?>; }
.link_color:hover { color: <?= $bender_settings["colors"]["link"]["hover"] ?>;}
.link_color_second {color: <?= $bender_settings["colors"]["link_second"]["color"] ?>; }
.link_color_second:hover { color: <?= $bender_settings["colors"]["link_second"]["hover"] ?>;}

/* custom styles */
<?= $bender_settings["custom"]["style"]; ?>
/* custom styles END */
</style>
<body onload="javascript:onLoad();" class="" style="">

	<?php wp_body_open(); ?>

	<div id="page" class="site">

		<?php
		//$header = get_field('header');
		
		// Header values
		//$xx--contacts = get_field("contacts", 'option');
		//$-company = get_field("company", 'option');
		//$-menu = get_field("menu", 'option');
			
		//echo "<pre>"; var_dump($bender_settings); echo "</pre>";
		//if (is_array($header)) { echo "AAAAAAAAAAAAA";}

		//require_once 'blocks/test_header.php';	// Header Type1
		//if ( is_array($bender_settings["company"]) )
		//{
			// <!-- Header = Type1 -->
			require_once 'blocks/header_type1.php';	// Header Type1
	
			// <!-- MobileMenu = Type1 -->
			require_once 'blocks/menu_mobile_topslider.php';	// Mobile menu
		//}

		?>


<?php
/* 
$rows = get_field('header');
echo "<pre>"; var_dump($rows); echo "</pre>";
// */
?>
<main>
<!--main id="site-content" class="site-content" role="main"-->
