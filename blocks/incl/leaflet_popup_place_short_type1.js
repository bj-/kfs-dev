<?php $currentFileName = 'leaflet_popup_place_short_type1'; ?>
function <?= $currentFileName; ?>(data){

	let id		= (data && data?.ID) ? data.ID : 'none';
	let ico		= (data && data?.ico) ? data.ico : '';
	let title	= (data && data?.name) ? data.name : 'Участок';
	let status	= (data && data?.status) ? data.status : 'none';
	let statusText	= (data && data?.status) ? getStatusText(data.status) : 'none';
	let desc	= (data && data?.desc) ? data.desc : '';

	let square	= data.square ? `<span class="label">Площадь участка: <span class="value">${data.square} сот.</span></span>` : "";
	let price	= (data && data?.price) ? `<span class="label">Стоимость: <span class="value">от ${data.price} ₽</span></span>` : '';
	
	let projectName	= (data && data?.projects?.[0]?.name ) ? data.projects[0].name : '';
	let projectSquare	= (data && data?.projects?.[0]?.square ) ? data.projects[0].square : '';
	let projectlink	= (data && data?.projects?.[0]?.link ) ? data.projects[0].link : '';
	let project = ''
	if (projectName) {
		project = `<span class="label">Проект дома: <span class="value">`;
		project += (projectlink) ? `<a href='${projectlink}' class="project-link">` : '';
		project += projectName;
		project += (projectSquare) ? `, ${projectSquare} м кв.` : '';
		project += (projectlink) ? `</a>` : '';
		project += `</span></span>`;

	}
	let interiorName	= (data && data?.interior?.[0]?.name ) ? data.interior[0].name : '';
	let interiorlink	= (data && data?.interior?.[0]?.link ) ? data.interior[0].link : '';
	let interior = ''
	if (interiorName) {
		interior = `<span class="label">Комплектация отделки: <span class="value">`;
		interior += (interiorlink) ? `<a href='${interiorlink}' class="interior-link">` : '';
		interior += interiorName;
		interior += (interiorlink) ? `</a>` : '';
		interior += `</span></span>`;

	}

	let imgUrl	= (data && data?.gallery?.[0]?.img ) ? data.gallery[0].img : '';
	let imgName	= (data && data?.gallery?.[0]?.name ) ? data.gallery[0].name : '';
	let img = '';
	if (imgName) {
		img += `
			<div class="popup-img" style="background:url('${imgUrl}'); background-size: cover; background-position: center; height: 150px;">
				<div class='img_gradient w100h100p'>
					<div class="img-label">
						${imgName}
					</div>
				</div>
			</div>`;
	}
	
	let content = `
		<div class="popup-content popup-content-short">
			<div class="popup-title popup-title-short">
				<h3>${title}</h3>
			</div>
			<div class="popup-status">
				<span class="status ${status}">${statusText}</span>
			</div>
		</div>
	`;
	
	return content;
}
window.<?= $currentFileName; ?> = <?= $currentFileName; ?>;