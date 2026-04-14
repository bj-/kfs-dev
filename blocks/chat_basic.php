<!-- Block: footer, template: <?= $block["template"]; ?> -- START -->
<style>
/* Footer */
#chat { 
	
	& .icon {position:fixed; 
	bottom:clamp(17px, 2.9vw, 50px); right:clamp(17px, 2.9vw, 50px);; 
	z-index:999;
	border-radius:50%; height:70px; width:70px; display:flex; overflow:hidden; cursor:pointer; box-shadow: 5px 5px 10px black;
	border:3px solid <?= $bender_settings["colors"]["site"]["border"] ?>;
	animation-duration: 2s; animation-name: ChatFlash; animation-iteration-count: infinite; animation-direction: alternate;
	align-items: center; justify-content: center;
	background:<?= $bender_settings["colors"]["button"]["bg"] ?>;
	transition: all 0.3s ease;
	transform-origin: center;}
	& .icon > img {width:35px; height:35px; }
	& .icon:hover {transform: scale(1.1);}
	
	/* chat popup */
	& .bg, 
		& .form {display:none; opacity:0; transition: all 0.4s ease;}
	& .bg {position:fixed; top:0; left:0; width:100%; height:100%; z-index:1010; background:<?= setAlpha($bender_settings["colors"]["site"]["bg"], 0.6); ?>;}
	& .form {position:fixed; bottom:130px; right:50px; z-index:1020; overflow:hidden;
		width:350px; border-radius:20px; border:3px solid <?= $bender_settings["colors"]["site"]["border"] ?>; background:<?= setAlpha($bender_settings["colors"]["site"]["bg"], 0.8); ?>; padding:20px;
		transform: translateY(50px); transform-origin: bottom;}
	
	/* Active states for animations */
	& .bg.active, 
		& .form.active {display:block; opacity:1;}
	& .form.active {transform: translateY(0);}
	
	/* close button - diagonal cross */
	& .close { width: 39px; height: 39px; position: absolute; right:10px; top: 10px; cursor: pointer;}
	& .close::before,
	& .close::after { content: ''; position: absolute; width: 100%; height: 1px; /* толщина линии */ background-color: <?= $bender_settings["colors"]["button"]["bg"] ?>; top: 50%; left: 0; transform-origin: center; }
	& .close::before { transform: translateY(-50%) rotate(45deg); }
	& .close::after { transform: translateY(-50%) rotate(-45deg); }
	
	/* cf7 */
	& .cf7-text { padding-right: 25px; padding-bottom:20px; font-size:16px; line-height: 20px; margin: 0; margin-right: 30px;}
	& .cf7-form {}
	& .cf7-form > p { display: flex; gap: 0px; flex-direction:column;}
	& .cf7-form-text, 
		& .cf7-form-tel {background:none; border:1px solid <?= $bender_settings["colors"]["site"]["border"] ?>; border-radius:30px; color:<?= $bender_settings["colors"]["site"]["text"] ?>;}
	& .cf7-form-tel {margin:0px;}
	& .cf7-form-send {background:<?= $bender_settings["colors"]["button"]["bg"] ?>; border-radius:20px; color:<?= $bender_settings["colors"]["button"]["text"] ?>; width: 100%; font-size: 20px; line-height: 30px; font-family: "<?= $bender_settings["fonts"]["text"] ?>";}
	& .cf7-form-accept {opacity:1;}
	& .wpcf7-response-output {color:<?= $bender_settings["colors"]["site"]["text"] ?>; font-size:12px; line-height:16px; margin:0 auto;}
	& .wpcf7-not-valid-tip {font-size:12px; line-height:16px;}	
	& .wpcf7-list-item-label { font-size: 10px; line-height: 12px; color: <?= $bender_settings["colors"]["site"]["text"] ?>;}
	& .wpcf7-list-item > label { display: flex; gap: 20px; }
	
	& .cf7-form-text, 
		& .cf7-form-tel, 
		& .cf7-form-send {padding: 15px 20px;}

}

/* Mobile breakpoint */
@media (max-width: 1000px) {
	#chat {
		& .form {width:300px; right:30px; bottom:100px;}
	}
}

/* Mobile breakpoint */
@media (max-width: 800px) {
	#chat {
		& .form {width:280px; right:20px; bottom:80px;}
		& .icon {bottom:20px; right:20px; height:60px; width:60px;}
		& .icon > img {width:30px; height:30px;}
	}
}

/* Optional: адаптивность под ещё меньшие экраны */
@media (max-width: 350px) {
	#chat {
		& .form {width:260px; padding:15px;}
	}
}

@keyframes ChatFlash {
	0% {
		transform: scale(1);
	}
	50% {
		transform: scale(1);
       }
	100% {
		transform: scale(1.2);
	}
}

</style>

<div id="chat">
	<div class="icon" onclick="showChat()">
		<img src="<?= $bender_settings["chat"]["ico"] ?>">
	</div>
	<div id="chat-bg" class="bg" onclick="showChat()"></div>
	<div id="chat-form" class="form">
		<a onclick="showChat()">
			<div class="close"></div>
		</a>
		<?php echo do_shortcode( $bender_settings["chat"]["form"]); ?>
	</div>

</div>
<script>
function showChat(){
    const chatBg = document.getElementById('chat-bg');
    const chatForm = document.getElementById('chat-form');
    const chatIcon = document.querySelector('#chat .icon');
    
    // Проверяем текущее состояние
    const isActive = chatBg.classList.contains('active');
    
    if (isActive) {
        // Закрываем чат
        chatBg.classList.remove('active');
        chatForm.classList.remove('active');
        chatIcon.style.animationPlayState = 'running';
        
        // После анимации скрываем элементы
        setTimeout(() => {
            chatBg.style.display = 'none';
            chatForm.style.display = 'none';
        }, 400);
    } else {
        // Открываем чат
        chatBg.style.display = 'block';
        chatForm.style.display = 'block';
        
        // Запускаем анимацию
        setTimeout(() => {
            chatBg.classList.add('active');
            chatForm.classList.add('active');
            chatIcon.style.animationPlayState = 'paused';
        }, 10);
    }
}

// Закрытие чата при нажатии на клавишу Escape
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const chatBg = document.getElementById('chat-bg');
        if (chatBg.classList.contains('active')) {
            showChat();
        }
    }
});
</script>

<!-- Block: [chat], template: <?= $block["template"]; ?> -- END -->