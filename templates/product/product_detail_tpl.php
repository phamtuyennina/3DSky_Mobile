<section class="wrap_chiliet">
    <?php include TEMPLATE.LAYOUT."breadcrumb.php"; ?>
    <div class="container">
        <div class="row row-product-detail">
            <div class="col-7 col-lg-7">
                <div class="box-img-main">
                    <div class="photo-main">
                        <div class="slick_main">
                            <div>
                                <p>
                                    <a href="javascript:void(0)">
                                        <img src="<?=THUMBS?>/609x600x1/<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" alt="<?=$row_detail['ten'.$lang]?>">
                                    </a>
                                </p>
                            </div>
                            <?php foreach ($hinhanhsp as $v) {?>
                            <div>
                                <p>
                                    <a href="javascript:void(0)">
                                        <img src="<?=THUMBS?>/609x600x1/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>">
                                    </a>
                                </p>
                            </div>    
                            <?php }?>
                        </div>
                    </div>
                    <div class="thumb-photo-main">
                        <div class="slick_thumb">
                            <div>
                                <p>
                                    <a href="javascript:void(0)">
                                        <img src="<?=THUMBS?>/90x90x1/<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" alt="<?=$row_detail['ten'.$lang]?>">
                                    </a>
                                </p>
                            </div>
                            <?php foreach ($hinhanhsp as $v) {?>
                            <div>
                                <p>
                                    <a href="javascript:void(0)">
                                        <img src="<?=THUMBS?>/90x90x1/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>">
                                    </a>
                                </p>
                            </div>    
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="thongke-detail-info d-flex justify-content-end">
                    <div class="show-thongke d-flex align-items-center justify-content-end">
                        <p class="d-flex align-items-center mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="13" viewBox="0 0 19 13" fill="none">
                                <path d="M17.9997 6.50017C17.1497 3.95018 13.3247 0.550186 9.49973 0.550186C5.67474 0.550186 1.84975 3.95018 0.999756 6.50017" stroke="#EAEAEA" stroke-linecap="round"/>
                                <path d="M0.999804 6.49983C1.8498 9.04982 5.67479 12.4498 9.49978 12.4498C13.3248 12.4498 17.1498 9.04982 17.9998 6.49983" stroke="#EAEAEA" stroke-linecap="round"/>
                                <path d="M11.8339 6.45549C11.8339 7.75941 10.7905 8.83776 9.4996 8.83776C8.20866 8.83776 7.15796 7.75941 7.15796 6.45549C7.15796 5.15158 8.20866 4.16277 9.4996 4.16277C10.7905 4.16277 11.8339 5.15158 11.8339 6.45549Z" stroke="#EAEAEA"/>
                            </svg>
                            <span class="ml-2"><?=$row_detail['luotxem']?> views</span>
                        </p>

                        <p class="d-flex align-items-center mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">
                                <path d="M9.46476 16.1075C9.20976 16.1975 8.78976 16.1975 8.53476 16.1075C6.35976 15.365 1.49976 12.2675 1.49976 7.0175C1.49976 4.7 3.36726 2.825 5.66976 2.825C7.03476 2.825 8.24226 3.485 8.99976 4.505C9.75726 3.485 10.9723 2.825 12.3298 2.825C14.6323 2.825 16.4998 4.7 16.4998 7.0175C16.4998 12.2675 11.6398 15.365 9.46476 16.1075Z" stroke="#EAEAEA" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="ml-2"><?=$func->GetLike($row_detail['id'])?> likes</span>
                        </p>

                        <p class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="17" viewBox="0 0 18 17" fill="none">
                                <path d="M17 2.90009C17 1.57456 15.9255 0.5 14.6 0.5C13.2745 0.5 12.2 1.57456 12.2 2.90009C12.2 4.22562 13.2745 5.30018 14.6 5.30018C15.9255 5.30018 17 4.22562 17 2.90009Z" stroke="#EAEAEA"/>
                                <path d="M5.79983 8.4999C5.79983 7.17436 4.7253 6.09981 3.39979 6.09981C2.07429 6.09981 0.999756 7.17436 0.999756 8.4999C0.999756 9.82543 2.07429 10.9 3.39979 10.9C4.7253 10.9 5.79983 9.82543 5.79983 8.4999Z" stroke="#EAEAEA"/>
                                <path d="M17 14.0997C17 12.7742 15.9255 11.6996 14.6 11.6996C13.2745 11.6996 12.2 12.7742 12.2 14.0997C12.2 15.4252 13.2745 16.4998 14.6 16.4998C15.9255 16.4998 17 15.4252 17 14.0997Z" stroke="#EAEAEA"/>
                                <path d="M12.1998 3.3006L5.39966 6.90073" stroke="#EAEAEA" stroke-linecap="round"/>
                                <path d="M12.1998 13.7L5.39966 10.0999" stroke="#EAEAEA" stroke-linecap="round"/>
                            </svg>
                            <span class="ml-2">120 share</span>
                        </p>
                    </div>
                </div>
                <div class="content-detail-info">
                    <div class="tabs-pro-detail mt-4">
                        <ul class="ul-tabs-pro-detail">
                            <li class="active transition" data-tabs="info-pro-detail">Description</li>
                            <li class="transition" data-tabs="commentfb-pro-detail">Comments</li>
                            <li class="transition" data-tabs="reviews-pro-detail">Reviews</li>
                        </ul>
                        <div class="content-tabs-pro-detail info-pro-detail active"><?=htmlspecialchars_decode($row_detail['noidung'.$lang])?></div>
                        <div class="content-tabs-pro-detail commentfb-pro-detail">
                            <div class="fb-comments" data-href="<?=$func->getCurrentPageURL()?>" data-numposts="3" data-colorscheme="dark" data-width="100%"></div>
                        </div>
                        <div class="content-tabs-pro-detail reviews-pro-detail"></div>
                    </div>
                </div>
            </div>
            <div class="col-5 col-lg-5">
                <div class="info-product-detail">
                    <div class="header-info-detail">
                        <span><?=$func->get_danhmucID($row_detail['id_list'],'product_list','tenvi')?></span>
                        <h2 class="title-header-info-detail"><?=$row_detail['ten'.$lang]?></h2>
                        <div class="price-pro">
                            <?php if($row_detail['tinhtrang']==2) {?>
                            <span class="price_product"><?=$row_detail['gia']?> $</span>
                            <?php }?>
                            <span class="tinhtrang"><?=($row_detail['tinhtrang']==2)?'Pro':'Free'?></span>
                        </div>
                        <p class="policy_detail">
                            <a href="javascript:void(0)" class="d-flex align-items-center">
                                <span>Royalty Free License</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                    <rect y="0.5" width="24" height="24" rx="12" fill="white" fill-opacity="0.28"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.67928 9.958C8.39528 9.958 8.16528 9.721 8.20928 9.441C8.48428 7.74 9.78028 6.5 12.0293 6.5C14.2793 6.5 15.7963 7.86 15.7963 9.715C15.7963 11.059 15.1313 12.003 14.0063 12.688C12.9063 13.347 12.5923 13.806 12.5923 14.698V14.728C12.5923 14.8606 12.5396 14.9878 12.4458 15.0816C12.3521 15.1753 12.2249 15.228 12.0923 15.228H11.3223C11.1905 15.228 11.0641 15.176 10.9705 15.0833C10.8769 14.9906 10.8236 14.8647 10.8223 14.733L10.8193 14.533C10.7763 13.312 11.2963 12.532 12.4643 11.821C13.4943 11.189 13.8613 10.686 13.8613 9.793C13.8613 8.814 13.1033 8.095 11.9353 8.095C10.9263 8.095 10.2253 8.624 9.99728 9.497C9.93128 9.751 9.71928 9.958 9.45728 9.958H8.68028H8.67928ZM11.7003 18.5C12.3223 18.5 12.7953 18.026 12.7953 17.41C12.7953 16.792 12.3223 16.318 11.7003 16.318C11.0943 16.318 10.6133 16.792 10.6133 17.409C10.6133 18.026 11.0943 18.5 11.7003 18.5Z" fill="white"/>
                                </svg>
                            </a>
                        </p>
                    </div>
                    <hr>

                    <div class="pro_models">
                        <p class="text-content">Balance: 0 accesses to PRO models</p>
                    </div>
                    <hr>
                    <div class="info_thuoctinh">
                        <ul>
                            <li class="d-flex align-items-center <?=(empty($row_detail['platform']))?'d-none':''?>"><span>Platform :</span><p><?=$row_detail['platform']?></p></li>
                            <li class="d-flex align-items-center <?=(empty($row_detail['render']))?'d-none':''?>"><span>Render :</span><p><?=$func->get_danhmucID($row_detail['render'],'product_properties','tenvi')?></p></li>
                            <li class="d-flex align-items-center <?=(empty($row_detail['size']))?'d-none':''?>"><span>Size :</span><p><?=$row_detail['size']?></p></li>
                            <li class="d-flex align-items-center <?=(empty($row_detail['polygons']))?'d-none':''?>"><span>Polygons :</span><p><?=$row_detail['polygons']?></p></li>
                            <li class="d-flex align-items-center <?=(empty($row_detail['color']))?'d-none':''?>">
                                <span>Colors :</span>
                                <p>
                                    <?php  $mausac = explode(',',$row_detail['color']); foreach ($mausac as $v){?>
                                        <span style="--bg:#<?=$func->get_danhmucID($v,'product_properties','mau')?>" class="mr-1 !inline-block last:!mr-0"></span>
                                    <?php }?>
                                </p>
                            </li>
                            <li class="d-flex align-items-center <?=(empty($row_detail['lengh']))?'d-none':''?>"><span>Lengh :</span><p><?=$row_detail['lengh']?></p></li>
                            <li class="d-flex align-items-center <?=(empty($row_detail['width']))?'d-none':''?>"><span>Width :</span><p><?=$row_detail['width']?></p></li>
                            <li class="d-flex align-items-center <?=(empty($row_detail['height']))?'d-none':''?>"><span>Height :</span><p><?=$row_detail['height']?></p></li>
                            <li class="d-flex align-items-center <?=(empty($row_detail['style']))?'d-none':''?>"><span>Style :</span><p><?=$func->get_danhmucID($row_detail['style'],'product_properties','tenvi')?></p></li>
                            <li class="d-flex align-items-center <?=(empty($row_detail['material']))?'d-none':''?>">
                                <span>Materials :</span>
                                <p>
                                    <?php  $material = explode(',',$row_detail['material']); foreach ($material as $k => $v){?>
                                        <?=$func->get_danhmucID($v,'product_properties','tenvi')?><?=($k<count($material)-1)?', ':''?>
                                    <?php }?>
                                </p>
                            </li>
                            <li class="d-flex align-items-center <?=(empty($row_detail['form']))?'d-none':''?> !mb-0"><span>Formfactor :</span><p><img src="<?=UPLOAD_MAU_L.$func->get_danhmucID($row_detail['form'],'product_properties','photo')?>" alt=""></p></li>
                        </ul>
                    </div>
                    <div class="donw_load_file d-flex justify-content-between align-items-center">
                        <a href="javascript:void(0)" class="click_download <?=($row_detail['tinhtrang']==1)?'click_download_free':'click_download_pro'?>">
                            <i class="fal fa-long-arrow-down mr-2"></i><span><?=($row_detail['tinhtrang']==1)?'FREE DOWNLOAD':'Buy Model'?></span>
                        </a>
                        <div class="like-product like_product_click <?=(!empty($rowUser))?$func->checkLike($row_detail['id'],$rowUser['id']):''?>" data-like="<?=$row_detail['id']?>">
                            <a href="javascript:void(0)" class="" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="19" viewBox="0 0 21 19" fill="none">
                                    <path d="M11.12 18.31C10.78 18.43 10.22 18.43 9.88 18.31C6.98 17.32 0.5 13.19 0.5 6.19C0.5 3.1 2.99 0.599998 6.06 0.599998C7.88 0.599998 9.49 1.48 10.5 2.84C11.51 1.48 13.13 0.599998 14.94 0.599998C18.01 0.599998 20.5 3.1 20.5 6.19C20.5 13.19 14.02 17.32 11.12 18.31Z" stroke="#777777" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                        <p class="note_dowload" style="width: 100%;margin-top: 6px;color: red;font-style: italic;font-size: 15px;margin-bottom: -6px;display: none;"></p>
                        <input type="hidden" id="id_download" value="<?=$row_detail['id']?>">
                    </div>
                    <hr>
                    <div class="mota_product_detail">
                        <?=nl2br($row_detail['mota'.$lang])?>
                    </div>
                    <?php if(!empty($pro_tags)){?>
                    <hr>
                    <div class="tags_product_detail">
                        <p>Find models with the same tags</p>
                        <div class="show_tags">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                                <path d="M24.7488 14.1421L15.529 4.92235C15.0994 4.49273 14.4978 4.2817 13.894 4.34879L6.8936 5.12661C5.96391 5.22991 5.23 5.96382 5.1267 6.89352L4.34888 13.8939C4.28179 14.4977 4.49282 15.0993 4.92243 15.5289L14.1422 24.7487C14.9233 25.5298 16.1896 25.5298 16.9707 24.7487L24.7488 16.9706C25.5299 16.1895 25.5299 14.9232 24.7488 14.1421Z" stroke="white"/>
                                <path d="M9.13197 11.253C8.54618 10.6672 8.54618 9.71749 9.13197 9.13171C9.71775 8.54592 10.6675 8.54592 11.2533 9.13171C11.8391 9.71749 11.8391 10.6672 11.2533 11.253C10.6675 11.8388 9.71775 11.8388 9.13197 11.253Z" stroke="white"/>
                            </svg>
                            <ul>
                                <?php foreach ($pro_tags as $v) {?>
                                <li>
                                    <a href="3d-models?tag=<?=$v['id']?>"><?=$v['tenvi']?></a>
                                </li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if(!empty($product)){?>
<div class="product_lienquan">
    <div class="container">
        <h3 class="title-lienquan">Similar 3D Models</h3>
        <div class="row_lienquan">
            <div class="slick in-page" data-dots="0" data-infinite="1" data-arrows="1" data-autoplay='1' data-slidesDefault="6:1" data-lg-items='6:1' data-md-items='6:1' data-sm-items='6:1' data-xs-items="6:1" data-vertical="0">
                <?php foreach ($product as $k => $v) {?>
                    <div class="col-custom">
                        <span></span>
                        <span></span>
                        <div class="box-model">
                            <div class="like-product like_product_click <?=(!empty($rowUser))?$func->checkLike($v['id'],$rowUser['id']):''?>" data-like="<?=$v['id']?>">
                                <a href="javascript:void(0)" class="" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="19" viewBox="0 0 21 19" fill="none">
                                        <path d="M11.12 18.31C10.78 18.43 10.22 18.43 9.88 18.31C6.98 17.32 0.5 13.19 0.5 6.19C0.5 3.1 2.99 0.599998 6.06 0.599998C7.88 0.599998 9.49 1.48 10.5 2.84C11.51 1.48 13.13 0.599998 14.94 0.599998C18.01 0.599998 20.5 3.1 20.5 6.19C20.5 13.19 14.02 17.32 11.12 18.31Z" stroke="#777777" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                            <a href="<?=$v['tenkhongdauvi']?>">
                                <img class="img-block" onerror="this.src='<?=THUMBS?>/186x186x1/assets/images/noimage.png';" src="<?=THUMBS?>/186x186x1/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>">
                            </a>
                            <div class="info-box-model">
                                <h3 class="text-split-1" title="<?=$v['ten'.$lang]?>"><?=$v['ten'.$lang]?></h3>
                                <p class="show-social flex items-center">
                                    <b class="status-<?=($v['tinhtrang']==1)?'free':'pro'?>"><?=($v['tinhtrang']==1)?'FREE':'PRO'?></b>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none">
                                            <path d="M7.36175 11.1392C7.16342 11.2092 6.83675 11.2092 6.63842 11.1392C4.94675 10.5617 1.16675 8.15252 1.16675 4.06918C1.16675 2.26668 2.61925 0.80835 4.41008 0.80835C5.47175 0.80835 6.41092 1.32168 7.00008 2.11502C7.58925 1.32168 8.53425 0.80835 9.59008 0.80835C11.3809 0.80835 12.8334 2.26668 12.8334 4.06918C12.8334 8.15252 9.05342 10.5617 7.36175 11.1392Z" stroke="#EAEAEA" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <i><?=$func->GetLike($v['id'])?></i>
                                    </span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 15 14" fill="none">
                                            <path d="M14.0001 2.45015C14.0001 1.37318 13.127 0.500122 12.0501 0.500122C10.9731 0.500122 10.1001 1.37318 10.1001 2.45015C10.1001 3.52713 10.9731 4.40019 12.0501 4.40019C13.127 4.40019 14.0001 3.52713 14.0001 2.45015Z" stroke="#EAEAEA"/>
                                            <path d="M4.89998 6.99996C4.89998 5.92299 4.02694 5.04993 2.94999 5.04993C1.87304 5.04993 1 5.92299 1 6.99996C1 8.07693 1.87304 8.94999 2.94999 8.94999C4.02694 8.94999 4.89998 8.07693 4.89998 6.99996Z" stroke="#EAEAEA"/>
                                            <path d="M14.0001 11.5496C14.0001 10.4727 13.127 9.59961 12.0501 9.59961C10.9731 9.59961 10.1001 10.4727 10.1001 11.5496C10.1001 12.6266 10.9731 13.4997 12.0501 13.4997C13.127 13.4997 14.0001 12.6266 14.0001 11.5496Z" stroke="#EAEAEA"/>
                                            <path d="M10.0999 2.77551L4.57495 5.70056" stroke="#EAEAEA" stroke-linecap="round"/>
                                            <path d="M10.0999 11.2249L4.57495 8.2998" stroke="#EAEAEA" stroke-linecap="round"/>
                                        </svg>
                                        <i>250</i>
                                    </span>
                                </p>
                            </div>  
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>
<?php }?>
