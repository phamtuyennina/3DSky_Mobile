<?php
    function getStatus()
    {
        global $d;

        $row = $d->rawQuery("select * from #_status order by id");

        $str = '<select id="tinhtrang" name="tinhtrang" class="form-select text-sm"><option value="0">Chọn tình trạng</option>';
        foreach($row as $v)
        {   
            $tinhtrang = (isset($_REQUEST['tinhtrang'])) ? $_REQUEST['tinhtrang']:'';
            if($v["id"] == (int)$tinhtrang) $selected = "selected";
            else $selected = "";

            $str .= '<option value='.$v["id"].' '.(isset($selected) ? $selected:'').'>'.$v["trangthai"].'</option>';
        }
        $str .= '</select>';

        return $str;
    }
    function getMember()
    {
        global $d;

        $row = $d->rawQuery("select * from #_member order by id");

        $str = '<select id="id_user" name="id_user" class="select2-basic-single js-states form-control" id="select-member"><option value="0">Chọn tình thành viên</option>';
        foreach($row as $v)
        {   
            $id_user = (isset($_REQUEST['iduser'])) ? $_REQUEST['iduser']:'';
            if($v["id"] == (int)$id_user) $selected = "selected";
            else $selected = "";

            $str .= '<option value='.$v["id"].' '.(isset($selected) ? $selected:'').'>'.$v["ten"].'</option>';
        }
        $str .= '</select>';

        return $str;
    }
    function getStatusPayments()
    {
        global $d;

        $row = $d->rawQuery("select * from #_payments order by id");

        $str = '<select id="payment" name="payment" class="form-select text-sm"><option value="0">Chọn tình trạng thanh toán</option>';
        foreach($row as $v)
        {   
            $payment = (isset($_REQUEST['payment'])) ? $_REQUEST['payment']:'';
            if($v["id"] == (int)$payment) $selected = "selected";
            else $selected = "";

            $str .= '<option value='.$v["id"].' '.(isset($selected) ? $selected:'').'>'.$v["trangthai"].'</option>';
        }
        $str .= '</select>';

        return $str;
    }

    function getPayments()
    {
        global $d;
        $httt = (isset($_REQUEST['httt'])) ? $_REQUEST['httt']:'';
        $row = $d->rawQuery("select * from #_news where type='hinh-thuc-thanh-toan' order by stt,id desc");

        $str = '<select id="httt" name="httt" class="form-select text-sm"><option value="0">Chọn hình thức thanh toán</option>';
        if((int)$httt==1) $selected = "selected";
        else $selected = "";
        $str .= '<option value="1" '.(isset($selected) ? $selected:'').'>Thanh toán PayPal</option>';
        foreach($row as $v)
        {
            
            if($v["id"] == (int)$httt) $selected = "selected";
            else $selected = "";
            $str .= '<option value='.$v["id"].' '.(isset($selected) ? $selected:'').'>'.$v["tenvi"].'</option>';
        }
        $str .= '</select>';

        return $str;
    }
    

    function getCity()
    {
        global $d;

        $row = $d->rawQuery("select ten,id from #_city order by id asc");

        $str = '<select id="city" name="id_city" data-level="0" data-table="#_district" data-child="district" class="select2-basic-single js-states form-control select-place" id="select-city"><option value="0">Chọn danh mục</option>';
        foreach($row as $v)
        {
            $city = (isset($_REQUEST['city'])) ? $_REQUEST['city']:'';
            if($v["id"] == (int)$city) $selected = "selected";
            else $selected = "";
            $str .= '<option value='.$v["id"].' '.(isset($selected) ? $selected:'').'>'.$v["ten"].'</option>';
        }
        $str .= '</select>';

        return $str;
    }

    function getDistrict()
    {
        global $d;

        $id_city = (isset($_REQUEST['city'])) ? $_REQUEST['city']:'';
        $row = $d->rawQuery("select ten,id from #_district where id_city = ? order by id asc",array($id_city));

        $str = '<select id="district" name="id_district" data-level="1" data-table="#_wards" data-child="wards" class="select2-basic-single js-states form-control select-place" id="select-district"><option value="0">Chọn danh mục</option>';
        foreach($row as $v)
        {
            $district = (isset($_REQUEST['district'])) ? $_REQUEST['district']:'';
            if($v["id"] == (int)$district) $selected = "selected";
            else $selected = "";
            $str .= '<option value='.$v["id"].' '.(isset($selected) ? $selected:'').'>'.$v["ten"].'</option>';
        }
        $str .= '</select>';

        return $str;
    }
    
    function getWards()
    {
        global $d;

        $id_city = (isset($_REQUEST['city'])) ? $_REQUEST['city']:'';
        $id_district = (isset($_REQUEST['district'])) ? $_REQUEST['district']:'';
        $row = $d->rawQuery("select ten,id from #_wards where id_city = ? and id_district = ? order by id asc",array($id_city,$id_district));

        $str = '<select id="wards" name="id_wards" class="select2-basic-single js-states form-control" id="select-wards"><option value="0">Chọn danh mục</option>';
        foreach($row as $v)
        {
            $wards = (isset($_REQUEST['wards'])) ? $_REQUEST['wards']:'';
            if($v["id"] == (int)$wards) $selected = "selected";
            else $selected = "";
            $str .= '<option value='.$v["id"].' '.(isset($selected) ? $selected:'').'>'.$v["ten"].'</option>';
        }
        $str .= '</select>';

        return $str;
    }

	$linkMan = $linkFilter = "index.php?com=order&act=man&p=".$curPage;
    $linkEdit = "index.php?com=order&act=edit&p=".$curPage;
    $linkDelete = "index.php?com=order&act=delete&p=".$curPage;
    $linkExcel = "index.php?com=excelAll";
    $linkWord = "index.php?com=wordAll";
    $arrStatus = array("text-primary","text-info","text-warning","text-success","text-danger");
