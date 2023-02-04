<?php
	session_start();
	@define('LIBRARIES','../libraries/');
	@define('SOURCES','./sources/');
	@define('TEMPLATE','./templates/');
	@define('LAYOUT','layout/');
	@define('THUMBS','../thumbs');
	@define('WATERMARK','../watermark');

	require_once LIBRARIES."config.php";
    require_once LIBRARIES.'autoload.php';
    new AutoLoad();
    $d = new PDODb($config['database']);
    $seo = new Seo($d);
    $emailer = new Email($d);
	$func = new Functions($d);
	$cache = new FileCache($d);
	require_once LIBRARIES."config-type.php";

	/* Lang Init */
	// require_once LIBRARIES."lang/langinit.php";

	/* Setting */
	$setting = $d->rawQueryOne("select * from #_setting");
	$optsetting = json_decode($setting['options'],true);

	/* Requick */
	require_once LIBRARIES."requick.php";
	if(isset($_GET['elfinder'])){	
		require_once "elfinder/php/connectorminimal.php";
		exit;
	}

?>
<!DOCTYPE html>
<html lang="vi" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="assets/images/logo-12.png" />
	<title>Administrator - <?=$setting['tenvi']?></title>
	<meta name="google_font_api" content="AIzaSyBG58yNdAjc20_8jAvLNSVi9E4Xhwjau_k">
	<meta name="setting_options" content='{&quot;saveLocal&quot;:&quot;sessionStorage&quot;,&quot;storeKey&quot;:&quot;huisetting&quot;,&quot;setting&quot;:{&quot;app_name&quot;:{&quot;value&quot;:&quot;A Website&quot;},&quot;theme_scheme_direction&quot;:{&quot;value&quot;:&quot;ltr&quot;},&quot;theme_scheme&quot;:{&quot;value&quot;:&quot;light&quot;},&quot;theme_style_appearance&quot;:{&quot;value&quot;:[&quot;theme-default&quot;]},&quot;theme_color&quot;:{&quot;colors&quot;:{&quot;--{{prefix}}primary&quot;:&quot;#3a57e8&quot;,&quot;--{{prefix}}info&quot;:&quot;#08B1BA&quot;},&quot;value&quot;:&quot;theme-color-default&quot;},&quot;theme_transition&quot;:{&quot;value&quot;:&quot;theme-with-animation&quot;},&quot;theme_font_size&quot;:{&quot;value&quot;:&quot;theme-fs-sm&quot;},&quot;page_layout&quot;:{&quot;value&quot;:&quot;container-fluid&quot;},&quot;header_navbar&quot;:{&quot;value&quot;:&quot;default&quot;},&quot;header_banner&quot;:{&quot;value&quot;:&quot;default&quot;},&quot;sidebar_color&quot;:{&quot;value&quot;:&quot;sidebar-white&quot;},&quot;card_color&quot;:{&quot;value&quot;:&quot;card-default&quot;},&quot;sidebar_type&quot;:{&quot;value&quot;:[]},&quot;sidebar_menu_style&quot;:{&quot;value&quot;:&quot;left-bordered&quot;},&quot;footer&quot;:{&quot;value&quot;:&quot;default&quot;},&quot;body_font_family&quot;:{&quot;value&quot;:null},&quot;heading_font_family&quot;:{&quot;value&quot;:null}}}'>
	<link rel="stylesheet" href="assets/css/core/libs.min.css" />
	<link href="../assets/fontawesome512/all-admin.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/main-tailwind.css?time=<?=time()?>"/>
    <link rel="stylesheet" href="assets/vendor/flatpickr/dist/flatpickr.min.css" />
    <link rel="stylesheet" href="assets/vendor/sheperd/dist/css/sheperd.css">
	<link rel="stylesheet" href="assets/vendor/button-hover/css/hover-min.css"/>
	<link rel="stylesheet" href="assets/vendor/sweetalert2/dist/sweetalert2.min.css"/>
    <link rel="stylesheet" href="assets/css/hope-ui.min.css" />
    <link rel="stylesheet" href="assets/css/pro.min.css" />
    <link rel="stylesheet" href="assets/css/custom.min.css" />
    <link rel="stylesheet" href="assets/filer/jquery.filer.css">
	<link rel="stylesheet" href="assets/filer/jquery.filer-dragdropbox-theme.css">
	<link rel="stylesheet" href="assets/rangeSlider/ion.rangeSlider.css" >
    <link rel="stylesheet" href="assets/css/custom.css" />
    <link rel="stylesheet" href="assets/css/dark.min.css"/>
    <link rel="stylesheet" href="assets/css/customizer.min.css" />
    <link rel="stylesheet" href="assets/css/rtl.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="assets/js/core/libs.min.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
		CKEDITOR.editorConfig = function( config ) {
			/* Config General */
			config.language = 'vi';
			config.skin = 'n1theme';
			config.width = 'auto';
			config.height = 420;

			/* Allow element */
			config.allowedContent = true;

			/* Entities */
			config.entities = false;
			config.entities_latin = false;
			config.entities_greek = false;
			config.basicEntities = false;

			/* Config CSS */
			config.contentsCss =
			[
				'<?=$config_base?>/admin/ckeditor/contents.css'
			];

			/* All Plugins */
			config.extraPlugins = 'texttransform,copyformatting,html5video,html5audio,flash,youtube,wordcount,tableresize,widget,lineutils,clipboard,dialog,dialogui,widgetselection,lineheight,video,videodetector';

			/* Config Lineheight */
			config.line_height = '1;1.1;1.2;1.3;1.4;1.5;2;2.5;3;3.5;4;4.5;5';

			/* Config Word */
			config.pasteFromWordRemoveFontStyles = false;
			config.pasteFromWordRemoveStyles = false;
			
			/* Config CKFinder */
			config.filebrowserBrowseUrl = 'elfinder/index.php';
			

			/* Config ToolBar */
			config.toolbar = [
				{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
				{ name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', 'PasteFromExcel', '-', 'Undo', 'Redo' ] },
				{ name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
				{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
				{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
				'/',
				{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
				{ name: 'texttransform', items: [ 'TransformTextToUppercase', 'TransformTextToLowercase', 'TransformTextCapitalize', 'TransformTextSwitcher' ] },
				{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
				'/',
				{ name: 'insert', items: [ 'Image', 'Flash', 'Youtube', 'VideoDetector', 'Html5video', 'Video', 'Html5audio', 'Iframe', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak' ] },
				'/',
				{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize', 'lineheight' ] },
				{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
				{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
				{ name: 'about', items: [ 'About' ] }
			];
			
			/* Config StylesSet */
			config.stylesSet = [
			    { name : 'Font Seguoe Regular', element : 'span', attributes : { 'class' : 'segui' } },
			    { name : 'Font Seguoe Semibold', element : 'span', attributes : { 'class' : 'seguisb' } },
			    { name:'Italic title', element:'span', styles:{'font-style':'italic'} },
			    { name:'Special Container', element:'div', styles:{'background' : '#eee', 'border' : '1px solid #ccc', 'padding' : '5px 10px'} },
			    { name:'Big', element:'big' },
			    { name:'Small', element:'small' },
			    { name:'Inline ', element:'q' },
			    { name : 'marker', element : 'span', attributes : { 'class' : 'marker' } }
			];
			
			/* Config Wordcount */
			config.wordcount = {
			    showParagraphs: true,
			    showWordCount: true,
			    showCharCount: true,
			    countSpacesAsChars: false,
			    countHTML: false,
			    filter: new CKEDITOR.htmlParser.filter({
			        elements: {
			            div: function( element ) {
			                if(element.attributes.class == 'mediaembed') {
			                    return false;
			                }
			            }
			        }
			    })
			};
		};
	</script>
</head>
<body class="">
    <!-- Wrapper -->
	<?php if(isset($_SESSION[$login_admin]) && ($_SESSION[$login_admin] == true)) { ?>
		<!-- loader Start -->
        <!-- <div id="loading">
	        <div class="loader simple-loader">
	            <div class="loader-body">
	                <img src="assets/images/loader.webp" alt="loader" class="light-loader img-fluid w-25" width="200" height="200">
	            </div>
	        </div>
        </div> -->
         <!-- loader END -->
        <?php include TEMPLATE.LAYOUT."menu.php"; ?>
        <main class="main-content">
        	<div class="position-relative iq-banner">
        		<?php include TEMPLATE.LAYOUT."header.php";?>
        	</div>
			<?php include TEMPLATE.$template."_tpl.php"; ?>
			<div class="wrapper d-none">
				<div class="content-wrapper">
					<?php if($alertlogin) { ?>
						<section class="content">
							<div class="container-fluid">
								<div class="alert my-alert alert-warning alert-dismissible text-sm bg-gradient-warning mt-3 mb-0">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<i class="icon fas fa-exclamation-triangle"></i> <?=$alertlogin?>
								</div>
							</div>
						</section>
					<?php } ?>
				</div>
			</div>
			<?php include TEMPLATE.LAYOUT."footer.php"; ?>
		</main>
		<?php include TEMPLATE.LAYOUT."style.php";?>
	<?php } else { include TEMPLATE."user/login_tpl.php"; } ?>
	<script type="text/javascript">
		var IDMUC=<?=($id)?$id:0?>,COM='<?=($com)?$com:""?>',KIND='<?=($act)?$act:""?>',TYPE='<?=($type)?$type:""?>';
	</script>
    <script src="assets/js/plugins/slider-tabs.js"></script>
    <script src="assets/vendor/lodash/lodash.min.js"></script>
    <script src="assets/js/iqonic-script/utility.min.js"></script>
    <script src="assets/js/iqonic-script/setting.js"></script>
    <script src="assets/js/setting-init.js"></script>
	<script src="assets/js/plugins/select2.js" defer></script>
    <script src="assets/js/core/external.min.js"></script>
    <script src="assets/js/charts/widgetcharts.js"></script>
    <script src="assets/js/charts/dashboard.js"></script>
    <script src="assets/vendor/sweetalert2/dist/sweetalert2.min.js" async></script>
    <script src="assets/js/hope-ui.js"></script>
    <script src="assets/js/hope-uipro.js"></script>
	<script src="assets/vendor/flatpickr/dist/flatpickr.min.js" defer></script>
	<script src="assets/rangeSlider/ion.rangeSlider.js" defer></script>
    <script src="assets/filer/jquery.filer.js" defer></script>
    <script src="assets/js/priceFormat.js" defer></script>
    <script src="assets/jscolor/jscolor.js" defer></script>
    <script src="assets/js/main.js" defer></script>
</body>
</html>