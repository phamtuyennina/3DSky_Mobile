<?php
	$product_type = $config['product'][$type];

	function get_main_list()
    {
        global $d, $type;

        $row = $d->rawQuery("select tenvi, id from #_product_list where type = ? order by stt,id desc",array($type));

        $str = '<select id="id_list" name="data[id_list]" data-level="0" data-type="'.$type.'" data-table="#_product_cat" data-child="id_cat" class="form-control select2 select-category"><option value="0">Chọn danh mục</option>';
        foreach($row as $v)
        {
        	$id_list = isset($_REQUEST['id_list']) ? $_REQUEST['id_list']:'';
            if($v["id"] == (int)$id_list) $selected = "selected";
            else $selected = "";

            $str .= '<option value='.$v["id"].' '.$selected.'>'.$v["tenvi"].'</option>';
        }
        $str .= '</select>';

        return $str;
    }

	function get_main_cat()
	{
		global $d, $type;

        $id_list = isset($_REQUEST['id_list']) ? $_REQUEST['id_list']:'';
        $row = $d->rawQuery("select tenvi, id from #_product_cat where id_list = ? and type = ? order by stt,id desc",array($id_list,$type));

		$str = '<select id="id_cat" name="data[id_cat]" data-level="1" data-type="'.$type.'" data-table="#_product_item" data-child="id_item" class="form-control select2 select-category"><option value="0">Chọn danh mục</option>';
		foreach($row as $v)
        {
        	$id_cat = isset($_REQUEST['id_cat']) ? $_REQUEST['id_cat']:'';
            if($v["id"] == (int)$id_cat) $selected = "selected";
            else $selected = "";

            $str .= '<option value='.$v["id"].' '.$selected.'>'.$v["tenvi"].'</option>';
        }
        $str .= '</select>';

		return $str;
	}

	function get_main_item()
	{
		global $d, $type;

        $id_list = isset($_REQUEST['id_list']) ? $_REQUEST['id_list']:'';
        $id_cat = isset($_REQUEST['id_cat']) ? $_REQUEST['id_cat']:'';
        $row = $d->rawQuery("select tenvi, id from #_product_item where id_list = ? and id_cat = ? and type = ? order by stt,id desc",array($id_list,$id_cat,$type));

		$str = '<select id="id_item" name="data[id_item]" data-level="2" data-type="'.$type.'" data-table="#_product_sub" data-child="id_sub" class="form-control select2 select-category"><option value="0">Chọn danh mục</option>';
		foreach($row as $v)
        {
        	$id_item = isset($_REQUEST['id_item']) ? $_REQUEST['id_item']:'';
            if($v["id"] == (int)$id_item) $selected = "selected";
            else $selected = "";

            $str .= '<option value='.$v["id"].' '.$selected.'>'.$v["tenvi"].'</option>';
        }
        $str .= '</select>';

		return $str;
	}
    
	function get_main_sub()
	{
		global $d, $type;

        $id_list = isset($_REQUEST['id_list']) ? $_REQUEST['id_list']:'';
        $id_cat = isset($_REQUEST['id_cat']) ? $_REQUEST['id_cat']:'';
        $id_item = isset($_REQUEST['id_item']) ? $_REQUEST['id_item']:'';
        $row = $d->rawQuery("select tenvi, id from #_product_sub where id_list = ? and id_cat = ? and id_item = ? and type = ? order by stt,id desc",array($id_list,$id_cat,$id_item,$type));

		$str = '<select id="id_sub" name="data[id_sub]" class="form-control select2 select-category"><option value="0">Chọn danh mục</option>';
		foreach($row as $v)
        {
        	$id_sub = isset($_REQUEST['id_sub']) ? $_REQUEST['id_sub']:'';
            if($v["id"] == (int)$id_sub) $selected = "selected";
            else $selected = "";

            $str .= '<option value='.$v["id"].' '.$selected.'>'.$v["tenvi"].'</option>';
        }
        $str .= '</select>';

		return $str;
	}

	function get_main_brand()
    {
        global $d, $type;

        $row = $d->rawQuery("select tenvi, id from #_product_brand where type = ? order by stt,id desc",array($type));

        $str = '<select id="id_brand" name="data[id_brand]" class="form-control select2"><option value="0">Danh mục hãng</option>';
        foreach($row as $v)
        {
        	$id_brand = isset($_REQUEST['id_brand']) ? $_REQUEST['id_brand']:'';
            if($v["id"] == (int)$id_brand) $selected = "selected";
            else $selected = "";

            $str .= '<option value='.$v["id"].' '.$selected.'>'.$v["tenvi"].'</option>';
        }
        $str .= '</select>';

        return $str;
    }

	function get_tags($id="")
	{
		global $d, $type;

		if(!empty($id))
		{
			$temps = $d->rawQueryOne("select id_tags from #_product where id = ? and type = ?",array($id,$type));
			$arr_tags = explode(',', $temps['id_tags']);
			
			for($i=0;$i<count($arr_tags);$i++) $temp[$i]=$arr_tags[$i];
		}

		$row_tags = $d->rawQuery("select tenvi, id from #_tags where type = ? order by stt,id desc",array($type));

		$str = '<select id="tags_group" name="tags_group[]" class="select multiselect" multiple="multiple" >';
		for($i=0;$i<count($row_tags);$i++)
		{
			if(!empty($temp))
			{	
				if(in_array($row_tags[$i]['id'],$temp)) $selected = 'selected="selected"';
				else $selected = '';
			}
			$str .= '<option value="'.$row_tags[$i]["id"].'" '.$selected.' /> '.$row_tags[$i]["tenvi"].'</option>';
		}
		$str .= '</select>';

		return $str;
	}

	function get_mau($id="")
	{
		global $d, $type;

		if(!empty($id))
		{
			$temps = $d->rawQueryOne("select id_mau from #_product where id = ? and type = ?",array($id,$type));
			$arr_mau = explode(',', $temps['id_mau']);
			
			for($i=0;$i<count($arr_mau);$i++) $temp[$i]=$arr_mau[$i];
		}

		$row_mau = $d->rawQuery("select tenvi, id from #_product_mau where type = ? order by stt,id desc",array($type));

		$str = '<select id="mau_group" name="mau_group[]" class="select multiselect" multiple="multiple" >';
		for($i=0;$i<count($row_mau);$i++)
		{
			if(!empty($temp))
			{	
				if(in_array($row_mau[$i]['id'],$temp)) $selected = 'selected="selected"';
				else $selected = '';
			}
			$str .= '<option value="'.$row_mau[$i]["id"].'" '.(!empty($selected) ? $selected:'').' /> '.$row_mau[$i]["tenvi"].'</option>';
		}
		$str .= '</select>';

		return $str;
	}

	function get_size($id="")
	{
		global $d, $type;

		if(!empty($id))
		{
			$temps = $d->rawQueryOne("select id_size from #_product where id = ? and type = ?",array($id,$type));
			$arr_size = explode(',', $temps['id_size']);
			
			for($i=0;$i<count($arr_size);$i++) $temp[$i]=$arr_size[$i];
		}

		$row_size = $d->rawQuery("select tenvi, id from #_product_size where type = ? order by stt,id desc",array($type));

		$str = '<select id="size_group" name="size_group[]" class="select multiselect" multiple="multiple" >';
		for($i=0;$i<count($row_size);$i++)
		{
			if(!empty($temp))
			{	
				if(in_array($row_size[$i]['id'],$temp)) $selected = 'selected="selected"';
				else $selected = '';
			}
			$str .= '<option value="'.$row_size[$i]["id"].'" '.(!empty($selected) ? $selected:'').' /> '.$row_size[$i]["tenvi"].'</option>';
		}
		$str .= '</select>';
		
		return $str;
	}

	if($act=="add") $labelAct = "Thêm mới";
	else if($act=="edit") $labelAct = "Chỉnh sửa";
	else if($act=="copy")  $labelAct = "Sao chép";

	$linkMan = "index.php?com=product&act=man&type=".$type."&p=".$curPage;
	if($act=='add') $linkFilter = "index.php?com=product&act=add&type=".$type."&p=".$curPage;
	else if($act=='edit') $linkFilter = "index.php?com=product&act=edit&type=".$type."&p=".$curPage."&id=".$id;
    if($act=="copy") $linkSave = "index.php?com=product&act=save_copy&type=".$type."&p=".$curPage;
    else $linkSave = "index.php?com=product&act=save&type=".$type."&p=".$curPage;

    /* Check cols */
    if(!empty($product_type['gallery'])){
    	foreach($product_type['gallery'] as $key => $value){
	        if($key==$type)
	        {
	            $flagGallery=true;
	            break;
	        }
	    }
    }
    
    if((isset($product_type['dropdown']) && $product_type['dropdown']==true) || (isset($product_type['brand']) && $product_type['brand']==true) || (isset($product_type['mau']) && $product_type['mau']==true) || (isset($product_type['size']) && $product_type['size']==true) || (isset($product_type['tags']) && $product_type['tags']==true) || (isset($product_type['images']) && $product_type['images']==true) || (isset($flagGallery) && $flagGallery=true)){
    	$colLeft = "col-xl-8";
    	$colRight = "col-xl-4";
    }else{
    	$colLeft = "col-12";
    	$colRight = "d-none";	
    }
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active"><?=$labelAct?> <?=$product_type['title_main']?></li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form class="validation-form" novalidate method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="submit" class="btn btn-sm bg-gradient-success submit-check" name="save-here"><i class="far fa-save mr-2"></i>Lưu tại trang</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
        <div class="row">
        	<div class="<?=$colLeft?>">
	            <?php
                	if($product_type['slug'])
	                {
	                	$slugchange = ($act=='edit') ? 1 : 0;
	                	$copy = ($act!='copy') ? 0 : 1;
						include TEMPLATE.LAYOUT."slug.php";
				    }
			    ?>
	        	<div class="card card-primary card-outline text-sm">
		            <div class="card-header">
		                <h3 class="card-title">Nội dung <?=$product_type['title_main']?></h3>
		                <div class="card-tools">
		                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
		                </div>
		            </div>
		            <div class="card-body">
		                <div class="card card-primary card-outline card-outline-tabs">
		                    <div class="card-header p-0 border-bottom-0">
		                        <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang-one" role="tablist">
		                            <?php foreach($config['website']['lang'] as $k => $v) { ?>
		                                <li class="nav-item">
		                                    <a class="nav-link <?=($k=='vi')?'active':''?>" id="tabs-lang" data-toggle="pill" href="#tabs-lang-<?=$k?>" role="tab" aria-controls="tabs-lang-<?=$k?>" aria-selected="true"><?=$v?></a>
		                                </li>
		                            <?php } ?>
		                        </ul>
		                    </div>
		                    <div class="card-body card-article">
		                        <div class="tab-content" id="custom-tabs-three-tabContent-lang-one">
		                            <?php foreach($config['website']['lang'] as $k => $v) { ?>
		                                <div class="tab-pane fade show <?=($k=='vi')?'active':''?>" id="tabs-lang-<?=$k?>" role="tabpanel" aria-labelledby="tabs-lang">
		                                    <div class="form-group">
		                                        <label for="ten<?=$k?>">Tiêu đề (<?=$k?>):</label>
		                                        <input type="text" class="form-control for-seo" name="data[ten<?=$k?>]" id="ten<?=$k?>" placeholder="Tiêu đề (<?=$k?>)" value="<?=(!empty($item['ten'.$k])) ? $item['ten'.$k]:''?>" <?=($k=='vi')?'required':''?>>
		                                    </div>
		                                    <?php if(!empty($product_type['mota']) && $product_type['mota']) { ?>
		                                        <div class="form-group">
		                                            <label for="mota<?=$k?>">Mô tả (<?=$k?>):</label>
		                                            <textarea class="form-control for-seo <?=($product_type['mota_cke'])?'form-control-ckeditor':''?>" name="data[mota<?=$k?>]" id="mota<?=$k?>" rows="5" placeholder="Mô tả (<?=$k?>)"><?=(!empty($item['mota'.$k])) ? htmlspecialchars_decode($item['mota'.$k]):''?></textarea>
		                                        </div>
		                                    <?php } ?>
		                                    <?php if(!empty($product_type['noidung']) && $product_type['noidung']) { ?>
		                                        <div class="form-group">
		                                            <label for="noidung<?=$k?>">Nội dung (<?=$k?>):</label>
		                                            <textarea class="form-control for-seo <?=($product_type['noidung_cke'])?'form-control-ckeditor':''?>" name="data[noidung<?=$k?>]" id="noidung<?=$k?>" rows="5" placeholder="Nội dung (<?=$k?>)"><?=(!empty($item['noidung'.$k])) ? htmlspecialchars_decode($item['noidung'.$k]):''?></textarea>
		                                        </div>
		                                    <?php } ?>
		                                </div>
		                            <?php } ?>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
	        </div>
        	<div class="<?=$colRight?>">
        		<?php if((isset($product_type['dropdown']) && $product_type['dropdown']==true) || (isset($product_type['brand']) && $product_type['brand']==true) || (isset($product_type['tags']) && $product_type['tags']==true) || (isset($product_type['mau']) && $product_type['mau']==true) || (isset($product_type['size']) && $product_type['size']==true)) { ?>
			        <div class="card card-primary card-outline text-sm">
			            <div class="card-header">
			                <h3 class="card-title">Danh mục <?=$product_type['title_main']?></h3>
			                <div class="card-tools">
			                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
			                </div>
			            </div>
			            <div class="card-body">
		            		<div class="form-group-category row">
				            	<?php if($product_type['dropdown']) { ?>
				            		<?php if(!empty($product_type['list']) && $product_type['list']) { ?>
						                <div class="form-group col-xl-6 col-sm-4">
						                    <label class="d-block" for="id_list">Danh mục cấp 1:</label>
						                    <?=get_main_list()?>
						                </div>
						            <?php } ?>
						            <?php if(!empty($product_type['cat']) && $product_type['cat']) { ?>
						                <div class="form-group col-xl-6 col-sm-4">
						                    <label class="d-block" for="id_cat">Danh mục cấp 2:</label>
						                    <?=get_main_cat()?>
						                </div>
						            <?php } ?>
					                <?php if(!empty($product_type['item']) && $product_type['item']) { ?>
						                <div class="form-group col-xl-6 col-sm-4">
						                    <label class="d-block" for="id_item">Danh mục cấp 3:</label>
						                    <?=get_main_item()?>
						                </div>
						            <?php } ?>
					                <?php if(!empty($product_type['sub']) && $product_type['sub']) { ?>
						                <div class="form-group col-xl-6 col-sm-4">
						                    <label class="d-block" for="id_sub">Danh mục cấp 4:</label>
						                    <?=get_main_sub()?>
						                </div>
						            <?php } ?>
					            <?php } ?>
					            <?php if(!empty($product_type['brand']) && $product_type['brand']) { ?>
							    	<div class="form-group col-xl-6 col-sm-4">
					                    <label class="d-block" for="id_brand">Danh mục hãng:</label>
					                    <?=get_main_brand()?>
					                </div>
							    <?php } ?>
							    <?php if(!empty($product_type['tags']) && $product_type['tags']) { ?>
							    	<div class="form-group col-xl-6 col-sm-4">
					                    <label class="d-block" for="id_tags">Danh mục tags:</label>
					                    <?=get_tags($item['id'])?>
					                </div>
							    <?php } ?>
							    <?php if(!empty($product_type['mau']) && $product_type['mau']) { ?>
							    	<div class="form-group col-xl-6 col-sm-4">
					                    <label class="d-block" for="id_mau">Danh mục màu sắc:</label>
					                    <?=(!empty($item)) ? get_mau($item['id']):get_mau(0)?>
					                </div>
							    <?php } ?>
							    <?php if(!empty($product_type['size']) && $product_type['size']) { ?>
							    	<div class="form-group col-xl-6 col-sm-4">
					                    <label class="d-block" for="id_size">Danh mục kích thước:</label>
					                    <?=(!empty($item)) ? get_size($item['id']):get_size(0)?>
					                </div>
							    <?php } ?>
							</div>
			            </div>
			        </div>
			    <?php } ?>
				<div class="card card-primary card-outline text-sm">
		            <div class="card-header">
		                <h3 class="card-title">Thông tin <?=$product_type['title_main']?></h3>
		                <div class="card-tools">
		                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
		                </div>
		            </div>
		            <div class="card-body">
						
		            	<?php if(!empty($product_type['file']) && $product_type['file']) { ?>
		                    <div class="form-group">
		                        <label class="change-file mb-1 mr-2" for="file-taptin">
		                        	<p>Upload tập tin:</p>
		                        	<strong class="ml-2">
		                    			<span class="btn btn-sm bg-gradient-success"><i class="fas fa-file-upload mr-2"></i>Chọn tập tin</span>
		                    			<div><b class="text-sm text-split"></b></div>
		                    		</strong>
		                        </label>
		                        <strong class="d-block mt-2 mb-2 text-sm"><?php echo $product_type['file_type']; ?></strong>
		                        <div class="custom-file my-custom-file d-none">
		                            <input type="file" class="custom-file-input" name="file-taptin" id="file-taptin">
		                            <label class="custom-file-label" for="file-taptin">Chọn file</label>
		                        </div>
		                        <?php if(!empty($item['taptin'])) { ?>
		                            <a class="btn btn-sm bg-gradient-primary text-white d-inline-block align-middle p-2 rounded mb-1" href="<?=UPLOAD_FILE.$item['taptin']?>" title="Download tập tin hiện tại"><i class="fas fa-download mr-2"></i>Download tập tin hiện tại</a>
		                        <?php } ?>
		                    </div>
		                <?php } ?>
		                <div class="row">
			                <?php if(!empty($product_type['ma']) && $product_type['ma']) { ?>
			                    <div class="form-group col-md-6">
			                        <label class="d-block" for="masp">Mã sản phẩm:</label>
			                        <input type="text" class="form-control" name="data[masp]" id="masp" placeholder="Mã sản phẩm" value="<?=(!empty($item['masp'])) ? $item['masp']:''?>">
			                    </div>
			                <?php } ?>
							<?php if(!empty($product_type['gia']) && $product_type['gia']==true) { ?>
						    	<div class="form-group col-md-6">
			                        <label class="d-block" for="gia">Giá bán:</label>
			                        <div class="input-group">
			                        	<input type="text" class="form-control format-price gia_ban" name="data[gia]" id="gia" placeholder="Giá bán" value="<?=(!empty($item['gia'])) ? $item['gia']:''?>">
			                        	<div class="input-group-append">
			                        		<div class="input-group-text"><strong>VNĐ</strong></div>
			                        	</div>
			                        </div>
			                    </div>
						    <?php } ?>
						    <?php if(!empty($product_type['giamoi']) && $product_type['giamoi']==true) { ?>
						    	<div class="form-group col-md-6">
			                        <label class="d-block" for="giamoi">Giá mới:</label>
			                        <div class="input-group">
			                        	<input type="text" class="form-control format-price gia_moi" name="data[giamoi]" id="giamoi" placeholder="Giá mới" value="<?=(!empty($item['giamoi'])) ? $item['giamoi']:''?>">
			                        	<div class="input-group-append">
			                        		<div class="input-group-text"><strong>VNĐ</strong></div>
			                        	</div>
			                        </div>
			                    </div>
						    <?php } ?>
						    <?php if(!empty($product_type['giakm']) && $product_type['giakm']==true) { ?>
						    	<div class="form-group col-md-6">
			                        <label class="d-block" for="giakm">Chiết khấu:</label>
			                        <div class="input-group">
			                        	<input type="text" class="form-control gia_km" name="data[giakm]" id="giakm" placeholder="Chiết khấu" value="<?=(!empty($item['giakm'])) ? $item['giakm']:''?>" maxlength="3" readonly>
			                        	<div class="input-group-append">
			                        		<div class="input-group-text"><strong>%</strong></div>
			                        	</div>
			                        </div>
			                    </div>
						    <?php } ?>
						    <?php if(!empty($product_type['link']) && $product_type['link']==true) { ?>
			                    <div class="form-group col-md-6">
			                        <label for="link">Link:</label>
			                        <input type="text" class="form-control" name="data[link]" id="link" placeholder="Link" value="<?=(!empty($item['link'])) ? $item['link']:''?>">
			                    </div>
			                <?php } ?>
			                <?php if(!empty($product_type['video']) && $product_type['video']==true) { ?>
			                    <div class="form-group col-md-6">
			                        <label for="link_video">Video:</label>
			                        <input type="text" class="form-control" name="data[link_video]" id="link_video" placeholder="Video" value="<?=(!empty($item['link_video'])) ? $item['link_video']:''?>">
			                    </div>
			                <?php } ?>
						    <?php if(!empty($product_type['tintrang']) && $product_type['tintrang']==true) { ?>
							    <div class="form-group col-md-6">
			                        <label for="tinhtrang">Tình trạng:</label>
			                        <select class="form-control" name="data[tinhtrang]" id="tinhtrang">
										<option value="0">Chọn tình trạng</option>
										<option <?=((!empty($item['tintrang'])) && $item['tinhtrang']==1)?"selected":""?> value="1">Còn hàng</option>
										<option <?=((!empty($item['tintrang'])) && $item['tinhtrang']==2)?"selected":""?> value="2">Hết hàng</option>
									</select>
			                    </div>
							<?php } ?>
						</div>
						<div class="row align-items-center">
							<div class="form-group col-md-6">
			                    <label for="hienthi" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
			                    <div class="custom-control custom-checkbox d-inline-block align-middle">
			                        <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked':''?>>
			                        <label for="hienthi-checkbox" class="custom-control-label"></label>
			                    </div>
			                </div>
			                <div class="form-group col-md-6">
			                    <label for="stt" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
			                    <input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?=isset($item['stt'])?$item['stt']:1?>">
			                </div>
						</div>
		            </div>
		        </div>
				<?php if(!empty($product_type['images']) && $product_type['images']==true) { ?>
			        <div class="card card-primary card-outline text-sm">
			            <div class="card-header">
			                <h3 class="card-title">Hình ảnh <?=$product_type['title_main']?></h3>
			                <div class="card-tools">
			                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
			                </div>
			            </div>
			            <div class="card-body">
	                    	<?php
	                    		$photoDetail = (!empty($item['photo'])) ? UPLOAD_PRODUCT.$item['photo']:'';
	                    		$dimension = "Width: ".$product_type['width']." px - Height: ".$product_type['height']." px (".$product_type['img_type'].")";
	                    		include TEMPLATE.LAYOUT."image.php";
	                    	?>
			            </div>
			        </div>
		        <?php } ?>

	            
	        </div>
	    </div>

	    <?php if(!empty($flagGallery) && $flagGallery==true) { ?>
	        <div class="card card-primary card-outline text-sm">
	            <div class="card-header">
	                <h3 class="card-title">Bộ sưu tập <?=$product_type['title_main']?></h3>
	                <div class="card-tools">
	                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
	                </div>
	            </div>
	            <div class="card-body">
	                <div class="form-group">
	                    <label for="filer-gallery" class="label-filer-gallery mb-3">Album hình: (<?=$product_type['gallery'][$key]['img_type_photo']?>)</label>
	                    <input type="file" name="files[]" id="filer-gallery" multiple="multiple">
	                    <input type="hidden" class="col-filer" value="col-xl-2 col-sm-4 col-6">
	                    <input type="hidden" class="act-filer" value="man">
	                </div>
	                <?php if(!empty($gallery) && count($gallery) > 0) { ?>
	                    <div class="form-group form-group-gallery">
	                    	<label class="label-filer">Album hiện tại:</label>
	                    	<div class="action-filer mb-3">
			                    <a class="btn btn-sm bg-gradient-primary text-white check-all-filer mr-1"><i class="far fa-square mr-2"></i>Chọn tất cả</a>
			                    <button type="button" class="btn btn-sm bg-gradient-success text-white sort-filer mr-1"><i class="fas fa-random mr-2"></i>Sắp xếp</button>
			                	<a class="btn btn-sm bg-gradient-danger text-white delete-all-filer" data-folder="product"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
			                </div>
			                <div class="alert my-alert alert-sort-filer alert-info text-sm text-white bg-gradient-info"><i class="fas fa-info-circle mr-2"></i>Có thể chọn nhiều hình để di chuyển</div>
	                        <div class="jFiler-items my-jFiler-items jFiler-row">
	                            <ul class="jFiler-items-list jFiler-items-grid row scroll-bar" id="jFilerSortable">
	                                <?php foreach($gallery as $v) $func->galleryFiler($v['stt'],$v['id'],$v['photo'],$v['tenvi'],'product','col-xl-2 col-sm-4 col-6'); ?>
	                            </ul>
	                        </div>
	                    </div>
	                <?php } ?>
	        	</div>
	        </div>
	    <?php } ?>

	    
        <?php if(!empty($product_type['seo']) && $product_type['seo']==true) { ?>
			<div class="card card-primary card-outline text-sm">
	            <div class="card-header">
	                <h3 class="card-title">Nội dung SEO</h3>
	                <a class="btn btn-sm bg-gradient-success d-inline-block text-white float-right create-seo" title="Tạo SEO">Tạo SEO</a>
	            </div>
	            <div class="card-body">
                    <?php
                    	$seoDB = $seo->getSeoDB($id,$com,'man',$type);
                    	include TEMPLATE.LAYOUT."seo.php";
                    ?>
	            </div>
	        </div>
	    <?php } ?>
	    <?php if(isset($config['product'][$type]['schema']) && $config['product'][$type]['schema'] == true) { ?>
			<div class="card card-primary card-outline text-sm">
	            <div class="card-header">
	                <h3 class="card-title">Schema JSON Product</h3>
           			<button type="submit" class="btn btn-sm bg-gradient-success float-right submit-check" name="build-schema"><i class="far fa-save mr-2"></i>Lưu và tạo tự động Schema</button>
	            </div>
	            <div class="card-body">
                    <?php
                    	$seoDB = $seo->getSeoDB($id,$com,'man',$type);
                    	include TEMPLATE.LAYOUT."schema.php";
                    ?>
        			<input type="hidden" id="schema-type" value="product">
	            </div>
	        </div>
	    <?php } ?>
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="submit" class="btn btn-sm bg-gradient-success submit-check" name="save-here"><i class="far fa-save mr-2"></i>Lưu tại trang</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?=@$item['id']?>">
        </div>
    </form>
</section>

<?php if(!empty($product_type['giakm']) && $product_type['giakm']) { ?>
	<script type="text/javascript">
		function roundNumber(rnum, rlength)
		{
			return Math.round(rnum*Math.pow(10,rlength))/Math.pow(10,rlength);
		}
		$(document).ready(function(){

			$(".gia_ban, .gia_moi").keyup(function(){
				var gia_ban = $('.gia_ban').val();
				var gia_moi = $('.gia_moi').val();
				var gia_km = 0;

				if(gia_ban=='' || gia_ban=='0' || gia_moi=='' || gia_moi=='0')
				{
					gia_km=0;
				}
				else
				{
					gia_ban = gia_ban.replace(/,/g,"");
					gia_moi = gia_moi.replace(/,/g,"");
					gia_ban = parseInt(gia_ban);
					gia_moi = parseInt(gia_moi);

					if(gia_moi < gia_ban)
					{
						gia_km = 100-((gia_moi * 100) / gia_ban);
						gia_km = roundNumber(gia_km,0);
					}
					else
					{
						gia_km=0;
					}
				}
				$('.gia_km').val(gia_km);
			})
		})
	</script>
<?php } ?>