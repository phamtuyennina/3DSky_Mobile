<section class="header flex justify-between items-center">
	<div class="container ">
		<div class="row mx-0 flex justify-between items-center">
			<div class="logo">
				<a href="">
					<img src="<?=UPLOAD_PHOTO_L.$logo['photo']?>" alt="<?=$setting['ten']?>">
				</a>
			</div>
			<div class="button-header-right flex items-center justify-end">
				<a href="javascript:void(0)" class="first:ml-0">
					<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
						<path d="M12.1181 23.2362C18.2584 23.2362 23.2362 18.2584 23.2362 12.1181C23.2362 5.97773 18.2584 1 12.1181 1C5.97773 1 1 5.97773 1 12.1181C1 18.2584 5.97773 23.2362 12.1181 23.2362Z" stroke="#EAEAEA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M25 25.0002L21 21.0001" stroke="#EAEAEA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</a>
				<a href="javascript:void(0)" class="btn-open-menu">
					<svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" viewBox="0 0 40 30" fill="none">
						<line x1="1" y1="-1" x2="39" y2="-1" transform="matrix(-1 0 0 1 40 2)" stroke="#EAEAEA" stroke-width="2" stroke-linecap="round"/>
						<line x1="1" y1="-1" x2="39" y2="-1" transform="matrix(-1 2.91118e-07 2.62531e-08 1 40 14)" stroke="#EAEAEA" stroke-width="2" stroke-linecap="round"/>
						<line x1="1" y1="-1" x2="39" y2="-1" transform="matrix(-1 0 0 1 40 26)" stroke="#EAEAEA" stroke-width="2" stroke-linecap="round"/>
					</svg>
				</a>
			</div>
		</div>
		<div class="menu-header flex justify-between">
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
	</div>
</section>