<?php
	include "ajax_config.php";

	$id = (isset($_POST["id"])) ? htmlspecialchars($_POST["id"]):'';
	$table = (isset($_POST["table"])) ? htmlspecialchars($_POST["table"]):'';
	$copyimg = (isset($_POST["copyimg"])) ? htmlspecialchars($_POST["copyimg"]):'';
	
	if(isset($id) && $id!=0) $item = $d->rawQueryOne("SELECT * FROM #_$table WHERE id = ?",array($id));

	function createCopy($titleCopy,$titleSlug,$table)
	{
		global $d, $cache, $func, $config, $item, $copyimg;

		$check = $d->rawQueryOne("SELECT id FROM #_$table WHERE tenkhongdauvi = ? OR tenkhongdauen = ?",array($titleSlug,$titleSlug));

		if(isset($check['id']) && $check['id']!=0)
		{
			$titleCopy .= " (1)";
			$titleSlug = $func->changeTitle($titleCopy);
			createCopy($titleCopy,$titleSlug,$table);
		}
		else
		{
			foreach($config['website']['lang'] as $key => $value) 
			{
				$datacopy['mota'.$key] = $item['mota'.$key];
				$datacopy['noidung'.$key] = $item['noidung'.$key];
			}
			if($copyimg)
			{
				$datacopy['photo'] = $func->copyImg($item['photo'],$table);
			}
			$datacopy['tenvi'] = $titleCopy;
			$datacopy['tenkhongdauvi'] = $func->changeTitle($datacopy['tenvi']);
			$datacopy['id_list'] = $item['id_list'];
			$datacopy['id_cat'] = $item['id_cat'];
			$datacopy['id_item'] = $item['id_item'];
			$datacopy['id_sub'] = $item['id_sub'];
			if($table == 'product')
			{
				$datacopy['id_size'] = $item['id_size'];
				$datacopy['id_mau'] = $item['id_mau'];
				$datacopy['id_brand'] = $item['id_brand'];
				$datacopy['masp'] = $item['masp'];
				$datacopy['gia'] = $item['gia'];
				$datacopy['giakm'] = $item['giakm'];
				$datacopy['giamoi'] = $item['giamoi'];
				$datacopy['tinhtrang'] = $item['tinhtrang'];
			}
			$datacopy['link'] = $item['link'];
			$datacopy['link_video'] = $item['link_video'];
			$datacopy['stt'] = 0;
			$datacopy['hienthi'] = 0;
			$datacopy['type'] = $item['type'];
			$datacopy['ngaytao'] = time();
			$d->insert($table,$datacopy);
			$cache->DeleteCache();
		}
	}
	
	if(isset($item['id']) && $item['id']!=0)
	{
		$title = $item['tenvi'];
		$titleSlug = $item['tenkhongdauvi'];
		createCopy($title,$titleSlug,$table);
	}
?>