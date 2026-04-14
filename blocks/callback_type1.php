<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- START -->
<style>

#<?= $bUID; ?> { 
	position: relative; background-size: cover !important; background-position: center !important; height: fit-content;
	& .fade { <?= $fade_style ?> width: 100%; height: 100%; }

	& .content { display: flex; gap: 20px; flex-wrap: wrap; }
	& .item { display: flex; justify-content: center; align-items: center; height: 100%; flex-direction: column; flex: 1 1 0; min-width: 150px; }
	& .item > h2 { font-size: <?= $bender_settings["size"]["title"] ?>; color: <?= $title_color ?>; margin-top: 20px; margin-bottom: 20px; font-weight: normal;}
	& .form { margin-top: 20px; }

	/* CF7 */
	& .cf7-form-tel {background:none !important; border:1px solid #fff !important; border-radius:30px !important; padding: 15px 30px !important; margin-bottom:10px !important; color:#fff !important;}
	& .cf7-form-tel::placeholder { color: #AAA; opacity: 1; }
	& .cf7-form-send {font-weight:400 !important; color:rgb(152,152,152) !important;}
	& .wpcf7-submit {background:#eadc9e !important; border-radius:30px !important; width:100%; color:#000 !important; font-family: "Montserrat", sans-serif  !important; padding:15px 30px !important; font-size:20px !important; line-height:30px !important;}
	& .wpcf7-spinner {display:none !important;}
	& .cf7-form-accept {opacity:1 !important; display:none;}
	& .wpcf7-list-item-label {font-size:10px !important; line-height:12px !important; color:#fff;}

	& .cf7-form-tel, 
		.cf7-form-send {margin-bottom:20px !important;}

	& .cf7-form {display:flex; gap:20px;}
	& .cf7-form > div:nth-child(1n) {width:65%}
	& .cf7-form > div:nth-child(2n) {width:35%}	
}

/* Mobile breakpoint */
@media (max-width: 1000px) {
	#<?= $bUID; ?> { 
		& .content {flex-direction: column;}
	}
}

@media (max-width: 450px) {
	#<?= $bUID; ?> { 
		& .cf7-form { flex-direction: column; }
		& .cf7-form > div { width: 100%  !important; }
	    & .cf7-form-tel, .cf7-form-send { margin-bottom: 0px !important; }
	}
}
</style>


<div id="<?= $bUID ?>" class="wide" style="<?= $block["bg_style"] ?>" >
	<div class="fade">
	<div class="nowide" style="">
		<div style="padding-left:clamp(0px, 3vw, 50px); padding-right:clamp(0px, 3vw, 50px);">
			<div class="content">
				<div class="item">
					<h2 class="wow fadeInDown slower"><?= $block["title"] ?></h2>
				</div>
				<div class="item">
					<div class="form"><?php echo do_shortcode($block["callback_form"]); ?></div>
				</div>
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