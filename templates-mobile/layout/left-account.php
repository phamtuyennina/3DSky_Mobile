<div class="wrap-left-acount">
	<div class="box-avatar">
		<div class="img-avatar">
			<form id="chage-avatar">
			<p>
				<img id="img-output" onerror="this.src='<?=THUMBS?>/109x109x1/assets/images/noimage.png';" src="<?=THUMBS?>/109x109x1/<?=UPLOAD_USER_L.$rowUser['avatar']?>" alt="<?=$rowUser['ten']?>">
				<i><img src="assets/images/change_avata.svg" alt="<?=$rowUser['ten']?>"></i>
			</p>
			<input type="file" accept="image/*" onchange="loadFile(event)" id="files" name="files">
			</form>
		</div>
		<ul>
			<li><strong><?=$rowUser['ten']?></strong></li>
			<li><?=$rowUser['email']?></li>
			<li><?=$rowUser['dienthoai']?></li>
		</ul>
		<div class="show_current d-flex align-content-center">
			<div class="show_current_pro">
				<span><?=(!empty($rowUser['numpro']))?$rowUser['numpro']:0?> PRO</span>
				<div class="prohint">
					These are your PRO-accesses, you can use to purchase paid 3D models, which are marked with the “PRO” icon. One paid model costs one PRO access.
                        <br><br>
                        After clicking on the "Download for 1 PRO" button on the page of a paid model, one PRO access will be deducted from your balance, and the model becomes available for download an unlimited number of times.
                </div>
			</div>
			<div class="show_current_free">
				<span><?=$func->FreeToDay()?> FREE</span>
				<div class="prohint">
					This is the daily limit of the currently available downloads of free 3D models, which are marked with the “FREE” icon. Without a subscription, you are given the opportunity to download up to three free models per day. With a monthly subscription, you are given the opportunity to download up to 30 free models per day for a month.
                        <br><br>
                        Repeated downloads of the same free models are considered separate downloads and will reduce the daily limit.
                </div>
			</div>
		</div>
	</div>
	<div class="menu-account">
		<ul>
			<li><a href="account/profile" class="<?=($action=='profile')?'active':''?>">Profile</a></li>
			<li><a href="account/bookmarks" class="<?=($action=='bookmarks')?'active':''?>">Bookmarks</a></li>
			<li><a href="account/purchases" class="<?=($action=='purchases')?'active':''?>">Purchases</a></li>
			<li class="last:mb-0"><a href="account/logout">Logout</a></li>
		</ul>
	</div>
</div>