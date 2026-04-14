<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- START -->
<style>
#<?= $bUID; ?> { 
	position: relative; height: fit-content;
	<?= ( $block['bg']['type'] == "img" ) ? "background-size: cover !important; background-position: center !important;" : ""; ?>
	<?= ( $block['bg']['type'] == "color" ) ? "background:" . $block['bg']['color'] . ";" : ""; ?>
	& .fade { <?= $fade_style ?> width: 100%; height: 100%; }

	& .title {display:flex; gap:20px; flex-direction:column;}
	& .title > h2 { font-size: <?= $bender_settings["size"]["title"] ?>; /*line-height: 80px; */ color: <?= $title_color ?>; margin-top: 20px; margin-bottom: 20px; font-weight: normal; }
	& .text,
		& .title > h2 { flex: 1 1 0; }
	& .text { font-size: 18px; line-height: 32px; }
	/* & .title,*/
	& .title, .content {padding-left:clamp(0px, 3vw, 50px); padding-right:clamp(0px, 3vw, 50px); }
	
	& .content { display:flex; gap:20px; align-items: center; }
	& .content > div { width:50%; }
	& .left {padding-bottom: 50px;}
	& .items { display:flex; gap:20px; flex-direction:column;}
	& .item { display:flex; gap:20px; }
	& .item > img { max-width: 38px; }
	& .right {  }
	& .form { margin-top: 20px; }

	/* CF7 */
	& .cf7-form {
		display:flex; 
		gap:20px;
		align-items: center;
	}
	& .cf7-form > div:nth-child(1n) {
		width:65%;
		& .cf7-form-tel {
			width: calc(100% - 60px);
			padding: 15px 30px; 
			background:none; border:1px solid #fff; border-radius:30px; color:#fff;
			}
		& .cf7-form-tel::placeholder { color: #AAA; opacity: 1; }
		}
	& .cf7-form > div:nth-child(2n) {
		width:35%;
		& .cf7-form-send {
			width: calc(100% - 60px);
			padding:15px 30px;
			font-weight:400; 
			color:rgb(0,0,0);
			background:#eadc9e; 
			border-radius:30px; 
			font-family: "Montserrat", sans-serif; 
			font-size:20px; 
			line-height:30px;
		}
	}
	& .wpcf7-spinner {
		display:none;
		position:absolute;
	}
	& .wpcf7-list-item-label {
		font-size:10px; 
		line-height:12px; 
		color:#fff;}
	/* & .cf7-form-accept {opacity:1 !important; display:none;} */

	/*
	& .cf7-form-tel, 
		.cf7-form-send {margin-bottom:20px;}
	*/
}

/* Mobile breakpoint */
@media (max-width: 1200px) {
	#<?= $bUID; ?> { 
		& .cf7-form { 
			flex-direction:column; 
			gap: 0px;
			& div { width:100% !important; }
		}
	}
}


/* Mobile breakpoint */
@media (max-width: 1000px) {
	#<?= $bUID; ?> { 
		& .content {flex-direction: column; gap:0px;}
		& .content > div { width:100%; }
		& .right > iframe { max-height: 90vw; }
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

<div id="<?= $bUID; ?>" class="nowide" style="<?= $block["bg_style"] ?>">
	<div class="fade">
		<div class="title">
			<h2 class="<?= $block["title-effect"]["style"] ?>" <?= $block["title-effect"]["data"] ?>><?= $block['title'] ?></h2>
			<p class="text"><?= $block['text'] ?></p>
		</div>
		<div class="content">
			<div class="left">
				<div class="items">
					<?php foreach ($block["icons"] as $key => $item ): ?>
						<div class="item">
							<img src="<?= $item['icon'] ?>" alt="<?= $item['name'] ?>"/>
							<a class="link_color" href="<?= $item['link'] ?>"><?= $item['name'] ?></a>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="right">
				<?= do_shortcode($block["callback"]["form"]); ?>
			</div>
		</div>
	</div>
</div>

<?php
//echo "<pre>"; var_dump($block); echo "</pre>";
?>
<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- END -->
