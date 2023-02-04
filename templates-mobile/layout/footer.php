<footer id="footer">
   <div class="container">
        <div class="footer-article">
            <div class="row flex items-start justify-between">
                <div class="footer-news last:mb-0 col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="info-footer"><?=htmlspecialchars_decode($footer['noidung'.$lang])?></div>
                    <ul class="social social-footer d-flex align-items-start">
                        <?php for($i=0;$i<count($social1);$i++) { ?>
                            <li><a href="<?=$social1[$i]['link']?>" target="_blank"><img src="<?=UPLOAD_PHOTO_L.$social1[$i]['photo']?>" alt="<?=$social1[$i]['ten'.$lang]?>"></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="footer-news last:mb-0 col-12 col-sm-12 col-md-12 col-lg-12">
                    <p class="title-footer">LEGAL</p>
                    <ul class="footer-ul">
                        <li><a href="terms-of-use">Terms of Use</a></li>
                        <li><a href="3dmodel-license">3D Model License</a></li>
                        <li class="last:!mb-0"><a href="privacy-policy">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="footer-news last:mb-0 col-12 col-sm-12 col-md-12 col-lg-12">
                    <p class="title-footer">SUBCRIBE TO OUR NEWS</p>
                    <div class="wrap-nhantin">
                        <form class="form-newsletter flex items-center" method="post" action="" enctype="multipart/form-data">
                            <div class="newsletter-input">
                                <input type="email" class="form-control" id="email-newsletter" name="email-newsletter" placeholder="Enter your email" required />
                            </div>
                            <div class="newsletter-button">
                                <button type="submit">Subcribe</button>
                            </div>
                        </form>
                        <p>By subscribing you confirm that you have read and accept our <a href="terms-of-use">Terms of Use</a></p>
                    </div>
                </div>
            </div>
        </div>
        <section id="footer-powered">
            <div class="container">
                <div class="wrap-content d-flex align-items-center justify-content-center">
                    <p class="copyright">Copyright 2023 3D Sky. Allright Reserved - Developed by A Website</p>
                </div>
            </div>
        </section>
   </div>
</footer>

