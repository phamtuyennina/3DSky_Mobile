<?php  
	if(!defined('SOURCES')) die("Error");
	$item_name = $_GET['item_name'];
	$arr = explode('#', $item_name);
    $order_code = explode('-', $arr[1]);
	$payment_status = $_GET['st'];
	if($title_crumb) $breadcr->setBreadCrumbs($com,$title_crumb);
	$breadcrumbs = $breadcr->getBreadCrumbs();
	$madonhang = (!empty($_GET['order-code']))?$_GET['order-code']:$order_code[1];


	$myOrderCheck=$d->rawQueryOne("select * from #_order where madonhang=? order by ngaytao desc",array($madonhang));
	$func->transfer('Processing is successful, we will notify you when completed', $config_base);

	

?>