<?php
	$photo_config = $config['photo']['man_photo'][$type];
    $linkMan = "index.php?com=photo&act=man_photo&type=".$type."&p=".$curPage;
    $linkSave = "index.php?com=photo&act=save_photo&type=".$type."&p=".$curPage;
	$numberPhoto = $photo_config['number_photo'];
?>
<div class="content-inner container-fluid pb-0" id="page_layout">
	<form method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
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
			<?php for($i=0;$i<$numberPhoto;$i++) { $stt = $i+1; ?>
			<div class="col-lg-12 mb-4 last:mb-0">
				<div class="card mb-0">
					<div class="card-header">
						<h5 class="mb-0"><?=$photo_config['title_main_photo'].": ".$stt?></h5>
					</div>
					<div class="card-body">
						<?php if($photo_config['images_photo']) { ?>
						<div class="form-group">
							<label class="change-photo" for="file-zone<?=$i?>">
								<p> <b class="text-gray-800">Upload hình ảnh:</b> <span class="text-danger mt-2 mb-2 text-sm"><?php echo "Width: ".$photo_config['width_photo']." px - Height: ".$photo_config['height_photo']." px (".$photo_config['img_type_photo'].")" ?></span></p>
								<div class="rounded photoUpload-preview flex items-center justify-left " id="photoUpload-preview<?=$i?>">
									<img class="rounded img-upload max-w-2xl" src="<?=UPLOAD_PHOTO.$item['photo']?>" onerror="src='assets/images/noimage.png'" alt="Alt Photo"/>
								</div>
							</label>
							<div class="custom-file my-custom-file mt-3">
								<label for="file-zone<?=$i?>" class="photo-zone form-label" id="photo-zone<?=$i?>">
									<input type="file" class="form-control file-zone"  name="file<?=$i?>" id="file-zone<?=$i?>">
								</label>
							</div>
						</div>
						<?php } ?>

						<?php if(isset($photo_config['link_photo']) && $photo_config['link_photo']==true) { ?>
						<div class="form-group">
							<label for="link<?=$i?>" class="form-label">Link:</label>
							<input type="text" class="form-control" name="dataMulti[<?=$i?>][link]" id="link<?=$i?>" placeholder="Link">
						</div>
						<?php } ?>

						<?php if(isset($photo_config['video_photo']) && $photo_config['video_photo']==true) { ?>
							<div class="form-group">
								<label for="link_video<?=$i?>" class="form-label">Video:</label>
								<input type="text" class="form-control" name="dataMulti[<?=$i?>][link_video]" id="link_video<?=$i?>" onchange="youtubePreview(this.value,'#loadVideo<?=$i?>');" placeholder="Video">
							</div>
							<div class="form-group">
								<label for="link_video" class="form-label font-medium text-black">Video preview:</label>
								<div class="mb-0"><iframe id="loadVideo<?=$i?>" width="0px" height="0px" frameborder="0" allowfullscreen></iframe></div>
							</div>
						<?php } ?>
						<div class="row align-items-center">
							<div class="form-check ps-3 cursor-pointer form-switch col-2">
									<label class="form-label form-check-label font-medium cursor-pointer" for="hienthi-checkbox">Hiển thị:</label>
									<input class="form-check-input l-0 ms-1 !float-none" name="data[hienthi]" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked':''?> type="checkbox" id="hienthi-checkbox" >
							</div>
							<div class="form-group col-md-6">
								<label for="stt<?=$i?>" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
								<input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="dataMulti[<?=$i?>][stt]" id="stt<?=$i?>" placeholder="Số thứ tự" value="1">
							</div>
						</div>

						<?php if((isset($photo_config['tieude_photo']) && $photo_config['tieude_photo']==true) || (isset($photo_config['mota_photo']) && $photo_config['mota_photo']==true) || (isset($photo_config['noidung_photo']) && $photo_config['noidung_photo']==true)) { ?>
						<div class="bd-example mt-4">
							<div class="card mb-0">
								<div class="card-header p-0">
									<nav class="tab-bottom-bordered">
										<div class="mb-0 nav nav-tabs" id="nav-tab1" role="tablist">
											<?php foreach($config['website']['lang'] as $k => $v) { ?>
											<button class="nav-link <?=($k=='vi')?'active':''?>" id="tabs-lang-<?=$i?>" data-bs-toggle="tab" data-bs-target="#tabs-lang-<?=$i?>-<?=$k?>" type="button" role="tab" aria-controls="tabs-lang-<?=$i?>-<?=$k?>" aria-selected="true"><?=$v?></button>
											<?php }?>
										</div>
									</nav>
								</div>
								<div class="card-body">
									<div class="tab-content iq-tab-fade-up" id="nav-tabContent">
									<?php foreach($config['website']['lang'] as $k => $v) { ?>
										<div class="tab-pane fade <?=($k=='vi')?'active show':''?>" id="tabs-lang-<?=$i?>-<?=$k?>" role="tabpanel" aria-labelledby="tabs-lang-<?=$i?>-<?=$k?>">
											<?php if((isset($photo_config['tieude_photo']) && $photo_config['tieude_photo']==true)) { ?>
											<div class="form-group last:mb-0">
												<label for="ten<?=$k?><?=$i?>" class="form-label">Tiêu đề (<?=$k?>):</label>
												<input type="text" class="form-control" name="dataMulti[<?=$i?>][ten<?=$k?>]" id="ten<?=$k?><?=$i?>" placeholder="Tiêu đề (<?=$k?>)" value="<?=@$item['ten'.$k]?>">
											</div>
											<?php } ?>
											<?php if((isset($photo_config['mota_photo']) && $photo_config['mota_photo']==true)) { ?>
												<div class="form-group last:mb-0">
													<label for="mota<?=$k?><?=$i?>" class="form-label">Mô tả (<?=$k?>):</label>
													<textarea class="form-control <?=($photo_config['mota_cke_photo'])?'form-control-ckeditor':''?>" name="dataMulti[<?=$i?>][mota<?=$k?>]" id="mota<?=$k?><?=$i?>" rows="5" placeholder="Mô tả (<?=$k?>)"><?=htmlspecialchars_decode(@$item['mota'.$k])?></textarea>
												</div>
											<?php } ?>
											<?php if((isset($photo_config['noidung_photo']) && $photo_config['noidung_photo']==true)) { ?>
												<div class="form-group last:mb-0">
													<label for="noidung<?=$k?><?=$i?>" class="form-label">Nội dung (<?=$k?>):</label>
													<textarea class="form-control <?=($photo_config['noidung_cke_photo'])?'form-control-ckeditor':''?>" name="dataMulti[<?=$i?>][noidung<?=$k?>]" id="noidung<?=$k?><?=$i?>" rows="5" placeholder="Nội dung (<?=$k?>)"><?=htmlspecialchars_decode(@$item['noidung'.$k])?></textarea>
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
			</div>
			<?php }?>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="row pe-4 d-flex align-items-center justify-content-center justify-content-md-between">
					<?php include TEMPLATE.LAYOUT."saveelement.php"; ?>
				</div>
			</div>
		</div>
	</form>
</div>
