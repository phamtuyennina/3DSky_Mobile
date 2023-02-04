<?php
	session_start();
	@define('LIBRARIES','./libraries/');

	require_once LIBRARIES."config.php";
    require_once LIBRARIES.'autoload.php';
    new AutoLoad();
    $injection = new AntiSQLInjection();
    $d = new PDODb($config['database']);
    $func = new Functions($d);
	
	/* Kiểm tra có đăng nhập chưa */
	if($func->check_login()==false && $act!="login")
	{
		$func->redirect("index.php?com=user&act=login");
	}

	/* Kiểm tra active export word */
	if(!isset($config['order']['word']) || $config['order']['word']==false) $func->transfer("Trang không tồn tại", "index.php", false);

	/* Setting */
	$setting = $d->rawQueryOne("select * from #_setting");
	$optsetting = json_decode($setting['options'],true);
	
	/* Thông tin đơn hàng */
	$iddh = (isset($_GET['id'])) ? (int)htmlspecialchars($_GET['id']):0;
	if(!$iddh) $func->transfer("Dữ liệu không có thực", "index.php?com=order&act=man", false);
	$donhang = $d->rawQueryOne("select * from #_order where id = ?",array($iddh));

	/* Chi tiết đơn hàng */
	$detail = $d->rawQuery("select * from #_order_detail where id_order = ?",array($iddh));

	/* Gán giá trị đơn hàng */
	$time = time();
	$madonhang = $donhang['madonhang'];
	$ngaydat = date('H:i A d-m-Y',$donhang['ngaytao']);
	$tinhtrang = $donhang['tinhtrang'];
	$hotenkh = $donhang["hoten"];
	$dienthoaikh = $donhang["dienthoai"];
	$emailkh = $donhang["email"];
	$diachikh = $donhang["diachi"];
	$yeucaukhackh = $donhang["yeucaukhac"];
	$tamtinh = number_format($donhang['tamtinh'], 0, ',', '.')."đ";
	$tonggia = number_format($donhang['tonggia'], 0, ',', '.')."đ";
	$phiship = $donhang['phiship'];
	if($phiship) $phiship = number_format($phiship, 0, ',', '.')."đ";
	else $phiship = "Không";
	$phicoupon = $donhang['phicoupon'];
	$loaicoupon = $donhang['loaicoupon'];
	if($donhang['loaicoupon']==1) $phicoupon = "-".number_format($phicoupon, 0, ',', '.')."%";
	else if($donhang['loaicoupon']==2) $phicoupon = "-".number_format($phicoupon, 0, ',', '.')."đ";
	else $phicoupon = "Không";

	/* Trang thái */
	$trangthai = $d->rawQueryOne("select trangthai from #_status where id = ?",array($tinhtrang));

	/* Khởi tạo PHPWord */
	require_once LIBRARIES.'PHPWord.php';
	$PHPWord = new PHPWord();
	$filemau = LIBRARIES.'sample/order.docx';

	/* Load file Word mẫu */
	$document = $PHPWord->loadTemplate($filemau);

	/* Thông tin công ty */
	$document->setValue('{tencty}', $setting["tenvi"]);
	$document->setValue('{hotlinecty}', $optsetting["hotline"]);
	$document->setValue('{emailcty}', $optsetting["email"]);
	$document->setValue('{diachicty}', $optsetting["diachi"]);

	/* Thông tin đơn hàng */
	$document->setValue('{madonhang}', $madonhang);
	$document->setValue('{ngaydat}', $ngaydat);
	$document->setValue('{tinhtrang}', $trangthai['trangthai']);

	/* Thông tin khách hàng */
	$document->setValue('{hotenkh}', $hotenkh);
	$document->setValue('{dienthoaikh}', $dienthoaikh);
	$document->setValue('{emailkh}', $emailkh);
	$document->setValue('{diachikh}', $diachikh);
	$document->setValue('{yeucaukhackh}', $yeucaukhackh);

	/* Tạo chi tiết đơn hàng */
	$data = array();
	for($i=0;$i<count($detail);$i++) 
	{ 
		$data["stt"][$i] = $i+1;
		$data["ten"][$i] = $detail[$i]["ten"];
		$data["mau"][$i] = $detail[$i]["mau"];
		$data["size"][$i] = $detail[$i]["size"];
		$data["gia"][$i] = number_format($detail[$i]["gia"], 0, ',', '.')."đ";
		$data["giamoi"][$i] = number_format($detail[$i]["giamoi"], 0, ',', '.')."đ";
		$data["soluong"][$i] = $detail[$i]["soluong"];
		$data["thanhtien"][$i] = 0;
		if($detail[$i]["giamoi"]) $data["thanhtien"][$i] = number_format($detail[$i]["giamoi"]*$data["soluong"][$i], 0, ',', '.')."đ";
		else $data["thanhtien"][$i] = number_format($detail[$i]["gia"]*$data["soluong"][$i], 0, ',', '.')."đ";
	}

	/* Thiết lập đối tượng dữ liệu từng dòng */
	$document->cloneRow('TB', $data);

	/* Tính thành tiền */
	$document->setValue('{tamtinh}', $tamtinh);
	$document->setValue('{phiship}', $phiship);
	$document->setValue('{phicoupon}', $phicoupon);
	$document->setValue('{tonggia}', $tonggia);
	
	/* Lưu file */
	$filename = "order_".$madonhang."_".$time."_".date('d_m_Y').".docx";
	$document->save($filename);
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.$filename);
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: '. filesize($filename));
	flush();
	readfile($filename);
	unlink($filename);
?>