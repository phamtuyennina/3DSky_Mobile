 <div class="title-main"><h1><span><?=(isset($title_cat) && $title_cat!='')?$title_cat:$title_crumb?></span></h1></div>
<div class="content-main mt-xl-3">
    <div class="row">
        <?php if(count($news)>0) { foreach($news as $k => $v) { ?>
        <div class="news col-12 col-sm-6 col-lg-6 hover-desc">
            <div class="pic-news scale-img">
                <a href="<?=$v[$sluglang]?>" title="<?=$v['ten'.$lang]?>">
                    <img class="img-block" onerror="this.src='<?=THUMBS?>/570x350x2/assets/images/noimage.png';" src="<?=THUMBS?>/570x350x1/<?=UPLOAD_NEWS_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>">
                </a>
            </div>
            <div class="info-news">
                <h3 class="name-news">
                    <a href="<?=$v[$sluglang]?>" title="<?=$v['ten'.$lang]?>">
                        <?=$v['ten'.$lang]?>
                    </a>
                </h3>
                <p class="time-news"><?=ngaydang?>: <?=date("d/m/Y h:i A",$v['ngaytao'])?></p>
                <div class="desc-news text-split-3"><?=$v['mota'.$lang]?></div>
            </div>
        </div>
    <?php } } else { ?>
        <div class="col-12">
            <div class="alert alert-warning" role="alert">
                <strong><?=khongtimthayketqua?></strong>
            </div>
        </div>
    <?php } ?>
    </div>
</div>
<div class="pagination-home mb-xl-3"><?=$paging?></div>