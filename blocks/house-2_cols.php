<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- START -->
<style>
#<?= $bUID; ?> { 
	position: relative; background-size: cover !important; background-position: center !important;
	& .fade { <?= $fade_style ?> width: 100%; height: 100%; }

	
	& .title {display:flex; grid-gap:20px; margin-bottom: 40px;}
	& .title > h2 { font-size: <?= $bender_settings["size"]["title"] ?>; color: <?= $title_color ?>; margin-top: 20px; margin-bottom: 20px; font-weight: normal; }
	& .text, 
		& .title > h2 { flex: 1 1 0; }
		
	& .text { font-size: 18px; line-height: 32px;}
	& .title {padding-left:clamp(0px, 3vw, 50px); padding-right:clamp(0px, 3vw, 50px); }

	& .grid { display: flex; gap: 20px; flex-wrap: wrap; }
	& .item { position: relative; cursor: pointer; background-size: cover !important; background-position: center !important; 
			width: calc(50% - 10px); height: 540px;
			overflow: hidden; /* КРИТИЧЕСКИ ВАЖНО: обрезает вылезающие края при увеличении */
			/* backface-visibility: hidden;
			transform: translateZ(0); */
	}
	/* Custom: Анимация scale фона через псевдоэлемент */
	& .item { background: none !important; /* убираем фон с родителя */ }
	& .item::before {
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
		transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
		will-change: transform;
		z-index: 0;
	}
	& .item:hover::before { transform: scale(1.15); }
	& .item > * { position: relative; z-index: 1; }
	/* Custom END */


	& .item > h3 {position: absolute; left: clamp(20px, 2.3vw, 40px); bottom: clamp(20px, 2.3vw, 40px); margin: 0; font-size: clamp(30px, 5vw, 46px); line-height: 40px; color: <?= $bender_settings["colors"]["img"]["label"] ?>;}
	& .item-infobar { position: absolute; top:0px; right:0px; height:100%; background: <?= $bender_settings["colors"]["img"]["bar"] ?>;
							display: flex; align-items: center; justify-content: center; width: clamp(130px, 11.1vw, 200px); flex-direction: column; gap: 10px; }
	& .item-infobar > div > p {margin:0px; font-weight: 300; color: #ffffff; letter-spacing: 0;} 
	& .item-infobar p:nth-child(2n) { font-weight: 600; }


	/* Custom: img decoration */
	& .item { border-radius: 60px 0 60px 0; }
	& .item-infobar { border-radius: 0 0 60px 0; }
	& .fade_house { background: rgba(7, 15, 31, 0.3); position: absolute; top: 0; width: 100%; height: 100%; }
	/* Custom END */
}

.<?= $bUID; ?>-popup {background:none; padding: 1rem;}

