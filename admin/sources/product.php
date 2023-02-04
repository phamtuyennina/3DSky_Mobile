<?php
	if(!defined('SOURCES')) die("Error");

	/* Kiểm tra active product */
	$arrCheck = array();
	foreach($config['product'] as $k => $v) $arrCheck[] = $k;
	if(!count($arrCheck) || !in_array($type,$arrCheck)) $func->transfer("Trang không tồn tại", "index.php", false);

	/* Cấu hình đường dẫn trả về */
	$strUrl = "";
	$arrUrl = array('id_list','id_cat','id_item','id_sub','id_brand');
	if(isset($_POST['data']))
	{
		$dataUrl = isset($_POST['data']) ? $_POST['data']:null;
		foreach($arrUrl as $k => $v)
		{
			if(!empty($dataUrl[$arrUrl[$k]])) $strUrl .= "&".$arrUrl[$k]."=".htmlspecialchars($dataUrl[$arrUrl[$k]]);
		}
	}
	else
	{
		foreach($arrUrl as $k => $v)
		{
			if(!empty($_REQUEST[$arrUrl[$k]])) $strUrl .= "&".$arrUrl[$k]."=".htmlspecialchars($_REQUEST[$arrUrl[$k]]);
		}
		if(!empty($_REQUEST['keyword'])) $strUrl .= "&keyword=".htmlspecialchars($_REQUEST['keyword']);
	}

	switch($act)
	{
		/* Man */
		case "man":
			get_items();
			$template = "product/man/items";
			break;
		case "add":
			$template = "product/man/item_add";
			break;
		case "edit":
		case "copy":
			if((!isset($config['product'][$type]['copy']) || $config['product'][$type]['copy']==false) && $act=='copy')
			{
				$template = "404";
				return false;
			}
			get_item();
			$template = "product/man/item_add";
			break;
		case "save":
		case "save_copy":
			save_item();
			break;
		case "delete":
			delete_item();
			break;

		/* Size */
		case "man_size":
			get_items_size();
			$template = "product/size/items";
			break;
		case "add_size":
			$template = "product/size/item_add";
			break;
		case "edit_size":
			get_item_size();
			$template = "product/size/item_add";
			break;
		case "save_size":
			save_item_size();
			break;
		case "delete_size":
			delete_item_size();
			break;

		/* Color */
		case "man_mau":
			get_items_mau();
			$template = "product/mau/items";
			break;
		case "add_mau":
			$template = "product/mau/item_add";
			break;
		case "edit_mau":
			get_item_mau();
			$template = "product/mau/item_add";
			break;
		case "save_mau":
			save_item_mau();
			break;
		case "delete_mau":
			delete_item_mau();
			break;

		/* Brand */
		case "man_brand":
			get_brands();
			$template = "product/brand/brand";
			break;
		case "add_brand":
			$template = "product/brand/brand_add";
			break;
		case "edit_brand":
			get_brand();
			$template = "product/brand/brand_add";
			break;
		case "save_brand":
			save_brand();
			break;
		case "delete_brand":
			delete_brand();
			break;

		/* List */
		case "man_list":
			get_lists();
			$template = "product/list/lists";
			break;
		case "add_list":
			$template = "product/list/list_add";
			break;
		case "edit_list":
			get_list();
			$template = "product/list/list_add";
			break;
		case "save_list":
			save_list();
			break;
		case "delete_list":
			delete_list();
			break;

		/* Cat */
		case "man_cat":
			get_cats();
			$template = "product/cat/cats";
			break;
		case "add_cat":
			$template = "product/cat/cat_add";
			break;
		case "edit_cat":
			get_cat();
			$template = "product/cat/cat_add";
			break;
		case "save_cat":
			save_cat();
			break;
		case "delete_cat":
			delete_cat();
			break;

		/* Item */
		case "man_item":
			get_loais();
			$template = "product/item/loais";
			break;
		case "add_item":
			$template = "product/item/loai_add";
			break;
		case "edit_item":
			get_loai();
			$template = "product/item/loai_add";
			break;
		case "save_item":
			save_loai();
			break;
		case "delete_item":
			delete_loai();
			break;

		/* Sub */
		case "man_sub":
			get_subs();
			$template = "product/sub/subs";
			break;
		case "add_sub":
			$template = "product/sub/sub_add";
			break;
		case "edit_sub":
			get_sub();
			$template = "product/sub/sub_add";
			break;
		case "save_sub":
			save_sub();
			break;
		case "delete_sub":
			delete_sub();
			break;
		
		/* Gallery */
		case "man_photo":
		case "add_photo":
		case "edit_photo":
		case "save_photo":
		case "delete_photo":
			include "gallery.php";
			break;

		default:
			$template = "404";
	}

	/* Get man */
	function get_items()
	{
		global $d, $func, $strUrl, $curPage, $items, $paging, $type;

		$where = "";
		$idlist = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']):'';
		$idcat = (isset($_REQUEST['id_cat'])) ? htmlspecialchars($_REQUEST['id_cat']):'';
		$iditem = (isset($_REQUEST['id_item'])) ? htmlspecialchars($_REQUEST['id_item']):'';
		$idsub = (isset($_REQUEST['id_sub'])) ? htmlspecialchars($_REQUEST['id_sub']):'';
		$idbrand = (isset($_REQUEST['id_brand'])) ? htmlspecialchars($_REQUEST['id_brand']):'';

		if(!empty($idlist)) $where .= " and id_list=$idlist";
		if(!empty($idcat)) $where .= " and id_cat=$idcat";
		if(!empty($iditem)) $where .= " and id_item=$iditem";
		if(!empty($idsub)) $where .= " and id_sub=$idsub";
		if(!empty($idbrand)) $where .= " and id_brand=$idbrand";
		if(!empty($_REQUEST['keyword']))
		{
			$keyword = (isset($_REQUEST['keyword'])) ? htmlspecialchars($_REQUEST['keyword']):'';
			$where .= " and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
		}

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_product where type = ? $where order by stt,id desc $limit";
		$items = $d->rawQuery($sql,array($type));
		$sqlNum = "select count(*) as 'num' from #_product where type = ? $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,array($type));
		$total = $count['num'];
		$url = "index.php?com=product&act=man".$strUrl."&type=".$type;
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit man */
	function get_item()
	{
		global $d, $func, $strUrl, $curPage, $item, $gallery, $type, $com;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;

		if(empty($id)) $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl, false);

		$item = $d->rawQueryOne("select * from #_product where id = ? and type = ?",array($id,$type));

		if(empty($item['id'])) $func->transfer("Dữ liệu không có thực", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl, false);

		/* Lấy hình ảnh con */
		$gallery = $d->rawQuery("select * from #_gallery where id_photo = ? and com = ? and type = ? and kind = ? and val = ? order by stt,id desc",array($id,$com,$type,'man',$type));
	}

	/* Save man */
	function save_item()
	{
		global $d, $strUrl, $func, $curPage, $config, $com, $act, $type, $config_base, $setting;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl, false);

		$savehere = (isset($_POST['save-here'])) ? true : false;
		$id = (isset($_POST['id'])) ? (int)htmlspecialchars($_POST['id']):0;

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data']:null;
		if(!empty($data)) { foreach($data as $column => $value) $data[$column] = htmlspecialchars($value); }
		if(isset($_POST['slugvi'])) $data['tenkhongdauvi'] = $func->changeTitle(htmlspecialchars($_POST['slugvi']));
		else $data['tenkhongdauvi'] = $func->changeTitle($data['tenvi']);
		if(isset($_POST['slugen'])) $data['tenkhongdauen'] = $func->changeTitle(htmlspecialchars($_POST['slugen']));
		else $data['tenkhongdauen'] = (isset($data['tenen'])) ? $func->changeTitle($data['tenen']):'';
		if(isset($config['product'][$type]['size']) && $config['product'][$type]['size']==true) 
		{
			if(!empty($_POST['size_group']) && $_POST['size_group']!='') $data['id_size'] = implode(",", $_POST['size_group']);
			else $data['id_size'] = "";
		}
		if(isset($config['product'][$type]['mau']) && $config['product'][$type]['mau']==true) 
		{
			if(!empty($_POST['mau_group']) && $_POST['mau_group']!='') $data['id_mau'] = implode(",", $_POST['mau_group']);
			else $data['id_mau'] = "";
		}
		if(isset($config['product'][$type]['tags']) && $config['product'][$type]['tags']==true) 
		{
			if(!empty($_POST['tags_group']) && $_POST['tags_group']!='') $data['id_tags'] = implode(",", $_POST['tags_group']);
			else $data['id_tags'] = "";
		}
		$data['gia'] = (isset($data['gia']) && $data['gia'] != '') ? str_replace(",","",$data['gia']) : 0;
		$data['giamoi'] = (isset($data['giamoi']) && $data['giamoi'] != '') ? str_replace(",","",$data['giamoi']) : 0;
		$data['giakm'] = (isset($data['giakm']) && $data['giakm'] != '') ? $data['giakm'] : 0;
		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
		$data['type'] = $type;

		/* Post seo */
		if(isset($config['product'][$type]['seo']) && $config['product'][$type]['seo']==true)
		{
			$dataSeo = $_POST['dataSeo'];
			foreach($dataSeo as $column => $value) $dataSeo[$column] = htmlspecialchars($value);
		}

		if($id && $act!='save_copy')
		{	
			if(isset($_FILES['file'])){
				$file_name = $func->uploadName($_FILES['file']["name"]);
				if($photo = $func->uploadImage("file", $config['product'][$type]['img_type'], UPLOAD_PRODUCT,$file_name)){
					$data['photo'] = $photo;
					$row = $d->rawQueryOne("select id, photo from #_product where id = ? and type = ?",array($id,$type));
					if(!empty($row['id'])) $func->delete_file(UPLOAD_PRODUCT.$row['photo']);
				}
			}
			
			if(isset($_FILES['file-taptin'])){
				$file_name = $func->uploadName($_FILES['file-taptin']["name"]);
				if($taptin = $func->uploadImage("file-taptin", $config['product'][$type]['file_type'],UPLOAD_FILE,$file_name)){
					$data['taptin'] = $taptin;
					$row = $d->rawQueryOne("select id, taptin from #_product where id = ? and type = ?",array($id,$type));
					if(!empty($row['id'])) $func->delete_file(UPLOAD_FILE.$row['taptin']);
				}	
			}
			

			/* Cập nhật hình ảnh con */
			if(isset($_FILES['files'])) 
			{
				if(isset($_POST['jfiler-items-exclude-files-0'])){
					$arr_chuoi = str_replace('"','',$_POST['jfiler-items-exclude-files-0']);
					$arr_chuoi = str_replace('[','',$arr_chuoi);
					$arr_chuoi = str_replace(']','',$arr_chuoi);
					$arr_chuoi = str_replace('\\','',$arr_chuoi);
					$arr_chuoi = str_replace('0://','',$arr_chuoi);
					$arr_file_del = explode(',',$arr_chuoi);
				}
				$dem = 0;
	            $myFile = $_FILES['files'];
	            $fileCount = count($myFile["name"]);

	            for($i=0;$i<$fileCount;$i++) 
	            {
	            	if($_FILES['files']['name'][$i]!='')
					{
						if(!in_array(($_FILES['files']['name'][$i]),$arr_file_del,true))
						{
							$file_name = $func->uploadName($myFile["name"][$i]);
							$file_ext = pathinfo($myFile["name"][$i], PATHINFO_EXTENSION);
							if(move_uploaded_file($myFile["tmp_name"][$i], UPLOAD_PRODUCT."/".$file_name.".".$file_ext))
				            {
								$data1['photo'] = $file_name.".".$file_ext;
								$data1['stt'] = (int)$_POST['stt-filer'][$dem];		
								$data1['tenvi'] = $_POST['ten-filer'][$dem];
								$data1['id_photo'] = $id;
								$data1['com'] = $com;
								$data1['type'] = $type;
								$data1['kind'] = 'man';
								$data1['val'] = $type;
								$data1['hienthi'] = 1;
								$d->insert('gallery',$data1);
				            }
				            $dem++;
						}
		            }
	            }
	        }

			$data['ngaysua'] = time();

			$d->where('id', $id);
			$d->where('type', $type);
			if($d->update('product',$data))
			{
				/* SEO */
				if(isset($config['product'][$type]['seo']) && $config['product'][$type]['seo']==true)
				{
					$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man',$type));

					$dataSeo['idmuc'] = $id;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'man';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}
				if(isset($config['product'][$type]['schema']) && $config['product'][$type]['schema'] == true)
				{
					//Kiểm tra nếu tạo Schema tự động
					if($buildSchema) {
						foreach($config['website']['seo'] as $k => $v) {
							//lấy tên danh mục
							$pro_list = $d->rawQueryOne("select id,ten$k as ten from #_product_list where id = ? and type = ? limit 0,1",array($data['id_list'],$type));
							//lấy url thuộc vi,en 
							if($k=='vi' || $k=='en'){
								$url_pro=$config_base.$data['tenkhongdau'.$k];
							}else{
								$url_pro=$config_base.$data['tenkhongdauvi'];
							}
							//Kiểm tra hình ảnh
							if($data['photo']!=''){
								$url_img_pro=$config_base.UPLOAD_PRODUCT_L.$data['photo'];
							}else{
								$img_pro = $d->rawQueryOne("select id, photo from #_product where id = ? and type = ? limit 0,1",array($id,$type));
								$url_img_pro=$config_base.UPLOAD_PRODUCT_L.$img_pro['photo'];
							}
							//Tiến hành build schema product
							$dataSchema['schema'.$k]=$func->buildSchemaProduct($id,$data['ten'.$k],$url_img_pro,$dataSeo['description'.$k],$data['masp'],$pro_list['ten'],$setting['ten'.$k],$url_pro,$data['gia']);
						}
					}else{
						$dataSchema = (isset($_POST['dataSchema'])) ? $_POST['dataSchema'] : null;
						if($dataSchema)
						{
							foreach($dataSchema as $column => $value)
							{
								$dataSchema[$column] = htmlspecialchars($value);
							}
						}
					}
					$d->where('idmuc', $id);
					$d->where('com', $com);
					$d->where('act', 'man');
					$d->where('type', $type);
					$d->update('seo',$dataSchema);
				}
				if($savehere) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=product&act=edit&type=".$type."&p=".$curPage.$strUrl."&id=".$id);
				else $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl);
			}
			else
			{
				if($savehere) $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=edit&type=".$type."&p=".$curPage.$strUrl."&id=".$id, false);
				else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl, false);
			}
		}
		else
		{
			if(isset($_FILES['file'])){
				$file_name = $func->uploadName($_FILES['file']["name"]);
				if($photo = $func->uploadImage("file", $config['product'][$type]['img_type'], UPLOAD_PRODUCT,$file_name))
				{
					$data['photo'] = $photo;
				}
			}

			if(isset($_FILES['file-taptin'])){
				$file_name = $func->uploadName($_FILES['file-taptin']["name"]);
				if($taptin = $func->uploadImage("file-taptin", $config['product'][$type]['file_type'],UPLOAD_FILE,$file_name))
				{
					$data['taptin'] = $taptin;		
				}
				}
		
			$data['ngaytao'] = time();

			if($d->insert('product',$data))
			{
				$id_insert = $d->getLastInsertId();

				/* SEO */
				if(isset($config['product'][$type]['seo']) && $config['product'][$type]['seo']==true)
				{
					$dataSeo['idmuc'] = $id_insert;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'man';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}
				/* Schema */
				if(isset($config['product'][$type]['schema']) && $config['product'][$type]['schema'] == true)
				{
					//Kiểm tra nếu tạo Schema tự động
					if($buildSchema) {
						foreach($config['website']['seo'] as $k => $v) {
							//lấy tên danh mục
							$pro_list = $d->rawQueryOne("select id,ten$k as ten from #_product_list where id = ? and type = ? limit 0,1",array($data['id_list'],$type));
							//lấy url thuộc vi,en 
							if($k=='vi' || $k=='en'){
								$url_pro=$config_base.$data['tenkhongdau'.$k];
							}else{
								$url_pro=$config_base.$data['tenkhongdauvi'];
							}
							//Tiến hành build schema product
							$dataSchema['schema'.$k]=$func->buildSchemaProduct($id_insert,$data['ten'.$k],$config_base.UPLOAD_PRODUCT_L.$data['photo'],$dataSeo['description'.$k],$data['masp'],$pro_list['ten'],$setting['ten'.$k],$url_pro,$data['gia']);
						}
					}else{
						$dataSchema = (isset($_POST['dataSchema'])) ? $_POST['dataSchema'] : null;
						if($dataSchema)
						{
							foreach($dataSchema as $column => $value)
							{
								$dataSchema[$column] = htmlspecialchars($value);
							}
						}
					}
					$d->where('idmuc', $id_insert);
					$d->where('com', $com);
					$d->where('act', 'man');
					$d->where('type', $type);
					$d->update('seo',$dataSchema);
				}
				/* Lưu hình ảnh con */
				if(isset($_FILES['files'])) 
				{
					if(isset($_POST['jfiler-items-exclude-files-0'])){
						$arr_chuoi = str_replace('"','',$_POST['jfiler-items-exclude-files-0']);
						$arr_chuoi = str_replace('[','',$arr_chuoi);
						$arr_chuoi = str_replace(']','',$arr_chuoi);
						$arr_chuoi = str_replace('\\','',$arr_chuoi);
						$arr_chuoi = str_replace('0://','',$arr_chuoi);
						$arr_file_del = explode(',',$arr_chuoi);
					}
					

					$dem = 0;
		            $myFile = $_FILES['files'];
		            $fileCount = count($myFile["name"]);

		            for($i=0;$i<$fileCount;$i++) 
		            {
		            	if($_FILES['files']['name'][$i]!='')
				    	{
							if(!in_array(($_FILES['files']['name'][$i]),$arr_file_del,true))
							{
								$file_name = $func->uploadName($myFile["name"][$i]);
								$file_ext = pathinfo($myFile["name"][$i], PATHINFO_EXTENSION);
								if(move_uploaded_file($myFile["tmp_name"][$i], UPLOAD_PRODUCT."/".$file_name.".".$file_ext))
					            {
									$data1['photo'] = $file_name.".".$file_ext;
									$data1['stt'] = (int)$_POST['stt-filer'][$dem];		
									$data1['tenvi'] = $_POST['ten-filer'][$dem];		
									$data1['id_photo'] = $id_insert;
									$data1['com'] = $com;
									$data1['type'] = $type;
									$data1['kind'] = 'man';
									$data1['val'] = $type;
									$data1['hienthi'] = 1;
									$d->insert('gallery',$data1);
					            }
					            $dem++;
							}
			            }
		            }
		        }

				if($act=='save_copy')
				{
					if($savehere) $func->transfer("Sao chép dữ liệu thành công", "index.php?com=product&act=edit&type=".$type."&p=".$curPage.$strUrl."&id=".$id_insert);
					else $func->transfer("Sao chép dữ liệu thành công", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl);
				}
				else
				{
					if($savehere) $func->transfer("Lưu dữ liệu thành công", "index.php?com=product&act=edit&type=".$type."&p=".$curPage.$strUrl."&id=".$id_insert);
					else $func->transfer("Lưu dữ liệu thành công", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl);
				}
			}
			else
			{
				if($act=='save_copy')
				{
					if($savehere) $func->transfer("Sao chép dữ liệu bị lỗi", "index.php?com=product&act=edit&type=".$type."&p=".$curPage.$strUrl."&id=".$id_insert, false);
					else $func->transfer("Sao chép dữ liệu bị lỗi", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl, false);
				}
				else
				{
					
					if($savehere) $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=edit&type=".$type."&p=".$curPage.$strUrl."&id=".$id_insert, false);
					else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl, false);
				}
			}
		}
	}

	/* Delete man */
	function delete_item()
	{
		global $d, $strUrl, $func, $curPage, $com, $type;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;

		if(isset($id) && $id!=0)
		{
			/* Xóa SEO */
			$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man',$type));

			/* Lấy dữ liệu */
			$row = $d->rawQueryOne("select id, photo, taptin from #_product where id = ? and type = ?",array($id,$type));

			if(!empty($row['id']))
			{
				$func->delete_file(UPLOAD_PRODUCT.$row['photo']);
				$func->delete_file(UPLOAD_FILE.$row['taptin']);
				$d->rawQuery("delete from #_product where id = ?",array($id));

				/* Xóa gallery */
				$row = $d->rawQuery("select id, photo, taptin from #_gallery where id_photo = ? and kind = ? and com = ?",array($id,'man',$com));

				if(count($row)>0)
				{
					foreach($row as $v)
					{
						$func->delete_file(UPLOAD_PRODUCT.$v['photo']);
						$func->delete_file(UPLOAD_FILE.$v['taptin']);
					}

					$d->rawQuery("delete from #_gallery where id_photo = ? and kind = ? and com = ?",array($id,'man',$com));
				}

				$func->transfer("Xóa dữ liệu thành công", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);

				/* Xóa SEO */
				$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man',$type));

				/* Lấy dữ liệu */
				$row = $d->rawQueryOne("select id, photo, taptin from #_product where id = ? and type = ?",array($id,$type));

				if(!empty($row['id']))
				{
					$func->delete_file(UPLOAD_PRODUCT.$row['photo']);
					$func->delete_file(UPLOAD_FILE.$row['taptin']);
					$d->rawQuery("delete from #_product where id = ?",array($id));

					/* Xóa gallery */
					$row = $d->rawQuery("select id, photo, taptin from #_gallery where id_photo = ? and kind = ? and com = ?",array($id,'man',$com));

					if(count($row)>0)
					{
						foreach($row as $v)
						{
							$func->delete_file(UPLOAD_PRODUCT.$v['photo']);
							$func->delete_file(UPLOAD_FILE.$v['taptin']);
						}

						$d->rawQuery("delete from #_gallery where id_photo = ? and kind = ? and com = ?",array($id,'man',$com));
					}
				}
			}

			$func->transfer("Xóa dữ liệu thành công", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl);
		} 
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man&type=".$type."&p=".$curPage.$strUrl, false);
	}

	/* Get size */
	function get_items_size()
	{
		global $d, $func, $curPage, $items, $paging, $type;

		$where = "";

		if(!empty($_REQUEST['keyword']))
		{
			$keyword = (isset($_REQUEST['keyword'])) ? htmlspecialchars($_REQUEST['keyword']):'';
			$where .= " and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
		}

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_product_size where type = ? $where order by stt,id desc $limit";
		$items = $d->rawQuery($sql,array($type));
		$sqlNum = "select count(*) as 'num' from #_product_size where type = ? $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,array($type));
		$total = $count['num'];
		$url = "index.php?com=product&act=man_size&type=".$type;
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit size */
	function get_item_size()
	{
		global $d, $func, $curPage, $item, $type;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;
		if(empty($id)) $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_size&type=".$type."&p=".$curPage, false);

		$item = $d->rawQueryOne("select * from #_product_size where id = ?",array($id));

		if(empty($item['id'])) $func->transfer("Dữ liệu không có thực", "index.php?com=product&act=man_size&type=".$type."&p=".$curPage, false);
	}

	/* Save size */
	function save_item_size()
	{
		global $d, $func, $curPage, $config, $type;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_size&type=".$type."&p=".$curPage, false);

		$id = (isset($_POST['id'])) ? (int)htmlspecialchars($_POST['id']):0;

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data']:null;
		if(!empty($data)) { foreach($data as $column => $value) $data[$column] = htmlspecialchars($value); }
		$data['gia'] = ($data['gia']) ? str_replace(",","",$data['gia']) : 0;
		$data['hienthi'] = ($data['hienthi']) ? 1 : 0;
		$data['type'] = $type;

		if(isset($id) && $id!=0)
		{
			$data['ngaysua'] = time();

			$d->where('id', $id);
			$d->where('type', $type);
			if($d->update('product_size',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=product&act=man_size&type=".$type."&p=".$curPage);
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_size&type=".$type."&p=".$curPage, false);
		}
		else
		{
			$data['ngaytao'] = time();

			if($d->insert('product_size',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=product&act=man_size&type=".$type."&p=".$curPage);
			else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_size&type=".$type."&p=".$curPage, false);
		}
	}

	/* Delete size */
	function delete_item_size()
	{
		global $d, $func, $curPage, $type;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;

		if(isset($id) && $id!=0)
		{
			$row = $d->rawQueryOne("select id from #_product_size where id = ? and type = ?",array($id,$type));

			if(!empty($row['id']))
			{
				$d->rawQuery("delete from #_product_size where id = ? and type = ?",array($id,$type));
				$func->transfer("Xóa dữ liệu thành công", "index.php?com=product&act=man_size&type=".$type."&p=".$curPage);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_size&type=".$type."&p=".$curPage, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);
				$row = $d->rawQueryOne("select id from #_product_size where id = ? and type = ?",array($id,$type));

				if(!empty($row['id'])) $d->rawQuery("delete from #_product_size where id = ? and type = ?",array($id,$type));
			}

			$func->transfer("Xóa dữ liệu thành công", "index.php?com=product&act=man_size&type=".$type."&p=".$curPage);
		} 
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_size&type=".$type."&p=".$curPage, false);
	}

	/* Get color */
	function get_items_mau()
	{
		global $d, $func, $curPage, $items, $paging, $type;

		$where = "";

		if(!empty($_REQUEST['keyword']))
		{
			$keyword = (isset($_REQUEST['keyword'])) ? htmlspecialchars($_REQUEST['keyword']):'';
			$where .= " and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
		}

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_product_mau where type = ? $where order by stt,id desc $limit";
		$items = $d->rawQuery($sql,array($type));
		$sqlNum = "select count(*) as 'num' from #_product_mau where type = ? $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,array($type));
		$total = $count['num'];
		$url = "index.php?com=product&act=man_mau&type=".$type;
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit color */
	function get_item_mau()
	{
		global $d, $func, $curPage, $item, $type;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;
		if(empty($id)) $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_mau&type=".$type."&p=".$curPage, false);

		$item = $d->rawQueryOne("select * from #_product_mau where id = ?",array($id));

		if(empty($item['id'])) $func->transfer("Dữ liệu không có thực", "index.php?com=product&act=man_mau&type=".$type."&p=".$curPage, false);
	}

	/* Save color */
	function save_item_mau()
	{
		global $d, $func, $curPage, $config, $type;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_mau&type=".$type."&p=".$curPage, false);

		$file_name = $func->uploadName($_FILES['file']["name"]);
		$id = (isset($_POST['id'])) ? (int)htmlspecialchars($_POST['id']):0;

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data']:null;
		if(!empty($data)) { foreach($data as $column => $value) $data[$column] = htmlspecialchars($value); }
		$data['gia'] = ($data['gia']) ? str_replace(",","",$data['gia']) : 0;
		$data['hienthi'] = ($data['hienthi']) ? 1 : 0;
		$data['type'] = $type;

		if(isset($id) && $id!=0)
		{
			if($photo = $func->uploadImage("file", $config['product'][$type]['img_type_mau'], UPLOAD_COLOR,$file_name))
			{
				$data['photo'] = $photo;
				$row = $d->rawQueryOne("select id, photo from #_product_mau where id = ? and type = ?",array($id,$type));
				if(!empty($row['id'])) $func->delete_file(UPLOAD_COLOR.$row['photo']);
			}

			$data['ngaysua'] = time();

			$d->where('id', $id);
			$d->where('type', $type);
			if($d->update('product_mau',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=product&act=man_mau&type=".$type."&p=".$curPage);
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_mau&type=".$type."&p=".$curPage, false);
		}
		else
		{	
			if($photo = $func->uploadImage("file", $config['product'][$type]['img_type_mau'], UPLOAD_COLOR,$file_name))
			{
				$data['photo'] = $photo;
			}

			$data['ngaytao'] = time();

			if($d->insert('product_mau',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=product&act=man_mau&type=".$type."&p=".$curPage);
			else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_mau&type=".$type."&p=".$curPage, false);
		}
	}

	/* Delete color */
	function delete_item_mau()
	{
		global $d, $curPage, $func, $type;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;

		if(isset($id) && $id!=0)
		{
			$row = $d->rawQueryOne("select * from #_product_mau where id = ? and type = ?",array($id,$type));

			if(!empty($row['id']))
			{
				$func->delete_file(UPLOAD_COLOR.$row['photo']);
				$d->rawQuery("delete from #_product_mau where id = ?",array($id));

				$func->transfer("Xóa dữ liệu thành công", "index.php?com=product&act=man_mau&type=".$type."&p=".$curPage);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_mau&type=".$type."&p=".$curPage, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);
				$row = $d->rawQueryOne("select * from #_product_mau where id = ? and type = ?",array($id,$type));

				if(!empty($row['id']))
				{
					$func->delete_file(UPLOAD_COLOR.$row['photo']);
					$d->rawQuery("delete from #_product_mau where id = ?",array($id));
				}
			}
			$func->transfer("Xóa dữ liệu thành công", "index.php?com=product&act=man_mau&type=".$type."&p=".$curPage);
		} 
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_mau&type=".$type."&p=".$curPage, false);
	}

	/* Get list */
	function get_lists()
	{
		global $d, $func, $strUrl, $curPage, $items, $paging, $type;
		
		$where = "";

		if(!empty($_REQUEST['keyword']))
		{
			$keyword = (isset($_REQUEST['keyword'])) ? htmlspecialchars($_REQUEST['keyword']):'';
			$where .= " and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
		}

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_product_list where type = ? $where order by stt,id desc $limit";
		$items = $d->rawQuery($sql,array($type));
		$sqlNum = "select count(*) as 'num' from #_product_list where type = ? $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,array($type));
		$total = $count['num'];
		$url = "index.php?com=product&act=man_list&type=".$type;
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit list */
	function get_list()
	{
		global $d, $func, $strUrl, $curPage, $item, $gallery, $type, $com;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;

		if(empty($id)) $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_list&type=".$type."&p=".$curPage.$strUrl, false);

		$item = $d->rawQueryOne("select * from #_product_list where id = ? and type = ?",array($id,$type));
		
		if(empty($item['id'])) $func->transfer("Dữ liệu không có thực", "index.php?com=product&act=man_list&type=".$type."&p=".$curPage.$strUrl, false);

		/* Lấy hình ảnh con */
		$gallery = $d->rawQuery("select * from #_gallery where id_photo = ? and com = ? and type = ? and kind = ? and val = ? order by stt,id desc",array($id,$com,$type,'man_list',$type));
	}

	/* Save list */
	function save_list()
	{
		global $d, $strUrl, $func, $curPage, $config, $com, $type;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_list&type=".$type."&p=".$curPage.$strUrl, false);

		$file_name = $func->uploadName($_FILES['file']["name"]);
		$id = (isset($_POST['id'])) ? (int)htmlspecialchars($_POST['id']):0;

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data']:null;
		if(!empty($data)) { foreach($data as $column => $value) $data[$column] = htmlspecialchars($value); }
		if(isset($_POST['slugvi'])) $data['tenkhongdauvi'] = $func->changeTitle(htmlspecialchars($_POST['slugvi']));
		else $data['tenkhongdauvi'] = $func->changeTitle($data['tenvi']);
		if(isset($_POST['slugen'])) $data['tenkhongdauen'] = $func->changeTitle(htmlspecialchars($_POST['slugen']));
		else $data['tenkhongdauen'] = (isset($data['tenen'])) ? $func->changeTitle($data['tenen']):'';
		$data['hienthi'] = ($data['hienthi']) ? 1 : 0;
		$data['type'] = $type;

		/* Post seo */
		if($config['product'][$type]['seo_list'])
		{
			$dataSeo = $_POST['dataSeo'];
			foreach($dataSeo as $column => $value) $dataSeo[$column] = htmlspecialchars($value);
		}

		if(isset($id) && $id!=0)
		{					
			if($photo = $func->uploadImage("file", $config['product'][$type]['img_type_list'], UPLOAD_PRODUCT,$file_name))
			{
				$data['photo'] = $photo;
				$row = $d->rawQueryOne("select id, photo from #_product_list where id = ? and type = ?",array($id,$type));
				if(!empty($row['id'])) $func->delete_file(UPLOAD_PRODUCT.$row['photo']);
			}

	        /* Cập nhật hình ảnh con */
			if(isset($_FILES['files'])) 
			{
				if(isset($_POST['jfiler-items-exclude-files-0'])){
					$arr_chuoi = str_replace('"','',$_POST['jfiler-items-exclude-files-0']);
		        	$arr_chuoi = str_replace('[','',$arr_chuoi);
		        	$arr_chuoi = str_replace(']','',$arr_chuoi);
		        	$arr_chuoi = str_replace('\\','',$arr_chuoi);
		        	$arr_chuoi = str_replace('0://','',$arr_chuoi);
		        	$arr_file_del = explode(',',$arr_chuoi);
				}
				

	        	$dem = 0;
	            $myFile = $_FILES['files'];
	            $fileCount = count($myFile["name"]);

	            for($i=0;$i<$fileCount;$i++) 
	            {
	            	if($_FILES['files']['name'][$i]!='')
	            	{
						if(!in_array(($_FILES['files']['name'][$i]),$arr_file_del,true))
						{
							$file_name = $func->uploadName($myFile["name"][$i]);
							$file_ext = pathinfo($myFile["name"][$i], PATHINFO_EXTENSION);
							if(move_uploaded_file($myFile["tmp_name"][$i], UPLOAD_PRODUCT."/".$file_name.".".$file_ext))
				            {
								$data1['photo'] = $file_name.".".$file_ext;
								$data1['stt'] = (int)$_POST['stt-filer'][$dem];		
								$data1['tenvi'] = $_POST['ten-filer'][$dem];
								$data1['id_photo'] = $id;
								$data1['com'] = $com;
								$data1['type'] = $type;
								$data1['kind'] = 'man_list';
								$data1['val'] = $type;
								$data1['hienthi'] = 1;
								$d->insert('gallery',$data1);
				            }
				            $dem++;
						}
	            	}
	            }
	        }

			$data['ngaysua'] = time();
			
			$d->where('id', $id);
			$d->where('type', $type);
			if($d->update('product_list',$data))
			{
				/* SEO */
				if($config['product'][$type]['seo_list'])
				{
					$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_list',$type));

					$dataSeo['idmuc'] = $id;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'man_list';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}

				$func->transfer("Cập nhật dữ liệu thành công", "index.php?com=product&act=man_list&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_list&type=".$type."&p=".$curPage.$strUrl, false);
		}
		else
		{				
			if($photo = $func->uploadImage("file", $config['product'][$type]['img_type_list'], UPLOAD_PRODUCT,$file_name))
			{
				$data['photo'] = $photo;
			}
			
			$data['ngaytao'] = time();
			
			if($d->insert('product_list',$data))
			{
				$id_insert = $d->getLastInsertId();

				/* SEO */
				if($config['product'][$type]['seo_list'])
				{
					$dataSeo['idmuc'] = $id_insert;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'man_list';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}

				/* Lưu hình ảnh con */
				if(isset($_FILES['files'])) 
				{
					if(isset($_POST['jfiler-items-exclude-files-0'])){
						$arr_chuoi = str_replace('"','',$_POST['jfiler-items-exclude-files-0']);
						$arr_chuoi = str_replace('[','',$arr_chuoi);
						$arr_chuoi = str_replace(']','',$arr_chuoi);
						$arr_chuoi = str_replace('\\','',$arr_chuoi);
						$arr_chuoi = str_replace('0://','',$arr_chuoi);
						$arr_file_del = explode(',',$arr_chuoi);
					}
					$dem = 0;
		            $myFile = $_FILES['files'];
		            $fileCount = count($myFile["name"]);

		            for($i=0;$i<$fileCount;$i++) 
		            {
		            	if($_FILES['files']['name'][$i]!='')
						{
							if(!in_array(($_FILES['files']['name'][$i]),$arr_file_del,true))
							{
								$file_name = $func->uploadName($myFile["name"][$i]);
								$file_ext = pathinfo($myFile["name"][$i], PATHINFO_EXTENSION);
								if(move_uploaded_file($myFile["tmp_name"][$i], UPLOAD_PRODUCT."/".$file_name.".".$file_ext))
					            {
									$data1['photo'] = $file_name.".".$file_ext;
									$data1['stt'] = (int)$_POST['stt-filer'][$dem];		
									$data1['tenvi'] = $_POST['ten-filer'][$dem];
									$data1['id_photo'] = $id_insert;
									$data1['com'] = $com;
									$data1['type'] = $type;
									$data1['kind'] = 'man_list';
									$data1['val'] = $type;
									$data1['hienthi'] = 1;
									$d->insert('gallery',$data1);
					            }
					            $dem++;
							}
			            }
		            }
		        }

				$func->transfer("Lưu dữ liệu thành công", "index.php?com=product&act=man_list&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_list&type=".$type."&p=".$curPage.$strUrl, false);
		}
	}

	/* Delete list */
	function delete_list()
	{
		global $d, $strUrl, $func, $curPage, $com, $type;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;

		if(isset($_GET['id']))
		{
			/* Xóa SEO */
			$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_list',$type));

			/* Lấy dữ liệu */
			$row = $d->rawQueryOne("select id, photo from #_product_list where id = ? and type = ?",array($id,$type));

			if(!empty($row['id']))
			{
				$func->delete_file(UPLOAD_PRODUCT.$row['photo']);
				$d->rawQuery("delete from #_product_list where id = ?",array($id));

				/* Xóa gallery */
				$row = $d->rawQuery("select id, photo from #_gallery where id_photo = ? and kind = ? and com = ?",array($id,'man_list',$com));

				if(count($row)>0)
				{
					foreach($row as $v)
					{
						$func->delete_file(UPLOAD_PRODUCT.$v['photo']);
					}

					$d->rawQuery("delete from #_gallery where id_photo = ? and kind = ? and com = ?",array($id,'man_list',$com));
				}

				$func->transfer("Xóa dữ liệu thành công", "index.php?com=product&act=man_list&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_list&type=".$type."&p=".$curPage.$strUrl, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);

				/* Xóa SEO */
				$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_list',$type));

				/* Lấy dữ liệu */
				$row = $d->rawQueryOne("select id, photo from #_product_list where id = ? and type = ?",array($id,$type));

				if(!empty($row['id']))
				{
					$func->delete_file(UPLOAD_PRODUCT.$row['photo']);
					$d->rawQuery("delete from #_product_list where id = ?",array($id));

					/* Xóa gallery */
					$row = $d->rawQuery("select id, photo from #_gallery where id_photo = ? and kind = ? and com = ?",array($id,'man_list',$com));

					if(count($row)>0)
					{
						foreach($row as $v)
						{
							$func->delete_file(UPLOAD_PRODUCT.$v['photo']);
						}

						$d->rawQuery("delete from #_gallery where id_photo = ? and kind = ? and com = ?",array($id,'man_list',$com));
					}
				}
			}

			$func->transfer("Xóa dữ liệu thành công", "index.php?com=product&act=man_list&type=".$type."&p=".$curPage.$strUrl);
		}
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_list&type=".$type."&p=".$curPage.$strUrl, false);
	}

	/* Get cat */
	function get_cats()
	{
		global $d, $func, $strUrl, $curPage, $items, $paging, $type;
		
		$where = "";
		$idlist = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']):'';

		if($idlist) $where .= " and id_list=$idlist";
		if(!empty($_REQUEST['keyword']))
		{
			$keyword = (isset($_REQUEST['keyword'])) ? htmlspecialchars($_REQUEST['keyword']):'';
			$where .= " and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
		}

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_product_cat where type = ? $where order by stt,id desc $limit";
		$items = $d->rawQuery($sql,array($type));
		$sqlNum = "select count(*) as 'num' from #_product_cat where type = ? $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,array($type));
		$total = $count['num'];
		$url = "index.php?com=product&act=man_cat".$strUrl."&type=".$type;
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit cat */
	function get_cat()
	{
		global $d, $func, $strUrl, $curPage, $item, $type;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;

		if(empty($id)) $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_cat&type=".$type."&p=".$curPage.$strUrl, false);
		
		$item = $d->rawQueryOne("select * from #_product_cat where id = ? and type = ?",array($id,$type));

		if(empty($item['id'])) $func->transfer("Dữ liệu không có thực", "index.php?com=product&act=man_cat&type=".$type."&p=".$curPage.$strUrl, false);
	}

	/* Save cat */
	function save_cat()
	{
		global $d, $strUrl, $func, $curPage, $config, $com, $type;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_cat&type=".$type."&p=".$curPage.$strUrl, false);

		$file_name = $func->uploadName($_FILES['file']["name"]);
		$id = (isset($_POST['id'])) ? (int)htmlspecialchars($_POST['id']):0;

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data']:null;
		if(!empty($data)) { foreach($data as $column => $value) $data[$column] = htmlspecialchars($value); }
		if(isset($_POST['slugvi'])) $data['tenkhongdauvi'] = $func->changeTitle(htmlspecialchars($_POST['slugvi']));
		else $data['tenkhongdauvi'] = $func->changeTitle($data['tenvi']);
		if(isset($_POST['slugen'])) $data['tenkhongdauen'] = $func->changeTitle(htmlspecialchars($_POST['slugen']));
		else $data['tenkhongdauen'] = (isset($data['tenen'])) ? $func->changeTitle($data['tenen']):'';
		$data['hienthi'] = ($data['hienthi']) ? 1 : 0;
		$data['type'] = $type;

		/* Post seo */
		if($config['product'][$type]['seo_cat'])
		{
			$dataSeo = $_POST['dataSeo'];
			foreach($dataSeo as $column => $value) $dataSeo[$column] = htmlspecialchars($value);
		}

		if(isset($id) && $id!=0)
		{
			if($photo = $func->uploadImage("file", $config['product'][$type]['img_type_cat'], UPLOAD_PRODUCT,$file_name))
			{
				$data['photo'] = $photo;
				$row = $d->rawQueryOne("select id, photo from #_product_cat where id = ? and type = ?",array($id,$type));
				if(!empty($row['id'])) $func->delete_file(UPLOAD_PRODUCT.$row['photo']);
			}

			$data['ngaysua'] = time();
			
			$d->where('id', $id);
			$d->where('type', $type);
			if($d->update('product_cat',$data))
			{
				/* SEO */
				if($config['product'][$type]['seo_cat'])
				{
					$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_cat',$type));

					$dataSeo['idmuc'] = $id;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'man_cat';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}

				$func->transfer("Cập nhật dữ liệu thành công", "index.php?com=product&act=man_cat&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_cat&type=".$type."&p=".$curPage.$strUrl, false);
		}
		else
		{		
			if($photo = $func->uploadImage("file", $config['product'][$type]['img_type_cat'], UPLOAD_PRODUCT,$file_name))
			{
				$data['photo'] = $photo;
			}

			$data['ngaytao'] = time();
			
			if($d->insert('product_cat',$data))
			{
				$id_insert = $d->getLastInsertId();

				/* SEO */
				if($config['product'][$type]['seo_cat'])
				{
					$dataSeo['idmuc'] = $id_insert;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'man_cat';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}
				$func->transfer("Lưu dữ liệu thành công", "index.php?com=product&act=man_cat&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_cat&type=".$type."&p=".$curPage.$strUrl, false);
		}
	}

	/* Delete cat */
	function delete_cat()
	{
		global $d, $strUrl, $func, $curPage, $com, $type;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;

		if(isset($id) && $id!=0)
		{
			/* Xóa SEO */
			$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_cat',$type));

			/* Lấy dữ liệu */
			$row = $d->rawQueryOne("select id, photo from #_product_cat where id = ? and type = ?",array($id,$type));

			if(!empty($row['id']))
			{
				$func->delete_file(UPLOAD_PRODUCT.$row['photo']);
				$d->rawQuery("delete from #_product_cat where id = ?",array($id));

				$func->transfer("Xóa dữ liệu thành công", "index.php?com=product&act=man_cat&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_cat&type=".$type."&p=".$curPage.$strUrl, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);

				/* Xóa SEO */
				$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_cat',$type));

				/* Lấy dữ liệu */
				$row = $d->rawQueryOne("select id, photo from #_product_cat where id = ? and type = ?",array($id,$type));

				if(!empty($row['id']))
				{
					$func->delete_file(UPLOAD_PRODUCT.$row['photo']);
					$d->rawQuery("delete from #_product_cat where id = ?",array($id));
				}
			}

			$func->transfer("Xóa dữ liệu thành công", "index.php?com=product&act=man_cat&type=".$type."&p=".$curPage.$strUrl);
		}
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_cat&type=".$type."&p=".$curPage.$strUrl, false);
	}

	/* Get item */
	function get_loais()
	{
		global $d, $func, $strUrl, $curPage, $items, $paging, $type;
		
		$where = "";
		$idlist = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']):'';
		$idcat = (isset($_REQUEST['id_cat'])) ? htmlspecialchars($_REQUEST['id_cat']):'';

		if($idlist) $where .= " and id_list=$idlist";
		if($idcat) $where .= " and id_cat=$idcat";
		if(!empty($_REQUEST['keyword']))
		{
			$keyword = (isset($_REQUEST['keyword'])) ? htmlspecialchars($_REQUEST['keyword']):'';
			$where .= " and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
		}

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_product_item where type = ? $where order by stt,id desc $limit";
		$items = $d->rawQuery($sql,array($type));
		$sqlNum = "select count(*) as 'num' from #_product_item where type = ? $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,array($type));
		$total = $count['num'];
		$url = "index.php?com=product&act=man_item".$strUrl."&type=".$type;
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit item */
	function get_loai()
	{
		global $d, $func, $strUrl, $curPage, $item, $type;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;

		if(empty($id)) $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_item&type=".$type."&p=".$curPage.$strUrl, false);
		
		$item = $d->rawQueryOne("select * from #_product_item where id = ? and type = ?",array($id,$type));

		if(empty($item['id'])) $func->transfer("Dữ liệu không có thực", "index.php?com=product&act=man_item&type=".$type."&p=".$curPage.$strUrl, false);
	}

	/* Save item */
	function save_loai()
	{
		global $d, $strUrl, $func, $curPage, $config, $com, $type;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_item&type=".$type."&p=".$curPage.$strUrl, false);

		$file_name = $func->uploadName($_FILES['file']["name"]);
		$id = (isset($_POST['id'])) ? (int)htmlspecialchars($_POST['id']):0;

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data']:null;
		if(!empty($data)) { foreach($data as $column => $value) $data[$column] = htmlspecialchars($value); }
		if(isset($_POST['slugvi'])) $data['tenkhongdauvi'] = $func->changeTitle(htmlspecialchars($_POST['slugvi']));
		else $data['tenkhongdauvi'] = $func->changeTitle($data['tenvi']);
		if(isset($_POST['slugen'])) $data['tenkhongdauen'] = $func->changeTitle(htmlspecialchars($_POST['slugen']));
		else $data['tenkhongdauen'] = (isset($data['tenen'])) ? $func->changeTitle($data['tenen']):'';
		$data['hienthi'] = ($data['hienthi']) ? 1 : 0;
		$data['type'] = $type;

		/* Post seo */
		if($config['product'][$type]['seo_item'])
		{
			$dataSeo = $_POST['dataSeo'];
			foreach($dataSeo as $column => $value) $dataSeo[$column] = htmlspecialchars($value);
		}

		if(isset($id) && $id!=0)
		{
			if($photo = $func->uploadImage("file", $config['product'][$type]['img_type_item'], UPLOAD_PRODUCT,$file_name))
			{
				$data['photo'] = $photo;
				$row = $d->rawQueryOne("select id, photo from #_product_item where id = ? and type = ?",array($id,$type));
				if(!empty($row['id'])) $func->delete_file(UPLOAD_PRODUCT.$row['photo']);
			}

			$data['ngaysua'] = time();
			
			$d->where('id', $id);
			$d->where('type', $type);
			if($d->update('product_item',$data))
			{
				/* SEO */
				if($config['product'][$type]['seo_item'])
				{
					$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_item',$type));

					$dataSeo['idmuc'] = $id;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'man_item';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}

				$func->transfer("Cập nhật dữ liệu thành công", "index.php?com=product&act=man_item&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_item&type=".$type."&p=".$curPage.$strUrl, false);
		}
		else
		{	
			if($photo = $func->uploadImage("file", $config['product'][$type]['img_type_item'], UPLOAD_PRODUCT,$file_name))
			{
				$data['photo'] = $photo;
			}	

			$data['ngaytao'] = time();
			
			if($d->insert('product_item',$data))
			{
				$id_insert = $d->getLastInsertId();

				/* SEO */
				if($config['product'][$type]['seo_item'])
				{
					$dataSeo['idmuc'] = $id_insert;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'man_item';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}

				$func->transfer("Lưu dữ liệu thành công", "index.php?com=product&act=man_item&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_item&type=".$type."&p=".$curPage.$strUrl, false);
		}
	}

	/* Delete item */
	function delete_loai()
	{
		global $d, $strUrl, $func, $curPage, $com, $type;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;

		if(isset($id) && $id!=0)
		{
			/* Xóa SEO */
			$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_item',$type));

			/* Lấy dữ liệu */
			$row = $d->rawQueryOne("select id, photo from #_product_item where id = ? and type = ?",array($id,$type));

			if(!empty($row['id']))
			{
				$func->delete_file(UPLOAD_PRODUCT.$row['photo']);
				$d->rawQuery("delete from #_product_item where id = ?",array($id));

				$func->transfer("Xóa dữ liệu thành công", "index.php?com=product&act=man_item&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_item&type=".$type."&p=".$curPage.$strUrl, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);

				/* Xóa SEO */
				$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_item',$type));

				/* Lấy dữ liệu */
				$row = $d->rawQueryOne("select id, photo from #_product_item where id = ? and type = ?",array($id,$type));

				if(!empty($row['id']))
				{
					$func->delete_file(UPLOAD_PRODUCT.$row['photo']);
					$d->rawQuery("delete from #_product_item where id = ?",array($id));
				}
			}

			$func->transfer("Xóa dữ liệu thành công", "index.php?com=product&act=man_item&type=".$type."&p=".$curPage.$strUrl);
		}
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_item&type=".$type."&p=".$curPage.$strUrl, false);
	}

	/* Get sub */
	function get_subs()
	{
		global $d, $func, $strUrl, $curPage, $items, $paging, $type;

		$where = "";	
		
		$idlist = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']):'';
		$idcat = (isset($_REQUEST['id_cat'])) ? htmlspecialchars($_REQUEST['id_cat']):'';
		$iditem = (isset($_REQUEST['id_item'])) ? htmlspecialchars($_REQUEST['id_item']):'';
		$keyword = (isset($_REQUEST['keyword'])) ? htmlspecialchars($_REQUEST['keyword']):'';
		if($idlist) $where .= " and id_list=$idlist";
		if($idcat) $where .= " and id_cat=$idcat";
		if($iditem) $where .= " and id_item=$iditem";
		if($keyword!='')
		{
			$keyword = (isset($_REQUEST['keyword'])) ? htmlspecialchars($_REQUEST['keyword']):'';
			$where .= " and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
		}

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_product_sub where type = ? $where order by stt,id desc $limit";
		$items = $d->rawQuery($sql,array($type));
		$sqlNum = "select count(*) as 'num' from #_product_sub where type = ? $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,array($type));
		$total = $count['num'];
		$url = "index.php?com=product&act=man_sub".$strUrl."&type=".$type;
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit sub */
	function get_sub()
	{
		global $d, $func, $strUrl, $curPage, $item, $type;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;

		if(empty($id)) $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_sub&type=".$type."&p=".$curPage.$strUrl, false);

		$item = $d->rawQueryOne("select * from #_product_sub where id = ? and type = ?",array($id,$type));

		if(empty($item['id'])) $func->transfer("Dữ liệu không có thực", "index.php?com=product&act=man_sub&type=".$type."&p=".$curPage.$strUrl, false);
	}

	/* Save sub */
	function save_sub()
	{
		global $d, $strUrl, $func, $curPage, $config, $com, $type;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_sub&type=".$type."&p=".$curPage.$strUrl, false);

		$file_name = $func->uploadName($_FILES['file']["name"]);
		$id = (isset($_POST['id'])) ? (int)htmlspecialchars($_POST['id']):0;
		
		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data']:null;
		if(!empty($data)) { foreach($data as $column => $value) $data[$column] = htmlspecialchars($value); }
		if(isset($_POST['slugvi'])) $data['tenkhongdauvi'] = $func->changeTitle(htmlspecialchars($_POST['slugvi']));
		else $data['tenkhongdauvi'] = $func->changeTitle($data['tenvi']);
		if(isset($_POST['slugen'])) $data['tenkhongdauen'] = $func->changeTitle(htmlspecialchars($_POST['slugen']));
		else $data['tenkhongdauen'] = (isset($data['tenen'])) ? $func->changeTitle($data['tenen']):'';
		$data['hienthi'] = ($data['hienthi']) ? 1 : 0;
		$data['type'] = $type;

		/* Post seo */
		if(!empty($config['product'][$type]['seo_sub']) && $config['product'][$type]['seo_sub']==true)
		{
			$dataSeo = $_POST['dataSeo'];
			foreach($dataSeo as $column => $value) $dataSeo[$column] = htmlspecialchars($value);
		}

		if(isset($id) && $id!=0)
		{
			if($photo = $func->uploadImage("file", $config['product'][$type]['img_type_sub'], UPLOAD_PRODUCT,$file_name))
			{
				$data['photo'] = $photo;
				$row = $d->rawQueryOne("select id, photo from #_product_sub where id = ? and type = ?",array($id,$type));
				if(!empty($row['id'])) $func->delete_file(UPLOAD_PRODUCT.$row['photo']);
			}

			$data['ngaysua'] = time();
			
			$d->where('id', $id);
			$d->where('type', $type);
			if($d->update('product_sub',$data))
			{
				/* SEO */
				if(!empty($config['product'][$type]['seo_sub']) && $config['product'][$type]['seo_sub']==true)
				{
					$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_sub',$type));

					$dataSeo['idmuc'] = $id;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'man_sub';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}

				$func->transfer("Cập nhật dữ liệu thành công", "index.php?com=product&act=man_sub&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_sub&type=".$type."&p=".$curPage.$strUrl, false);
		}
		else
		{	
			if($photo = $func->uploadImage("file", $config['product'][$type]['img_type_sub'], UPLOAD_PRODUCT,$file_name))
			{
				$data['photo'] = $photo;
			}

			$data['ngaytao'] = time();
			
			if($d->insert('product_sub',$data))
			{
				$id_insert = $d->getLastInsertId();

				/* SEO */
				if(!empty($config['product'][$type]['seo_sub']) && $config['product'][$type]['seo_sub']==true)
				{
					$dataSeo['idmuc'] = $id_insert;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'man_sub';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}

				$func->transfer("Lưu dữ liệu thành công", "index.php?com=product&act=man_sub&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_sub&type=".$type."&p=".$curPage.$strUrl, false);
		}
	}

	/* Delete sub */
	function delete_sub()
	{
		global $d, $strUrl, $func, $curPage, $com, $type;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;

		if(isset($id) && $id!=0)
		{
			/* Xóa SEO */
			$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_sub',$type));

			/* Lấy dữ liệu */
			$row = $d->rawQueryOne("select id, photo from #_product_sub where id = ? and type = ?",array($id,$type));

			if(!empty($row['id']))
			{
				$func->delete_file(UPLOAD_PRODUCT.$row['photo']);
				$d->rawQuery("delete from #_product_sub where id = ?",array($id));

				$func->transfer("Xóa dữ liệu thành công", "index.php?com=product&act=man_sub&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_sub&type=".$type."&p=".$curPage.$strUrl, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);

				/* Xóa SEO */
				$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_sub',$type));

				/* Lấy dữ liệu */
				$row = $d->rawQueryOne("select id, photo from #_product_sub where id = ? and type = ?",array($id,$type));

				if(!empty($row['id']))
				{
					$func->delete_file(UPLOAD_PRODUCT.$row['photo']);
					$d->rawQuery("delete from #_product_sub where id = ?",array($id));
				}
			}

			$func->transfer("Xóa dữ liệu thành công", "index.php?com=product&act=man_sub&type=".$type."&p=".$curPage.$strUrl);
		}
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_sub&type=".$type."&p=".$curPage.$strUrl, false);
	}

	/* Get brand */
	function get_brands()
	{
		global $d, $func, $strUrl, $curPage, $items, $paging, $type;

		$where = "";

		if(!empty($_REQUEST['keyword']))
		{
			$keyword = (isset($_REQUEST['keyword'])) ? htmlspecialchars($_REQUEST['keyword']):'';
			$where .= " and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
		}

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_product_brand where type = ? $where order by stt,id desc $limit";
		$items = $d->rawQuery($sql,array($type));
		$sqlNum = "select count(*) as 'num' from #_product_brand where type = ? $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,array($type));
		$total = $count['num'];
		$url = "index.php?com=product&act=man_brand&type=".$type;
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit brand */
	function get_brand()
	{
		global $d, $func, $strUrl, $curPage, $item, $gallery, $type, $com;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;

		if(empty($id)) $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_brand&type=".$type."&p=".$curPage.$strUrl, false);

		$item = $d->rawQueryOne("select * from #_product_brand where id = ? and type = ?",array($id,$type));
		
		if(empty($item['id'])) $func->transfer("Dữ liệu không có thực", "index.php?com=product&act=man_brand&type=".$type."&p=".$curPage.$strUrl, false);
	}

	/* Save brand */
	function save_brand()
	{
		global $d, $curPage, $func, $config, $com, $type;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_brand&type=".$type."&p=".$curPage, false);

		$file_name = $func->uploadName($_FILES['file']["name"]);
		$id = (isset($_POST['id'])) ? (int)htmlspecialchars($_POST['id']):0;

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data']:null;
		if(!empty($data)) { foreach($data as $column => $value) $data[$column] = htmlspecialchars($value); }
		if(isset($_POST['slugvi'])) $data['tenkhongdauvi'] = $func->changeTitle(htmlspecialchars($_POST['slugvi']));
		else $data['tenkhongdauvi'] = $func->changeTitle($data['tenvi']);
		if(isset($_POST['slugen'])) $data['tenkhongdauen'] = $func->changeTitle(htmlspecialchars($_POST['slugen']));
		else $data['tenkhongdauen'] = (isset($data['tenen'])) ? $func->changeTitle($data['tenen']):'';
		$data['hienthi'] = ($data['hienthi']) ? 1 : 0;
		$data['type'] = $type;

		/* Post seo */
		if($config['product'][$type]['seo_brand'])
		{
			$dataSeo = $_POST['dataSeo'];
			foreach($dataSeo as $column => $value) $dataSeo[$column] = htmlspecialchars($value);
		}

		if(isset($id) && $id!=0)
		{
			if($photo = $func->uploadImage("file", $config['product'][$type]['img_type_brand'], UPLOAD_PRODUCT,$file_name))
			{
				$data['photo'] = $photo;
				$row = $d->rawQueryOne("select id, photo from #_product_brand where id = ? and type = ?",array($id,$type));
				if(!empty($row['id'])) $func->delete_file(UPLOAD_PRODUCT.$row['photo']);
			}

			$data['ngaysua'] = time();
			
			$d->where('id', $id);
			$d->where('type', $type);
			if($d->update('product_brand',$data))
			{
				/* SEO */
				if($config['product'][$type]['seo_brand'])
				{
					$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_brand',$type));

					$dataSeo['idmuc'] = $id;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'man_brand';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}

				$func->transfer("Cập nhật dữ liệu thành công", "index.php?com=product&act=man_brand&type=".$type."&p=".$curPage);
			}
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_brand&type=".$type."&p=".$curPage, false);
		}
		else
		{				
			if($photo = $func->uploadImage("file", $config['product'][$type]['img_type_brand'], UPLOAD_PRODUCT,$file_name))
			{
				$data['photo'] = $photo;
			}
			
			$data['ngaytao'] = time();
			
			if($d->insert('product_brand',$data))
			{
				$id_insert = $d->getLastInsertId();

				/* SEO */
				if($config['product'][$type]['seo_brand'])
				{
					$dataSeo['idmuc'] = $id_insert;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'man_brand';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}

				$func->transfer("Lưu dữ liệu thành công", "index.php?com=product&act=man_brand&type=".$type."&p=".$curPage);
			}
			else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_brand&type=".$type."&p=".$curPage, false);
		}
	}

	/* Delete brand */
	function delete_brand()
	{
		global $d, $strUrl, $func, $curPage, $com, $type;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;

		if(isset($_GET['id']))
		{
			/* Xóa SEO */
			$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_brand',$type));

			/* Lấy dữ liệu */
			$row = $d->rawQueryOne("select id, photo from #_product_brand where id = ? and type = ?",array($id,$type));

			if(!empty($row['id']))
			{
				$func->delete_file(UPLOAD_PRODUCT.$row['photo']);
				$d->rawQuery("delete from #_product_brand where id = ?",array($id));

				$func->transfer("Xóa dữ liệu thành công", "index.php?com=product&act=man_brand&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_brand&type=".$type."&p=".$curPage.$strUrl, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);

				/* Xóa SEO */
				$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_brand',$type));

				/* Lấy dữ liệu */
				$row = $d->rawQueryOne("select id, photo from #_product_brand where id = ? and type = ?",array($id,$type));

				if(!empty($row['id']))
				{
					$func->delete_file(UPLOAD_PRODUCT.$row['photo']);
					$d->rawQuery("delete from #_product_brand where id = ?",array($id));
				}
			}

			$func->transfer("Xóa dữ liệu thành công", "index.php?com=product&act=man_brand&type=".$type."&p=".$curPage.$strUrl);
		}
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_brand&type=".$type."&p=".$curPage.$strUrl, false);
	}
?>