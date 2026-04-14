<style>
/* Mobile Menu TopSlider */
#mobile-menu { 
	display:flex; background:<?= setAlpha($bender_settings["colors"]["site"]["bg"], 0.95); ?>; position:fixed; top:0; width:100%; z-index:999; overflow:hidden; align-items: center;
	& .content {display:flex; flex-direction:column; align-items:flex-start; width: max-content; margin: auto; gap: 40px;}
	& .items > div {text-transform:uppercase; padding:10px 0;}
	& .link > a {color:<?= $bender_settings["colors"]["link"]["color"] ?>; text-decoration:none;}
	& .messengers { display:flex; gap: 20px; flex-direction: column;}
	& .messengers-items { }
	& .messengers-items > a { text-decoration:none; color:<?= $bender_settings["colors"]["link"]["color"] ?>; display:flex; gap: 10px; }
	& .messengers-items > a > img { width: 36px; }
	& .menu-button { text-align:center;}
	& .menu-button > a {border-radius:30px; text-align:center; text-decoration:none; padding:10px 50px; width:100%; text-decoration:none; color:#000;}
}

</style>

<div id="mobile-menu" class="mobile-menu block-inactive-menu">
    <div class="wide">
	<div class="content">
		<div class="items">
			<?php foreach ($bender_settings["menu"] as $item): ?>
                    <div class="link">
                        <a href="/<?= $item['link'] ?>" onclick="showmenu()"><?= $item['name'] ?></a>
                    </div>
			<?php endforeach; ?>
		</div>
		<div class="messengers">
			<?php if (is_array($bender_settings["contacts"]["messengers"])) : ?>
				<?php foreach ($bender_settings["contacts"]["messengers"] as $item): ?>
					<div class="messengers-items">
						<a href="<?= $item['link'] ?>" onclick="ym(103473885, 'reachGoal', 'combineGoal'); return true;">
							<img src="<?= $item['ico'] ?>">
							<span><?= $item['name'] ?></span>
						</a>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>	
		</div>
		<div class="menu-button">
			<a href="/#callback" onclick="showmenu()" class="button_color">Заказать звонок</a>
		</div>
	</div>
	</div>
</div>