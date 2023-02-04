<!-- SEO -->
<?php
    if($com == "static" || $com == "seopage")
    {
        foreach($config['website']['comlang'] as $k => $v)
        {
            if($type == $k)
            {
                $slugurlArray = $v;
                break;
            }
        }
    }
    $seo_create = '';
?>


<div class="card card-seo pb-0">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">
        <h5 class="mb-0">Thông tin Seo <?=$config['static'][$type]['title_main']?></h5>
        <a class="btn btn btn-success flex items-center justify-center create-seo" title="Tạo SEO">Tạo SEO</a>
    </div>
    <div class="card-body">
        <div class="bd-example">
            <div class="card card-seo mb-0">
                <div class="card-header p-0">
                    <nav class="tab-bottom-bordered">
                        <div class="mb-0 nav nav-tabs" id="nav-tab1" role="tablist">
                            <?php foreach($config['website']['lang'] as $k => $v) {$seo_create .= $k.","; ?>
                            <button class="nav-link <?=($k=='vi')?'active':''?>" id="tabs-lang-seo" data-bs-toggle="tab" data-bs-target="#tabs-lang-seo-<?=$k?>" type="button" role="tab" aria-controls="tabs-lang-seo-<?=$k?>" aria-selected="true">SEO <?=$v?></button>
                            <?php }?>
                        </div>
                    </nav>
                </div>
                <div class="card-body">
                    <div class="tab-content iq-tab-fade-up" id="nav-tabContent">
                        <?php foreach($config['website']['lang'] as $k => $v) { ?>
                        <div class="tab-pane fade <?=($k=='vi')?'active show':''?>" id="tabs-lang-seo-<?=$k?>" role="tabpanel" aria-labelledby="tabs-lang-seo-<?=$k?>-tab">
                            <div class="form-group">
                                <div class="label-seo">
                                    <label class="form-label" for="title<?=$k?>">SEO Title (<?=$k?>):</label>
                                    <span class="count-seo text-xs text-red-800 font-medium"><span><?=strlen(utf8_decode($seoDB['title'.$k]))?></span>/70 ký tự</span>
                                </div>
                                <input type="text" class="form-control check-seo title-seo" name="dataSeo[title<?=$k?>]" id="title<?=$k?>" placeholder="SEO Title (<?=$k?>)" value="<?=$seoDB['title'.$k]?>">
                            </div>
                            <div class="form-group">
                                <div class="label-seo">
                                    <label class="form-label" for="keywords<?=$k?>">SEO Keywords (<?=$k?>):</label>
                                    <span class="count-seo text-xs text-red-800 font-medium"><span><?=strlen(utf8_decode($seoDB['keywords'.$k]))?></span>/70 ký tự</span>
                                </div>
                                <input type="text" class="form-control check-seo keywords-seo" name="dataSeo[keywords<?=$k?>]" id="keywords<?=$k?>" placeholder="SEO Keywords (<?=$k?>)" value="<?=$seoDB['keywords'.$k]?>">
                            </div>
                            <div class="form-group mb-0">
                                <div class="label-seo">
                                    <label class="form-label" for="description<?=$k?>">SEO Description (<?=$k?>):</label>
                                    <span class="count-seo text-xs text-red-800 font-medium"><span><?=strlen(utf8_decode($seoDB['description'.$k]))?></span>/160 ký tự</span>
                                </div>
                                <textarea class="form-control check-seo description-seo" name="dataSeo[description<?=$k?>]" id="description<?=$k?>" rows="5" placeholder="SEO Description (<?=$k?>)"><?=$seoDB['description'.$k]?></textarea>
                            </div>
                            <input type="hidden" id="seo-create" value="<?=($seo_create) ? rtrim($seo_create,",") : ''?>">
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

