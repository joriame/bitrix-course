<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @var CBitrixComponentTemplate $this */
$this->setFrameMode(true);
?>

<div class="custom-news-container">
    <?php if ($arParams["DISPLAY_TOP_PAGER"]): ?>
        <div class="custom-news-pager"><?=$arResult["NAV_STRING"]?></div>
    <?php endif; ?>

    <div class="custom-news-grid">
        <?php foreach ($arResult["ITEMS"] as $arItem): ?>
            <?php
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="custom-news-card" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                
                <?php if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                    <div class="custom-news-card__image">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                            <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>">
                        </a>
                    </div>
                <?php endif; ?>

                <div class="custom-news-card__content">
                    <?php if ($arParams["DISPLAY_DATE"] != "N" && $arItem["DISPLAY_ACTIVE_FROM"]): ?>
                        <span class="custom-news-card__date">📅 <?=$arItem["DISPLAY_ACTIVE_FROM"]?></span>
                    <?php endif; ?>

                    <?php if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
                        <h3 class="custom-news-card__title">
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
                        </h3>
                    <?php endif; ?>

                    <?php if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                        <p class="custom-news-card__text"><?=$arItem["PREVIEW_TEXT"]?></p>
                    <?php endif; ?>

                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="custom-news-card__btn">
                        Читать дальше →
                    </a>
                </div>

            </div>
        <?php endforeach; ?>
    </div>

    <?php if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <div class="custom-news-pager"><?=$arResult["NAV_STRING"]?></div>
    <?php endif; ?>
</div>