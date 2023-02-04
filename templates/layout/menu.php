<section class="menu" id="menu">
    <div class="container">
        <div class="desc-menu d-flex flex-wrap justify-content-between">
            <ul class="menu-i d-flex align-items-center justify-content-start">
                <li>
                    <div class="menu-mobile-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </li>
                <li>
                    <a class="transition <?php if($com=='' || $com=='index') echo 'active'; ?>" href="" title="<?=trangchu?>"><?=trangchu?></a>
                </li>
                <li>
                    <a class="transition <?php if($com=='gioi-thieu') echo 'active'; ?>" href="gioi-thieu" title="<?=gioithieu?>"><?=gioithieu?></a>
                </li>
                <li>
                    <a class="transition <?php if($com=='san-pham') echo 'active'; ?>" href="san-pham" title="<?=sanpham?>"><?=sanpham?></a>
                    <?php if(count($splistmenu)) { ?>
                        <ul>
                            <?php foreach ($splistmenu as $k => $v) {
                                $spcatmenu = $d->rawQuery("SELECT ten$lang as ten, tenkhongdauvi, tenkhongdauen, id FROM #_product_cat WHERE hienthi=1 AND id_list = ? ORDER BY stt,id DESC",array($v['id'])); ?>
                                <li>
                                    <h2><a class="transition" title="<?=$v['ten']?>" href="<?=$v[$sluglang]?>"><?=$v['ten']?></a></h2>
                                    <?php if(count($spcatmenu)>0) { ?>
                                        <ul>
                                            <?php foreach ($spcatmenu as $k1 => $v1) {
                                                $spitemmenu = $d->rawQuery("SELECT ten$lang as ten, tenkhongdauvi, tenkhongdauen, id FROM #_product_item WHERE hienthi=1 AND id_cat = ? ORDER BY stt,id DESC",array($v1['id'])); ?>
                                                <li>
                                                    <h2><a class="transition" title="<?=$v1['ten']?>" href="<?=$v1[$sluglang]?>"><?=$v1['ten']?></a></h2>
                                                    <?php if(count($spitemmenu)) { ?>
                                                        <ul>
                                                            <?php foreach ($spitemmenu as $k2 => $v2) {
                                                                $spsubmenu = $d->rawQuery("SELECT ten$lang as ten, tenkhongdauvi, tenkhongdauen, id FROM #_product_sub WHERE hienthi=1 AND id_item = ? ORDER BY stt,id DESC",array($v2['id'])); ?>
                                                                <li>
                                                                    <h2><a class="transition" title="<?=$v2['ten']?>" href="<?=$v2[$sluglang]?>"><?=$v2['ten']?></a></h2>
                                                                    <?php if(count($spsubmenu)) { ?>
                                                                        <ul>
                                                                            <?php foreach ($spsubmenu as $k3 => $v3) {?>
                                                                                <li>
                                                                                    <h2><a class="transition" title="<?=$v3['ten']?>" href="<?=$v3[$sluglang]?>"><?=$v3['ten']?></a></h2>
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
                <li>
                    <a class="transition <?php if($com=='to-chuc-su-kien') echo 'active'; ?>" href="to-chuc-su-kien" title="<?=tochuc?> <?=sukien?>"><?=tochuc?> <?=sukien?></a>
                    <?php if($serviceslist){ ?>
                    <ul class="wpage">
                        <?php foreach ($serviceslist as $k => $v) { ?>
                        <li>
                            <h2><a href="<?=$v[$sluglang]?>" title="<?=$v['ten']?>"><?=$v['ten']?></a></h2>
                        </li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </li>
                
                <li>
                    <a class="transition <?php if($com=='thiet-bi-su-kien') echo 'active'; ?>" href="thiet-bi-su-kien" title="<?=thietbisukien?>"><?=thietbisukien?></a>
                    <?php if($tbsklist){ ?>
                    <ul>
                        <?php foreach ($tbsklist as $k => $v) { ?>
                        <li>
                            <h2><a href="<?=$v[$sluglang]?>" title="<?=$v['ten']?>"><?=$v['ten']?></a></h2>
                        </li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </li>
                <li>
                    <a class="transition <?php if($com=='thu-vien-anh') echo 'active'; ?>" href="thu-vien-anh" title="<?=hoatdong?>"><?=hoatdong?></a>
                </li>
                <li>
                    <a class="transition <?php if($com=='tin-tuc') echo 'active'; ?>" href="tin-tuc" title="<?=tintuc?>"><?=tintuc?></a>
                </li>
                <li>
                    <a class="transition <?php if($com=='lien-he') echo 'active'; ?>" href="lien-he" title="<?=lienhe?>"><?=lienhe?></a>
                </li>
                <li>
                    <div class="search">
                        <input type="text" id="keyword" placeholder="<?=nhaptukhoatimkiem?>" onkeypress="doEnter(event,'keyword');"/>
                        <p onclick="onSearch('keyword');"><i class="fas fa-search"></i></p>
                    </div>
                </li>
            </ul>
        </div>
   </div>
</section>