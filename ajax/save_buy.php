<?php 
	include "ajax_config.php";


	$data['madonhang'] = strtoupper($func->stringRandom(6));
	$data['hoten'] = htmlspecialchars($_POST['ten']);
    $data['email'] = htmlspecialchars($_POST['email']);
    $data['dienthoai'] = htmlspecialchars($_POST['dienthoai']);
    $data['diachi'] = htmlspecialchars($_POST['diachi']);
    $data['numpro'] = htmlspecialchars($_POST['num_pro']);
    $data['numfree'] = htmlspecialchars($_POST['num_free']);
    $data['pricepro_total'] = htmlspecialchars($_POST['price_pro']*$data['numpro']);
    $data['pricefree_total'] = htmlspecialchars($_POST['price_free']*$data['numfree']);
    $data['tonggia'] = htmlspecialchars($_POST['total_model']);
    $data['pricepro'] = htmlspecialchars($_POST['price_pro']);
    $data['pricefree'] = htmlspecialchars($_POST['price_free']);
    $data['httt'] = htmlspecialchars($_POST['payments']);
    $data['id_user'] = htmlspecialchars($_POST['id_user']);
    $data['ngaytao'] = time();
	$data['tinhtrang'] = 1;
	$data['payment'] = 1;
	$data['stt'] = 1;
	$id_insert = $d->insert('order',$data);
	if($_POST['payments']==1){
		if(!empty($data['numpro']) && !empty($data['numfree'])){
			$payment = '#'.$data['madonhang'].' - Payment for '.$data['numpro'].' PRO and '.$data['numfree'].' months free';
		}
		if(empty($data['numpro']) && !empty($data['numfree'])){
			$payment = '#'.$data['madonhang'].' - Payment for '.$data['numfree'].' months free';
		}
		if(!empty($data['numpro']) && empty($data['numfree'])){
			$payment = '#'.$data['madonhang'].' - Payment for '.$data['numpro'].' PRO';
		}
		$donhang = $d->rawQueryOne("select * from #_order where id=?",array($id_insert));
		$func->EmailCart($donhang,$func->get_payments($data['httt']));
		echo json_encode(array('mess'=>$payment,'paypal'=>1,'total'=>$data['tonggia']));
	}else{
		$data['paypal']=0;
		if(!empty($data['numpro']) && !empty($data['numfree'])){
			$payment = '#'.$data['madonhang'].' - Payment for '.$data['numpro'].' PRO and '.$data['numfree'].' months free';
		}
		if(empty($data['numpro']) && !empty($data['numfree'])){
			$payment = '#'.$data['madonhang'].' - Payment for '.$data['numfree'].' months free';
		}
		if(!empty($data['numpro']) && empty($data['numfree'])){
			$payment = '#'.$data['madonhang'].' - Payment for '.$data['numpro'].' PRO';
		}
		$donhang = $d->rawQueryOne("select * from #_order where id=?",array($id_insert));
		//$func->EmailCart($donhang,$func->get_payments($data['httt']));
		echo json_encode(array('mess'=>'Processing is successful, we will notify you when completed','paypal'=>0,'total'=>$data['tonggia']));
	}
?>