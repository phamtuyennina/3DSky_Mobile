<?php
	include "ajax_config.php";
		
	$loai = (isset($_POST["loai"])) ? htmlspecialchars($_POST["loai"]):'';
	$table = (isset($_POST["table"])) ? htmlspecialchars($_POST["table"]):'';
	$id = (isset($_POST["id"])) ? htmlspecialchars($_POST["id"]):'';

	$tmp = $d->rawQueryOne("select $loai from #_$table where id = ?",array($id));

	if($tmp[$loai]>0) $data[$loai] = 0;
	else $data[$loai] = 1;

	$d->where('id',$id);
	$d->update($table,$data);
	$cache->DeleteCache();
?>