?>
<div class="content-inner pb-0 container-fluid" id="page_layout">
    <div class="card shadow-none border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex flex-column mb-4 mb-md-0">
                    <h3 class="mb-0">Danh sách đơn hàng</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- <div class="col-lg-12 col-md-12">
            <div class="row">
                <div class="col-lg-6 col-xl-3 col-md-6">
                    <div class="card bg-primary">
                        <div id="admin-chart-06" class="admin-chart-06"></div>
                        <div class="card-body">
                            <p class="text-white">Mới đặt</p>
                            <h4 class="text-white counter mb-0"><?=number_format($totalMoidat, 0, ',', '.')?> vnđ</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 col-md-6">
                    <div class="card bg-info">
                    <div id="admin-chart-07" class="admin-chart-07"></div>
                    <div class="card-body">
                        <p class="text-white">Đã xác nhận</p>
                        <h4 class="text-white counter mb-0"><?=number_format($totalDaxacnhan, 0, ',', '.')?> vnđ</h4>
                    </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 col-md-6">
                    <div class="card bg-primary">
                    <div id="admin-chart-08" class="admin-chart-08"></div>
                    <div class="card-body">
                        <p class="text-white">Đã giao</p>
                        <h4 class="text-white counter mb-0"><?=number_format($totalDagiao, 0, ',', '.')?> vnđ</h4>
                    </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 col-md-6">
                    <div class="card bg-info">
                    <div id="admin-chart-09" class="admin-chart-09"></div>
                    <div class="card-body">
                        <p class="text-white">Đã hủy</p>
                        <h4 class="text-white counter mb-0"><?=number_format($totalDahuy, 0, ',', '.')?> vnđ</h4>
                    </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="col-lg-12 col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Tìm kiếm đơn hàng</h5>
                        </div>
                        <div class="card-body">
                            <div class="row form-group-category">
                                <div class="form-group col-md-3 col-sm-3">
                                    <label class="form-label">Nhập từ khóa:</label>
                                    <input class="form-control form-control-navbar text-sm" type="search" id="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" value="<?=(isset($_GET['keyword'])) ? $_GET['keyword']:''?>">
                                </div>
                                <div class="form-group last:mb-0 col-md-3 col-sm-3">
                                    <label class="form-label">Ngày đặt:</label>
                                    <input type="text"  class="form-control flatpickrrange" value="<?=$_GET['ngaydat']?>" placeholder="Chọn ngày đặt">
                                    <input type="hidden" id="ngaydat" name="ngaydat">
                                </div>
                                <div class="form-group last:mb-0 col-md-3 col-sm-3">
                                    <label class="form-label">Thành viên:</label>
                                    <?=getMember()?>
                                </div>
                                <div class="form-group last:mb-0 col-md-3 col-sm-3">
                                    <label class="form-label">Tình trạng:</label>
                                    <?=getStatus()?>
                                </div>
                                <div class="form-group last:mb-0 col-md-3 col-sm-3">
                                    <label class="form-label">Hình thức thanh toán:</label>
                                    <?=getPayments()?>
                                </div>
                                <!-- <div class="form-group last:mb-0 col-md-3 col-sm-3">
                                    <label class="form-label">Trạng thái thanh toán:</label>
                                    <?=getStatusPayments()?>
                                </div> -->
                                <!-- <div class="form-group last:mb-0 col-md-3 col-sm-3">
                                    <label class="form-label">Tỉnh thành:</label>
                                    <?=getCity()?>
                                </div>
                                <div class="form-group last:mb-0 col-md-3 col-sm-3">
                                    <label class="form-label">Quận huyện:</label>
                                    <?=getDistrict()?>
                                </div>
                                <div class="form-group last:mb-0 col-md-3 col-sm-3">
                                    <label class="form-label">Phường xã:</label>
                                    <?=getWards()?>
                                </div>
                                <div class="form-group last:mb-0 col-md-6 col-sm-6">
                                    <label class="form-label">Khoảng giá:</label>
                                    <input type="text" class="primary" id="khoanggia" name="khoanggia">
                                </div> -->
                                <div class="form-group last:mb-0 col-md-12 col-sm-12 flex justify-center ">
                                    <a class="btn bg-success text-white sm:m-0 mx-2" onclick="actionOrder('<?=$linkFilter?>')" title="Tìm kiếm">
                                        <span class="d-sm-inline-block me-1">Tìm kiếm</span>
                                        <svg class="size-28" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                                            <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                    <a class="btn bg-danger sm:m-0 mx-2 text-white" href="<?=$linkMan?>" title="Hủy lọc">
                                        <span class="d-sm-inline-block me-1">Hủy lọc</span>
                                        <svg class="size-28" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.8807 14.6713C4.74972 14.2784 4.32498 14.066 3.93202 14.197C3.53906 14.328 3.32669 14.7527 3.45768 15.1457L4.8807 14.6713ZM20.8807 15.1457C21.0117 14.7527 20.7993 14.328 20.4064 14.197C20.0134 14.066 19.5887 14.2784 19.4577 14.6713L20.8807 15.1457ZM4.16919 14.9085C3.45768 15.1457 3.45779 15.146 3.45791 15.1464C3.45796 15.1465 3.45809 15.1469 3.45819 15.1472C3.45839 15.1478 3.45862 15.1485 3.45889 15.1493C3.45942 15.1509 3.46007 15.1528 3.46086 15.1551C3.46242 15.1597 3.4645 15.1657 3.4671 15.1731C3.47229 15.188 3.47955 15.2084 3.48896 15.2341C3.50776 15.2854 3.53515 15.3576 3.57164 15.4477C3.64455 15.6279 3.75414 15.8805 3.90462 16.1814C4.20474 16.7817 4.67217 17.5836 5.34302 18.3886C6.68936 20.0043 8.88337 21.6585 12.1692 21.6585V20.1585C9.45501 20.1585 7.64902 18.8128 6.49536 17.4284C5.91621 16.7334 5.50864 16.0354 5.24626 15.5106C5.11549 15.2491 5.02195 15.0329 4.96206 14.8849C4.93214 14.811 4.91069 14.7543 4.89727 14.7177C4.89056 14.6994 4.88587 14.6861 4.88312 14.6783C4.88175 14.6744 4.88087 14.6718 4.88047 14.6706C4.88027 14.67 4.88019 14.6698 4.88023 14.6699C4.88025 14.67 4.88029 14.6701 4.88037 14.6704C4.88041 14.6705 4.8805 14.6707 4.88052 14.6708C4.88061 14.671 4.8807 14.6713 4.16919 14.9085ZM12.1692 21.6585C15.455 21.6585 17.649 20.0043 18.9954 18.3886C19.6662 17.5836 20.1336 16.7817 20.4338 16.1814C20.5842 15.8805 20.6938 15.6279 20.7667 15.4477C20.8032 15.3576 20.8306 15.2854 20.8494 15.2341C20.8588 15.2084 20.8661 15.188 20.8713 15.1731C20.8739 15.1657 20.876 15.1597 20.8775 15.1551C20.8783 15.1528 20.879 15.1509 20.8795 15.1493C20.8798 15.1485 20.88 15.1478 20.8802 15.1472C20.8803 15.1469 20.8804 15.1465 20.8805 15.1464C20.8806 15.146 20.8807 15.1457 20.1692 14.9085C19.4577 14.6713 19.4578 14.671 19.4579 14.6708C19.4579 14.6707 19.458 14.6705 19.458 14.6704C19.4581 14.6701 19.4581 14.67 19.4582 14.6699C19.4582 14.6698 19.4581 14.67 19.4579 14.6706C19.4575 14.6718 19.4566 14.6744 19.4553 14.6783C19.4525 14.6861 19.4478 14.6994 19.4411 14.7177C19.4277 14.7543 19.4062 14.811 19.3763 14.8849C19.3164 15.0329 19.2229 15.2491 19.0921 15.5106C18.8297 16.0354 18.4222 16.7334 17.843 17.4284C16.6894 18.8128 14.8834 20.1585 12.1692 20.1585V21.6585Z" fill="currentColor"></path>
                                            <path d="M16.1692 15.4857L20.8122 13.981L22.2973 18.6312" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M20.0741 10.0265C20.1885 10.4246 20.604 10.6545 21.0021 10.5401C21.4002 10.4257 21.6302 10.0102 21.5157 9.61208L20.0741 10.0265ZM4.10797 8.88311C3.96065 9.27025 4.15507 9.7035 4.5422 9.85081C4.92933 9.99812 5.36259 9.80371 5.5099 9.41658L4.10797 8.88311ZM20.7949 9.81927C21.5157 9.61208 21.5156 9.61174 21.5155 9.61138C21.5155 9.61122 21.5154 9.61084 21.5153 9.61053C21.5151 9.60992 21.5149 9.60922 21.5147 9.60842C21.5142 9.60683 21.5136 9.60487 21.513 9.60254C21.5116 9.59789 21.5098 9.59178 21.5075 9.58425C21.5029 9.56919 21.4965 9.54847 21.4882 9.52245C21.4715 9.47042 21.4472 9.39713 21.4145 9.30554C21.3492 9.1225 21.2503 8.86554 21.1125 8.55855C20.8378 7.94628 20.4043 7.12546 19.7677 6.29307C18.4902 4.62255 16.3673 2.87795 13.0843 2.74047L13.0216 4.23916C15.7334 4.35272 17.4815 5.77284 18.5762 7.20429C19.1258 7.92289 19.5038 8.63736 19.744 9.17265C19.8637 9.43943 19.9481 9.65931 20.0018 9.80966C20.0286 9.88477 20.0476 9.94232 20.0595 9.97945C20.0654 9.99801 20.0696 10.0115 20.072 10.0194C20.0732 10.0234 20.074 10.026 20.0743 10.0272C20.0745 10.0278 20.0746 10.028 20.0745 10.0279C20.0745 10.0279 20.0745 10.0277 20.0744 10.0275C20.0744 10.0273 20.0743 10.0271 20.0743 10.027C20.0742 10.0268 20.0741 10.0265 20.7949 9.81927ZM13.0843 2.74047C9.8014 2.60299 7.5401 4.164 6.12735 5.72187C5.42339 6.49812 4.92282 7.27983 4.59785 7.86698C4.43491 8.16138 4.31485 8.40917 4.23446 8.58611C4.19424 8.67465 4.16385 8.74564 4.14292 8.7961C4.13245 8.82133 4.12433 8.84144 4.11853 8.85607C4.11562 8.86338 4.1133 8.86932 4.11154 8.87384C4.11066 8.8761 4.10992 8.87801 4.10933 8.87956C4.10903 8.88033 4.10877 8.88101 4.10854 8.88161C4.10843 8.8819 4.10828 8.88228 4.10823 8.88243C4.10809 8.88278 4.10797 8.88311 4.80893 9.14985C5.5099 9.41658 5.50979 9.41686 5.50969 9.41713C5.50967 9.41718 5.50957 9.41743 5.50953 9.41754C5.50944 9.41778 5.50939 9.41792 5.50936 9.41798C5.50932 9.4181 5.50941 9.41786 5.50963 9.41728C5.51008 9.41612 5.51107 9.41359 5.51261 9.40973C5.51568 9.40199 5.52093 9.38895 5.52839 9.37095C5.54334 9.33494 5.56713 9.27918 5.60012 9.20658C5.66615 9.06124 5.76865 8.84919 5.91025 8.59335C6.19436 8.08002 6.63078 7.39965 7.23849 6.72952C8.44906 5.3946 10.3098 4.1256 13.0216 4.23916L13.0843 2.74047Z" fill="currentColor"></path>
                                            <path d="M8.82965 8.74048L4.12772 10.0496L2.8385 5.34131" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>  
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <h5 class="mb-0 text-capitalize">Danh sách đơn hàng</h5>
                        <div class="d-flex header-top-page justify-content-end align-items-center rounded flex-wrap gap-3">
                            <?php if(isset($config['order']['excelall']) && $config['order']['excelall']==true) { ?>
                                <a class="btn bg-success text-white btn-export-excel d-inline-block align-middle ml-2" onclick="actionOrder('<?=$linkExcel?>')" title="Xuất file Excel"><span class="d-sm-inline-block me-1">Xuất file Excel</span></a>
                            <?php } ?>
                            <?php if(isset($config['order']['wordall']) && $config['order']['wordall']==true) { ?>
                                <a class="btn bg-primary text-white btn-export-word d-inline-block align-middle ml-2 " onclick="actionOrder('<?=$linkWord?>')" title="Xuất file Word"><span class="d-sm-inline-block me-1">Xuất file Word</span></a>
                            <?php } ?>
                            <a class="btn bg-danger text-white flex items-center" id="delete-all" data-url="<?=$linkDelete?>" title="Xóa tất cả">
                                <span class="d-sm-inline-block me-1">Xóa tất cả</span>
                                <svg class="size-28" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 ">
                    <div class="fancy-table table-left-bordered table-responsive rounded mt-3">
                        <table class="table mb-0 w-100" id="datatable">
                            <thead>
                                <tr class="bg-white">
                                    <th class="align-middle" width="5%">
                                        <div class="custom-control custom-checkbox my-checkbox">
                                            <input type="checkbox" class="form-check-input" id="selectall-checkbox">
                                        </div>
                                    </th>
                                    <th scope="col" class="align-middle">Mã đơn hàng</th>
                                    <th scope="col" class="align-middle" style="width:15%">Họ tên</th>
                                    <th scope="col" class="align-middle">Ngày đặt</th>
                                    <th scope="col" class="align-middle">Hình thức thanh toán</th>
                                    <th scope="col" class="align-middle">Tổng giá</th>
                                    <th scope="col" class="align-middle">Tình trạng</th>
                                    <?php if((isset($config['order']['excel']) && $config['order']['excel']==true) || (isset($config['order']['word']) && $config['order']['word']==true)) { ?>
                                        <th scope="col" class="align-middle">Export</th>
                                    <?php } ?>
                                    <th scope="col" class="align-middle text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <?php if(empty($items)) { ?>
                            <tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
                            <?php } else { ?>
                            <tbody>
                                <?php for($i=0;$i<count($items);$i++) { ?>
                                <tr>
                                    <td class="align-middle">
                                        <div class="custom-control custom-checkbox my-checkbox">
                                            <input type="checkbox" class="form-check-input select-checkbox" id="select-checkbox-<?=$items[$i]['id']?>" value="<?=$items[$i]['id']?>">
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <a class="text-primary" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['madonhang']?>"><?=$items[$i]['madonhang']?></a>
                                    </td>
                                    <td class="align-middle">
                                        <a class="text-primary" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['hoten']?>"><?=$items[$i]['hoten']?></a>
                                    </td>
                                    <td class="align-middle"><?=date("h:i:s A - d/m/Y", $items[$i]['ngaytao'])?></td>
                                    <td class="align-middle">
                                        <span class="text-info"><?=$func->get_payments($items[$i]['httt'])?></span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="text-danger font-weight-bold"><?=number_format($items[$i]['tonggia'], 2, '.', ',')?> USD</span>
                                    </td>
                                    <td class="align-middle">
                                        <?php
                                            $id_tinhtrang = $items[$i]['tinhtrang'];
                                            $tinhtrang = $d->rawQueryOne("SELECT trangthai FROM #_status WHERE id = ?",array($id_tinhtrang));
                                        ?>
                                        <span class="<?=$arrStatus[$id_tinhtrang-1]?> text-capitalize"><?=$tinhtrang['trangthai']?></span>
                                    </td>
                                    <?php if($config['order']['excel'] || $config['order']['word']) { ?>
                                        <td class="align-middle text-center text-lg text-nowrap">
                                            <?php if($config['order']['excel']) { ?>
                                                <a class="text-primary mr-2" href="index.php?com=excel&id=<?=$items[$i]['id']?>" title="Xuất file excel"><i class="far fa-file-excel"></i></a>
                                            <?php } ?>
                                            <?php if($config['order']['word']) { ?>
                                                <a class="text-primary" href="index.php?com=word&id=<?=$items[$i]['id']?>" title="Xuất file word"><i class="far fa-file-word"></i></a>
                                            <?php } ?>
                                        </td>
                                    <?php } ?>
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

<!-- Order js -->
<script type="text/javascript">
    const MIN_ORDER= <?=(!empty($minTotal))?$minTotal:1?>;
    const MAX_ORDER= <?=(!empty($maxTotal))?$maxTotal:1?>;
    const FROM_ORDER= <?=(!empty($giatu))?$giatu:0?>;
    const TO_ORDER= <?=(!empty($giaden))?$giaden:$maxTotal?>;
</script>
