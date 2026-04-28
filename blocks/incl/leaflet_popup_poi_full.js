<?php $currentFileName = 'leaflet_popup_poi_full'; ?>
function <?= $currentFileName; ?>(data){
	//console.log('leaflet_popup_place_full_type1');

	// style
	let popupClass = (data && data?.gallery?.[0]?.img) ? 'popup-poi-content' : 'popup-poi-content-short';

	let id		= (data && data?.ID) ? data.ID : 'none';
	let ico		= (data && data?.ico) ? data.ico : '';
	let title	= (data && data?.name) ? data.name : 'Маркер';

	let desc	= (data && data?.desc) ? data.desc : '';
	if (desc) {
		desc = `
		<div class="popup-poi-desc">
				<span class="desc">${desc}</span>
			</div>
			`;
	}
	let olink = (data && data?.olink) ? data.olink : '';

	//console.log('[DBG] olink: ' + olink);

	// gallery
	let gallery = [];
	let galleryHtml = '';
	if ( data && data?.gallery?.[1]?.img )
	{
		data.gallery.forEach((item, index) => {
			let img = ( item.img ) ? item.img : '';
			let name  = ( item.name ) ? item.name : '';

			let galleryItem = `<div class="f-carousel__slide area_gallery_item" data-fancybox="fancybox-carousel-<?= $bUID; ?>-poi-${id}" data-src="${item.img}" data-thumb-src="${item.img}" style="background:url('${item.img}');height: 200px;">`;
			
			if (name){
				galleryItem += `
				<div class="img_gradient img_border w100h100p">
					<span class="img_label img_label_font img_label_hide">${name}</span>
				</div>
				`;
			}
			galleryItem += `</div>`;

			gallery.push(galleryItem);
		});
		
	}
	if ( gallery.length ){
		galleryHtml += `<div class="<?= $bUID; ?>-poi-carousel-class" id="carousel-<?= $bUID; ?>-poi-${id}" style="height:200px;">`;
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
				<div class="popup-poi-img" style="background:url('${imgUrl}'); ">
				`;
			img += (olink) ? `<a href='${olink}' class="link">` : '';

			if ( imgName ){
				img += `<div class='img_gradient w100h100p'>`;
				img += `
							<div class="img-label">
								${imgName}
							</div>`;
				img += `
						</div>
						`;
			}
			img += (olink) ? `</a>` : '';
			img += `</div>`;
		}
	}
	
	let content = `
		<div class="${popupClass}">
			<div class="popup-poi-title">
				<h3>${title}</h3>
			</div>
			${desc}
			${galleryHtml}
			${img}
		</div>
	`;
	
	return content;
}
window.<?= $currentFileName; ?> = <?= $currentFileName; ?>;