<div class="box-news-detail">
    <?php /*<div class="left-news-detail"><?php */?>
        <div class="title-main-news"><h1><span><?=$row_detail['ten'.$lang]?></span></h1></div>
        <div class="time-main"><i class="fas fa-calendar-week"></i><span><?=ngaydang?>: <?=date("d/m/Y h:i A", $row_detail['ngaytao'])?></span></div>
        <?php if($row_detail['noidung'.$lang]) { ?>
        <div class="meta-toc">
            <div class="box-readmore">
                <ul class="toc-list" data-toc="article" data-toc-headings="h1, h2, h3"></ul>
            </div>
        </div>
        <div class="content-main info-news-detail" id="toc-content"><?=htmlspecialchars_decode($row_detail['noidung'.$lang])?></div>
        <div class="share mt-3">
            <b><?=chiase?>:</b>
            <div class="social-plugin">
                <div class="addthis_inline_share_toolbox_qj48"></div>
                <div class="zalo-share-button" data-href="<?=$func->getCurrentPageURL()?>" data-oaid="<?=($optsetting['oaidzalo']!='')?$optsetting['oaidzalo']:'579745863508352884'?>" data-layout="1" data-color="blue" data-customize=false></div>
            </div>
        </div>
        <?php } else { ?>
        <div class="alert alert-warning" role="alert">
            <strong><?=noidungdangcapnhat?></strong>
        </div>
        <?php } ?>
        <div class="share othernews mt-3">
            <h6><?=baivietkhac?>:</h6>
            <ul class="list-news-other">
                <?php foreach($news as $k => $v) { ?>
                    <li><a class="text-decoration-none" href="<?=$v[$sluglang]?>" title="<?=$v['ten'.$lang]?>">
                        - <?=$v['ten'.$lang]?> (<?=date("d/m/Y",$v['ngaytao'])?>)
                    </a></li>
                <?php } ?>
            </ul>
            <div class="pagination-home mt-xl-3"><?=$paging?></div>
        </div>
    <?php /*</div><?php */?>
    <?php /*
    <div class="right-news-detail">
        <div class="other-title">
            <h5>Mọi người hay đọc</h5>
            <a href="<?=$com?>" title="">Xem thêm</a>
        </div>
        <div class="other-desc">
            <?php if(count($news_other)>0) { foreach($news_other as $k => $v) { ?>
            <div class="news-other">
                <div class="pic-news">
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
                </div>
            </div>
        <?php } } ?>
        </div>
    </div>*/?>
</div>