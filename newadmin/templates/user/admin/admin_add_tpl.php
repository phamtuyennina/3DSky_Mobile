<?php
	if($_GET['changepass'] == 1) $changepass = "&changepass=1";
	else $changepass = "";
    $linkSave = "index.php?com=user&act=admin_edit".$changepass;
?>
<div class="content-inner container-fluid pb-0" id="page_layout">
	<form method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
		<div class="row">
			<div class="col-lg-12 mb-4">
				<div class="card mb-0">
					<div class="card-header">
						<div class="d-flex justify-start align-items-center flex-wrap gap-3">
							<?php include TEMPLATE.LAYOUT."saveelement.php"; ?>
						</div>
					</div>
					<div class="card-body pt-0"></div>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h5 class="mb-0">Thông tin admin</h5>
					</div>
					<div class="card-body">
						<div class="row">
							<?php if(isset($changepass) && $changepass==true) { ?>
							<div class="form-group last:mb-0 col-xl-4 col-lg-6 col-md-6">
								<label class="form-label" for="old-password">Mật khẩu cũ:</label>
								<input type="password" class="form-control" name="old-password" id="old-password" placeholder="Mật khẩu cũ">
							</div>
							<div class="form-group last:mb-0 col-xl-4 col-lg-6 col-md-6">
								<label class="form-label" for="new-password">
									<span class="d-inline-block align-middle">Mật khẩu mới:</span>
									<span class="text-danger ml-2" id="show-password"></span>
								</label>
								<div class="row align-items-center">
									<div class="col-6"><input type="password" class="form-control" name="new-password" id="new-password" placeholder="Mật khẩu mới"></div>
									<div class="col-6"><a class="btn btn-success flex items-center justify-center text-sm" href="#" onclick="randomPassword()"><i class="fas fa-random mr-2"></i>Tạo mật khẩu</a></div>
								</div>
							</div>
							<div class="form-group last:mb-0 col-xl-4 col-lg-6 col-md-6">
								<label class="form-label" for="renew-password">Nhập lại mật khẩu mới:</label>
								<input type="password" class="form-control" name="renew-password" id="renew-password" placeholder="Nhập lại mật khẩu mới">
							</div>
							<?php }else{?>
							<div class="form-group last:mb-0 col-xl-4 col-lg-6 col-md-6">
								<label class="form-label" for="username">Tài khoản: <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="data[username]" id="username" placeholder="Tài khoản" value="<?=@$item['username']?>" required>
							</div>
							<div class="form-group last:mb-0 col-xl-4 col-lg-6 col-md-6">
								<label class="form-label" for="ten">Họ tên: <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="data[ten]" id="ten" placeholder="Họ tên" value="<?=@$item['ten']?>" required>
							</div>
							<div class="form-group last:mb-0 col-xl-4 col-lg-6 col-md-6">
								<label class="form-label" for="email">Email:</label>
								<input type="email" class="form-control" name="data[email]" id="email" placeholder="Email" value="<?=@$item['email']?>">
							</div>
							<div class="form-group last:mb-0 col-xl-4 col-lg-6 col-md-6">
								<label class="form-label" for="dienthoai">Điện thoại:</label>
								<input type="text" class="form-control" name="data[dienthoai]" id="dienthoai" placeholder="Điện thoại" value="<?=@$item['dienthoai']?>">
							</div>
							<div class="form-group last:mb-0 col-xl-4 col-lg-6 col-md-6">
								<label class="form-label" for="gioitinh">Giới tính:</label>
								<select class="form-select" name="data[gioitinh]" id="gioitinh">
									<option value="0">Chọn giới tính</option>
									<option <?=(@$item['gioitinh']==1)?"selected":""?> value="1">Nam</option>
									<option <?=(@$item['gioitinh']==2)?"selected":""?> value="2">Nữ</option>
								</select>
							</div>
							<div class="form-group last:mb-0 col-xl-4 col-lg-6 col-md-6">
								<label class="form-label" for="ngaysinh">Ngày sinh:</label>
								<input type="date" class="form-control" name="data[ngaysinh]" id="ngaysinh" placeholder="Ngày sinh" value="<?=(@$item['ngaysinh'])?date('d/m/Y',@$item['ngaysinh']):"";?>" >
							</div>
							<div class="form-group last:mb-0 col-xl-4 col-lg-6 col-md-6">
								<label class="form-label" for="diachi">Địa chỉ:</label>
								<input type="text" class="form-control" name="data[diachi]" id="diachi" placeholder="Địa chỉ" value="<?=@$item['diachi']?>">
							</div>
							<?php }?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<div class="row pe-4 d-flex align-items-center justify-content-center justify-content-md-between">
							<?php include TEMPLATE.LAYOUT."saveelement.php"; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</form>
</div>


<!-- User js -->
<script type="text/javascript">
	function randomPassword()
	{
		var chuoi = "";
		for(i=0;i<9;i++)
		{
			chuoi += "!@#$%^&*()?abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890".charAt(Math.floor(Math.random()*62));
		}
		jQuery('#new-password').val(chuoi);
		jQuery('#renew-password').val(chuoi);
		jQuery('#show-password').html(chuoi);
	}
</script>