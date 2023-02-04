<?php
    $linkMan = "index.php?com=tags&act=man&type=".$type."&p=".$curPage;
    $linkAdd = "index.php?com=tags&act=add&type=".$type."&p=".$curPage;
    $linkEdit = "index.php?com=tags&act=edit&type=".$type."&p=".$curPage;
    $linkDelete = "index.php?com=tags&act=delete&type=".$type."&p=".$curPage;
?>
<div class="content-inner container-fluid pb-0" id="page_layout">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <h5 class="mb-0 text-capitalize">Quản lý tags</h5>
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
                                    <th scope="col" class="align-middle text-center" width="50px">
                                        <div class="custom-control custom-checkbox my-checkbox">
                                            <input type="checkbox" class="form-check-input" id="selectall-checkbox">
                                        </div>
                                    </th>
                                    <th scope="col" class="align-middle text-center" width="100px">STT</th>
                                    <?php if(isset($config['tags'][$type]['show_images']) && $config['tags'][$type]['show_images']==true) { ?>
                                        <th class="align-middle">Hình</th>
                                    <?php } ?>
                                    <th scope="col" style="width:70%;min-width: 200px">Tiêu đề</th>
                                    <?php if(isset($config['tags'][$type]['check'])) { foreach($config['tags'][$type]['check'] as $key => $value) { ?>
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
                                <?php for($i=0;$i<count($items);$i++) { ?>
                                    <tr>
                                        <td class="align-middle">
                                            <div class="custom-control custom-checkbox my-checkbox">
                                            <input type="checkbox" class="form-check-input select-checkbox" id="select-checkbox-<?=$items[$i]['id']?>" value="<?=$items[$i]['id']?>">
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <input type="number" class="form-control form-control-mini m-auto update-stt" min="0" value="<?=$items[$i]['stt']?>" data-id="<?=$items[$i]['id']?>" data-table="tags">
                                        </td>
                                        <?php if(isset($config['tags'][$type]['show_images']) && $config['tags'][$type]['show_images']==true) { ?>
                                            <td class="align-middle text-center">
                                                <h5 class="mb-0 text-default font-weight-normal"><a href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['tenvi']?>"><img class="rounded img-preview" onerror="src='<?=THUMBS?>/<?=$config['tags'][$type]['thumb']?>/assets/images/noimage.png'" src="<?=THUMBS?>/<?=$config['tags'][$type]['thumb']?>/<?=UPLOAD_TAGS_L.$items[$i]['photo']?>" alt="<?=$items[$i]['tenvi']?>"></a></h5>
                                            </td>
                                        <?php } ?>
                                        <td class="align-middle">
                                            <a class="text-dark" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['tenvi']?>"><?=$items[$i]['tenvi']?></a>
                                        </td>
                                        <?php if(isset($config['tags'][$type]['check'])) { foreach($config['tags'][$type]['check'] as $key => $value) { ?>
                                            <td class="align-middle text-center">
                                                <div class="custom-control custom-checkbox my-checkbox form-switch">
                                                    <input type="checkbox" class="form-check-input show-checkbox" id="show-checkbox-<?=$key?>-<?=$items[$i]['id']?>" data-table="tags" data-id="<?=$items[$i]['id']?>" data-loai="<?=$key?>" <?=($items[$i][$key]==true)?'checked':''?>>
                                                    <label for="show-checkbox-<?=$key?>-<?=$items[$i]['id']?>" class="custom-control-label"></label>
                                                </div>
                                            </td>
                                        <?php }} ?>
                                        <td class="align-middle text-center">
                                            <div class="custom-control custom-checkbox my-checkbox form-switch">
                                                <input type="checkbox" class="form-check-input show-checkbox" id="show-checkbox-<?=$items[$i]['id']?>" data-table="tags" data-id="<?=$items[$i]['id']?>" data-loai="hienthi" <?=($items[$i]['hienthi'])?'checked':''?>>
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
