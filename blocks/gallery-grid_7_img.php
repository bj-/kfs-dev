<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- START -->
<style>
#<?= $bUID; ?> { 
	position: relative; background-size: cover !important; background-position: center !important; height: fit-content;
	& .fade { <?= $fade_style ?> width: 100%; height: 100%; }	
	
	& .title {display:flex; gap:20px;}
	& .title > h2 { font-size: <?= $bender_settings["size"]["title"] ?>; /*line-height: 80px; */ color: <?= $title_color ?>; margin-top: 20px; margin-bottom: 20px; font-weight: normal; }
	& .text,
		& .title > h2 { flex: 1 1 0; }
	& .text { font-size: 18px; line-height: 32px; }
	& .title,
		& .grid {padding-left:clamp(0px, 3vw, 50px); padding-right:clamp(0px, 3vw, 50px); }
	
	/* grid */
	& .grid { margin-top: 40px; overflow: hidden; display:flex; flex-direction:row; height: 790px;}
	& .img_gap { gap:20px; }
	& .img {
		background-size:cover !important; background-position:center !important; position: relative; 
		overflow: hidden; /* обрезает вылезающие края при увеличении */
	}
	& .col1, 
		& .col2,
		& .col3 { display:flex; flex-direction:column; }
	& .col1, & .col3 { width:25%; }
	& .col2 { width:50%; }
	& .col1 > .img {height: 50%;}
	& .col3 > .img {height: 100%;}
	& .row2-1 { display:flex; flex-direction:row; height: 33%;}
	& .row2-2 { display:flex; flex-direction:column; height: 67%; }
	& .row2-1 > .img { width:50%; }
	& .row2-2 > .img { height:50%; }

	/* img and text decoration */
	& .img_link {position: absolute; width: 100%; height: 100%; text-decoration: none; color: #FFF; }
	& .img_link:hover {color: #FFF;}
	& .img_border { border-radius: clamp(12px, 3vw, 30px) }
	& .img_label { position:absolute; left:clamp(15px, 2vw, 30px); bottom:10px;  font-size: clamp(24px, 2vw, 35px); color: <?= $bender_settings["colors"]["img"]["label"] ?>;}
	& .img_gradient { background: linear-gradient(to bottom, <?= setAlpha($bender_settings["colors"]["img"]["bar"], 0.0); ?> 75%, <?= setAlpha($bender_settings["colors"]["img"]["bar"], 0.3); ?> 80%, <?= setAlpha($bender_settings["colors"]["img"]["bar"], 1); ?> 100%); } 
	
	& .f-thumbs { display:none; } /* thumb мобильной версии скрыт */

	/* Custom: Анимация scale фона через псевдоэлемент */
	& .img { background: none !important; /* убираем фон с родителя */ }
	& .img::before {
		content: '';
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-size: cover !important;
		background-position: center !important;
		/* Копируем инлайновый фон через CSS */
		background-image: var(--bg-image);
		transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
		will-change: transform;
		z-index: 0;
	}
	& .img:hover::before { transform: scale(1.15); }
	& .img > * { position: relative; z-index: 1; }
	/* Custom END */
	
	& .f-carousel {
		--f-arrow-pos: 10px; /* Distance from edge */
		--f-arrow-width: 40px; /* Width of button */
		--f-arrow-height: 40px; /* Height of button */
		--f-arrow-border-radius: 50%; /* Shape */
		--f-arrow-color: #475569; /* Icon color */
		--f-arrow-bg: #fff; /* Background color */
		--f-arrow-hover-bg: #f9f9f9; /* Hover state */
		--f-arrow-shadow: 0 6px 12px -2px rgb(50 50 93 / 25%);
	}
}

#<?= $bUID; ?>-mobile-carousel {
	display:none; margin-top: 50px; padding-left: clamp(0px, 3vw, 25px); padding-right: clamp(0px, 3vw, 25px);
	
	/* mobile caroseel */
	& .gallery_mobile_item { position: relative; z-index: 1; transition: transform 0.1s ease; aspect-ratio: 1 / 2; background-size:cover !important; background-position:center !important; max-height: 70vh;}
	/* & .mobile-slide { aspect-ratio: 1 / 2; background-size:cover !important; background-position:center !important; max-height: 80%; } */
	
	/* image decoration */
	& .img_border {border-radius: unset;}
	
}

