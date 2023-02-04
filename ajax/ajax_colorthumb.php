<?php
	include "ajax_config.php";
	
	$id_mau = htmlspecialchars($_POST['id_mau']);
	$idpro = htmlspecialchars($_POST['idpro']);
	$hinhanhsp = $d->rawQuery("SELECT photo, id_photo, id FROM #_gallery WHERE id_mau = ? AND id_photo = ? AND com = ? AND type = ? AND kind = ? AND val = ?",array($id_mau,$idpro,'product','san-pham','man','san-pham'));
	$row_detail = $d->rawQueryOne("SELECT ten$lang, photo FROM #_product WHERE id = ? AND type = ?",array($idpro,'san-pham'));
?>
<?php if(count($hinhanhsp)) { ?>
	<a id="Zoom-1" class="MagicZoom" data-options="zoomMode: off; hint: off; rightClick: true; selectorTrigger: hover; expandCaption: false; history: false;" href="<?=WATERMARK?>/product/540x540x1/<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" title="<?=$row_detail['ten'.$lang]?>"><img onerror="this.src='<?=THUMBS?>/540x540x2/assets/images/noimage.png';" src="<?=WATERMARK?>/product/540x540x1/<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" alt="<?=$row_detail['ten'.$lang]?>"></a>
    <?php if(count($hinhanhsp)>0) { ?>
    <div class="gallery-thumb-pro">
        <div class="owl-carousel owl-theme owl-carousel-loop in-page in-arrow-detail" data-dot="0" data-nav='1' data-loop='1' data-play='0' data-lg-items='5' data-md-items='4' data-sm-items='3' data-xs-items="2" data-margin='5'>
            <div><a class="thumb-pro-detail" data-zoom-id="Zoom-1" href="<?=WATERMARK?>/product/540x540x1/<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" title="<?=$row_detail['ten'.$lang]?>"><img class="img-block" onerror="this.src='<?=THUMBS?>/540x540x2/assets/images/noimage.png';" src="<?=WATERMARK?>/product/540x540x1/<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" alt="<?=$row_detail['ten'.$lang]?>"></a></div>
            <?php for($i=0;$i<count($hinhanhsp);$i++) { ?>
                <div><a class="thumb-pro-detail" data-zoom-id="Zoom-1" href="<?=WATERMARK?>/product/540x540x1/<?=UPLOAD_PRODUCT_L.$hinhanhsp[$i]['photo']?>" title="<?=$row_detail['ten'.$lang]?>"><img class="img-block" onerror="this.src='<?=THUMBS?>/540x540x2/assets/images/noimage.png';" src="<?=WATERMARK?>/product/540x540x1/<?=UPLOAD_PRODUCT_L.$hinhanhsp[$i]['photo']?>" alt="<?=$row_detail['ten'.$lang]?>"></a></div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
<?php } else { ?>
	<img onerror="this.src='<?=THUMBS?>/540x540x2/assets/images/noimage.png';" src="" alt="<?=khongtimthayketqua?>"/>
<?php } ?>