<?php 
/*
* Template Name: Тест
*/
get_header(); ?>
<div class="wrap">
<a class="galery6" data-fancybox="galery6" href="https://modernlake.ru/wp-content/uploads/2025/08/render-antara-3.jpg"><img src="https://modernlake.ru/wp-content/uploads/2025/08/render-antara-3.jpg" style="width:500px;"></a>
<a class="galery6" data-fancybox="galery6" href="https://modernlake.ru/wp-content/uploads/2025/08/render-antara-4.jpg"><img src="https://modernlake.ru/wp-content/uploads/2025/08/render-antara-4.jpg" style="width:500px;"></a>
</div>
    <div style="display:none;">
        <div id="asdasd">
            <img src="https://modernlake.ru/wp-content/uploads/2025/08/render-antara-3.jpg" style="width:500px;">
        </div>
    </div>
<script>
Fancybox.bind('.galery6', {
	    adaptiveHeight: true
	});
</script>
<?php while (have_rows('blok_10')) : the_row(); ?>

<div id="blok_10" style="display:none;">
    <!-- <h2 class="h2big wow bounceInLeft" data-wow-offset="0"><?= get_sub_field('zagolovok') ?></2>
    <h2 class="font-artist padding43 wow bounceInLeft" data-wow-offset="0"><?= get_sub_field('podzagolovok') ?></h2> -->
    <div class="wrap">
        <h2 class="wow bounceInLeft slower" data-wow-offset="0"><?= get_sub_field('zagolovok') ?></2>
        <h2 class="padding43 wow bounceInLeft slower" data-wow-offset="0"><?= get_sub_field('podzagolovok') ?></h2>
        
    <div style="text-align:center;"><img src="<?= get_sub_field('genplan') ?>" style="width:100%"></div>
    <center>
    <div id="info-infouch-mob">
        <div class="block-infouch">
            <div class="circle_color color_free"> </div>
            <div class="text_color">Свободен</div>
        </div>
        <div class="block-infouch">
            <div class="circle_color color_reserv"></div>
            <div class="text_color">Зарезервирован</div>
        </div>
        <div class="block-infouch">
            <div class="circle_color color_sold"></div>
            <div class="text_color">Продан</div>
        </div>
    </div>
    <div id="map">
        <div id="info-infouch">
            <div class="block-infouch">
                <div class="circle_color color_free"> </div>
                <div class="text_color">Свободен</div>
            </div>
            <div class="block-infouch">
                <div class="circle_color color_reserv"></div>
                <div class="text_color">Зарезервирован</div>
            </div>
            <div class="block-infouch">
                <div class="circle_color color_sold"></div>
                <div class="text_color">Продан</div>
            </div>
        </div>
        <!-- <div id="info-infouch2">    
            <?php if (get_sub_field('ssylka_aeroplan')) : ?>
            <a href="<?= get_sub_field('ssylka_aeroplan') ?>" class="button-aero" target=_blank><div>Генплан на аэропанораме</div></a>
            <?php endif; ?> -->
        </div>
     </div>
    <!-- <div id="info-infouch2-mob">    
            <?php if (get_sub_field('ssylka_aeroplan')) : ?>
            <a href="<?= get_sub_field('ssylka_aeroplan') ?>" class="button-aero" target=_blank><div>Генплан на аэропанораме</div></a>
            <?php endif; ?>
    </div> -->
    </center>
        <div class="b10-info">
        <div>
            <?php if (get_sub_field('ssylka_aeroplan')) : ?>
                <a href="<?= get_sub_field('ssylka_aeroplan') ?>" class="button-aero" target=_blank><div>Генплан на аэропанораме</div></a>
            <?php endif; ?>
        </div>
        <div>
            <?php if (get_sub_field('ssylka_genplan')) : ?>
                <a href="<?= get_sub_field('ssylka_genplan') ?>" class="button-aero" target=_blank><div>Генплан на схеме</div></a>
            <?php endif; ?>
        </div>
    </div>
    </div>
    <script  type="text/javascript">
        let bounds = [
            [0, 0], // padding
            [-1245, 1600], // image dimensions
        ];
        let map = L.map("map", {
            crs: L.CRS.Simple,
            maxZoom: 0,
            minZoom: -2,
            maxBounds: bounds,
        });
        L.imageOverlay("https://modernlake.ru/genplan/genplan7.jpg", bounds).addTo(map);
        map.fitBounds(bounds);
        let uchastkiinfo = [
		    <?php $i = 0;
		    while (have_rows('uchastki')) : the_row();
		    $i++; ?>
		        ['<span class="tooltip_nom_uch"><?= get_sub_field('nomer_uchastka') ?></span>','<?= get_sub_field('status') ?>',[<?= get_sub_field('koordinaty') ?>],"<span style='font-size:30px; line-height:40px;'>Участок <?= get_sub_field('nomer_uchastka') ?></span></br><?php if (get_sub_field('kartinka')) : ?><center><img src='<?= get_sub_field('kartinka') ?>' style='margin:20px 0;'></center><?php endif; ?><span style='font-size:18px; line-height:32px;'>Площадь: <strong><?= get_sub_field('ploshad') ?></strong></span></br><?php if (get_sub_field('proekt_doma')) : ?><span style='font-size:18px; line-height:32px;'>Проект дома: <strong><?= get_sub_field('proekt_doma') ?></strong></span></br><?php endif; ?><span style='font-size:18px; line-height:32px;'>Стоимость: <strong><?= get_sub_field('stoimost') ?></strong></span>"],
		    <?php endwhile; ?>
		];
		for (let i = 0; i < uchastkiinfo.length; i++) {
        const [nomer, status_uch, koordinat_uch, info] = uchastkiinfo[i];
        polygons = new L.polygon(koordinat_uch, {className: status_uch}).bindTooltip(info).addTo(map);
        markers = L.marker(polygons.getCenter(), {icon: new L.DivIcon({iconSize: [50,0], html: nomer})}).bindTooltip(info).addTo(map);
		};
window.onload = function() {
    if (window.innerWidth < 768) {
        map.setZoom(-2);
        map.setMinZoom(-2);
        map.setMaxZoom(-1);
    } else {
        map.setZoom(0);
        map.setMinZoom(0);
        map.setMaxZoom(0);
    };
};
</script>
</div>
<?php endwhile; ?>
<!-- Блок №10 конец -->    

<?php get_footer(); ?>
