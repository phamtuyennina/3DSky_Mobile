<?php
	if(!defined('SOURCES')) die("Error");

	/* Kiểm tra active đơn hàng */
	if(!$config['order']['active']) $func->transfer("Trang không tồn tại", "index.php", false);

	/* Cấu hình đường dẫn trả về */
	$strUrl = "";
	$strUrl .= (isset($_REQUEST['tinhtrang'])) ? "&tinhtrang=".htmlspecialchars($_REQUEST['tinhtrang']) : "";
	$strUrl .= (isset($_REQUEST['httt'])) ? "&httt=".htmlspecialchars($_REQUEST['httt']) : "";
	$strUrl .= (isset($_REQUEST['ngaydat'])) ? "&ngaydat=".htmlspecialchars($_REQUEST['ngaydat']) : "";
	$strUrl .= (isset($_REQUEST['khoanggia'])) ? "&khoanggia=".htmlspecialchars($_REQUEST['khoanggia']) : "";
	$strUrl .= (isset($_REQUEST['city'])) ? "&city=".htmlspecialchars($_REQUEST['city']) : "";
	$strUrl .= (isset($_REQUEST['district'])) ? "&district=".htmlspecialchars($_REQUEST['district']) : "";
	$strUrl .= (isset($_REQUEST['wards'])) ? "&wards=".htmlspecialchars($_REQUEST['wards']) : "";
	$strUrl .= (isset($_REQUEST['keyword'])) ? "&keyword=".htmlspecialchars($_REQUEST['keyword']) : "";

	switch($act)
	{
		case "man":
			get_items();
			$template = "order/man/items";
			break;

		case "edit":
			get_item();
			$template = "order/man/item_add";
			break;

		case "save":
			save_item();
			break;

		case "delete":
			delete_item();
			break;

		default:
			$template = "404";
	}

	/* Get order */
	function get_items()
	{
		global $d, $func, $strUrl, $curPage, $items, $paging, $minTotal, $maxTotal, $giatu, $giaden, $allMoidat, $totalMoidat, $allDaxacnhan, $totalDaxacnhan, $allDagiao, $totalDagiao, $allDahuy, $totalDahuy;
		
		$where = "";

		$tinhtrang = (isset($_REQUEST['tinhtrang'])) ? htmlspecialchars($_REQUEST['tinhtrang']):0;
		$httt = (isset($_REQUEST['httt'])) ? htmlspecialchars($_REQUEST['httt']):0;
		$ngaydat = (isset($_REQUEST['ngaydat'])) ? htmlspecialchars($_REQUEST['ngaydat']):0;
		$khoanggia = (isset($_REQUEST['khoanggia'])) ? htmlspecialchars($_REQUEST['khoanggia']):'';
		$city = (isset($_REQUEST['city'])) ? htmlspecialchars($_REQUEST['city']):0;
		$district = (isset($_REQUEST['district'])) ? htmlspecialchars($_REQUEST['district']):0;
		$wards = (isset($_REQUEST['wards'])) ? htmlspecialchars($_REQUEST['wards']):0;

		if(!empty($tinhtrang)) $where .= " and tinhtrang=$tinhtrang";
		if(!empty($httt)) $where .= " and httt=$httt";
		if(!empty($ngaydat))
		{
			$ngaydat = explode("-",$ngaydat);
			$ngaytu = trim($ngaydat[0]);
			$ngayden = trim($ngaydat[1]);
			$ngaytu = strtotime(str_replace("/","-",$ngaytu));
			$ngayden = strtotime(str_replace("/","-",$ngayden));
			$where .= " and ngaytao<=$ngayden and ngaytao>=$ngaytu";
		}
		if(!empty($khoanggia))
		{
			$khoanggia = explode(";",$khoanggia);
			$giatu = trim($khoanggia[0]);
			$giaden = trim($khoanggia[1]);
			$where .= " and tonggia<=$giaden and tonggia>=$giatu";
		}
		if(!empty($city)) $where .= " and city=$city";
		if(!empty($district)) $where .= " and district=$district";
		if(!empty($wards)) $where .= " and wards=$wards";
		if(!empty($_REQUEST['keyword']))
		{
			$keyword = (isset($_REQUEST['keyword'])) ? htmlspecialchars($_REQUEST['keyword']):'';
			$where .= " and (hoten LIKE '%$keyword%' or email LIKE '%$keyword%' or dienthoai LIKE '%$keyword%' or madonhang LIKE '%$keyword%')";
		}

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_order where id<>0 $where order by ngaytao desc $limit";
		$items = $d->rawQuery($sql);
		$sqlNum = "select count(*) as 'num' from #_order where id<>0 $where order by ngaytao desc";
		$count = $d->rawQueryOne($sqlNum);
		$total = $count['num'];
		$url = "index.php?com=order&act=man".$strUrl;
		$paging = $func->pagination($total,$per_page,$curPage,$url);

		/* Lấy tổng giá min */
		$minTotal = $d->rawQueryOne("SELECT MIN(tonggia) FROM #_order limit 0,1");
		if($minTotal['MIN(tonggia)'] > 0) $minTotal = $minTotal['MIN(tonggia)'];
		else $minTotal = 0;

		/* Lấy tổng giá max */
		$maxTotal = $d->rawQueryOne("SELECT MAX(tonggia) FROM #_order limit 0,1");
		if($maxTotal['MAX(tonggia)'] > 0) $maxTotal = $maxTotal['MAX(tonggia)'];
		else $maxTotal = 0;

		/* Lấy đơn hàng - mới đặt */
		$orderMoidat = $d->rawQueryOne("SELECT COUNT(id), SUM(tonggia) FROM #_order WHERE tinhtrang = 1");
		$allMoidat = $orderMoidat['COUNT(id)'];
		$totalMoidat = $orderMoidat['SUM(tonggia)'];

		/* Lấy đơn hàng - đã xác nhận */
		$orderDaxacnhan = $d->rawQueryOne("SELECT COUNT(id), SUM(tonggia) FROM #_order WHERE tinhtrang = 2");
		$allDaxacnhan = $orderDaxacnhan['COUNT(id)'];
		$totalDaxacnhan = $orderDaxacnhan['SUM(tonggia)'];

		/* Lấy đơn hàng - đã giao */
		$orderDagiao = $d->rawQueryOne("SELECT COUNT(id), SUM(tonggia) FROM #_order WHERE tinhtrang = 4");
		$allDagiao = $orderDagiao['COUNT(id)'];
		$totalDagiao = $orderDagiao['SUM(tonggia)'];

		/* Lấy đơn hàng - đã hủy */
		$orderDahuy = $d->rawQueryOne("SELECT COUNT(id), SUM(tonggia) FROM #_order WHERE tinhtrang = 5");
		$allDahuy = $orderDahuy['COUNT(id)'];
		$totalDahuy = $orderDahuy['SUM(tonggia)'];
	}

	/* Edit order */
	function get_item()
	{
		global $d, $func, $curPage, $item, $chitietdonhang;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;

		if(empty($id)) $func->transfer("Không nhận được dữ liệu", "index.php?com=order&act=man&p=".$curPage, false);
		
		$item = $d->rawQueryOne("select * from #_order where id = ?",array($id));

		if(empty($item['id'])) $func->transfer("Dữ liệu không có thực", "index.php?com=order&act=man&p=".$curPage, false);

		/* Lấy chi tiết đơn hàng */
		$chitietdonhang = $d->rawQuery("select * from #_order_detail where id_order = ? order by id desc",array($id));
	}

	/* Save order */
	function save_item()
	{
		global $d, $func, $curPage;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=order&act=man&p=".$curPage, false);

		$id = (isset($_POST['id'])) ? (int)htmlspecialchars($_POST['id']):0;

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data']:null;
		if(!empty($data)) { foreach($data as $column => $value) $data[$column] = htmlspecialchars($value); }

		if(isset($id) && $id!=0)
		{
			$d->where('id', $id);
			if($d->update('order',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=order&act=man&p=".$curPage);
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=order&act=man&p=".$curPage, false);
		}
		else
		{
			$func->transfer("Dữ liệu rỗng", "index.php?com=order&act=man&p=".$curPage, false);
		}
	}

	/* Delete order */
	function delete_item()
	{
		global $d, $func, $curPage;

		$id = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;

		if(isset($id) && $id!=0)
		{
			$row = $d->rawQueryOne("select id from #_order where id = ?",array($id));

			if(!empty($row['id']))
			{
				$d->rawQuery("delete from #_order_detail where id_order = ?",array($id));
				$d->rawQuery("delete from #_order where id = ?",array($id));
				$func->transfer("Xóa dữ liệu thành công", "index.php?com=order&act=man&p=".$curPage);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=order&act=man&p=".$curPage, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);
			
			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);
				$row = $d->rawQueryOne("select id from #_order where id = ?",array($id));

				if(!empty($row['id']))
				{
					$d->rawQuery("delete from #_order_detail where id_order = ?",array($id));
					$d->rawQuery("delete from #_order where id = ?",array($id));
				}
			}
			
			$func->transfer("Xóa dữ liệu thành công", "index.php?com=order&act=man&p=".$curPage);
		}
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=order&act=man&p=".$curPage, false);
	}
?>