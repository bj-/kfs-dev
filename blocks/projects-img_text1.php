<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- START -->
<style>
#<?= $bUID; ?> { 
	position: relative; 
	background-size: cover !important; 
	background-position: center !important; 
	height: fit-content;
	
	& .fade { 
		<?= $fade_style ?> 
		width: 100%; 
		height: 100%; 
	}	
	& .title {
		display:flex; 
		gap:20px;
		margin-left:clamp(0px, 3vw, 50px); 
		margin-right:clamp(0px, 3vw, 50px); 
		background-size: cover !important; 
		background-position: center !important; 
		height: clamp(200px, 33vw, 500px);
		align-items: center;
		position: relative;

		&::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			/* background-color: rgba(0, 0, 0, 0.3); */
			<?= $fade_style ?> 
			padding-top: unset;
			padding-bottom: unset;
			z-index: 1;
			pointer-events: none;
		}
		
		& h2, 
		& .text {
			position: relative;
			z-index: 2;
		}
		
		& h2 { 
			/* font-size: <?= $bender_settings["size"]["title"] ?>;  */
			font-size: clamp(20px, 8vw, 85px);
			color: <?= $title_color ?>; 
			margin-top: 20px; 
			margin-bottom: 20px; 
			font-weight: normal; 
			text-align: center;
			width: 100%;
			font-weight: 400;
		}
		& .text { 
			font-size: 18px; 
			line-height: 32px; 
		}
	}
	& .content {
		padding-left:clamp(0px, 3vw, 50px); 
		padding-right:clamp(0px, 3vw, 50px); 
		display:flex; 
		flex-direction: column;
		gap: 0px;
		
		& .item:nth-child(odd) {
			flex-direction: row;
			
			& .desc {
				background-color: rgba(1, 150, 245, 0.2);
			}
				
		}
		& .item:nth-child(even) {
			flex-direction: row-reverse;
			
			& .desc {
				background-color: rgba(13, 255, 132, 0.2);
			}
		}
		& .item {
			display: flex;
			gap: 0px;
			/* height: clamp(200px, 27vw, 450px); */
			height: fit-content;

			& .desc {
				width: 45%;
				display: flex;
				align-items: center;
				padding-bottom: 40px;
				padding-top: 20px;
				& .text {
					display: flex;
					flex-direction: column;
					font-size: 16px;
					margin-left: 10%;
					margin-right: 10%;

					& h3 {
						margin-bottom: 30px;
						font-size: 32px;
					}
					& .goals {
						margin-bottom: 10px;
					}
					& .results{
						margin-left: 30px;
					}
					& a {
						color: <?= $bender_settings["colors"]["link"]["color"] ?>;
					}
						
				}
			}
			& .gallery {
				width: 55%;
				aspect-ratio: 16 / 9;
				/* height: fit-content; */
				min-height: 100%;
				
				& .f-carousel {
					height:100%;
					& .f-carousel__slide {
						background-size: cover !important; 
						background-position: center !important; 
					}

					  --f-arrow-pos: 10px;

					  --f-arrow-width: 45px;
					  --f-arrow-height: 45px;

					  --f-arrow-svg-width: 20px;
					  --f-arrow-svg-height: 20px;
					  --f-arrow-svg-stroke-width: 5;

					  --f-arrow-color: #475569;
					  --f-arrow-shadow: 0 6px 12px -2px rgb(50 50 93 / 25%), 0 3px 7px -3px rgb(0 0
							  0 / 30%);

					  --f-arrow-border-radius: 50%;
					  --f-arrow-bg: rgba(255, 255, 255, 0.5); /* #fff; */
					  --f-arrow-hover-bg: #f9f9f9;
					  --f-arrow-active-bg: #f0f0f0;
		  
		  


				}
			}
		}
		& .gallery {
		}
	}
	

}



/* Mobile breakpoint */
@media (max-width: 1200px) {
	#<?= $bUID; ?> { 
		
	}
}

