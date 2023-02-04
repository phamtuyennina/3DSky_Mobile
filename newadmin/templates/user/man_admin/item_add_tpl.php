<?php
	if($config['permission'])
	{
		function get_nhomquyen($id_nhomquyen)
		{
			global $d;

			$row = $d->rawQuery("select * from #_permission_group where hienthi>0 order by stt,id desc");

			$str = '<select id="id_nhomquyen" name="data[id_nhomquyen]" class="form-select"><option value="0">Chọn nhóm quyền</option>';
			foreach($row as $v)
			{
				if($v["id"] == (int)@$id_nhomquyen) $selected = "selected";
				else $selected = "";

				$str .= '<option value='.$v["id"].' '.$selected.'>'.$v["ten"].'</option>';			
			}
			$str .= '</select>';

			return $str;
		}
	}
    $linkMan = "index.php?com=user&act=man_admin&p=".$curPage;
    $linkSave = "index.php?com=user&act=save_admin&p=".$curPage;
?>

<div class="content-inner container-fluid pb-0" id="page_layout">
	<form class="validation-form" novalidate method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h5 class="mb-0"><?=($act=="edit")?"Cập nhật":"Thêm mới";?> tài khoản</h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="form-group col-md-4">
								<?php if(isset($config['permission']) && $config['permission']==true) { ?>
									<label for="permission" class="form-label">Danh sách nhóm quyền:</label>
									<?=get_nhomquyen($item['id_nhomquyen'])?>
								<?php } ?>
							</div>
							<div class="form-group col-md-4">
								<label class="form-label" for="username">Tài khoản: <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="data[username]" id="username" placeholder="Tài khoản" value="<?=@$item['username']?>"  required>
							</div>
							<div class="form-group col-md-4">
								<label class="form-label" for="ten">Họ tên: <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="data[ten]" id="ten" placeholder="Họ tên" value="<?=@$item['ten']?>" required>
							</div>
							<div class="form-group col-md-4">
								<label class="form-label" for="password">Mật khẩu:</label>
								<input type="password" class="form-control" name="data[password]" id="password" placeholder="Mật khẩu" <?=($act=="add_admin")?'required':'';?>>
							</div>
							<div class="form-group col-md-4">
								<label class="form-label" for="confirm_password">Nhập lại mật khẩu:</label>
								<input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Nhập lại mật khẩu" <?=($act=="add_admin")?'required':'';?>>
							</div>
							<div class="form-group col-md-4">
								<label class="form-label" for="email">Email:</label>
								<input type="email" class="form-control" name="data[email]" id="email" placeholder="Email" value="<?=@$item['email']?>">
							</div>
							<div class="form-group col-md-4">
								<label class="form-label" for="dienthoai">Điện thoại:</label>
								<input type="text" class="form-control" name="data[dienthoai]" id="dienthoai" placeholder="Điện thoại" value="<?=@$item['dienthoai']?>">
							</div>
							<div class="form-group col-md-4">
								<label class="form-label" for="gioitinh">Giới tính:</label>
								<select class="form-select" name="data[gioitinh]" id="gioitinh">
									<option value="0">Chọn giới tính</option>
									<option <?=(@$item['gioitinh']==1)?"selected":""?> value="1">Nam</option>
									<option <?=(@$item['gioitinh']==2)?"selected":""?> value="2">Nữ</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<label for="ngaysinh">Ngày sinh:</label>
								<input type="date" class="form-control" name="data[ngaysinh]" id="ngaysinh" placeholder="Ngày sinh" value="<?=(@$item['ngaysinh'])?date('d/m/Y',@$item['ngaysinh']):"";?>">
							</div>
							<div class="form-group col-md-4">
								<label for="diachi">Địa chỉ:</label>
								<input type="text" class="form-control" name="data[diachi]" id="diachi" placeholder="Địa chỉ" value="<?=@$item['diachi']?>">
							</div>
						</div>
						<div class="row align-items-center mt-3">
							<div class="form-group col-md-2">
								<label for="hienthi" class="d-inline-block align-middle mb-0 mr-2">Kích hoạt:</label>
								<div class="custom-control  d-inline-block align-middle form-switch">
									<input type="checkbox" class="form-check-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked':''?>>
									<label for="hienthi-checkbox" class="form-check-label"></label>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label for="stt" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
								<input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?=isset($item['stt'])?$item['stt']:1?>">
							</div>
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
