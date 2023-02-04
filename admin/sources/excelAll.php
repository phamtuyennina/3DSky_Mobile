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

	/* Kiểm tra active export excel */
	if(!isset($config['order']['excelall']) || $config['order']['excelall']==false) $func->transfer("Trang không tồn tại", "index.php", false);
	
	/* Setting */
	$setting = $d->rawQueryOne("select * from #_setting");
	$optsetting = json_decode($setting['options'],true);
		
	/* Thông tin đơn hàng */
	$time = time();
	$sql = "select * from #_order where id<>0";

	$listid = (isset($_REQUEST['listid'])) ? htmlspecialchars($_REQUEST['listid']):'';
	$tinhtrang = (isset($_REQUEST['tinhtrang'])) ? htmlspecialchars($_REQUEST['tinhtrang']):'';
	$httt = (isset($_REQUEST['httt'])) ? htmlspecialchars($_REQUEST['httt']):'';
	$ngaydat = (isset($_REQUEST['ngaydat'])) ? htmlspecialchars($_REQUEST['ngaydat']):'';
	$khoanggia = (isset($_REQUEST['khoanggia'])) ? htmlspecialchars($_REQUEST['khoanggia']):'';
	$city = (isset($_REQUEST['city'])) ? htmlspecialchars($_REQUEST['city']):'';
	$district = (isset($_REQUEST['district'])) ? htmlspecialchars($_REQUEST['district']):'';
	$wards = (isset($_REQUEST['wards'])) ? htmlspecialchars($_REQUEST['wards']):'';

	if(!empty($listid)) $sql .= " and id IN ($listid)";
	if(!empty($tinhtrang)) $sql .= " and tinhtrang=$tinhtrang";
	if(!empty($httt)) $sql .= " and httt=$httt";
	if(!empty($ngaydat))
	{
		$ngaydat = explode("-",$ngaydat);
		$ngaytu = trim($ngaydat[0]);
		$ngayden = trim($ngaydat[1]);
		$ngaytu = strtotime(str_replace("/","-",$ngaytu));
		$ngayden = strtotime(str_replace("/","-",$ngayden));
		$sql .= " and ngaytao<=$ngayden and ngaytao>=$ngaytu";
	}
	if(!empty($khoanggia))
	{
		$khoanggia = explode(";",$khoanggia);
		$giatu = trim($khoanggia[0]);
		$giaden = trim($khoanggia[1]);
		$sql .= " and tonggia<=$giaden and tonggia>=$giatu";
	}
	if(!empty($city)) $sql .= " and city=$city";
	if(!empty($district)) $sql .= " and district=$district";
	if(!empty($wards)) $sql .= " and wards=$wards";
	if($_REQUEST['keyword']!='')
	{
		$keyword = (isset($_REQUEST['keyword'])) ? htmlspecialchars($_REQUEST['keyword']):'';
		$sql .= " and (hoten LIKE '%$keyword%' or email LIKE '%$keyword%' or dienthoai LIKE '%$keyword%' or madonhang LIKE '%$keyword%')";
	}

	$sql .= " order by ngaytao desc";
	$donhang = $d->rawQuery($sql);
	
	/* PHPExcel */
	include LIBRARIES.'PHPExcel.php';
	include LIBRARIES.'PHPExcel/Writer/Excel5.php';
	$PHPExcel = new PHPExcel();

	/* Set properties */
	$PHPExcel->getProperties()->setCreator($setting['tenvi']);
	$PHPExcel->getProperties()->setLastModifiedBy($setting['tenvi']);
	$PHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
	$PHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
	$PHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");

	/* Add some data */
	$PHPExcel->setActiveSheetIndex(0);
	$PHPExcel->setActiveSheetIndex(0)->mergeCells('A1:M1');
	$PHPExcel->setActiveSheetIndex(0)->mergeCells('A2:M2');
	$PHPExcel->setActiveSheetIndex(0)->mergeCells('A3:M3');
	$PHPExcel->setActiveSheetIndex(0)->mergeCells('A4:M4');

	/* Thông tin chung */
	$PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
	$PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
	$PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	$PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
	$PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	$PHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
	$PHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
	$PHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
	$PHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
	$PHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
	$PHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
	$PHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
	$PHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('A1',$setting['tenvi']);
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('A2','Hotline: '.$optsetting['hotline']);
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('A3','Email: '.$optsetting['email']);
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('A4','Địa chỉ: '.$optsetting['diachi']);
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('A6','STT');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('B6','Mã đơn hàng');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('C6','Ngày đặt');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('D6','Tình trạng');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('E6','Hình thức thanh toán');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('F6','Họ tên');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('G6','Điện thoại');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('H6','Email');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('I6','Địa chỉ');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('J6','Tạm tính');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('K6','Phí vận chuyển');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('L6','Ưu đãi');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('M6','Tổng giá trị đơn hàng');

	/* Style */
	$PHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray(
		array(
			'font'=>array(
				'color'=>array(
					'rgb'=>'000000'
				),
				'name'=>'Arial',
				'bold'=>true,
				'italic'=>false,
				'size' => 14
			),
			'alignment'=>array(
				'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
				'wrap'=>true
			)
		)
	);
	$PHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray(
		array(
			'font'=>array(
				'size'=>11
			),
			'alignment'=>array(
				'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
				'wrap'=>true
			)
		)
	);
	$PHPExcel->getActiveSheet()->getStyle('A3')->applyFromArray(
		array(
			'font'=>array(
				'size'=>11
			),
			'alignment'=>array(
				'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
				'wrap'=>true
			)
		)
	);
	$PHPExcel->getActiveSheet()->getStyle('A4')->applyFromArray(
		array(
			'font'=>array(
				'size'=>11
			),
			'alignment'=>array(
				'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
				'wrap'=>true
			)
		)
	);
	$PHPExcel->getActiveSheet()->getStyle('A6:M6')->applyFromArray(
		array(
			'font'=>array(
				'color'=>array('rgb'=>'000000'),
				'name'=>'Calibri',
				'bold'=>true,
				'italic'=>false,
				'size'=> 10
			),
			'alignment'=>array(
				'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
				'wrap'=>true)
		)
	);
	$PHPExcel->getActiveSheet()->getStyle('A6:M6')->getBorders()->getAllBorders()->setBorderStyle(
		PHPExcel_Style_Border::BORDER_THIN
	);

	/* Thông tin tổng đơn hàng */
	$vitri = 7;
	for($i=0;$i<count($donhang);$i++) 
	{
		/* Phí ship */
		if($donhang[$i]['phiship']>0) $phiship = number_format($donhang[$i]['phiship'], 0, ',', '.')."đ";
		else $phiship = "Không";

		/* Phí coupon */
		if($donhang['loaicoupon']==1) $phicoupon = "-".number_format($donhang[$i]['phicoupon'], 0, ',', '.')."%";
		else if($donhang['loaicoupon']==2) $phicoupon = "-".number_format($donhang[$i]['phicoupon'], 0, ',', '.')."đ";
		else $phicoupon = "Không";
	
		/* Trang thái */
		$trangthai = $d->rawQueryOne("select trangthai from #_status where id = ?",array($donhang[$i]['tinhtrang']));
		
		$i_madonhang = (!empty($donhang[$i]['madonhang'])) ? $donhang[$i]['madonhang']:'';
		$i_ngaytao = (!empty($donhang[$i]['ngaytao'])) ? $donhang[$i]['ngaytao']:time();
		$i_httt = (!empty($donhang[$i]['httt'])) ? $donhang[$i]['httt']:0;
		$i_hoten = (!empty($donhang[$i]['hoten'])) ? $donhang[$i]['hoten']:'';
		$i_dienthoai = (!empty($donhang[$i]['dienthoai'])) ? $donhang[$i]['dienthoai']:'';
		$i_diachi = (!empty($donhang[$i]['diachi'])) ? $donhang[$i]['diachi']:'';
		$i_email = (!empty($donhang[$i]['email'])) ? $donhang[$i]['email']:'';
		$i_tamtinh = (!empty($donhang[$i]['tamtinh'])) ? $donhang[$i]['tamtinh']:0;
		$i_tonggia = (!empty($donhang[$i]['tonggia'])) ? $donhang[$i]['tonggia']:0;
		/* Gán giá trị */
		$PHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$vitri, $i+1)
		->setCellValue('B'.$vitri, $i_madonhang)
		->setCellValue('C'.$vitri, date('H:i A d-m-Y',$i_ngaytao))
		->setCellValue('D'.$vitri, $trangthai['trangthai'])
		->setCellValue('E'.$vitri, $func->get_payments($i_httt))
		->setCellValue('F'.$vitri, $i_hoten)
		->setCellValue('G'.$vitri, $i_dienthoai)
		->setCellValue('H'.$vitri, $i_email)
		->setCellValue('I'.$vitri, $i_diachi)
		->setCellValue('J'.$vitri, number_format($i_tamtinh, 0, ',', '.')."đ")
		->setCellValue('K'.$vitri, $phiship)
		->setCellValue('L'.$vitri, $phicoupon)
		->setCellValue('M'.$vitri, number_format($i_tonggia, 0, ',', '.')."đ");

		$PHPExcel->getActiveSheet()->getStyle('A'.$vitri.':M'.$vitri)->applyFromArray(
			array(
				'alignment'=>array(
					'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
					'wrap'=>true
				)
			)
		);
		$PHPExcel->getActiveSheet()->getStyle('A'.$vitri.':M'.$vitri)->getBorders()->getAllBorders()->setBorderStyle(
			PHPExcel_Style_Border::BORDER_THIN
		);
		$vitri++;
	}

	/* Đổi tiêu đề */
	$PHPExcel->getActiveSheet()->setTitle('DANH SÁCH ĐƠN HÀNG');

	/* Lưu file */
    header( 'Content-Type: application/vnd.ms-excel' );
    header( 'Content-Disposition: attachment;filename="orderlist_'.$time.'_'.date('d_m_Y').'.xls"' );
    header( 'Cache-Control: max-age=0' );

    $objWriter = new PHPExcel_Writer_Excel5($PHPExcel);
    $objWriter->save( 'php://output' );	
?>