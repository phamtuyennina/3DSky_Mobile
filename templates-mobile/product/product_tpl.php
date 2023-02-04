<svg class="!hidden">
    <defs>
        <linearGradient id="paint0_linear_127_11528" x1="4.2351" y1="1.89879" x2="5.37264" y2="4.73652" gradientUnits="userSpaceOnUse">
        <stop stop-color="#00B9B9"/>
        <stop offset="0.1337" stop-color="#00B3BC"/>
        <stop offset="0.3176" stop-color="#00A1C6"/>
        <stop offset="0.5307" stop-color="#0084D6"/>
        <stop offset="0.7637" stop-color="#005CEC"/>
        <stop offset="0.9424" stop-color="#0038FF"/>
        <stop offset="1" stop-color="#0038FF"/>
        </linearGradient>
    </defs>
</svg>

<div class="wrap-product py-[40px]">
    <form id="search_product">
        <div class="container flex">
            <div class="col-search-product ">
                <div class="close-mmenu-search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
                        <path d="M33 33L1 1" stroke="#9A9A9A" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M33 1L1 33" stroke="#9A9A9A" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="data-scrollbar">
                    <?php include TEMPLATE.LAYOUT."search.php"; ?>
                </div>
            </div>
            <div class="col-right-product">
                <div class="top-right-product mb-3 w-full">
                    <div class="row flex-1 justify-between">
                        <div class="col-12 col-lg-12 top-right-product-order flex justify-end items-center">
                            <div class="ssort flex items-center">
                                <span>Sort by:</span>
                                <div class="drowsort" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="order-by" data-order='<?=$order_by['key']?>'><?=$order_by['text']?></span>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item change-order" data-order='staff-pick' href="javascript:void(0)">Staff Pick</a>
                                    <a class="dropdown-item change-order" data-order='newets' href="javascript:void(0)">Newets</a>
                                    <a class="dropdown-item change-order" data-order='most-relevant' href="javascript:void(0)">Most Relevant</a>
                                    <a class="dropdown-item change-order" data-order='most-popula' href="javascript:void(0)">Most Popula</a>
                                </div>
                            </div>
                            <button type="button"><span>Upload Model</span></button>
                        </div>
                    </div>
                </div> 
                <div id="ajax_product">
                    <div class="show_produts mt-4">
                        <p class="found-product mb-3"><span class="font-semibold"><?=$total?></span> models found</p>
                        <div class="grid grid-cols-2">
                            <?php foreach ($product as $k => $v) {?>
                            <div class="col-custom product-information">
                                <span></span>
                                <span></span>
                                <div class="box-model content_tooltip">
                                    <div class="like-product like_product_click <?=(!empty($rowUser))?$func->checkLike($v['id'],$rowUser['id']):''?>" data-like="<?=$v['id']?>">
                                        <a href="javascript:void(0)" class="" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="19" viewBox="0 0 21 19" fill="none">
                                                <path d="M11.12 18.31C10.78 18.43 10.22 18.43 9.88 18.31C6.98 17.32 0.5 13.19 0.5 6.19C0.5 3.1 2.99 0.599998 6.06 0.599998C7.88 0.599998 9.49 1.48 10.5 2.84C11.51 1.48 13.13 0.599998 14.94 0.599998C18.01 0.599998 20.5 3.1 20.5 6.19C20.5 13.19 14.02 17.32 11.12 18.31Z" stroke="#777777" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                                    <a href="<?=$v['tenkhongdauvi']?>">
                                        <img class="img-block" onerror="this.src='<?=THUMBS?>/180x180x1/assets/images/noimage.png';" src="<?=THUMBS?>/600x600x1/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>">
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
                    <?php if($lastpage>1){?>
                    <div class="botttom_product mt-5 flex justify-between items-center">
                        <div class="button-page">
                            <a href="<?=$url?>&p=<?=(($curPage<=$lastpage) && ($curPage>1))?($curPage-1):1?>" class="<?=($curPage>1)?'click-page':'no-click'?>">
                                <span><i class="fal mr-1 fa-long-arrow-left"></i> Previous page</span>
                            </a>
                            <a href="<?=$url?>&p=<?=(( ($curPage<$lastpage))?($curPage+1):1)?>" class="last:!mr-0 <?=($curPage<$lastpage)?'click-page':'no-click'?>">
                                <span>Previous page <i class="fal ml-1 fa-long-arrow-right"></i></span>
                            </a>
                        </div>
                        <div class="input-page flex justify-end items-center">
                            Page
                            <input type="number" class="mx-3" onkeyup="if((this.value><?=$lastpage?> || this.value<1)) this.value=1;" id="page-input" value="<?=$curPage?>">
                            of <?=$lastpage?>
                            <button type="button"><span><i class="fal fa-long-arrow-right"></i></span></button>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </form>
</div>
<div id="tooltip"></div>