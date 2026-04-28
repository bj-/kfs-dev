<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- START -->
<link rel="stylesheet" href="/scripts/cocoen/cocoen.css">
<script src="/scripts/cocoen/cocoen2.js"></script>

<style>
#<?= $bUID; ?> { 
	position: relative; background-size: cover !important; background-position: center !important; height: fit-content;
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
	}

	& .grid { 
		padding-top:40px; 
		padding-left:clamp(0px, 3vw, 50px); 
		padding-right:clamp(0px, 3vw, 50px);
		& .img_border { }
		& .img_gradient { } 
		& .img_label_font {}
		& .img_label_hide {}
		& .item { background-size: cover !important; background-position: center !important; }

		& .carousel { /* height: 70vw; */ }
	}
	& .img1 { height:400px; background-size:cover !important; background-position:center !important; position:relative;	
		overflow: hidden; /* обрезает вылезающие края при увеличении */ 
	}
		
	& .img1 { width:100%; }
	& .img_link {position: absolute; width: 100%; height: 100%; text-decoration: none; color: #FFF; }
	& .img_link:hover {color: #FFF;}
	& .img_label { position:absolute; left:clamp(15px, 2vw, 30px); bottom:10px;  font-size: clamp(24px, 3vw, 38px); color: <?= $bender_settings["colors"]["img"]["label"] ?>; }
	
	& .legend {
		position: relative;
		display: flex;
		justify-content: space-between;
		padding: 10px 15px;
		background-image: linear-gradient(to right, #0196F5, #0DFF84);
		
		& .label {
			color: #081123;
			font-size: clamp(18px, 3vw, 32px);
			font-weight: 500;
		}
	}

	& .bottom-bar {
		height: 52px; background-image: linear-gradient(to right, #0196F5, #0DFF84); position:relative;
		& h3 {
			margin:0;
			font-size: 32px;
			line-height: 42px;
		}
		& .span-left, & .span-right {position:absolute; padding:5px 20px; color:#081123;}
		& .span-left {left:0;}
		& .span-right {right:0;}

	}

	/* === Before/After Slider v2 === */
	/* Контейнер блока */
	& .before-after {
		position: relative;
		width: 100%;
		aspect-ratio: 1.5; /* или ваше значение */
		overflow: hidden;
		user-select: none;
		touch-action: none; /* ← важно: запрещает браузерный скролл внутри */
		background: #000;
	}

	/* Обёртка изображений */
	& .ba-images {
		position: relative;
		width: 100%;
		height: 100%;
	}

	/* Изображения */
	& .ba-images img {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		object-fit: cover;
		pointer-events: none; /* ← чтобы картинки не мешали драгу */
	}

	/* "До" — поверх, обрезается через clip-path */
	&  .ba-before {
		clip-path: polygon(0 0, 50% 0, 50% 100%, 0 100%);
		z-index: 2;
	}

	/* Ползунок */
	& .slider-bar {
		position: absolute;
		top: 0;
		left: 50%;
		width: 3px;
		height: 100%;
		background: rgb(1, 150, 245);
		z-index: 3;
		transform: translateX(-50%);
		cursor: ew-resize;
	}

	/* Кнопка на ползунке */
	& .slider-button {
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		width: 40px;
		height: 40px;
		background: rgb(1, 150, 245);
		border-radius: 50%;
		box-shadow: 0 2px 10px rgba(0,0,0,0.3);
		display: flex;
		align-items: center;
		justify-content: center;
	}

	/* Стрелочки внутри кнопки */
	& .slider-button::before {
		content: "⟷";
		color: #081123;
		font-size: 16px;
		font-weight: bold;
	}
}



/* Mobile breakpoint */
@media (max-width: 1000px) {
	#<?= $bUID; ?> {
		& .title {flex-direction: column; grid-gap:0px;}

	}
}


/* Адаптив */
@media (max-width: 768px) {
  #<?= $bUID; ?>-carousel .before-after { aspect-ratio: 1.2; }
  #<?= $bUID; ?>-carousel .slider-button { width: 32px; height: 32px; }
}


<?php 
/*
	$x = "
	#blok-kartinki {
		& .container {
			position: relative;
			margin: auto;
			max-width: 1500px;
		max-height: 1000px;
			text-align: center;
			padding:30px 0;
			height: 66vw;
		}
		& cocoen-component::part(drag) {
			background: #0196F5;
		}
		& cocoen-component::part(drag)::before {
			border:none;
			border-color: #0196F5;
			height:34px;
			width:34px;
			background-image: url("/img/img-drag.png");
			border-radius:17px;
			content:'';
		}
		  
	}
	";
*/
?>
</style>


<div id="<?= $blockID; ?>" class="nowide" style="<?= $block["bg_style"] ?>" >
	<div class="fade">
		<div class="title">
			<h2 class="wow fadeInDown slower" data-wow-offset="0"><?= $block['title'] ?></h2>
			<p class="text"><?= $block['text'] ?></p>
		</div>
		<div class="grid">
			<div class="carousel" id="<?= $bUID; ?>-carousel">
				  <!-- v0 One + Cocoen -->
				  <!--div>
					<cocoen-component>
						<picture slot="before" >
							<img src="<?= $block["gallery"][0]["img_before"]; ?>" alt="" loading="lazy" width="1600" class="img"  style="">
						</picture>
						<picture slot="after" >
							<img src="<?= $block["gallery"][0]["img_after"]; ?>" alt="" loading="lazy" width="1600" class="img" >
						</picture>
					</cocoen-component>
				  </div-->


				<!-- v2 -->
				<?php foreach ($block["gallery"] as $item ): ?>
				  <div class="f-carousel__slide">
					<div class="before-after" data-ba-initialized="false">
					  <!-- Контейнер с изображениями -->
					  <div class="ba-images">
						<img class="ba-after" src="<?= $item["img_after"]; ?>" alt="After" loading="lazy">
						<img class="ba-before" src="<?= $item["img_before"]; ?>" alt="Before" loading="lazy">
					  </div>
					  
					  <!-- Ползунок -->
					  <div class="slider-bar" aria-label="Перетащите для сравнения">
						<div class="slider-button"></div>
					  </div>
					  
					</div>
				  </div>
				<?php endforeach; ?>


			</div>
			<div class="bottom-bar">
				<h3 class="span-left">БЫЛО</h3>
				<h3 class="span-right">СТАЛО</h3>
			</div>			
		</div>
	</div>
</div>

<script>

// v2
document.addEventListener("DOMContentLoaded", () => {
  const MOBILE_BREAKPOINT = 768;

  // Функция инициализации одного блока
  function initBeforeAfter(block) {
    if (block.dataset.baInitialized === "true") return;
    block.dataset.baInitialized = "true";

    const sliderBar = block.querySelector(".slider-bar");
    const beforeImage = block.querySelector(".ba-before");
    const container = block;
    
    let isDragging = false;

    function updateSlider(clientX) {
      const rect = container.getBoundingClientRect();
      let percent = ((clientX - rect.left) / rect.width) * 100;
      percent = Math.max(0, Math.min(100, percent));
      
      beforeImage.style.clipPath = `polygon(0 0, ${percent}% 0, ${percent}% 100%, 0 100%)`;
      sliderBar.style.left = `${percent}%`;
    }

    function onMove(e) {
      if (!isDragging) return;
      e.stopPropagation();
      
      const clientX = e.type.includes('touch') ? e.touches[0].clientX : e.clientX;
      updateSlider(clientX);
    }

    function onStart(e) {
      isDragging = true;
      e.stopPropagation();
      
      if (e.type.includes('touch')) {
        e.preventDefault();
      }
    }

    function onEnd() {
      isDragging = false;
    }

    // Слушатели
    sliderBar.addEventListener("mousedown", onStart);
    sliderBar.addEventListener("touchstart", onStart, { passive: false });
    
    document.addEventListener("mousemove", onMove, { passive: false });
    document.addEventListener("touchmove", onMove, { passive: false });
    document.addEventListener("mouseup", onEnd);
    document.addEventListener("touchend", onEnd);
    
    container.addEventListener("contextmenu", e => e.preventDefault());
  }

  // === Интеграция с каруселью ===
  const carouselEl = document.getElementById("<?= $bUID; ?>-carousel");
  
  if (carouselEl && typeof Carousel !== 'undefined') {
    // Инициализация карусели
    const carousel = Carousel(carouselEl, {
      gestures: false,
      Panzoom: { 
        touch: true,
        panOnlyZoomed: true
      }
    }, { Lazyload, Arrows, Thumbs }).init();

    // Инициализируем before-after через небольшую задержку
    // чтобы карусель успела отрендериться
    setTimeout(() => {
      document.querySelectorAll('#<?= $bUID; ?>-carousel .before-after').forEach(initBeforeAfter);
    }, 10);
    
    // И при смене слайда
    carousel.on('change', () => {
      setTimeout(() => {
        document.querySelectorAll('#<?= $bUID; ?>-carousel .before-after[data-ba-initialized="false"]').forEach(initBeforeAfter);
      }, 10);
    });
    
  } else {
    // Без карусели
    document.querySelectorAll('.before-after').forEach(initBeforeAfter);
  }
});

</script>

<?php
//echo "<pre>"; var_dump($block); echo "</pre>";
?>
<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- END -->