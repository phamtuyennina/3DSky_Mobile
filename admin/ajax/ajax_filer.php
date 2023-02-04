<?php
	include "ajax_config.php";

	$id = (isset($_POST["id"])) ? htmlspecialchars($_POST["id"]):'';
	$idmuc = (isset($_POST["idmuc"])) ? htmlspecialchars($_POST["idmuc"]):'';
	$folder = (isset($_POST["folder"])) ? htmlspecialchars($_POST["folder"]):'';
	$info = (isset($_POST["info"])) ? htmlspecialchars($_POST["info"]):'';
	$value = (isset($_POST["value"])) ? htmlspecialchars($_POST["value"]):'';
	$listid = $func->sanitize($_POST['listid']);
	$com = (isset($_POST["com"])) ? htmlspecialchars($_POST["com"]):'';
	$kind = (isset($_POST["kind"])) ? htmlspecialchars($_POST["kind"]):'';
	$type = (isset($_POST["type"])) ? htmlspecialchars($_POST["type"]):'';
	$colfiler = (isset($_POST["colfiler"])) ? htmlspecialchars($_POST["colfiler"]):'';
	$cmd = (isset($_POST["cmd"])) ? htmlspecialchars($_POST["cmd"]):'';
	
	if($cmd == 'info' && $id && $idmuc)
	{
		if($info == 'stt') $data['stt'] = $value;
		if($info == 'tieude') $data['tenvi'] = $value;

		$d->where('id',$id);
		if($d->update('gallery',$data))
		{
			$gallery = $d->rawQuery("select stt, id, photo, tenvi from #_gallery where id_photo = ? and com = ? and type = ? and kind = ? and val = ? order by stt,id desc",array($idmuc,$com,$type,$kind,$type));

			for($i=0;$i<count($gallery);$i++)
			{
				echo $func->galleryFiler($gallery[$i]['stt'],$gallery[$i]['id'],$gallery[$i]['photo'],$gallery[$i]['tenvi'],$com,$colfiler);
			}

			$cache->DeleteCache();
		}
	}
	else if($cmd == 'updateNumb' && $idmuc && $listid)
	{
		$row = $d->rawQuery("select id, stt from #_gallery where id_photo = ? and com = ? and type = ? and kind = ? and val = ? order by stt,id desc",array($idmuc,$com,$type,$kind,$type));

		for($i=0;$i<count($listid);$i++)
		{
			$arrId[] = $listid[$i];
			$arrNumb[] = $row[$i]['stt'];

			$data['stt'] = $row[$i]['stt'];

			$d->where('id',$listid[$i]);
			$d->update('gallery',$data);
		}

		$cache->DeleteCache();
		$data = array('id' => $arrId, 'numb' => $arrNumb);
		echo json_encode($data);
	}
	else if($cmd == 'delete' && $id)
	{
		$row = $d->rawQueryOne("select photo from #_gallery where id = ?",array($id));

		$path="../../upload/".$folder."/".$row['photo'];

		$func->delete_file($path);
		
		$d->rawQuery("delete from #_gallery where id = ?",array($id));

		$cache->DeleteCache();
	}
	else if($cmd == 'delete-all' && $listid)
	{
		$listid = explode(",",$listid);
		$cols = ["id", "photo"];
		$d->where('id', $listid, 'IN');
		$row = $d->get("gallery", null, $cols);

		for($i=0;$i<count($row);$i++)
		{
			$path="../../upload/".$folder."/".$row[$i]['photo'];

			$func->delete_file($path);

			$id = $row[$i]['id'];
			$d->rawQuery("delete from #_gallery where id = ?",array($id));
		}

		$cache->DeleteCache();
	}
?>