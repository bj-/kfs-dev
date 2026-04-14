<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- START -->

<style>

#<?= $bUID; ?> { 
	position: relative; background-size: cover !important; background-position: center !important; height: fit-content;
	& .fade { <?= $fade_style ?> width: 100%; height: 100%; }

	& .block { padding-left:clamp(0px, 3vw, 50px); padding-right:clamp(0px, 3vw, 50px); }
	& .title { display: flex; gap: 40px; /* padding-top: 50px; */ flex-direction: column; /*flex-wrap: wrap; */}
	& .title > h2 { font-size: <?= $bender_settings["size"]["title"] ?>; color: <?= $title_color ?>; margin-top: 20px; margin-bottom: 20px; font-weight: normal;}
	& .title > p { margin-top: 20px; font-weight: normal;}
	& .content { display: flex; gap: 20px; flex-wrap: wrap; align-items: center; }
	& .item { display: flex; justify-content: center; align-items: center; height: 100%; flex-direction: column; flex: 1 1 0; min-width: 150px; }
	& .item-left { align-items: baseline;}
	& .item-right { }
	& .nums { display: flex; gap:5px; align-items: baseline; flex-direction: column; }
	& .num { display: flex; gap:10px; flex-direction: row; }
	& .num-val {}
	& .num-name {}
	
	/* map */
	& .map { width: 100%; position: relative; }
	& .map > img { width: 100%; border-radius: 60px 0 60px 0; }
	& .map-animation {position: absolute; left: 0; top: 0;}
	& .poi { width: 100%; height: 100%; position: absolute; top: 0; left: 0;}
	& .poi-ico {background: none; border: 1px solid #000; box-shadow: 2px 2px #000; position: absolute; cursor: pointer; border-radius: 20px;}
	& .poi-name	{background: rgba(7, 15, 31, 0.85); position: absolute; }
	
	/* анимация появление подписей к POI */
	/* Плавное появление текста точек интереса */
	& .poi-name { 
		opacity: 0; 
		visibility: hidden; 
		/* Полное скрытие для доступности и производительности */
		transition: opacity 0.35s ease, visibility 0.35s ease;
		pointer-events: none;
		color: #fefff2;
		padding: 6px 12px;
		border-radius: 8px;
		white-space: nowrap;
		z-index: 20;
		font-size: 16px;
		line-height: 1.3;
		box-shadow: 0 2px 6px rgba(0, 0, 0, 0.25);
		}
	/* Показ текста при наведении на иконку ИЛИ на сам текст */
	& .poi-ico:hover + .poi-name,
	& .poi-name:hover {
		opacity: 1;
		visibility: visible;
		pointer-events: auto;
	}

	/* Дополнительно: улучшение внешнего вида иконок при наведении */
	& .poi-ico {
		transition: transform 0.25s ease, box-shadow 0.25s ease;
		will-change: transform;
	}
	& .poi-ico:hover {
		transform: scale(1.15);
		box-shadow: 0 4px 10px rgba(0, 0, 0, 0.35);
		z-index: 15;
	}	
}


/* Mobile breakpoint */
@media (max-width: 1000px) {
	#<?= $bUID; ?> { 
		& .content { flex-direction: column; align-items: baseline; gap: 40px;}
		& .title > h2 { margin-bottom: 0px; }
		& .title > p { margin-top: 0px; }
		& .item-right { width: 100%; }
	}
}
</style>

<div id="<?= $bUID ?>" class="wide" style="<?= $block["bg_style"] ?>" >
	<div class="fade">
	<div class="nowide">
		<div class="block">
			<div class="content">
				<div class="item item-left">
					<div class="title">
						<h2 class="wow fadeInDown slower"><?= $block["title"] ?></h2>
						<p>
							<?= $block["text"] ?>
						</p>
					</div>
					<div class="nums">
						<?php foreach ($block["nums"] as $key => $item): ?>
							<div class="num">
								<span class="num-val"><?= $item["num"] ?></span>
								<span class="num-name"><?= $item["name"] ?></span>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="item item-right">
					<div class="map">
						<img src="<?= $block["map"] ?>" />
						<img class="map-animation" src="<?= $block["animation"] ?>" />
						<div class="poi">
							<?php foreach ($block["poi"] as $key => $item): ?>
								<img id="<?= $bUID ?>-img-<?= $key ?>" class="poi-ico" style="top:<?= $item["ico_pos_y"] ?>%; left:<?= $item["ico_pos_x"] ?>%;" src="<?= $item["icon"] ?>" />
								<span id="<?= $bUID ?>-text-<?= $key ?>" class="poi-name" style="top:<?= $item["name_pos_y"] ?>%; left:<?= $item["name_pos_x"] ?>%;"><?= $item["name"] ?></span>
							<?php endforeach; ?>
						</div>
					</div>
					
				</div>
			</div>
		</div>
    </div>
    </div>
</div>
<?php
//echo "<pre>"; var_dump($block); echo "</pre>";
//if (is_array($header)) { echo "AAAAAAAAAAAAA";}
?>
<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- END -->