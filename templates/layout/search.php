<?php 
    $style = $d->rawQuery("SELECT ten$lang as ten,id FROM #_product_properties WHERE hienthi=1 AND type = ? ORDER BY stt,id DESC",array('style'));
    $render = $d->rawQuery("SELECT ten$lang as ten,id FROM #_product_properties WHERE hienthi=1 AND type = ? ORDER BY stt,id DESC",array('render'));
    $format = $d->rawQuery("SELECT ten$lang as ten,id FROM #_product_properties WHERE hienthi=1 AND type = ? ORDER BY stt,id DESC",array('format'));
    $form = $d->rawQuery("SELECT ten$lang as ten,id,photo FROM #_product_properties WHERE hienthi=1 AND type = ? ORDER BY stt,id DESC",array('form'));
    $color = $d->rawQuery("SELECT ten$lang as ten,id,mau FROM #_product_properties WHERE hienthi=1 AND type = ? ORDER BY stt,id DESC",array('color'));
    $material = $d->rawQuery("SELECT ten$lang as ten,id,mau FROM #_product_properties WHERE hienthi=1 AND type = ? ORDER BY stt,id DESC",array('material'));
?>
<div class="list-danhmuc-search ">
    <ul>
        <?php foreach($splistmenu as $k => $v){
            $spcatmenu = $d->rawQuery("SELECT ten$lang as ten, tenkhongdauvi, tenkhongdauen, id FROM #_product_cat WHERE hienthi=1 AND id_list = ? ORDER BY stt,id DESC",array($v['id']));
        ?>
        <li class="danhmuc <?=($list_search==$v['id'])?'active':''?>">
            <p>
                <a href="javascript:void(0)" class="flex justify-between items-center <?=($list_search==$v['id'])?'active':''?>" data-key="list" data-value="<?=$v['tenkhongdauvi']?>">
                    <span class="flex items-center">
                        <img src="<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten']?>">
                        <?=$v['ten']?>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="7" viewBox="0 0 11 7" fill="none">
                        <path d="M11.0066 1.25972L6.7018 5.54063C6.31019 5.93007 5.67703 5.9283 5.28759 5.53669L1.00668 1.23185" stroke="url(#paint0_linear_127_<?=$v['id']?>)" stroke-linecap="round"/>
                        <defs>
                            <linearGradient id="paint0_linear_127_<?=$v['id']?>" x1="4.2351" y1="1.89879" x2="5.37264" y2="4.73652" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#00B9B9"></stop>
                            <stop offset="0.1337" stop-color="#00B3BC"></stop>
                            <stop offset="0.3176" stop-color="#00A1C6"></stop>
                            <stop offset="0.5307" stop-color="#0084D6"></stop>
                            <stop offset="0.7637" stop-color="#005CEC"></stop>
                            <stop offset="0.9424" stop-color="#0038FF"></stop>
                            <stop offset="1" stop-color="#0038FF"></stop>
                            </linearGradient>
                        </defs>
                    </svg>
                </a>
            </p>
            <?php if(!empty($spcatmenu)){?>
            <div class="show_cat show_click <?=($list_search==$v['id'])?'active':''?>">
                <?php foreach($spcatmenu as $k_cat => $v_cat){?>
                <p>
                    <a href="javascript:void(0)" class="cat_<?=$v_cat['id']?> <?=(in_array($v_cat['id'],$cat_search))?'active':''?>" data-name="<?=$v_cat['ten']?>" data-key="cat" data-id="<?=$v_cat['id']?>" data-value="<?=$v_cat['tenkhongdauvi']?>" data-list="<?=$v['id']?>"><?=$v_cat['ten']?></a>
                </p>   
                <?php }?>
            </div>    
            <?php }?>
        </li>    
        <?php }?>
    </ul>
