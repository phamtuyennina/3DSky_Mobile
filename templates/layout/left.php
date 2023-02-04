<h4 class="left-title">Liên kết nhanh</h4>
<div class="left-desc">
	<ul class="left-menu">
		<li><a href="" title="Trang chủ">Trang chủ</a></li>
		<li><a href="gioi-thieu" title="<?=gioithieu?>"><?=gioithieu?></a></li>
		<li><a href="to-chuc-su-kien" title="<?=tochuc?> <?=sukien?>"><?=tochuc?> <?=sukien?></a></li>
		<li><a href="thiet-bi-su-kien" title="<?=thietbisukien?>"><?=thietbisukien?></a></li>
		<li><a href="hoat-dong" title="<?=hoatdong?>"><?=hoatdong?></a></li>
		<li><a href="tin-tuc" title="<?=tintuc?>"><?=tintuc?></a></li>
		<li><a href="lien-he" title="<?=lienhe?>"><?=lienhe?></a></li>
	</ul>
</div>

<h4 class="left-title mt-3">Hỗ trợ trực tuyến</h4>
<div class="left-desc support-bg">
	<?php foreach ($support_link as $k => $v) { ?>
	<div class="support  <?=($k>0) ? 'mt-3':''?> d-flex flex-wrap justify-content-start align-items-center">
		<div class="support-icon">
			<a href="skype:<?=$v['skype']?>?chat" title="<?=$v['ten']?>">
				<img src="assets/images/icon-skye.png" alt="<?=$v['ten']?>">
			</a>
			<a href="https://zalo.me/<?=$v['zalo']?>" title="<?=$v['ten']?>">
				<img src="assets/images/icon-zalo.png" alt="<?=$v['ten']?>">
			</a>
			<a href="viber://add?number=<?=$v['viber']?>" title="<?=$v['ten']?>">
			<img src="assets/images/icon-viber.png" alt="<?=$v['ten']?>"> 
			</a>
		</div>
		<div class="support-info">
			<p><?=$v['ten']?></p>
			<p><?=$v['dienthoai']?></p>
		</div>
	</div>
	<div class="support-email">
		<?=$v['email']?>
	</div>
	<?php } ?>
</div>
<?php if(count($adv_left) > 0){ ?>
<div class="left-adv">
	<?php foreach($adv_left as $k => $v) { ?>
	<a href="<?=$v['link']?>" title="<?=$v['ten'.$lang]?>"><img class="img-block mt-3" onerror="this.src='assets/images/noimage.png';" src="<?=UPLOAD_PHOTO_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>" alt="<?=$v['ten'.$lang]?>"/></a>
	<?php } ?>
</div>
<?php } ?>
<?php /*
<h4 class="left-title mt-3">Giải pháp bảo vệ</h4>
<div class="left-desc">
	<?php if(count($gpbaove)) { ?>
	<ul class="left-menu left-menu-border">
	    <?php foreach ($gpbaove as $k => $v) { ?>
	        <li>
	            <a class="transition" title="<?=$v['ten']?>" href="<?=$v[$sluglang]?>"><?=$v['ten']?></a>
	        </li>
	    <?php } ?>
	</ul>
	<?php } ?>
</div>
<h4 class="left-title mt-3">Dịch vụ</h4>
<div class="left-desc">
	<?php foreach ($dvnb as $k => $v) { ?>
	<div class="service">
		<a href="<?=$v[$sluglang]?>" title="<?=$v['ten']?>">
			<img src="<?=UPLOAD_NEWS_L.$v['icon']?>" alt="<?=$v['ten']?>">
		</a>
		<a href="<?=$v[$sluglang]?>" title="<?=$v['ten']?>">
			<h4><?=$v['ten']?></h4>
		</a>
	</div>
	<?php } ?>
</div>

SKYPE CALL
<a href="skype:USERNAME?call">call using Skype</a>
SKYPE CHAT
<a href="skype:USERNAME?chat">Chat with Skype</a>
SKYPE VOICEMAIL
<a href="skype:USERNAME?voicemail">Leave a voicemail</a>
*/ ?>
<?php /*if(count($splistmenu)) { ?>
<ul class="left-menu">
    <?php foreach ($splistmenu as $k => $v) {
        $spcatmenu = $d->rawQuery("SELECT ten$lang as ten, tenkhongdauvi, tenkhongdauen, id FROM #_product_cat WHERE hienthi=1 AND id_list = ? ORDER BY stt,id DESC",array($v['id'])); ?>
        <li>
            <a class="transition tt" title="<?=$v['ten']?>" href="<?=$v[$sluglang]?>"><?=$v['ten']?></a>
            <?php if(count($spcatmenu)>0) { ?>
                <ul>
                    <?php foreach ($spcatmenu as $k1 => $v1) {
                        $spitemmenu = $d->rawQuery("SELECT ten$lang as ten, tenkhongdauvi, tenkhongdauen, id FROM #_product_item WHERE hienthi=1 AND id_cat = ? ORDER BY stt,id DESC",array($v1['id'])); ?>
                        <li>
                            <a class="transition" title="<?=$v1['ten']?>" href="<?=$v1[$sluglang]?>"><?=$v1['ten']?></a>
                            <?php if(count($spitemmenu)) { ?>
                                <ul>
                                    <?php foreach ($spitemmenu as $k2 => $v2) {
                                        $spsubmenu = $d->rawQuery("SELECT ten$lang as ten, tenkhongdauvi, tenkhongdauen, id FROM #_product_sub WHERE hienthi=1 AND id_item = ? ORDER BY stt,id DESC",array($v2['id'])); ?>
                                        <li>
                                            <a class="transition" title="<?=$v2['ten']?>" href="<?=$v2[$sluglang]?>"><?=$v2['ten']?></a>
                                            <?php if(count($spsubmenu)) { ?>
                                                <ul>
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
<?php } */?>