<!-- Block: <?= $bUID; ?>, template: <?= $block["template_checked"] ?> -- START -->
<style>
#<?= $bUID; ?> { 
	position: relative; background-size: cover !important; background-position: center !important; height: fit-content;
	& .fade { <?= $fade_style ?> width: 100%; height: 100%; }

	& .block { padding-left:clamp(0px, 3vw, 50px); padding-right:clamp(0px, 3vw, 50px); }
	& .title > h2 { font-size: <?= $bender_settings["size"]["title"] ?>; color: <?= $title_color ?>; margin-top: 20px; margin-bottom: 20px; font-weight: normal;}
	& .content { display: flex; gap: 20px; padding-top: 50px; flex-wrap: wrap; }
	& .item { display: flex; justify-content: center; align-items: center; height: 100%; flex-direction: column; flex: 1 1 0; min-width: 240px; }
	& .item > img { max-width: 64px; }
	& .item-title { font-size: 30px; line-height: 40px; font-weight: 400; }
	& .item-text { font-weight: 300; text-align: center; }

/* Mobile breakpoint */
@media (max-width: 1000px) {
	#<?= $bUID; ?> { 
		& .content { flex-direction: column; align-items: baseline; gap: 40px;}
		& .block > h2 { margin-bottom: 0px; }
	}
}
</style>

<div id="<?= $bUID ?>" class="wide" style="background: url(<?= $block['bg'] ?>);" >
	<div class="fade">
		<div class="nowide">
			<div class="block">
				<div class="title">
					<h2 class="<?= $block["title-effect"]["style"] ?>" <?= $block["title-effect"]["data"] ?>><?= $block["title"] ?></h2>
				</div>
				<div class="content">
					<?php foreach ($block["icons"] as $key => $item): ?>
					<div class="item">
						<img src="<?= $item["icon"] ?>" />
						<p class="item-title"><?= $item["name"] ?></p>
						<p class="item-text"><?= $item["text"] ?></p>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
//echo "<pre>"; var_dump($block); echo "</pre>";
//echo "<pre>"; var_dump($bender_settings["title_style"]); echo "</pre>";
//if (is_array($header)) { echo "AAAAAAAAAAAAA";}
?>
<!-- Block: <?= $bUID; ?>, template: <?= $block["template_checked"] ?> -- END -->