<section class="wrap-thanhcong py-5">
	<div class="container">
		<div class="wrapper">
			<div class="m-custom-con">
				<p class="thankyou-order-received"><?=chucmungdathang?></p>
				<ul class="thankyou-order-details order_details">
					<li class="overview__order">
						<?=madonhang?>
						<strong><?=$myOrderCheck['madonhang']?></strong>
					</li>
					<li class="overview__date">
						<?=ngaydat?>
						<strong><?=date('d/m/Y',$myOrderCheck['ngaytao'])?></strong>
					</li>
					<li class="overview__total">
						<?=tongcong?>
						<strong><?=number_format($myOrderCheck['tonggia']*$tygia, 2, '.', '')?> <?=$postfix?></strong>
					</li>
					<li class="overview__payment-method">
						<strong><?=$func->get_payments($myOrderCheck['httt'])?></strong>
					</li>
				</ul>
				<p class="thankyou-order-payment"><?=$func->get_payments($myOrderCheck['httt'])?></p>
				<section class="order-details">
					<h2 class="order-details__title"><?=chitietdonhang?></h2>
					<table class="table--order-details shop_table order_details table table-bordered">
						<thead>
							<tr>
								<th class="table__product-name product-name"><?=sanpham?></th>
								<th class="table__product-table product-total"><?=tong?></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($myOrderCheck_detail as $k => $v) {
								$pid = $v['id_product'];
								$q = $v['soluong'];
								$proinfo = $cart->get_product_info($pid);
								$gia = $proinfo['gia'];
								$giamoi = $proinfo['giamoi'];
								$size = $v['size'];
								$color = $v['mau'];
								$proinfo = $cart->get_product_info($pid);
								$textsm='';
								if($color!='' && $size!='') $textsm = $color." - ".$size;
								else if($color!='') $textsm = $color;
								else if($size!='') $textsm = $size;
							?>
							<tr class="table__line-item order_item">
								<td class="table__product-name product-name ">
									<a href="<?=$proinfo['tenkhongdauen']?>">
										<?=$proinfo['ten'.$lang]?><br><?=$textsm?>
									</a>
									<strong class="product-quantity">×&nbsp;<?=$v['soluong']?></strong>
								</td>
								<td class="table__product-total product-total">
									<span class="Price-amount amount"><bdi><?=number_format((($v['giamoi']>0)?$v['giamoi']:$v['gia'])*$v['soluong']*$tygia, 2, '.', '')?> <?=$postfix?></bdi></span>
								</td>
							</tr>
							<?php }?>
						</tbody>
						<tfoot>
							<tr>
								<th scope="row"><?=tamtinh?>:</th>
								<td><span class="Price-amount amount"><?=number_format($myOrderCheck['tamtinh']*$tygia, 2, '.', '')?> <?=$postfix?></span></td>
							</tr>
							<tr>
								<th scope="row"><?=khuyenmai?>:</th>
								<td><span class="Price-amount amount"><?=number_format($myOrderCheck['phicoupon']*$tygia, 2, '.', '')?> <?=$postfix?></span></td>
							</tr>
							<tr>
								<th scope="row"><?=phivanchuyen?>:</th>
								<td><span class="Price-amount amount"><?=number_format($myOrderCheck['phiship']*$tygia, 2, '.', '')?> <?=$postfix?></span></td>
							</tr>
							<tr>
								<th scope="row"><?=phuongthucthanhtoan?>:</th>
								<td><?=$func->get_payments($myOrderCheck['httt'])?></td>
							</tr>
							<tr>
								<th scope="row"><?=tongcong?>:</th>
								<td><span class="Price-amount amount"><?=number_format($myOrderCheck['tonggia']*$tygia, 2, '.', '')?> <?=$postfix?></span></td>
							</tr>
						</tfoot>
					</table>
					<h2 class="order-details__title"><?=diachithanhtoan?></h2>
					<div class="show_order_adderss">
						<p><?=$myOrderCheck['hoten']?></p>
						<p><?=$myOrderCheck['diachi']?><br><?=$myOrderCheck['wards']?><br><?=$myOrderCheck['district']?><br><?=$func->get_places("district",$myOrderCheck['city'])?><br><?=$func->get_places("city",$myOrderCheck['country'])?></p>
						<p><?=$myOrderCheck['email']?></p>
						<p><?=$myOrderCheck['dienthoai']?></p>
					</div>
				</section>
				<a href="<?=$config_base?>" class="dp-block form__link form__back"><?=tieptucmuasam?></a>
			</div>
		</div>
	</div>
</section>