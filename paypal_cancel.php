<?php

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
    $detect = new MobileDetect();
    $statistic = new Statistic($d);
    $cart = new Cart($d);
    $lang = $_SESSION['lang'];
    require_once LIBRARIES."lang/lang$lang.php";
    
	$func->transfer('Order cancel successfully', $config_base);

?>
