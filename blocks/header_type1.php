<style>

/* Header */
#header { 
	position:fixed; z-index:1000; width:100%; top: 0; left: 0;
			background: linear-gradient(180deg, <?= setAlpha($bender_settings["colors"]["site"]["bg"], 1); ?> 0%, <?= setAlpha($bender_settings["colors"]["site"]["bg"], 0.6); ?> 80%, <?= setAlpha($bender_settings["colors"]["site"]["bg"], 0); ?> 100%);
	& .header { 
		display:flex; align-items: center; padding-left: clamp(0px, 3vw, 50px); padding-right: clamp(0px, 3vw, 50px); gap: clamp(10px, 3vw, 30px); justify-content: space-between; height:100px;
		margin: auto;
		max-width: 1700px;
	}
	& .logo {}
	& .logo > a > img {max-height:80px; filter: invert(1);}
	& .menu-content {display:flex; gap:clamp(12px, 4vw, 30px); align-items: center; }
	& .menu { display:flex; gap:30px; }
	& .phone-mobile { 
		display:none; width:clamp(28px, 7vw, 35px); height: clamp(28px, 7vw, 35px);
		& a { width:clamp(28px, 7vw, 35px); height:clamp(28px, 7vw, 35px); }
		& img { height: 100%; width: 100%; }
	}
	& .messengers { 
		display:flex; gap:clamp(12px, 4vw, 30px); height:clamp(28px, 7vw, 35px);
		& a { width:clamp(28px, 7vw, 35px); height:clamp(28px, 7vw, 35px); }
		& img { height: 100%; width: 100%; }
	}

	/* Mobile menu burger */
	& .menu-mobile, 
		& .phone-mobile, 
		& .menu-mobile-close { display: none; align-items: center; gap: 20px; margin-left: auto;}
	& .menu-mobile > a { display: flex; flex-direction: column; justify-content: space-between; width: 39px; height: clamp(26px, 7vw, 30px); cursor: pointer; }
	& .menu-mobile > a > span { display: block; height: 3px; border-radius: 2px; transition: 0.3s; }

	/* Mobile menu cross */
	& .menu-diagonal-cross { width: 39px; height: 39px; position: relative;}
	& .menu-diagonal-cross::before,
	& .menu-diagonal-cross::after { content: ''; position: absolute; width: 100%; height: 1px; /* толщина линии */ background-color: #eadc9e; top: 50%; left: 0; transform-origin: center; }
	& .menu-diagonal-cross::before { transform: translateY(-50%) rotate(45deg); }
	& .menu-diagonal-cross::after { transform: translateY(-50%) rotate(-45deg); }
}

/* Mobile breakpoint */
@media (max-width: 1000px) {
	#header {
		& .phone-desktop { display: none !important; }
		& .phone-mobile { display: flex; }
	}
}

/* Mobile breakpoint */
@media (max-width: 800px) {
	#header {
		& .menu { display: none !important; }
		& .menu-mobile { display: flex; }
	}
}

/* Optional: адаптивность под ещё меньшие экраны */
@media (max-width: 350px) {
	#header {
		& .menu-content,
			& .messengers { /* gap: 12px; */ }
	}
}

</style>

<header id="header" class="wide">
	<div class="header">
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

			<div id="menu-mobile" class="menu-mobile"> <!-- Mobile toggle icons (initially hidden) -->
				<a onclick="showmenu()" aria-label="Меню">
					<!-- Иконка бургера -->
					<span class="button_color"></span>
					<span class="button_color"></span>
					<span class="button_color"></span>
				</a>
			</div>
			<div id="menu-mobile-close" class="menu-mobile-close">
				<a onclick="showmenu()">
					<div class="menu-diagonal-cross"></div>
				</a>
			</div>
		</div>
	</div>
</header>
