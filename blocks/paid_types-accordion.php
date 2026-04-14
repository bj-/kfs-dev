<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- START -->
<style>
#<?= $bUID; ?> { 
	position: relative; background-size: cover !important; background-position: center !important; height: fit-content;
	& .fade { <?= $fade_style ?> width: 100%; height: 100%; }

	& .title {display:flex; gap:20px; margin-bottom: 40px;}
	& .title > h2 { font-size: <?= $bender_settings["size"]["title"] ?>; /*line-height: 80px; */ color: <?= $title_color ?>; margin-top: 20px; margin-bottom: 20px; font-weight: normal; }
	& .text,
		& .title > h2 { /* flex: 1 1 0; */ }
	& .text { font-size: 18px; line-height: 32px; }
	& .title,
		& .items {padding-left:clamp(0px, 3vw, 50px); padding-right:clamp(0px, 3vw, 50px); }

	& .accordion { margin: 0 auto; border-bottom:1px solid #ffffff; }
	& .accordion > section {border-top:1px solid #fff;}
	& .accordion__heading { display: block; position: relative; cursor: pointer; padding: clamp(7px, 1.2vw, 20px) 0px; margin: 0; color: white; font-weight:400; margin-bottom:-20px; }
	& .accordion__heading > h3 { margin: 5px 0 5px 0; padding-right: 60px; font-size: clamp(25px, 4.5vw, 45px);}
	& .accordion__heading:after, .accordion__heading:before { content: ""; position: absolute; top: 50%; right: 20px; background: white; transition: all 1s; width:40px; height:1px; }
	& .accordion__checkbox:checked~.accordion__heading:before { transform: rotate(90deg); opacity: 0; transition: all 1s; }
	& .accordion__heading:after { transform: rotate(90deg); transition: all 1s; }
	& .accordion__checkbox:checked~.accordion__heading:after { transform: rotate(180deg); }
	& .accordion__checkbox { display: none; position: absolute; left: -9999em; }
	& .accordion__checkbox:checked~.accordion__content { max-height: 1000px; transition: all 2s; }
	& .accordion__content { max-height: 0; overflow: hidden; padding: 0px; transition: all 0.5s; margin:clamp(5px, 3vw, 20px) 0 clamp(5px, 3vw, 20px) 5px;}
	& .accordion__content > p {max-width:800px;}
}

/* Mobile breakpoint */
@media (max-width: 1000px) {
	#<?= $bUID; ?> { 
		& .title {flex-direction: column; grid-gap:0px;}
	}
}
</style>

<div id="<?= $bUID; ?>" class="nowide" style="<?= $block["bg_style"] ?>">
	<div class="fade">
		<div class="title">
			<h2 class="<?= $block["title-effect"]["style"] ?>" <?= $block["title-effect"]["data"] ?>><?= $block['title'] ?></h2>
			<p class="text"><?= $block['text'] ?></p>
		</div>
		<div class="items">
			<?php foreach ($block["items"] as $key => $item ): ?>
				<div class="accordion">
					<section>
						<input type="checkbox" class="accordion__checkbox" id="accordion-heading-<?= $key ?>">
						<label class="accordion__heading" for="accordion-heading-<?= $key ?>">
							<h3><?= $item['title'] ?></h3>
						</label>
						<div class="accordion__content">
							<p><?= $item['text'] ?></p>
						</div>
					</section>        
				</div>
			<?php endforeach; ?>
		</div>
    </div>
</div>
<?php
//echo "<pre>"; var_dump($block); echo "</pre>";
?>
<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- END -->
