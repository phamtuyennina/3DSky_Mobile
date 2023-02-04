<div class="opacity-menu"></div>
<div class="header-left-fixwidth">
    <div class="section wrap-header">
        <div class="logos-menu">
            <a class="logo-header" href=""><img src="<?=UPLOAD_PHOTO_L.$banner['photo']?>"/></a>
        </div>
        <div class="searchs-menu">
            <div class="search">
                <input type="text" id="keyword-mobile" placeholder="<?=nhaptukhoatimkiem?>" onkeypress="doEnter(event,'keyword-mobile');"/>
                <button type="button" onclick="onSearch('keyword-mobile');" class="search-btn"><i class="fas fa-search"></i></button>
            </div>
        </div>
        
        <div class="nav-menu">
            <ul>
                



                <li class="nav-item active">
                    <a href="" title="<?=trangchu?>"><?=trangchu?></a>
                </li>
                <li class="nav-item">
                    <a  title="<?=gioithieu?>"><?=gioithieu?></a>
                </li>
                <li class="nav-item">
                    <a href="san-pham" title="<?=sanpham?>"><?=sanpham?></a>
                    <?php if(count($splistmenu)) { ?>
                        <span class="btn-dropdown-menu"><i class="fa fa-angle-right"></i></span>
                        <ul class="sub-menu none level0">
                            <?php foreach ($splistmenu as $k => $v) {
                                $spcatmenu = $d->rawQuery("SELECT ten$lang as ten, tenkhongdauvi, tenkhongdauen, id FROM #_product_cat WHERE hienthi=1 AND id_list = ? ORDER BY stt,id DESC",array($v['id'])); ?>
                                <li>
                                    <a class="transition" title="<?=$v['ten']?>" href="<?=$v[$sluglang]?>"><?=$v['ten']?></a>
                                    <?php if(count($spcatmenu)>0) { ?>
                                        <span class="btn-dropdown-menu"><i class="fa fa-angle-right"></i></span>
                                        <ul class="sub-menu none level1">
                                            <?php foreach ($spcatmenu as $k1 => $v1) {
                                                $spitemmenu = $d->rawQuery("SELECT ten$lang as ten, tenkhongdauvi, tenkhongdauen, id FROM #_product_item WHERE hienthi=1 AND id_cat = ? ORDER BY stt,id DESC",array($v1['id'])); ?>
                                                <li>
                                                    <a class="transition" title="<?=$v1['ten']?>" href="<?=$v1[$sluglang]?>"><?=$v1['ten']?></a>
                                                    <?php if(count($spitemmenu)) { ?>
                                                        <span class="btn-dropdown-menu"><i class="fa fa-angle-right"></i></span>
                                                        <ul class="sub-menu none level2">
                                                            <?php foreach ($spitemmenu as $k2 => $v2) {
                                                                $spsubmenu = $d->rawQuery("SELECT ten$lang as ten, tenkhongdauvi, tenkhongdauen, id FROM #_product_sub WHERE hienthi=1 AND id_item = ? ORDER BY stt,id DESC",array($v2['id'])); ?>
                                                                <li>
                                                                    <a class="transition" title="<?=$v2['ten']?>" href="<?=$v2[$sluglang]?>"><?=$v2['ten']?></a>
                                                                    <?php if(count($spsubmenu)) { ?>
                                                                        <span class="btn-dropdown-menu"><i class="fa fa-angle-right"></i></span>
                                                                       <ul class="sub-menu none level3">
                                                                            <?php foreach ($spsubmenu as $k3 => $v3) {?>
                                                                                <li>
                                                                                    <a class="transition" title="<?=$v3['ten']?>" href="<?=$v3[$sluglang]?>"><?=$v3['ten']?></a>
                                                                                </li>
                                                                            <?php } ?>
                                                                        </ul>
                                                                    <?php } ?>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    <?php } ?>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </li>
               <li class="nav-item">
                    <a class="transition <?php if($com=='to-chuc-su-kien') echo 'active'; ?>" href="to-chuc-su-kien" title="<?=tochuc?> <?=sukien?>"><?=tochuc?> <?=sukien?></a>
                    <?php if($serviceslist){ ?>
                    <span class="btn-dropdown-menu"><i class="fa fa-angle-right"></i></span>
                    <ul class="sub-menu none level0">
                        <?php foreach ($serviceslist as $k => $v) { ?>
                        <li>
                            <a href="<?=$v[$sluglang]?>" title="<?=$v['ten']?>"><?=$v['ten']?></a>
                        </li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </li>
                
                <li class="nav-item">
                    <a class="transition <?php if($com=='thiet-bi-su-kien') echo 'active'; ?>" href="thiet-bi-su-kien" title="<?=thietbisukien?>"><?=thietbisukien?></a>
                    <?php if($tbsklist){ ?>
                    <span class="btn-dropdown-menu"><i class="fa fa-angle-right"></i></span>
                    <ul class="sub-menu none level0">
                        <?php foreach ($tbsklist as $k => $v) { ?>
                        <li>
                            <a href="<?=$v[$sluglang]?>" title="<?=$v['ten']?>"><?=$v['ten']?></a>
                        </li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </li>
                <li class="nav-item">
                    <a class="transition <?php if($com=='thu-vien-anh') echo 'active'; ?>" href="thu-vien-anh" title="<?=hoatdong?>"><?=hoatdong?></a>
                </li>
                <li class="nav-item">
                    <a class="transition <?php if($com=='tin-tuc') echo 'active'; ?>" href="tin-tuc" title="<?=tintuc?>"><?=tintuc?></a>
                </li>
                <li class="nav-item">
                    <a class="transition <?php if($com=='lien-he') echo 'active'; ?>" href="lien-he" title="<?=lienhe?>"><?=lienhe?></a>
                </li>
            </ul>
        </div>
    </div>
</div>