<?php 
    $support = $d->rawQueryOne("select noidung$lang,photo from #_static where type = ?",array('helful-infomation'));
    $httt = $d->rawQuery("select ten$lang, mota$lang, id,photo from #_news where type = ? order by stt,id desc",array('hinh-thuc-thanh-toan'));
?>
<div class="wrap_account_buy">
    <div class="container">
        
        <div class="row d-flex justify-center">
            <div class="col-8 col-lg-8">
                <div class="title-buy">
                    <h2>Models Purchase</h2>
                </div>
                <div class="user_info_buy d-flex items-center justify-between">
                    <div class="box-info-data d-flex items-center">
                        <div class="data-avatar">
                            <img src="<?=UPLOAD_USER_L.$rowUser['avatar']?>" onerror="this.src='assets/images/blank.svg';"  alt="">
                        </div>
                        <div class="data-name">
                            <p><?=(!empty($rowUser['ten']))?$rowUser['ten']:$rowUser['username']?></p>
                            <p><span>Profile status:</span> No Purchases</p>
                        </div>
                    </div>
                    <a href="account/profile"><span>View Profile</span></a>
                </div>
                <div class="row d-flex">
                    <div class="col-8 col-lg-8">
                        <form id="form_models" class="h-100">
                            <div class="order-pro h-100">
                                <div class="top-order-pro">
                                    <h3>Basket:</h3>
                                    <div class="select-pro d-flex items-center">
                                        <div class="info-select-pro">
                                            <p>Chose a number of PRO 3D Models:</p>
                                            <span>Choose between 0 and 200</span>
                                        </div>
                                        <div class="input-select-pro">
                                            <div class="wrap-input">
                                                <input type="number" name="num_pro" id="number_pro" value="0">
                                                <div class="wrap-button">
                                                    <button type="button" class="add-pro"><i class="fal fa-angle-up"></i></button>
                                                    <button type="button" class="remove-pro"><i class="fal fa-angle-down"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="select-free">
                                        <p>Availability period for FREE 3D Models:</p>
                                        <ul>
                                            <?php for($i=1;$i<=12;$i++){?>
                                            <li data-num="<?=$i?>">
                                                <span><?=$i?> month</span>
                                            </li>    
                                            <?php }?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="center-order-pro">
                                    <div class="your-choice">
                                        <h3>Your choice:</h3>
                                        <div class="show-your-choice d-flex justify-between">
                                            <div class="box-show-pro-choice">
                                                <div>
                                                    <p class="big" id="numPro"><i>0</i> Pro</p>
                                                    <span>on off</span>
                                                </div>
                                            </div>
                                            <div class="box-show-plus-choice">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                                    <rect x="9" y="0.5" width="2" height="20" fill="#EAEAEA"/>
                                                    <rect y="11.5" width="2" height="20" transform="rotate(-90 0 11.5)" fill="#EAEAEA"/>
                                                </svg>
                                            </div>
                                            <div class="box-show-free-choice">
                                                <div>
                                                    <p class="big" ><?=@$optsetting['sofree']?> Free</p>
                                                    <span id="numFree">Models per day during <i >0</i> month renewed at 00:00 GMT +4</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="payment-method">
                                        <h3>Payment method:</h3>
                                        <div class="information-cart">
                                            <div class="payments-cart custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="payments-1" checked name="payments" value="1" required>
                                                <label class="payments-label custom-control-label d-flex items-center justify-between" for="payments-1" data-payments="1">
                                                    <span>Pay with PayPal</span>
                                                    <p><img src="assets/images/img_paypal.svg" alt=""></p>
                                                </label>
                                            </div>
                                            <?php foreach($httt as $key => $value) { ?>
                                            <div class="payments-cart custom-control custom-radio last:!mb-0">
                                                <input type="radio" class="custom-control-input" id="payments-<?=$value['id']?>" name="payments" value="<?=$value['id']?>" required>
                                                <label class="payments-label custom-control-label d-flex items-center justify-between" for="payments-<?=$value['id']?>" data-payments="<?=$value['id']?>">
                                                    <span><?=$value['ten'.$lang]?></span>
                                                    <p><img src="<?=UPLOAD_NEWS_L.$value['photo']?>" alt=""></p>
                                                </label>
                                                <div class="payments-info payments-info-<?=$value['id']?> transition"><?=str_replace("\n","<br>",$value['mota'.$lang])?></div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom-order-pro">
                                    <h3>Amount to pay: <span id="load_price">14$</span></h3>
                                    <p>By clicking "Pay" you agree to <a href="terms-of-use" target="_blank">The Terms of Use for Customers</a> and agree to <a href="privacy-policy" target="_blank">The Privacy policy</a></p>
                                    <button type="button" disabled id="pay_models">PAY</button>
                                </div>
                            </div>
                            <input type="hidden" name="price_pro" id="price_pro" value="<?=@$optsetting['giapro']?>">
                            <input type="hidden" name="price_free" id="price_free" value="<?=@$optsetting['giafree']?>">
                            <input type="hidden" name="num_free" id="num_free" value="0">
                            <input type="hidden" name="total_model" id="total_model" value="0">
                            <input type="hidden" name="id_user" value="<?=$rowUser['id']?>">
                            <input type="hidden" name="email" value="<?=$rowUser['email']?>">
                            <input type="hidden" name="ten" value="<?=(!empty($rowUser['ten']))?$rowUser['ten']:$rowUser['username']?>">
                            <input type="hidden" name="dienthoai" value="<?=$rowUser['dienthoai']?>">
                        </form>
                    </div>
                    <div class="col-4 col-lg-4">
                        <div class="box-helful-infomation h-100">
                            <h3>helful infomation</h3>
                            <div class="noidung-helful-infomation"><?=htmlspecialchars_decode($support['noidung'.$lang])?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="<?=$config['paypal']['url']?>" method="post" id="form_paypal">
    <input type="hidden" name="business" value="<?=$config['paypal']['id']?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" id="txt_name_paypal" name="item_name" value="">
    <input type="hidden" name="item_number" value="1">
    <input type="hidden" id="total_paypal" name="amount" value="">
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="no_note" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="cancel_return" value="<?=$config['paypal']['cancel_return']?>">
    <input type="hidden" name="return" value="<?=$config['paypal']['return']?>">
    <input type="hidden" name="notify_url" value="<?=$config['paypal']['notify_url']?>">
</form>