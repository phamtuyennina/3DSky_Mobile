<?php
    $linkSave = "index.php?com=photo&act=save_static&type=".$type;
    $options = (isset($item['options'])) ? json_decode($item['options'],true):null;
?>
<div class="content-inner container-fluid pb-0" id="page_layout">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <h5 class="mb-0 text-capitalize">Chi tiết <?=$config['photo']['photo_static'][$type]['title_main']?></h5>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" id="form-watermark" action="<?=$linkSave?>" enctype="multipart/form-data">
                        <?php if(isset($config['photo']['photo_static'][$type]['images']) && $config['photo']['photo_static'][$type]['images']==true) { ?>
                        <div class="form-group">
                            <label class="change-photo" for="file-zone">
                                <p> <b class="text-gray-800">Upload hình ảnh:</b> <span class="text-danger mt-2 mb-2 text-sm"><?php echo "Width: ".$config['photo']['photo_static'][$type]['width']." px - Height: ".$config['photo']['photo_static'][$type]['height']." px (".$config['photo']['photo_static'][$type]['img_type'].")" ?></span></p>
                                <div class="rounded photoUpload-preview flex items-center justify-left " id="photoUpload-preview">
                                    <img class="rounded img-upload max-w-2xl" src="<?=UPLOAD_PHOTO.$item['photo']?>" onerror="src='assets/images/noimage.png'" alt="Alt Photo"/>
                                </div>
                            </label>
                            <div class="custom-file my-custom-file mt-3">
                                <label for="file" class="photo-zone" id="photo-zone">
                                    <input type="file" class="form-control file-zone"  name="file" id="file-zone">
                                </label>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if(isset($config['photo']['photo_static'][$type]['watermark-advanced']) && $config['photo']['photo_static'][$type]['watermark-advanced']==true) { ?>
                        <?php
                            if(isset($options['watermark']['position']) && $options['watermark']['position']!=null){
                                 $tl = ($options['watermark']['position'] == 1 || !$options['watermark']['position']) ? 'checked' : '';
                                $tc = ($options['watermark']['position'] == 2) ? 'checked' : '';
                                $tr = ($options['watermark']['position'] == 3) ? 'checked' : '';
                                $mr = ($options['watermark']['position'] == 4) ? 'checked' : '';
                                $br = ($options['watermark']['position'] == 5) ? 'checked' : '';
                                $bc = ($options['watermark']['position'] == 6) ? 'checked' : '';
                                $bl = ($options['watermark']['position'] == 7) ? 'checked' : '';
                                $ml = ($options['watermark']['position'] == 8) ? 'checked' : '';
                                $cc = ($options['watermark']['position'] == 9) ? 'checked' : '';
                            }
                            $watermark = THUMBS.'/'.$config['photo']['photo_static'][$type]['thumb'].'/'.UPLOAD_PHOTO_L.@$item['photo'];
                        ?>
                        <div class="row">
                            <div class="col-xl-3 row">
                                <div class="form-group col-12">
                                    <label class="form-label text-black font-medium">Vị trí đóng dấu:</label>
                                    <div class="watermark-position rounded max-w-[355px] h-[370px] bg-[#eee] relative">
                                        <label for="tl">
                                            <input type="radio" name="data[options][watermark][position]" id="tl" value="1" <?=$tl?>>
                                            <img class="rounded" onerror="src='assets/images/noimage.png'" src="<?=(isset($tl) && $tl==true) ? $watermark : ''?>" alt="watermark-cover">
                                        </label>
                                        <label for="tc">
                                            <input type="radio" name="data[options][watermark][position]" id="tc" value="2" <?=$tc?>>
                                            <img class="rounded" onerror="src='assets/images/noimage.png'" src="<?=(isset($tc) && $tc==true) ? $watermark : ''?>" alt="watermark-cover">
                                        </label>
                                        <label for="tr">
                                            <input type="radio" name="data[options][watermark][position]" id="tr" value="3" <?=$tr?>>
                                            <img class="rounded" onerror="src='assets/images/noimage.png'" src="<?=(isset($tr) && $tr==true) ? $watermark : ''?>" alt="watermark-cover">
                                        </label>
                                        <label for="mr">
                                            <input type="radio" name="data[options][watermark][position]" id="mr" value="4" <?=$mr?>>
                                            <img class="rounded" onerror="src='assets/images/noimage.png'" src="<?=(isset($mr) && $mr==true) ? $watermark : ''?>" alt="watermark-cover">
                                        </label>
                                        <label for="br">
                                            <input type="radio" name="data[options][watermark][position]" id="br" value="5" <?=$br?>>
                                            <img class="rounded" onerror="src='assets/images/noimage.png'" src="<?=(isset($br) && $br==true) ? $watermark : ''?>" alt="watermark-cover">
                                        </label>
                                        <label for="bc">
                                            <input type="radio" name="data[options][watermark][position]" id="bc" value="6" <?=$bc?>>
                                            <img class="rounded" onerror="src='assets/images/noimage.png'" src="<?=(isset($bc) && $bc==true) ? $watermark : ''?>" alt="watermark-cover">
                                        </label>
                                        <label for="bl">
                                            <input type="radio" name="data[options][watermark][position]" id="bl" value="7" <?=$bl?>>
                                            <img class="rounded" onerror="src='assets/images/noimage.png'" src="<?=(isset($bl) && $bl==true) ? $watermark : ''?>" alt="watermark-cover">
                                        </label>
                                        <label for="ml">
                                            <input type="radio" name="data[options][watermark][position]" id="ml" value="8" <?=$ml?>>
                                            <img class="rounded" onerror="src='assets/images/noimage.png'" src="<?=(isset($ml) && $ml==true) ? $watermark : ''?>" alt="watermark-cover">
                                        </label>
                                        <label for="cc">
                                            <input type="radio" name="data[options][watermark][position]" id="cc" value="9" <?=$cc?>>
                                            <img class="rounded" onerror="src='assets/images/noimage.png'" src="<?=(isset($cc) && $cc==true) ? $watermark : ''?>" alt="watermark-cover">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-9 row">
                                <div class="form-group col-xl-12 col-sm-4">
                                    <label class="form-label">Độ trong suốt:</label>
                                    <input type="text" class="form-control " name="data[options][watermark][opacity]" placeholder="70" value="<?=$options['watermark']['opacity']?>">
                                </div>
                                <div class="form-group col-xl-12 col-sm-4">
                                    <label class="form-label">Tỉ lệ:</label>
                                    <input type="text" class="form-control " name="data[options][watermark][per]"  placeholder="2" value="<?=$options['watermark']['per']?>">
                                </div>
                                <div class="form-group col-xl-12 col-sm-4">
                                    <label class="form-label">Tỉ lệ < 300px:</label>
                                    <input type="text" class="form-control " name="data[options][watermark][small_per]" placeholder="3" value="<?=$options['watermark']['small_per']?>">
                                </div>
                                <div class="form-group col-xl-12 col-sm-4">
                                    <label class="form-label">Kích thước tối đa:</label>
                                    <input type="text" class="form-control " name="data[options][watermark][max]" placeholder="600" value="<?=$options['watermark']['max']?>">
                                </div>
                                <div class="form-group col-xl-12 col-sm-4">
                                    <label class="form-label">Kích thước tối thiểu:</label>
                                    <input type="text" class="form-control " name="data[options][watermark][min]" placeholder="100" value="<?=$options['watermark']['min']?>">
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="row">
                        <?php if(isset($config['photo']['photo_static'][$type]['background']) && $config['photo']['photo_static'][$type]['background']==true) { ?>
                            <div class="form-group col-md-3">
                                <label for="background_repeat">Tùy chọn lặp:</label>
                                <select id="background_repeat" name="data[options][background][repeat]" class="form-control select2">
                                    <option value="0">Chọn thuộc tính</option>
                                    <option <?php if($options['background']['repeat']=='no-repeat') echo 'selected="selected"' ?> value="no-repeat">Không lặp lại</option>
                                    <option <?php if($options['background']['repeat']=='repeat') echo 'selected="selected"' ?> value="repeat">Lặp lại</option>
                                    <option <?php if($options['background']['repeat']=='repeat-x') echo 'selected="selected"' ?> value="repeat-x">Lặp lại theo chiều ngang</option>
                                    <option <?php if($options['background']['repeat']=='repeat-y') echo 'selected="selected"' ?> value="repeat-y">Lặp lại theo chiều dọc</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="background_size">Kích thước:</label>
                                <select id="background_size" name="data[options][background][size]" class="form-control select2">
                                    <option value="0">Chọn thuộc tính</option>
                                    <option <?php if($options['background']['size']=='auto') echo 'selected="selected"' ?> value="auto">Auto</option>
                                    <option <?php if($options['background']['size']=='cover') echo 'selected="selected"' ?> value="cover">Cover</option>
                                    <option <?php if($options['background']['size']=='contain') echo 'selected="selected"' ?> value="contain">Contain</option>
                                    <option <?php if($options['background']['size']=='100% 100%') echo 'selected="selected"' ?> value="100% 100%">Toàn màn hình</option>
                                    <option <?php if($options['background']['size']=='100% auto') echo 'selected="selected"' ?> value="100% auto">Toàn màn hình theo chiều ngang</option>
                                    <option <?php if($options['background']['size']=='auto 100%') echo 'selected="selected"' ?> value="auto 100%">Toàn màn hình theo chiều dọc</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="background_position">Vị trí:</label>
                                <select id="background_position" name="data[options][background][position]" class="form-control select2">
                                    <option value="0">Chọn thuộc tính</option>
                                    <option <?php if($options['background']['position']=='left top') echo 'selected="selected"' ?> value="left top">Canh Trái - Canh Trên</option>
                                    <option <?php if($options['background']['position']=='left bottom') echo 'selected="selected"' ?> value="left bottom">Canh Trái - Canh Dưới</option>
                                    <option <?php if($options['background']['position']=='left center') echo 'selected="selected"' ?> value="left center">Canh Trái - Canh Giữa</option>
                                    <option <?php if($options['background']['position']=='right top') echo 'selected="selected"' ?> value="right top">Canh Phải - Canh Trên</option>
                                    <option <?php if($options['background']['position']=='right bottom') echo 'selected="selected"' ?> value="right bottom">Canh Phải - Canh Dưới</option>
                                    <option <?php if($options['background']['position']=='right center') echo 'selected="selected"' ?> value="right center">Canh Phải - Canh Giữa</option>
                                    <option <?php if($options['background']['position']=='center top') echo 'selected="selected"' ?> value="center top">Canh Giữa - Canh Trên</option>
                                    <option <?php if($options['background']['position']=='center bottom') echo 'selected="selected"' ?> value="center bottom">Canh Giữa - Canh Dưới</option>
                                    <option <?php if($options['background']['position']=='center center') echo 'selected="selected"' ?> value="center center">Canh Giữa - Canh Giữa</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-label" for="background_attachment">Cố định:</label>
                                <select class="form-control" name="data[options][background][attachment]" id="background_attachment">
                                    <option <?=($options['background']['attachment']=='')?"selected":""?> value="0">Không cố định</option>
                                    <option <?=($options['background']['attachment']=='fixed')?"selected":""?> value="fixed">Cố định</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-label" for="background_color">Màu nền:</label>
                                <input type="text" class="form-control jscolor" name="data[options][background][color]" id="background_color" maxlength="7" value="<?=($options['background']['color'])?$options['background']['color']:'#000000'?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-label" for="loaihienthi">Loại hiển thị:</label>
                                <select class="form-control" name="data[options][background][loaihienthi]" id="loaihienthi">
                                    <option value="0">Chọn tình trạng</option>
                                    <option <?=($options['background']['loaihienthi']==1)?"selected":""?> value="1">Hình nền</option>
                                    <option <?=($options['background']['loaihienthi']==0)?"selected":""?> value="0">Màu nền</option>
                                </select>
                            </div>
                        <?php } ?>
                        <?php if(isset($config['photo']['photo_static'][$type]['link']) && $config['photo']['photo_static'][$type]['link']==true) { ?>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="link">Link:</label>
                                <input type="text" class="form-control" name="data[link]" id="link" placeholder="Link" value="<?=$item['link']?>">
                            </div>
                        <?php } ?>
                        <?php if(isset($config['photo']['photo_static'][$type]['video']) && $config['photo']['photo_static'][$type]['video']==true) { ?>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="link_video">Video:</label>
                                <input type="text" class="form-control" name="data[link_video]" id="link_video" placeholder="Video" value="<?=$item['link_video']?>">
                            </div>
                        <?php } ?>
                        </div>
                        <div class="form-group">
                            <div class="form-check ps-0 cursor-pointer form-switch">
                                <label class="form-label form-check-label font-medium cursor-pointer" for="hienthi-checkbox">Hiển thị:</label>
                                <input class="form-check-input l-0 ms-1 !float-none" name="data[hienthi]" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked':''?> type="checkbox" id="hienthi-checkbox" >
                           </div>
                        </div>
                        <?php if((isset($config['photo']['photo_static'][$type]['tieude']) && $config['photo']['photo_static'][$type]['tieude']==true) || (isset($config['photo']['photo_static'][$type]['mota']) && $config['photo']['photo_static'][$type]['mota']==true) || (isset($config['photo']['photo_static'][$type]['noidung']) && $config['photo']['photo_static'][$type]['noidung']==true)) { ?>
                        <div class="bd-example mt-4">
                            <div class="card">
                                <div class="card-header p-0">
                                    <nav class="tab-bottom-bordered">
                                        <div class="mb-0 nav nav-tabs" id="nav-tab1" role="tablist">
                                            <?php foreach($config['website']['lang'] as $k => $v) { ?>
                                            <button class="nav-link <?=($k=='vi')?'active':''?>" id="tabs-lang" data-bs-toggle="tab" data-bs-target="#tabs-lang-<?=$k?>" type="button" role="tab" aria-controls="tabs-lang-<?=$k?>" aria-selected="true"><?=$v?></button>
                                            <?php }?>
                                        </div>
                                    </nav>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content iq-tab-fade-up" id="nav-tabContent">
                                        <?php foreach($config['website']['lang'] as $k => $v) { ?>
                                        <div class="tab-pane fade <?=($k=='vi')?'active show':''?>" id="tabs-lang-<?=$k?>" role="tabpanel" aria-labelledby="tabs-lang-<?=$k?>-tab">
                                            <?php if(isset($config['photo']['photo_static'][$type]['tieude']) && $config['photo']['photo_static'][$type]['tieude']==true) { ?>
                                                <div class="form-group last:mb-0">
                                                    <label class="form-label" for="ten<?=$k?>">Tiêu đề (<?=$k?>):</label>
                                                    <input type="text" class="form-control" name="data[ten<?=$k?>]" id="ten<?=$k?>" placeholder="Tiêu đề (<?=$k?>)" value="<?=@$item['ten'.$k]?>">
                                                </div>
                                            <?php } ?>
                                            <?php if(isset($config['photo']['photo_static'][$type]['mota']) && $config['photo']['photo_static'][$type]['mota']==true) { ?>
                                                <div class="form-group last:mb-0">
                                                    <label class="form-label" for="mota<?=$k?>">Mô tả (<?=$k?>):</label>
                                                    <textarea class="form-control <?=($config['photo']['photo_static'][$type]['mota_cke'])?'form-control-ckeditor':''?>" name="data[mota<?=$k?>]" id="mota<?=$k?>" rows="5" placeholder="Mô tả (<?=$k?>)"><?=htmlspecialchars_decode(@$item['mota'.$k])?></textarea>
                                                </div>
                                            <?php } ?>
                                            <?php if(isset($config['photo']['photo_static'][$type]['noidung']) && $config['photo']['photo_static'][$type]['noidung']==true) { ?>
                                                <div class="form-group last:mb-0">
                                                    <label class="form-label" for="noidung<?=$k?>">Nội dung (<?=$k?>):</label>
                                                    <textarea class="form-control <?=($config['photo']['photo_static'][$type]['noidung_cke'])?'form-control-ckeditor':''?>" name="data[noidung<?=$k?>]" id="noidung<?=$k?>" rows="5" placeholder="Nội dung (<?=$k?>)"><?=htmlspecialchars_decode(@$item['noidung'.$k])?></textarea>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="row pe-4 pt-4 d-flex align-items-center justify-content-center justify-content-md-between">
                            <?php include TEMPLATE.LAYOUT."saveelement.php"; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
