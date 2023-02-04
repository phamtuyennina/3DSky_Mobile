<?php
	function get_main_city()
    {
        global $d;

        $row = $d->rawQuery("select ten, id from #_city order by id asc");

        $str = '<select id="id_city" name="id_city" onchange="onchangeList()" class="select2-basic-single js-states form-control" id="select-list"><option value="0">Tỉnh thành</option>';
        foreach($row as $v)
        {
            if($v["id"] == (int)$_REQUEST['id_city']) $selected = "selected";
            else $selected = "";
            $str .= '<option value='.$v["id"].' '.$selected.'>'.$v["ten"].'</option>';
        }
        $str .= '</select>';

        return $str;
    }

	function get_main_district()
    {
        global $d;

        $id_city = htmlspecialchars($_REQUEST['id_city']);
        $row = $d->rawQuery("select ten, id from #_district where id_city = ? order by id asc",array($id_city));

        $str = '<select id="id_district" name="id_district" onchange="onchangeCat()" class="select2-basic-single js-states form-control" id="select-cat"><option value="0">Quận huyện</option>';
        foreach($row as $v)
        {
            if($v["id"] == (int)$_REQUEST['id_district']) $selected = "selected";
            else $selected = "";
            $str .= '<option value='.$v["id"].' '.$selected.'>'.$v["ten"].'</option>';
        }
        $str .= '</select>';

        return $str;
    }

	$linkMan = $linkFilter = "index.php?com=places&act=man_wards&p=".$curPage;
    $linkAdd = "index.php?com=places&act=add_wards&p=".$curPage;
	$linkEdit = "index.php?com=places&act=edit_wards&p=".$curPage;
	$linkDelete = "index.php?com=places&act=delete_wards&p=".$curPage;
