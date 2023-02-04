<meta name="viewport" content="width=1349">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
<?php
    $css->setCache("cached");
    $css->setCss("./assets/css/animate.min.css");
    $css->setCss("./assets/engine1/style_slider.css");
    $css->setCss("./assets/bootstrap/css/bootstrap.css");
    $css->setCss("./assets/css/all.css");
    $css->setCss("./assets/fancybox3/jquery.fancybox.min.css");
    $css->setCss("./assets/fancybox3/jquery.fancybox.style.css");
    $css->setCss("./assets/slick/slick.css");
    $css->setCss("./assets/slick/slick-theme.css");
    $css->setCss("./assets/slick/slick-style.css");
    $css->setCss("./assets/magiczoomplus/magiczoomplus.css");
    $css->setCss("./assets/owlcarousel2/owl.carousel.css");
    $css->setCss("./assets/owlcarousel2/owl.theme.default.css");
    $css->setCss("./assets/css/flickity.css");
    $css->setCss("./assets/css/main-style.css");
    $css->setCss("./assets/css/HoldOn.css");
    $css->setCss("./assets/css/style.css");
    echo $css->getCss();
?>

<?php if($config['googleAPI']['recaptcha']['active']) { ?>
    <script src="https://www.google.com/recaptcha/api.js?render=<?=$config['googleAPI']['recaptcha']['sitekey']?>"></script>
    <script type="text/javascript">
        grecaptcha.ready(function () {
            grecaptcha.execute('<?=$config['googleAPI']['recaptcha']['sitekey']?>', { action: 'Newsletter' }).then(function (token) {
                var recaptchaResponseNewsletter = document.getElementById('recaptchaResponseNewsletter');
                recaptchaResponseNewsletter.value = token;
            });
            <?php if($source=='contact') { ?>
                grecaptcha.execute('<?=$config['googleAPI']['recaptcha']['sitekey']?>', { action: 'contact' }).then(function (token) {
                    var recaptchaResponseContact = document.getElementById('recaptchaResponseContact');
                    recaptchaResponseContact.value = token;
                });
            <?php } ?>
        });
    </script>
<?php } ?>
<?=htmlspecialchars_decode($setting['analytics'])?>
<?=htmlspecialchars_decode($setting['headjs'])?>