<?php
	$photo_config = $config['photo']['man_photo'][$type];
    $linkMan = "index.php?com=photo&act=man_photo&type=".$type."&p=".$curPage;
    $linkSave = "index.php?com=photo&act=save_photo&type=".$type."&p=".$curPage;
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item"><a href="<?=$linkMan?>" title="<?=$photo_config['title_main_photo']?>">Quản lý <?=$photo_config['title_main_photo']?></a></li>
                <li class="breadcrumb-item active">Thêm mới <?=$photo_config['title_main_photo']?></li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-sm bg-gradient-primary"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
		<?php $numberPhoto = $photo_config['number_photo']; ?>
		<?php for($i=0;$i<$numberPhoto;$i++) { $stt = $i+1; ?>
			<div class="card card-primary card-outline text-sm">
	            <div class="card-header">
	                <h3 class="card-title"><?=$photo_config['title_main_photo'].": ".$stt?></h3>
	                <div class="card-tools">
	                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
	                </div>
	            </div>
	            <div class="card-body">
					<?php if($photo_config['images_photo']) { ?>
	                    <div class="form-group">
	                        <label class="change-photo" for="file<?=$i?>">
	                            <p>Upload hình ảnh: <strong class="text-danger mt-2 mb-2 text-sm"><?php echo "Width: ".$photo_config['width_photo']." px - Height: ".$photo_config['height_photo']." px (".$photo_config['img_type_photo'].")" ?></strong></p>
	                            <div class="rounded">
	                                <img class="rounded img-upload" src="" onerror="src='assets/images/noimage.png'" alt="Alt Photo"/>
	                                <strong class="justify-content-start flex-row mt-2">
	                                    <span class="btn btn-sm bg-gradient-success"><i class="fas fa-camera mr-2"></i>Chọn hình</span>
	                                    <b class="text-sm text-split ml-3"></b>
	                                </strong>
	                            </div>
	                        </label>
	                        <div class="custom-file my-custom-file d-none">
	                            <input type="file" class="custom-file-input" name="file<?=$i?>" id="file<?=$i?>">
	                            <label class="custom-file-label" for="file<?=$i?>">Chọn file</label>
	                        </div>
	                    </div>
	                <?php } ?>
	                <?php if(isset($photo_config['link_photo']) && $photo_config['link_photo']==true) { ?>
		                <div class="form-group">
		                    <label for="link<?=$i?>">Link:</label>
		                    <input type="text" class="form-control" name="dataMulti[<?=$i?>][link]" id="link<?=$i?>" placeholder="Link">
		                </div>
		            <?php } ?>
		            <?php if(isset($photo_config['video_photo']) && $photo_config['video_photo']==true) { ?>
		                <div class="form-group">
		                    <label for="link_video<?=$i?>">Video:</label>
		                    <input type="text" class="form-control" name="dataMulti[<?=$i?>][link_video]" id="link_video<?=$i?>" onchange="youtubePreview(this.value,'#loadVideo<?=$i?>');" placeholder="Video">
		                </div>
		                <div class="form-group">
		                    <label for="link_video">Video preview:</label>
		                    <div><iframe id="loadVideo<?=$i?>" width="0px" height="0px" frameborder="0" allowfullscreen></iframe></div>
		                </div>
		            <?php } ?>
		            <div class="row align-items-center">
		            	<div class="form-group col-md-6">
		                    <label for="hienthi<?=$i?>" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
		                    <div class="custom-control custom-checkbox d-inline-block align-middle">
		                        <input type="checkbox" class="custom-control-input hienthi-checkbox" name="dataMulti[<?=$i?>][hienthi]" id="hienthi-checkbox<?=$i?>" checked>
		                        <label for="hienthi-checkbox<?=$i?>" class="custom-control-label"></label>
		                    </div>
		                </div>
		                <div class="form-group col-md-6">
							<label for="stt<?=$i?>" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
							<input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="dataMulti[<?=$i?>][stt]" id="stt<?=$i?>" placeholder="Số thứ tự" value="1">
						</div>
		            </div>
		            <?php if((isset($photo_config['tieude_photo']) && $photo_config['tieude_photo']==true) || (isset($photo_config['mota_photo']) && $photo_config['mota_photo']==true) || (isset($photo_config['noidung_photo']) && $photo_config['noidung_photo']==true)) { ?>
		                <div class="card card-primary card-outline card-outline-tabs">
		                    <div class="card-header p-0 border-bottom-0">
		                        <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
		                            <?php foreach($config['website']['lang'] as $k => $v) { ?>
		                                <li class="nav-item">
		                                    <a class="nav-link <?=($k=='vi')?'active':''?>" id="tabs-lang" data-toggle="pill" href="#tabs-lang-<?=$k?>-<?=$i?>" role="tab" aria-controls="tabs-lang-<?=$k?>-<?=$i?>" aria-selected="true"><?=$v?></a>
		                                </li>
		                            <?php } ?>
		                        </ul>
		                    </div>
		                    <div class="card-body">
		                        <div class="tab-content" id="custom-tabs-three-tabContent-lang">
		                            <?php foreach($config['website']['lang'] as $k => $v) { ?>
		                                <div class="tab-pane fade show <?=($k=='vi')?'active':''?>" id="tabs-lang-<?=$k?>-<?=$i?>" role="tabpanel" aria-labelledby="tabs-lang">
		                                    <?php if((isset($photo_config['tieude_photo']) && $photo_config['tieude_photo']==true)) { ?>
		                                        <div class="form-group">
		                                            <label for="ten<?=$k?><?=$i?>">Tiêu đề (<?=$k?>):</label>
		                                            <input type="text" class="form-control" name="dataMulti[<?=$i?>][ten<?=$k?>]" id="ten<?=$k?><?=$i?>" placeholder="Tiêu đề (<?=$k?>)" value="<?=@$item['ten'.$k]?>">
		                                        </div>
		                                    <?php } ?>
		                                    <?php if((isset($photo_config['mota_photo']) && $photo_config['mota_photo']==true)) { ?>
		                                        <div class="form-group">
		                                            <label for="mota<?=$k?><?=$i?>">Mô tả (<?=$k?>):</label>
		                                            <textarea class="form-control <?=($photo_config['mota_cke_photo'])?'form-control-ckeditor':''?>" name="dataMulti[<?=$i?>][mota<?=$k?>]" id="mota<?=$k?><?=$i?>" rows="5" placeholder="Mô tả (<?=$k?>)"><?=htmlspecialchars_decode(@$item['mota'.$k])?></textarea>
		                                        </div>
		                                    <?php } ?>
		                                    <?php if((isset($photo_config['noidung_photo']) && $photo_config['noidung_photo']==true)) { ?>
		                                        <div class="form-group">
		                                            <label for="noidung<?=$k?><?=$i?>">Nội dung (<?=$k?>):</label>
		                                            <textarea class="form-control <?=($photo_config['noidung_cke_photo'])?'form-control-ckeditor':''?>" name="dataMulti[<?=$i?>][noidung<?=$k?>]" id="noidung<?=$k?><?=$i?>" rows="5" placeholder="Nội dung (<?=$k?>)"><?=htmlspecialchars_decode(@$item['noidung'.$k])?></textarea>
		                                        </div>
		                                    <?php } ?>
		                                </div>
		                            <?php } ?>
		                        </div>
		                    </div>
		                </div>
		            <?php } ?>
	            </div>
	        </div>
		<?php } ?>
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
    </form>
</section>