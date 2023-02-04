<?php  
session_start();
@define("DEBUG", true);
@define("LOG_FILE", "ipn_paypal.log");
@define('LIBRARIES','./libraries/');
require_once LIBRARIES."config.php";
require_once LIBRARIES.'autoload.php';
new AutoLoad();
$d = new PDODb($config['database']);
$func = new Functions($d);



// DEBUG: Kích hoạt chế độ gỡ lỗi. Ghi nhận phản hồi vào file 'ipn_paypal.log' trong cùng thư mục (ngoài index)
// Đặc biệt hữu ích nếu bạn gặp lỗi mạng hoặc các sự cố không liên tục khác với IPN (xác thực).
// set DEBUG = false nếu không muốn ghi vào file ipn_paypal.log


// Đọc dữ liệu POST
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);

$myPost = array();
foreach ($raw_post_array as $keyval) {
    $keyval = explode ('=', $keyval);
    if (count($keyval) == 2)
        $myPost[$keyval[0]] = urldecode($keyval[1]);
}

// lấy dữ liệu post từ PayPal và thêm 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
    $get_magic_quotes_exists = true;
}
foreach ($myPost as $key => $value) {
    if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
        $value = urlencode(stripslashes($value));
    } else {
        $value = urlencode($value);
    }
    $req .= "&$key=$value";
}

// Post dữ liệu IPN trở lại PayPal để xác thực dữ liệu IPN là chính hãng (từ PayPal gửi)
// Không có bước này, bất kỳ ai cũng có thể giả mạo dữ liệu IPN
if($config['paypal']['use_sandbox'] == true) {  // link để post dữ liệu
    $paypal_url = "https://ipnpb.sandbox.paypal.com/cgi-bin/webscr";
} else {
    $paypal_url = "https://www.paypal.com/cgi-bin/webscr";
}
$ch = curl_init($paypal_url);
if ($ch == FALSE) {
    return FALSE;
}
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
if(DEBUG == true) {
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
}

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: sole')); // quan trọng: đổi Cypress => company-name
$res = curl_exec($ch);

if (curl_errno($ch) != 0) // cURL error
    {
    if(DEBUG == true) {  // ghi nhận toàn bộ phản hồi vào file ipn_paypal nếu DEBUG = true
        error_log(date('[Y-m-d H:i e] AAAAAAAAAA '). "Không thể kết nối với PayPal để xác thực tin nhắn IPN: " . curl_error($ch) . PHP_EOL, 3, LOG_FILE);
    }
    curl_close($ch);
    exit;
} else {
    // ghi nhận toàn bộ phản hồi vào file ipn_paypal nếu DEBUG = true
    if(DEBUG == true) { 
        error_log(date('[Y-m-d H:i e] BBB'). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req" . PHP_EOL, 3, LOG_FILE);
        error_log(date('[Y-m-d H:i e] BBB'). "HTTP response of validation request: $res" . PHP_EOL, 3, LOG_FILE);
    }
    curl_close($ch);
}
$tokens = explode("\r\n\r\n", trim($res));
$res = trim(end($tokens));

if (strcmp ($res, "VERIFIED") == 0) {
    parse_str($req, $arr_req);
    $item_name = $arr_req['item_name'];
    $arr = explode('#', $item_name);
    $order_code = explode('-', $arr[1]);
    $item_number = $arr_req['item_number'];
    $payment_status = $arr_req['payment_status'];
    $payment_amount = $arr_req['mc_gross'];
    $payment_currency = $arr_req['mc_currency'];
    $txn_id = $arr_req['txn_id'];
    $receiver_email = $arr_req['receiver_email'];
    $payer_email = $arr_req['payer_email'];
    $row=$d->rawQueryOne('select * from table_order where madonhang=?',array(str_replace(' ','',$order_code[0])));
    
    if($row['id']>0 && $row['payment']==1 && $receiver_email==$config['paypal']['receiver_email'] && $payment_amount==$row['tonggia']){
        $rowUser=$d->rawQueryOne("select numpro,id from #_member where id=?",array($row['id_user']));
        $data['id_paypal']=$txn_id;
        $data['payment']=2;
        $data['tinhtrang']=2;
        $d->where('id', $row['id']);
        $d->where('madonhang', $order_code[0]);
        if($d->update('order',$data)){
            if(!empty($row['numfree'])){
                $dataUser['free_start']=time();
                $dataUser['free_end']=time()+(86400*$row['numfree']);
            }
            $dataUser['numpro']=$row['numpro']+$rowUser['numpro'];
            $d->where('id', $rowUser['id']);
            $d->update('member',$dataUser);
        }
    }
    if(!empty(DEBUG)) {
        error_log(date('[Y-m-d H:i e] CCCC'). "Đã xác minh IPN: $madonhang". PHP_EOL, 3, LOG_FILE);
    }
} else if (strcmp ($res, "INVALID") == 0) { 
    if(!empty(DEBUG)) {
        error_log(date('[Y-m-d H:i e] DDD'). "IPN không hợp lệ: $req" . PHP_EOL, 3, LOG_FILE);
    }
}