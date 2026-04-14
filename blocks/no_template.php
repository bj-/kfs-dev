<!-- Block: No_Template, type: none -- START -->
<div class="nowide">
    <h2 style="color: <?= $title_color ?>; font-size: <?= $bender_settings["size"]["title"] ?>;"><?= @$block["title"] ?></h2>
    <p>Выбранный шаблон отсутствует: Выберите существующий шаблон</p>
	<p>Block: [<?= @$bUID; ?>], шаблон [<?= (@$block["template"]) ? @$block["template"] : "[Шаблон не выбран]"; ?>]</p>
</div>
<?php
//echo "<pre>"; var_dump($block); echo "</pre>";
?>
<!-- Block: No_Template, type: none -- END -->