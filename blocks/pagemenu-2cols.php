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
	& .grid {
		padding-left:clamp(0px, 3vw, 50px); 
		padding-right:clamp(0px, 3vw, 50px); 
		margin-top: 40px;
		overflow: hidden; 
		display:flex; 
		/* height: 790px; */
		gap: 20px;
		flex-wrap: wrap;
		
		& .img { 
			position: relative; 
			width: calc(50% - 10px); 
			height: clamp(200px, 38vw, 650px);
			background-size:cover !important; background-position:center !important; 
			overflow: hidden;
			background: none !important;
			
			* {
				position: relative; z-index: 1; 
			}

			/* Анимация scale фона через псевдоэлемент */
			&::before {
					content: '';
					position: absolute;
					top: 0;
					left: 0;
					width: 100%;
					height: 100%;
					background-size: cover;
					background-position: center;
					/* Копируем инлайновый фон через CSS */
					background-image: var(--bg-image);
					transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
					will-change: transform;
					z-index: 0;
				}
			&:hover::before { 
				transform: scale(1.15); 
				}
			/* Анимация scale фона END */
	
			/* Затемняющий оверлей */
			&::after {
				content: '';
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background: rgba(7, 15, 31, 0.5); /* Цвет затемнения */
				opacity: 1;
				transition: 0.6s ease;
				/* z-index: 1; */
				pointer-events: none; /* Чтобы клик проходил сквозь оверлей */
			}
			&:hover::after {
				background: rgba(7, 15, 31, 0.1); /* Цвет затемнения */
				transition: 0.6s ease;
			}
			
			& .link {
				position: absolute; width: 100%; height: 100%; /* кликабельная область */
				opacity: 1;
				transition: 1s ease;
				&:hover {
					opacity: 0;
					transition: 0.5s ease;
				}
			}
			
			& .label { 
				position:absolute; 
				font-size: clamp(24px, 4vw, 50px); 
				color: <?= $bender_settings["colors"]["img"]["label"] ?>; 
				font-weight: 400;
				line-height: clamp(24px, 4vw, 70px); 
				left: 50% ;
				bottom: 50%;
				transform: translate(-50%, 50%) !important;
				width: 90%;
				max-width: 90%;
				/* text-align: center; */
				padding: 0 20px;
				color: #0DFF84; /* Требуемый цвет подписи */
			}		
		}
	}


	/* Custom img and text decoration */
	& .border { 
		/* border-radius: clamp(12px, 3vw, 30px) */ 
	}
	& .img_gradient { 
		background: unset;
	} 

	
	/* === Только текст. без картинки === */
	& .menu-text {
		background-size:cover !important; background-position:center !important; position: relative; 
		overflow: hidden;
		background: rgb(7, 30, 56);
		
		&::before {
			z-index: 0;
		}
		/* Затемняющий оверлей */
		&::after {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: rgba(7, 15, 31, 0.5); /* Цвет затемнения */
			opacity: 1;
			transition: opacity 0.6s ease;
			/* z-index: 1; */
			pointer-events: none; /* Чтобы клик проходил сквозь оверлей */
		}
		&:hover {
			background-color: rgba(1, 150, 245, 1); /* Фон при наведении */
			transition: 1.0s ease;
			& .label {
				color: #000 !important; /* Черный текст при наведении */
				transition: 0.6s ease;
			}
		}
		&:hover::after {
			background: rgba(1, 150, 245, 1); /* Цвет затемнения */
			transition: 1.0s ease;
			
		}

		& .link {
			position: absolute; width: 100%; height: 100%; /* кликабельная область */
		}
		
		& .label { 
			position:absolute; 
			font-size: clamp(24px, 3vw, 50px); 
			color: <?= $bender_settings["colors"]["img"]["label"] ?>; 
			font-weight: 400;
			line-height: clamp(24px, 4vw, 70px); 
			left: 50% ;
			bottom: 50%;
			transform: translate(-50%, 50%) !important;
			width: 90%;
			max-width: 90%;
			/* text-align: center; */
			padding: 0 20px;
			
		}		

	}	
	& .menu-text > * { position: relative; z-index: 1; }
}

/* Mobile breakpoint */
@media (max-width: 1200px) {
	#<?= $bUID; ?> { 
		& .title {flex-direction: column; grid-gap:0px;}
	}
}

@media (max-width: 900px) {
	#<?= $bUID; ?> { 
		& .grid {
			gap: 10px; 
			flex-direction: column; 
			height: unset;
			& .img {
				width: 100%; 
				height: clamp(200px, 38vw, 650px); 
				& .label { 
					text-align: center; 
				}
			}
			& .menu-text { 
				width:100%; 
				height: clamp(40px, 20vw, 100px); 
				background-color: rgba(1, 150, 245, 1); 
			}
		}
		
	}
}
@media (max-width: 350px) {
	#<?= $bUID; ?> { 
	}
}

<?= $block["custom"]["styles"] ?>
</style>

<div id="<?= $bUID; ?>" class="nowide" style="<?= $block["bg_style"] ?>">
	<div class="fade">
		<div class="title">
			<h2 class="<?= $block["title-effect"]["style"] ?>" <?= $block["title-effect"]["data"] ?>><?= $block['title'] ?></h2>
			<p class="text"><?= $block['text'] ?></p>
		</div>
		<div class="grid">
			<?php foreach ( $block["items"] as $key => $item ): ?>
				<div class="img" style="background:url('<?= $item["bg"]["img"]; ?>'); --bg-image:url('<?= $item["bg"]["img"]; ?>'); ">
					<div class="<?= ($item["name"]) ? "img_gradient" : "" ?> border w100h100p">
						<a class="link curspointer" style="" href="<?php echo @$item["link"]["page"]; ?>">
							<span class="label" style="text-align: center;"><?php echo @$item["name"]; ?></span>
						</a>
					</div>
				</div>			
			<?php endforeach ?>
			<!-- TODO Текстовая плашка 
				<div class="menu-text border" style="">
					<div class="<?= ($item["name"]) ? "img_gradient" : "" ?> border w100h100p">
						<a class="link curspointer" style="" href="<?php echo @$item["link"]["page"]; ?>">
							<span class="label" style=""><?php echo @$item["name"]; ?></span>
						</a>
					</div>
				</div>
			-->
		</div>
	</div>
</div>

<?php
//echo "<pre>"; var_dump($block); echo "</pre>";
?>
<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- END -->