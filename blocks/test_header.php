<!-- Block: test, type: grid-2-img -- START -->
<style>
/* Header */
#header {position:fixed; z-index:1000; width:100%; top: 0; left: 0; 
			background: linear-gradient(180deg, rgba(29,33,22,1) 0%, rgba(29,33,22, 0.6) 80%, rgba(29,33,22, 0) 100%);
		}

.header {display:flex; align-items: center; width:clamp(20px, 85vw, 100%); padding-top: 30px; padding-bottom:30px; gap: clamp(10px, 3vw, 30px);}
.header-menu {width:100%;}
.header-menu-link > a {color:#fff; text-decoration:none;}
.header-logo > a > img {max-height:50px; filter: invert(1);}
.header-phone-desktop > a, .header-phone-desktop > span {text-decoration:none;}
.header-messengers {display:flex; gap:20px;}
.header-messengers img, .header-menu-mobile > a > img  {width:clamp(28px, 7vw, 35px); filter: hue-rotate(243deg) brightness(110%)} 
.header-menu-content {display:flex; gap:30px; justify-content: flex-end;}

.shapka-tel-mob {margin-left:auto; display:flex; gap:10px;}
.shapka-tel-mob img {height:35px;} 

/* Mobile menu burger */
.header-menu-mobile, .header-phone-mobile, .header-menu-mobile-close { display: none; align-items: center; gap: 20px; margin-left: auto;}
.header-menu-mobile > a { display: flex; flex-direction: column; justify-content: space-between; width: 39px; height: clamp(26px, 7vw, 30px); cursor: pointer; }
.header-menu-mobile > a > span { display: block; height: 3px; border-radius: 2px; transition: 0.3s; }

/* Mobile menu cross */
.menu-diagonal-cross { width: 39px; height: 39px; position: relative;}
.menu-diagonal-cross::before,
.menu-diagonal-cross::after { content: ''; position: absolute; width: 100%; height: 1px; /* толщина линии */ background-color: #eadc9e; top: 50%; left: 0; transform-origin: center; }
.menu-diagonal-cross::before { transform: translateY(-50%) rotate(45deg); }
.menu-diagonal-cross::after { transform: translateY(-50%) rotate(-45deg); }

/* Mobile breakpoint */
@media (max-width: 1000px) {
	/*.header-menu,*/
	.header-phone-desktop { display: none !important; }
	.header-phone-mobile { display: flex; }
}

/* Mobile breakpoint */
@media (max-width: 800px) {
	/*.header-menu,*/
	.header-menu-content { display: none !important; }
	.header-menu-mobile { display: flex; }

}

/* Optional: адаптивность под ещё меньшие экраны */
@media (max-width: 350px) {
	.header-messengers { gap: 12px; }
}
</style>

<header id="header">
	<!-- Menu = Type1 -->
	<div class="wrap header desktop">
		<?php if (is_array($bender_settings["menu"])) : ?>
			<div class="header-logo">
				<a href="/">
					<img src="<?= $bender_settings["company"]['logo'] ?>" alt="<?= htmlspecialchars(str_replace('"', '', $bender_settings["company"]['name'])) ?>">
				</a>
			</div>

			<!-- Desktop menu -->
            <div class="header-menu">
                <div class="header-menu-content" style="">
					<?php foreach ($bender_settings["menu"] as $item): ?>
						<div class="header-menu-link">
							<a href="/<?= $item['link'] ?>"><?= $item['name'] ?></a>
						</div>
					<?php endforeach; ?>
                </div>
            </div>

			<!-- Desktop phone -->
            <div class="header-phone-desktop">
                    <a class="link_color" href="tel:<?= preg_replace('/[^\+0-9]/', '', $bender_settings["contacts"]['phone']['number']); ?>" onclick="ym(103473885, 'reachGoal', 'combineGoal'); return true;" aria-label="Позвонить">
						<span style="white-space: nowrap;"><?= $bender_settings["contacts"]['phone']['number'] ?></span>
                    </a>
            </div>
			
			<!-- Messengers -->
            <div class="header-messengers">
				<div class="header-phone-mobile">
					<a href="tel:<?= preg_replace('/[^\+0-9]/', '', $bender_settings["contacts"]['phone']['number']); ?>" class="phone-icon" aria-label="Позвонить">
						<!-- Иконка телефона -->
						<img src="<?= $bender_settings["contacts"]['phone']['ico'] ?>" />
					</a>
				</div>
				<?php if (is_array($bender_settings["contacts"]["messengers"])) : ?>
					<?php foreach ($bender_settings["contacts"]["messengers"] as $item): ?>
						<a href="<?= $item['link'] ?>" onclick="ym(103473885, 'reachGoal', 'combineGoal'); return true;">
							<img src="<?= $item['ico'] ?>" alt="<?= $item['name'] ?>" />
						</a>
					<?php endforeach; ?>
				<?php endif; ?>
						
				<div id="header-menu-mobile" class="header-menu-mobile"> <!-- Mobile toggle icons (initially hidden) -->
					<a onclick="showmenu()" aria-label="Меню">
						<!-- Иконка бургера -->
						<span class="button_color"></span>
						<span class="button_color"></span>
						<span class="button_color"></span>
					</a>
				</div>
				<div id="header-menu-mobile-close" class="header-menu-mobile-close block-inactive">
					<a onclick="showmenu()">
						<div class="menu-diagonal-cross"></div>
					</a>
				</div>
			</div>
		<?php endif; ?>
	</div>
</header>

<!-- Block: test, type: grid-2-img -- END -->

<?php
/*

*/
?>