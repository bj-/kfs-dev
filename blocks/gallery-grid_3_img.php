<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- START -->
<style>
#<?= $bUID; ?> { 
	position: relative; background-size: cover !important; background-position: center !important; height: fit-content;
	& .fade { <?= $fade_style ?> width: 100%; height: 100%; }

	& .title {display:flex; grid-gap:20px;}
	& .title > h2 { font-size: <?= $bender_settings["size"]["title"] ?>; /*line-height: 80px; */ color: <?= $title_color ?>; margin-top: 20px; margin-bottom: 20px; font-weight: normal; }
	& .text, 
		& .title > h2 { flex: 1 1 0; }
	& .text { font-size: 18px; line-height: 32px; }
	& .title,
		& .grid {padding-left:clamp(0px, 3vw, 50px); padding-right:clamp(0px, 3vw, 50px); }
	& .grid { padding-top:40px; }
	& .img1, 
		& .img2,
		& .img3 { height:400px; background-size:cover !important; background-position:center !important; position:relative;	
		overflow: hidden; /* обрезает вылезающие края при увеличении */ 
	}
		
	& .img1 { width:100%; }
	& .img_link {position: absolute; width: 100%; height: 100%; text-decoration: none; color: #FFF; }
	& .img_link:hover {color: #FFF;}
	& .img23-grid { display:flex; gap:40px; padding-top:40px; }
	& .img2,
		& .img3 { width:calc(50% - 20px); }
	& .img_border { border-radius: clamp(12px, 3vw, 30px) }
	& .img_label { position:absolute; left:clamp(15px, 2vw, 30px); bottom:10px;  font-size: clamp(24px, 3vw, 38px); color: <?= $bender_settings["colors"]["img"]["label"] ?>; }
	& .img_gradient { background: linear-gradient(to bottom, <?= setAlpha($bender_settings["colors"]["img"]["bar"], 0.0); ?> 75%, <?= setAlpha($bender_settings["colors"]["img"]["bar"], 0.3); ?> 80%, <?= setAlpha($bender_settings["colors"]["img"]["bar"], 1); ?> 100%); } 

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
}

/* Mobile breakpoint */
@media (max-width: 1000px) {
	#<?= $bUID; ?> {
		& .title {flex-direction: column; grid-gap:0px;}
		& .img2,
			& .img3 { width:100%; }
		& .img23-grid {flex-direction: column;}
	}
}
</style>

<div id="<?= $blockID; ?>" class="nowide" style="<?= $block["bg_style"] ?>" >
	<div class="fade">
    <div class="title">
        <h2 class="wow fadeInDown slower" data-wow-offset="0"><?= $block['title'] ?></h2>
        <p class="text"><?= $block['text'] ?></p>
    </div>
    <div class="grid">
        <div class="img img1 img_border" style="background:url('<?php echo $block["gallery"][0]["img"]; ?>'); --bg-image:url('<?= $block["gallery"][0]["img"]; ?>'); " >
			<div class="<?= ($block["gallery"][0]["name"]) ? "img_gradient" : "" ?> img_border w100h100p">
				<a class="img_link fancybox-<?= $blockID; ?> curspointer" data-fancybox="fancybox-<?= $blockID; ?>" style="position:absolute; width:100%; height:100%" href="<?php echo $block["gallery"][0]["img"]; ?>">
					<span class="img_label img_label_font" style=""><?php echo $block["gallery"][0]["name"]; ?></span>
				</a>
			</div>
		</div>
        <div class="img23-grid">
            <div class="img img2 img_border" style="background:url('<?php echo $block["gallery"][1]["img"]; ?>');  --bg-image:url('<?= $block["gallery"][1]["img"]; ?>'); ">
				<div class="<?= ($block["gallery"][1]["name"]) ? "img_gradient" : "" ?> img_border w100h100p">
					<a class="img_link fancybox-<?= $blockID; ?> curspointer img_label_font" data-fancybox="fancybox-<?= $blockID; ?>" style="position:absolute; width:100%; height:100%" href="<?php echo $block["gallery"][1]["img"]; ?>">
					<span class="img_label img_label_font" style=""><?php echo $block["gallery"][1]["name"]; ?></span>
				</a>
				</div>
            </div>
            <div class="img img3 img_border" style="background:url('<?php echo $block["gallery"][2]["img"]; ?>');  --bg-image:url('<?= $block["gallery"][2]["img"]; ?>'); ">
				<div class="<?= ($block["gallery"][1]["name"]) ? "img_gradient" : "" ?> img_border w100h100p">
					<a class="img_link fancybox-<?= $blockID; ?> curspointer img_label_font" data-fancybox="fancybox-<?= $blockID; ?>" style="position:absolute; width:100%; height:100%" href="<?php echo $block["gallery"][2]["img"]; ?>">
					<span class="img_label img_label_font" style=""><?php echo $block["gallery"][2]["name"]; ?></span>
				</a>
				</div>
            </div>
        </div>
        <div style="display:none;">
            <?php 
			$i = 0;
			while ($block["gallery"][$i]["img"]):
            ?>
                <?php if ($i > 2) : ?>
                    <a class="fancybox-<?= $blockID; ?>" data-fancybox="fancybox-<?= $blockID; ?>" href="<?= $block["gallery"][$i]["img"] ?>">
						<img src="<?= $block["gallery"][$i]["img"] ?>" alt="<?= $block["gallery"][$i]["name"] ?>">
					</a>
                <?php endif; ?>
            <?php 
			$i++; 
			endwhile; 
			?>
        </div>
    </div>
	</div>
</div>


<script>
Fancybox.bind('.fancybox-<?= $blockID; ?>', {
	    adaptiveHeight: true
	});
</script>
<?php
//echo "<pre>"; var_dump($block); echo "</pre>";
?>
<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- END -->