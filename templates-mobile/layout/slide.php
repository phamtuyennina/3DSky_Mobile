<?php if(count($slider)) { ?>
<div class="w_slider">
    <div id="wowslider-container1">
        <div class="ws_images">
            <ul>
                <?php foreach($slider as $k => $v){ ?>
                <li>
                    <a href="<?=$v['link']?>">
                        <img src="<?=THUMBS?>/1366x475x1/<?=UPLOAD_PHOTO_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>" title="" />
                    </a>
                </li>
                <?php }?>
            </ul>
       </div>
        <div class="ws_bullets"><div>
        <?php foreach($slider as $v){ ?>
            <a href="#" title="hinhc"><span><img src="<?=THUMBS?>/85x48x1/<?=UPLOAD_PHOTO_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>"  /><?=$k?></span></a>
            <?php }?>
        </div></div>
        <div class="ws_shadow"></div>
    </div>
</div>
<?php } ?>