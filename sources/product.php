<?php  
	if(!defined('SOURCES')) die("Error");

	@$id = htmlspecialchars($_GET['id']);
	@$idl = htmlspecialchars($_GET['idl']);
	@$idc = htmlspecialchars($_GET['idc']);
	@$idi = htmlspecialchars($_GET['idi']);
	@$ids = htmlspecialchars($_GET['ids']);
	@$idb = htmlspecialchars($_GET['idb']);

	if($id!='')
	{
		/* Lấy sản phẩm detail */
		$row_detail = $d->rawQueryOne("select *,type, id, ten$lang, tenkhongdauvi, tenkhongdauen, mota$lang, noidung$lang, masp, luotxem, id_brand, id_mau, id_size, id_list, id_cat, id_item, id_sub, id_tags, photo, options, giakm, giamoi, gia from #_product where hienthi=1 and id = ? and type = ? limit 0,1",array($id,$type));

		/* Cập nhật lượt xem */
		$data_luotxem['luotxem'] = $row_detail['luotxem'] + 1;
		$d->where('id',$row_detail['id']);
		$d->update('product',$data_luotxem);

        /* Lấy tags */
		if($row_detail['id_tags']) $pro_tags = $d->rawQuery("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_tags where id in (".$row_detail['id_tags'].") and type='".$type."'");

		/* Lấy thương hiệu */
		$pro_brand = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_product_brand where hienthi=1 and id = ? and type = ? limit 0,1",array($row_detail['id_brand'],$type));

		/* Lấy màu */
		if($row_detail['id_mau']) $mau = $d->rawQuery("select loaihienthi, photo, mau, id from #_product_mau where hienthi=1 and type='".$type."' and find_in_set(id,'".$row_detail['id_mau']."') order by stt,id desc");

		/* Lấy size */
		if($row_detail['id_size']) $size = $d->rawQuery("select id, ten$lang from #_product_size where hienthi=1 and type='".$type."' and find_in_set(id,'".$row_detail['id_size']."') order by stt,id desc");

		/* Lấy cấp 1 */
		$pro_list = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_product_list where hienthi=1 and id = ? and type = ? limit 0,1",array($row_detail['id_list'],$type));

		/* Lấy cấp 2 */
		$pro_cat = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_product_cat where hienthi=1 and id = ? and type = ? limit 0,1",array($row_detail['id_cat'],$type));

		/* Lấy cấp 3 */
		$pro_item = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_product_item where hienthi=1 and id = ? and type = ? limit 0,1",array($row_detail['id_item'],$type));

		/* Lấy cấp 4 */
		$pro_sub = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_product_sub where hienthi=1 and id = ? and type = ? limit 0,1",array($row_detail['id_sub'],$type));
		
		/* Lấy hình ảnh con */
		$hinhanhsp = $d->rawQuery("select photo from #_gallery where hienthi=1 and id_photo = ? and com='product' and type = ? and kind='man' and val = ? order by stt,id desc",array($row_detail['id'],$type,$type));

		/* Lấy sản phẩm mới nhất */
		$product_new = $d->rawQuery("select photo, ten$lang, tenkhongdauvi, tenkhongdauen, giamoi, gia, giakm, id,masp from #_product where id!=? and hienthi!=0 order by id desc limit 0,10", array($row_detail['id']));
		
		/* Lấy sản phẩm cùng loại */
		$where = "";
		$where = "hienthi=1 and id <> ? and id_list = ? and type = ?";
		$params = array($id,$row_detail['id_list'],$type);

		$curPage = $get_page;
		$per_page = 20;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select photo, ten$lang, tenkhongdauvi, tenkhongdauen, giamoi, gia, giakm, id,tinhtrang from #_product where $where order by stt,id desc $limit";
		$product = $d->rawQuery($sql,$params);
		$sqlNum = "select count(*) as 'num' from #_product where $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,$params);
		$total = $count['num'];
		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($total,$per_page,$curPage,$url);

		/* SEO */
		$seoDB = $seo->getSeoDB($row_detail['id'],'product','man',$row_detail['type']);
		$seo->setSeo('h1',$row_detail['ten'.$lang]);
		if($seoDB['title'.$seolang]!='') $seo->setSeo('title',$seoDB['title'.$seolang]);
		else $seo->setSeo('title',$row_detail['ten'.$lang]);
		$seo->setSeo('keywords',$seoDB['keywords'.$seolang]);
		$seo->setSeo('description',$seoDB['description'.$seolang]);
		$seo->setSeo('url',$func->getPageURL());
		
		$img_json_bar = json_decode($row_detail['options'],true);
		if($img_json_bar['p'] != $row_detail['photo'])
		{
			$img_json_bar = $func->getImgSize($row_detail['photo'],UPLOAD_PRODUCT_L.$row_detail['photo']);
			$seo->updateSeoDB(json_encode($img_json_bar),'product',$row_detail['id']);
		}
		$seo->setSeo('photo',$config_base.THUMBS.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'.UPLOAD_PRODUCT_L.$row_detail['photo']);
		$seo->setSeo('photo:width',$img_json_bar['w']);
		$seo->setSeo('photo:height',$img_json_bar['h']);
		$seo->setSeo('photo:type',$img_json_bar['m']);
		/* breadCrumbs */
		if($title_crumb) $breadcr->setBreadCrumbs($com,$title_crumb);
		$breadcr->setBreadCrumbs('3d-models?list='.$pro_list[$sluglang],$pro_list['ten'.$lang]);
		$breadcr->setBreadCrumbs('3d-models?list='.$pro_list[$sluglang].'&cat='.$pro_cat[$sluglang],$pro_cat['ten'.$lang]);
		$breadcr->setBreadCrumbs('$row_detail[$sluglang]',$row_detail['ten'.$lang]);
		$breadcrumbs = $breadcr->getBreadCrumbs();
	}
	else if($idl!='')
	{
		/* Lấy cấp 1 detail */
		$pro_list = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen, type, photo, options from #_product_list where id = ? and type = ? limit 0,1",array($idl,$type));

		/* SEO */
		$title_cat = $pro_list['ten'.$lang];
		$seoDB = $seo->getSeoDB($pro_list['id'],'product','man_list',$pro_list['type']);
		$seo->setSeo('h1',$pro_list['ten'.$lang]);
		if($seoDB['title'.$seolang]!='') $seo->setSeo('title',$seoDB['title'.$seolang]);
		else $seo->setSeo('title',$pro_list['ten'.$lang]);
		$seo->setSeo('keywords',$seoDB['keywords'.$seolang]);
		$seo->setSeo('description',$seoDB['description'.$seolang]);
		$seo->setSeo('url',$func->getPageURL());

		$img_json_bar = json_decode($pro_list['options'],true);
		if($img_json_bar['p'] != $pro_list['photo'])
		{
			$img_json_bar = $func->getImgSize($pro_list['photo'],UPLOAD_PRODUCT_L.$pro_list['photo']);
			$seo->updateSeoDB(json_encode($img_json_bar),'product_list',$pro_list['id']);
		}
		$seo->setSeo('photo',$config_base.THUMBS.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'.UPLOAD_PRODUCT_L.$pro_list['photo']);
		$seo->setSeo('photo:width',$img_json_bar['w']);
		$seo->setSeo('photo:height',$img_json_bar['h']);
		$seo->setSeo('photo:type',$img_json_bar['m']);
		/* Lấy sản phẩm */
		$where = "";
		$where = "id_list = ? and type = ? and hienthi=1";
		$params = array($idl,$type);

		$curPage = $get_page;
		$per_page = 20;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select photo, ten$lang, tenkhongdauvi, tenkhongdauen, giamoi, gia, giakm, id,masp from #_product where $where order by stt,id desc $limit";
		$product = $d->rawQuery($sql,$params);
		$sqlNum = "select count(*) as 'num' from #_product where $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,$params);
		$total = $count['num'];
		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($total,$per_page,$curPage,$url);

		/* breadCrumbs */
		if($title_crumb) $breadcr->setBreadCrumbs($com,$title_crumb);
		$breadcr->setBreadCrumbs($pro_list[$sluglang],$pro_list['ten'.$lang]);
		$breadcrumbs = $breadcr->getBreadCrumbs();	
	}
	else if($idc!='')
	{
		/* Lấy cấp 2 detail */
		$pro_cat = $d->rawQueryOne("select id, id_list, ten$lang, tenkhongdauvi, tenkhongdauen, type, photo, options from #_product_cat where id = ? and type = ? limit 0,1",array($idc,$type));

		/* Lấy cấp 1 */
		$pro_list = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_product_list where id = ? and type = ? limit 0,1",array($pro_cat['id_list'],$type));

		/* Lấy sản phẩm */
		$where = "";
		$where = "id_cat = ? and type = ? and hienthi=1";
		$params = array($idc,$type);

		$curPage = $get_page;
		$per_page = 20;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select photo, ten$lang, tenkhongdauvi, tenkhongdauen, giamoi, gia, giakm, id,masp from #_product where $where order by stt,id desc $limit";
		$product = $d->rawQuery($sql,$params);
		$sqlNum = "select count(*) as 'num' from #_product where $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,$params);
		$total = $count['num'];
		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($total,$per_page,$curPage,$url);

		/* SEO */
		$title_cat = $pro_cat['ten'.$lang];
		$seoDB = $seo->getSeoDB($pro_cat['id'],'product','man_cat',$pro_cat['type']);
		$seo->setSeo('h1',$pro_cat['ten'.$lang]);
		if($seoDB['title'.$seolang]!='') $seo->setSeo('title',$seoDB['title'.$seolang]);
		else $seo->setSeo('title',$pro_cat['ten'.$lang]);
		$seo->setSeo('keywords',$seoDB['keywords'.$seolang]);
		$seo->setSeo('description',$seoDB['description'.$seolang]);
		$seo->setSeo('url',$func->getPageURL());
		$img_json_bar = json_decode($pro_cat['options'],true);
		if($img_json_bar['p'] != $pro_cat['photo'])
		{
			$img_json_bar = $func->getImgSize($pro_cat['photo'],UPLOAD_PRODUCT_L.$pro_cat['photo']);
			$seo->updateSeoDB(json_encode($img_json_bar),'product_cat',$pro_cat['id']);
		}
		$seo->setSeo('photo',$config_base.THUMBS.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'.UPLOAD_PRODUCT_L.$pro_cat['photo']);
		$seo->setSeo('photo:width',$img_json_bar['w']);
		$seo->setSeo('photo:height',$img_json_bar['h']);
		$seo->setSeo('photo:type',$img_json_bar['m']);
		/* breadCrumbs */
		if($title_crumb) $breadcr->setBreadCrumbs($com,$title_crumb);
		$breadcr->setBreadCrumbs($pro_list[$sluglang],$pro_list['ten'.$lang]);
		$breadcr->setBreadCrumbs($pro_cat[$sluglang],$pro_cat['ten'.$lang]);
		$breadcrumbs = $breadcr->getBreadCrumbs();
	}
	else if($idi!='')
	{
		/* Lấy cấp 3 detail */
		$pro_item = $d->rawQueryOne("select id, id_list, id_cat, ten$lang, tenkhongdauvi, tenkhongdauen, type, photo, options from #_product_item where id = ? and type = ? limit 0,1",array($idi,$type));

		/* Lấy cấp 1 */
		$pro_list = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_product_list where id = ? and type = ? limit 0,1",array($pro_item['id_list'],$type));

		/* Lấy cấp 2 */
		$pro_cat = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_product_cat where id_list = ? and id = ? and type = ? limit 0,1",array($pro_item['id_list'],$pro_item['id_cat'],$type));

		/* Lấy sản phẩm */
		$where = "";
		$where = "id_item = ? and type = ? and hienthi=1";
		$params = array($idi,$type);

		$curPage = $get_page;
		$per_page = 20;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select photo, ten$lang, tenkhongdauvi, tenkhongdauen, giamoi, gia, giakm, id,masp from #_product where $where order by stt,id desc $limit";
		$product = $d->rawQuery($sql,$params);
		$sqlNum = "select count(*) as 'num' from #_product where $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,$params);
		$total = $count['num'];
		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($total,$per_page,$curPage,$url);

		/* SEO */
		$title_cat = $pro_item['ten'.$lang];
		$seoDB = $seo->getSeoDB($pro_item['id'],'product','man_item',$pro_item['type']);
		$seo->setSeo('h1',$pro_item['ten'.$lang]);
		if($seoDB['title'.$seolang]!='') $seo->setSeo('title',$seoDB['title'.$seolang]);
		else $seo->setSeo('title',$pro_item['ten'.$lang]);
		$seo->setSeo('keywords',$seoDB['keywords'.$seolang]);
		$seo->setSeo('description',$seoDB['description'.$seolang]);
		$seo->setSeo('url',$func->getPageURL());

		$img_json_bar = json_decode($pro_item['options'],true);
		if($img_json_bar['p'] != $pro_item['photo'])
		{
			$img_json_bar = $func->getImgSize($pro_item['photo'],UPLOAD_PRODUCT_L.$pro_item['photo']);
			$seo->updateSeoDB(json_encode($img_json_bar),'product_item',$pro_item['id']);
		}
		$seo->setSeo('photo',$config_base.THUMBS.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'.UPLOAD_PRODUCT_L.$pro_item['photo']);
		$seo->setSeo('photo:width',$img_json_bar['w']);
		$seo->setSeo('photo:height',$img_json_bar['h']);
		$seo->setSeo('photo:type',$img_json_bar['m']);
		/* breadCrumbs */
		if($title_crumb) $breadcr->setBreadCrumbs($com,$title_crumb);
		$breadcr->setBreadCrumbs($pro_list[$sluglang],$pro_list['ten'.$lang]);
		$breadcr->setBreadCrumbs($pro_cat[$sluglang],$pro_cat['ten'.$lang]);
		$breadcr->setBreadCrumbs($pro_item[$sluglang],$pro_item['ten'.$lang]);
		$breadcrumbs = $breadcr->getBreadCrumbs();
	}
	else if($ids!='')
	{
		/* Lấy cấp 4 */
		$pro_sub = $d->rawQueryOne("select id, id_list, id_cat, id_item, ten$lang, tenkhongdauvi, tenkhongdauen, type, photo, options from #_product_sub where id = ? and type = ? limit 0,1",array($ids,$type));

		/* Lấy cấp 1 */
		$pro_list = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_product_list where id = ? and type = ? limit 0,1",array($pro_sub['id_list'],$type));

		/* Lấy cấp 2 */
		$pro_cat = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_product_cat where id_list = ? and id = ? and type = ? limit 0,1",array($pro_sub['id_list'],$pro_sub['id_cat'],$type));

		/* Lấy cấp 3 */
		$pro_item = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_product_item where id_list = ? and id_cat = ? and id = ? and type = ? limit 0,1",array($pro_sub['id_list'],$pro_sub['id_cat'],$pro_sub['id_item'],$type));

		/* Lấy sản phẩm */
		$where = "";
		$where = "id_sub = ? and type = ? and hienthi=1";
		$params = array($ids,$type);

		$curPage = $get_page;
		$per_page = 20;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select photo, ten$lang, tenkhongdauvi, tenkhongdauen, giamoi, gia, giakm, id,masp from #_product where $where order by stt,id desc $limit";
		$product = $d->rawQuery($sql,$params);
		$sqlNum = "select count(*) as 'num' from #_product where $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,$params);
		$total = $count['num'];
		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($total,$per_page,$curPage,$url);

		/* SEO */
		$title_cat = $pro_sub['ten'.$lang];
		$seoDB = $seo->getSeoDB($pro_sub['id'],'product','man_sub',$pro_sub['type']);
		$seo->setSeo('h1',$pro_sub['ten'.$lang]);
		if($seoDB['title'.$seolang]!='') $seo->setSeo('title',$seoDB['title'.$seolang]);
		else $seo->setSeo('title',$pro_sub['ten'.$lang]);
		$seo->setSeo('keywords',$seoDB['keywords'.$seolang]);
		$seo->setSeo('description',$seoDB['description'.$seolang]);
		$seo->setSeo('url',$func->getPageURL());
		$img_json_bar = json_decode($pro_sub['options'],true);
		if($img_json_bar['p'] != $pro_sub['photo'])
		{
			$img_json_bar = $func->getImgSize($pro_sub['photo'],UPLOAD_PRODUCT_L.$pro_sub['photo']);
			$seo->updateSeoDB(json_encode($img_json_bar),'product_sub',$pro_sub['id']);
		}
		$seo->setSeo('photo',$config_base.THUMBS.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'.UPLOAD_PRODUCT_L.$pro_sub['photo']);
		$seo->setSeo('photo:width',$img_json_bar['w']);
		$seo->setSeo('photo:height',$img_json_bar['h']);
		$seo->setSeo('photo:type',$img_json_bar['m']);
		/* breadCrumbs */
		if($title_crumb) $breadcr->setBreadCrumbs($com,$title_crumb);
		$breadcr->setBreadCrumbs($pro_list[$sluglang],$pro_list['ten'.$lang]);
		$breadcr->setBreadCrumbs($pro_cat[$sluglang],$pro_cat['ten'.$lang]);
		$breadcr->setBreadCrumbs($pro_item[$sluglang],$pro_item['ten'.$lang]);
		$breadcr->setBreadCrumbs($pro_sub[$sluglang],$pro_sub['ten'.$lang]);
		$breadcrumbs = $breadcr->getBreadCrumbs();
	}
	else if($idb!='')
	{
		/* Lấy brand detail */
		$pro_brand = $d->rawQueryOne("select ten$lang, tenkhongdauvi, tenkhongdauen, id, type, photo, options from #_product_brand where id = ? and type = ? limit 0,1",array($idb,$type));

		/* SEO */
		$title_cat = $pro_brand['ten'.$lang];
		$seoDB = $seo->getSeoDB($pro_brand['id'],'product','man_brand',$pro_brand['type']);
		$seo->setSeo('h1',$pro_brand['ten'.$lang]);
		if($seoDB['title'.$seolang]!='') $seo->setSeo('title',$seoDB['title'.$seolang]);
		else $seo->setSeo('title',$pro_brand['ten'.$lang]);
		$seo->setSeo('keywords',$seoDB['keywords'.$seolang]);
		$seo->setSeo('description',$seoDB['description'.$seolang]);
		$seo->setSeo('url',$func->getPageURL());

		$img_json_bar = json_decode($pro_brand['options'],true);
		if($img_json_bar['p'] != $pro_brand['photo'])
		{
			$img_json_bar = $func->getImgSize($pro_brand['photo'],UPLOAD_PRODUCT_L.$pro_brand['photo']);
			$seo->updateSeoDB(json_encode($img_json_bar),'product_brand',$pro_brand['id']);
		}
		$seo->setSeo('photo',$config_base.THUMBS.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'.UPLOAD_PRODUCT_L.$pro_brand['photo']);
		$seo->setSeo('photo:width',$img_json_bar['w']);
		$seo->setSeo('photo:height',$img_json_bar['h']);
		$seo->setSeo('photo:type',$img_json_bar['m']);
		/* Lấy sản phẩm */
		$where = "";
		$where = "id_brand = ? and type = ? and hienthi=1";
		$params = array($pro_brand['id'],$type);

		$curPage = $get_page;
		$per_page = 20;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select photo, ten$lang, tenkhongdauvi, tenkhongdauen, giamoi, gia, giakm, id,masp from #_product where $where order by stt,id desc $limit";
		$product = $d->rawQuery($sql,$params);
		$sqlNum = "select count(*) as 'num' from #_product where $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,$params);
		$total = $count['num'];
		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($total,$per_page,$curPage,$url);

		/* breadCrumbs */
		$breadcr->setBreadCrumbs($pro_brand[$sluglang],$title_cat);
		$breadcrumbs = $breadcr->getBreadCrumbs();
	}
	else
	{
		/* SEO */
		$seopage = $d->rawQueryOne("SELECT * FROM #_seopage WHERE type = ? limit 0,1",array($type));
		$seo->setSeo('h1',$title_crumb);
		if($seopage['title'.$seolang]!='') $seo->setSeo('title',$seopage['title'.$seolang]);
		else $seo->setSeo('title',$title_crumb);
		$seo->setSeo('keywords',$seopage['keywords'.$seolang]);
		$seo->setSeo('description',$seopage['description'.$seolang]);
		$seo->setSeo('url',$func->getPageURL());

		$img_json_bar = json_decode($seopage['options'],true);
		if($img_json_bar['p'] != $seopage['photo'])
		{
			$img_json_bar = $func->getImgSize($seopage['photo'],UPLOAD_SEOPAGE_L.$seopage['photo']);
			$seo->updateSeoDB(json_encode($img_json_bar),'seopage',$seopage['id']);
		}
		$seo->setSeo('photo',$config_base.THUMBS.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'.UPLOAD_SEOPAGE_L.$seopage['photo']);
		$seo->setSeo('photo:width',$img_json_bar['w']);
		$seo->setSeo('photo:height',$img_json_bar['h']);
		$seo->setSeo('photo:type',$img_json_bar['m']);
		/* Lấy tất cả sản phẩm */
		$where = "";
		$where = "hienthi=1 and type = ?";
		$params = array($type);
		$order_by['key']='staff-pick';
		$order_by['text']= 'Staff Pick';
		if(!empty($_SERVER['REDIRECT_QUERY_STRING'])){
			$url_search=explode('&',$_SERVER['REDIRECT_QUERY_STRING']);
			foreach($url_search as $k => $v){
				$proSearch = explode('=',$v);
				if($proSearch[0]=='list'){
					$list_search = (!empty($func->get_danhmuc($proSearch[1],'product_list','id')))?$func->get_danhmuc($proSearch[1],'product_list','id'):'';
				}
				if($proSearch[0]=='cat'){
					$cat_search[]=(!empty($func->get_danhmuc($proSearch[1],'product_cat','id')))?$func->get_danhmuc($proSearch[1],'product_cat','id'):'';
				}

				if($proSearch[0]=='style') $style_array[]=$proSearch[1];
				if($proSearch[0]=='render') $render_array[]=$proSearch[1];
				if($proSearch[0]=='format') $format_array[]=$proSearch[1];
				if($proSearch[0]=='color') $color_array[]=$proSearch[1];
				if($proSearch[0]=='material') $material_array[]=$proSearch[1];
				if($proSearch[0]=='form') $form_array[]=$proSearch[1];
				if($proSearch[0]=='status') $status_array[]=$proSearch[1];
				if($proSearch[0]=='manufacturers'){
					$where .=" and manufacturers=?";
					array_push($params,1);
				}
				
				if($proSearch[0]=='bookmarks'){
					$where .=" and id IN (select id_product from #_product_like where id_user=".$rowUser['id'].")";
				}
				if($proSearch[0]=='purchases'){
					$where .=" and id IN (select id_product from #_product_download where id_user=".$rowUser['id']." and type='pro')";
				}
				if($proSearch[0]=='order-by'){
					$order_by['key']=$proSearch[1];
					if($proSearch[1]=='staff-pick') $order_by['text']= 'Staff Pick';
					if($proSearch[1]=='newets') $order_by['text']= 'Newets';
					if($proSearch[1]=='most-relevant') $order_by['text']= 'Most Relevant';
					if($proSearch[1]=='most-popula') $order_by['text']= 'Most Popula';
				}
			}
			if(!empty($list_search)){
				$where .=" and id_list=?";
				array_push($params,$list_search);
			}
			if(!empty($status_array)){
				$where .=" and (";
				foreach($status_array as $k => $v){
					if($k==0) $where .=" tinhtrang=?";
					else $where .=" or tinhtrang=?";
					array_push($params,$v);
				}
				$where .=" )";
			}
			if(!empty($cat_search)){
				$where .=" and (";
				foreach($cat_search as $k => $v){
					if($k==0) $where .=" id_cat=?";
					else $where .=" or id_cat=?";
					array_push($params,$v);
				}
				$where .=" )";
			}
			if(!empty($style_array)){
				$where .=" and (";
				foreach($style_array as $k => $v){
					if($k==0) $where .=" style=?";
					else $where .=" or style=?";
					array_push($params,$v);
				}
				$where .=" )";
			}
			if(!empty($render_array)){
				$where .=" and (";
				foreach($render_array as $k => $v){
					if($k==0) $where .=" render=?";
					else $where .=" or render=?";
					array_push($params,$v);
				}
				$where .=" )";
			}
			if(!empty($format_array)){
				$where .=" and (";
				foreach($format_array as $k => $v){
					if($k==0) $where .=" format=?";
					else $where .=" or format=?";
					array_push($params,$v);
				}
				$where .=" )";
			}
			if(!empty($color_array)){
				$where .=" and (";
				foreach($color_array as $k => $v){
					if($k==0) $where .=" color=?";
					else $where .=" or color=?";
					array_push($params,$v);
				}
				$where .=" )";
			}
			if(!empty($material_array)){
				$where .=" and (";
				foreach($material_array as $k => $v){
					if($k==0) $where .=" material=?";
					else $where .=" or material=?";
					array_push($params,$v);
				}
				$where .=" )";
			}
			if(!empty($form_array)){
				$where .=" and (";
				foreach($form_array as $k => $v){
					if($k==0) $where .=" form=?";
					else $where .=" or form=?";
					array_push($params,$v);
				}
				$where .=" )";
			}
		}
		
		$curPage = $get_page;
		$per_page = 30;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select photo, ten$lang, tenkhongdauvi, tenkhongdauen, giamoi, gia, id,masp,tinhtrang from #_product where $where order by stt,id desc $limit";
		$product = $d->rawQuery($sql,$params);
		$sqlNum = "select count(*) as 'num' from #_product where $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,$params);
		$total = $count['num'];
		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($total,$per_page,$curPage,$url);
		$lastpage = ceil($total/$per_page);

		/* breadCrumbs */
		if($title_crumb) $breadcr->setBreadCrumbs($com,$title_crumb);
		$breadcrumbs = $breadcr->getBreadCrumbs();
	}
?>