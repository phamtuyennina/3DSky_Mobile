<?php 
	include "ajax_config.php";
	$action=$_POST['action'];
	switch ($action) {
		case 'register':
			accountRegister();
			break;
		case 'login':
			accountLogin();
			break;
		case 'avatar':
			accountAvatar();
			break;
		case 'myinfo':
			accountMyinfo();
			break;
		case 'add-address':
			actiontAddress();
			break;
		case 'set-addressdefault':
			actiontAddressDefault();
			break;
		case 'delete-address':
			actiontAddressDelete();
			break;
		case 'edit-address-load':
			actiontAddressEditLoad();
			break;
		case 'edit-address':
			actiontAddressEdit();
			break;
		case 'wishlist':
			actiontWishlist();
			break;
		default:
			break;
	}
function actiontWishlist()
{
	global $d,$lang,$config,$func,$emailer,$optsetting,$setting,$login_member;
	$rowUser = $d->rawQueryOne("select * from #_member where id=? and hienthi=1",array($_SESSION[$login_member]['id']));
	$idProduct=$_POST['idProduct'];
	$cmd=$_POST['cmd'];
	
	if($cmd=='add'){
		$data['id_user']=$_SESSION[$login_member]['id'];
		$data['id_product']=$idProduct;
		$d->insert('wishlist',$data);
	}else{
		$d->rawQuery("delete from #_wishlist where id_user=? and id_product=?",array($_SESSION[$login_member]['id'],$idProduct));
	}

	$count=$d->rawQueryOne("select count(id) as dem from #_wishlist where id_product=? and id_user=?",array($idProduct,$_SESSION[$login_member]['id']));
	echo $count['dem'];


}
function actiontAddressEdit(){
	global $d,$lang,$config,$func,$emailer,$optsetting,$setting,$login_member;
	$data = (isset($_POST['data'])) ? $_POST['data']:null;
	if(!empty($data)) { foreach($data as $column => $value) $data[$column] = htmlspecialchars($value); }
	$id=$_POST['id'];
	$d->where('id', $id);
	$d->update('member_address',$data);
}
function actiontAddressEditLoad(){
	global $d,$lang,$config,$func,$emailer,$optsetting,$setting,$login_member;
	$id=$_POST['id'];
	$country = $d->rawQuery("select ten, id from #_city where hienthi=1 order by stt asc");
	
	$rowAddress=$d->rawQueryOne("select * from #_member_address where id=? order by macdinh desc",array($id));
	$district = $d->rawQuery("select ten, id from #_district where hienthi=1 and id_city=? order by stt asc",array($rowAddress['country']));
	?>
	<div class="form d-flex flex-wrap ct__form fl-wrap">
        <div class="col-12 col-lg-12"><h2 class="sec-title"><?=chinhsuadiachigiaohang?></h2></div>
        <div class="col">
            <input type="text" name="data[ten]" value="<?=$rowAddress['ten']?>" size="40" oninvalid="this.setCustomValidity('<?=vuilongdienvaotruongnay?>')" oninput="this.setCustomValidity('')" class="rs-form form__inp" required="" placeholder="Your name*">
        </div>
        <div class="col-12 col-lg-12">
            <input type="text" name="data[dienthoai]" value="<?=$rowAddress['dienthoai']?>" oninvalid="this.setCustomValidity('<?=vuilongdienvaotruongnay?>')" oninput="this.setCustomValidity('')" size="40" class="rs-form form__inp" required="" placeholder="Your phone*">
        </div>
        <div class="col-12 col-lg-12">
            <input type="text" name="data[diachi]" value="<?=$rowAddress['diachi']?>" oninvalid="this.setCustomValidity('<?=vuilongdienvaotruongnay?>')" oninput="this.setCustomValidity('')" size="40" class="rs-form form__inp" required="" placeholder="Your address*">
        </div>
        <div class="col-12 col-sm-6" id="m-location-province">
            <select class="field-input form-control" id="country" oninvalid="this.setCustomValidity('<?=vuilongdienvaotruongnay?>')" oninput="this.setCustomValidity('')" required name="data[country]" onchange="load_district(this.value);">
                <option value="">  <?=chonqocgia?> </option>
                <?php foreach ($country as $key => $v) {?>
                <option <?=($rowAddress['country']==$v['id'])?'selected':''?> value="<?=$v['id']?>"><?=$v['ten']?></option>   
                <?php }?>
            </select>
        </div>
        
        <div class="col-12 col-sm-6">
            <input type="text" name="data[city]" value="<?=$rowAddress['city']?>" oninvalid="this.setCustomValidity('<?=vuilongdienvaotruongnay?>')" oninput="this.setCustomValidity('')" size="40" class="rs-form form__inp" required="" placeholder="City*">
        </div>
        <div class="col-12 col-sm-6">
            <input type="text" name="data[district]" value="<?=$rowAddress['district']?>" oninvalid="this.setCustomValidity('<?=vuilongdienvaotruongnay?>')" oninput="this.setCustomValidity('')" size="40" class="rs-form form__inp" required="" placeholder="District*">
        </div>
        <div class="col-12 col-sm-6">
            <input type="text" name="data[wards]" value="<?=$rowAddress['wards']?>" oninvalid="this.setCustomValidity('<?=vuilongdienvaotruongnay?>')" oninput="this.setCustomValidity('')" size="40" class="rs-form form__inp" required="" placeholder="Wards*">
        </div>
        <div class="col-12 col-lg-12">
            <input type="hidden" name="action" value="edit-address">
            <input type="hidden" name="id" value="<?=$rowAddress['id']?>">
            <button type="submit" value="yes"><?=chinhsua?></button>
        </div>
    </div>
	<?php 
}
function actiontAddressDelete(){
	global $d,$lang,$config,$func,$emailer,$optsetting,$setting,$login_member;
	$id_default=$_POST['id'];
	$rowUser = $d->rawQueryOne("select * from #_member where id=? and hienthi=1",array($_SESSION[$login_member]['id']));
	$d->rawQuery("delete from #_member_address where id=?",array($id_default));
}
function actiontAddressDefault(){
	global $d,$lang,$config,$func,$emailer,$optsetting,$setting,$login_member;
	$id_default=$_POST['id'];
	$rowUser = $d->rawQueryOne("select * from #_member where id=? and hienthi=1",array($_SESSION[$login_member]['id']));
	$data_update['macdinh']=0;
	$d->where('id_user', $rowUser['id']);
	if($d->update('member_address',$data_update)){
		$data['macdinh']=1;
		$d->where('id_user', $rowUser['id']);
		$d->where('id', $id_default);
		$d->update('member_address',$data);
	}
}
function actiontAddress(){
	global $d,$lang,$config,$func,$emailer,$optsetting,$setting,$login_member;
	$data = (isset($_POST['data'])) ? $_POST['data']:null;
	if(!empty($data)) { foreach($data as $column => $value) $data[$column] = htmlspecialchars($value); }
	$rowUser = $d->rawQueryOne("select * from #_member where id=? and hienthi=1",array($_SESSION[$login_member]['id']));
	$rowUserAddress = $d->rawQuery("select * from #_member_address where id_user=? ",array($_SESSION[$login_member]['id']));
	$data['id_user']=$rowUser['id'];
	if(empty($rowUserAddress)){
		$data['macdinh']=1;
	}
	$d->insert('member_address',$data);
}
function accountMyinfo(){
	global $d,$lang,$config,$func,$emailer,$optsetting,$setting,$login_member;
	$data = (isset($_POST['data'])) ? $_POST['data']:null;
	if(!empty($data)) { foreach($data as $column => $value) $data[$column] = htmlspecialchars($value); }
	$data['ngaysinh'] = strtotime(str_replace("/","-",$data['ngaysinh']));
	$rowUser = $d->rawQueryOne("select * from #_member where id=? and hienthi=1",array($_SESSION[$login_member]['id']));
	$d->where('id', $rowUser['id']);
	$d->update('member',$data);
}
function accountAvatar(){
	global $d,$lang,$config,$func,$emailer,$optsetting,$setting,$login_member,$config_base;
	$rowUser = $d->rawQueryOne("select * from #_member where id=? and hienthi=1",array($_SESSION[$login_member]['id']));
	if(isset($_FILES['file'])){
		$file_name = $func->uploadName($_FILES['file']["name"]);
		if($avatar = $func->uploadImage("file",'.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF', UPLOAD_USER,$file_name))
		{
			$data['avatar'] = $avatar;
			$row = $d->rawQueryOne("select id, avatar from #_member where id = ?",array($rowUser['id']));
			if(!empty($row['id'])) $func->delete_file(UPLOAD_USER.$row['avatar']);

			$d->where('id', $rowUser['id']);
			if($d->update('member',$data)){
				echo json_encode(array('avatar'=>$config_base.UPLOAD_USER_L.$data['avatar']),JSON_UNESCAPED_SLASHES);
			}
		}
	}

}
function accountLogin(){
	global $d,$lang,$config,$func,$emailer,$optsetting,$setting,$login_member;
	$data = (isset($_POST['data'])) ? $_POST['data']:null;
	$remember = htmlspecialchars($_POST['user_remember']);
	$password = $func->encrypt_password($config['website']['secret'], $data['password'],$config['website']['salt']);
	$row = $d->rawQueryOne("select * from #_member where email = ? or dienthoai=? and hienthi = 1 limit 0,1",array($data['username'],$data['username']));
	if($row['id'])
	{
		if($row['password'] == $password)
		{
			$id_user = $row['id'];
			$lastlogin = time();
			$login_session = md5($row['password'].$lastlogin);
			$d->rawQuery("update #_member set login_session = ?, lastlogin = ? where id = ?",array($login_session,$lastlogin,$id_user));

			/* Lưu session login */
			$_SESSION[$login_member]['active'] = true;
			$_SESSION[$login_member]['id'] = $row['id'];
			$_SESSION[$login_member]['dienthoai'] = $row['dienthoai'];
			$_SESSION[$login_member]['diachi'] = $row['diachi'];
			$_SESSION[$login_member]['email'] = $row['email'];
			$_SESSION[$login_member]['ten'] = $row['ten'];
			$_SESSION[$login_member]['login_session'] = $login_session;

			/* Nhớ mật khẩu */
			setcookie('login_member_id',"",-1,'/');
			setcookie('login_member_session',"",-1,'/');
			if($remember)
			{
				$time_expiry = time()+3600*24;
				setcookie('login_member_id',$row['id'],$time_expiry,'/');
				setcookie('login_member_session',$login_session,$time_expiry,'/');
			}
			$data_res['error']=0;
			echo json_encode($data_res);die;
		}
		else
		{
			$data_res['mess']=loidangnhap;
			$data_res['error']=1;
			echo json_encode($data_res);die;
		}
	}
	else
	{
		$data_res['mess']=loidangnhap;
		$data_res['error']=1;
		echo json_encode($data_res);die;
	}
}

