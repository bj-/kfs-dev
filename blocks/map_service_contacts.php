<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- START -->
<style>
#<?= $bUID; ?> { 
	position: relative; height: fit-content;
	<?= ( $block['bg']['type'] == "img" ) ? "background-size: cover !important; background-position: center !important;" : ""; ?>
	<?= ( $block['bg']['type'] == "color" ) ? "background:" . $block['bg']['color'] . ";" : ""; ?>
	& .fade { <?= $fade_style ?> width: 100%; height: 100%; }

	& .title {display:flex; gap:20px; flex-direction:column;}
	& .title > h2 { font-size: <?= $bender_settings["size"]["title"] ?>; /*line-height: 80px; */ color: <?= $title_color ?>; margin-top: 20px; margin-bottom: 20px; font-weight: normal; }
	& .text,
		& .title > h2 { flex: 1 1 0; }
	& .text { font-size: 18px; line-height: 32px; }
	/* & .title,*/
	& .content {padding-left:clamp(0px, 3vw, 50px); padding-right:clamp(0px, 3vw, 50px); }
	
	& .content { display:flex; gap:20px; align-items: center; }
	& .content > div { width:50%; }
	& .left {padding-bottom: 50px;}
	& .items { display:flex; gap:20px; flex-direction:column;}
	& .item { display:flex; gap:20px; }
	& .item > img { max-width: 38px; }
	& .right { <?= ($block["filter"]) ? "filter: " . $block["filter"] . ";" : ""; ?> }
	& .right > iframe { max-height: 40vw;  }

}

/* Mobile breakpoint */
@media (max-width: 1000px) {
	#<?= $bUID; ?> { 
		& .content {flex-direction: column; gap:0px;}
		& .content > div { width:100%; }
		& .right > iframe { max-height: 90vw; }
	}
}
</style>

<div id="<?= $bUID; ?>" class="nowide" style="<?= $block["bg_style"] ?>">
	<div class="fade">
    <div class="content">
		<div class="left">
			<div class="title">
				<h2 class="<?= $block['options']['wow_style']['wow_block_title'] ?>" data-wow-offset="<?= $block['options']['wow_style']['data-wow-offset'] ?>"><?= $block['title'] ?></h2>
				<p class="text"><?= $block['text'] ?></p>
			</div>
			<div class="items">
				<?php foreach ($block["icons"] as $key => $item ): ?>
					<div class="item">
						<img src="<?= $item['icon'] ?>" alt="<?= $item['name'] ?>"/>
						<a class="link_color" href="<?= $item['link'] ?>"><?= $item['name'] ?></a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="right">
			<?= $block['map_code'] ?>
		</div>
	</div>
	</div>
</div>

<?php
//echo "<pre>"; var_dump($block); echo "</pre>";
?>
<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- END -->
