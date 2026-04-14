<?php $currentFileName = 'leaflet_popup_poi_simple'; ?>
function <?= $currentFileName; ?>(data){

	// style
	let popupClass = (data && data?.gallery?.[0]?.img) ? 'popup-poi-content' : 'popup-poi-content-short';

	let title	= (data && data?.name) ? data.name : 'POI';

	let content = `
		<div class="${popupClass}">
			<div class="popup-poi-title">
				<h3>${title}</h3>
			</div>
		</div>
	`;
	return content;
}
window.<?= $currentFileName; ?> = <?= $currentFileName; ?>;