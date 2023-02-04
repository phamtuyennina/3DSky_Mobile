<div class="title-main"><h1><span><?=$static['ten'.$lang]?></span></h1></div>
<div class="content-main info-news-detail"><?=htmlspecialchars_decode($static['noidung'.$lang])?></div>
<div class="share mt-xl-3 mb-xl-3">
	<b><?=chiase?>:</b>
	<div class="social-plugin w-clear">
        <div class="addthis_inline_share_toolbox_qj48"></div>
        <div class="zalo-share-button" data-href="<?=$func->getCurrentPageURL()?>" data-oaid="<?=($optsetting['oaidzalo']!='')?$optsetting['oaidzalo']:'579745863508352884'?>" data-layout="1" data-color="blue" data-customize=false></div>
    </div>
</div>