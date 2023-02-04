<?php
    $linkSave = "index.php?com=seopage&act=save&type=".$_GET['type'];
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
                        <h5 class="mb-0">Thông tin SEO page - <?=$config['seopage']['page'][$_GET['type']]?></h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group last:mb-0">
                            <label class="change-photo" for="file-zone">
                                <p> <b class="text-gray-800">Upload hình ảnh:</b> <span class="text-danger mt-2 mb-2 text-sm"><?php echo "Width: ".$config['seopage']['width']." px - Height: ".$config['seopage']['height']." px (".$config['seopage']['img_type'].")" ?></span></p>
                                <div class="rounded photoUpload-preview flex items-center justify-left " id="photoUpload-preview">
                                    <img class="rounded img-upload max-w-[300px]" src="<?=UPLOAD_SEOPAGE_L.$item['photo']?>" onerror="src='assets/images/noimage.png'" alt="Alt Photo"/>
                                </div>
                            </label>
                            <div class="custom-file my-custom-file mt-3">
                                <label for="file" class="photo-zone" id="photo-zone">
                                    <input type="file" class="form-control file-zone"  name="file" id="file-zone">
                                </label>
                            </div>
                        </div> 
                    </div>
                </div>
                <?php $seoDB = $item; include TEMPLATE.LAYOUT."seo.php";?>
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
