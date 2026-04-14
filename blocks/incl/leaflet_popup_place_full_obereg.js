<?php $currentFileName = 'leaflet_popup_place_full_obereg'; ?>
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
	
	let interiors = [];
	if ( data && data?.interior?.[0]?.name )
	{
		data.interior.forEach((item, index) => {
			let aStart = (data?.interior?.[index]?.link ) ? '<a href="' + data.interior[index].link + '">' : '';
			let aEnd = (data?.interior?.[index]?.link ) ? '</a>' : '';
			let interiorItem = `${aStart}${item.name}${aEnd}`;
			interiors.push(interiorItem);
		});
	}
	
	let interior = ''
	if (interiorName) {
		interior = `<span class="label">Комплектация отделки: <span class="value">`;
		interior += interiors.join(', ');
		interior += `</span></span>`;
	}

	// gallery
	let gallery = [];
	let galleryHtml = '';
	if ( data && data?.gallery?.[1]?.img )
	{
		data.gallery.forEach((item, index) => {
			let img = ( item.img ) ? item.img : '';
			let name  = ( item.name ) ? item.name : '';

			let galleryItem = `<div class="f-carousel__slide area_gallery_item" data-fancybox="fancybox-carousel-<?= $bUID; ?>-area-${id}" data-src="${item.img}" data-thumb-src="${item.img}" style="background:url('${item.img}');     height: 200px;">`;
			if (name){
				galleryItem += `
				<div class="img_gradient img_border w100h100p">
					<span class="img-label">${name}</span>
				</div>
				`;
			}
			galleryItem += `</div>`;

			gallery.push(galleryItem);
		});
		
	}
	if ( gallery.length ){
		galleryHtml += `<div class="<?= $bUID; ?>-area-carousel-class" id="carousel-<?= $bUID; ?>-area-${id}" style="height:200px;">`;
		galleryHtml += gallery.join('');
		galleryHtml += `</div>`;
	}

	gallery = [];
	galleryHtml = '';

	// only one img
	let img = '';
	if ( gallery.length == 0 ){
		let imgUrl	= (data && data?.gallery?.[0]?.img ) ? data.gallery[0].img : '';
		let imgName	= (data && data?.gallery?.[0]?.name ) ? data.gallery[0].name : '';
		if (imgUrl) {
			img += `
				<div class="popup-img" style="background:url('${imgUrl}'); ">
				`;
			if ( imgName ){
				img += `<div class='img_gradient w100h100p'>
							<div class="img-label">
								${imgName}
							</div>
						</div>
						`;
			}
			img += `</div>`;
		}
	}
	
	let content = `
		<div class="popup-content">
			<div class="popup-title">
				<h3>${title}</h3>
				<span>
					<!--button class="map-section__info-btn btn btn--accent" data-place-num="${title}">Узнать условия</button-->
					<button class="map-section__info-btn btn btn--accent" data-micromodal-trigger="modal-callback">Узнать условия</button>
				</span>
			</div>
			<div class="popup-status">
				<span class="status ${status}">${statusText}</span>
				<span class="desc">${desc}</span>
			</div>
			<div class="popup-prop">
				${square}
				${interior}
				${price}
				${project}
			</div>
			
			${galleryHtml}
			${img}
			
		</div>
		`;
	
	return content;
}
window.<?= $currentFileName; ?> = <?= $currentFileName; ?>;