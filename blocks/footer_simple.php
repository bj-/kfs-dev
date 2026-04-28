<!-- Block: footer, template: <?= $block["template"]; ?> -- START -->
<style>
/* Footer */
#footer { 
	position: relative; /* background-size: cover !important; background-position: center !important;*/

	& .footer {
		display:flex; align-items: center; padding-top: 15px; padding-bottom:15px; padding-left: clamp(0px, 3vw, 50px); padding-right: clamp(0px, 3vw, 50px); gap: clamp(10px, 3vw, 30px); justify-content: space-between; 
		height:100px;
		margin: auto;
		max-width: 1700px;
	}
	& .logo {}
	& .logo > a > img {max-height:80px; filter: invert(1);}
	& .menu-content {display:flex; gap:30px;}
	& .menu { display:flex; gap:30px; align-items: center; }

	& .phone-desktop {
		display: flex;
		align-items: center;
	}
	& .phone-mobile { 
		display:none; width:clamp(28px, 7vw, 35px); height: clamp(28px, 7vw, 35px);
		& a { width:clamp(28px, 7vw, 35px); height:clamp(28px, 7vw, 35px); }
		& img { height: 100%; width: 100%; }
	}
	& .messengers { 
		display:flex; gap:30px; height:clamp(28px, 7vw, 35px);
		& a { width:clamp(28px, 7vw, 35px); height:clamp(28px, 7vw, 35px); }
		& img { height: 100%; width: 100%; }
	}
	
	& .copyright {display:flex; padding-top: 30px; padding-bottom:30px; padding-left: clamp(0px, 3vw, 50px); padding-right: clamp(0px, 3vw, 50px); flex-direction: column; }
	
}

/* Mobile breakpoint */
@media (max-width: 1000px) {
	#footer {
		& .phone-desktop { display: none !important; }
		& .phone-mobile { display: flex; }
	}
}

/* Mobile breakpoint */
@media (max-width: 800px) {
	#footer {
		& .menu { display: none !important; }
	}
}

/* Optional: адаптивность под ещё меньшие экраны */
@media (max-width: 350px) {
	#footer {
		& .menu-content,
			& .messengers { gap: 12px; }
	}
}

</style>

<div id="footer" class="wide">
	<div class="footer">
		<div class="logo">
			<a href="/">
				<img src="<?= $bender_settings["company"]['logo'] ?>" alt="<?= htmlspecialchars(str_replace('"', '', $bender_settings["company"]['name'])) ?>" />
			</a>
		</div>
		<div class="menu-content">
            <div class="menu">
				<?php foreach ($bender_settings["menu"] as $item): ?>
					<a class="link_color" href="/<?= $item['link'] ?>"><?= $item['name'] ?></a>
				<?php endforeach; ?>
            </div>
			<!-- Desktop phone -->
            <div class="phone-desktop">
                    <a class="link_color_second" href="tel:<?= preg_replace('/[^\+0-9]/', '', $bender_settings["contacts"]['phone']['number']); ?>" onclick="ym(103473885, 'reachGoal', 'combineGoal'); return true;" aria-label="Позвонить">
						<span style="white-space: nowrap;"><?= $bender_settings["contacts"]['phone']['number'] ?></span>
                    </a>
            </div>
			<!-- Mobile phone -->
			<div class="phone-mobile">
				<a href="tel:<?= preg_replace('/[^\+0-9]/', '', $bender_settings["contacts"]['phone']['number']); ?>" class="phone-icon" aria-label="Позвонить">
					<!-- Иконка телефона -->
					<img src="<?= $bender_settings["contacts"]['phone']['ico'] ?>" />
				</a>
			</div>
			<div class="messengers">
				<?php if (is_array($bender_settings["contacts"]["messengers"])) : ?>
					<?php foreach ($bender_settings["contacts"]["messengers"] as $item): ?>
						<a href="<?= $item['link'] ?>" onclick="ym(103473885, 'reachGoal', 'combineGoal'); return true;">
							<img src="<?= $item['ico'] ?>" alt="<?= $item['name'] ?>" />
						</a>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="copyright">
		<span>© <?= ($bender_settings["company"]["copyright"]["year"] ? $bender_settings["company"]["copyright"]["year"] : date("Y")) ?>, 
			<?php if ($bender_settings["company"]["copyright"]["link"]): ?>
				<a class="link_color" href="<?= $bender_settings["company"]["copyright"]["link"] ?>">
			<?php endif; ?>
					<?= $bender_settings["company"]["copyright"]["text"] ?>
			<?php if ($bender_settings["company"]["copyright"]["link"]): ?>
				</a>
			<?php endif; ?>
		</span>
		<p>
			Сайт разработан в 
			<a class="link_color" href="https://kirilloff.studio/" target="_blank">kirilloff.studio</a>
		</p>
	</div>	
</div>

<!-- Block: footer, template: <?= $block["template"]; ?> -- END -->