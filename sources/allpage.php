<?php
    if(!defined('SOURCES')) die("Error");
    
    /* Query allpage */
    $favicon = $d->rawQueryOne("SELECT photo FROM #_photo WHERE hienthi=1 AND type = ? AND act = ? limit 0,1",array('favicon','photo_static'));
    $logo = $d->rawQueryOne("SELECT id, photo FROM #_photo WHERE type = ? AND act = ? limit 0,1",array('logo','photo_static'));
    $social = $d->rawQuery("SELECT ten$lang, photo, link FROM #_photo WHERE type = ? AND hienthi=1 ORDER BY stt,id DESC",array('mangxahoi'));

    $splistmenu = $d->rawQuery("SELECT ten$lang as ten, tenkhongdauvi, tenkhongdauen, id,photo FROM #_product_list WHERE hienthi=1 AND type = ? ORDER BY stt,id DESC",array('san-pham'));

    $footer = $d->rawQueryOne("SELECT ten$lang, noidung$lang FROM #_static WHERE type = ?",array('footer'));
    $cs = $d->rawQuery("SELECT ten$lang, tenkhongdauvi, tenkhongdauen, id, photo FROM #_news WHERE hienthi=1 AND type = ? ORDER BY stt,id DESC",array('chinh-sach'));
    /* Get statistic */
    $counter = $statistic->getCounter();
    $online = $statistic->getOnline();

    /* Đăng ký nhận mail */
    if(isset($_POST['submit-newsletter']))
    {
        $responseCaptcha = $_POST['recaptcha_response_newsletter'];
        $resultCaptcha = $func->checkRecaptcha($responseCaptcha);

        if(($resultCaptcha['score'] >= 0.5 && $resultCaptcha['action'] == 'Newsletter') || $resultCaptcha['test'])
        {
            $data['email'] = htmlspecialchars($_REQUEST['email-newsletter']);
            $data['ngaytao'] = time();
            $data['type'] = 'dangkynhantin';

            if($d->insert('newsletter',$data))
            {
                $func->transfer("Đăng ký nhận tin thành công. Chúng tôi sẽ liên hệ với bạn sớm.",$config_base);
            }
            else
            {
                $func->transfer("Đăng ký nhận tin thất bại. Vui lòng thử lại sau.",$config_base, false);
            }
        }
        else
        {
            $func->transfer("Đăng ký nhận tin thất bại. Vui lòng thử lại sau.",$config_base, false);
        }
    }
?>