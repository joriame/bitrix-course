<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$this->addExternalCss($this->GetFolder() . '/style.css');
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
$this->setFrameMode(true);
?>

<div class="article-card">
    <div class="article-card__title">
        <?= htmlspecialcharsbx($arResult["NAME"]) ?>
    </div>

    <?php if (!empty($arResult["DISPLAY_ACTIVE_FROM"])): ?>
        <div class="article-card__date">
            <?= $arResult["DISPLAY_ACTIVE_FROM"] ?>
        </div>
    <?php endif; ?>

    <div class="article-card__content">
        <div class="article-card__image sticky">
            <?php
            $arFile = is_array($arResult["PREVIEW_PICTURE"]) ? $arResult["PREVIEW_PICTURE"] : false;

            if (!$arFile && !empty($arResult["PREVIEW_PICTURE"])) {
                $arFile = CFile::GetFileArray($arResult["PREVIEW_PICTURE"]);
            }

            if (!$arFile && is_array($arResult["DETAIL_PICTURE"])) {
                $arFile = $arResult["DETAIL_PICTURE"];
            }

            if (!$arFile && !empty($arResult["DETAIL_PICTURE"])) {
                $arFile = CFile::GetFileArray($arResult["DETAIL_PICTURE"]);
            }
            ?>

            <?php if (!empty($arFile["SRC"])): ?>
                <img src="<?= $arFile["SRC"] ?>" alt="<?= htmlspecialcharsbx($arFile["ALT"] ?: $arResult["NAME"]) ?>"
                    data-object-fit="cover" />
            <?php else: ?>
                <img src="<?= $this->GetFolder() ?>/images/1.1108519d.jpg"
                    alt="<?= htmlspecialcharsbx($arResult["NAME"]) ?>" data-object-fit="cover" />
            <?php endif; ?>
        </div>

        <div class="article-card__text">
            <div class="block-content">
                <?php
                $text = !empty($arResult["DETAIL_TEXT"]) ? $arResult["DETAIL_TEXT"] : $arResult["PREVIEW_TEXT"];

                if (!empty($text)) {
                    $paragraphs = explode("\n", trim($text));
                    foreach ($paragraphs as $paragraph) {
                        $paragraph = trim($paragraph);
                        if (!empty($paragraph)) {
                            echo '<p>' . htmlspecialcharsbx($paragraph) . '</p>';
                        }
                    }
                }
                ?>
            </div>

            <a class="article-card__button" href="<?= $arResult["LIST_PAGE_URL"] ?>">
                Назад к новостям
            </a>
        </div>
    </div>
</div>