<?php
	$linkSave = "index.php?com=setting&act=save";
	$options = json_decode($item['options'],true);
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
            <div class="col-12">
            	<?php if($config['website']['debug-developer']) { ?>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Cấu Hình Email</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
							<div class="custom-control custom-radio d-inline-block me-4 text-md">
								<input class="custom-control-input mailertype form-check-input" type="radio" id="mailertype-host" name="data[options][mailertype]" <?=($options['mailertype']==1 || $options['mailertype']==0)?"checked":""?> value="1">
								<label for="mailertype-host" class="custom-control-label form-check-label font-weight-normal capitalize">Host email</label>
							</div>
							<div class="custom-control custom-radio d-inline-block text-md">
								<input class="custom-control-input mailertype form-check-input" type="radio" id="mailertype-gmail" name="data[options][mailertype]" <?=($options['mailertype']==2)?"checked":""?> value="2">
								<label for="mailertype-gmail" class="custom-control-label font-weight-normal capitalize form-check-label">Gmail email</label>
							</div>
						</div>
						<div class="host-email <?=($options['mailertype']==1 || $options['mailertype']==0)?'d-block':'d-none'?>">
							<div class="row">
								<div class="form-group last:mb-0 col-md-4 col-sm-6">
									<label for="ip_host" class="form-label">Host:</label>
									<input type="text" class="form-control" name="data[options][ip_host]" id="ip_host" placeholder="Host" value="<?=$options['ip_host']?>">
								</div>
								<div class="form-group last:mb-0 col-md-4 col-sm-6">
									<label for="port_host" class="form-label">Port:</label>
									<input type="text" class="form-control" name="data[options][port_host]" id="port_host" placeholder="Port" value="<?=$options['port_host']?>">
								</div>
								<div class="form-group last:mb-0 col-md-4 col-sm-6 form-group-category">
									<label for="secure_host" class="form-label">Secure:</label>
									<select class="form-control select2-basic-single js-states" id="select_secure_host" name="data[options][secure_host]" id="secure_host">
										<option <?=($options['secure_host']=='tls')?'selected':''?> value="tls">TLS</option>
										<option <?=($options['secure_host']=='ssl')?'selected':''?> value="ssl">SSL</option>
									</select>
								</div>
								<div class="form-group md:!mb-0 col-md-4 col-sm-6">
									<label for="email_host" class="form-label">Email host:</label>
									<input type="text" class="form-control" name="data[options][email_host]" id="email_host" placeholder="Email host" value="<?=$options['email_host']?>">
								</div>
								<div class="form-group last:mb-0 col-md-4 col-sm-6">
									<label for="password_host" class="form-label">Password host:</label>
									<input type="text" class="form-control" name="data[options][password_host]" id="password_host" placeholder="Password host" value="<?=$options['password_host']?>">
								</div>
							</div>
						</div>
						<div class="gmail-email <?=($options['mailertype']==2)?'d-block':'d-none'?>">
							<div class="row">
								<div class="form-group last:mb-0 col-md-4 col-sm-6">
									<label for="host_gmail" class="form-label">Host:</label>
									<input type="text" class="form-control" name="data[options][host_gmail]" id="host_gmail" placeholder="Host" value="<?=$options['host_gmail']?>">
								</div>
								<div class="form-group last:mb-0 col-md-4 col-sm-6">
									<label for="port_gmail" class="form-label">Port:</label>
									<input type="text" class="form-control" name="data[options][port_gmail]" id="port_gmail" placeholder="Port" value="<?=$options['port_gmail']?>">
								</div>
								<div class="form-group last:mb-0 col-md-4 col-sm-6 form-group-category">
									<label for="secure_gmail" class="form-label">Secure:</label>
									<select class="form-control select2-basic-single js-states" id="select_secure_gmail" name="data[options][secure_gmail]" id="secure_gmail">
										<option <?=($options['secure_gmail']=='tls')?'selected':''?> value="tls">TLS</option>
										<option <?=($options['secure_gmail']=='ssl')?'selected':''?> value="ssl">SSL</option>
									</select>
								</div>
								<div class="form-group md:!mb-0 col-md-4 col-sm-6">
									<label for="email_gmail" class="form-label">Email:</label>
									<input type="text" class="form-control" name="data[options][email_gmail]" id="email_gmail" placeholder="Email" value="<?=$options['email_gmail']?>">
								</div>
								<div class="form-group last:mb-0 col-md-4 col-sm-6">
									<label for="password_gmail" class="form-label">Password:</label>
									<input type="text" class="form-control" name="data[options][password_gmail]" id="password_gmail" placeholder="Password" value="<?=$options['password_gmail']?>">
								</div>
							</div>
						</div>
                    </div>
                </div>
            	<?php }?>
            	<div class="card">
            		<div class="card-header">
            			<h5 class="mb-0">Thông tin chung</h5>
            		</div>
            		<div class="card-body">
            			<?php if(count($config['website']['lang'])>1) { ?>
							<div class="form-group">
								<label class="form-label mb-0">Ngôn ngữ mặc định:</label>
								<div class="form-group d-inline-block ms-2 mb-0">
									<?php foreach($config['website']['lang'] as $k => $v) { ?>
										<div class="custom-control custom-radio d-inline-block mr-3 text-md">
											<input class="custom-control-input form-check-input" type="radio" id="lang_default-<?=$k?>" name="data[options][lang_default]" <?=($k=='vi')?"checked":($k==$options['lang_default'])?"checked":""?> value="<?=$k?>">
											<label for="lang_default-<?=$k?>" class="custom-control-label font-weight-normal form-check-label"><?=$v?></label>
										</div>
									<?php } ?>
								</div>
							</div>
						<?php } ?>

                        <div class="card card-article mb-3">
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
											<input type="text" class="form-control for-seo" name="data[ten<?=$k?>]" id="ten<?=$k?>" placeholder="Tiêu đề (<?=$k?>)" value="<?=$item['ten'.$k]?>" <?=($k=='vi')?'required':''?>>
										</div>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                        </div>

						<div class="row">
							<?php if(isset($config['setting']['slogan']) && $config['setting']['slogan']==true) { ?>
								<div class="form-group col-md-4 col-sm-6">
									<label class="form-label" for="slogan">Slogan:</label>
									<input type="text" class="form-control" name="data[options][slogan]" id="slogan" placeholder="Slogan" value="<?=@$options['slogan']?>">
								</div>
							<?php } ?>
							<?php if(isset($config['setting']['diachi']) && $config['setting']['diachi']==true) { ?>
								<div class="form-group col-md-4 col-sm-6">
									<label class="form-label" for="diachi">Địa chỉ:</label>
									<input type="text" class="form-control" name="data[options][diachi]" id="diachi" placeholder="Địa chỉ" value="<?=@$options['diachi']?>">
								</div>
							<?php } ?>
							<?php if(isset($config['setting']['email']) && $config['setting']['email']==true) { ?>
								<div class="form-group col-md-4 col-sm-6">
									<label class="form-label" for="email">Email:</label>
									<input type="email" class="form-control" name="data[options][email]" id="email" placeholder="Email" value="<?=@$options['email']?>">
								</div>
							<?php } ?>
							<?php if(isset($config['setting']['hotline']) && $config['setting']['hotline']==true) { ?>
								<div class="form-group col-md-4 col-sm-6">
									<label class="form-label" for="hotline">Hotline:</label>
									<input type="text" class="form-control" name="data[options][hotline]" id="hotline" placeholder="Hotline" value="<?=@$options['hotline']?>">
								</div>
							<?php } ?>
							<?php if(isset($config['setting']['hotline1']) && $config['setting']['hotline1']==true) { ?>
								<div class="form-group col-md-4 col-sm-6">
									<label class="form-label" for="hotline1">Hotline 2:</label>
									<input type="text" class="form-control" name="data[options][hotline1]" id="hotline1" placeholder="Hotline" value="<?=@$options['hotline1']?>">
								</div>
							<?php } ?>
							<?php if(isset($config['setting']['hotline2']) && $config['setting']['hotline2']==true) { ?>
								<div class="form-group col-md-4 col-sm-6">
									<label class="form-label" for="hotline2">Hotline 3:</label>
									<input type="text" class="form-control" name="data[options][hotline2]" id="hotline2" placeholder="Hotline" value="<?=@$options['hotline2']?>">
								</div>
							<?php } ?>
							<?php if(isset($config['setting']['dienthoai']) && $config['setting']['dienthoai']==true) { ?>
								<div class="form-group col-md-4 col-sm-6">
									<label class="form-label" for="dienthoai">Điện thoại:</label>
									<input type="text" class="form-control" name="data[options][dienthoai]" id="dienthoai" placeholder="Điện thoại" value="<?=@$options['dienthoai']?>">
								</div>
							<?php } ?>
							<?php if(isset($config['setting']['zalo']) && $config['setting']['zalo']==true) { ?>
								<div class="form-group col-md-4 col-sm-6">
									<label class="form-label" for="zalo">Zalo:</label>
									<input type="text" class="form-control" name="data[options][zalo]" id="zalo" placeholder="Zalo" value="<?=@$options['zalo']?>">
								</div>
							<?php } ?>
							<?php if(isset($config['setting']['oaidzalo']) && $config['setting']['oaidzalo']==true) { ?>
								<div class="form-group col-md-4 col-sm-6">
									<label class="form-label" for="oaidzalo">OAID Zalo:</label>
									<input type="text" class="form-control" name="data[options][oaidzalo]" id="oaidzalo" placeholder="OAID Zalo" value="<?=@$options['oaidzalo']?>">
								</div>
							<?php } ?>
							<?php if(isset($config['setting']['website']) && $config['setting']['website']==true) { ?>
								<div class="form-group col-md-4 col-sm-6">
									<label class="form-label" for="website">Website:</label>
									<input type="text" class="form-control" name="data[options][website]" id="website" placeholder="Website" value="<?=@$options['website']?>">
								</div>
							<?php } ?>
							<?php if(isset($config['setting']['fanpage']) && $config['setting']['fanpage']==true) { ?>
								<div class="form-group col-md-4 col-sm-6">
									<label class="form-label" for="fanpage">Fanpage:</label>
									<input type="text" class="form-control" name="data[options][fanpage]" id="fanpage" placeholder="Fanpage" value="<?=@$options['fanpage']?>">
								</div>
							<?php } ?>


							<?php if(isset($config['setting']['sofree']) && $config['setting']['sofree']==true) { ?>
								<div class="form-group col-md-4 col-sm-6">
									<label class="form-label" for="sofree">Free/Month:</label>
									<input type="text" class="form-control" name="data[options][sofree]" id="sofree" placeholder="Free/Month" value="<?=@$options['sofree']?>">
								</div>
							<?php } ?>
							<?php if(isset($config['setting']['giafree']) && $config['setting']['giafree']==true) { ?>
								<div class="form-group col-md-4 col-sm-6">
									<label class="form-label" for="giafree">Free Price:</label>
									<input type="text" class="form-control" name="data[options][giafree]" id="giafree" placeholder="Free Price" value="<?=@$options['giafree']?>">
								</div>
							<?php } ?>

							<?php if(isset($config['setting']['giapro']) && $config['setting']['giapro']==true) { ?>
								<div class="form-group col-md-4 col-sm-6">
									<label class="form-label" for="giapro">Pro Price:</label>
									<input type="text" class="form-control" name="data[options][giapro]" id="giapro" placeholder="Pro Price" value="<?=@$options['giapro']?>">
								</div>
							<?php } ?>

							<?php if(isset($config['setting']['toado']) && $config['setting']['toado']==true) { ?>
								<div class="form-group last:mb-0 col-md-4 col-sm-6">
									<label class="form-label" for="toado">Tọa độ google map:</label>
									<input type="text" class="form-control" name="data[options][toado]" id="toado" placeholder="Tọa độ google map" value="<?=@$options['toado']?>">
								</div>
							<?php } ?>
							<?php if(isset($config['setting']['toado_iframe']) && $config['setting']['toado_iframe']==true) { ?>
							<div class="form-group last:mb-0">
								<label class="form-label" for="toado_iframe">
									<span>Tọa độ google map iframe:</span>
									<a class="text-sm font-weight-normal ml-1" href="https://www.google.com/maps" target="_blank" title="Lấy mã nhúng google map">(Lấy mã nhúng)</a>
								</label>
								<textarea class="form-control" name="data[options][toado_iframe]" id="toado_iframe" rows="5" placeholder="Tọa độ google map iframe"><?=(!empty($options['toado_iframe'])) ? htmlspecialchars_decode($options['toado_iframe']):''?></textarea>
							</div>
							<?php } ?>
							<div class="form-group last:mb-0">
								<label class="form-label" for="analytics">Google analytics:</label>
								<textarea class="form-control" name="data[analytics]" id="analytics" rows="5" placeholder="Google analytics"><?=htmlspecialchars_decode(@$item['analytics'])?></textarea>
							</div>
							<div class="form-group last:mb-0">
								<label class="form-label" for="mastertool">Google Webmaster Tool:</label>
								<textarea class="form-control" name="data[mastertool]" id="mastertool" rows="5" placeholder="Google Webmaster Tool"><?=htmlspecialchars_decode(@$item['mastertool'])?></textarea>
							</div>
							<div class="form-group last:mb-0">
								<label class="form-label" for="headjs">Head JS:</label>
								<textarea class="form-control" name="data[headjs]" id="headjs" rows="5" placeholder="Head JS"><?=htmlspecialchars_decode(@$item['headjs'])?></textarea>
							</div>
							<div class="form-group last:mb-0">
								<label class="form-label" for="bodyjs">Body JS:</label>
								<textarea class="form-control" name="data[bodyjs]" id="bodyjs" rows="5" placeholder="Body JS"><?=htmlspecialchars_decode(@$item['bodyjs'])?></textarea>
							</div>
						</div>
            		</div>
            	</div>
            </div>
        </div>
        
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
<!-- Setting js -->
<script type="text/javascript">
	$(document).ready(function(){
		$(".mailertype").click(function(){
			var value = parseInt($(this).val());

			if(value == 1)
			{
				$(".host-email").removeClass("d-none");
				$(".host-email").addClass("d-block");
				$(".gmail-email").removeClass("d-block");
				$(".gmail-email").addClass("d-none");
			}
			if(value == 2)
			{
				$(".gmail-email").removeClass("d-none");
				$(".gmail-email").addClass("d-block");
				$(".host-email").removeClass("d-block");
				$(".host-email").addClass("d-none");
			}
		})
	})
</script>