<?php
	if(!defined('LIBRARIES')) die("Error");

	/* Timezone */
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	define('ROOT',__DIR__);
	/* Cấu hình coder */
	define('NN_MSHD','3dsky');
	/* Cấu hình chung */
	$config = array(
		'arrayDomainSSL' => array(),
		'database' => array(
			'server-name' => $_SERVER["SERVER_NAME"],
			'url' => '/3dsky/',
			'type' => 'mysql',
			'host' => 'localhost',
			'username' => 'root',
			'password' => '',
			'dbname' => '3dsky',
			'port' => 3306,
			'prefix' => 'table_',
			'charset' => 'utf8'
		),
		'website' => array(
			'error-reporting' => false,
			'secret' => '$nina@',
			'salt' => 'N1$&Yo$F,2',
			'debug-developer' => true,
			'debug-css' => true,
			'debug-js' => true,
			'index' => false,
			'reponsive' => false,
			'upload' => array(
				'max-width' => 1600,
				'max-height' => 1600
			),
			'lang' => array(
				'vi'=>'Tiếng Anh',
			),
			'lang-doc' => 'en',
			'slug' => array(
				'vi'=>'Tiếng Anh'
			),
			'seo' => array(
				'vi'=>'Tiếng Anh'
			),
			'comlang' => array(
				"gioi-thieu" => array("vi"=>"gioi-thieu"),
				"san-pham" => array("vi"=>"san-pham"),
				"tin-tuc" => array("vi"=>"tin-tuc"),
				"tuyen-dung" => array("vi"=>"tuyen-dung"),
				"thu-vien-anh" => array("vi"=>"thu-vien-anh"),
				"video" => array("vi"=>"video"),
				"lien-he" => array("vi"=>"lien-he")
			)
		),
		'order' => array(
			'check' => true,
			'coupon' => true,
			'ship' => true
		),
		'login' => array(
			'admin' => 'LoginAdmin'.NN_MSHD,
			'member' => 'LoginMember'.NN_MSHD,
			'attempt' => 5,
			'delay' => 15
		),
		'googleAPI' => array(
			'recaptcha' => array(
				'active' => false,
				'urlapi' => 'https://www.google.com/recaptcha/api/siteverify',
				'sitekey' => '6LezS5kUAAAAAF2A6ICaSvm7R5M-BUAcVOgJT_31',
				'secretkey' => '6LezS5kUAAAAAGCGtfV7C1DyiqlPFFuxvacuJfdq'
			)
		),
		'oneSignal' => array(
			'active' => false,
			'id' => 'af12ae0e-cfb7-41d0-91d8-8997fca889f8',
			'restId' => 'MWFmZGVhMzYtY2U0Zi00MjA0LTg0ODEtZWFkZTZlNmM1MDg4'
		),
		'ckeditor' => array(
			'folder' => "upload/ckfinder/"
		),
		'license' => array(
			'version' => "7.0.0"
		)
	);
	/*UXI6CXVR*/
	/* Error reporting */
	error_reporting(($config['website']['error-reporting']) ? E_ALL & ~E_NOTICE : 0);

	/* Cấu hình base */
	if($config['arrayDomainSSL']) require_once LIBRARIES."checkSSL.php";
	$http = 'http';
    if(!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") $http .= "s";
    $http .= "://";
	$config_base = $http.$config['database']['server-name'].$config['database']['url'];

	/* Cấu hình ckeditor */
	$_SESSION['baseUrl'] = $config_base.$config['ckeditor']['folder'];

	/* Cấu hình login */
	$login_admin = $config['login']['admin'];
	$login_member = $config['login']['member'];

	/* Cấu hình upload */
	require_once LIBRARIES."constant.php";

	$config['paypal']['url'] = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
	$config['paypal']['id'] = 'sb-kylvv8273778@business.example.com';
	$config['paypal']['return'] = $config_base.'complete';
	$config['paypal']['cancel_return'] = $config_base.'paypal_cancel.php';
	//$config['paypal']['notify_url'] = $config_base.'paypal_ipn.php';
	$config['paypal']['notify_url'] = 'https://5f92-113-161-89-144.ap.ngrok.io/3dSky/paypal_ipn.php';
	$config['paypal']['use_sandbox'] = true; 
	$config['paypal']['receiver_email'] = 'sb-kylvv8273778@business.example.com';
?>