<?php
    $linkSave = "index.php?com=static&act=save&type=".$type;
?>

<div class="content-inner container-fluid pb-0" id="page_layout">
    <form class="validation-form" novalidate method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card mb-0">
                    <div class="card-header">
                        <div class="d-flex justify-start align-items-center flex-wrap gap-3">
                            <?php include TEMPLATE.LAYOUT."saveelement.php"; ?>
                        </div>
                    </div>
                    <div class="card-body pt-0"></div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <h5 class="mb-0 text-capitalize">Chi tiết <?=$config['static'][$type]['title_main']?></h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if(isset($config['static'][$type]['images']) && $config['static'][$type]['images']==true) { ?>
                        <div class="form-group">
                            <label class="change-photo" for="file-zone">
                                <p> <b class="text-gray-800">Upload hình ảnh:</b> <span class="text-danger mt-2 mb-2 text-sm"><?php echo "Width: ".$config['static'][$type]['width']." px - Height: ".$config['static'][$type]['height']." px (".$config['static'][$type]['img_type'].")" ?></span></p>
                                <div class="rounded photoUpload-preview flex items-center justify-left " id="photoUpload-preview">
                                    <img class="rounded img-upload max-w-2xl" src="<?=UPLOAD_NEWS.$item['photo']?>" onerror="src='assets/images/noimage.png'" alt="Alt Photo"/>
                                </div>
                            </label>
                            <div class="custom-file my-custom-file mt-3">
                                <label for="file" class="photo-zone" id="photo-zone">
                                    <input type="file" class="form-control file-zone"  name="file" id="file-zone">
                                </label>
                            </div>
                        </div>
                        <?php } ?> 

                        <?php if(isset($config['static'][$type]['file']) && $config['static'][$type]['file']==true) { ?>
                        <div class="form-group">
                            <label class="change-file form-label mb-1 mr-2" for="file-taptin">
                                <p> <b class="text-gray-800">Chọn tập tin:</b> <span class="text-danger mt-2 mb-2 text-sm"><?php echo $config['static'][$type]['file_type']; ?></span></p>
                                <div class="custom-file my-custom-file ">
                                    <input type="file" class="form-control" name="file-taptin" id="file-taptin">
                                </div>
                             </label>
                            <?php if(!empty($item['taptin']) && $item['taptin']==true) { ?>
                                <a class="btn btn-sm bg-primary text-white d-inline-block align-middle p-2 rounded mb-1" href="<?=UPLOAD_FILE.$item['taptin']?>" title="Download tập tin hiện tại"><i class="fas fa-download mr-2"></i>Download tập tin hiện tại</a>
                            <?php } ?>
                        </div>
                        <?php } ?>
                        <?php if(isset($config['static'][$type]['video']) && $config['static'][$type]['video']==true) { ?>
                        <div class="form-group">
                            <label class="form-label" for="link_video">Video:</label>
                            <input type="text" class="form-control" name="data[link_video]" id="link_video" onchange="youtubePreview(this.value,'#loadVideo');" placeholder="Video" value="<?=$item['link_video']?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="link_video">Video preview:</label>
                            <div><iframe id="loadVideo" width="450" src="//www.youtube.com/embed/<?=$func->getYoutube($item['link_video'])?>" <?=($item["link_video"]=="")?"height='0'":"height='300'";?> frameborder="0" allowfullscreen></iframe></div>
                        </div>
                        <?php } ?>
                        <?php if(isset($config['static'][$type]['link']) && $config['static'][$type]['link']==true) { ?>
                        <div class="form-group">
                            <label class="form-label" for="link">Link:</label>
                            <input type="text" class="form-control" name="data[link]" id="link" placeholder="Link" value="<?=$item['link']?>">
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <div class="form-check ps-0 cursor-pointer form-switch">
                                <label class="form-label form-check-label font-medium cursor-pointer" for="hienthi-checkbox">Hiển thị:</label>
                                <input class="form-check-input l-0 ms-1 !float-none" name="data[hienthi]" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked':''?> type="checkbox" id="hienthi-checkbox" >
                           </div>
                        </div>
                        <?php if((isset($config['static'][$type]['tieude']) && $config['static'][$type]['tieude']==true) || (isset($config['static'][$type]['mota']) && $config['static'][$type]['mota']==true) || (isset($config['static'][$type]['noidung']) && $config['static'][$type]['noidung']==true)) { ?>
                            <div class="bd-example mt-4">
                                <div class="card mb-0">
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
                                                <?php if(isset($config['static'][$type]['tieude']) && $config['static'][$type]['tieude']==true) { ?>
                                                    <div class="form-group last:mb-0">
                                                        <label class="form-label" for="ten<?=$k?>">Tiêu đề (<?=$k?>):</label>
                                                        <input type="text" class="form-control" name="data[ten<?=$k?>]" id="ten<?=$k?>" placeholder="Tiêu đề (<?=$k?>)" value="<?=@$item['ten'.$k]?>">
                                                    </div>
                                                <?php } ?>
                                                <?php if(isset($config['static'][$type]['mota']) && $config['static'][$type]['mota']==true) { ?>
                                                    <div class="form-group last:mb-0">
                                                        <label class="form-label" for="mota<?=$k?>">Mô tả (<?=$k?>):</label>
                                                        <textarea class="form-control for-seo <?=($config['static'][$type]['mota_cke'])?'form-control-ckeditor':''?>" name="data[mota<?=$k?>]" id="mota<?=$k?>" rows="5" placeholder="Mô tả (<?=$k?>)"><?=htmlspecialchars_decode(@$item['mota'.$k])?></textarea>
                                                    </div>
                                                <?php } ?>
                                                <?php if(isset($config['static'][$type]['noidung']) && $config['static'][$type]['noidung']==true) { ?>
                                                    <div class="form-group last:mb-0">
                                                        <label class="form-label" for="noidung<?=$k?>">Nội dung (<?=$k?>):</label>
                                                        <textarea class="form-control for-seo <?=($config['static'][$type]['noidung_cke'])?'form-control-ckeditor':''?>" name="data[noidung<?=$k?>]" id="noidung<?=$k?>" rows="5" placeholder="Nội dung (<?=$k?>)"><?=htmlspecialchars_decode(@$item['noidung'.$k])?></textarea>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>
                <?php if(isset($config['static'][$type]['seo']) && $config['static'][$type]['seo']==true) { 
                    $seoDB = $seo->getSeoDB(0,$com,'capnhat',$type);
                    include TEMPLATE.LAYOUT."seo.php";
                } ?>
                <div class="card">
                    <div class="card-body">
                        <div class="row pe-4 d-flex align-items-center justify-content-center justify-content-md-between">
                            <?php include TEMPLATE.LAYOUT."saveelement.php"; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