function accountRegister(){
	global $d,$lang,$config,$func,$emailer,$optsetting,$setting;
	$data = (isset($_POST['data'])) ? $_POST['data']:null;
	if(!empty($data)) { foreach($data as $column => $value) $data[$column] = htmlspecialchars($value); }
	$pass=$func->encrypt_password($config['website']['secret'], $data['password'],$config['website']['salt']);
	$pass_ree=$func->encrypt_password($config['website']['secret'], $_POST['register_repass'],$config['website']['salt']);
	$error=array();
	$data_res=array();
	if($pass!=$pass_ree){
		$data_res['mess']=nhaplaimatkhaukhongchinhxac;
		$data_res['error']=1;
		echo json_encode($data_res);die;
	}
	$checkMember=$d->rawQuery("select * from #_member where email = ? or dienthoai=?",array($data['email'],$data['dienthoai']));
	if(!empty($checkMember)){
		$data_res['mess']=emailorsodienthoaidatontai;
		$data_res['error']=1;
		echo json_encode($data_res);die;
	}
	$data['password']=$pass;
	$data['hienthi']=1;
	$data['ngaysinh'] = strtotime(str_replace("/","-",$data['ngaysinh']));
	if($d->insert('member',$data))
	{
		$data_res['error']=0;
		echo json_encode($data_res);
		$id_insert = $d->getLastInsertId();
		send_active_user($id_insert);
		die;
	}
	else
	{
		$data_res['mess']=coloixayravuilongthulaisau;
		$data_res['error']=1;
		echo json_encode($data_res);die;
	}

}

