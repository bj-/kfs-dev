<!-- Block: <?= $bUID; ?>, template: <?= $block["template_checked"] ?> -- START -->
<style>
#<?= $bUID; ?> { 
	position: relative;  height: fit-content;
	<?= ( $block['bg']['type'] == "img" ) ? "background-size: cover !important; background-position: center !important;" : ""; ?>
	<?= ( $block['bg']['type'] == "color" ) ? "background:" . $block['bg']['color'] . ";" : ""; ?>
	
	& .fade { 
		<?= $fade_style ?> width: 100%; height: 100%; 
		& .title {
			display:flex; 
			grid-gap:20px;
			padding-left:clamp(0px, 3vw, 50px); 
			padding-right:clamp(0px, 3vw, 50px); 

			& h2 { 
				font-size: <?= $bender_settings["size"]["title"] ?>; 
				/*line-height: 80px; */ 
				color: <?= $title_color ?>; 
				margin-top: 20px; 
				margin-bottom: 20px; 
				font-weight: normal; 
				/* flex: 1 1 0; */ 
			}
			& .text {
				font-size: 18px; 
				line-height: 32px;
				/* flex: 1 1 0; */ 
			}
		}
		& .content {
			padding-left:clamp(0px, 3vw, 50px); 
			padding-right:clamp(0px, 3vw, 50px); 
		}
	}




	& .content { display: flex; gap: 20px; padding-top: 50px; flex-wrap: wrap; }
	& .item { display: flex; justify-content: center; align-items: center; height: 100%; flex-direction: column; flex: 1 1 0; min-width: 240px; }
	& .item	{ 
		/* max-width: fit-content; */
	}
	& .item-title { font-size: 30px; line-height: 40px; font-weight: 400; }
	& .item-text { font-weight: 300; text-align: center; }
	
	/* corousel */
	

/* Mobile breakpoint */
@media (max-width: 1000px) {
	#<?= $bUID; ?> { 
		& .content { flex-direction: column; align-items: baseline; gap: 40px;}
		& .block > h2 { margin-bottom: 0px; }
	}
}

</style>

<div id="<?= $bUID ?>" class="nowide" style="<?= ( $block['bg']['type'] == "img" ) ? "background: url(" . $block['bg'] . "); " : ""; ?>" >
	<div class="fade">
				<div class="title">
					<h2 class="<?= $block["title-effect"]["style"] ?>" <?= $block["title-effect"]["data"] ?>><?= $block["title"] ?></h2>
					<p class="text"><?= $block['text'] ?></p>
				</div>
				<div class="content" id="<?= $bUID; ?>-carousel">
					<?php foreach ($block["video"] as $key => $item): ?>
					<div class="f-carousel__slide item">
						<?= $item["video"] ?>
					</div>
					<?php endforeach; ?>
				</div>

	</div>
</div>

<script>
/*
Carousel(
	document.getElementById("<?= $bUID; ?>-carousel"), 
	{
	}, 
	{
	}).init();
*/
</script>

<?php
//echo "<pre>"; var_dump($block); echo "</pre>";
//echo "<pre>"; var_dump($bender_settings["title_style"]); echo "</pre>";
//if (is_array($header)) { echo "AAAAAAAAAAAAA";}
?>
<!-- Block: <?= $bUID; ?>, template: <?= $block["template_checked"] ?> -- END -->