<?php
	function get_main_list()
    {
        global $d, $type;

        $row = $d->rawQuery("select tenvi, id from #_news_list where type = ? order by stt,id desc",array($type));

        $str = '<select id="id_list" name="data[id_list]" data-level="0" data-type="'.$type.'" data-table="#_news_cat" data-child="id_cat" class="select2-basic-single js-states form-control select-category" id="select-list"><option value="0">Chọn danh mục cấp 1</option>';
        foreach($row as $v)
        {
            $id_list = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']):'';
            if($v["id"] == (int)$id_list) $selected = "selected";
            else $selected = "";

            $str .= '<option value='.$v["id"].' '.(isset($selected) ? $selected:'').'>'.$v["tenvi"].'</option>';
        }
        $str .= '</select>';

        return $str;
    }

	function get_main_cat()
	{
		global $d, $type;

        $id_list = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']):'';
        $row = $d->rawQuery("select tenvi, id from #_news_cat where id_list = ? and type = ? order by stt,id desc",array($id_list,$type));

		$str = '<select id="id_cat" name="data[id_cat]" data-level="1" data-type="'.$type.'" data-table="#_news_item" data-child="id_item" class="select2-basic-single js-states form-control select-category" id="select-cat"><option value="0">Chọn danh mục cấp 2</option>';
		foreach($row as $v)
        {
            $id_cat = (isset($_REQUEST['id_cat'])) ? htmlspecialchars($_REQUEST['id_cat']):'';
            if($v["id"] == (int)$id_cat) $selected = "selected";
            else $selected = "";

            $str .= '<option value='.$v["id"].' '.(isset($selected) ? $selected:'').'>'.$v["tenvi"].'</option>';
        }
        $str .= '</select>';

		return $str;
	}

	function get_main_item()
	{
		global $d, $type;

        $id_list = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']):'';
        $id_cat = (isset($_REQUEST['id_cat'])) ? htmlspecialchars($_REQUEST['id_cat']):'';
        $row = $d->rawQuery("select tenvi, id from #_news_item where id_list = ? and id_cat = ? and type = ? order by stt,id desc",array($id_list,$id_cat,$type));

		$str = '<select id="id_item" name="data[id_item]" data-level="2" data-type="'.$type.'" data-table="#_news_sub" data-child="id_sub" class="select2-basic-single js-states form-control select-category" id="select-item"><option value="0">Chọn danh mục cấp 3</option>';
		foreach($row as $v)
        {
            $id_item = (isset($_REQUEST['id_item'])) ? htmlspecialchars($_REQUEST['id_item']):'';
            if($v["id"] == (int)$id_cat) $selected = "selected";
            else $selected = "";

            $str .= '<option value='.$v["id"].' '.(isset($selected) ? $selected:'').'>'.$v["tenvi"].'</option>';
        }
        $str .= '</select>';

		return $str;
	}
    
	function get_main_sub()
	{
		global $d, $type;

        $id_list = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']):'';
        $id_cat = (isset($_REQUEST['id_cat'])) ? htmlspecialchars($_REQUEST['id_cat']):'';
        $id_item = (isset($_REQUEST['id_item'])) ? htmlspecialchars($_REQUEST['id_item']):'';
        $row = $d->rawQuery("select tenvi, id from #_news_sub where id_list = ? and id_cat = ? and id_item = ? and type = ? order by stt,id desc",array($id_list,$id_cat,$id_item,$type));

		$str = '<select id="id_sub" name="data[id_sub]" class="select2-basic-single js-states form-control select-category" id="select-sub"><option value="0">Chọn danh mục cấp 4</option>';
		foreach($row as $v)
        {
            $id_sub = (isset($_REQUEST['id_sub'])) ? htmlspecialchars($_REQUEST['id_sub']):'';
            if($v["id"] == (int)$id_sub) $selected = "selected";
            else $selected = "";

            $str .= '<option value='.$v["id"].' '.(isset($selected) ? $selected:'').'>'.$v["tenvi"].'</option>';
        }
        $str .= '</select>';

		return $str;
	}

	function get_tags($id=0)
    {
        global $d, $type;

        if($id!='' && $id!=0)
        {
            $temps = $d->rawQueryOne("select id_tags from #_news where id = ? and type = ?",array($id,$type));
            $arr_tags = explode(',', $temps['id_tags']);
            
            for($i=0;$i<count($arr_tags);$i++) $temp[$i]=$arr_tags[$i];
        }

        $row_tags = $d->rawQuery("select tenvi, id from #_tags where type = ? order by stt,id desc",array($type));

        $str = '<select id="tags_group" name="tags_group[]" class="select2-basic-single js-states form-control" id="select-tag" multiple="multiple" >';
        for($i=0;$i<count($row_tags);$i++)
        {
            if(!empty($temp))
            {   
                if(in_array($row_tags[$i]['id'],$temp)) $selected = 'selected="selected"';
                else $selected = '';
            }
            $str .= '<option value="'.$row_tags[$i]["id"].'" '.(isset($selected) ? $selected:'').' /> '.$row_tags[$i]["tenvi"].'</option>';
        }
        $str .= '</select>';

        return $str;
    }

	if($act=="add") $labelAct = "Thêm mới";
	else if($act=="edit") $labelAct = "Chỉnh sửa";
	else if($act=="copy")  $labelAct = "Sao chép";

	$linkMan = "index.php?com=news&act=man&type=".$type."&p=".$curPage;
	if($act=='add') $linkFilter = "index.php?com=news&act=add&type=".$type."&p=".$curPage;
	else if($act=='edit') $linkFilter = "index.php?com=news&act=edit&type=".$type."&p=".$curPage."&id=".$id;
    if($act=="copy") $linkSave = "index.php?com=news&act=save_copy&type=".$type."&p=".$curPage;
    else $linkSave = "index.php?com=news&act=save&type=".$type."&p=".$curPage;

    /* Check cols */
    if(!empty($config['news'][$type]['gallery'])){
        foreach($config['news'][$type]['gallery'] as $key => $value){
            if($key==$type)
            {
                $flagGallery=true;
                break;
            }
        }
    }
    

    if((isset($config['news'][$type]['icon']) && $config['news'][$type]['icon']==true) || (isset($config['news'][$type]['dropdown']) && $config['news'][$type]['dropdown']==true) || (isset($config['news'][$type]['tags']) && $config['news'][$type]['tags']==true) || (isset($config['news'][$type]['images']) && $config['news'][$type]['images']==true) || (isset($flagGallery) && $flagGallery=true))
    {
        $colLeft = "col-xl-8";
        $colRight = "col-xl-4";
    }
    else
    {
        $colLeft = "col-12";
        $colRight = "d-none";   
    }
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
            <div class="<?=$colLeft?>">
                <?php if($config['news'][$type]['slug']){
	                	$slugchange = ($act=='edit') ? 1 : 0;
	                	$copy = ($act!='copy') ? 0 : 1;
						include TEMPLATE.LAYOUT."slug.php";
				    }
                ?>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Nội dung <?=$config['news'][$type]['title_main']?></h5>
                    </div>
                    <div class="card-body">
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
                                            <?php if(isset($config['news'][$type]['mota']) && $config['news'][$type]['mota']==true) { ?>
                                                <div class="form-group last:mb-0">
                                                    <label class="form-label" for="mota<?=$k?>">Mô tả (<?=$k?>):</label>
                                                    <textarea class="form-control for-seo <?=($config['news'][$type]['mota_cke'])?'form-control-ckeditor':''?>" name="data[mota<?=$k?>]" id="mota<?=$k?>" rows="5" placeholder="Mô tả (<?=$k?>)"><?=(!empty($item['mota'.$k])) ?htmlspecialchars_decode($item['mota'.$k]):''?></textarea>
                                                </div>
                                            <?php } ?>
                                            <?php if(isset($config['news'][$type]['noidung']) && $config['news'][$type]['noidung']==true) { ?>
                                                <div class="form-group last:mb-0">
                                                    <label class="form-label" for="noidung<?=$k?>">Nội dung (<?=$k?>):</label>
                                                    <textarea class="form-control for-seo <?=($config['news'][$type]['noidung_cke'])?'form-control-ckeditor':''?>" name="data[noidung<?=$k?>]" id="noidung<?=$k?>" rows="5" placeholder="Nội dung (<?=$k?>)"><?=htmlspecialchars_decode(@$item['noidung'.$k])?></textarea>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="<?=$colRight?>">
            	<?php if((isset($config['news'][$type]['dropdown']) && $config['news'][$type]['dropdown']==true) || (isset($config['news'][$type]['brand']) && $config['news'][$type]['brand']==true) || (isset($config['news'][$type]['tags']) && $config['news'][$type]['tags']==true) || (isset($config['news'][$type]['mau']) && $config['news'][$type]['mau']==true) || (isset($config['news'][$type]['size']) && $config['news'][$type]['size']==true)) { ?>
                <div class="card">
                    <div class="card-header">
                         <h5 class="mb-0">Danh mục <?=$config['news'][$type]['title_main']?></h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group-category row">
                        	<?php if($config['news'][$type]['dropdown']) { ?>
			            		<?php if(!empty($config['news'][$type]['list']) && $config['news'][$type]['list']) { ?>
					                <div class="form-group last:mb-0 col-xl-6 col-sm-4">
					                    <label class="d-block form-label" for="id_list">Danh mục cấp 1:</label>
					                    <?=get_main_list()?>
					                </div>
					            <?php } ?>
					            <?php if(!empty($config['news'][$type]['cat']) && $config['news'][$type]['cat']) { ?>
					                <div class="form-group last:mb-0 col-xl-6 col-sm-4">
					                    <label class="d-block form-label" for="id_cat">Danh mục cấp 2:</label>
					                    <?=get_main_cat()?>
					                </div>
					            <?php } ?>
				                <?php if(!empty($config['news'][$type]['item']) && $config['news'][$type]['item']) { ?>
					                <div class="form-group last:mb-0 col-xl-6 col-sm-4">
					                    <label class="d-block form-label" for="id_item">Danh mục cấp 3:</label>
					                    <?=get_main_item()?>
					                </div>
					            <?php } ?>
				                <?php if(!empty($config['news'][$type]['sub']) && $config['news'][$type]['sub']) { ?>
					                <div class="form-group last:mb-0 col-xl-6 col-sm-4">
					                    <label class="d-block form-label" for="id_sub">Danh mục cấp 4:</label>
					                    <?=get_main_sub()?>
					                </div>
					            <?php } ?>
				            <?php } ?>
				            <?php if(!empty($config['news'][$type]['brand']) && $config['news'][$type]['brand']) { ?>
						    	<div class="form-group last:mb-0 col-xl-6 col-sm-4">
				                    <label class="d-block form-label" for="id_brand">Danh mục hãng:</label>
				                    <?=get_main_brand()?>
				                </div>
						    <?php } ?>
							<?php if(!empty($config['news'][$type]['tags']) && $config['news'][$type]['tags']) { ?>
								<div class="form-group last:mb-0 col-xl-12 col-sm-12">
									<label class="d-block form-label" for="id_tags">Danh mục tags:</label>
									<?=get_tags($item['id'])?>
								</div>
							<?php } ?>
							<?php if(!empty($config['news'][$type]['mau']) && $config['news'][$type]['mau']) { ?>
								<div class="form-group last:mb-0 col-xl-12 col-sm-12">
									<label class="d-block form-label" for="id_mau">Danh mục màu sắc:</label>
									<?=(!empty($item)) ? get_mau($item['id']):get_mau(0)?>
								</div>
							<?php } ?>
							<?php if(!empty($config['news'][$type]['size']) && $config['news'][$type]['size']) { ?>
								<div class="form-group last:mb-0 col-xl-12 col-sm-12">
									<label class="d-block form-label" for="id_size">Danh mục kích thước:</label>
									<?=(!empty($item)) ? get_size($item['id']):get_size(0)?>
								</div>
							<?php } ?>
                        </div>
                    </div>
                </div>
            	<?php }?>

				<div class="card">
					<div class="card-header">
						<h5 class="mb-0">Thông tin <?=$config['news'][$type]['title_main']?></h5>
					</div>
					<div class="card-body">
						<?php if(!empty($config['news'][$type]['file']) && $config['news'][$type]['file']) { ?>
		                    <div class="form-group">
		                        <label class="change-file mb-1 mr-2" for="file-taptin">
		                        	<p>Upload tập tin: <span class="text-danger mt-2 mb-2 text-sm"><?php echo $config['news'][$type]['file_type']; ?></span></p>
		                        </label>
		                        <div class="custom-file my-custom-file">
									<input type="file" class="form-control"  name="file-taptin" id="file-taptin">
		                        </div>
		                        <?php if(!empty($item['taptin'])) { ?>
		                            <a class="btn btn-primary w-100 flex items-center justify-center mt-3" href="<?=UPLOAD_FILE.$item['taptin']?>" title="Download tập tin hiện tại"><i class="fas fa-download mr-2"></i>Download tập tin hiện tại</a>
		                        <?php } ?>
		                    </div>
		                <?php } ?>
						<div class="row">
			                <?php if(!empty($config['news'][$type]['ma']) && $config['news'][$type]['ma']) { ?>
			                    <div class="form-group col-md-6">
			                        <label class="d-block form-label" for="masp">Mã sản phẩm:</label>
			                        <input type="text" class="form-control" name="data[masp]" id="masp" placeholder="Mã sản phẩm" value="<?=(!empty($item['masp'])) ? $item['masp']:''?>">
			                    </div>
			                <?php } ?>
							<?php if(!empty($config['news'][$type]['gia']) && $config['news'][$type]['gia']==true) { ?>
						    	<div class="form-group col-md-6">
			                        <label class="d-block form-label" for="gia">Giá bán:</label>
			                        <div class="input-group">
			                        	<input type="text" class="form-control format-price gia_ban" name="data[gia]" id="gia" placeholder="Giá bán" value="<?=(!empty($item['gia'])) ? $item['gia']:''?>">
			                        	<div class="input-group-append">
			                        		<div class="input-group-text"><strong>VNĐ</strong></div>
			                        	</div>
			                        </div>
			                    </div>
						    <?php } ?>
						    <?php if(!empty($config['news'][$type]['giamoi']) && $config['news'][$type]['giamoi']==true) { ?>
						    	<div class="form-group col-md-6">
			                        <label class="d-block form-label" for="giamoi">Giá mới:</label>
			                        <div class="input-group">
			                        	<input type="text" class="form-control format-price gia_moi" name="data[giamoi]" id="giamoi" placeholder="Giá mới" value="<?=(!empty($item['giamoi'])) ? $item['giamoi']:''?>">
			                        	<div class="input-group-append">
			                        		<div class="input-group-text"><strong>VNĐ</strong></div>
			                        	</div>
			                        </div>
			                    </div>
						    <?php } ?>
						    <?php if(!empty($config['news'][$type]['giakm']) && $config['news'][$type]['giakm']==true) { ?>
						    	<div class="form-group col-md-6">
			                        <label class="d-block form-label" for="giakm">Chiết khấu:</label>
			                        <div class="input-group">
			                        	<input type="text" class="form-control gia_km" name="data[giakm]" id="giakm" placeholder="Chiết khấu" value="<?=(!empty($item['giakm'])) ? $item['giakm']:''?>" maxlength="3" readonly>
			                        	<div class="input-group-append">
			                        		<div class="input-group-text"><strong>%</strong></div>
			                        	</div>
			                        </div>
			                    </div>
						    <?php } ?>
						    <?php if(!empty($config['news'][$type]['link']) && $config['news'][$type]['link']==true) { ?>
			                    <div class="form-group col-md-6">
			                        <label for="link" class="form-label">Link:</label>
			                        <input type="text" class="form-control" name="data[link]" id="link" placeholder="Link" value="<?=(!empty($item['link'])) ? $item['link']:''?>">
			                    </div>
			                <?php } ?>
			                <?php if(!empty($config['news'][$type]['video']) && $config['news'][$type]['video']==true) { ?>
			                    <div class="form-group col-md-6">
			                        <label for="link_video" class="form-label">Video:</label>
			                        <input type="text" class="form-control" name="data[link_video]" id="link_video" placeholder="Video" value="<?=(!empty($item['link_video'])) ? $item['link_video']:''?>">
			                    </div>
			                <?php } ?>
						    <?php if(!empty($config['news'][$type]['tinhtrang']) && $config['news'][$type]['tinhtrang']==true) { ?>
							    <div class="form-group col-md-6">
			                        <label for="tinhtrang" class="form-label">Tình trạng:</label>
			                        <select class="form-control select2-basic-single js-states form-control select-category" id="select-tinhtrang" name="data[tinhtrang]" id="tinhtrang">
										<option value="0">Chọn tình trạng</option>
										<option <?=((!empty($item['tinhtrang'])) && $item['tinhtrang']==1)?"selected":""?> value="1">Còn hàng</option>
										<option <?=((!empty($item['tinhtrang'])) && $item['tinhtrang']==2)?"selected":""?> value="2">Hết hàng</option>
									</select>
			                    </div>
							<?php } ?>
						</div>
						<div class="row align-items-center">
							<div class="form-group col-md-6">
			                    <label for="hienthi" class="d-inline-block align-middle mb-0 form-label mr-2">Hiển thị:</label>
			                    <div class="custom-control custom-checkbox d-inline-block align-middle form-switch">
			                        <input type="checkbox" class="custom-control-input form-check-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked':''?>>
			                        <label for="hienthi-checkbox" class="custom-control-label"></label>
			                    </div>
			                </div>
			                <div class="form-group col-md-6">
			                    <label for="stt" class="d-inline-block align-middle mb-0 mr-2 form-label">Số thứ tự:</label>
			                    <input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?=isset($item['stt'])?$item['stt']:1?>">
			                </div>
						</div>
					</div>
				</div>
                <?php if(isset($config['news'][$type]['icon']) && $config['news'][$type]['icon']==true) { ?>
                    <?php
                        $photoDetail = (!empty($item['photo'])) ? UPLOAD_NEWS.$item['icon']:'';
                        $dimension = "Width: ".$config['news'][$type]['width_icon']." px - Height: ".$config['news'][$type]['height_icon']." px (".$config['news'][$type]['img_type'].")";
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Icon <?=$config['news'][$type]['title_main']?></h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="change-photo" for="file-zone">
                                    <p> <b class="text-gray-800">Upload hình ảnh:</b> <span class="text-danger mt-2 mb-2 text-sm"><?=$dimension?></span></p>
                                    <div class="rounded photoUpload-preview flex items-center justify-left " id="photoUpload-preview-icon">
                                        <img class="rounded img-upload max-w-2xl" src="<?=UPLOAD_NEWS.$item['icon']?>" onerror="src='assets/images/noimage.png'" alt="Alt Photo"/>
                                    </div>
                                </label>
                                <div class="custom-file my-custom-file mt-3">
                                    <label for="file-zone-icon" class="photo-zone block" id="photo-zone-icon">
                                        <input type="file" class="form-control file-zone"  name="file-icon" id="file-zone-icon">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }?>
                <?php if(isset($config['news'][$type]['images']) && $config['news'][$type]['images']==true) { ?>
                    <?php
                        $photoDetail = (!empty($item['photo'])) ? UPLOAD_NEWS.$item['photo']:'';
                        $dimension = "Width: ".$config['news'][$type]['width']." px - Height: ".$config['news'][$type]['height']." px (".$config['news'][$type]['img_type'].")";
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Hình đại diện <?=$config['news'][$type]['title_main']?></h5>
                        </div>
                        <div class="card-body">
                            <?php include TEMPLATE.LAYOUT."image.php"; ?>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
        <?php if(!empty($flagGallery)) { ?>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Hình ảnh đính kèm <span class="text-danger mt-2 mb-2 text-sm">(<?=(!empty($config['product'][$type]['gallery_list'][$key]['img_type_photo'])) ? $config['product'][$type]['gallery_list'][$key]['img_type_photo']:''?>)</span></h5>
            </div>
            <div class="card-body">
                <div class="form-group last:mb-0">
                    <input type="file" name="files[]" id="filer-gallery" multiple="multiple">
                    <input type="hidden" class="col-filer" value="col-xl-6 col-sm-12 col-12">
                    <input type="hidden" class="act-filer" value="man_list">
                </div>
                <?php if(!empty($gallery) && count($gallery) > 0) { ?>
                    <div class="form-group last:mb-0 form-group-gallery jFiler-items mt-5">
						<label class="form-label font-medium mb-0 text-black text-base capitalize">
							<h5 class="mb-0">Hình ảnh hiện tại:</h5>
						</label>
						<ul class="jFiler-items-list jFiler-items-default" id="jFilerSortable">
							<?php foreach($gallery as $v) $func->galleryFiler($v['stt'],$v['id'],$v['photo'],$v['tenvi'],'product','col-xl-2 col-sm-4 col-6'); ?>
						</ul>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php }?>
        <?php if(isset($config['news'][$type]['seo']) && $config['news'][$type]['seo']==true) { ?>
            <?php $seoDB = $seo->getSeoDB($id,$com,'man',$type); include TEMPLATE.LAYOUT."seo.php";?>
        <?php }?>
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