<?php
    $linkMan = "index.php?com=pushOnesignal&act=man&p=".$curPage;
    $linkAdd = "index.php?com=pushOnesignal&act=add&p=".$curPage;
    $linkEdit = "index.php?com=pushOnesignal&act=edit&p=".$curPage;
    $linkDelete = "index.php?com=pushOnesignal&act=delete&p=".$curPage;
?>
<div class="content-inner container-fluid pb-0" id="page_layout">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <h5 class="mb-0 text-capitalize">Quản lý thông báo đẩy</h5>
                        <div class="d-flex header-top-page justify-content-end align-items-center rounded flex-wrap gap-3">
                            <?php include TEMPLATE.LAYOUT."topaction.php"; ?>
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
                                    <th class="align-middle text-center" width="10%">STT</th>
                                    <th class="align-middle text-center" width="8%">Hình</th>
                                    <th class="align-middle" style="width:30%">Tiêu đề</th>
                                    <th class="align-middle text-center">Đẩy tin</th>
                                    <th class="align-middle text-center">Thao tác</th>
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
                                        <input type="number" class="form-control form-control-mini m-auto update-stt" min="0" value="<?=$items[$i]['stt']?>" data-id="<?=$items[$i]['id']?>" data-table="pushonesignal">
                                    </td>

                                    <td class="align-middle text-center">
                                        <a href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['name']?>"><img class="rounded img-preview" onerror="src='<?=THUMBS?>/64x64x1/assets/images/noimage.png'" src="<?=THUMBS?>/64x64x1/<?=UPLOAD_SYNC_L.$items[$i]['photo']?>" alt="<?=$items[$i]['name']?>"></a>
                                    </td>
                                    <td class="align-middle">
                                        <h5 class="mb-0 text-default font-weight-normal"><a class="text-dark" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['name']?>"><?=$items[$i]['name']?></a></h5>
                                    </td>
                                    <td class="align-middle text-center text-md text-nowrap">
                                        <a class="btn btn-primary hvr-icon-wobble-horizontal d-inline-block px-2 py-1" id="push-onesignal" data-url="index.php?com=pushOnesignal&act=sync&id=<?=$items[$i]['id']?>" title="Đẩy tin">
                                            <svg class="icon-22" width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.8325 8.17463L10.109 13.9592L3.59944 9.88767C2.66675 9.30414 2.86077 7.88744 3.91572 7.57893L19.3712 3.05277C20.3373 2.76963 21.2326 3.67283 20.9456 4.642L16.3731 20.0868C16.0598 21.1432 14.6512 21.332 14.0732 20.3953L10.106 13.9602" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                            Đẩy tin
                                        </a>
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