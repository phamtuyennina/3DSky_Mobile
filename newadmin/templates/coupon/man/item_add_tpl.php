<?php
	function randomCoupon()
	{
		global $func;
		
		$f = substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVXYZabcdefghijklmnopqrstuvwxyz", 5)), 0, 3);
		$m = substr(md5(time()),0,3);
		$l = $func->digitalRandom(0,9,3);

		return $f.$m.$l;
	}
	
	function checkCoupon($cp)
	{
		global $d;
		
		$tmp = $d->rawQuery("select id from #_coupon where ma = ?",array($cp));
		
		if($tmp['id']!="") return 1;
		else return 0;
	}

	$quanitycode = 20;
	$linkMan = "index.php?com=coupon&act=man&p=".$curPage;
    $linkSave = "index.php?com=coupon&act=save&quanitycode=".$quanitycode."&p=".$curPage;
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item"><a href="<?=$linkMan?>" title="Quản lý mã ưu đãi">Quản lý mã ưu đãi</a></li>
                <li class="breadcrumb-item active"><?=($act=="edit")?"Cập nhật":"Thêm mới";?> mã ưu đãi</li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form class="validation-form" novalidate method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-sm bg-gradient-primary" disabled><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title">Chi tiết mã ưu đãi</h3>
            </div>
            <div class="card-body">
            	<div class="form-group-category row">
	                <?php if($act=='edit') { ?>
						<div class="form-group col-md-4">
							<label for="ma">Mã ưu đãi: <span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="data[ma]" id="ma" placeholder="Mã ưu đãi" value="<?=@$item['ma']?>" readonly required>
						</div>
					<?php } ?>
					<div class="form-group col-md-4">
						<label for="chietkhau">Loại giảm: <span class="text-danger">*</span></label>
						<div class="row">
							<div class="col-7">
								<input type="text" class="form-control" name="data[chietkhau]" id="chietkhau" placeholder="Loại giảm" value="<?=@$item['chietkhau']?>" required>
							</div>
							<div class="col-5">
								<select class="form-control" name="data[loai]">
									<option <?=(isset($item['loai']) && $item['loai']==1)?"selected":""?> value="1">%</option>
									<option <?=(isset($item['loai']) && $item['loai']==2)?"selected":""?> value="2">VNĐ</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group col-md-4">
						<label for="ngaybatdau">Ngày bắt đầu: <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="data[ngaybatdau]" id="ngaybatdau" placeholder="Ngày bắt đầu" value="<?=($item['ngaybatdau'])?date('d/m/Y',$item['ngaybatdau']):"";?>" required readonly>
					</div>
					<div class="form-group col-md-4">
						<label for="ngayketthuc">Ngày kết thúc: <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="data[ngayketthuc]" id="ngayketthuc" placeholder="Ngày kết thúc" value="<?=($item['ngayketthuc'])?date('d/m/Y',$item['ngayketthuc']):"";?>" required readonly>
					</div>
					<?php if($act=='edit') { ?>
						<div class="form-group col-md-4">
							<label for="tinhtrang">Tình trạng: <span class="text-danger">*</span></label>
							<select class="form-control select2" name="data[tinhtrang]" required>
								<option <?=(isset($item['tinhtrang']) && $item['tinhtrang']==0)?"selected":"";?> value="0">Chưa sử dụng</option>
								<option <?=(isset($item['tinhtrang']) && $item['tinhtrang']==1)?"selected":"";?> value="1">Đã sử dụng</option>
								<option <?=(isset($item['tinhtrang']) && $item['tinhtrang']==2)?"selected":"";?> value="2">Hết hạn</option>
								<option <?=(isset($item['tinhtrang']) && $item['tinhtrang']==3)?"selected":"";?> value="3">Đã gửi</option>
							</select>
						</div>
				    <?php } ?>
				</div>
				<?php if($act=='add') { ?>
					<div class="row">
						<?php for($i=0;$i<$quanitycode;$i++) {
							$ck=1;
							while($ck!=0)
							{
								$ma = randomCoupon();
								$ck = checkCoupon($ma);
							} ?>
					    	<div class="form-group col-sm-3">
		                        <label class="d-block">Mã <?=($i+1)?>:</label>
		                        <a class="d-block bg-gradient-primary text-white p-2 rounded" href="#" title="Mã <?=($i+1)?>"><?=$ma?></a>
					    		<input type="hidden" name="ma<?=$i?>" value="<?=$ma?>"/>
		                    </div>
					    <?php } ?>
					</div>
				<?php } ?>
			    <?php if($act=='edit') { ?>
				    <div class="form-group">
	                    <label for="stt" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
	                    <input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?=isset($item['stt'])?$item['stt']:1?>">
	                </div>
	            <?php } ?>
            </div>
        </div>
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary" disabled><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?=@$item['id']?>">
        </div>
    </form>
</section>

<!-- Coupon js -->
<script type="text/javascript">
	$(document).ready(function(){
	    $('#ngaybatdau, #ngayketthuc').datetimepicker({
	        timepicker:false,
	        format:'d/m/Y',
	        formatDate:'d/m/Y',
	        minDate:'<?=date("Y/m/d",time())?>',
	        // maxDate:''
	    });
	});
</script>