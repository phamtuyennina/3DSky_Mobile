<?php
    $photo_config = $config['photo']['man_photo'][$type];
    $linkMan = "index.php?com=photo&act=man_photo&type=".$type."&p=".$curPage;
    $linkSave = "index.php?com=photo&act=save_photo&type=".$type."&p=".$curPage;
?>
<div class="content-inner container-fluid pb-0" id="page_layout">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <h5 class="mb-0 text-capitalize">Chi tiết <?=$photo_config['title_main_photo']?></h5>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" id="form-watermark" action="<?=$linkSave?>" enctype="multipart/form-data">
                        <?php if(!empty($photo_config['images_photo']) && $photo_config['images_photo']==true) { ?>
                        <div class="form-group">
                            <label class="change-photo" for="file-zone">
                                <p> <b class="text-gray-800">Upload hình ảnh:</b> <span class="text-danger mt-2 mb-2 text-sm"><?php echo "Width: ".$photo_config['width_photo']." px - Height: ".$photo_config['height_photo']." px (".$photo_config['img_type_photo'].")" ?></span></p>
                                <div class="rounded photoUpload-preview flex items-center justify-left " id="photoUpload-preview">
                                    <img class="rounded img-upload max-w-2xl" src="<?=UPLOAD_PHOTO.$item['photo']?>" onerror="src='assets/images/noimage.png'" alt="Alt Photo"/>
                                </div>
                            </label>
                            <div class="custom-file my-custom-file mt-3">
                                <label for="file" class="photo-zone" id="photo-zone">
                                    <input type="file" class="form-control file-zone" name="file" id="file-zone">
                                </label>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if(!empty($photo_config['link_photo']) && $photo_config['link_photo']==true) { ?>
                        <div class="form-group">
                            <label class="form-label" for="link">Link:</label>
                            <input type="text" class="form-control" name="data[link]" id="link" placeholder="Link" value="<?=(!empty($item['link'])) ? $item['link']:''?>">
                        </div>
                        <?php } ?>
                        <?php if(!empty($photo_config['video_photo']) && $photo_config['video_photo']==true) { ?>
                        <div class="form-group">
                            <label class="form-label" for="link_video">Video:</label>
                            <input type="text" class="form-control" name="data[link_video]" id="link_video" onchange="youtubePreview(this.value,'#loadVideo');" placeholder="Video" value="<?=(!empty($item['link_video'])) ? $item['link_video']:''?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="link_video">Video preview:</label>
                            <div><iframe id="loadVideo" width="450" height="300" src="//www.youtube.com/embed/<?=$func->getYoutube($item['link_video'])?>" <?=($item["link_video"]=="")?"height='0'":"height='150'";?> frameborder="0" allowfullscreen></iframe></div>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <label for="stt" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
                            <input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?=isset($item['stt'])?$item['stt']:1?>">
                        </div>
                        <div class="form-group">
                            <div class="form-check ps-0 cursor-pointer">
                                <label class="form-label form-check-label font-medium cursor-pointer" for="hienthi-checkbox">Hiển thị:</label>
                                <input class="form-check-input l-0 ms-1 !float-none" name="data[hienthi]" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked':''?> type="checkbox" id="hienthi-checkbox" >
                           </div>
                        </div>


                        <?php if((!empty($photo_config['tieude_photo']) && $photo_config['tieude_photo']==true) || (!empty($photo_config['mota_photo']) && $photo_config['mota_photo']==true) || (!empty($photo_config['noidung_photo']) && $photo_config['noidung_photo']==true)) { ?>
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
                                                <?php if(isset($photo_config['tieude_photo']) && $photo_config['tieude_photo']==true) { ?>
                                                    <div class="form-group">
                                                        <label class="form-label" for="ten<?=$k?>">Tiêu đề (<?=$k?>):</label>
                                                        <input type="text" class="form-control" name="data[ten<?=$k?>]" id="ten<?=$k?>" placeholder="Tiêu đề (<?=$k?>)" value="<?=@$item['ten'.$k]?>">
                                                    </div>
                                                <?php } ?>
                                                <?php if(isset($photo_config['mota_photo']) && $photo_config['mota_photo']==true) { ?>
                                                    <div class="form-group">
                                                        <label class="form-label" for="mota<?=$k?>">Mô tả (<?=$k?>):</label>
                                                        <textarea class="form-control <?=($photo_config['mota_cke_photo'])?'form-control-ckeditor':''?>" name="data[mota<?=$k?>]" id="mota<?=$k?>" rows="5" placeholder="Mô tả (<?=$k?>)"><?=htmlspecialchars_decode(@$item['mota'.$k])?></textarea>
                                                    </div>
                                                <?php } ?>
                                                <?php if(isset($photo_config['noidung_photo']) && $photo_config['noidung_photo']==true) { ?>
                                                    <div class="form-group mb-0">
                                                        <label class="form-label" for="noidung<?=$k?>">Nội dung (<?=$k?>):</label>
                                                        <textarea class="form-control <?=($photo_config['noidung_cke_photo'])?'form-control-ckeditor':''?>" name="data[noidung<?=$k?>]" id="noidung<?=$k?>" rows="5" placeholder="Nội dung (<?=$k?>)"><?=htmlspecialchars_decode(@$item['noidung'.$k])?></textarea>
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
