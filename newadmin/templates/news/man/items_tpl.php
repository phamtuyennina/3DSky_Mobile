<?php 
	function get_main_list()
    {
        global $d, $type;

        $row = $d->rawQuery("select tenvi, id from #_news_list where type = ? order by stt,id desc",array($type));

        $str = '<select id="id_list" name="id_list" onchange="onchangeList()" class="select2-basic-single js-states form-control" id="select-list"><option value="0">Chọn danh mục cấp 1</option>';
        foreach($row as $v)
        {
            $id_list = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']):'';
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

        $id_list = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']):'';
        $row = $d->rawQuery("select tenvi, id from #_news_cat where id_list = ? and type = ? order by stt,id desc",array($id_list,$type));

		$str = '<select id="id_cat" name="id_cat" onchange="onchangeCat()" class="select2-basic-single js-states form-control" id="select-cat"><option value="0">Chọn danh mục cấp 2</option>';
		foreach($row as $v)
		{
			$id_cat = (isset($_REQUEST['id_cat'])) ? htmlspecialchars($_REQUEST['id_cat']):'';
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

        $id_list = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']):'';
        $id_cat = (isset($_REQUEST['id_cat'])) ? htmlspecialchars($_REQUEST['id_cat']):'';
        $row = $d->rawQuery("select tenvi, id from #_news_item where id_list = ? and id_cat = ? and type = ? order by stt,id desc",array($id_list,$id_cat,$type));

		$str = '<select id="id_item" name="id_item" onchange="onchangeItem()" class="select2-basic-single js-states form-control" id="select-item"><option value="0">Chọn danh mục cấp 3</option>';
		foreach($row as $v)
		{
			$id_item = (isset($_REQUEST['id_item'])) ? htmlspecialchars($_REQUEST['id_item']):'';
            if($v["id"] == (int)$id_cat) $selected = "selected";
			else $selected = "";

			$str .= '<option value='.$v["id"].' '.$selected.'>'.$v["tenvi"].'</option>';
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

		$str = '<select id="id_sub" name="id_sub" onchange="onchangeSub()" class="select2-basic-single js-states form-control" id="select-sub"><option value="0">Chọn danh mục cấp 4</option>';
		foreach($row as $v)
		{
            $id_sub = (isset($_REQUEST['id_sub'])) ? htmlspecialchars($_REQUEST['id_sub']):'';
			if($v["id"] == (int)$id_sub) $selected = "selected";
			else $selected = "";

			$str .= '<option value='.$v["id"].' '.$selected.'>'.$v["tenvi"].'</option>';
		}
		$str .= '</select>';
		
		return $str;
	}

	$linkView = $config_base;
	$linkMan = $linkFilter = "index.php?com=news&act=man&type=".$type."&p=".$curPage;
	$linkAdd = "index.php?com=news&act=add&type=".$type."&p=".$curPage;
    $linkCopy = "index.php?com=news&act=copy&type=".$type."&p=".$curPage;
    $linkEdit = "index.php?com=news&act=edit&type=".$type."&p=".$curPage;
    $linkDelete = "index.php?com=news&act=delete&type=".$type."&p=".$curPage;
    $linkMulti = "index.php?com=news&act=man_photo&kind=man&type=".$type."&p=".$curPage;
    $copyImg = ($config['news'][$type]['copy_image']) ? TRUE : FALSE;
?>

<div class="content-inner container-fluid pb-0" id="page_layout">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <h5 class="mb-0 text-capitalize"><?=$config['news'][$type]['title_main']?></h5>
                        <div class="d-flex header-top-page justify-content-between align-items-center rounded flex-wrap gap-3">
                            <?php include TEMPLATE.LAYOUT."topaction.php"; ?>
                        </div>
                    </div>
                    <?php if($config['news'][$type]['dropdown']==true){?>
                    <div class="d-flex justify-content-end align-items-center flex-wrap gap-3 mt-3">
                        <?php if(isset($config['news'][$type]['list']) && $config['news'][$type]['list']==true) { ?>
                        <div class="form-group mb-0 header-top-page-select w-auto d-block d-sm-inline-block">
                            <div class="input-group form-group-category"><?=get_main_list()?></div>
                        </div>
                        <?php }?>
                        <?php if(isset($config['news'][$type]['list']) && $config['news'][$type]['list']==true) { ?>
                        <div class="form-group mb-0 header-top-page-select w-auto d-block d-sm-inline-block">
                            <div class="input-group form-group-category"><?=get_main_cat()?></div>
                        </div>
                        <?php }?>
                        <?php if(isset($config['news'][$type]['list']) && $config['news'][$type]['list']==true) { ?>
                        <div class="form-group mb-0 header-top-page-select w-auto d-block d-sm-inline-block">
                            <div class="input-group form-group-category"><?=get_main_item()?></div>
                        </div>
                        <?php }?>
                        <?php if(isset($config['news'][$type]['list']) && $config['news'][$type]['list']==true) { ?>
                        <div class="form-group mb-0 header-top-page-select w-auto d-block d-sm-inline-block">
                            <div class="input-group form-group-category"><?=get_main_sub()?></div>
                        </div>
                        <?php }?>
                    </div>
                    <?php }?>
                </div>

                <div class="card-body px-0">
                    <div class="fancy-table table-left-bordered table-responsive rounded mt-3">
                        <table class="table mb-0 w-100" id="datatable">
                            <thead>
                                <tr class="bg-white">
                                    <th scope="col" class="align-middle text-center" width="50px">
                                        <div class="custom-control custom-checkbox my-checkbox">
                                            <input type="checkbox" class="form-check-input" id="selectall-checkbox">
                                        </div>
                                    </th>
                                    <th scope="col" class="align-middle text-center" width="100px">STT</th>
                                    <?php if(!empty($config['news'][$type]['show_images']) && $config['news'][$type]['show_images']==true) { ?>
                                        <th class="align-middle">Hình</th>
                                    <?php } ?>
                                    <th scope="col" style="width:70%;min-width: 200px">Tiêu đề</th>
                                    <?php if(!empty($config['news'][$type]['gallery']) && count($config['news'][$type]['gallery']) > 0) { ?>
                                        <th scope="col">Gallery</th>
                                    <?php } ?>
                                    <?php if(!empty($config['news'][$type]['check_item'])){ foreach($config['news'][$type]['check_item'] as $key => $value) { ?>
                                        <th scope="col" class="align-middle text-center"><?=$value?></th>
                                    <?php } } ?>
                                    <th scope="col" class="align-middle text-center">Hiển thị</th>
                                    <th scope="col" class="align-middle text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <?php if(empty($items)) { ?>
                            <tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
                            <?php } else { ?>
                            <tbody>
                                <?php for($i=0;$i<count($items);$i++) {
                                $linkID = "";
                                if(isset($items[$i]['id_list']) && $items[$i]['id_list']!=0) $linkID .= "&id_list=".$items[$i]['id_list'];
                                if(isset($items[$i]['id_cat']) && $items[$i]['id_cat']!=0) $linkID .= "&id_cat=".$items[$i]['id_cat'];
                                if(isset($items[$i]['id_item']) && $items[$i]['id_item']!=0) $linkID .= "&id_item=".$items[$i]['id_item'];
                                if(isset($items[$i]['id_sub']) && $items[$i]['id_sub']!=0) $linkID .= "&id_sub=".$items[$i]['id_sub']; ?>
                                <tr>
                                    <td class="align-middle">
                                        <div class="custom-control custom-checkbox my-checkbox">
                                            <input type="checkbox" class="form-check-input select-checkbox" id="select-checkbox-<?=$items[$i]['id']?>" value="<?=$items[$i]['id']?>">
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <input type="number" class="form-control form-control-mini m-auto update-stt" min="0" value="<?=$items[$i]['stt']?>" data-id="<?=$items[$i]['id']?>" data-table="news">
                                    </td>
                                    <?php if(isset($config['news'][$type]['show_images']) && $config['news'][$type]['show_images']) { ?>
                                        <td class="align-middle">
                                            <a href="<?=$linkEdit?><?=$linkID?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['tenvi']?>"><img class="rounded img-preview" onerror="src='<?=THUMBS?>/64x64x1/assets/images/noimage.png'" src="<?=UPLOAD_NEWS.$items[$i]['photo']?>" alt="<?=$items[$i]['tenvi']?>"></a>
                                        </td>
                                    <?php } ?>
                                    <td class="align-middle">
                                        <h5><a class="text-dark" href="<?=$linkEdit?><?=$linkID?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['tenvi']?>"><?=$items[$i]['tenvi']?></a></h5>
                                        <?php if(!empty($items[$i]['motavi'])){?> <p class="text-split-2 mt-2"><?=$items[$i]['motavi']?></p><?php }?>
                                    </td>
                                    <?php if(!empty($config['news'][$type]['gallery']) && $config['news'][$type]['show_gallery']==true) { ?>
                                        <td class="align-middle">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-primary px-2 py-1 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Thêm</button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <?php foreach($config['news'][$type]['gallery'] as $key => $value) { ?>
                                                    <li>
                                                        <a class="dropdown-item" href="<?=$linkMulti?>&idc=<?=$items[$i]['id']?>&val=<?=$key?>" title="<?=$value['title_sub_photo']?>"><?=$value['title_sub_photo']?></a>
                                                    </li>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </td>
                                    <?php } ?>
                                    <?php if(!empty($config['news'][$type]['check'])){ foreach($config['news'][$type]['check'] as $key => $value) { ?>
                                        <td class="align-middle text-center">
                                            <div class="custom-control custom-checkbox my-checkbox form-switch">
                                                <input type="checkbox" class="form-check-input show-checkbox" id="show-checkbox-<?=$key?>-<?=$items[$i]['id']?>" data-table="news" data-id="<?=$items[$i]['id']?>" data-loai="<?=$key?>" <?=($items[$i][$key]==true)?'checked':''?>>
                                                <label for="show-checkbox-<?=$key?>-<?=$items[$i]['id']?>" class="custom-control-label"></label>
                                            </div>
                                        </td>
                                    <?php } } ?>
                                    <td class="align-middle text-center">
                                        <div class="custom-control custom-checkbox my-checkbox form-switch">
                                            <input type="checkbox" class="form-check-input show-checkbox" id="show-checkbox-<?=$items[$i]['id']?>" data-table="news" data-id="<?=$items[$i]['id']?>" data-loai="hienthi" <?=($items[$i]['hienthi'])?'checked':''?>>
                                            <label for="show-checkbox-<?=$items[$i]['id']?>" class="custom-control-label"></label>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center text-md text-nowrap">
                                        <?php include TEMPLATE.LAYOUT."action.php"; ?>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                            <?php }?>
                        </table>
                    </div>
                    <div class="row pe-4 ps-4 pt-4 d-flex align-items-center justify-content-center justify-content-md-between">
                        <?php include TEMPLATE.LAYOUT."tempbottom.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var linkFilter='<?=$linkFilter?>';
</script>