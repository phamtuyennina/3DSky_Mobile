<div class="container">
    <div class="title-main"><h1><span><?=$title_crumb?></span></h1></div>
    <div class="content-main mt-xl-3 row d-flex flex-wrap justify-content-start">
        <?php if(count($product)>0) { for($i=0;$i<count($product);$i++) { ?>
            <div class="col-6 col-sm-4 col-lg-4 album mb-xl-3">
                <div class="pic-album scale-img">
                    <a class="text-decoration-none" href="<?=$product[$i][$sluglang]?>" title="<?=$product[$i]['ten'.$lang]?>">
                        <img class="img-block" onerror="this.src='<?=THUMBS?>/480x360x2/assets/images/noimage.png';" src="<?=THUMBS?>/480x360x1/<?=UPLOAD_PRODUCT_L.$product[$i]['photo']?>" alt="<?=$product[$i]['ten'.$lang]?>"/>
                    </a>
                </div>
                <h3 class="name-album text-split">
                    <a class="text-decoration-none" href="<?=$product[$i][$sluglang]?>" title="<?=$product[$i]['ten'.$lang]?>">
                        <?=$product[$i]['ten'.$lang]?>
                    </a>
                </h3>
            </div>
        <?php } } else { ?>
        <div class="col-12">
            <div class="alert alert-warning" role="alert">
                <strong><?=khongtimthayketqua?></strong>
            </div>
        </div>
        <?php } ?>
        <div class="clear"></div>
    </div>
    <div class="pagination-home"><?=$paging?></div>
</div>