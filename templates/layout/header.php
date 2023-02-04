<section class="header flex justify-between items-center">
	<div class="container ">
		<div class="row flex justify-between items-center">
			<div class="logo">
				<a href="">
					<img src="<?=UPLOAD_PHOTO_L.$logo['photo']?>" alt="<?=$setting['ten']?>">
				</a>
			</div>
			<div class="menu-header flex justify-between">
				<ul class="flex items-center justify-between">
					<li class="show-3d-model">
						<a href="3d-models">
							<span class="text-clolor font-bold">3D Models</span>
							<svg xmlns="http://www.w3.org/2000/svg" width="12" height="6" viewBox="0 0 12 6" fill="none" class="ml-1">
								<path d="M11 0.5L6.70711 4.79289C6.31658 5.18342 5.68342 5.18342 5.29289 4.79289L1 0.5" stroke="url(#paint0_linear_512_5735)" stroke-linecap="round"/>
								<defs>
									<linearGradient id="paint0_linear_512_5735" x1="7.7649" y1="4.10121" x2="6.62736" y2="1.26348" gradientUnits="userSpaceOnUse">
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
						</a>
						<?php if(!empty($splistmenu)){?>
						<div class="menu-page-hover">
							<div class="show-dropdown-menu">
								<div class="row relative z-10 bg-black flex m-0">
									<div class="col-3 col-sm-3 col-md-3 p-0">
										<div class="dropdown-menu-left">
											<ul>
												<?php foreach ($splistmenu as $k => $v) {?>
												<li class="last:mb-0 <?=($k==0)?'active':''?>">
													<a href="3d-models?list=<?=$v['tenkhongdauvi']?>" class="flex items-center">
														<span class="mr-1">
															<img src="<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten']?>">
														</span>
														<?=$v['ten']?>
													</a>
												</li>
												<?php }?>
											</ul>
										</div>
									</div>
									<div class="col-9 col-sm-9 col-md-9 p-0">
										<div class="show-dropdown-menu-right">
											<?php foreach ($splistmenu as $k => $v) {
												$spcatmenu = $d->rawQuery("SELECT ten$lang as ten, tenkhongdauvi, tenkhongdauen, id FROM #_product_cat WHERE hienthi=1 AND id_list = ? ORDER BY stt,id DESC",array($v['id']));
											?>
											<div class="tabs-menu-right tabs-menu-right_<?=$k?> <?=($k==0)?'active':''?>">
												<h2><?=$v['ten']?></h2>
												<div class="row">
													<?php foreach ($spcatmenu as $v_cat) {?>
													<div class="<?=(count($spcatmenu)>6)?'col-4 col-sm-4 col-md-4':'col-12 col-sm-12 col-md-12'?>">
														<p><a href="3d-models?list=<?=$v['tenkhongdauvi']?>&cat=<?=$v_cat['tenkhongdauvi']?>"><?=$v_cat['ten']?></a></p>
													</div>
													<?php }?>
												</div>
											</div>
											<?php }?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php }?>
					</li>
					<li>
						<a href="account/buy">
							<span>BUY</span>
						</a>
					</li>
					<li>
						<a href="support"><span>SUPPORT</span></a>
					</li>
				</ul>
				<div class="search-header">
					<span></span>
					<form action="3d-models" class="flex justify-between items-center">
						<select name="list" id="select_cat">
							<option value="">3D Models</option>
							<?php foreach($splistmenu as $k => $v){?>
								<option value="<?=$v['tenkhongdauvi']?>"><?=$v['ten']?></option>
							<?php }?>
						</select>
						<input type="text" name="keyword" placeholder="Search 3D models, textures, materials,...">
						<button type="submit">
							<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
								<path d="M10.2651 19.1301C15.382 19.1301 19.5301 14.982 19.5301 9.86504C19.5301 4.74809 15.382 0.599976 10.2651 0.599976C5.14811 0.599976 1 4.74809 1 9.86504C1 14.982 5.14811 19.1301 10.2651 19.1301Z" stroke="#2D2A2A" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M21.0001 20.6001L17.6667 17.2667" stroke="#2D2A2A" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</button>		
					</form>
				</div>
			</div>
			
			<div class="account-header">
				<?php if(empty($rowUser)){?>
				<p class="no-login flex items-center justify-between">
					<a href="account/login"><span>Login</span></a>
					<a href="account/sign-up" class="last:ml-0"><span>SIGN UP</span></a>
				</p>
				<?php }else{?>
					<div class="show_user_login d-flex justify-end items-center position-static" >
						<div class="d-flex justify-end items-center position-static" id="dropdownMenuUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<div class="sky-avatar-frame">
								<img src="<?=UPLOAD_USER_L.$rowUser['avatar']?>" onerror="this.src='assets/images/blank.svg';"  alt="">
							</div>
							<div class="avatar-name" >
								<span class="mr-2"><?=$rowUser['username']?></span>
								<svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg"><path _ngcontent-ksx-c14="" fill-rule="evenodd" clip-rule="evenodd" d="M0.146447 0.146447C0.341709 -0.0488155 0.658291 -0.0488155 0.853553 0.146447L4.5 3.79289L8.14645 0.146447C8.34171 -0.0488155 8.65829 -0.0488155 8.85355 0.146447C9.04882 0.341709 9.04882 0.658291 8.85355 0.853553L4.85355 4.85355C4.65829 5.04882 4.34171 5.04882 4.14645 4.85355L0.146447 0.853553C-0.0488155 0.658291 -0.0488155 0.341709 0.146447 0.146447Z" fill="currentColor"></path></svg>
							</div>
						</div>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuUser">
							<div class="avatar-dropdown">
								<div class="dropdown-name"><span><?=$rowUser['username']?></span></div>
								<div class="dropdown-mail"><?=$rowUser['email']?></div>
								<div class="_ngcontent-jql-c58"><a href="account/profile">Profile</a></div>
								<div class="_ngcontent-jql-c58"><a href="account/purchases">Purchases</a></div>
								<div class="_ngcontent-jql-c58"><a href="account/logout">Log out</a></div>
								<div class="_ngcontent-jql-c58" class="d-none"><a href="account/logout"></a></div>
							</div>
						</div>
					</div>	
				<?php }?>
			</div>
		</div>
	</div>
</section>