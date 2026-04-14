<?php
//$site_settings

// TODO переделать главную на список блоков на самой главной.
$anchor = (@$blockInfo["anchor"]) ? @$blockInfo["anchor"] : @$bender_settings["blocks"][$bUID]["anchor"];
// После переделки оставить прдыдущую строку убрать и оставить следующую:
//$anchor = $blockInfo["anchor"];

//$anchor = $bender_settings["blocks"][$bUID]["anchor"];

$divID = ($anchor) ? "id='$anchor'" : "";
$divClass = (@$bUID != "first") ? "block_gap" : "";
?>
<div <?= $divID ?>></div>
<div class="<?= $divClass ?>" style="scroll-margin-top: 500px; /* height:unset; */">
<?php
//echo "Block: [" . $bUID . "], template: [" . $block["template"] . "]";
//echo "<pre>"; var_dump($bUID); echo "</pre>";
//echo "<pre>"; var_dump($site_settings); echo "</pre>";
//echo "<pre>"; var_dump($block); echo "</pre>";
?>
</div>
