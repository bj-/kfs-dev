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
	
	& .content { 
		display:flex; 
		gap:20px; 
		flex-direction: column;
		
		& .text {
			width: 100%;
		}
		& .form {
			width: 100%;
		}
	}
	
	/* CF7 */
	& .wpcf7 {
		
		& .form {
			display: flex;
			gap: 20px;
			width: 100%;
            flex-direction: row;

			& .name {
				width: calc(33% - 10px);

				& input {
					width: calc(100% - 50px);
					padding: 20px 0px 20px 50px;
					background: none;
					border: 1px solid #FFFFFF;
					color: #ffffff;
					font-size: 16px;
				}
			}
			& .phone {
				width: calc(33% - 10px);

				& input {
					width: calc(100% - 50px);
					padding: 20px 0px 20px 50px;
					background: none;
					border: 1px solid #FFFFFF;
					color: #ffffff;
					font-size: 16px;
				}
			}
			& .submit {
				width: calc(34% - 10px);

				& input {
					width: calc(100% - 50px);
					padding: 20px 0px 20px 0px;
					color: <?= $bender_settings["colors"]["button"]["text"] ?>;
					background: <?= $bender_settings["colors"]["button"]["bg"] ?>; 					
					
					
					font-size: 16px;
					cursor: pointer;
					transition: 0.3s;
					&:disabled {
						
						cursor: not-allowed;
						opacity: 0.3;
						transition: 0.3s;
					}
				}
			}
		}
		& .policy {
			width: 100%;
			& .cf7-private-policy-link {
				color: <?= $bender_settings["colors"]["link"]["color"] ?>;
			}
		}
	}

/*	
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
*/
}

/* Mobile breakpoint */
@media (max-width: 1200px) {
	#<?= $bUID; ?> { 

	}
}


/* Mobile breakpoint */
@media (max-width: 900px) {
	#<?= $bUID; ?> { 
		& .wpcf7 {
		
			& .form {
				flex-direction: column;
				& .name, & .phone, & .submit {
					width: 100%;
				}
				& .submit {
					& input {
						width: 100%;
					}
				}
			}
		}
	}
}

@media (max-width: 450px) {
	#<?= $bUID; ?> { 

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
			<div class="text">
				<?= $block["callback"]["title"]; ?>
			</div>
			<div class="form">
				<?= do_shortcode($block["callback"]["form"]); ?>
			</div>
		</div>
	</div>
</div>

<?php
//echo "<pre>"; var_dump($block); echo "</pre>";
?>
<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- END -->
