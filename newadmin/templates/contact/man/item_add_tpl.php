<?php
    $linkMan = "index.php?com=contact&act=man&p=".$curPage;
    $linkSave = "index.php?com=contact&act=save&p=".$curPage;
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
                        <h5 class="mb-0">Thông tin liên hệ</h5>
                    </div>
                        <div class="card-body">
                            <?php if(isset($item['taptin']) && $item['taptin']==true) { ?>
                                <div class="form-group">
                                    <a class="btn btn-sm bg-primary text-white d-inline-block align-middle p-2 rounded mb-1" href="<?=UPLOAD_FILE.$item['taptin']?>" title="Download tập tin hiện tại"><i class="fas fa-download mr-2"></i>Download tập tin hiện tại</a>
                                </div>
                            <?php } ?>
                            <div class="form-group-category row">
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="ten">Họ tên:</label>
                                    <input type="text" class="form-control" name="data[ten]" id="ten" placeholder="Họ tên" value="<?=@$item['ten']?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="dienthoai">Điện thoại:</label>
                                    <input type="text" class="form-control" name="data[dienthoai]" id="dienthoai" placeholder="Điện thoại" value="<?=@$item['dienthoai']?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="email">Email:</label>
                                    <input type="email" class="form-control" name="data[email]" id="email" placeholder="Email" value="<?=@$item['email']?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="diachi">Địa chỉ:</label>
                                    <input type="text" class="form-control" name="data[diachi]" id="diachi" placeholder="Địa chỉ" value="<?=@$item['diachi']?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="tieude">Chủ đề:</label>
                                    <input type="text" class="form-control" name="data[tieude]" id="tieude" placeholder="Chủ đề" value="<?=@$item['tieude']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="noidung" class="form-label">Nội dung:</label>
                                <textarea class="form-control" name="data[noidung]" id="noidung" rows="5" placeholder="Nội dung"><?=@$item['noidung']?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="ghichu" class="form-label">Ghi chú:</label>
                                <textarea class="form-control" name="data[ghichu]" id="ghichu" rows="5" placeholder="Ghi chú"><?=@$item['ghichu']?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="stt" class="d-inline-block align-middle form-label mb-0 mr-2">Số thứ tự:</label>
                                <input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?=isset($item['stt'])?$item['stt']:1?>">
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
    </form>
</div>
