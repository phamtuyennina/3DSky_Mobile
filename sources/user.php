<?php
	if(!defined('SOURCES')) die("Error");

	$action = htmlspecialchars($match['params']['action']);

	switch($action)
	{
		case 'login':
			$title_crumb = 'Login';
			$template = "account/dangnhap";
			if(isset($_SESSION[$login_member]) && $_SESSION[$login_member] == true) $func->transfer("Page does not exist",$config_base, false);
			if(isset($_POST['dangnhap'])) login();
			break;

		case 'sign-up':
			$title_crumb = 'Sign Up';
			$template = "account/dangky";
			if(isset($_SESSION[$login_member]) && $_SESSION[$login_member] == true) $func->transfer("Page does not exist",$config_base, false);
			if(isset($_POST['dangky'])) signup();
			break;

		case 'quen-mat-khau':
			$title_crumb = quenmatkhau;
			$template = "account/quenmatkhau";
			if(isset($_SESSION[$login_member]) && $_SESSION[$login_member] == true) $func->transfer("Page does not exist",$config_base, false);
			if(isset($_POST['quenmatkhau'])) doimatkhau_user();
			break;

		case 'kich-hoat':
			$title_crumb = kichhoat;
			$template = "account/kichhoat";
			if(isset($_SESSION[$login_member]) && $_SESSION[$login_member] == true) $func->transfer("Page does not exist",$config_base, false);
			if(isset($_POST['kichhoat'])) active_user();
			break;

		case 'profile':
			if(!isset($_SESSION[$login_member]) || !$_SESSION[$login_member]) $func->transfer("Page does not exist",$config_base, false);
			$template = "account/thongtin";
			$title_crumb = 'Profile';
			info_user();
			break;

		case 'bookmarks':
			if(!isset($_SESSION[$login_member]) || !$_SESSION[$login_member]) $func->transfer("Page does not exist",$config_base, false);
			$template = "account/bookmarks";
			$title_crumb = 'Bookmarks';
			bookmarks();
			break;

		case 'purchases':
			if(!isset($_SESSION[$login_member]) || !$_SESSION[$login_member]) $func->transfer("Page does not exist",$config_base, false);
			$template = "account/purchases";
			$title_crumb = 'Purchases';
			purchases();
			break;

		case 'logout':
			if(!isset($_SESSION[$login_member]) || !$_SESSION[$login_member]) $func->transfer("Page does not exist",$config_base, false);
			logout();

		case 'buy':
			if(empty($_SESSION[$login_member])) $func->redirect($config_base.'account/login');
			$template = "account/buy";
			$title_crumb = 'Models Purchase';
			break;
		default:
			header('HTTP/1.0 404 Not Found', true, 404);
			include("404.php");
			exit();
	}

	/* SEO */
	$seo->setSeo('title',$title_crumb);

	/* breadCrumbs */
	if($title_crumb) $breadcr->setBreadCrumbs('',$title_crumb);
	$breadcrumbs = $breadcr->getBreadCrumbs();


	function purchases(){
		global $d, $func, $row_detail, $config_base, $login_member,$get_page,$paging,$product,$lang;
		$iduser = $_SESSION[$login_member]['id'];

		$where = "";
		$where = "hienthi=1 and type = 'san-pham'";
		$where .=" and id IN (select id_product from #_product_download where id_user=".$iduser." and type='pro')";

		$curPage = $get_page;
		$per_page = 20;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select photo, ten$lang, tenkhongdauvi, tenkhongdauen, giamoi, gia, id,masp,tinhtrang,taptin from #_product where $where order by stt,id desc $limit";
		$product = $d->rawQuery($sql);
		$sqlNum = "select count(*) as 'num' from #_product where $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum);
		$total = $count['num'];
		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	function bookmarks(){
		global $d, $func, $row_detail, $config_base, $login_member,$get_page,$paging,$product,$lang;
		$iduser = $_SESSION[$login_member]['id'];

		$where = "";
		$where = "hienthi=1 and type = 'san-pham'";
		$where .=" and id IN (select id_product from #_product_like where id_user=".$iduser.")";

		$curPage = $get_page;
		$per_page = 20;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select photo, ten$lang, tenkhongdauvi, tenkhongdauen, giamoi, gia, id,masp,tinhtrang from #_product where $where order by stt,id desc $limit";
		$product = $d->rawQuery($sql);
		$sqlNum = "select count(*) as 'num' from #_product where $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum);
		$total = $count['num'];
		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	function info_user()
	{
		global $d, $func, $row_detail, $config_base, $login_member;

		$iduser = $_SESSION[$login_member]['id'];

		if($iduser)
		{
			$row_detail = $d->rawQueryOne("select ten, username, gioitinh, ngaysinh, email, dienthoai, diachi from #_member where id = ? limit 0,1",array($iduser));

		    if(isset($_POST['capnhatthongtin']))
		    {
		    	$data = (isset($_POST['data'])) ? $_POST['data']:null;
				if(!empty($data)) { foreach($data as $column => $value) $data[$column] = htmlspecialchars($value); }

				if(!empty($_POST['old-password']) && !empty($_POST['password']) && !empty($_POST['rePassword'])){
					$old_password = md5($_POST['old-password']);
					$new_password = md5($_POST['password']);
					$renew_password = md5($_POST['rePassword']);
				}	

		        if($old_password)
		        {
		            $row = $d->rawQueryOne("select id from #_member where id = ? and password = ? limit 0,1",array($iduser,$old_password));

		            if(!$row['id']) $func->transfer("Current password is incorrect","", false);
		            if(!$new_password || ($new_password != $renew_password)) $func->transfer("New password information is incorrect","", false);

		            $data['password'] = $old_password;
		        }
		        $d->where('id', $iduser);
		        if($d->update('member',$data))
		        {
		        	if($password)
		        	{
			            $_SESSION[$login_member] = false;
			            unset($_SESSION['login_member']);
			            setcookie('login_member_id',"",-1,'/');
						setcookie('login_member_session',"",-1,'/');
		            	$func->transfer("Successfully updated",$config_base."account/login");
		        	}

					$_SESSION[$login_member]['dienthoai'] = $data['dienthoai'];
					$_SESSION[$login_member]['diachi'] = $data['diachi'];
					$_SESSION[$login_member]['ten'] = $data['ten'];
		        	$func->transfer("Successfully updated",$config_base."account/profile");	            
		        }
		    }
		}
		else
		{
			$func->transfer("Page does not exist",$config_base, false);
		}
	}

	function active_user()
	{
		global $d, $func, $row_detail, $config_base;

		$id = htmlspecialchars($_GET['id']);
		$maxacnhan = htmlspecialchars($_POST['maxacnhan']);

		/* Ki???m tra th??ng tin */
        $row_detail = $d->rawQueryOne("select hienthi, maxacnhan, id from #_member where id = ? limit 0,1",array($id));

        if(!$row_detail['id']) $func->transfer("T??i kho???n c???a b???n ch??a ???????c k??ch ho???t",$config_base, false);
        else if($row_detail['hienthi']) $func->transfer("T??i kho???n c???a b???n ???? ???????c k??ch ho???t",$config_base);
        else
        {
    		if($row_detail['maxacnhan'] == $maxacnhan)
        	{
        		$data['hienthi'] = 1;
        		$data['maxacnhan'] = '';
				$d->where('id', $id);
				if($d->update('member',$data)) $func->transfer("K??ch ho???t t??i kho???n th??nh c??ng.",$config_base."account/dang-nhap");
        	}
        	else
        	{
        		$func->transfer("M?? x??c nh???n kh??ng ????ng. Vui l??ng nh???p l???i m?? x??c nh???n.",$config_base."account/kich-hoat?id=".$id, false);
        	}
        }
	}

	function login()
	{
		global $d, $func, $login_member, $config_base;

		$email = htmlspecialchars($_POST['email']);
		$password = htmlspecialchars($_POST['password']);
		$passwordMD5 = md5($password);
		$remember = htmlspecialchars($_POST['remember-user']);
		$row = $d->rawQueryOne("select * from #_member where email = ? and hienthi = 1 limit 0,1",array($email));

		if($row['id'])
		{
			if($row['password'] == $passwordMD5)
			{
				/* T???o login session */
				$id_user = $row['id'];
				$lastlogin = time();
				$login_session = md5($row['password'].$lastlogin);
				$d->rawQuery("update #_member set login_session = ?, lastlogin = ? where id = ?",array($login_session,$lastlogin,$id_user));

				/* L??u session login */
				$_SESSION[$login_member]['active'] = true;
				$_SESSION[$login_member]['id'] = $row['id'];
				$_SESSION[$login_member]['username'] = $row['username'];
				$_SESSION[$login_member]['email'] = $row['email'];
				$_SESSION[$login_member]['dienthoai'] = $row['dienthoai'];
				$_SESSION[$login_member]['diachi'] = $row['diachi'];
				$_SESSION[$login_member]['email'] = $row['email'];
				$_SESSION[$login_member]['ten'] = $row['ten'];
				$_SESSION[$login_member]['login_session'] = $login_session;

				if(!empty($row['free_start']) && !empty($row['free_end'])){
					if($row['free_end']<time()){
						$dataupdate['free_end']='';
						$dataupdate['free_start']='';
						$dataupdate['numfree']=3;
						$d->where('id', $row['id']);
						$d->update('member',$dataupdate);
					}
				}

				/* Nh??? m???t kh???u */
				setcookie('login_member_id',"",-1,'/');
				setcookie('login_member_session',"",-1,'/');
				if($remember)
				{
					$time_expiry = time()+3600*24;
					setcookie('login_member_id',$row['id'],$time_expiry,'/');
					setcookie('login_member_session',$login_session,$time_expiry,'/');
				}

				$func->transfer("Logged in successfully", $config_base);
			}
			else
			{
				$func->transfer("Username or password incorrect. Or your account has not been confirmed from the Website Admin", $config_base."account/login", false);
			}
		}
		else
		{
			$func->transfer("Username or password incorrect. Or your account has not been confirmed from the Website Admin", $config_base."account/login", false);
		}
	}

	function signup()
	{
		global $d, $func, $config_base;

		$username = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']);
		$passwordMD5 = md5($password);
		$repassword = htmlspecialchars($_POST['rePassword']);
		$repasswordMD5 = md5($repassword);
		$email = htmlspecialchars($_POST['email']);
		if($passwordMD5 != $repasswordMD5) $func->transfer("Confirm password does not match", $config_base."account/sign-up", false);
		/* Ki???m tra t??n ????ng k?? */
		$row = $d->rawQueryOne("select id from #_member where username = ? limit 0,1",array($username));
		if($row['id']) $func->transfer("Username available", $config_base."account/sign-up", false);

		/* Ki???m tra email ????ng k?? */
		$row = $d->rawQueryOne("select id from #_member where email = ? limit 0,1",array($email));
		if($row['id']) $func->transfer("Email address already exists", $config_base."account/sign-up", false);

		$data['username'] = $username;
		$data['password'] = $passwordMD5;
		$data['numfree'] = 3;
		$data['email'] = $email;
		$data['hienthi'] = 1;
		
		if($d->insert('member',$data))
		{
			//send_active_user($username);
			$func->transfer("Member registration is successful. Click here to proceed to login account", $config_base."account/login");
		}
		else
		{
			$func->transfer("Member registration failed. Please try again later.", $config_base, false);
		}
	}

	function send_active_user($username)
	{
		global $d, $setting, $emailer, $func, $config_base, $lang;

		/* L???y th??ng tin ng?????i d??ng */
		$row = $d->rawQueryOne("select id, maxacnhan, username, password, ten, email, dienthoai, diachi from #_member where username = ? limit 0,1",array($username));

		/* G??n gi?? tr??? g???i email */
		$iduser = $row['id'];
		$maxacnhan = $row['maxacnhan'];
		$tendangnhap = $row['username'];
		$matkhau = $row['password'];
		$tennguoidung = $row['ten'];
		$emailnguoidung = $row['email'];
		$dienthoainguoidung = $row['dienthoai'];
		$diachinguoidung = $row['diachi'];
		$linkkichhoat = $config_base."account/kich-hoat?id=".$iduser;

		/* Th??ng tin ????ng k?? */
		$thongtindangky='<td style="padding:3px 9px 9px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:normal">Username: '.$tendangnhap.'</span><br>M???t kh???u: *******'.substr($matkhau,-3).'<br>M?? k??ch ho???t: '.$maxacnhan.'</td><td style="padding:3px 0px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">';
		if($tennguoidung)
		{
			$thongtindangky.='<span style="text-transform:capitalize">'.$tennguoidung.'</span><br>';
		}
		if($emailnguoidung)
		{
			$thongtindangky.='<a href="mailto:'.$emailnguoidung.'" target="_blank">'.$emailnguoidung.'</a><br>';
		}
		if($diachinguoidung)
		{
			$thongtindangky.=$diachinguoidung.'<br>';
		}
		if($dienthoainguoidung)
		{
			$thongtindangky.='Tel: '.$dienthoainguoidung.'</td>';
		}

		$contentMember = '
		<table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
			<tbody>
				<tr>
					<td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
						<table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px" width="600">
							<tbody>
								<tr>
									<td align="center" id="m_-6357629121201466163headerImage" valign="bottom">
										<table cellpadding="0" cellspacing="0" style="border-bottom:3px solid '.$emailer->getEmail('color').';padding-bottom:10px;background-color:#fff" width="100%">
											<tbody>
												<tr>
													<td bgcolor="#FFFFFF" style="padding:0" valign="top" width="100%">
														<div style="color:#fff;background-color:f2f2f2;font-size:11px">&nbsp;</div>
														<div style="display:flex;justify-content:space-between;align-items:center;">
															<table style="width:100%;">
																<tbody>
																	<tr>
																		<td>
																			<a href="'.$emailer->getEmail('home').'" style="border:medium none;text-decoration:none;color:#007ed3;margin:0px 0px 0px 20px" target="_blank">'.$emailer->getEmail('logo').'</a>
																		</td>
																		<td style="padding:15px 20px 0 0;text-align:right">'.$emailer->getEmail('social').'</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr style="background:#fff">
									<td align="left" height="auto" style="padding:15px" width="600">
										<table>
											<tbody>
												<tr>
													<td>
														<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">C???m ??n qu?? kh??ch ???? ????ng k?? t???i '.$emailer->getEmail('company:website').'</h1>
														<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Th??ng tin t??i kho???n c???a qu?? kh??ch ???? ???????c '.$emailer->getEmail('company:website').' c???p nh???t. Qu?? kh??ch vui l??ng k??ch ho???t t??i kho???n b???ng c??ch truy c???p v??o ???????ng link ph??a d?????i.</p>
														<h3 style="font-size:13px;font-weight:bold;color:'.$emailer->getEmail('color').';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">Th??ng tin t??i kho???n <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">(Ng??y '.date('d',$emailer->getEmail('datesend')).' th??ng '.date('m',$emailer->getEmail('datesend')).' n??m '.date('Y H:i:s',$emailer->getEmail('datesend')).')</span></h3>
													</td>
												</tr>
											<tr>
											<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
											<table border="0" cellpadding="0" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th align="left" style="padding:6px 9px 0px 0px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Th??ng tin t??i kho???n</th>
														<th align="left" style="padding:6px 0px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Th??ng tin ng?????i d??ng</th>
													</tr>
												</thead>
												<tbody>
													<tr>'.$thongtindangky.'</tr>
												</tbody>
											</table>
											</td>
										</tr>
										<tr>
											<td>
											<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><i>L??u ??: Qu?? kh??ch vui l??ng truy c???p v??o ???????ng link ph??a d?????i ????? ho??n t???t qu?? tr??nh ????ng k?? t??i kho???n.</i>
											<div style="margin:auto"><a href="'.$linkkichhoat.'" style="display:inline-block;text-decoration:none;background-color:'.$emailer->getEmail('color').'!important;margin-right:30px;text-align:center;border-radius:3px;color:#fff;padding:5px 10px;font-size:12px;font-weight:bold;margin-left:38%;margin-top:5px" target="_blank">K??ch ho???t t??i kho???n</a></div>
											</p>
											</td>
										</tr>
										<tr>
											<td>&nbsp;
												<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px '.$emailer->getEmail('color').' dashed;padding:10px;list-style-type:none">B???n c???n ???????c h??? tr??? ngay? Ch??? c???n g???i mail v??? <a href="mailto:'.$emailer->getEmail('company:email').'" style="color:'.$emailer->getEmail('color').';text-decoration:none" target="_blank"> <strong>'.$emailer->getEmail('company:email').'</strong> </a>, ho???c g???i v??? hotline <strong style="color:'.$emailer->getEmail('color').'">'.$emailer->getEmail('company:hotline').'</strong> '.$emailer->getEmail('company:worktime').'. '.$emailer->getEmail('company:website').' lu??n s???n s??ng h??? tr??? b???n b???t k?? l??c n??o.</p>
											</td>
										</tr>
										<tr>
											<td>&nbsp;
											<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">M???t l???n n???a '.$emailer->getEmail('company:website').' c???m ??n qu?? kh??ch.</p>
											<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:right"><strong><a href="'.$emailer->getEmail('home').'" style="color:'.$emailer->getEmail('color').';text-decoration:none;font-size:14px" target="_blank">'.$emailer->getEmail('company').'</a> </strong></p>
											</td>
										</tr>
									</tbody>
								</table>
								</td>
							</tr>
						</tbody>
					</table>
					</td>
				</tr>
				<tr>
					<td align="center">
					<table width="600">
						<tbody>
							<tr>
								<td>
								<p align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal">Qu?? kh??ch nh???n ???????c email n??y v?? ???? ????ng k?? t???i '.$emailer->getEmail('company:website').'.<br>
								????? ch???c ch???n lu??n nh???n ???????c email th??ng b??o, ph???n h???i t??? '.$emailer->getEmail('company:website').', qu?? kh??ch vui l??ng th??m ?????a ch??? <strong><a href="mailto:'.$emailer->getEmail('email').'" target="_blank">'.$emailer->getEmail('email').'</a></strong> v??o s??? ?????a ch??? (Address Book, Contacts) c???a h???p email.<br>
								<b>?????a ch???:</b> '.$emailer->getEmail('company:address').'</p>
								</td>
							</tr>
						</tbody>
					</table>
					</td>
				</tr>
			</tbody>
		</table>';

		/* Send email admin */
		$arrayEmail = array(
			"dataEmail" => array(
				"name" => $row['username'],
				"email" => $row['email']
			)
		);
		$subject = "Th?? k??ch ho???t t??i kho???n th??nh vi??n t??? ".$setting['ten'.$lang];
		$message = $contentMember;

		if(!$emailer->sendEmail("customer", $arrayEmail, $subject, $message, $file)) $func->transfer("C?? l???i x???y ra trong qu?? tr??nh k??ch ho???t t??i kho???n. Vui l??ng li??n h??? v???i ch??ng t??i.",$config_base."lien-he", false);
	}

	function doimatkhau_user()
	{
		global $d, $setting, $emailer, $func, $login_member, $config_base, $lang;

		$username = htmlspecialchars($_POST['username']);
		$email = htmlspecialchars($_POST['email']);
		$newpass = substr(md5(rand(0,999)*time()), 15, 6);
		$newpassMD5 = md5($newpass);

		if(!$username) $func->transfer("Ch??a nh???p t??n t??i kho???n", $config_base."account/quen-mat-khau", false);
		if(!$email) $func->transfer("Ch??a nh???p email ????ng k?? t??i kho???n", $config_base."account/quen-mat-khau", false);

		/* Ki???m tra username v?? email */
		$row = $d->rawQueryOne("select id from #_member where username = ? and email = ? limit 0,1",array($username,$email));
		if(!$row['id']) $func->transfer("T??n ????ng nh???p v?? email kh??ng t???n t???i", $config_base."account/quen-mat-khau", false);

		/* C???p nh???t m???t kh???u m???i */
		$data['password'] = $newpassMD5;
		$d->where('username', $username);
		$d->where('email', $email);
		$d->update('member',$data);

		/* L???y th??ng tin ng?????i d??ng */
		$row = $d->rawQueryOne("select id, username, password, ten, email, dienthoai, diachi from #_member where username = ? limit 0,1",array($username));

		/* G??n gi?? tr??? g???i email */
		$iduser = $row['id'];
		$tendangnhap = $row['username'];
		$matkhau = $row['password'];
		$tennguoidung = $row['ten'];
		$emailnguoidung = $row['email'];
		$dienthoainguoidung = $row['dienthoai'];
		$diachinguoidung = $row['diachi'];

	    /* Th??ng tin ????ng k?? */
	    $thongtindangky='<td style="padding:3px 9px 9px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:normal">Username: '.$tendangnhap.'</span><br>M???t kh???u: *******'.substr($matkhau,-3).'</td><td style="padding:3px 0px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">';
	    if($tennguoidung)
	    {
	    	$thongtindangky.='<span style="text-transform:capitalize">'.$tennguoidung.'</span><br>';
	    }

	    if($emailnguoidung)
	    {
	    	$thongtindangky.='<a href="mailto:'.$emailnguoidung.'" target="_blank">'.$emailnguoidung.'</a><br>';
	    }

	    if($diachinguoidung)
	    {
	    	$thongtindangky.=$diachinguoidung.'<br>';
	    }

	    if($dienthoainguoidung)
	    {
	    	$thongtindangky.='Tel: '.$dienthoainguoidung.'</td>';
	    }

	    $contentMember = '
		<table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
			<tbody>
				<tr>
					<td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
						<table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px" width="600">
							<tbody>
								<tr>
									<td align="center" id="m_-6357629121201466163headerImage" valign="bottom">
										<table cellpadding="0" cellspacing="0" style="border-bottom:3px solid '.$emailer->getEmail('color').';padding-bottom:10px;background-color:#fff" width="100%">
											<tbody>
												<tr>
													<td bgcolor="#FFFFFF" style="padding:0" valign="top" width="100%">
														<div style="color:#fff;background-color:f2f2f2;font-size:11px">&nbsp;</div>
														<table style="width:100%;">
															<tbody>
																<tr>
																	<td>
																		<a href="'.$emailer->getEmail('home').'" style="border:medium none;text-decoration:none;color:#007ed3;margin:0px 0px 0px 20px" target="_blank">'.$emailer->getEmail('logo').'</a>
																	</td>
																	<td style="padding:15px 20px 0 0;text-align:right">'.$emailer->getEmail('social').'</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr style="background:#fff">
									<td align="left" height="auto" style="padding:15px" width="600">
										<table>
											<tbody>
												<tr>
													<td>
														<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">K??nh ch??o Qu?? kh??ch</h1>
														<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Y??u c???u cung c???p l???i m???t kh???u c???a qu?? kh??ch ???? ???????c ti???p nh???n v?? ??ang trong qu?? tr??nh x??? l??. Qu?? kh??ch vui l??ng x??c nh???n v??o ???????ng d???n ph??a d?????i ????? ???????c c???p m???tu kh???u m???i.</p>
														<h3 style="font-size:13px;font-weight:bold;color:'.$emailer->getEmail('color').';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">Th??ng tin t??i kho???n <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">(Ng??y '.date('d',$emailer->getEmail('datesend')).' th??ng '.date('m',$emailer->getEmail('datesend')).' n??m '.date('Y H:i:s',$emailer->getEmail('datesend')).')</span></h3>
													</td>
												</tr>
											<tr>
											<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
											<table border="0" cellpadding="0" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th align="left" style="padding:6px 9px 0px 0px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Th??ng tin t??i kho???n</th>
														<th align="left" style="padding:6px 0px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Th??ng tin ng?????i d??ng</th>
													</tr>
												</thead>
												<tbody>
													<tr>'.$thongtindangky.'</tr>
												</tbody>
											</table>
											</td>
										</tr>
										<tr>
											<td>
											<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><i>L??u ??: Qu?? kh??ch vui l??ng thay ?????i m???t kh???u ngay khi ????ng nh???p b???ng m???t kh???u m???i b??n d?????i.</i>
											<div style="margin:auto"><p style="display:inline-block;text-decoration:none;background-color:'.$emailer->getEmail('color').'!important;margin-right:30px;text-align:center;border-radius:3px;color:#fff;padding:5px 10px;font-size:12px;font-weight:bold;margin-left:33%;margin-top:5px" target="_blank">M???t kh???u m???i: '.$newpass.'</p></div>
											</p>
											</td>
										</tr>
										<tr>
											<td>&nbsp;
												<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px '.$emailer->getEmail('color').' dashed;padding:10px;list-style-type:none">B???n c???n ???????c h??? tr??? ngay? Ch??? c???n g???i mail v??? <a href="mailto:'.$emailer->getEmail('company:email').'" style="color:'.$emailer->getEmail('color').';text-decoration:none" target="_blank"> <strong>'.$emailer->getEmail('company:email').'</strong> </a>, ho???c g???i v??? hotline <strong style="color:'.$emailer->getEmail('color').'">'.$emailer->getEmail('company:hotline').'</strong> '.$emailer->getEmail('company:worktime').'. '.$emailer->getEmail('company:website').' lu??n s???n s??ng h??? tr??? b???n b???t k?? l??c n??o.</p>
											</td>
										</tr>
										<tr>
											<td>&nbsp;
											<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">M???t l???n n???a '.$emailer->getEmail('company:website').' c???m ??n qu?? kh??ch.</p>
											<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:right"><strong><a href="'.$emailer->getEmail('home').'" style="color:'.$emailer->getEmail('color').';text-decoration:none;font-size:14px" target="_blank">'.$emailer->getEmail('company').'</a> </strong></p>
											</td>
										</tr>
									</tbody>
								</table>
								</td>
							</tr>
						</tbody>
					</table>
					</td>
				</tr>
				<tr>
					<td align="center">
					<table width="600">
						<tbody>
							<tr>
								<td>
								<p align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal">Qu?? kh??ch nh???n ???????c email n??y v?? ???? li??n h??? t???i '.$emailer->getEmail('company:website').'.<br>
								????? ch???c ch???n lu??n nh???n ???????c email th??ng b??o, ph???n h???i t??? '.$emailer->getEmail('company:website').', qu?? kh??ch vui l??ng th??m ?????a ch??? <strong><a href="mailto:'.$emailer->getEmail('email').'" target="_blank">'.$emailer->getEmail('email').'</a></strong> v??o s??? ?????a ch??? (Address Book, Contacts) c???a h???p email.<br>
								<b>?????a ch???:</b> '.$emailer->getEmail('company:address').'</p>
								</td>
							</tr>
						</tbody>
					</table>
					</td>
				</tr>
			</tbody>
		</table>';

		/* Send email admin */
		$arrayEmail = array(
			"dataEmail" => array(
				"name" => $tennguoidung,
				"email" => $email
			)
		);
		$subject = "Th?? c???p l???i m???t kh???u t??? ".$setting['ten'.$lang];
		$message = $contentMember;
		
		if($emailer->sendEmail("customer", $arrayEmail, $subject, $message, $file))
		{
			$_SESSION[$login_member] = false;
			unset($_SESSION['login_member']);
			setcookie('login_member_id',"",-1,'/');
			setcookie('login_member_session',"",-1,'/');
			$func->transfer("C???p l???i m???t kh???u th??nh c??ng. Vui l??ng ki???m tra email: ".$email, $config_base);
		}
		else
		{
			$func->transfer("C?? l???i x???y ra trong qu?? tr??nh c???p l???i m???t kh???u. Vui l??ng li???n h??? v???i ch??ng t??i.", $config_base."account/quen-mat-khau", false);
		}
	}

	function logout()
	{
		global $d, $func, $login_member, $config_base;

		$_SESSION[$login_member] = false;
		unset($_SESSION['login_member']);
		setcookie('login_member_id',"",-1,'/');
		setcookie('login_member_session',"",-1,'/');

		$func->redirect($config_base);
	}
?>