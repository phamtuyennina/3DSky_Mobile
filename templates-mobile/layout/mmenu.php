<div class="opacity-menu"></div>
<div class="header-left-fixwidth">
    <div class="section wrap-header">
        <div class="wrap-mmenu-header flex items-center justify-between">
            <div class="logos-menu">
                <a class="logo-header" href=""><img src="<?=UPLOAD_PHOTO_L.$logo['photo']?>"/></a>
            </div>
            <div class="close-mmenu">
                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
                    <path d="M33 33L1 1" stroke="#9A9A9A" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M33 1L1 33" stroke="#9A9A9A" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </div>
        </div>
        <?php if(empty($rowUser)){?>
        <div class="wrap-mmenu-user account-header flex justify-between items-center">
            <p class="no-login flex items-center justify-between">
                <a href="account/login"><span>Login</span></a>
                <a href="account/sign-up" class="last:ml-0"><span>SIGN UP</span></a>
            </p>        
        </div>
        <?php }?>
        <div class="block-mmenu-header">
            <p class="title-mmenu-header">
                3D Models
            </p>
            <div class="show-mmenu-ul-header">
                <ul>
                    <?php foreach ($splistmenu as $k => $v) {
                        $spcatmenu = $d->rawQuery("SELECT ten$lang as ten, tenkhongdauvi, tenkhongdauen, id FROM #_product_cat WHERE hienthi=1 AND id_list = ? ORDER BY stt,id DESC",array($v['id']));
                    ?>
                    <li class="open_ul_sub">
                        <a href="javascript:void(0)" class="flex items-center">
                            <span class="mr-1">
                                <img src="<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten']?>">
                            </span>
                            <?=$v['ten']?>
                        </a>
                        <ul>
                            <?php foreach ($spcatmenu as $v_cat) {?>
                            <li>
                                <a href="3d-models?list=<?=$v['tenkhongdauvi']?>&cat=<?=$v_cat['tenkhongdauvi']?>"><?=$v_cat['ten']?></a>
                            </li>
                            <?php }?>
                        </ul>
                    </li>
                    <?php }?>
                </ul>
            </div>
        </div>
        <div class="bot-mmenu-header">
            <p><a href="account/buy">BUY</a></p>
            <p><a href="support">SUPPORT</a></p>
        </div>
    </div>
</div>