<?php

	/* Validate URL */
	$func->checkUrl($config['website']['index']);
	
	/* Check login */
    $func->checkLogin();

	/* Mobile detect */
    $deviceType = ($detect->isMobile() || $detect->isTablet()) ? 'mobile' : 'computer';
   	$deviceType ='mobile';
    if($deviceType == 'computer') @define('TEMPLATE','./templates/');
    else @define('TEMPLATE','./templates-mobile/');

    /* Watermark */
    $wtmPro = $d->rawQueryOne("SELECT hienthi, photo, options FROM #_photo WHERE type = ? AND act = ? LIMIT 0,1",array('watermark','photo_static'));
	$wtmNews = $d->rawQueryOne("SELECT hienthi, photo, options FROM #_photo WHERE type = ? AND act = ? LIMIT 0,1",array('watermark-news','photo_static'));

    /* Router */

    $router->setBasePath($config['database']['url']);
    $router->map('GET',array('admin/','admin'), function(){
		global $func, $config;
		$func->redirect($config['database']['url']."admin/index.php");
		exit;
	});
	$router->map('GET',array('admin','admin'), function(){
		global $func, $config;
		$func->redirect($config['database']['url']."admin/index.php");
		exit;
	});

    $router->map('GET|POST', '', 'index', 'home');
    $router->map('GET|POST', 'index.php', 'index', 'index');
    $router->map('GET|POST', 'sitemap.xml', 'sitemap', 'sitemap');
    $router->map('GET|POST', '[a:com]', 'allpage', 'show');
    $router->map('GET|POST', '[a:com]/[a:lang]/', 'allpagelang', 'lang');
    $router->map('GET|POST', '[a:com]/[a:action]', 'account', 'account');
    $router->map('GET', THUMBS.'/[i:w]x[i:h]x[i:z]/[**:src]', function($w,$h,$z,$src){
        global $func;
        $func->createThumb($w,$h,$z,$src,null,THUMBS);
    },'thumb');
    $router->map('GET', WATERMARK.'/product/[i:w]x[i:h]x[i:z]/[**:src]', function($w,$h,$z,$src){
        global $func, $wtmPro;
        $func->createThumb($w,$h,$z,$src,$wtmPro,"product");
    },'watermark');
    $router->map('GET', WATERMARK.'/news/[i:w]x[i:h]x[i:z]/[**:src]', function($w,$h,$z,$src){
        global $func, $wtmNews;
        $func->createThumb($w,$h,$z,$src,$wtmNews,"news");
    },'watermarkNews');
    $match = $router->match();
	if(is_array($match)){
		if(is_callable($match['target'])){
			call_user_func_array($match['target'], $match['params']); 
		}else{
			$com = (isset($match['params']['com'])) ? htmlspecialchars($match['params']['com']) : htmlspecialchars($match['target']);
			$get_page = isset($_GET['p']) ? htmlspecialchars($_GET['p']) : 1;
		}
	}else{
		header($_SERVER["SERVER_PROTOCOL"].'404 Not Found');
		include("404.php");
		exit;
	}

    /* Setting */
    $sqlCache = "select * from #_setting";
    $setting = $cache->getCache($sqlCache,'fetch',600);
    $optsetting = json_decode($setting['options'],true);

    /* Lang */
    $_SESSION['lang'] = (isset($_SESSION['lang'])) ? $_SESSION['lang']:'vi';
    if(isset($match['params']['lang'])) $_SESSION['lang'] = $match['params']['lang'];
    else if(!isset($_SESSION['lang']) && !isset($match['params']['lang'])) $_SESSION['lang'] = $optsetting['lang_default'];
    $lang = $_SESSION['lang'];

    /* Slug lang */
    $sluglang = 'tenkhongdauvi';

    /* SEO Lang */
    $seolang = "vi";

    /* Require datas */
    require_once LIBRARIES."lang/lang$lang.php";
    require_once SOURCES."allpage.php";
    if(!empty($_SESSION[$login_member]['id'])){
    	$rowUser=$d->rawQueryOne("select * from #_member where id=?",array($_SESSION[$login_member]['id']));
    }
	/* Tối ưu link */
	$requick = array(
		array("tbl"=>"product","field"=>"id","source"=>"product","com"=>"3d-models","type"=>"san-pham",'menu'=>true),
		/* Trang tĩnh */
		array("tbl"=>"static","field"=>"id","source"=>"static","com"=>"terms-of-use","type"=>"terms-of-use",'menu'=>true),
		array("tbl"=>"static","field"=>"id","source"=>"static","com"=>"3dmodel-license","type"=>"3dmodel-license",'menu'=>true),
		array("tbl"=>"static","field"=>"id","source"=>"static","com"=>"privacy-policy","type"=>"privacy-policy",'menu'=>true),
		/* Liên hệ */
		array("tbl"=>"","field"=>"id","source"=>"","com"=>"support","type"=>"",'menu'=>true),
	);

	/* Find data */
	if($com != 'tim-kiem' && $com != 'account' && $com != 'sitemap')
	{
		foreach($requick as $k => $v)
		{
			$url_tbl = $v['tbl'];
			$url_tbltag = (isset($v['tbltag'])) ? $v['tbltag']:'';
			$url_type = $v['type'];
			$url_field = $v['field'];
			$url_com = $v['com'];
			
			if($url_tbl!='' && $url_tbl!='static' && $url_tbl!='photo')
			{
				$row = $d->rawQueryOne("select id from #_$url_tbl where $sluglang = ? and type = ? and hienthi=1",array($com,$url_type));
				
				if($row['id'])
				{
					$_GET[$url_field] = $row['id'];
					$com = $url_com;
					break;
				}
			}
		}
	}

	/* Switch coms */
	switch($com)
	{
		case 'support':
			$source = "contact";
			$template = "contact/contact";
			$seo->setSeo('type','object');
			$title_crumb = 'support';
			break;


		case 'terms-of-use':
			$source = "static";
			$template = "static/static";
			$type = $com;
			$seo->setSeo('type','article');
			$title_crumb = 'Terms Of Use';
			break;

		case '3dmodel-license':
			$source = "static";
			$template = "static/static";
			$type = $com;
			$seo->setSeo('type','article');
			$title_crumb = '3D Model License';
			break;

		case 'privacy-policy':
			$source = "static";
			$template = "static/static";
			$type = $com;
			$seo->setSeo('type','article');
			$title_crumb = 'Privacy Policy';
			break;

		case 'complete':
			$source = "complete";
			$template = 'order/complete';
			$seo->setSeo('type','object');
			break;

		case '3d-models':
			$source = "product";
			$template = isset($_GET['id']) ? "product/product_detail" : "product/product";
			$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
			$type = 'san-pham';
			$title_crumb = '3D Models';
			break;

		case 'tim-kiem':
			$source = "search";
			$template = "news/news";
			$seo->setSeo('type','object');
			$title_crumb = timkiem;
			break;

		case 'tags-san-pham':
			$source = "tags";
			$template = "product/product";
			$type = $url_type;
			$table = $url_tbltag;
			$seo->setSeo('type','object');
			break;

		case 'account':
			$source = "user";
			break;

		case 'ngon-ngu':
			if(isset($lang))
			{
				switch($lang)
				{
					case 'vi':
						$_SESSION['lang'] = 'vi';
						break;
					case 'en':
						$_SESSION['lang'] = 'en';
						break;
					default:
						$_SESSION['lang'] = 'vi';
						break;
				}
			}
			$func->redirect($_SERVER['HTTP_REFERER']);
			break;

		case 'sitemap':
			include_once LIBRARIES."sitemap.php";
			exit();
			
		case '':
		case 'index':
			$source = "index";
			$template ="layout/index";
			$seo->setSeo('type','website');
			break;

		default: 
			header('HTTP/1.0 404 Not Found', true, 404);
			include("404.php");
			exit();
	}

	/* Include sources */
	if($source!='') include SOURCES.$source.".php";
	if($template=='')
	{
		header('HTTP/1.0 404 Not Found', true, 404);
		include("404.php");
		exit();
	}
?>