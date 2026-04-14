<?php

$genplan_areas = convertToLeafletArrayPlace($block["areas"], $block["view"]["shift"], $block["area_prefix"]);
$genplan_poi = convertToLeafletArrayPOI($block["poi"], $block["view"]["shift"]);
$genplan_orders = convertToLeafletArrayOrders($block["orders"], $block["view"]["shift"]);

?>

ЗАГЛУШКА для проверки корректности встраивания

<style>

#<?= $bUID; ?>_map {
    width: 100%;
    height: 000px;
    border-radius: 8px;
	background-color: <?= $bender_settings["colors"]["site"]["bg"] ?>;
}

</style>
<div style="color:black;">
	<table border="1">
		<tr>
			<td>
				bUID
			</td>
			<td>
				<?= $bUID; ?>
			</td>
		</tr>
		<tr>
			<td>
				img
			</td>
			<td>
				<?= $block["img"]["url"]; ?>
			</td>
		</tr>
		<tr>
			<td>
				genplan_areas
			</td>
			<td>
				<?= count($genplan_areas); ?>
				<?php //echo "<pre>"; var_dump($genplan_areas); echo "</pre>"; ?>
			</td>
		</tr>
		<tr>
			<td>
				genplan_poi
			</td>
			<td>
				<?= count($genplan_poi); ?>
				<?php //echo "<pre>"; var_dump($genplan_poi); echo "</pre>"; ?>
			</td>
		</tr>
		<tr>
			<td>
				genplan_orders
			</td>
			<td>
				<?= count($genplan_orders); ?>
				<?php //echo "<pre>"; var_dump($genplan_orders); echo "</pre>"; ?>
			</td>
		</tr>
		<tr>
			<td>
				settings
			</td>
			<td>
				<?= count($bender_settings); ?>
				<?php //echo "<pre>"; var_dump($bender_settings); echo "</pre>"; ?>
			</td>
		</tr>
		<tr>
			<td>
				block data
			</td>
			<td>
				<?= count($block); ?>
				<?php //echo "<pre>"; var_dump($block); echo "</pre>"; ?>
			</td>
		</tr>
	</table>

<div id="<?= $bUID; ?>_map" class="map-bg bg-container"></div>


<script>
var map=null;
(function(){
const _w=<?= $block["img"]["width"]; ?>,_h=<?= $block["img"]["height"]; ?>,_u='<?= $block["img"]["url"]; ?>',_b=[[0,0],[_h,_w]],_z=0;
map=L.map("<?= $bUID; ?>_map",{crs:L.CRS.Simple,maxZoom:2,minZoom:-1,maxBounds:_b});
L.imageOverlay(_u,_b).addTo(map);map.fitBounds(_b);
let _vy=0.5,_vx=0.5;
map.setView([_h*_vy,_w*_vx],_z);
L.polygon([[100,100],[100,300],[250,280],[220,120]],{color:'blue',weight:2,opacity:.8,fillColor:'#3388ff',fillOpacity:.3}).addTo(map).bindPopup("Полигон");
L.marker([180,200]).addTo(map).bindPopup("POI");
})();

</script>


</div>