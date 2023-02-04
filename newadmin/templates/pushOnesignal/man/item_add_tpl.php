<?php
    $linkMan = "index.php?com=pushOnesignal&act=man&p=".$curPage;
    $linkSave = "index.php?com=pushOnesignal&act=save&p=".$curPage;
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
                        <h5 class="mb-0"><?=($act=="edit")?"Cập nhật":"Thêm mới";?> thông báo đẩy</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="change-photo" for="file-zone">
                                <p> <b class="text-gray-800">Upload hình ảnh:</b> <span class="text-danger mt-2 mb-2 text-sm">Width: 100px - Height: 100px (.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF)</span></p>
                                <div class="rounded photoUpload-preview flex items-center justify-left " id="photoUpload-preview">
                                    <img class="rounded img-upload max-w-[100px]" src="<?=UPLOAD_SYNC.$item['photo']?>" onerror="src='assets/images/noimage.png'" alt="Alt Photo"/>
                                </div>
                            </label>
                            <div class="custom-file my-custom-file mt-3">
                                <label for="file" class="photo-zone" id="photo-zone">
                                    <input type="file" class="form-control file-zone"  name="file" id="file-zone">
                                </label>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="name" class="form-label">Tiêu đề:</label>
                            <input type="text" class="form-control" name="data[name]" id="name" placeholder="Tiêu đề" value="<?=@$item['name']?>" required>
                        </div>
                        <div class="form-group">
                            <label for="link" class="form-label">Link:</label>
                            <input type="text" class="form-control" name="data[link]" id="link" placeholder="Link" value="<?=@$item['link']?>" required>
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">Mô tả:</label>
                            <textarea class="form-control" name="data[description]" id="description" rows="5" placeholder="Mô tả" required><?=@$item['description']?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="stt" class="d-inline-block form-label align-middle mb-0 mr-2">Số thứ tự:</label>
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
