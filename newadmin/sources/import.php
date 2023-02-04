<?php	
	if(!defined('SOURCES')) die("Error");

	/* Kiểm tra active import */
	$arrCheck = array();
	foreach($config['product'] as $k => $v) if($v['import']) $arrCheck[] = $k;
	if(!count($arrCheck) || !in_array($type,$arrCheck)) $func->transfer("Trang không tồn tại", "index.php", false);

	switch($act)
	{
		case "man":
			getImages();
			$template = "import/man/items";
			break;

		case "uploadImages":
			uploadImages();
			break;

		case "editImages":
			editImages();
			$template = "import/man/item_edit";
			break;

		case "saveImages":
			saveImages();
			break;

		case "deleteImages":
			deleteImages();
			break;

		case "uploadExcel":
			uploadExcel();
			break;

		default:
			$template = "404";
	}

	/* Get image */
	function getImages()
	{
		global $d, $func, $type, $curPage, $items, $paging;

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_excel where type = ? order by stt,id desc $limit";
		$items = $d->rawQuery($sql,array($type));
		$sqlNum = "select count(*) as 'num' from #_excel where type = ? order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,array($type));
		$total = $count['num'];
		$url = "index.php?com=import&act=man&type=".$type;
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit image */
	function editImages()
	{
		global $d, $func, $item, $type, $curPage;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;

		if(empty($id)) $func->transfer("Không nhận được dữ liệu", "index.php?com=import&act=man&type=".$type."&p=".$curPage, false);

		$item = $d->rawQueryOne("select * from #_excel where id = ? and type = ?",array($id,$type));

		if(empty($item['id'])) $func->transfer("Dữ liệu không có thực", "index.php?com=import&act=man&type=".$type."&p=".$curPage, false);
	}

	/* Save image */
	function saveImages()
	{
		global $d, $item, $func, $type, $curPage, $config;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=import&act=man&type=".$type."&p=".$curPage, false);

		$id = (isset($_POST['id'])) ? (int)htmlspecialchars($_POST['id']):0;

		if(isset($id) && $id!=0)
		{
			if(isset($_FILES['file'])){
				$file_name = $func->uploadName($_FILES['file']["name"]);
				if($photo = $func->uploadImage("file", $config['import']['img_type'], UPLOAD_EXCEL, $file_name))
				{
					$data['photo'] = $photo;
					$row = $d->rawQueryOne("select id, photo from #_excel where id = ? and type = ?",array($id,$type));
					if(!empty($row['id'])) $func->delete_file(UPLOAD_EXCEL.$row['photo']);
					
					$d->where('id', $id);
					$d->where('type', $type);
					if($d->update('excel',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=import&act=man&type=".$type."&p=".$curPage);
					else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=import&act=man&type=".$type."&p=".$curPage, false);
				}
				else
				{
					$func->transfer("Không nhận được hình ảnh mới", "index.php?com=import&act=editImages&id=".$id."&type=".$type."&p=".$curPage, false);
				}
			}
		}
		else
		{
			$func->transfer("Không nhận được dữ liệu", "index.php?com=import&act=man&type=".$type."&p=".$curPage, false);
		}
	}

	/* Upload image */
	function uploadImages()
	{
		global $d, $type, $func, $config;

		if(isset($_POST['uploadImg']) && isset($_FILES['files']) && $_FILES['files']["name"][0]!='') 
		{
			$arr_chuoi = str_replace('"','',$_POST['jfiler-items-exclude-files-0']);
			$arr_chuoi = str_replace('[','',$arr_chuoi);
			$arr_chuoi = str_replace(']','',$arr_chuoi);
			$arr_chuoi = str_replace('\\','',$arr_chuoi);
			$arr_chuoi = str_replace('0://','',$arr_chuoi);
			$arr_file_del = explode(',',$arr_chuoi);

			$dem = 0;
	        $myFile = $_FILES['files'];
	        $fileCount = count($myFile["name"]);

	        if($_FILES['files']){
		        for($i=0;$i<$fileCount;$i++) 
		        {
		        	if($_FILES['files']['name'][$i]!='')
					{
						if(!in_array(($_FILES['files']['name'][$i]),$arr_file_del,true))
						{
							$file_name = $func->uploadName($myFile["name"][$i]);
							$file_ext = pathinfo($myFile["name"][$i], PATHINFO_EXTENSION);
							if(move_uploaded_file($myFile["tmp_name"][$i], UPLOAD_EXCEL."/".$file_name.".".$file_ext))
				            {
				            	$data['photo'] = $file_name.".".$file_ext;
								$data['stt'] = (int)$_POST['stt-filer'][$dem];
								$data['type'] = $type;
								$d->insert('excel',$data);
				            }
				            $dem++;
						}
		            }
		        }
		        $func->transfer("Lưu hình ảnh thành công", "index.php?com=import&act=man&type=".$type);
	        }
	    }
	    else
	    {
	    	$func->transfer("Dữ liệu rỗng", "index.php?com=import&act=man&type=".$type, false);
	    }
	}

	/* Delete image */
	function deleteImages()
	{
		global $d, $type, $func, $curPage;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;

		if(isset($id) && $id!=0)
		{
			$row = $d->rawQueryOne("select id, photo from #_excel where id = ? and type = ?",array($id,$type));

			if(!empty($row['id']))
			{
				$func->delete_file(UPLOAD_EXCEL.$row['photo']);
				$d->rawQuery("delete from #_excel where id = ? and type = ?",array($id,$type));
				$func->transfer("Xóa dữ liệu thành công", "index.php?com=import&act=man&type=".$type."&p=".$curPage);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=import&act=man&type=".$type."&p=".$curPage, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);
				$row = $d->rawQueryOne("select id, photo from #_excel where id = ? and type = ?",array($id,$type));

				if(!empty($row['id']))
				{
					$func->delete_file(UPLOAD_EXCEL.$row['photo']);
					$d->rawQuery("delete from #_excel where id = ? and type = ?",array($id,$type));
				}
			}
			
			$func->transfer("Xóa dữ liệu thành công", "index.php?com=import&act=man&type=".$type."&p=".$curPage);
		} 
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=import&act=man&type=".$type."&p=".$curPage, false);
	}

	/* Transfer image */
	function transferphoto($photo)
	{
		global $d;

		$oldpath = UPLOAD_EXCEL.$photo;
		$newpath = UPLOAD_PRODUCT.$photo;

		if(rename($oldpath,$newpath)) $d->rawQuery("delete from #_excel where photo = ?",array($photo));
	}

	/* Upload excel */
	function uploadExcel()
	{
		global $d, $type, $func, $config;

		if(isset($_POST['importExcel']))
		{
			$file_type = $_FILES['file-excel']['type'];

			if($file_type == "application/vnd.ms-excel" || $file_type == "application/x-ms-excel")
			{
				$mess = '';
				$filename = $func->changeTitle($_FILES["file-excel"]["name"]);
				move_uploaded_file($_FILES["file-excel"]["tmp_name"],$filename);			
				
				require LIBRARIES.'PHPExcel.php';
				require_once LIBRARIES.'PHPExcel/IOFactory.php';

				$objPHPExcel = PHPExcel_IOFactory::load($filename);

				foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) 
				{
					$worksheetTitle = $worksheet->getTitle();
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

					$nrColumns = ord($highestColumn) - 64;

					for($row=2;$row<=$highestRow;++$row)
					{
						$cell = $worksheet->getCellByColumnAndRow(3, $row);
						$masp = $cell->getValue();

						if($masp!="")
						{
							$cell = $worksheet->getCellByColumnAndRow(0, $row);
							$stt = $cell->getValue();

							$cell = $worksheet->getCellByColumnAndRow(1, $row);
							$cap1 = $cell->getValue();

							$cell = $worksheet->getCellByColumnAndRow(2, $row);
							$cap2 = $cell->getValue();

							$cell = $worksheet->getCellByColumnAndRow(3, $row);
							$masp = $cell->getValue();

							$cell = $worksheet->getCellByColumnAndRow(4, $row);
							$tenvi = $cell->getValue();

							$cell = $worksheet->getCellByColumnAndRow(5, $row);
							$gia = $cell->getValue();

							$cell = $worksheet->getCellByColumnAndRow(6, $row);
							$giamoi = $cell->getValue();

							$cell = $worksheet->getCellByColumnAndRow(7, $row);
							$giakm = $cell->getValue();

							$cell = $worksheet->getCellByColumnAndRow(8, $row);
							$motavi = $cell->getValue();
							
							$cell = $worksheet->getCellByColumnAndRow(9, $row);
							$noidungvi = $cell->getValue();

							$cell = $worksheet->getCellByColumnAndRow(10, $row);
							$photo = $cell->getValue();

							/* Lấy sản phẩm theo mã */
							$proimport = $d->rawQueryOne("SELECT id, photo FROM #_product WHERE masp = ?",array($masp));

							/* Lấy danh mục cấp 1 */
							$tkdcap1 = $func->changeTitle($cap1);
							$idlist = $d->rawQueryOne("SELECT id FROM #_product_list WHERE tenkhongdauvi = ?",array($tkdcap1));

							/* Lấy danh mục cấp 2 */
							$tkdcap2 = $func->changeTitle($cap2);
							$idcat = $d->rawQueryOne("SELECT id FROM #_product_cat WHERE tenkhongdauvi = ?",array($tkdcap2));

							/* Gán dữ liệu */
							$data = array();
							$data['stt'] = (int)$stt;
							$data['id_list'] = (int)$idlist['id'];
							$data['id_cat'] = (int)$idcat['id'];
							$data['masp'] = htmlspecialchars($masp);
							$data['tenvi'] = htmlspecialchars($tenvi);
							$data['tenkhongdauvi'] = $func->changeTitle($data['tenvi']);
							$data['gia'] = $gia;
							$data['giamoi'] = $giamoi;
							$data['giakm'] = $giakm;
							$data['motavi'] = htmlspecialchars($motavi);
							$data['noidungvi'] = htmlspecialchars($noidungvi);

							if($config['import']['images'])
							{
								if($photo!="")
								{
									if(filter_var($photo,FILTER_VALIDATE_URL))
									{
										/* Get Images Online */
										$random = $func->digitalRandom(0,9,12);
										$ext = substr(basename($photo),strrpos(basename($photo),".")+1);
										$tmp = explode('?',$ext);
										$ext = $tmp[0];
										$name = $random."_online_img.".$ext;

										$pathOnlineImg = $photo;
										$pathSaveImg = UPLOAD_EXCEL.$name;
										$ch = curl_init($pathOnlineImg);
										$fp = fopen($pathSaveImg, 'wb');
										curl_setopt($ch, CURLOPT_FILE, $fp);
										curl_setopt($ch, CURLOPT_HEADER, 0);
										curl_exec($ch);
										curl_close($ch);
										fclose($fp);

										$data['photo'] = $name;
										$photo = $name;
									}
									else
									{
										/* Get Images Local */
										$data['photo'] = $photo;
									}
								}
								else $data['photo'] = '';
							}
							else
							{
								$data['photo'] = '';
							}
							$data['type'] = $type;
							$data['hienthi'] = 1;

							if($proimport['id'])
							{
								$d->where('type', $type);
								$d->where('masp', $masp);
								if($d->update('product',$data))
								{
									if($config['import']['images'])
									{
										/* Cập nhật hình */
										/* Nếu tồn tại hình mới thì xóa hình cũ và cập nhật hình mới */
										$oldphoto = $proimport['photo'];
										if(($photo!="") && ($photo!=$oldphoto))
										{
											/* Xóa hình cũ */
											$oldpathphoto = UPLOAD_PRODUCT.$oldphoto;
											if(file_exists($oldpathphoto)) unlink($oldpathphoto);

											/* Chuyển hình mới từ thư mục excel sang thư mục cần chuyển */
											transferphoto($photo);
										}
									}
								}
								else
								{
									$mess.='Lỗi tại dòng: '.$row."<br>";
								}
							}
							else
							{
								if($d->insert('product',$data))
								{
									if($config['import']['images'])
									{
										/* Chuyển hình trong thư mục excel sang thư mục cần chuyển */
										if($photo!="") transferphoto($photo);
									}
								}
								else
								{
									$mess.='Lỗi tại dòng: '.$row."<br>";
								}
							}
						}
					}
				}

				/* Xóa tập tin sau khi đã import xong */
				unlink($filename);

				/* Kiểm tra kết quả import */
				if($mess == '')
				{
					$mess = "Import danh sách thành công";
					$func->transfer($mess, "index.php?com=import&act=man&type=".$type);
				}
				else
				{
					$func->transfer($mess, "index.php?com=import&act=man&type=".$type, false);
				}
			}
			else
			{
				$mess = "Không hỗ trợ kiểu tập tin này";
				$func->transfer($mess, "index.php?com=import&act=man&type=".$type, false);
			}
		}
		else
		{
			$func->transfer("Dữ liệu rỗng", "index.php?com=import&act=man&type=".$type, false);
		}
	}
?>