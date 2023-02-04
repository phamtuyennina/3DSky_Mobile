<?php
if(!empty($_GET)){
	session_start();
    @define('LIBRARIES','./libraries/');
    @define('SOURCES','./sources/');
    @define('LAYOUT','layout/');
    @define('THUMBS','thumbs');
    @define('WATERMARK','watermark');

    /* Config */
    require_once LIBRARIES."config.php";
    require_once LIBRARIES.'autoload.php';
    new AutoLoad();
    $injection = new AntiSQLInjection();
    $d = new PDODb($config['database']);
    $seo = new Seo($d);
    $emailer = new Email($d);
    $router = new AltoRouter();
    $cache = new FileCache($d);
    $func = new Functions($d);
    $breadcr = new BreadCrumbs($d);
    $statistic = new Statistic($d);
    $cart = new Cart($d);
    $detect = new MobileDetect();
    $addons = new AddonsOnline();
    $css = new CssMinify($config['website']['debug-css'], $func);
    $js = new JsMinify($config['website']['debug-js'], $func);

    /* Router */
    require_once LIBRARIES."router.php";
	$item_name = $_GET['item_name'];
	$arr = explode('#', $item_name); 
	$madonhang = $arr[1];
	$payment_status = $_GET['st'];
	// if($payment_status=='Completed'){
 //        unset($_SESSION['cart']);
 //       // $func->transfer('Order payment successfully: '.$madonhang, $config_base);
 //    }else{
 //       // $func->transfer('Payment failed: '.$madonhang, $config_base);
 //    }
    
    include TEMPLATE."index.php";
}
?>
