<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- START -->
<style>
#<?= $bUID; ?> {
	position: relative; background-size: cover !important; background-position: center !important; height: fit-content;
	& .fade { <?= $fade_style ?> width: 100%; height: 100%; }
	& .content { display: flex; gap: 20px; padding-top: 50px; flex-wrap: wrap; }
	& .item { display: flex; justify-content: center; align-items: center; height: 100%; flex-direction: column; flex: 1 1 0; min-width: 150px; }
	& .num { font-size: clamp(70px, 10vw, 120px); line-height: 120px; font-weight: 400; text-align: center; padding-top: 10px; margin: 0px;}
	& .name {font-size: 30px; line-height: 40px; font-weight: 400; text-transform: uppercase; margin: 0px; text-align: center;}
	& .text {text-align: center; padding-top: 10px; margin: 0px; text-align: center;}
}


/* Mobile breakpoint */
@media (max-width: 1000px) {
	.nums1_item {flex: 1 1 calc(50% - 10px);}
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
  // Функция анимации счета
  function animateValue(element, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
      if (!startTimestamp) startTimestamp = timestamp;
      const progress = Math.min((timestamp - startTimestamp) / duration, 1);
      const value = Math.floor(progress * (end - start) + start);
      element.textContent = value;
      if (progress < 1) {
        window.requestAnimationFrame(step);
      } else {
        element.textContent = end; // Убедимся, что итоговое значение точное
      }
    };
    window.requestAnimationFrame(step);
  }

  // Найдём все элементы с id вида <?= $bUID; ?>-val*
  const numberElements = document.querySelectorAll('[id^="<?= $bUID; ?>-val"]');

  // Создадим IntersectionObserver
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const el = entry.target;
        // Если может быть нецелое число (например, 12.5) - замените parseInt на parseFloat и Math.floor на toFixed(1) или просто уберите округление.
		const finalValue = parseInt(el.textContent.trim(), 10);
        if (!isNaN(finalValue) && !el.hasAttribute('data-animated')) {
          el.setAttribute('data-animated', 'true');
          animateValue(el, 0, finalValue, 1500); // 1.5 секунды
        }
        observer.unobserve(el); // Опционально: отключить после первого срабатывания
      }
    });
  }, {
    threshold: 0.1 // Запускать, когда 10% элемента видно
  });

  // Наблюдаем за каждым элементом
  numberElements.forEach(el => {
    observer.observe(el);
  });
});
</script>
<div id="<?= $bUID; ?>" class="wide" style="<?= $block["bg_style"] ?>" >
	<div class="fade">
	<div class="nowide">
		<div style="padding-left:clamp(0px, 3vw, 50px); padding-right:clamp(0px, 3vw, 50px);">
			<div class="content">
				<?php 
					$i = 0;
					foreach ($block['items'] as $item): 
				?>
					<div class="item">
						<p id="<?= $bUID; ?>-val<?= $i ?>" class="num font-num"><?= $item["num"] ?></p>
						<p class="name font-title"><?= $item["name"] ?></p>
						<p class="text font-text"><?= $item["text"] ?></p>
					</div>
				<?php 
					$i++;
					endforeach; 
				?>
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