<?php
	include "ajax_config.php";

	if(isset($_POST["level"]))
	{
		$level = (isset($_POST["level"])) ? htmlspecialchars($_POST["level"]):'';
		$table = (isset($_POST["table"])) ? htmlspecialchars($_POST["table"]):'';
		$id = (isset($_POST["id"])) ? htmlspecialchars($_POST["id"]):'';

		switch($level)
		{
			case '0':
				$id_temp = "id_city";
				break;

			case '1':
				$id_temp = "id_district";
				break;

			default:
				echo 'error ajax';
				exit();
				break;
		}

		$row = $d->rawQuery("select ten, id from $table where $id_temp = ? order by id asc",array($id));

		$str = '<option value="0">Chọn danh mục</option>';
		if(!empty($row)){
			foreach($row as $v) $str .= '<option value='.$v["id"].'>'.$v["ten"].'</option>';	
		}
				
		echo  $str;
	}
?>