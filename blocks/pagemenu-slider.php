<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- START -->
<style>
#<?= $bUID; ?> { 
	position: relative; 
	background-size: cover !important; 
	background-position: center !important; 
	height: fit-content;
	
	& .fade { 
		<?= $fade_style ?> 
		width: 100%; 
		height: 100%; 
	}	
	& .title {
		display:flex; 
		gap:20px;
		padding-left:clamp(0px, 3vw, 50px); 
		padding-right:clamp(0px, 3vw, 50px); 
		
		& h2 { 
			font-size: <?= $bender_settings["size"]["title"] ?>; 
			/*line-height: 80px; */ 
			color: <?= $title_color ?>; 
			margin-top: 20px; 
			margin-bottom: 20px; 
			font-weight: normal; 
			/* flex: 1 1 0;*/
		}
		& .text { 
			font-size: 18px; 
			line-height: 32px; 
		}
	}
	& .content {
		height: 400px;
		padding-left: clamp(0px, 3vw, 50px);
		padding-right: clamp(0px, 3vw, 50px);

		& .item {
			background-size: cover !important; 
			background-position: center !important; 
				&::before {
				content: '';
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background-color: rgba(0, 0, 0, 0.3);
				z-index: 1;
				pointer-events: none;
			}				
			& .label {
				font-size: clamp(32px, 3vw, 50px);
				display: block;
				position: relative;
				height: 100%;
				width: 100%; 
				z-index: 2;
				
				& .link {
					height: 100%;
					width: 100%; 
					display: flex;
					align-items: center;
					justify-content: center;
					text-align: center;
					color: #0DFF84;
					text-decoration: none;
					
				}
			}
		}

		& .f-carousel {
			height: 100%;
			
		  --f-arrow-pos: 10px;

		  --f-arrow-width: 45px;
		  --f-arrow-height: 45px;

		  --f-arrow-svg-width: 20px;
		  --f-arrow-svg-height: 20px;
		  --f-arrow-svg-stroke-width: 5;

		  --f-arrow-color: #475569;
		  --f-arrow-shadow: 0 6px 12px -2px rgb(50 50 93 / 25%), 0 3px 7px -3px rgb(0 0
				  0 / 30%);

		  --f-arrow-border-radius: 50%;
		  --f-arrow-bg: rgba(255, 255, 255, 0.5); /* #fff; */
		  --f-arrow-hover-bg: #f9f9f9;
		  --f-arrow-active-bg: #f0f0f0;
		}
	}
}

/* Mobile breakpoint */
@media (max-width: 1200px) {
	#<?= $bUID; ?> { 

	}
}

@media (max-width: 900px) {
	#<?= $bUID; ?> { 

	}
}
@media (max-width: 350px) {
	#<?= $bUID; ?> { 

	}
}

#carousel-<?= $bUID; ?> {
	--f-carousel-gap: 40px;
	--f-carousel-slide-width: 60%;
	--f-carousel-slide-padding: 0px;
}

</style>

<div id="<?= $bUID; ?>" class="nowide" style="<?= $block["bg_style"] ?>">
	<div class="fade">
		<div class="title">
			<h2 class="<?= $block["title-effect"]["style"] ?>" <?= $block["title-effect"]["data"] ?>><?= $block['title'] ?></h2>
			<p class="text"><?= $block['text'] ?></p>
		</div>
		<div class="content">
					<div class="<?= $bUID; ?>-area-carousel-class" id="carousel-<?= $bUID; ?>">
						
						<?php foreach ( $block["items"] as $key => $item ): ?>
								<!--div class="f-carousel__slide item" data-fancybox="fancybox-carousel-<?= $bUID; ?>-area-<?= $key; ?>" data-src="<?= $item["bg"]["img"]; ?>" data-thumb-src="<?= $item["bg"]["img"]; ?>" style="background:url('<?= $item["bg"]["img"]; ?>');"-->
								<div class="f-carousel__slide item" style="background:url('<?= $item["bg"]["img"]; ?>');">
									<div class="img_border w100h100p">
										<span class="label">
											<a href="<?= $item["link"]["page"]; ?>" class="link">
												<?= $item["name"]; ?>
											</a>
										</span>
									</div>
								</div>

						<?php endforeach; ?>
					</div>
		</div>
	</div>
</div>

<script>
Carousel(
	document.getElementById('carousel-<?= $bUID; ?>'), 
	{
		Autoscroll: {
		speed : 2,
		speedOnHover: 1
		}
	}, 
	{
		Autoscroll,
		Dots,
		Arrows
	}).init();
	
</script>

<?php
//echo "<pre>"; var_dump($block); echo "</pre>";
?>
<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- END -->