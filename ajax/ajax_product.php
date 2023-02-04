<?php 
	include "ajax_config.php";

	/* Paginations */
	include LIBRARIES."class/class.PaginationsAjax.php";
	$pagingAjax = new PaginationsAjax();
	$pagingAjax->perpage = (htmlspecialchars($_GET['perpage']) && $_GET['perpage'] > 0) ? htmlspecialchars($_GET['perpage']) : 1;
	$eShow = htmlspecialchars($_GET['eShow']);
	$idList = (isset($_GET['idList']) && $_GET['idList'] > 0) ? htmlspecialchars($_GET['idList']) : 0;
	$p = (isset($_GET['p']) && $_GET['p'] > 0) ? htmlspecialchars($_GET['p']) : 1;
	$start = ($p-1) * $pagingAjax->perpage;
	$pageLink = "ajax/ajax_product.php?perpage=".$pagingAjax->perpage;
	$tempLink = "";
	$where = "";

	if($idList)
	{
		$tempLink .= "&idList=".$idList;
		$where .= " and id_list = ".$idList;
	}
	$tempLink .= "&p=";
	$pageLink .= $tempLink;

	$sql = "select ten$lang, tenkhongdauvi, tenkhongdauen, id, photo, gia, giamoi, giakm, type from #_product where type='san-pham' $where and spchinh > 0 and hienthi > 0 order by stt,id desc";
	$sqlCache = $sql." limit $start, $pagingAjax->perpage";
    $items = $cache->getCache($sqlCache,'result',7200);

	$countItems = count($cache->getCache($sql,'result',7200));

	$pagingItems = $pagingAjax->getAllPageLinks($countItems, $pageLink, $eShow, $p);
?>
<?php if($countItems) { ?>
	<div class="row">
		<?php foreach ($items as $v) { ?>
		<div class="col-6 col-sm-6 col-md-3 col-lg-3 col-product mb-3">
			<div class="col-product">
				<div class="box-product">
					<a href="<?=$v['tenkhongdau'.$lang]?>">
						<img src="<?=THUMBS?>/280x320x1/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>">
					</a>
					<div class="info-product">
						<h3><a href="<?=$v['tenkhongdau'.$lang]?>"><?=$v['ten'.$lang]?></a></h3>
					</div>
					<div class="price-product">
                        <?php if($v['giakm']) { ?>
                            <span class="price-new"><?=number_format($v['giamoi'],0, ',', '.').'đ'?></span>
                            <span class="price-old"><?=number_format($v['gia'],0, ',', '.').'đ'?></span>
                        <?php } else { ?>
                            <span class="price-new"><?=($v['gia'])?number_format($v['gia'],0, ',', '.').'đ':lienhe?></span>
                        <?php } ?>
                    </div>
				</div>
			</div>
		</div>	
		<?php } ?>
	</div>
	<div class="pagination-ajax"><?=$pagingItems?></div>
<?php } ?>