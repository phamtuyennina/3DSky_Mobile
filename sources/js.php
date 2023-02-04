<script src="assets/js/jquery.min.js"></script>
<script type="text/javascript">
    var NN_FRAMEWORK = NN_FRAMEWORK || {};
    var CONFIG_BASE = '<?=$config_base?>';
    var WEBSITE_NAME = '<?=($setting['ten'.$lang]) ? $setting['ten'.$lang] : $setting['title'.$seolang]?>';
    var TIMENOW = '<?=date("Y/m/d",time())?>';
    var SHIP_CART = <?=($config['order']['ship']) ? 'true' : 'false'?>;
    var GOTOP = 'assets/images/top.png';
    var IS_LOGIN=<?=(!empty($rowUser))?"true":"false"?>;
    var LANG = {
        'no_keywords': '<?=chuanhaptukhoatimkiem?>',
        'delete_product_from_cart': '<?=banmuonxoasanphamnay?>',
        'no_products_in_cart': '<?=khongtontaisanphamtronggiohang?>',
        'no_coupon': '<?=chuanhapmauudai?>',
        'wards': '<?=phuongxa?>',
        'back_to_home': '<?=vetrangchu?>',
    };
</script>
<?php
    $js->setCache("cached");
    $js->setJs("./assets/js/popper.min.js");
    $js->setJs("./assets/bootstrap/js/bootstrap.js");
    $js->setJs("./assets/mmenu/mmenu.js");
    $js->setJs("./assets/owlcarousel2/owl.carousel.js");
    $js->setJs("./assets/magiczoomplus/magiczoomplus.js");
    $js->setJs("./assets/slick/slick.js");
    $js->setJs("./assets/fancybox3/jquery.fancybox.min.js");
    $js->setJs("./assets/toc/toc.js");
    $js->setJs("./assets/js/functions.js");
    $js->setJs("./assets/engine1/wowslider.js");
    $js->setJs("./assets/engine1/script.js");
    $js->setJs("./assets/js/masonry.pkgd.min.js");
    $js->setJs("./assets/js/flickity.pkgd.min.js");
    $js->setJs("./assets/js/smooth-scrollbar.js");
    $js->setJs("./assets/js/HoldOn.js");
    $js->setJs("./assets/js/app.js");
    echo $js->getJs();
?>
<?php if($config['oneSignal']['active']) { ?>
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script type="text/javascript">
        var OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "<?=$config['oneSignal']['id']?>"
            });
        });
    </script>
<?php } ?>
<?=$addons->setAddons('script-main', 'script-main', 0.5);?>
<?=$addons->getAddons();?>
<?=htmlspecialchars_decode($setting['bodyjs'])?>



