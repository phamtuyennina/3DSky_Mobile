<section class="page-account py-5">
    <div class="container">
        <div class="row row-account">
            <div class="col-3 col-lg-3 col-account col-left-account">
                <div class="bgBg">
                    <?php include TEMPLATE.LAYOUT."left-account.php" ?>
                </div>
            </div>
            <div class="col-9 col-lg-9 col-account col-right-account">
                <div class="bgBg">
                    <div class="ttile-account">
                        <h2>Purchases</h2>
                    </div>
                    <div class="grid grid-cols-4">
                        <?php foreach ($product as $k => $v) {?>
                        <div class="col-custom">
                            <span></span>
                            <span></span>
                            <div class="box-model">
                                <a href="<?=$v['tenkhongdauvi']?>">
                                    <img class="img-block" onerror="this.src='<?=THUMBS?>/206x206x1/assets/images/noimage.png';" src="<?=THUMBS?>/206x206x1/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>">
                                </a>
                                <div class="info-box-model">
                                    <h3 class="text-split-1" title="<?=$v['ten'.$lang]?>"><?=$v['ten'.$lang]?></h3>
                                    <a href="<?=$v['taptin']?>" download> Download </a>
                                </div>  
                            </div>
                        </div>
                        <?php }?>
                    </div>
                    <div class="pagination-home mb-xl-3"><?=$paging?></div>
                </div>
            </div>
        </div>
    </div>
</section>
