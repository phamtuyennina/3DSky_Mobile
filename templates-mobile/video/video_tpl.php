<div class="container">
    <div class="title-main"><h1><span><?=$title_crumb?></span></h1></div>
    <div class="content-main mt-xl-3 row d-flex flex-wrap justify-content-start">
        <?php if(count($video)>0) { for($i=0;$i<count($video);$i++) { ?>
            <div class="col-6 col-sm-4 col-lg-4 video mb-xl-4">
                <div class="pic-video scale-img">
                    <a class="text-decoration-none" data-fancybox="video" href="<?=$video[$i]['link_video']?>" title="<?=$product[$i]['ten'.$lang]?>">
                        <img class="img-block" onerror="this.src='<?=THUMBS?>/480x360x2/assets/images/noimage.png';" src="https://img.youtube.com/vi/<?=$func->getYoutube($video[$i]['link_video'])?>/0.jpg" alt="<?=$video[$i]['ten'.$lang]?>"/>
                    </a>
                </div>
                <h3 class="name-video text-split"><?=$video[$i]['ten'.$lang]?></h3>
            </div>
        <?php } } else { ?>
            <div class="alert alert-warning" role="alert">
                <strong><?=khongtimthayketqua?></strong>
            </div>
        <?php } ?>
        <div class="clear"></div>
        
    </div>
    <div class="pagination-home"><?=$paging?></div>
</div>