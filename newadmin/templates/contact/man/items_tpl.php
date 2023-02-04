<?php
	$linkMan = "index.php?com=contact&act=man&p=".$curPage;
	$linkEdit = "index.php?com=contact&act=edit&p=".$curPage;
	$linkDelete = "index.php?com=contact&act=delete&p=".$curPage;
?>
<div class="content-inner container-fluid pb-0" id="page_layout">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <h5 class="mb-0 text-capitalize">Quản lý liên hệ</h5>
                        <div class="d-flex header-top-page justify-content-end align-items-center rounded flex-wrap gap-3">
                            <?php include TEMPLATE.LAYOUT."topaction.php"; ?>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="fancy-table table-left-bordered table-responsive rounded mt-3">
                        <table class="table mb-0 w-100" id="datatable">
                            <thead>
                                <tr class="bg-white">
                                    <th scope="col" class="align-middle text-center" width="50px"><div class="custom-control custom-checkbox my-checkbox"><input type="checkbox" class="form-check-input" id="selectall-checkbox"></div></th>
                                    <th scope="col" class="align-middle text-center" width="100px">STT</th>
                                    <th scope="col" class="align-middle">Họ tên</th>
                                    <th scope="col" class="align-middle">Điện thoại</th>
                                    <th scope="col" class="align-middle">Email</th>
                                    <th scope="col" class="align-middle text-center">Xác nhận</th>
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
                                        <input type="number" class="form-control form-control-mini m-auto update-stt" min="0" value="<?=$items[$i]['stt']?>" data-id="<?=$items[$i]['id']?>" data-table="contact">
                                    </td>
                                    <td class="align-middle">
                                        <h5><a class="text-dark" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['ten']?>"><?=$items[$i]['ten']?></a></h5>
                                    </td>
                                    <td class="align-middle">
                                        <a class="text-dark" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['dienthoai']?>"><?=$items[$i]['dienthoai']?></a>
                                    </td>
                                    <td class="align-middle">
                                        <a class="text-dark" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['email']?>"><?=$items[$i]['email']?></a>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="custom-control custom-checkbox my-checkbox">
                                            <input type="checkbox" class="form-check-input select-checkbox" id="show-checkbox-<?=$items[$i]['id']?>" data-table="contact" data-id="<?=$items[$i]['id']?>" data-loai="hienthi" <?=($items[$i]['hienthi'])?'checked':''?>>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center text-md text-nowrap">
                                        <?php include TEMPLATE.LAYOUT."action.php"; ?>
                                    </td>
                                </tr>
                            <?php } ?>   
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