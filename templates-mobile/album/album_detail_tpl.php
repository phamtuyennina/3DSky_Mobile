<div class="container">
	<div class="title-main"><h1><span><?=$row_detail['ten'.$lang]?></span></h1></div>
	<div class="content-main mt-xl-3 row d-flex flex-wrap justify-content-start">
	    <?php if(count($hinhanhsp)>0) { for($i=0;$i<count($hinhanhsp);$i++) { ?>
			<div class="col-6 col-sm-4 col-lg-4 album mb-xl-4">
                <div class="pic-album scale-img">
                    <a class="text-decoration-none" data-fancybox="gallery" href="<?=UPLOAD_PRODUCT_L.$hinhanhsp[$i]['photo']?>" title="<?=$product[$i]['ten'.$lang]?>">
                        <img class="img-block" onerror="this.src='<?=THUMBS?>/480x360x2/assets/images/noimage.png';" src="<?=THUMBS?>/480x360x1/<?=UPLOAD_PRODUCT_L.$hinhanhsp[$i]['photo']?>" alt="<?=$row_detail['ten'.$lang]?>"/>
                    </a>
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