<?php
	include "ajax_config.php";
	
	$value = (isset($_POST["value"])) ? htmlspecialchars($_POST["value"]):'';
	$table = (isset($_POST["table"])) ? htmlspecialchars($_POST["table"]):'';
	$id = (isset($_POST["id"])) ? htmlspecialchars($_POST["id"]):'';
	
	$data['stt'] = $value;
	
	$d->where('id',$id);
	$d->update($table,$data);
	$cache->DeleteCache();
?>