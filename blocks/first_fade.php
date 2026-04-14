<!-- Блок First / Старт / главный экран начало -->
<style>
#first_screen {
	position:relative; background-size:cover !important; background-position:center !important; height:100vh; width: 100%;
	animation-name: fadeIn;
	animation-iteration-count: 1;
	animation-timing-function: ease-in-out;
	animation-duration: 5s;
	animation-fill-mode:forwards;
	opacity: 0;
	& .fade { <?= $fade ?> position: absolute; width: 100%; height: 100%; }	

	& .bg_animation_OnFade, .first_screen_bg_animation_UnderFade {position: absolute; width: 100%;  height: 100%; background-size: cover !important; background-position: center !important;}
	& .content {position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; text-align: center;}
	/* & .content > img {width:100%;} */
	/* #first_screen h2.font-artist {padding-top:100px;} */
	& .title1 {color:white; font-weight: 500; font-size: clamp(70px, 21vw, 280px); animation: fadeIn 3s ease-in-out 0s 0.6 forwards; padding-bottom: 20vh; font-family: "<?= $bender_settings['fonts']["site_title"] ?>";}
	& .title2 {font-size: clamp(25px, 4vw, 45px); line-height: normal; position: absolute; bottom: clamp(30px, 12vh, 180px); margin: 0; padding: 0; color: white; text-align: center; }
	& .subtitle_font { font-family:"<?= $bender_settings['fonts']["site_desc1"] ?>"; }
	
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}
</style>

<?php
$block = get_field("first");
//echo "<pre>"; var_dump($block); echo "</pre>";
//if (is_array($header)) { echo "AAAAAAAAAAAAA";}
?>

<div id="first_screen" class="wide" style="background:url(<?= $block['bg'] ?>); transition: background 2.75s 0.0s linear; backface-visibility: hidden;">
	<div id="bg_animation_UnderFade" class="first_screen_bg_animation_UnderFade" style="background:url(<?= $block['bg_animation_under_fade'] ?>); background-size: 0px !important;">
		<div class="fade">
			<div id="bg_animation_OnFade"  class="bg_animation_OnFade" style="background:url(<?= $block['bg_animation_over_fade'] ?>);">
				<div class="content">
					<h1 class="title1"><?= $block['name'] ?></h1>
					<h2 class="title2" >
						<span class="link_color subtitle_font" style="text-transform: lowercase;">
							<?= $block['description'] ?>
						</span>
						<br>
						<span class="subtitle_font link_color_second">
							<?= $block['description2'] ?>
						</span>
					</h2>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
// echo "<pre>"; var_dump($block); echo "</pre>";
		//if (is_array($header)) { echo "AAAAAAAAAAAAA";}
?>
<!-- Блок First / Старт / главный экран конец -->