[<?= $bUID; ?>_popup] {
	& .obj-img { width: clamp(100px, 86vw, 1500px); height: clamp(100px, 80vw, 900px); position: relative;}
	& .obj-item_gallery { position: absolute; top: 0; width: clamp(100px, 86vw, 1500px); height: clamp(100px, 80vw, 900px);}
	& .obj-fade { background: rgba(7, 15, 31, 0.3); position: absolute; top: 0; width: 100%; height: 100%; }

	/* house details */
	& .obj-popup {background:none; padding: 1rem;}
	& .obj-popup-title {position: absolute; top: 0; margin: clamp(5px, 5vw, 40px); font-size:clamp(20px, 8vw, 85px);}
	& .obj-item-infobar_bottom { position: absolute; bottom:0px; left:0px; width:100%; background: <?= $bender_settings["colors"]["img"]["bar"] ?>;
							display: flex; align-items: center; height: clamp(60px, 6.7vw, 110px); flex-direction: row; gap: clamp(10px, 3vw, 40px); padding-left: clamp(1px, 3vw, 40px);}
	& .obj-item-infobar_bottom_col, 
		& .obj-item-prop_detail {display:flex; gap:clamp(10px, 3vw, 20px);}
	& .obj-item-prop_detail {flex-wrap: wrap;}
	& .obj-item-infobar_bottom_col > p,
		& .obj-item-prop_detail > p {margin:0px; font-weight: 300; color: #ffffff; letter-spacing: 0;} 
	& .obj-item-infobar_bottom_col > p:nth-child(2n),
		& .obj-item-prop_detail > p:nth-child(2n) { font-weight: 600; }

	& .obj-item-prop_detail > p:nth-child(1n) {display:inline-block; width:calc(70% - 10px);}
	& .obj-item-prop_detail > p:nth-child(2n) {display:inline-block; width:calc(30% - 10px);}

	& .obj-item-desc {display:flex; gap:20px; flex-direction: row; width: clamp(100px, 86vw, 1500px); background: <?= $bender_settings["colors"]["site"]["bg"] ?>; padding-left: clamp(10px, 2.4vw, 40px); padding-right: clamp(10px, 2.4vw, 40px);}
	& .obj-item-prop {display:inline-block; /*gap:20px; flex-direction: column; */ width:calc(50% - 10px);}
	& .obj-item-prop > h3,
	& .obj-item-plan-floor_name { margin: 40px 0 30px 0; display:flex; gap:20px; flex-wrap: wrap; align-items: flex-start; }
	& .obj-item-plan {display:flex; gap:20px; flex-direction: column; width:calc(50% - 10px);}
	& .obj-item-plan-floor_container { position: relative; height: clamp(100px, 55vw, 600px); min-height: 100px; }
	& .obj-item-plan-floor-btn { border:1px solid #fff; border-radius:30px; color:#fff; cursor:pointer; padding:10px 40px;}
	& .obj-item-plan-floor_img { position: absolute; top: 0; left: 0; width: 100%; opacity: 0; visibility: hidden; transition: opacity 0.4s ease, visibility 0.4s ease; }
	& .obj-item-plan-floor_img.active { opacity: 1; visibility: visible; }
}

/* Mobile breakpoint */
@media (max-width: 1000px) {
	#<?= $bUID; ?> {
		& .title {flex-direction: column; grid-gap:0px;}
		& .item { width: 100%; height: clamp(285px, 50vw, 483px); }
		& .item-infobar { width: clamp(110px, 23vw, 200px);}
	}
	
	[<?= $bUID; ?>_popup] {
		& .obj-item-desc {flex-direction: column-reverse;}
		& .obj-item-prop,
		& .obj-item-plan {width:100%;}
	}
}
/* Mobile breakpoint */
@media (max-width: 500px) {
	[<?= $bUID; ?>_popup] {
		& .obj-item-infobar_bottom { height: clamp(45px, 16vw, 110px); gap: clamp(5px, 5vw, 40px);}
		& .obj-item-infobar_bottom_col {flex-direction:column; gap:1px; align-items: center; justify-content: center;}
		& .obj-item-infobar_bottom_col > p {font-size: clamp(10px, 5vw, 18px); } 
		}
}

.invert {
  filter: invert(1) !important;
  -webkit-filter: invert(1) !important;
}

</style>

<div id="<?= $bUID; ?>" class="wide" style="<?= $block["bg_style"] ?>" >
	<div class="fade">
		<div class="nowide">
			<div class="title">
				<h2 class="wow fadeInDown slower" data-wow-offset="0"><?= $block['title'] ?></h2>
				<?php if($block['text']): ?>
				<p class="text"><?= $block['text'] ?></p>
				<?php endif; ?>
			</div>
			<div style="padding-left:clamp(0px, 3vw, 50px); padding-right:clamp(0px, 3vw, 50px);">
				<div class="grid">
						<?php foreach ($block["houses"] as $key => $item): ?>
						<div class="item" style="background:url('<?= $item["img"]; ?>'); --bg-image:url('<?= $item["img"]; ?>'); ">
							<div class="fade_house"></div>
							<h3><?= $item["name"]; ?></h3>
							<div class="item-infobar">
								<div>
									<p>Площадь</p>
									<p><?= $item["square"] ?> м²</p>
									<p style="margin-top:20px;">Спальни</p>
									<p><?= $item["rooms"] ?></p>
									<p style="margin-top:20px;">Этажность</p>
									<p><?= $item["floors"] ?></p>
								</div>
							</div>
							<a class="fancybox-<?= $bUID; ?>-item<?= $key; ?>" data-fancybox href="#<?= $bUID; ?>-item_popup-<?= $key; ?>" style="position:absolute; top:0; left:0; width:100%; height:100%;"></a>
						</div>
						<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
	<div id="<?= $bUID; ?>_popup" class="houses-popups-container">
        <?php 
		foreach ($block["houses"] as $key => $item):
        ?>
	        <div class="<?= $bUID; ?>-popup" id="<?= $bUID; ?>-item_popup-<?= $key; ?>" style="display: none;" <?= $bUID; ?>_popup>
				<div class="obj-img">
					<div class="<?= $bUID; ?>-slick-house<?= $key; ?>">
						<?php foreach ($item["gallery"] as $gal_key => $gal_item): ?>
							<div class="obj-item_gallery" style="background:url(<?= $gal_item["img"]; ?>); background-size: cover; background-position: center !important;"></div>
						<?php endforeach; ?>
					</div>					
					<div class="obj-fade"></div>
					<h3 class="obj-popup-title"><?= $item["name"]; ?></h3>
					<div class="obj-item-infobar_bottom">
						<div class="obj-item-infobar_bottom_col">
							<p>Площадь</p>
							<p><?= $item["square"] ?> м²</p>
						</div>
						<div class="obj-item-infobar_bottom_col">
							<p>Спальни</p>
							<p><?= $item["rooms"] ?></p>
						</div>
						<div class="obj-item-infobar_bottom_col">
							<p>Этажность</p>
							<p><?= $item["floors"] ?></p>
						</div>
					</div>
				</div>
				<div class="obj-item-desc">
					<div class="obj-item-prop">
						<h3>Технические Характеристики</h3>
						<div class="obj-item-prop_detail">
							<p>Габариты дома</p>
							<p><?= $item["size"]; ?></p>
							<p>Общая площадь</p>
							<p><?= $item["square"]; ?></p>
							<p>Количество этажей</p>
							<p><?= $item["floors"]; ?></p>
							<p>Количество комнат</p>
							<p><?= $item["rooms"]; ?></p>
							<p>Количество санузлов</p>
							<p><?= $item["sanitary"]; ?></p>
							<p>Стоимость</p>
							<p><?= $item["price"]; ?></p>
						</div>
					</div>
					<div class="obj-item-plan">
                        <div class="obj-item-plan-floor_name">
                            <?php 
							foreach ( $item["gallery_plan"] as $key_plan => $item_plan): 
							$btn_active = ($key_plan == 0) ? "btn-active" : "";
							?>
								<div id="<?= $bUID; ?>-item<?= $key; ?>-floor_name<?= $key_plan; ?>" class="obj-item-plan-floor-btn <?= $btn_active; ?>" onclick="show_floor('<?= $bUID; ?>', <?= $key; ?>,<?= $key_plan; ?>)"><?= $item_plan["name"]; ?></div>
                            <?php endforeach; ?>
                        </div>    
						<div class="obj-item-plan-floor_container">
							<?php 
								foreach ( $item["gallery_plan"] as $key_plan => $item_plan): 
								//$show_first_floor = ($key_plan == 0) ? "display: block;" : "";
								$show_first_floor = ($key_plan == 0) ? "opacity: 1; visibility: visible;" : "";
								$show_first_floor = "";
								$show_first_floor_class = ($key_plan == 0) ? "active" : "";
							?>
								<div id="<?= $bUID; ?>-item<?= $key; ?>-floor<?= $key_plan; ?>" class="obj-item-plan-floor_img <?= $show_first_floor_class; ?>" style="<?= $show_first_floor; ?>">
									<a class="fancybox-<?= $bUID; ?>-item<?= $key; ?>-plan" data-fancybox="fancybox-<?= $bUID; ?>-item<?= $key; ?>-plan" href="<?= $item_plan["img"]; ?>" >
										<img class="invert" src="<?= $item_plan["img"]; ?>" alt="<?= $item_plan["description"]; ?>" style="width:100%;">
									</a>
								</div>
                            <?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
        <?php 
		endforeach; 
		?>
    </div>
</div>


<script>
<?php foreach ($block["houses"] as $key => $item): ?>
Fancybox.bind('.fancybox-<?= $bUID; ?>-item<?= $key; ?>', {
    adaptiveHeight: true,
	on: {
		ready: (fancybox) => {
			console.log('Попап дома <?= $key; ?> открыт:');
			initSlickSlider('.<?= $bUID; ?>-slick-house<?= $key; ?>');
		},
		// Дополнительная страховка (на случай асинхронных задержек)
		afterClose: (fancybox) => {
			// Принудительно снимаем фокус со слайдера, если он "застрял"
			const activeEl = document.activeElement;
			if (activeEl?.closest('.fancybox__container') && activeEl?.matches('.slick-arrow, .slick-dots button')) {
				activeEl.blur();
			}
			
			// Уничтожаем слайдер при закрытии, чтобы избежать конфликтов
			if ($('.<?= $bUID; ?>-slick-house<?= $key; ?>').hasClass('slick-initialized')) {
				$('.<?= $bUID; ?>-slick-house<?= $key; ?>').slick('unslick');
			}
		}
	}
});

Fancybox.bind('.fancybox-<?= $bUID; ?>-item<?= $key; ?>-plan', {
    adaptiveHeight: true,
    dragToClose: true,
    on: {
        ready: (fancybox) => {
            // Применяем инверсию к текущему слайду
            const applyInvert = () => {
                const images = document.querySelectorAll('.fancybox__slide.is-selected .f-panzoom__viewport .f-panzoom__content');
                images.forEach(img => {
                    img.classList.add('invert');
                });
            };
            
            // Применяем сразу и постоянно проверяем (для переключения слайдов)
            applyInvert();
            const interval = setInterval(applyInvert, 200);
            
            // Очищаем интервал при закрытии попапа
            fancybox.on('destroy', () => {
                clearInterval(interval);
            });
        }
    }
});
<?php endforeach; ?>

function show_floor (blockName, houseId, floorIndex)
{
	//alert ('blockName: .${blockName}' + ' house: ' + itemIndex + ' floor: ' + floorIndex);
    const prefix = `${blockName}-item${houseId}`;

    // 1. Убираем btn-active у всех кнопок этого дома
    document.querySelectorAll(`[id^="${prefix}-floor_name"]`).forEach(btn => {
        btn.classList.remove('btn-active');
    });

    // 2. Делаем активной нажатую кнопку
    const activeBtn = document.getElementById(`${prefix}-floor_name${floorIndex}`);
    if (activeBtn) {
        activeBtn.classList.add('btn-active');
    }

    // 3. Убираем класс 'active' у всех планов этого дома
    document.querySelectorAll(`[id^="${prefix}-floor"]`).forEach(el => {
        if (!el.id.includes('-floor_name')) {
            el.classList.remove('active');
        }
    });

    // 4. Добавляем 'active' к нужному плану
    const targetFloor = document.getElementById(`${prefix}-floor${floorIndex}`);
    if (targetFloor) {
        targetFloor.classList.add('active');
    }	
}
</script>

<?php
//echo "<pre>"; var_dump($block); echo "</pre>";
?>
<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- END -->