?>
<div class="content-inner container-fluid pb-0" id="page_layout">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <h5 class="mb-0 text-capitalize">Quản lý phường xã</h5>
                        <div class="d-flex header-top-page justify-content-between align-items-center rounded flex-wrap gap-3">
                            <div class="form-group mb-0 header-top-page-search w-auto">
                                <div class="input-group form-group-category"><?=get_main_city()?></div>
                            </div>
                            <div class="form-group mb-0 header-top-page-search w-auto">
                                <div class="input-group form-group-category"><?=get_main_district()?></div>
                            </div>
                            <div class="form-group mb-0 header-top-page-search">
                                <div class="input-group ">
                                    <input type="text" placeholder="Tìm kiếm" class="form-control" id="keyword" value="<?=(isset($_GET['keyword'])) ? $_GET['keyword']:''?>" onkeypress="doEnter(event,'keyword','<?=$linkMan?>')">
                                    <a href="javascript:void(0)" class="input-group-text btn btn-primary d-flex align-items-center" onclick="onSearch('keyword','<?=$linkMan?>')">
                                        <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                                            <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="form-group mb-0 header-top-page-btnaction">
                                <a class="btn btn-primary hvr-icon-wobble-horizontal d-flex align-items-center justify-content-center" href="<?=$linkAdd?>">
                                    <span class="d-sm-inline-block me-1">Thêm Mới</span>
                                    <svg class="size-28 hvr-icon" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" d="M16.6667 2H7.33333C3.92889 2 2 3.92889 2 7.33333V16.6667C2 20.0622 3.92 22 7.33333 22H16.6667C20.0711 22 22 20.0622 22 16.6667V7.33333C22 3.92889 20.0711 2 16.6667 2Z" fill="currentColor"></path>
                                        <path d="M15.3205 12.7083H12.7495V15.257C12.7495 15.6673 12.4139 16 12 16C11.5861 16 11.2505 15.6673 11.2505 15.257V12.7083H8.67955C8.29342 12.6687 8 12.3461 8 11.9613C8 11.5765 8.29342 11.2539 8.67955 11.2143H11.2424V8.67365C11.2824 8.29088 11.6078 8 11.996 8C12.3842 8 12.7095 8.29088 12.7495 8.67365V11.2143H15.3205C15.7066 11.2539 16 11.5765 16 11.9613C16 12.3461 15.7066 12.6687 15.3205 12.7083Z" fill="currentColor"></path>
                                    </svg>
                                </a>
                            </div>
                            <div class="form-group mb-0 header-top-page-btnaction">
                                <a class="btn btn-danger hvr-icon-wobble-horizontal d-flex align-items-center justify-content-center" id="delete-all" data-url="<?=$linkDelete?>" href="javascript:void(0)">
                                    <span class="d-sm-inline-block me-1">Xóa tất cả</span>
                                    <svg class="size-28 hvr-icon" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" d="M19.643 9.48851C19.643 9.5565 19.11 16.2973 18.8056 19.1342C18.615 20.8751 17.4927 21.9311 15.8092 21.9611C14.5157 21.9901 13.2494 22.0001 12.0036 22.0001C10.6809 22.0001 9.38741 21.9901 8.13185 21.9611C6.50477 21.9221 5.38147 20.8451 5.20057 19.1342C4.88741 16.2873 4.36418 9.5565 4.35445 9.48851C4.34473 9.28351 4.41086 9.08852 4.54507 8.93053C4.67734 8.78453 4.86796 8.69653 5.06831 8.69653H18.9388C19.1382 8.69653 19.3191 8.78453 19.4621 8.93053C19.5953 9.08852 19.6624 9.28351 19.643 9.48851Z" fill="currentColor"></path>
                                        <path d="M21 5.97686C21 5.56588 20.6761 5.24389 20.2871 5.24389H17.3714C16.7781 5.24389 16.2627 4.8219 16.1304 4.22692L15.967 3.49795C15.7385 2.61698 14.9498 2 14.0647 2H9.93624C9.0415 2 8.26054 2.61698 8.02323 3.54595L7.87054 4.22792C7.7373 4.8219 7.22185 5.24389 6.62957 5.24389H3.71385C3.32386 5.24389 3 5.56588 3 5.97686V6.35685C3 6.75783 3.32386 7.08982 3.71385 7.08982H20.2871C20.6761 7.08982 21 6.75783 21 6.35685V5.97686Z" fill="currentColor"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 ">
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
                                    <th scope="col" style="width:70%;min-width: 200px">Tiêu đề</th>
                                    <th scope="col" class="align-middle text-center">Hiển thị</th>
                                    <th scope="col" class="align-middle text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <?php if(empty($items)) { ?>
                            <tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
                            <?php } else { ?>
                            <tbody>
                                <?php for($i=0;$i<count($items);$i++) { ?>
                                    <tr>
                                        <td class="align-middle text-center">
                                            <div class="custom-control custom-checkbox my-checkbox">
                                                <input type="checkbox" class="form-check-input select-checkbox" id="select-checkbox-<?=$items[$i]['id']?>" value="<?=$items[$i]['id']?>">
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <input type="number" class="form-control form-control-mini m-auto update-stt" min="0" value="<?=$items[$i]['stt']?>" data-id="<?=$items[$i]['id']?>" data-table="wards">
                                        </td>
                                        
                                        <td class="align-middle" >
                                            <h5 class="mb-0 text-default font-weight-normal"><a class="text-dark" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['ten']?>"><?=$items[$i]['ten']?></a></h5>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="custom-control custom-checkbox my-checkbox form-switch">
                                                <input type="checkbox" class="form-check-input show-checkbox" id="show-checkbox-<?=$items[$i]['id']?>" data-table="wards" data-id="<?=$items[$i]['id']?>" data-loai="hienthi" <?=($items[$i]['hienthi'])?'checked':''?>>
                                                <label for="show-checkbox-<?=$items[$i]['id']?>" class="custom-control-label"></label>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-md text-nowrap">
                                            <?php include TEMPLATE.LAYOUT."action.php"; ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <?php } ?>
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