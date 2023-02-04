<?php
	function get_main_city()
	{
		global $d;

        $row = $d->rawQuery("select ten, id from #_city order by id asc");

		$str = '<select id="city" name="data[id_city]" data-level="0" data-table="#_district" data-child="district" class="form-control select2-basic-single js-states form-control select-place" id="select-list"><option value="0">Chọn danh mục</option>';
		foreach($row as $v)
        {
            $id_city = isset($_REQUEST['id_city']) ? $_REQUEST['id_city']:'';
            if($v["id"] == (int)$id_city) $selected = "selected";
            else $selected = "";

            $str .= '<option value='.$v["id"].' '.$selected.'>'.$v["ten"].'</option>';
        }
        $str .= '</select>';

        return $str;
	}
    
	function get_main_district()
	{
		global $d;

		$id_city = isset($_REQUEST['id_city']) ? $_REQUEST['id_city']:'';
        $row = $d->rawQuery("select ten, id from #_district where id_city = ? order by id asc",array($id_city));

		$str = '<select id="district" name="data[id_district]" class="form-control form-control select2-basic-single js-states form-control" id="select-cat"><option value="0">Chọn danh mục</option>';
		foreach($row as $v)
        {
            $id_district = isset($_REQUEST['id_district']) ? $_REQUEST['id_district']:'';
            if($v["id"] == (int)$id_district) $selected = "selected";
            else $selected = "";
            
            $str .= '<option value='.$v["id"].' '.$selected.'>'.$v["ten"].'</option>';
        }
        $str .= '</select>';

        return $str;
	}

	$linkMan = "index.php?com=places&act=man_wards&p=".$curPage;
	if($act=='add_wards') $linkFilter = "index.php?com=places&act=add_wards&p=".$curPage;
	else if($act=='edit_wards') $linkFilter = "index.php?com=places&act=edit_wards&id=".$id."&p=".$curPage;
    $linkSave = "index.php?com=places&act=save_wards&p=".$curPage;
?>

<div class="content-inner container-fluid pb-0" id="page_layout">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <h5 class="mb-0 text-capitalize">Chi tiết phường xã</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form class="validation-form" novalidate method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
                        <div class="form-group-category">
                            <div class="form-group">
                                <label class="form-label" for="id_city">Danh sách tỉnh thành:</label>
                                <?=get_main_city()?>
                            </div>
                        </div>
                        <div class="form-group-category">
                            <div class="form-group">
                                <label class="form-label" for="id_city">Danh sách quận huyện:</label>
                                <?=get_main_district()?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="ten">Tiêu đề: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="data[ten]" id="ten" placeholder="Tiêu đề" value="<?=@$item['ten']?>" required>
                        </div>
                        <?php if($config['places']['placesship']) { ?>
                            <div class="form-group">
                                <label for="ten" class="form-label">Phí vận chuyển:</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="gia">VNĐ</span>
                                    <input type="text" class="form-control format-price" value="<?=$item['gia']?>" name="data[gia]" id="gia" required placeholder="Phí vận chuyển">
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <div class="form-check ps-0 cursor-pointer form-switch">
                                <label class="form-label form-check-label font-medium cursor-pointer" for="hienthi-checkbox">Hiển thị:</label>
                                <input class="form-check-input l-0 ms-1 !float-none" name="data[hienthi]" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked':''?> type="checkbox" id="hienthi-checkbox" >
                           </div>
                        </div>
                        <div class="form-group">
                            <label for="stt" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
                            <input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?=isset($item['stt'])?$item['stt']:1?>">
                        </div>
                        <div class="row pe-4 pt-4 d-flex align-items-center justify-content-center justify-content-md-between">
                            <?php include TEMPLATE.LAYOUT."saveelement.php"; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
