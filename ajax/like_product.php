<?php 
	include "ajax_config.php";
	$id=$_POST['id'];
	$cmd=$_POST['cmd'];
	$id_user=$rowUser['id'];
	if($cmd=='add-like'){
		$data['id_user']=$id_user;
		$data['id_product']=$id;
		$d->insert('product_like',$data);
	}else{
		$d->rawQuery("delete from #_product_like where id_user = ? and id_product = ?",array($id_user,$id));
	}
?>