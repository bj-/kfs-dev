<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- START -->
<?php
//echo "<pre>"; var_dump($bender_settings["colors"]); echo "</pre>";
//echo "<pre>"; var_dump($block); echo "</pre>";
?>
<style>
#<?= $bUID; ?> { 
	position: relative; background-size: cover !important; background-position: center !important; height: fit-content;
	& .fade { <?= $fade_style ?> width: 100%; height: 100%; }	
	
	& .title {display:flex; gap:20px;}
	& .title > h2 { font-size: <?= $bender_settings["size"]["title"] ?>; /*line-height: 80px; */ color: <?= $title_color ?>; margin-top: 20px; margin-bottom: 20px; font-weight: normal; }
	& .text,
		& .title > h2 { flex: 1 1 0; }
	& .text { font-size: 18px; line-height: 32px; }
	& .title {padding-left:clamp(0px, 3vw, 50px); padding-right:clamp(0px, 3vw, 50px); }
	
}


/* === Квиз: обёртка === */
#<?= $bUID; ?>-quiz {
    & .quiz-wrapper { max-width: 1000px; margin: 0 auto; color: <?= $bender_settings["colors"]["text"]["text"] ?>; min-height: 400px; }

	/* === Шаги квиза === */
	& .quiz-step { display: none; animation: slideFadeIn 0.4s ease forwards; }
	& .quiz-step.active { display: block; }
	& .quiz-step.exiting { animation: slideFadeOut 0.6s ease forwards; }
	
	/* === Заголовки вопросов === */
	& .quiz-title { padding: 10px 20px; display: inline-block; border-radius: 12px; background: <?= $bender_settings["colors"]["button"]["bg"] ?>; color: <?= $bender_settings["colors"]["button"]["text"] ?> !important; font-size: 20px; margin-bottom: 25px; }

    /* === Прогресс-бар === */
	& .quiz-progress { display: flex; gap: 8px; margin-bottom: 30px; }
	& .quiz-progress-dot { width: 12px; height: 12px; border-radius: 50%; background: #E2DFDA; transition: background 0.3s; }
	& .quiz-progress-dot.active { background: <?= $bender_settings["colors"]["button"]["bg"] ?>; }
	& .quiz-progress-dot.completed { background: #4F4842; }

    /* === Варианты ответов (radio) === */
    & .quiz-options { display: flex; flex-direction: column; gap: 12px; margin-bottom: 30px; }

	& .quiz-option { position: relative; }
	& .quiz-option input { position: absolute; opacity: 0; width: 0; height: 0; }
	& .quiz-option label { display: block; padding: 15px 25px; background: transparent; border: 2px solid <?= $bender_settings["colors"]["button"]["border"] ?>; border-radius: 12px; cursor: pointer; transition: all 0.2s; line-height: 1.4; font-size: 18px;  color: <?= $bender_settings["colors"]["site"]["text"] ?>;}
	& .quiz-option label:hover { border-color: <?= $bender_settings["colors"]["button"]["hover"] ?>; ; }
	& .quiz-option input:checked + label { background: <?= $bender_settings["colors"]["button"]["bg"] ?>; border-color: <?= $bender_settings["colors"]["button"]["border"] ?>; color: <?= $bender_settings["colors"]["button"]["text"] ?>; font-weight: 500; }

    /* === Чекбоксы === */
    & .quiz-checkboxes { display: flex; flex-direction: column; gap: 10px; margin-bottom: 15px; }
    & .quiz-checkbox { display: flex; align-items: flex-start; gap: 10px; 
        & input { margin-top: 4px; width: 18px; height: 18px; accent-color: <?= $bender_settings["colors"]["button"]["bg"] ?>; opacity: unset; }
        & label { font-size: 18px; cursor: pointer; color: <?= $bender_settings["colors"]["site"]["text"] ?>; }
    }

    /* === Поле "Другое" === */
	& .quiz-other-input { margin-top: 15px; display: none; }
	& .quiz-other-input.show { display: block; }
	& .quiz-other-input input { width: 100%; background: none; color: <?= $bender_settings["colors"]["site"]["text"] ?>; border: 1px solid #E2DFDA; border-radius: 12px; padding: 12px 20px; font-size: 18px; }

    /* === Кнопки навигации === */
    & .quiz-nav { display: flex; justify-content: flex-end; gap: 15px; margin-top: 20px; }

	& .btn-quiz { cursor: pointer; text-decoration: none; padding: 15px 40px; border-radius: 12px; background: <?= $bender_settings["colors"]["button"]["bg"] ?>; font-size: 16px; font-weight: 500; border: none; transition: background 0.2s; display: inline-flex; align-items: center; color: <?= $bender_settings["colors"]["button"]["text"] ?>; }
	& .btn-quiz:hover { background: <?= $bender_settings["colors"]["button"]["hover"] ?>; }
	& .btn-quiz:disabled { opacity: 0.6; cursor: not-allowed; }

	& .btn-quiz.btn-back { background: transparent; border: 2px solid #E2DFDA; color: <?= $bender_settings["colors"]["site"]["text"] ?>;  }
	& .btn-quiz.btn-back:hover { background: <?= $bender_settings["colors"]["button"]["hover"] ?>; color: <?= $bender_settings["colors"]["button"]["text"] ?>; }

	/* Сообщение об ошибке валидации */
	& .quiz-error-message {
		display: none;
		color: #F44336 !important;
		font-size: 14px !important;
		margin: 10px 0 !important;
		padding: 8px 12px !important;
		background: rgba(244, 67, 54, 0.1) !important;
		border-radius: 8px !important;
		text-align: center !important;
		animation: shake 0.3s ease;
	}
    
	& .quiz-error-message.show {
	display: block !important;
	}
    
	/* Анимация "тряски" при ошибке */
	@keyframes shake {
		0%, 100% { transform: translateX(0); }
		25% { transform: translateX(-5px); }
		75% { transform: translateX(5px); }
	}
	
    /* === Финальный шаг (контакты) === */
	& .quiz-final { text-align: center; }
	& .quiz-final p { color: <?= $bender_settings["colors"]["site"]["text"] ?>; margin-bottom: 15px; }
	& .quiz-final p.subtitle { font-size: 14px; opacity: 0.9; }

    /* === Поля CF7 === */
	& .quiz-contact-fields { display: flex; flex-direction: column; gap: 15px; margin: 25px 0; max-width: 400px; margin-left: auto; margin-right: auto; }
	& .quiz-contact-fields input { background: none; color: <?= $bender_settings["colors"]["site"]["text"] ?>; border: 2px solid <?= $bender_settings["colors"]["button"]["border"] ?>; border-radius: 12px; padding: 12px 20px; font-size: 18px; width: 100%; box-sizing: border-box; margin: 0;}
	& .quiz-contact-fields input::placeholder { color: <?= $bender_settings["colors"]["site"]["text"] ?>; opacity: 0.7; }

    /* === Чекбокс согласия === */
	& .quiz-consent { font-size: 12px; color: <?= $bender_settings["colors"]["site"]["text"] ?>; text-align: left; max-width: 400px; margin: 0 auto 25px; line-height: 1.4; }
	& .quiz-consent a { color: #E2DFDA; text-decoration: underline; }

    /* === Кнопка отправки CF7 === */
    & .quiz-contact-fields .wpcf7-submit { width: 100%; max-width: 400px; color: <?= $bender_settings["colors"]["button"]["text"] ?>; background: <?= $bender_settings["colors"]["button"]["bg"] ?>; border-radius: 12px; padding: 15px; font-size: 16px; font-weight: 500; border: none; cursor: pointer; margin-top: 15px;  transition: background 0.2s; }
	& .wpcf7-submit { }
	& .wpcf7-submit:hover { background: <?= $bender_settings["colors"]["button"]["bg"] ?>; }

    /* === Сообщения CF7 === */
	& .wpcf7-response-output { margin: 20px 0 0; padding: 12px 20px; border-radius: 12px; font-size: 14px; text-align: center; max-width: 400px; margin-left: auto; margin-right: auto; position: relative; z-index: 10; color: <?= $bender_settings["colors"]["site"]["text"] ?>; }
	& .wpcf7-response-output.wpcf7-display-none { display: none !important; }
	& .wpcf7-response-output.wpcf7-mail-sent-ok { background: rgba(76, 175, 80, 0.2) !important; border: 1px solid #4CAF50 !important; color: #E2DFDA !important; }
	& .wpcf7-response-output.wpcf7-validation-errors,
		& .wpcf7-response-output.wpcf7-acceptance-missing,
		& .wpcf7-response-output.wpcf7-mail-failed { background: rgba(244, 67, 54, 0.2) !important; border: 1px solid #F44336 !important; color: #E2DFDA !important; }

    /* === Обёртки полей CF7 === */
    & .wpcf7-form-control-wrap:has(.cf7-visible) { display: block !important; width: 100%; }
    & .wpcf7-form-control-wrap:has(input[type="hidden"]:not(.cf7-visible)) { /* Скрытые поля не отображаем */}
    /* === Ссылка на политику === */
    & .cf7-private-policy-link { min-width: unset; padding: 0; font-size: unset; line-height: unset; backdrop-filter: unset; border: unset; }
    /* === Чекбоксы внутри CF7 === */
    & .wpcf7-list-item input { opacity: unset; margin-top: 3px; accent-color: <?= $bender_settings["colors"]["button"]["bg"] ?>; cursor: pointer; width: 12px; }
	& .wpcf7-list-item > label {font-size: 10px; line-height:12px; display: flex; gap: 10px;}
	& .wpcf7-list-item > label > span { text-align: justify; color: <?= $bender_settings["colors"]["site"]["text"] ?>}



}
/* === Анимации шагов === */
@keyframes slideFadeIn {
	from { opacity: 0; transform: translateX(200px); }
	to { opacity: 1; transform: translateX(0); }
}

@keyframes slideFadeOut {
	from { opacity: 1; transform: translateX(0); }
	to { opacity: 0; transform: translateX(-200px); }
}


/* Mobile breakpoint */
@media (max-width: 1200px) {
	#<?= $bUID; ?> { 
	}
}

@media (max-width: 1000px) {
	#<?= $bUID; ?> {
	}

@media (max-width: 900px) {
	#<?= $bUID; ?> {
	}

}
</style>

<div id="<?= $bUID; ?>" class="nowide" style="<?= $block["bg_style"] ?>">
    <div class="title">
        <h2 class="<?= $block['options']['wow_style']['wow_block_title'] ?>" data-wow-offset="<?= $block['options']['wow_style']['data-wow-offset'] ?>"><?= $block['title'] ?></h2>
        <p class="text"><?= $block['text'] ?></p>
    </div>
    <div class="content">
	

		<div id="<?= $bUID; ?>-quiz" class="quiz">

			<div class="quiz-wrapper">
				
				<!-- Прогресс-бар -->
				<div class="quiz-progress" id="quizProgress">
					<?php foreach ($block["steps"] as $key => $item): ?>
					<div class="quiz-progress-dot <?= ( $key == 0 ) ? "active" : ""; ?>"></div>
					<?php endforeach; ?>
					<div class="quiz-progress-dot"></div>
				</div>
				<?php
				// Step
				$currentStep = 1;
				foreach ($block["steps"] as $key => $item): 
				//if ( is_array($item) and @$item["settings"]["active"]):

				switch ($item["settings"]["selector"]) {
					case "radio":
						$selector = "radio";
						$items_class = "quiz-options";
						$item_class = "quiz-option";
						break;
					case "check":
						$selector = "checkbox";
						$items_class = "quiz-checkboxes";
						$item_class = "quiz-checkbox";
						break;
					default:
						$selector = "radio";
						$items_class = "quiz-options";
						$item_class = "quiz-option";
				}
				$item_result_field = $item["settings"]["result_field"];
					
				//echo "<pre>"; var_dump($item); echo "</pre>";
				?>
				<!-- Шаг <?= $currentStep ; ?>: <?= $item["title"] ; ?>-->
				<div class="quiz-step <?= ( $currentStep == 1 ) ? "active" : ""; ?>" data-step="<?= $currentStep ; ?>">
					<div class="quiz-title"><?= $item["title"] ; ?></div>
					<div class="<?= $items_class ; ?>">
						<?php foreach ($item["item"] as $optionId => $option): ?>
						<div class="<?= $item_class ; ?>">
							<input type="<?= $selector ; ?>" name="quiz_<?= $item_result_field ; ?>" id="step<?= $currentStep ; ?>_<?= $item_result_field . $optionId ; ?>" value="<?= $option["name"] ; ?>" data-cf7="<?= $item_result_field ; ?>">
							<label for="step<?= $currentStep ; ?>_<?= $item_result_field . $optionId ; ?>"><?= $option["name"] ; ?></label>
						</div>
						<?php 
						endforeach; 
						if ( $item["other"]["active"] ):
						?>
						<div class="<?= $item_class; ?>">
							<input type="<?= $selector ; ?>" id="step<?= $currentStep ; ?>_<?= $item_result_field; ?>_other" value="<?= $option["name"] ; ?>" data-cf7="<?= $item_result_field ; ?>" data-other-trigger="other-<?= $item_result_field ; ?>">
							<label for="step<?= $currentStep ; ?>_<?= $item_result_field; ?>_other"><?= $item["other"]["name"] ; ?></label>
						</div>
						<?php endif; ?>
					</div>
					<?php if ( $item["other"]["active"] ): ?>
					<div class="quiz-other-input" id="other-<?= $item["settings"]["result_field"] ; ?>">
						<input type="text" placeholder="Укажите ваш вариант..." id="<?= $item["settings"]["result_field"] ; ?>OtherText">
					</div>
					<?php endif; ?>
					<div class="quiz-error-message" style="display:none; color:#F44336; font-size:18px; margin:10px 0; text-align:center;"></div>
					<div class="quiz-nav">
						<?php if ( $currentStep > 1 ): ?>
						<button class="btn-quiz btn-back" data-prev="<?= $currentStep-1 ; ?>">Назад</button>
						<?php endif; ?>
						<button class="btn-quiz btn-next" data-next="<?= $currentStep+1 ; ?>">Далее</button>
					</div>
				</div>			
				<?php 
				$currentStep++;
				//endif;
				endforeach; 
				?>
				<!-- Шаг Финальный: Контакты (CF7) -->
				<div class="quiz-step quiz-final" data-step="<?= $currentStep ; ?>">
					<div class="quiz-title">Готово!</div>
					<p style="font-size:20px; color:#E2DFDA; margin-bottom:10px;">
						<?= $block["step_final"]["subtitle"] ?>
					</p>
					<p class="subtitle">
						<?= $block["step_final"]["text"] ?>
					</p>
					<!-- Контактные поля CF7 (видимые) -->
					<div class="quiz-contact-fields">
						<?php echo do_shortcode('[contact-form-7 id="8acd900" title="quiz"]'); ?>
					</div>
				</div>
			</div>
		</div>
</div>

<script>
// QUIZ
document.addEventListener('DOMContentLoaded', function() {
    
    // === Навигация по шагам ===
    const steps = document.querySelectorAll('.quiz-step');
    const progressDots = document.querySelectorAll('.quiz-progress-dot');
  
	function showStep(stepNumber) {
		const currentActive = document.querySelector('#<?= $bUID; ?>-quiz .quiz-step.active');
		const nextStep = document.querySelector(`#<?= $bUID; ?>-quiz .quiz-step[data-step="${stepNumber}"]`);
		
		// Если шаг уже активен — ничего не делаем
		if (currentActive === nextStep) return;
		
		// Анимация исчезновения текущего шага
		if (currentActive) {
			currentActive.classList.add('exiting');
			currentActive.classList.remove('active');
			
			// Ждём завершения анимации перед удалением класса exiting
			setTimeout(() => {
				currentActive.classList.remove('exiting');
			}, 300);
		}
		
		// Показ следующего шага с небольшой задержкой для плавности
		setTimeout(() => {
			if (nextStep) {
				nextStep.classList.add('active');
			}
		}, 100);
		
		// Обновление прогресс-бара
		progressDots.forEach((dot, index) => {
			dot.classList.remove('active', 'completed');
			console.log('index ' + index + '  stepNumber ' + stepNumber);
			if (index + 1 < stepNumber) dot.classList.add('completed');
			if (index + 1 == stepNumber) {
				dot.classList.add('active');
				console.log('add active class to progress dot');
			}
		});
	}
    
    // Кнопки "Далее"
    document.querySelectorAll('.btn-next').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const currentStep = this.closest('.quiz-step').dataset.step;
            const nextStep = this.dataset.next;
			const currentStepEl = document.querySelector(`.quiz-step[data-step="${currentStep}"]`);

			// Скрыть все сообщения об ошибках в текущем шаге
			const errorMsg = currentStepEl.querySelector('.quiz-error-message');
			if (errorMsg) {
				errorMsg.classList.remove('show');
				errorMsg.style.display = 'none';
				errorMsg.textContent = '';
			}           

			// Валидация для radio-шагов
            const radioInputs = currentStepEl.querySelectorAll('input[type="radio"]');
			
            if (radioInputs.length > 0) {
                const checked = currentStepEl.querySelector('input[type="radio"]:checked');
                if (!checked) {
					if (errorMsg) {
						errorMsg.textContent = 'Пожалуйста, выберите вариант ответа';
						errorMsg.style.display = 'block';
						errorMsg.classList.add('show');
                    
						// Плавный скролл к сообщению
						//errorMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
					}
                    //alert('Пожалуйста, выберите вариант ответа');
                    return;
                }
                // Сохраняем ответ в скрытое поле CF7
                const value = checked.value;
                const cf7Field = checked.dataset.cf7;
                if (cf7Field) {
                    //document.getElementById('cf7-' + cf7Field.split('-')[1]).value = value;
                    document.getElementById('cf7-' + cf7Field).value = value;
					//let x = "1";
                }
            }
            
            // Для checkbox-шагов собираем все выбранные значения
            const checkboxInputs = currentStepEl.querySelectorAll('input[type="checkbox"]:checked');
            if (checkboxInputs.length > 0) {
                const groups = {};
                checkboxInputs.forEach(cb => {
                    const group = cb.dataset.cf7;
                    if (!groups[group]) groups[group] = [];
                    groups[group].push(cb.value);
                    
                    // Обработка "Другое"
                    if (cb.dataset.otherTrigger) {
                        const otherId = cb.dataset.otherTrigger;
                        const otherInput = document.getElementById(otherId.replace('other-', '') + 'OtherText');
                        if (otherInput && otherInput.value.trim()) {
                            groups[group].push(otherInput.value.trim());
                        }
                    }
                });
                
                Object.entries(groups).forEach(([key, values]) => {
                    //const fieldId = 'cf7-' + key.split('-')[1];
					const fieldId = 'cf7-' + key;
                    document.getElementById(fieldId).value = values.join(', ');
                });
            }
            
            showStep(nextStep);
        });
    });
    
    // Кнопки "Назад"
    document.querySelectorAll('.btn-back').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const prevStep = this.dataset.prev;
            showStep(prevStep);
        });
    });
    
    // === Показ поля "Другое" при выборе соответствующего чекбокса ===
    document.querySelectorAll('[data-other-trigger]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const targetId = this.dataset.otherTrigger;
            const otherBlock = document.getElementById(targetId);
            if (otherBlock) {
                otherBlock.classList.toggle('show', this.checked);
                // Очистка поля при снятии галочки
                if (!this.checked) {
                    const input = otherBlock.querySelector('input');
                    if (input) input.value = '';
                }
            }
        });
    });
    
    // === Блокировка кнопки "Далее", пока не выбран ответ (для radio) ===
    document.querySelectorAll('.quiz-step').forEach(step => {
        const radios = step.querySelectorAll('input[type="radio"]');
        const nextBtn = step.querySelector('.btn-next');
        
        if (radios.length > 0 && nextBtn) {
            radios.forEach(radio => {
                radio.addEventListener('change', function() {
                    nextBtn.disabled = false;
                });
            });
            // Изначально кнопка может быть disabled, если нужно
            // nextBtn.disabled = true;
        }
    });
	
	// чтобы сообщение об ошибке исчезало при выборе варианта:
	document.querySelectorAll('.quiz-option input[type="radio"]').forEach(radio => {
		radio.addEventListener('change', function() {
			const step = this.closest('.quiz-step');
			const errorMsg = step?.querySelector('.quiz-error-message');
			if (errorMsg) {
				errorMsg.classList.remove('show');
				errorMsg.style.display = 'none';
			}
		});
	});
    
	showStep(1);
});
</script>
<?php
//echo "<pre>"; var_dump($block); echo "</pre>";
?>
<!-- Block: <?= $bUID; ?>, template: <?= $block["template"]; ?> -- END -->