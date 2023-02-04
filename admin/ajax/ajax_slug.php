<?php
	include "ajax_config.php";

	$flag = 1;
	$slug = (isset($_POST['slug'])) ? htmlspecialchars($_POST['slug']):'';
	$id = (isset($_POST['id'])) ? (int)htmlspecialchars($_POST['id']):0;
	$where = (isset($id) && $id!=0) ? "id<>$id AND " : "";

	$table = array(
		"#_product_list",
		"#_product_cat",
		"#_product_item",
		"#_product_sub",
		"#_product_brand",
		"#_product",
		"#_news_list",
		"#_news_cat",
		"#_news_item",
		"#_news_sub",
		"#_news",
		"#_tags"
	);

	foreach($table as $v)
	{
		$check = $d->rawQueryOne("SELECT id FROM $v WHERE $where (tenkhongdauvi = ? OR tenkhongdauen = ?)",array($slug,$slug));
		if($check['id'])
		{
			$flag = 0;
			break;
		}
	}

	echo $flag;
?>