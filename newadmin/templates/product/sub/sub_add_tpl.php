<?php
	function get_main_list()
    {
        global $d, $type;

        $row = $d->rawQuery("select tenvi, id from #_product_list where type = ? order by stt,id desc",array($type));

        $str = '<select id="id_list" name="data[id_list]" data-level="0" data-type="'.$type.'" data-table="#_product_cat" data-child="id_cat" class="select2-basic-single js-states form-control select-category" id="select-list"><option value="0">Chọn danh mục cấp 1</option>';
        foreach($row as $v)
        {
            $id_list = isset($_REQUEST['id_list']) ? $_REQUEST['id_list']:'';
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

        $id_list = isset($_REQUEST['id_list']) ? $_REQUEST['id_list']:'';
        $row = $d->rawQuery("select tenvi, id from #_product_cat where id_list = ? and type = ? order by stt,id desc",array($id_list,$type));

        $str = '<select id="id_cat" name="data[id_cat]" data-level="1" data-type="'.$type.'" data-table="#_product_item" data-child="id_item" class="select2-basic-single js-states form-control select-category" id="select-cat"><option value="0">Chọn danh mục cấp 2</option>';
        foreach($row as $v)
        {
            $id_cat = isset($_REQUEST['id_cat']) ? $_REQUEST['id_cat']:'';
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

        
        $id_list = isset($_REQUEST['id_list']) ? $_REQUEST['id_list']:'';
        $id_cat = isset($_REQUEST['id_cat']) ? $_REQUEST['id_cat']:'';
        $row = $d->rawQuery("select tenvi, id from #_product_item where id_list = ? and id_cat = ? and type = ? order by stt,id desc",array($id_list,$id_cat,$type));

        $str = '<select id="id_item" name="data[id_item]" class="select2-basic-single js-states form-control" id="select-item"><option value="0">Chọn danh mục cấp 3</option>';
        foreach($row as $v)
        {
            $id_item = isset($_REQUEST['id_item']) ? $_REQUEST['id_item']:'';
            if($v["id"] == (int)$id_item) $selected = "selected";
            else $selected = "";

            $str .= '<option value='.$v["id"].' '.$selected.'>'.$v["tenvi"].'</option>';
        }
        $str .= '</select>';
        
        return $str;
    }

	$linkMan = "index.php?com=product&act=man_sub&type=".$type."&p=".$curPage;
	if($act=='add_sub') $linkFilter = "index.php?com=product&act=add_sub&type=".$type."&p=".$curPage;
	else if($act=='edit_sub') $linkFilter = "index.php?com=product&act=edit_sub&type=".$type."&p=".$curPage."&id=".$id;
    $linkSave = "index.php?com=product&act=save_sub&type=".$type."&p=".$curPage;

    if((!empty($config['product'][$type]['images_item']) && $config['product'][$type]['images_item']==true) || $flagGallery || (!empty($config['product'][$type]['dropdown']) or $config['product'][$type]['dropdown']==true))
    {
        $colLeft = "col-xl-8 ";
        $colRight = "col-xl-4";
    }
    else
    {
        $colLeft = "col-12";
        $colRight = "d-none";
    }
?>
<div class="content-inner container-fluid pb-0" id="page_layout">
    <form class="validation-form" novalidate method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card mb-0">
                    <div class="card-header">
                        <div class="d-flex justify-start align-items-center flex-wrap gap-3">
                            <?php include TEMPLATE.LAYOUT."actionsave.php"; ?>
                        </div>
                    </div>
                    <div class="card-body pt-0"></div>
                </div>
            </div>
            <div class="<?=$colLeft?>">
                <?php if(!empty($config['product'][$type]['slug_sub']) && $config['product'][$type]['slug_sub']==true)
                {
                    $slugchange = ($act=='edit_sub') ? 1 : 0;
                    include TEMPLATE.LAYOUT."slug.php";
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Nội dung <?=$config['product'][$type]['title_main_sub']?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row items-center">
                            <div class="form-group col-md-6">
                                <label for="hienthi" class="d-inline-block form-check-label align-middle mb-0 mr-2">Hiển thị:</label>
                                <div class="custom-control custom-checkbox d-inline-block align-middle form-switch">
                                    <input type="checkbox" class="custom-control-input form-check-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked':''?>>
                                    <label for="hienthi-checkbox" class="custom-control-label"></label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="stt" class="d-inline-block form-check-label align-middle mb-0 mr-2">Số thứ tự:</label>
                                <input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?=isset($item['stt'])?$item['stt']:1?>">
                            </div>
                        </div>

                        <div class="bd-example">
                            <div class="card mb-0 card-article">
                                <div class="card-header p-0">
                                    <nav class="tab-bottom-bordered">
                                        <div class="mb-0 nav nav-tabs" id="nav-tab1" role="tablist">
                                            <?php foreach($config['website']['lang'] as $k => $v) { ?>
                                            <button class="nav-link <?=($k=='vi')?'active':''?>" id="tabs-lang" data-bs-toggle="tab" data-bs-target="#tabs-lang-<?=$k?>" type="button" role="tab" aria-controls="tabs-lang-<?=$k?>" aria-selected="true"><?=$v?></button>
                                            <?php }?>
                                        </div>
                                    </nav>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content iq-tab-fade-up" id="nav-tabContent">
                                        <?php foreach($config['website']['lang'] as $k => $v) { ?>
                                        <div class="tab-pane fade <?=($k=='vi')?'active show':''?>" id="tabs-lang-<?=$k?>" role="tabpanel" aria-labelledby="tabs-lang-<?=$k?>-tab">
                                                <div class="form-group last:mb-0">
                                                    <label class="form-label" for="ten<?=$k?>">Tiêu đề (<?=$k?>):</label>
                                                    <input type="text" class="form-control for-seo" name="data[ten<?=$k?>]" id="ten<?=$k?>" placeholder="Tiêu đề (<?=$k?>)" value="<?=(!empty($item['ten'.$k])) ? $item['ten'.$k]:''?>" <?=($k=='vi')?'required':''?>>
                                                </div>
                                            <?php if(isset($config['product'][$type]['mota_sub']) && $config['product'][$type]['mota_sub']==true) { ?>
                                                <div class="form-group last:mb-0">
                                                    <label class="form-label" for="mota<?=$k?>">Mô tả (<?=$k?>):</label>
                                                    <textarea class="form-control for-seo <?=($config['product'][$type]['mota_cke_sub'])?'form-control-ckeditor':''?>" name="data[mota<?=$k?>]" id="mota<?=$k?>" rows="5" placeholder="Mô tả (<?=$k?>)"><?=(!empty($item['mota'.$k])) ?htmlspecialchars_decode($item['mota'.$k]):''?></textarea>
                                                </div>
                                            <?php } ?>
                                            <?php if(isset($config['product'][$type]['noidung_sub']) && $config['product'][$type]['noidung_sub']==true) { ?>
                                                <div class="form-group last:mb-0">
                                                    <label class="form-label" for="noidung<?=$k?>">Nội dung (<?=$k?>):</label>
                                                    <textarea class="form-control for-seo <?=($config['product'][$type]['noidung_sub_cke'])?'form-control-ckeditor':''?>" name="data[noidung<?=$k?>]" id="noidung<?=$k?>" rows="5" placeholder="Nội dung (<?=$k?>)"><?=htmlspecialchars_decode(@$item['noidung'.$k])?></textarea>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="<?=$colRight?>">
                <div class="card">
                    <div class="card-header">
                         <h5 class="mb-0">Danh mục <?=$config['product'][$type]['title_main_sub']?></h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group-category row">
                            <div class="form-group last:mb-0 col-xl-6 col-sm-4">
                                <label class="d-block form-label" for="id_list">Danh mục cấp 1:</label>
                                <?=get_main_list()?>
                            </div>
                            <div class="form-group last:mb-0 col-xl-6 col-sm-4">
                                <label class="d-block form-label" for="id_cat">Danh mục cấp 2:</label>
                                <?=get_main_cat()?>
                            </div>
                            <div class="form-group last:mb-0 col-xl-6 col-sm-4">
                                <label class="d-block form-label" for="id_cat">Danh mục cấp 3:</label>
                                <?=get_main_item()?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(isset($config['product'][$type]['images_sub']) && $config['product'][$type]['images_sub']==true) { ?>
                    <?php
                        $photoDetail = (!empty($item['photo'])) ? UPLOAD_PRODUCT.$item['photo']:'';
                        $dimension = "Width: ".$config['product'][$type]['width_sub']." px - Height: ".$config['product'][$type]['height_sub']." px (".$config['product'][$type]['img_type_sub'].")";
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Hình đại diện <?=$config['product'][$type]['title_main_sub']?></h5>
                        </div>
                        <div class="card-body">
                            <?php include TEMPLATE.LAYOUT."image.php"; ?>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
        <?php if(isset($config['product'][$type]['seo_sub']) && $config['product'][$type]['seo_sub']==true) { ?>
            <?php $seoDB = $seo->getSeoDB($id,$com,'man_sub',$type); include TEMPLATE.LAYOUT."seo.php";?>
        <?php }?>
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-start align-items-center flex-wrap gap-3">
                    <?php include TEMPLATE.LAYOUT."actionsave.php"; ?>
                </div>
            </div>
            <div class="card-body pt-0"></div>
        </div>
    </form>
</div>