/* Mobile breakpoint */
@media (max-width: 1200px) {
	#<?= $bUID; ?> { 
		& .title {flex-direction: column; grid-gap:0px;}
	}
}

@media (max-width: 1000px) {
	#<?= $bUID; ?>-mobile-carousel {
		display: block;
	}

	#<?= $bUID; ?> { 
		& .grid { display:none; }
		& .f-thumbs { display:block; }
	}
}
</style>

<div id="<?= $bUID; ?>" class="nowide" style="<?= $block["bg_style"] ?>">
    <div class="title">
        <h2 class="<?= $block["title-effect"]["style"] ?>" <?= $block["title-effect"]["data"] ?>><?= $block['title'] ?></h2>
        <p class="text"><?= $block['text'] ?></p>
    </div>
    <div class="grid img_gap">
		<div class="col1 img_gap ">
			<div class="img img_border" style="background:url('<?= $block["gallery"][0]["img"]; ?>'); --bg-image:url('<?= $block["gallery"][0]["img"]; ?>'); ">
				<div class="<?= ($block["gallery"][0]["name"]) ? "img_gradient" : "" ?> img_border w100h100p">
					<?php if ($block["clickable"]): ?>
						<a class="img_link fancybox-<?= $blockID; ?> curspointer" data-fancybox="fancybox-<?= $blockID; ?>" style="position:absolute; width:100%; height:100%" href="<?php echo $block["gallery"][0]["img"]; ?>">
					<?php endif; ?>
							<span class="img_label img_label_font" style=""><?php echo $block["gallery"][0]["name"]; ?></span>
					<?php if ($block["clickable"]): ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
			<div class="img img_border" style="background:url('<?php echo $block["gallery"][1]["img"]; ?>'); --bg-image:url('<?= $block["gallery"][1]["img"]; ?>'); ">
				<div class="<?= ($block["gallery"][1]["name"]) ? "img_gradient" : "" ?> img_border w100h100p">
					<?php if ($block["clickable"]): ?>
						<a class="img_link fancybox-<?= $blockID; ?> curspointer" data-fancybox="fancybox-<?= $blockID; ?>" style="position:absolute; width:100%; height:100%" href="<?php echo $block["gallery"][1]["img"]; ?>">
					<?php endif; ?>
							<span class="img_label img_label_font" style=""><?php echo $block["gallery"][1]["name"]; ?></span>
					<?php if ($block["clickable"]): ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="col2 img_gap">
			<div class="row2-1 img_gap">
				<div class="img img_border" style="background:url('<?php echo $block["gallery"][2]["img"]; ?>'); --bg-image:url('<?= $block["gallery"][2]["img"]; ?>');">
					<div class="<?= ($block["gallery"][2]["name"]) ? "img_gradient" : "" ?> img_border w100h100p">
						<?php if ($block["clickable"]): ?>
							<a class="img_link fancybox-<?= $blockID; ?> curspointer" data-fancybox="fancybox-<?= $blockID; ?>" style="position:absolute; width:100%; height:100%" href="<?php echo $block["gallery"][2]["img"]; ?>">
						<?php endif; ?>
								<span class="img_label img_label_font" style=""><?php echo $block["gallery"][2]["name"]; ?></span>
						<?php if ($block["clickable"]): ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
				<div class="img img_border" style="background:url('<?php echo $block["gallery"][3]["img"]; ?>'); --bg-image:url('<?= $block["gallery"][3]["img"]; ?>');">
					<div class="<?= ($block["gallery"][3]["name"]) ? "img_gradient" : "" ?> img_border w100h100p">
						<?php if ($block["clickable"]): ?>
							<a class="img_link fancybox-<?= $blockID; ?> curspointer" data-fancybox="fancybox-<?= $blockID; ?>" style="position:absolute; width:100%; height:100%" href="<?php echo $block["gallery"][3]["img"]; ?>">
						<?php endif; ?>
								<span class="img_label img_label_font" style=""><?php echo $block["gallery"][3]["name"]; ?></span>
						<?php if ($block["clickable"]): ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="row2-2 img_gap">
				<div class="img img_border" style="background:url('<?php echo $block["gallery"][4]["img"]; ?>'); --bg-image:url('<?= $block["gallery"][4]["img"]; ?>');">
					<div class="<?= ($block["gallery"][4]["name"]) ? "img_gradient" : "" ?> img_border w100h100p">
						<?php if ($block["clickable"]): ?>
							<a class="img_link fancybox-<?= $blockID; ?> curspointer" data-fancybox="fancybox-<?= $blockID; ?>" style="position:absolute; width:100%; height:100%" href="<?php echo $block["gallery"][4]["img"]; ?>">
						<?php endif; ?>
								<span class="img_label img_label_font" style=""><?php echo $block["gallery"][4]["name"]; ?></span>
						<?php if ($block["clickable"]): ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
				<div class="img img_border" style="background:url('<?php echo $block["gallery"][5]["img"]; ?>'); --bg-image:url('<?= $block["gallery"][5]["img"]; ?>');">
					<div class="<?= ($block["gallery"][5]["name"]) ? "img_gradient" : "" ?> img_border w100h100p">
						<?php if ($block["clickable"]): ?>
							<a class="img_link fancybox-<?= $blockID; ?> curspointer" data-fancybox="fancybox-<?= $blockID; ?>" style="position:absolute; width:100%; height:100%" href="<?php echo $block["gallery"][5]["img"]; ?>">
						<?php endif; ?>
								<span class="img_label img_label_font" style=""><?php echo $block["gallery"][5]["name"]; ?></span>
						<?php if ($block["clickable"]): ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col3 img_gap">
			<div class="img img_border" style="background:url('<?php echo $block["gallery"][6]["img"]; ?>'); --bg-image:url('<?= $block["gallery"][6]["img"]; ?>');">
				<div class="<?= ($block["gallery"][6]["name"]) ? "img_gradient" : "" ?> img_border w100h100p">
					<?php if ($block["clickable"]): ?>
						<a class="img_link fancybox-<?= $blockID; ?> curspointer" data-fancybox="fancybox-<?= $blockID; ?>" style="position:absolute; width:100%; height:100%" href="<?php echo $block["gallery"][6]["img"]; ?>">
					<?php endif; ?>
							<span class="img_label img_label_font" style=""><?php echo $block["gallery"][6]["name"]; ?></span>
					<?php if ($block["clickable"]): ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div style="display:none;">
		<?php 
		$i = 0;
		while ($block["gallery"][$i]["img"]):
		?>
			<?php if ($i > 6) : ?>
				<a class="fancybox-<?= $blockID; ?>" data-fancybox="fancybox-<?= $blockID; ?>" href="<?= $block["gallery"][$i]["img"] ?>">
					<img src="<?= $block["gallery"][$i]["img"] ?>" alt="<?= $block["gallery"][$i]["name"] ?>">
				</a>
			<?php endif; ?>
			<?php 
			$i++; 
			endwhile; 
			?>
	</div>
	<div class="<?= $bUID; ?>-mobile-carousel-class" id="<?= $bUID; ?>-mobile-carousel">
		<?php foreach ($block["gallery"] as $item ): ?>
			<div class="f-carousel__slide gallery_mobile_item" data-fancybox="fancybox-carousel-<?= $bUID; ?>" data-src="<?= $item["img"]; ?>" data-thumb-src="<?= $item["img"]; ?>" style="background:url('<?=  $item["img"]; ?>');">
				<div class="img_gradient img_border w100h100p">
					<span class="img_label img_label_font img_label_hide"><?= $item["name"]; ?></span>
				</div>
				<!--img data-lazy-src="<?= $item["img"]; ?>" width="1920" height="1080" alt="Image #1" /-->
			</div>
		<?php endforeach; ?>
	</div>
</div>



<script>
Carousel(
	document.getElementById("<?= $bUID; ?>-mobile-carousel"),
	{
	// Your custom options
	},
	{
		Lazyload,
		Arrows,
		Thumbs,
	}
	).init();
</script>
<?php
//echo "<pre>"; var_dump($block); echo "</pre>";
?>
<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- END -->