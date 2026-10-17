<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @var CBitrixComponentTemplate $this */
$this->setFrameMode(true);
$APPLICATION->SetAdditionalCSS($this->GetFolder() . '/css/common.css');
?>

<div class="article-list">
    <?php foreach ($arResult["ITEMS"] as $arItem): ?>
        <?php
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <a class="article-item article-list__item" href="<?=$arItem["DETAIL_PAGE_URL"]?>" data-anim="anim-3" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="article-item__background">
                <?php if (is_array($arItem["PREVIEW_PICTURE"])): ?>
                    <!-- Картинка из инфоблока Битрикса -->
                    <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>"/>
                <?php else: ?>
                    <!-- Дефолтная картинка, если в инфоблоке нет превью -->
                    <img src="<?=$this->GetFolder()?>/images/article-item-bg-6.jpg" alt="<?=$arItem["NAME"]?>"/>
                <?php endif; ?>
            </div>
            <div class="article-item__wrapper">
                <div class="article-item__title"><?=$arItem["NAME"]?></div>
                <?php if ($arItem["PREVIEW_TEXT"]): ?>
                    <div class="article-item__content"><?=$arItem["PREVIEW_TEXT"]?></div>
                <?php endif; ?>
            </div>
        </a>
    <?php endforeach; ?>
</div>