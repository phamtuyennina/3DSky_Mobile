<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Đường dẫn <span class="text-red-800 text-sm font-normal pl-2">(Vui lòng không nhập trùng tiêu đề)</span></h5>
    </div>
    <div class="card-body">
        <?php if(isset($slugchange) && $slugchange==true) { ?>
        <div class="form-check d-block ps-0 flex items-center">
            <label class="form-check-label text-info font-semibold" for="slugchange">Thay đổi đường dẫn theo tiêu đề mới:</label>
            <input class="form-check-input float-none ms-2" name="slugchange" type="checkbox" id="slugchange">
        </div>
        <?php }?>
        <input type="hidden" class="slug-id" value="<?=$id?>">
        <div class="bd-example">
            <div class="card pb-0 mb-0">
                <div class="card-header p-0">
                    <nav class="tab-bottom-bordered">
                        <div class="mb-0 nav nav-tabs" id="nav-tab1" role="tablist">
                            <?php foreach($config['website']['lang'] as $k => $v) { ?>
                            <button class="nav-link <?=($k=='vi')?'active':''?>" id="tabs-sluglang" data-bs-toggle="tab" data-bs-target="#tabs-sluglang-<?=$k?>" type="button" role="tab" aria-controls="tabs-sluglang-<?=$k?>" aria-selected="true"><?=$v?></button>
                            <?php }?>
                        </div>
                    </nav>
                </div>
                <div class="card-body">
                        <div class="tab-content iq-tab-fade-up" id="nav-tabContent">
                        <?php foreach($config['website']['lang'] as $k => $v) { ?>
                            <div class="tab-pane fade <?=($k=='vi')?'active show':''?>" id="tabs-sluglang-<?=$k?>" role="tabpanel" aria-labelledby="tabs-sluglang-<?=$k?>-tab">
                                <label class="d-block form-label text-black font-bold">Đường dẫn mẫu (<?=$k?>):<span class="pl-2 font-weight-normal text-gray-700 font-normal" id="slugurlpreview<?=$k?>"><?=$config_base?><strong class="text-info font-normal"><?=(!empty($item['tenkhongdau'.$k])) ? $item['tenkhongdau'.$k]:''?></strong></span></label>
                                <input type="text" class="form-control slug-input no-validate" name="slug<?=$k?>" id="slug<?=$k?>" placeholder="Đường dẫn (<?=$k?>)" value="<?=(empty($copy)) ? $item['tenkhongdau'.$k]:''?>">
                                <input type="hidden" id="slug-default<?=$k?>" value="<?=(isset($copy) && $copy==true)?$item['tenkhongdau'.$k]:''?>">
                                <p class="alert-slug<?=$k?> text-danger d-none mt-2 mb-0" id="alert-slug-danger<?=$k?>">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    <span>Đường dẫn đã tồn tại. Đường dẫn truy cập mục này có thể bị trùng lặp.</span>
                                </p>
                                <p class="alert-slug<?=$k?> text-success d-none mt-2 mb-0" id="alert-slug-success<?=$k?>">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    <span>Đường dẫn hợp lệ.</span>
                                </p>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