</div>
<div class="list-danhmuc-search">
    <ul>
        <li class="li-properties <?=(!empty($style_array))?'active':''?>">
            <p>
                <a href="javascript:void(0)" class="flex justify-between items-center">
                    <span class="flex items-center font-bold">
                        Style
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="7" viewBox="0 0 11 7" fill="none">
                        <path d="M11.0066 1.25972L6.7018 5.54063C6.31019 5.93007 5.67703 5.9283 5.28759 5.53669L1.00668 1.23185" stroke="url(#paint0_linear_127_0)" stroke-linecap="round"/>
                        <defs>
                            <linearGradient id="paint0_linear_127_0" x1="4.2351" y1="1.89879" x2="5.37264" y2="4.73652" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#00B9B9"></stop>
                            <stop offset="0.1337" stop-color="#00B3BC"></stop>
                            <stop offset="0.3176" stop-color="#00A1C6"></stop>
                            <stop offset="0.5307" stop-color="#0084D6"></stop>
                            <stop offset="0.7637" stop-color="#005CEC"></stop>
                            <stop offset="0.9424" stop-color="#0038FF"></stop>
                            <stop offset="1" stop-color="#0038FF"></stop>
                            </linearGradient>
                        </defs>
                    </svg>
                </a>
            </p>
            <div class="box-show-properties">
                <p class="grid grid-cols-2 gap-2 mt-2">
                    <?php foreach($style as $k => $v){?>
                    <a href="javascript:void(0)" data-key="style" data-value="<?=$v['id']?>" data-name="<?=$v['ten']?>" class="style_<?=$v['id']?> properties properties-style <?=in_array($v['id'],$style_array)?'active':''?>"><?=$v['ten']?></a>
                    <?php }?>
                </p>
            </div>        
        </li> 
        <li class="li-properties <?=(!empty($render_array))?'active':''?>">
            <p>
                <a href="javascript:void(0)" class="flex justify-between items-center">
                    <span class="flex items-center font-bold">
                        Render
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="7" viewBox="0 0 11 7" fill="none">
                        <path d="M11.0066 1.25972L6.7018 5.54063C6.31019 5.93007 5.67703 5.9283 5.28759 5.53669L1.00668 1.23185" stroke="url(#paint0_linear_127_1)" stroke-linecap="round"/>
                        <defs>
                            <linearGradient id="paint0_linear_127_1" x1="4.2351" y1="1.89879" x2="5.37264" y2="4.73652" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#00B9B9"></stop>
                            <stop offset="0.1337" stop-color="#00B3BC"></stop>
                            <stop offset="0.3176" stop-color="#00A1C6"></stop>
                            <stop offset="0.5307" stop-color="#0084D6"></stop>
                            <stop offset="0.7637" stop-color="#005CEC"></stop>
                            <stop offset="0.9424" stop-color="#0038FF"></stop>
                            <stop offset="1" stop-color="#0038FF"></stop>
                            </linearGradient>
                        </defs>
                    </svg>
                </a>
            </p>
            <div class="box-show-properties">
                <p class="grid grid-cols-2 gap-2 mt-2">
                    <?php foreach($render as $k => $v){?>
                    <a href="javascript:void(0)" data-key="render" data-value="<?=$v['id']?>" data-name="<?=$v['ten']?>" class="render_<?=$v['id']?> properties properties-render <?=in_array($v['id'],$render_array)?'active':''?>"><?=$v['ten']?></a>
                    <?php }?>
                </p>
            </div>
        </li> 
        <li class="li-properties <?=(!empty($format_array))?'active':''?>">
            <p>
                <a href="javascript:void(0)" class="flex justify-between items-center">
                    <span class="flex items-center font-bold">
                        Format
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="7" viewBox="0 0 11 7" fill="none">
                        <path d="M11.0066 1.25972L6.7018 5.54063C6.31019 5.93007 5.67703 5.9283 5.28759 5.53669L1.00668 1.23185" stroke="url(#paint0_linear_127_2)" stroke-linecap="round"/>
                        <defs>
                            <linearGradient id="paint0_linear_127_2" x1="4.2351" y1="1.89879" x2="5.37264" y2="4.73652" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#00B9B9"></stop>
                            <stop offset="0.1337" stop-color="#00B3BC"></stop>
                            <stop offset="0.3176" stop-color="#00A1C6"></stop>
                            <stop offset="0.5307" stop-color="#0084D6"></stop>
                            <stop offset="0.7637" stop-color="#005CEC"></stop>
                            <stop offset="0.9424" stop-color="#0038FF"></stop>
                            <stop offset="1" stop-color="#0038FF"></stop>
                            </linearGradient>
                        </defs>
                    </svg>
                </a>
            </p>
            <div class="box-show-properties">
                <p class="grid grid-cols-2 gap-2 mt-2">
                    <?php foreach($format as $k => $v){?>
                    <a href="javascript:void(0)" data-key="format" data-value="<?=$v['id']?>" data-name="<?=$v['ten']?>" class="format_<?=$v['id']?> properties properties-format <?=in_array($v['id'],$format_array)?'active':''?>"><?=$v['ten']?></a>
                    <?php }?>
                </p>
            </div>
        </li> 
        <li class="li-properties <?=(!empty($form_array))?'active':''?>">
            <p>
                <a href="javascript:void(0)" class="flex justify-between items-center">
                    <span class="flex items-center font-bold">
                        Form
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="7" viewBox="0 0 11 7" fill="none">
                        <path d="M11.0066 1.25972L6.7018 5.54063C6.31019 5.93007 5.67703 5.9283 5.28759 5.53669L1.00668 1.23185" stroke="url(#paint0_linear_127_3)" stroke-linecap="round"/>
                        <defs>
                            <linearGradient id="paint0_linear_127_3" x1="4.2351" y1="1.89879" x2="5.37264" y2="4.73652" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#00B9B9"></stop>
                            <stop offset="0.1337" stop-color="#00B3BC"></stop>
                            <stop offset="0.3176" stop-color="#00A1C6"></stop>
                            <stop offset="0.5307" stop-color="#0084D6"></stop>
                            <stop offset="0.7637" stop-color="#005CEC"></stop>
                            <stop offset="0.9424" stop-color="#0038FF"></stop>
                            <stop offset="1" stop-color="#0038FF"></stop>
                            </linearGradient>
                        </defs>
                    </svg>
                </a>
            </p>
            <div class="box-show-properties">
                <p class="grid grid-cols-1 gap-2 mt-2">
                    <?php foreach($form as $k => $v){?>
                    <a href="javascript:void(0)" data-key="form" data-value="<?=$v['id']?>" data-img="<?=UPLOAD_MAU_L.$v['photo']?>" class="form_<?=$v['id']?> properties properties-form <?=in_array($v['id'],$form_array)?'active':''?> flex !py-[5px] items-center justify-center">
                        <img class="!max-w-[24px] mr-2 " src="<?=UPLOAD_MAU_L.$v['photo']?>" alt="<?=$v['ten']?>">
                        <span><?=$v['ten']?></span>
                    </a>
                    <?php }?>
                </p>
            </div>
        </li> 
        <li class="li-properties <?=(!empty($color_array))?'active':''?>">
            <p>
                <a href="javascript:void(0)" class="flex justify-between items-center">
                    <span class="flex items-center font-bold">
                        Color
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="7" viewBox="0 0 11 7" fill="none">
                        <path d="M11.0066 1.25972L6.7018 5.54063C6.31019 5.93007 5.67703 5.9283 5.28759 5.53669L1.00668 1.23185" stroke="url(#paint0_linear_127_4)" stroke-linecap="round"/>
                        <defs>
                            <linearGradient id="paint0_linear_127_4" x1="4.2351" y1="1.89879" x2="5.37264" y2="4.73652" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#00B9B9"></stop>
                            <stop offset="0.1337" stop-color="#00B3BC"></stop>
                            <stop offset="0.3176" stop-color="#00A1C6"></stop>
                            <stop offset="0.5307" stop-color="#0084D6"></stop>
                            <stop offset="0.7637" stop-color="#005CEC"></stop>
                            <stop offset="0.9424" stop-color="#0038FF"></stop>
                            <stop offset="1" stop-color="#0038FF"></stop>
                            </linearGradient>
                        </defs>
                    </svg>
                </a>
            </p>
            <div class="box-show-properties">
                <p class="grid grid-cols-4 gap-2 mt-2">
                    <?php foreach($color as $k => $v){?>
                    <a href="javascript:void(0)" data-key="color" data-value="<?=$v['id']?>" data-mau="#<?=$v['mau']?>" class="color_<?=$v['id']?> properties properties-color <?=in_array($v['id'],$color_array)?'active':''?> w-[40px] h-[40px]" style="--bg:#<?=$v['mau']?>"></a>
                    <?php }?>
                </p>
            </div>
        </li> 
        <li class="last:mb-0 li-properties <?=(!empty($material_array))?'active':''?>">
            <p>
                <a href="javascript:void(0)" class="flex justify-between items-center">
                    <span class="flex items-center font-bold">
                        Material
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="7" viewBox="0 0 11 7" fill="none">
                        <path d="M11.0066 1.25972L6.7018 5.54063C6.31019 5.93007 5.67703 5.9283 5.28759 5.53669L1.00668 1.23185" stroke="url(#paint0_linear_127_5)" stroke-linecap="round"/>
                        <defs>
                            <linearGradient id="paint0_linear_127_5" x1="4.2351" y1="1.89879" x2="5.37264" y2="4.73652" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#00B9B9"></stop>
                            <stop offset="0.1337" stop-color="#00B3BC"></stop>
                            <stop offset="0.3176" stop-color="#00A1C6"></stop>
                            <stop offset="0.5307" stop-color="#0084D6"></stop>
                            <stop offset="0.7637" stop-color="#005CEC"></stop>
                            <stop offset="0.9424" stop-color="#0038FF"></stop>
                            <stop offset="1" stop-color="#0038FF"></stop>
                            </linearGradient>
                        </defs>
                    </svg>
                </a>
            </p>
            <div class="box-show-properties">
                <p class="grid grid-cols-2 gap-2 mt-2">
                    <?php foreach($material as $k => $v){?>
                    <a href="javascript:void(0)" data-key="material" data-value="<?=$v['id']?>" data-name="<?=$v['ten']?>" class="material_<?=$v['id']?> properties properties-material <?=in_array($v['id'],$material_array)?'active':''?>"><?=$v['ten']?></a>
                    <?php }?>
                </p>
            </div>
        </li> 
    </ul>
</div>