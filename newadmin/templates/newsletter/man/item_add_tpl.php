<?php
    $linkMan = "index.php?com=newsletter&act=man&type=".$type."&p=".$curPage;
    $linkSave = "index.php?com=newsletter&act=save&type=".$type."&p=".$curPage;
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
                        <h5 class="mb-0">Chi tiết <?=$config['newsletter'][$type]['title_main']?></h5>
                    </div>
                    <div class="card-body">
                        <?php if(isset($config['newsletter'][$type]['file']) && $config['newsletter'][$type]['file']==true) { ?>
                            <div class="form-group">
                                <label class="change-file form-label mb-1 mr-2" for="file-taptin">
                                    <p> <b class="text-gray-800">Chọn tập tin:</b> <span class="text-danger mt-2 mb-2 text-sm"><?php echo $config['newsletter'][$type]['file_type']; ?></span></p>
                                    <div class="custom-file my-custom-file ">
                                        <input type="file" class="form-control" name="file-taptin" id="file-taptin">
                                    </div>
                                    </label>
                                <?php if(!empty($item['taptin']) && $item['taptin']==true) { ?>
                                    <a class="btn btn-sm bg-primary text-white d-inline-block align-middle p-2 rounded mb-1" href="<?=UPLOAD_FILE.$item['taptin']?>" title="Download tập tin hiện tại"><i class="fas fa-download mr-2"></i>Download tập tin hiện tại</a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <div class="form-group-category row">
                            <?php if(isset($config['newsletter'][$type]['ten']) && $config['newsletter'][$type]['ten']==true) { ?>
                                <div class="form-group col-md-4">
                                    <label for="ten" class="form-label">Họ tên:</label>
                                    <input type="text" class="form-control" name="data[ten]" id="ten" placeholder="Họ tên" value="<?=@$item['ten']?>">
                                </div>
                            <?php } ?>
                            <?php if(isset($config['newsletter'][$type]['dienthoai']) && $config['newsletter'][$type]['dienthoai']==true) { ?>
                                <div class="form-group col-md-4">
                                    <label for="dienthoai" class="form-label">Điện thoại:</label>
                                    <input type="text" class="form-control" name="data[dienthoai]" id="dienthoai" placeholder="Điện thoại" value="<?=@$item['dienthoai']?>">
                                </div>
                            <?php } ?>
                            <?php if(isset($config['newsletter'][$type]['email']) && $config['newsletter'][$type]['email']==true) { ?>
                                <div class="form-group col-md-4">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" name="data[email]" id="email" placeholder="Email" value="<?=@$item['email']?>">
                                </div>
                            <?php } ?>
                            <?php if(isset($config['newsletter'][$type]['diachi']) && $config['newsletter'][$type]['diachi']==true) { ?>
                                <div class="form-group col-md-4">
                                    <label for="diachi" class="form-label">Địa chỉ:</label>
                                    <input type="text" class="form-control" name="data[diachi]" id="diachi" placeholder="Địa chỉ" value="<?=@$item['diachi']?>">
                                </div>
                            <?php } ?>
                            <?php if(isset($config['newsletter'][$type]['chude']) && $config['newsletter'][$type]['chude']==true) { ?>
                                <div class="form-group col-md-4">
                                    <label for="chude" class="form-label">Chủ đề:</label>
                                    <input type="text" class="form-control" name="data[chude]" id="chude" placeholder="Chủ đề" value="<?=@$item['chude']?>">
                                </div>
                            <?php } ?>
                            <?php if(isset($config['newsletter'][$type]['tinhtrang']) && $config['newsletter'][$type]['tinhtrang']==true) { ?>
                                <div class="form-group col-md-4">
                                    <label for="tinhtrang" class="form-label">Tình trạng:</label>
                                    <select id="tinhtrang" name="data[tinhtrang]" class="select2-basic-single js-states form-control" id="select-tinhtrang">
                                        <option value="0">Cập nhật tình trạng</option>
                                        <?php foreach ($config['newsletter'][$type]['tinhtrang'] as $key => $value) { ?>
                                            <option <?=(@$item['tinhtrang']==$key)?"selected":""?> value="<?=$key?>"><?=$value?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            <?php } ?>
                        </div>
                        <?php if(isset($config['newsletter'][$type]['noidung']) && $config['newsletter'][$type]['noidung']==true) { ?>
                            <div class="form-group">
                                <label for="noidung" class="form-label">Nội dung:</label>
                                <textarea class="form-control" name="data[noidung]" id="noidung" rows="5" placeholder="Nội dung"><?=@$item['noidung']?></textarea>
                            </div>
                        <?php } ?>
                        <?php if(isset($config['newsletter'][$type]['ghichu']) && $config['newsletter'][$type]['ghichu']==true) { ?>
                            <div class="form-group">
                                <label for="ghichu" class="form-label">Ghi chú:</label>
                                <textarea class="form-control" name="data[ghichu]" id="ghichu" rows="5" placeholder="Ghi chú"><?=@$item['ghichu']?></textarea>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <label for="stt" class="d-inline-block align-middle form-label mb-0 mr-2">Số thứ tự:</label>
                            <input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?=isset($item['stt'])?$item['stt']:1?>">
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
    </form>
</div>
