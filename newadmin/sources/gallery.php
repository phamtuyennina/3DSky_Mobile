<?php
	if(!defined('SOURCES')) die("Error");

	switch($act)
	{
		case "man_photo":
			get_photos();
			$template = "gallery/man/photos";
			break;

		case "add_photo":
			$template = "gallery/man/photo_add";
			break;

		case "edit_photo":
			get_photo();
			$template = "gallery/man/photo_edit";
			break;

		case "save_photo":
			save_photo();
			break;

		case "delete_photo":
			delete_photo();
			break;

		default:
			$template = "404";
	}

	/* Get photo */
	function get_photos()
	{
		global $d, $func, $curPage, $items, $paging, $type, $kind, $val, $idc, $com;
		
		$where = "id_photo = ? and com = ? and type = ? and kind = ? and val = ?";

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_gallery where $where order by stt,id desc $limit";
		$items = $d->rawQuery($sql,array($idc,$com,$type,$kind,$val));
		$sqlNum = "select count(*) as 'num' from #_gallery where $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,array($idc,$com,$type,$kind,$val));
		$total = $count['num'];
		$url = "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val;
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Get photo */
	function get_photo()
	{
		global $d, $func, $curPage, $item, $type, $kind, $val, $idc, $com;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;

		if(empty($id)) $func->transfer("Không nhận được dữ liệu", "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage, false);

		$item = $d->rawQueryOne("select * from #_gallery where id_photo = ? and com = ? and type = ? and kind = ? and val = ? and id = ? order by stt,id desc",array($idc,$com,$type,$kind,$val,$id));

		if(empty($item['id'])) $func->transfer("Dữ liệu không có thực", "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage, false);
	}

	/* Save photo */
	function save_photo()
	{
		global $d, $curPage, $func, $config, $dfgallery, $type, $kind, $val, $idc, $com;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage, false);

		$id = (isset($_POST['id'])) ? (int)htmlspecialchars($_POST['id']):0;

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data']:null;
		$dataMultiTemp = (isset($_POST['dataMulti'])) ? $_POST['dataMulti']:'';
		if(!empty($data)) { foreach($data as $column => $value) $data[$column] = htmlspecialchars($value); }

		if(isset($id) && $id!=0)
		{
			$file_name = $func->uploadName($_FILES["file"]["name"]);
			if($photo = $func->uploadImage("file", $config[$com][$type][$dfgallery][$val]['img_type_photo'], "../upload/".$com."/",$file_name))
			{
				$data['photo'] = $photo;
				$row = $d->rawQueryOne("select id, photo from #_gallery where id_photo = ? and com = ? and type = ? and kind = ? and val = ? and id = ? order by stt,id desc",array($idc,$com,$type,$kind,$val,$id));
				if(!empty($row['id'])) $func->delete_file("../upload/".$com."/".$row['photo']);
			}

			$file_name = (isset($_FILES["file-taptin"])) ? $func->uploadName($_FILES["file-taptin"]["name"]):'';
			if(!empty($file_name)){
				if($taptin = $func->uploadImage("file-taptin", $config[$com][$type][$dfgallery][$val]['file_type_photo'],UPLOAD_FILE,$file_name."-taptin"))
				{
					$data['taptin'] = $taptin;

					$row = $d->rawQueryOne("select id, taptin from #_gallery where id_photo = ? and com = ? and type = ? and kind = ? and val = ? and id = ? order by stt,id desc",array($idc,$com,$type,$kind,$val,$id));
					
					if(!empty($row['id'])) $func->delete_file(UPLOAD_FILE.$row['taptin']);
				}
			}
			
			
			$data['hienthi'] = ($data['hienthi']) ? 1 : 0;

			$d->where('id', $id);
			$d->where('com', $com);
			$d->where('type', $type);
			$d->where('kind', $kind);
			$d->where('val', $val);
			if($d->update('gallery',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage);
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage, false);
		}
		else
		{
			$numberPhoto = $config[$com][$type][$dfgallery][$val]['number_photo'];

			if($numberPhoto)
			{
				for($i=0;$i<count($dataMultiTemp);$i++)
				{
					$dataMulti = $dataMultiTemp[$i];
					$dataMulti['id_mau'] = $data['id_mau'];
					$dataMulti['hienthi'] = ($dataMultiTemp[$i]['hienthi']) ? 1 : 0;
					$dataMulti['com'] = $com;
					$dataMulti['type'] = $type;
					$dataMulti['kind'] = $kind;
					$dataMulti['val'] = $val;
					$dataMulti['id_photo'] = $idc;

					if(isset($config[$com][$type][$dfgallery][$val]['file_photo']) && $config[$com][$type][$dfgallery][$val]['file_photo']==true)
					{
						$file_name = $func->uploadName($_FILES["file-taptin".$i]["name"]);
						if($taptin = $func->uploadImage("file-taptin".$i, $config[$com][$type][$dfgallery][$val]['file_type_photo'],UPLOAD_FILE,$file_name."-taptin".$i))
						{
							$dataMulti['taptin'] = $taptin;		
						}
					}

					if(isset($config[$com][$type][$dfgallery][$val]['images_photo']) && $config[$com][$type][$dfgallery][$val]['images_photo']==true)
					{
						$file_name = $func->uploadName($_FILES["file".$i]["name"]);
						if($photo = $func->uploadImage("file".$i, $config[$com][$type][$dfgallery][$val]['img_type_photo'], "../upload/".$com."/",$file_name.$i))
						{
							$dataMulti['photo'] = $photo;
							if(!$d->insert('gallery',$dataMulti)) $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage, false);
						}
					}
					else
					{
						if($dataMulti['tenvi']!='' || $dataMulti['mau']!='' || $dataMulti['link']!='' || $dataMulti['link_video']!='')
						{
							if(!$d->insert('gallery',$dataMulti)) $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage, false);
						}
					}
				}

				$func->transfer("Lưu dữ liệu thành công", "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage);
			}
			else
			{
				$func->transfer("Dữ liệu rỗng", "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage, false);
			}
		}
	}

	/* Delete photo */
	function delete_photo()
	{
		global $d, $curPage, $func, $type, $kind, $val, $idc, $com;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;
		
		if(isset($id) && $id!=0)
		{
			$row = $d->rawQueryOne("select id, photo, taptin from #_gallery where id = ? and com = ? and type = ? and kind = ? and val = ?",array($id,$com,$type,$kind,$val));

			if(!empty($row['id']))
			{
				$func->delete_file("../upload/".$com."/".$row['photo']);
				$func->delete_file(UPLOAD_FILE.$row['taptin']);

				$d->rawQuery("delete from #_gallery where id = ?",array($id));

				$func->transfer("Xóa dữ liệu thành công", "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "Dữ liệu không có thực", "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);
				$row = $d->rawQueryOne("select id, photo, taptin from #_gallery where id = ?",array($id));

				if(!empty($row['id']))
				{
					$func->delete_file("../upload/".$com."/".$row['photo']);
					$func->delete_file(UPLOAD_FILE.$row['taptin']);

					$d->rawQuery("delete from #_gallery where id = ? and com = ? and type = ? and kind = ? and val = ?",array($id,$com,$type,$kind,$val));
				}
			}
			$func->transfer("Xóa dữ liệu thành công", "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage);
		}
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage, false);
	}
?>