function send_active_user($id){
	global $d, $setting, $emailer, $func, $config_base, $lang;
	$row = $d->rawQueryOne("select id, username, password, ten, email, dienthoai, diachi from #_member where id = ? limit 0,1",array($id));
	$htmlEmail='<table style="border-spacing:0;border-collapse:collapse;height:100%!important;width:100%!important">
    		<tbody>
    			<tr>
      		<td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">';
				$htmlEmail .='<table style="border-spacing:0;border-collapse:collapse;width:100%;margin:40px 0 20px">
						<tbody>
							<tr>
  							<td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">
    								<center>
      								<table style="border-spacing:0;border-collapse:collapse;width:560px;text-align:left;margin:0 auto">
        									<tbody>
        										<tr>
          										<td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">
            											<table style="border-spacing:0;border-collapse:collapse;width:100%">
              											<tbody>
              												<tr>
                													<td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">
                														<h1 style="font-weight:normal;margin:0;font-size:30px;color:#333">
                      													<a href="'.$config_base.'" style="font-size:30px;text-decoration:none;color:#333" target="_blank" h><span class="il">'.$setting['ten'.$lang].'</span>
                      													</a>
                    													</h1>
                													</td>
              												</tr>
            												</tbody>
            											</table>
          										</td>
    											</tr>
      									</tbody>
      								</table>
    								</center>
  							</td>
							</tr>
					</tbody>
				</table>';
        			$htmlEmail .='<table style="border-spacing:0;border-collapse:collapse;width:100%">
						<tbody>
							<tr>
  							<td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding-bottom:40px">
   								 <center>
      								<table style="border-spacing:0;border-collapse:collapse;width:560px;text-align:left;margin:0 auto">
        									<tbody>
        										<tr>
          										<td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">
          											<h2 style="font-weight:normal;margin:0;font-size:24px;margin-bottom:10px">Welcome to <span class="il">'.$setting['ten'.$lang].'</span>! </h2>
      												<p style="margin:0;color:#777;line-height:150%;font-size:16px">Congratulations, you have successfully activated your customer account. Next time you make a purchase, log in to make payment more convenient.
      												</p>
    													<table style="border-spacing:0;border-collapse:collapse;width:100%;margin-top:20px">
      													<tbody>
      														<tr>
        															<td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif">
          															<table style="border-spacing:0;border-collapse:collapse;float:left;margin-right:15px">
                															<tbody>
                																<tr>
                  																<td style="font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;text-align:center;padding:20px 25px;border-radius:4px;background:#1666a2">
                  																	<a href="'.$config_base.'" style="font-size:16px;text-decoration:none;color:#fff" target="_blank">Visit our store
                  																	</a>
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
										</tbody>
									</table>
								</center>
							</td>
						</tr>
					</tbody>
				</table>';

        			$htmlEmail .="<table style='border-spacing:0;border-collapse:collapse;width:100%;border-top:1px solid #e5e5e5'>
						<tbody>
							<tr>
  							<td style='font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif;padding:35px 0'>
    								<center>
      								<table style='border-spacing:0;border-collapse:collapse;width:560px;text-align:left;margin:0 auto'>
        									<tbody>
        										<tr>
          										<td style='font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,&quot;Roboto&quot;,&quot;Oxygen&quot;,&quot;Ubuntu&quot;,&quot;Cantarell&quot;,&quot;Fira Sans&quot;,&quot;Droid Sans&quot;,&quot;Helvetica Neue&quot;,sans-serif'>
            											<p style='margin:0;color:#999;line-height:150%;font-size:14px'>If you have any questions, don't hesitate to contact us at 
            												<a href='mailto:".$optsetting['email']."' style='font-size:14px;text-decoration:none;color:#1666a2' target='_blank'>".$optsetting['email']."</a>
            											</p>
          										</td>
        										</tr>
      									</tbody>
      								</table>
    								</center>
  							</td>
							</tr>
					</tbody>
				</table>";
      		$htmlEmail .="</td>
    		</tr>
  	</tbody></table>";

  	$arrayEmail = array(
		"dataEmail" => array(
			"name" => $row['ten'],
			"email" => $row['email']
		)
	);
	$subject = $setting['ten'.$lang]." - Customer account confirmation";
	$emailer->sendEmail("customer", $arrayEmail, $subject, $htmlEmail, $file);

}
?>