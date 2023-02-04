<?php
    $linkMan = "index.php?com=newsletter&act=man&type=".$type."&p=".$curPage;
    $linkAdd = "index.php?com=newsletter&act=add&type=".$type."&p=".$curPage;
    $linkEdit = "index.php?com=newsletter&act=edit&type=".$type."&p=".$curPage;
    $linkDelete = "index.php?com=newsletter&act=delete&type=".$type."&p=".$curPage;

    $arrStatus = array("bg-light text-dark","bg-success","bg-warning","bg-info");
?>
<div class="content-inner container-fluid pb-0" id="page_layout">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <h5 class="mb-0 text-capitalize">Quản lý nhận tin</h5>
                        <div class="d-flex header-top-page justify-content-end align-items-center rounded flex-wrap gap-3">
                            <?php include TEMPLATE.LAYOUT."topaction.php"; ?>
                        </div>
                    </div>
                    <p class="mb-0">Chọn email sau đó kéo xuống dưới cùng danh sách này để có thể thiết lập nội dung email muốn gửi đi.</p>
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
                                    <?php if(isset($config['newsletter'][$type]['showten']) && $config['newsletter'][$type]['showten']==true) { ?>
                                        <th class="align-middle">Họ tên</th>
                                    <?php } ?>
                                    <?php if(isset($config['newsletter'][$type]['email']) && $config['newsletter'][$type]['email']==true) { ?>
                                        <th class="align-middle">Email</th>
                                    <?php } ?>
                                    <?php if(isset($config['newsletter'][$type]['showdienthoai']) && $config['newsletter'][$type]['showdienthoai']==true) { ?>
                                        <th class="align-middle">Điện thoại</th>
                                    <?php } ?>
                                    <?php if(isset($config['newsletter'][$type]['file']) && $config['newsletter'][$type]['file']==true) { ?>
                                        <th class="align-middle">Download</th>
                                    <?php } ?>
                                    <?php if(isset($config['newsletter'][$type]['showngaytao']) && $config['newsletter'][$type]['showngaytao']==true) { ?>
                                        <th class="align-middle">Ngày tạo</th>
                                    <?php } ?>
                                    <?php if(isset($config['newsletter'][$type]['tinhtrang']) && count($config['newsletter'][$type]['tinhtrang'])>0) { ?>
                                        <th class="align-middle text-center">Tình trạng</th>
                                    <?php } ?>
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
                                        <input type="number" class="form-control form-control-mini m-auto update-stt" min="0" value="<?=$items[$i]['stt']?>" data-id="<?=$items[$i]['id']?>" data-table="newsletter">
                                    </td>
                                    <?php if(isset($config['newsletter'][$type]['showten']) && $config['newsletter'][$type]['showten']==true) { ?>
                                        <td class="align-middle">
                                            <a class="text-dark" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['ten']?>"><?=$items[$i]['ten']?></a>
                                        </td>
                                    <?php } ?>
                                    <?php if(isset($config['newsletter'][$type]['email']) && $config['newsletter'][$type]['email']==true) { ?>
                                        <td class="align-middle">
                                            <a class="text-dark" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['email']?>"><?=$items[$i]['email']?></a>
                                        </td>
                                    <?php } ?>
                                    <?php if(isset($config['newsletter'][$type]['showdienthoai']) && $config['newsletter'][$type]['showdienthoai']==true) { ?>
                                        <td class="align-middle"><?=$items[$i]['dienthoai']?></td>
                                    <?php } ?>
                                    <?php if(isset($config['newsletter'][$type]['file']) && $config['newsletter'][$type]['file']==true) { ?>
                                        <td class="align-middle">
                                            <?php if($items[$i]['taptin']!='') { ?>
                                                <a class="btn btn-sm bg-gradient-primary text-white d-inline-block p-1 rounded" href="<?=UPLOAD_FILE.$items[$i]['taptin']?>" title="Download tập tin"><i class="fas fa-download mr-2"></i>Download tập tin</a>
                                            <?php } else { ?>
                                                <a class="bg-gradient-secondary text-white d-inline-block p-1 rounded" href="#" title="Tập tin trống"><i class="fas fa-download mr-2"></i>Tập tin trống</a>
                                            <?php } ?>
                                        </td>
                                    <?php } ?>
                                    <?php if(isset($config['newsletter'][$type]['showngaytao']) && $config['newsletter'][$type]['showngaytao']==true) { ?>
                                        <td class="align-middle"><?=date("h:i:s A - d/m/Y", $items[$i]['ngaytao'])?></td>
                                    <?php } ?>
                                    <?php if(isset($config['newsletter'][$type]['tinhtrang']) && count($config['newsletter'][$type]['tinhtrang'])>0) { ?>
                                        <td class="align-middle text-center"><span class="bg-soft-primary rounded-pill iq-custom-badge <?=$arrStatus[$items[$i]['tinhtrang']]?>"><?=$func->get_status_newsletter($items[$i]['tinhtrang'],$type)?></span></td>
                                    <?php } ?>
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
            <?php if($config['newsletter'][$type]['guiemail']) { ?>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <h5 class="mb-0 text-capitalize">Gửi email đến danh sách được chọn</h5>
                    </div>
                </div>
                <div class="card-body ">
                    <form name="frmsendemail" class="needs-validation" novalidate method="post" action="<?=$linkMan?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="form-label" for="exampleInputText1">Tiêu đề </label>
                            <input type="text" class="form-control" id="tieude" required name="tieude" value="" placeholder="Tiêu đề">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="exampleInputText1">Upload tập tin: <span class="text-red-700 text-sm">(<?php echo $config['newsletter'][$type]['file_type'] ?>)</span></label>
                            <input type="file" class="form-control" aria-label="file example" name="file" id="file" required="">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="noidung">Nội dung thông tin:</label>
                            <textarea class="form-control form-control-ckeditor" name="noidung" id="noidung" rows="5" placeholder="Nội dung thông tin"></textarea>
                        </div>
                        <input type="hidden" name="listemail" id="listemail">
                        <?php if($config['newsletter'][$type]['guiemail']) { ?>
                        <div class="form-group d-inline-block mb-0 header-top-page-btnaction">
                            <a class="btn btn-primary hvr-icon-wobble-horizontal d-flex align-items-center justify-content-center" id="send-email" href="javascript:void(0)">
                                <span class="d-sm-inline-block me-1">Gửi email</span>
                                <svg class="size-28 hvr-icon" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.4274 2.5783C20.9274 2.0673 20.1874 1.8783 19.4974 2.0783L3.40742 6.7273C2.67942 6.9293 2.16342 7.5063 2.02442 8.2383C1.88242 8.9843 2.37842 9.9323 3.02642 10.3283L8.05742 13.4003C8.57342 13.7163 9.23942 13.6373 9.66642 13.2093L15.4274 7.4483C15.7174 7.1473 16.1974 7.1473 16.4874 7.4483C16.7774 7.7373 16.7774 8.2083 16.4874 8.5083L10.7164 14.2693C10.2884 14.6973 10.2084 15.3613 10.5234 15.8783L13.5974 20.9283C13.9574 21.5273 14.5774 21.8683 15.2574 21.8683C15.3374 21.8683 15.4274 21.8683 15.5074 21.8573C16.2874 21.7583 16.9074 21.2273 17.1374 20.4773L21.9074 4.5083C22.1174 3.8283 21.9274 3.0883 21.4274 2.5783Z" fill="currentColor"></path>
                                    <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M3.01049 16.8079C2.81849 16.8079 2.62649 16.7349 2.48049 16.5879C2.18749 16.2949 2.18749 15.8209 2.48049 15.5279L3.84549 14.1619C4.13849 13.8699 4.61349 13.8699 4.90649 14.1619C5.19849 14.4549 5.19849 14.9299 4.90649 15.2229L3.54049 16.5879C3.39449 16.7349 3.20249 16.8079 3.01049 16.8079ZM6.77169 18.0003C6.57969 18.0003 6.38769 17.9273 6.24169 17.7803C5.94869 17.4873 5.94869 17.0133 6.24169 16.7203L7.60669 15.3543C7.89969 15.0623 8.37469 15.0623 8.66769 15.3543C8.95969 15.6473 8.95969 16.1223 8.66769 16.4153L7.30169 17.7803C7.15569 17.9273 6.96369 18.0003 6.77169 18.0003ZM7.02539 21.5683C7.17139 21.7153 7.36339 21.7883 7.55539 21.7883C7.74739 21.7883 7.93939 21.7153 8.08539 21.5683L9.45139 20.2033C9.74339 19.9103 9.74339 19.4353 9.45139 19.1423C9.15839 18.8503 8.68339 18.8503 8.39039 19.1423L7.02539 20.5083C6.73239 20.8013 6.73239 21.2753 7.02539 21.5683Z" fill="currentColor"></path>
                                </svg>
                            </a>
                        </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
