<?php
    $linkMan = "index.php?com=product&act=man_mau&type=".$type."&p=".$curPage;
    $linkSave = "index.php?com=product&act=save_mau&type=".$type."&p=".$curPage;
?>
<div class="content-inner container-fluid pb-0" id="page_layout">
    <form class="validation-form" novalidate method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card mb-0">
                    <div class="card-header">
                        <div class="d-flex justify-start align-items-center flex-wrap gap-3">
                            <?php include TEMPLATE.LAYOUT."actionsave.php"; ?>
                        </div>
                    </div>
                    <div class="card-body pt-0"></div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Chi tiết màu sắc</h5>
                    </div>
                    <div class="card-body">
                        <?php if(!empty($config['product'][$type]['mau_images']) && $config['product'][$type]['mau_images']==true) { ?>
                        <div class="form-group">
                            <label class="change-photo" for="file-zone">
                                <p> <b class="text-gray-800">Upload hình ảnh:</b> <span class="text-danger mt-2 mb-2 text-sm"><?php echo "Width: ".$config['product'][$type]['width_mau']." px - Height: ".$config['product'][$type]['height_mau']." px (".$config['product'][$type]['img_type_mau'].")" ?></span></p>
                                <div class="rounded photoUpload-preview flex items-center justify-left " id="photoUpload-preview">
                                    <img class="rounded img-upload max-h-[300px]" src="<?=UPLOAD_COLOR.$item['photo']?>" onerror="src='assets/images/noimage.png'" alt="Alt Photo"/>
                                </div>
                            </label>
                            <div class="custom-file my-custom-file mt-3">
                                <label for="file" class="photo-zone" id="photo-zone">
                                    <input type="file" class="form-control file-zone"  name="file" id="file-zone">
                                </label>
                            </div>
                        </div>
                        <?php }?>
                        <div class="row">
                            <?php if(!empty($config['product'][$type]['mau_mau']) && $config['product'][$type]['mau_mau']==true) { ?>
                                <div class="form-group col-md-3 col-sm-4">
                                    <label class="d-block form-label" for="mau">Màu sắc:</label>
                                    <input type="text" class="form-control jscolor" name="data[mau]" id="mau" maxlength="7" value="<?=($item['mau'])?$item['mau']:'#000000'?>">
                                </div>
                            <?php } ?>
                            <?php if(!empty($config['product'][$type]['mau_gia']) && $config['product'][$type]['mau_gia']==true) { ?>
                                <div class="form-group col-md-3 col-sm-4">
                                    <label class="d-block form-label" for="ten">Giá:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control format-price" name="data[gia]" id="gia" placeholder="Giá bán" value="<?=(!empty($item['gia'])) ? $item['gia']:''?>">
                                        <div class="input-group-append">
                                            <div class="input-group-text"><strong>VNĐ</strong></div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if(!empty($config['product'][$type]['mau_loai']) && $config['product'][$type]['mau_loai']==true && !empty($config['product'][$type]['mau_images']) && $config['product'][$type]['mau_images']==true) { ?>
                                <div class="form-group col-md-3 col-sm-4">
                                    <label for="loaihienthi" class="form-label">Loại hiển thị:</label>
                                    <select class="form-control select2-basic-single js-states form-control" id="select-loaihienthi" name="data[loaihienthi]" id="loaihienthi">
                                        <option value="0">Chọn loại hiển thị</option>
                                        <option <?=(!empty($item['loaihienthi']) && $item['loaihienthi']==0)?"selected":""?> value="0">Màu sắc</option>
                                        <option <?=(!empty($item['loaihienthi']) && $item['loaihienthi']==1)?"selected":""?> value="1">Hình ảnh</option>
                                    </select>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="row items-center">
                            <div class="form-group col-md-1">
                                <label for="hienthi" class="d-inline-block form-check-label align-middle mb-0 mr-2">Hiển thị:</label>
                                <div class="custom-control custom-checkbox d-inline-block align-middle form-switch">
                                    <input type="checkbox" class="custom-control-input form-check-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked':''?>>
                                    <label for="hienthi-checkbox" class="custom-control-label"></label>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="stt" class="d-inline-block form-check-label align-middle mb-0 mr-2">Số thứ tự:</label>
                                <input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?=isset($item['stt'])?$item['stt']:1?>">
                            </div>
                        </div>
                        <div class="bd-example">
                            <div class="card mb-0 card-article">
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
                                            <div class="form-group last:mb-0">
                                                <label class="form-label" for="ten<?=$k?>">Tiêu đề (<?=$k?>):</label>
                                                <input type="text" class="form-control for-seo" name="data[ten<?=$k?>]" id="ten<?=$k?>" placeholder="Tiêu đề (<?=$k?>)" value="<?=(!empty($item['ten'.$k])) ? $item['ten'.$k]:''?>" <?=($k=='vi')?'required':''?>>
                                            </div>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-start align-items-center flex-wrap gap-3">
                            <?php include TEMPLATE.LAYOUT."actionsave.php"; ?>
                        </div>
                    </div>
                    <div class="card-body pt-0"></div>
                </div>
            </div>
        </div>
    </form>
</div>
