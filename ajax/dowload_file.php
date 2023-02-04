<?php
	include "ajax_config.php";
	$id=$_POST['id'];
	$product=$d->rawQueryOne("select tinhtrang,gia,taptin,id from #_product where id=?",array($id));

	$beginOfDay = strtotime("today", time());
	$endOfDay   = strtotime("tomorrow", $beginOfDay) - 1;

	if($product['tinhtrang']==1){
		if(!empty($rowUser['free_start']) && !empty($rowUser['free_end'])){
			$numFree= ($rowUser['free_end']>time())?30:3;
		}else{
			$numFree= 3;
		}
		$count_download = $d->rawQueryOne("select count(id) as dem from #_product_download where id_user=? and ngaytao >= ? and ngaytao <= ? and type=?",array($rowUser['id'],$beginOfDay,$endOfDay,'free'));
		if($count_download['dem']>=$numFree){
			echo json_encode(array('error'=>1,'mess'=>'The number of free downloads per day has reached the limit.'));
		}else{
			$data['ngaytao'] = time();
			$data['id_user'] = $rowUser['id'];
			$data['id_product'] = $product['id'];
			$data['type'] = 'free';
			$d->insert('product_download',$data);
			echo json_encode(array('error'=>0,'url'=>$config_base.UPLOAD_FILE_L.$product['taptin'],'name'=>$product['taptin']));
		}
	}else{
		if($rowUser['numpro']>0){
			$data['ngaytao'] = time();
			$data['id_user'] = $rowUser['id'];
			$data['id_product'] = $product['id'];
			$data['type'] = 'pro';
			if($d->insert('product_download',$data)){
				$data_user['numpro'] = $rowUser['numpro'] - 1;
				$d->where('id', $rowUser['id']);
				$d->update('member',$data_user);
			}
			echo json_encode(array('error'=>0,'url'=>$config_base.UPLOAD_FILE_L.$product['taptin'],'name'=>$product['taptin']));
		}else{
			echo json_encode(array('error'=>3,'href'=>'account/buy'));
		}
	}
?>