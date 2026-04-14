<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- START -->
<style>
#<?= $bUID; ?> { 
	position: relative; height: fit-content;
	<?= ( $block['bg']['type'] == "img" ) ? "background-size: cover !important; background-position: center !important;" : ""; ?>
	<?= ( $block['bg']['type'] == "color" ) ? "background:" . $block['bg']['color'] . ";" : ""; ?>
	& .fade { <?= $fade_style ?> width: 100%; height: 100%; }

	& .title {display:flex; gap:20px; flex-direction:column;}
	& .title > h2 { 
		/* font-size: <?= $bender_settings["size"]["title"] ?>; */
		font-size: clamp(30px, 4vw, 60px);
		/*line-height: 80px; */ color: <?= $title_color ?>; margin-top: 20px; margin-bottom: 40px; font-weight: normal; }
	& .text,
		& .title > h2 { flex: 1 1 0; }
	& .text { font-size: 18px; line-height: 32px; }
	/* & .title,*/
	& .content { padding-left:clamp(0px, 3vw, 50px); padding-right:clamp(0px, 3vw, 50px); display:flex; gap:20px; align-items: baseline; }
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
		flex-direction: column;
		& .name {
			width: 100%;
			& input {
				width: calc(100% - 50px);
				padding: 20px 0px 20px 50px;
				background: none;
				border: 1px solid #FFFFFF;
				color: #ffffff;
				font-size: clamp(15px, 6vw, 28px);
			}
		}
		& .phone {
			width: 100%;
			& input {

			}
			& .cf7-form-tel {
				width: calc(100% - 50px);
				padding: 20px 0px 20px 50px;
				background:none; border:1px solid #fff; 
				/* border-radius:30px; */
				color:#fff;
				font-size: clamp(15px, 6vw, 28px);
			}
			& .cf7-form-tel::placeholder {
				color: #AAA; opacity: 1; 
			}
		}
		& .submit {
			width: 100%;
			& .cf7-form-send {
				width: calc(100% - 0px);
				/* padding:15px 30px; */ 
				padding: 20px 0px 20px 0px;
				font-weight:400; 
				color:rgb(0,0,0);
				background:#eadc9e; 
				/* border-radius:30px; */
				font-family: "Montserrat", sans-serif; 
				font-size: clamp(15px, 6vw, 28px);
				line-height:30px;
			}
		}
		& .policy {
			& .wpcf7-list-item-label {
				font-size:10px; 
				line-height:12px; 
				color:#fff;
			}			
		}
		& .wpcf7-spinner {
			display:none;
			position:absolute;
		}
	}
}

/* Mobile breakpoint */
@media (max-width: 1200px) {

}


/* Mobile breakpoint */
@media (max-width: 1000px) {
	#<?= $bUID; ?> { 
		& .title > h2 {
			font-size: clamp(30px, 8vw, 80px);
		}
		& .content {flex-direction: column; gap:0px;}
		& .content > div { width:100%; }
		& .right > iframe { max-height: 90vw; }
	}
}


</style>

<div id="<?= $bUID; ?>" class="nowide" style="<?= $block["bg_style"] ?>">
	<div class="fade">
		<div class="content">
			<div class="left">
				<div class="title">
					<h2 class="<?= $block["title-effect"]["style"] ?>" <?= $block["title-effect"]["data"] ?>><?= $block['title'] ?></h2>
				</div>
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
				<div class="title">
					<h2 class="<?= $block["title-effect"]["style"] ?>" <?= $block["title-effect"]["data"] ?>>
						<?= $block["callback"]["title"] ?>
					</h2>
				</div>
				<div>
					<?= do_shortcode($block["callback"]["form"]); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
//echo "<pre>"; var_dump($block); echo "</pre>";
?>
<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- END -->