@media (max-width: 900px) {
	#<?= $bUID; ?> { 
		& .title {
			margin-left:clamp(0px, 3vw, 50px); 
			margin-right:clamp(0px, 3vw, 50px); 
		}
		& .content {
			padding-left:clamp(0px, 3vw, 50px); 
			padding-right:clamp(0px, 3vw, 50px); 
			display:flex; 
			flex-direction: column;
			gap: 0px;
			
			& .item {
				& .desc {
					width: 100%;
					min-height: clamp(200px, 35vw, 300px);
				}
				& .gallery {
					width: 100%;
				}
			}
			
			& .item:nth-child(odd) {
				flex-direction: column;
					
			}
			& .item:nth-child(even) {
				flex-direction: column;
			}

			
		}
	}
}


</style>


<div id="<?= $bUID; ?>" class="nowide" style="">
	<div class="fade">
		<div class="title" style="<?= $block["bg_style"] ?>">
			<h2 class="<?= $block["title-effect"]["style"] ?>" <?= $block["title-effect"]["data"] ?>><?= $block['title'] ?></h2>
			<!--p class="text"><?= $block['text'] ?></p-->
		</div>
		<div class="content">
			<?php foreach ( $block["items"] as $key => $item ): ?>
			<div class="item">
				<div class="desc">
					<div class="text">
						<h3>
							<?= $item["title"]; ?>
						</h3>
						<div class="goals">
							<?= $item["goals"]["title"]; ?>
							<?php 
							if ( is_array($item["goals"]["items"] )):
								foreach ( $item["goals"]["items"] as $keyGoal => $itemGoal ): 
							?>
							<?= $itemGoal["text"]; ?>
							<?php 
								endforeach;
							endif;?>
						</div>
						<div class="results">
							<ul>
								<?php 
								if ( is_array($item["result"]["items"] )):
									foreach ( $item["result"]["items"] as $keyResult => $itemResult ): 
								?>
								<li>
									<?= @$itemResult["text"]; ?>
								</li>
								<?php 
									endforeach; 
								endif;
								?>
							</ul>
						</div>
					</div>
				</div>
				<div class="gallery">
					<div class="<?= $bUID; ?>-area-carousel-class" id="carousel-<?= $bUID; ?>-area-<?= $key; ?>">
						<?php foreach ( $item["gallery"] as $keyGallery => $itemGallery ): ?>
							<?php if ($itemGallery["type"] == "img"): ?>
								<div class="f-carousel__slide area_gallery_item" data-fancybox="fancybox-carousel-<?= $bUID; ?>-area-<?= $key; ?>" data-src="<?= $itemGallery["img"]; ?>" data-thumb-src="<?= $itemGallery["img"]; ?>" style="background:url('<?= $itemGallery["img"]; ?>');">
									<div class="img_border w100h100p">
										<span class="img-label">
											<!--a href='${projectlink}' class="link"-->
												<!-- name -->
											<!--/a-->
										</span>
									</div>
								</div>
							<?php elseif ($itemGallery["type"] == "video"): ?>
								<div class="f-carousel__slide area_gallery_item" data-fancybox="fancybox-carousel-<?= $bUID; ?>-area-<?= $key; ?>">
									<?= $itemGallery["video"]; ?>
								</div>
							<?php endif; ?>

						<?php endforeach; ?>
					</div>
					<script>
					
					setTimeout(() => {
						projectsCarouselInit('carousel-<?= $bUID; ?>-area-<?= $key; ?>');
					}, 300);
					</script>

				</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</div>

<script>

function projectsCarouselInit(id){
	Carousel(
		document.getElementById(id),
		{
			/*
			Autoscroll: {
				speed : 3,
				speedOnHover: 1
			},
			style: {
				//"--f-progressbar-color": "rgb(231,76,60)",
				//"--f-progressbar-height": "3px",
				//"--f-carousel-gap": "10px",
			},
			*/
		// Your custom options
		},
		{
			Lazyload,
			Arrows,
			//Dots,
			//Autoscroll,
			//Autoplay
		},
		//style: {
			//"--f-progressbar-color": "#111",
			//"--f-progressbar-height": "2px",
		//},
		).init();
}

</script>

<?php
//echo "<pre>"; var_dump($block); echo "</pre>";
?>
<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- END -->



