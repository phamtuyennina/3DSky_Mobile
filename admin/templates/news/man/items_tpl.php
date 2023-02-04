<?php 
	function get_main_list()
    {
        global $d, $type;

        $row = $d->rawQuery("select tenvi, id from #_news_list where type = ? order by stt,id desc",array($type));

        $str = '<select id="id_list" name="id_list" onchange="onchangeList()" class="form-control select2"><option value="0">Chọn danh mục</option>';
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

		$str = '<select id="id_cat" name="id_cat" onchange="onchangeCat()" class="form-control select2"><option value="0">Chọn danh mục</option>';
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

		$str = '<select id="id_item" name="id_item" onchange="onchangeItem()" class="form-control select2"><option value="0">Chọn danh mục</option>';
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

		$str = '<select id="id_sub" name="id_sub" onchange="onchangeSub()" class="form-control select2"><option value="0">Chọn danh mục</option>';
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
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Quản lý <?=$config['news'][$type]['title_main']?></li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card-footer text-sm sticky-top">
    	<a class="btn btn-sm bg-gradient-primary text-white" href="<?=$linkAdd?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
        <a class="btn btn-sm bg-gradient-danger text-white" id="delete-all" data-url="<?=$linkDelete?><?=$strUrl?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
        <div class="form-inline form-search d-inline-block align-middle ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar text-sm" type="search" id="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" value="<?=(isset($_GET['keyword'])) ? $_GET['keyword']:''?>" onkeypress="doEnter(event,'keyword','<?=$linkMan?>')">
                <div class="input-group-append bg-primary rounded-right">
                    <button class="btn btn-navbar text-white" type="button" onclick="onSearch('keyword','<?=$linkMan?>')">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php if(isset($config['news'][$type]['dropdown']) && $config['news'][$type]['dropdown']==true) { ?>
	    <div class="card-footer form-group-category text-sm bg-light row">
			<?php if(isset($config['news'][$type]['list']) && $config['news'][$type]['list']==true) { ?>
				<div class="form-group col-xl-2 col-lg-3 col-md-4 col-sm-4 mb-2"><?=get_main_list();?></div>
			<?php } ?>
			<?php if(isset($config['news'][$type]['cat']) && $config['news'][$type]['cat']==true) { ?>
				<div class="form-group col-xl-2 col-lg-3 col-md-4 col-sm-4 mb-2"><?=get_main_cat();?></div>
			<?php } ?>
			<?php if(isset($config['news'][$type]['item']) && $config['news'][$type]['item']==true) { ?>
				<div class="form-group col-xl-2 col-lg-3 col-md-4 col-sm-4 mb-2"><?=get_main_item();?></div>
			<?php } ?>
			<?php if(isset($config['news'][$type]['sub']) && $config['news'][$type]['sub']==true) { ?>
				<div class="form-group col-xl-2 col-lg-3 col-md-4 col-sm-4 mb-2"><?=get_main_sub();?></div>
			<?php } ?>
	    </div>
	<?php } ?>
    <div class="card card-primary card-outline text-sm mb-0">
        <div class="card-header">
            <h3 class="card-title">Danh sách <?=$config['news'][$type]['title_main']?></h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="align-middle" width="5%">
                            <div class="custom-control custom-checkbox my-checkbox">
                                <input type="checkbox" class="custom-control-input" id="selectall-checkbox">
                                <label for="selectall-checkbox" class="custom-control-label"></label>
                            </div>
                        </th>
                        <th class="align-middle text-center" width="10%">STT</th>
						<?php if(isset($config['news'][$type]['show_images']) && $config['news'][$type]['show_images']) { ?>
							<th class="align-middle">Hình</th>
						<?php } ?>
						<th class="align-middle" style="width:30%">Tiêu đề</th>
						<?php if(!empty($config['news'][$type]['gallery']) && $config['news'][$type]['show_gallery']==true) { ?>
							<th class="align-middle">Gallery</th>
						<?php } ?>
						<?php if(!empty($config['news'][$type]['check'])){ foreach($config['news'][$type]['check'] as $key => $value) { ?>
							<th class="align-middle text-center"><?=$value?></th>
						<?php } } ?>
						<th class="align-middle text-center">Hiển thị</th>
                        <th class="align-middle text-center">Thao tác</th>
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
                                        <input type="checkbox" class="custom-control-input select-checkbox" id="select-checkbox-<?=$items[$i]['id']?>" value="<?=$items[$i]['id']?>">
                                        <label for="select-checkbox-<?=$items[$i]['id']?>" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <input type="number" class="form-control form-control-mini m-auto update-stt" min="0" value="<?=$items[$i]['stt']?>" data-id="<?=$items[$i]['id']?>" data-table="news">
                                </td>
                                <?php if(isset($config['news'][$type]['show_images']) && $config['news'][$type]['show_images']) { ?>
                                    <td class="align-middle">
                                    	<a href="<?=$linkEdit?><?=$linkID?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['tenvi']?>"><img class="rounded img-preview" onerror="src='assets/images/noimage.png'" src="<?=THUMBS?>/<?=$config['news'][$type]['thumb']?>/<?=UPLOAD_NEWS_L.$items[$i]['photo']?>" alt="<?=$items[$i]['tenvi']?>"></a>
                                    </td>
                                <?php } ?>
                                <td class="align-middle">
                                    <a class="text-dark" href="<?=$linkEdit?><?=$linkID?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['tenvi']?>"><?=$items[$i]['tenvi']?></a>
                                    <div class="tool-action mt-2 w-clear">
                                    	<?php if(isset($config['news'][$type]['view']) && $config['news'][$type]['view']==true) { ?>
                                    		<a class="text-primary mr-3" href="<?=$linkView?><?=$items[$i]['tenkhongdauvi']?>" target="_blank" title="<?=$items[$i]['tenvi']?>"><i class="far fa-eye mr-1"></i>View</a>
                                    	<?php } ?>
                                    	<a class="text-info mr-3" href="<?=$linkEdit?><?=$linkID?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['tenvi']?>"><i class="far fa-edit mr-1"></i>Edit</a>
                                    	<?php if(isset($config['news'][$type]['copy']) && $config['news'][$type]['copy']==true) { ?>
                                    		<div class="dropdown">
			                            		<a id="dropdownCopy" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-success p-0 pr-3"><i class="far fa-clone mr-1"></i>Copy</a>
									            <ul aria-labelledby="dropdownCopy" class="dropdown-menu border-0 shadow">
									                <li><a href="#" class="dropdown-item copy-now" data-id="<?=$items[$i]['id']?>" data-table="news" data-copyimg="<?=$copyImg?>"><i class="far fa-caret-square-right text-secondary mr-2"></i>Sao chép ngay</a></li>
									                <li><a href="<?=$linkCopy?><?=$linkID?>&id=<?=$items[$i]['id']?>" class="dropdown-item"><i class="far fa-caret-square-right text-secondary mr-2"></i>Chỉnh sửa thông tin</a></li>
									            </ul>
			                            	</div>
                                    	<?php } ?>
                                    	<a class="text-danger" id="delete-item" data-url="<?=$linkDelete?><?=$linkID?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['tenvi']?>"><i class="far fa-trash-alt mr-1"></i>Delete</a>
                                    </div>
                                </td>
                                <?php if(!empty($config['news'][$type]['gallery']) && $config['news'][$type]['show_gallery']==true) { ?>
		                            <td class="align-middle">
		                            	<div class="dropdown">
		                            		<button type="button" class="btn btn-sm bg-gradient-success dropdown-toggle" id="dropdown-gallery" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Thêm</button>
		                            		<div class="dropdown-menu" aria-labelledby="dropdown-gallery">
		                            			<?php foreach($config['news'][$type]['gallery'] as $key => $value) { ?>
					                                <a class="dropdown-item text-dark" href="<?=$linkMulti?>&idc=<?=$items[$i]['id']?>&val=<?=$key?>" title="<?=$value['title_sub_photo']?>"><i class="far fa-caret-square-right text-secondary mr-2"></i><?=$value['title_sub_photo']?></a>
					                            <?php } ?>
		                            		</div>
		                            	</div>
		                            </td>
		                        <?php } ?>
                                <?php if(!empty($config['news'][$type]['check'])){ foreach($config['news'][$type]['check'] as $key => $value) { ?>
								  	<td class="align-middle text-center">
	                                	<div class="custom-control custom-checkbox my-checkbox">
	                                        <input type="checkbox" class="custom-control-input show-checkbox" id="show-checkbox-<?=$key?>-<?=$items[$i]['id']?>" data-table="news" data-id="<?=$items[$i]['id']?>" data-loai="<?=$key?>" <?=($items[$i][$key]==true)?'checked':''?>>
	                                        <label for="show-checkbox-<?=$key?>-<?=$items[$i]['id']?>" class="custom-control-label"></label>
	                                    </div>
	                                </td>
								<?php } } ?>
								<td class="align-middle text-center">
                                	<div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input show-checkbox" id="show-checkbox-<?=$items[$i]['id']?>" data-table="news" data-id="<?=$items[$i]['id']?>" data-loai="hienthi" <?=($items[$i]['hienthi'])?'checked':''?>>
                                        <label for="show-checkbox-<?=$items[$i]['id']?>" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td class="align-middle text-center text-md text-nowrap">
                                	<?php if(isset($config['news'][$type]['copy']) && $config['news'][$type]['copy']==true) { ?>
                                    	<div class="dropdown d-inline-block align-middle">
		                            		<a id="dropdownCopy" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-success p-0 pr-2"><i class="far fa-clone"></i></a>
								            <ul aria-labelledby="dropdownCopy" class="dropdown-menu border-0 shadow">
								                <li><a href="#" class="dropdown-item copy-now" data-id="<?=$items[$i]['id']?>" data-table="news"><i class="far fa-caret-square-right text-secondary mr-2"></i>Sao chép ngay</a></li>
								                <li><a href="<?=$linkCopy?><?=$linkID?>&id=<?=$items[$i]['id']?>" class="dropdown-item"><i class="far fa-caret-square-right text-secondary mr-2"></i>Chỉnh sửa thông tin</a></li>
								            </ul>
		                            	</div>
                                    <?php } ?>
                                    <a class="text-primary mr-2" href="<?=$linkEdit?><?=$linkID?>&id=<?=$items[$i]['id']?>" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                                    <a class="text-danger" id="delete-item" data-url="<?=$linkDelete?><?=$linkID?>&id=<?=$items[$i]['id']?>" title="Xóa"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
    <?php if(!empty($paging)) { ?>
        <div class="card-footer text-sm pb-0">
            <?=$paging?>
        </div>
    <?php } ?>
    <div class="card-footer text-sm">
    	<a class="btn btn-sm bg-gradient-primary text-white" href="<?=$linkAdd?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
        <a class="btn btn-sm bg-gradient-danger text-white" id="delete-all" data-url="<?=$linkDelete?><?=$strUrl?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
    </div>
</section>