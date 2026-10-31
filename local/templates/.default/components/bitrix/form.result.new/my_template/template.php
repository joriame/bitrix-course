<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;
Asset::getInstance()->addCss($templateFolder . "/css/common.css");
?>

<style>
    /* Растягиваем рабочую область Битрикса на всю ширину под макет */
    #workarea {
        width: 100% !important;
        float: none !important;
        margin: 0 !important;
        padding: 10px 20px !important;
        box-sizing: border-box;
    }
</style>

<?php if ($arResult["isFormErrors"] == "Y"): ?>
    <div class="contact-form-error" style="color: red; margin-bottom: 15px;">
        <?= $arResult["FORM_ERRORS_TEXT"]; ?>
    </div>
<?php endif; ?>

<?php if ($arResult["isFormNote"] == "Y"): ?>
    <div class="contact-form-success" style="color: green; margin-bottom: 15px;">
        <?= $arResult["FORM_NOTE"] ?>
    </div>
<?php endif; ?>

<div class="contact-form">
    <div class="contact-form__head">
        <div class="contact-form__head-title"><?= $arResult["FORM_TITLE"] ?></div>
        <?php if (!empty($arResult["FORM_DESCRIPTION"])): ?>
            <div class="contact-form__head-text">
                <?= $arResult["FORM_DESCRIPTION"] ?>
            </div>
        <?php endif; ?>
    </div>

    <?php 
        $formHeader = str_replace('<form ', '<form class="contact-form__form" ', $arResult["FORM_HEADER"]);
        echo $formHeader;
    ?>
    
        <!-- Динамический вывод стандартных полей (инпутов) -->
        <div class="contact-form__form-inputs">
            <?php foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion): ?>
                <?php 
                    // Пропускаем textarea, выведем их отдельно справа
                    if (strpos($arQuestion["HTML_CODE"], '<textarea') !== false) continue; 
                ?>
                <div class="input contact-form__input">
                    <label class="input__label" for="<?= $FIELD_SID ?>">
                        <div class="input__label-text">
                            <?= $arQuestion["CAPTION"] ?>
                            <?php if ($arQuestion["REQUIRED"] == "Y"): ?>*<?php endif; ?>
                        </div>
                        <?php 
                            $html = str_replace('<input ', '<input class="input__input" id="' . $FIELD_SID . '" ', $arQuestion["HTML_CODE"]);
                            
                            // Автоматически вешаем маску для телефона, если в коде поля есть phone/tel
                            if (strpos($FIELD_SID, 'phone') !== false || strpos($FIELD_SID, 'tel') !== false) {
                                $html = str_replace('input ', 'input data-inputmask="\'mask\': \'+79999999999\', \'clearIncomplete\': \'true\'" maxlength="12" x-autocompletetype="phone-full" ', $html);
                            }
                            
                            echo $html;
                        ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Динамический вывод полей типа textarea (сообщения) -->
        <?php foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion): ?>
            <?php if (strpos($arQuestion["HTML_CODE"], '<textarea') !== false): ?>
            <div class="contact-form__form-message">
                <div class="input">
                    <label class="input__label" for="<?= $FIELD_SID ?>">
                        <div class="input__label-text"><?= $arQuestion["CAPTION"] ?></div>
                        <?php 
                            $html = str_replace('<textarea ', '<textarea class="input__input" id="' . $FIELD_SID . '" ', $arQuestion["HTML_CODE"]);
                            echo $html;
                        ?>
                        <div class="input__notification"></div>
                    </label>
                </div>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>

        <!-- CAPTCHA -->
        <?php if ($arResult["isUseCaptcha"] == "Y"): ?>
            <div class="contact-form__captcha" style="margin: 20px 0;">
                <input type="hidden" name="captcha_sid" value="<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>" />
                <img src="/bitrix/tools/captcha.php?captcha_sid=<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>" width="180" height="40" alt="CAPTCHA" style="margin-bottom: 10px;" />
                <div class="input">
                    <label class="input__label">
                        <div class="input__label-text">Введите слово с картинки*</div>
                        <input type="text" class="input__input" name="captcha_word" size="30" maxlength="50" value="" required="" />
                    </label>
                </div>
            </div>
        <?php endif; ?>

        <div class="contact-form__bottom">
            <div class="contact-form__bottom-policy">
                Нажимая &laquo;Отправить&raquo;, Вы&nbsp;подтверждаете, что ознакомлены, полностью согласны и&nbsp;принимаете условия &laquo;Согласия на&nbsp;обработку персональных данных&raquo;.
            </div>
            <button class="form-button contact-form__bottom-button" type="submit" name="web_form_submit" value="Y" data-success="Отправлено" data-error="Ошибка отправки">
                <div class="form-button__title">
                    <?= (empty($arResult["arForm"]["BUTTON"]) ? "Оставить заявку" : htmlspecialcharsbx($arResult["arForm"]["BUTTON"])); ?>
                </div>
            </button>
        </div>

    <?= $arResult["FORM_FOOTER"] ?>
</div>