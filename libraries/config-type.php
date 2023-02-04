<?php
    $nametype = "style";
    $config['product'][$nametype]['title_main'] = "Phong cách";
    $config['product'][$nametype]['option']=true;
    $config['product'][$nametype]['mau_images'] = false;
    $config['product'][$nametype]['mau_gia'] = false;
    $config['product'][$nametype]['mau_properties'] = false;
    $config['product'][$nametype]['mau_loai'] = false;
    $config['product'][$nametype]['width_properties'] = 30;
    $config['product'][$nametype]['height_properties'] = 30;
    $config['product'][$nametype]['thumb_properties'] = '100x100x1';
    $config['product'][$nametype]['img_type_properties'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    $nametype = "render";
    $config['product'][$nametype]['title_main'] = "Kết xuất";
    $config['product'][$nametype]['option']=true;
    $config['product'][$nametype]['mau_images'] = false;
    $config['product'][$nametype]['mau_gia'] = false;
    $config['product'][$nametype]['mau_properties'] = false;
    $config['product'][$nametype]['mau_loai'] = false;
    $config['product'][$nametype]['width_properties'] = 30;
    $config['product'][$nametype]['height_properties'] = 30;
    $config['product'][$nametype]['thumb_properties'] = '100x100x1';
    $config['product'][$nametype]['img_type_properties'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    $nametype = "format";
    $config['product'][$nametype]['title_main'] = "Định dạng";
    $config['product'][$nametype]['option']=true;
    $config['product'][$nametype]['mau_images'] = false;
    $config['product'][$nametype]['mau_gia'] = false;
    $config['product'][$nametype]['mau_properties'] = false;
    $config['product'][$nametype]['mau_loai'] = false;
    $config['product'][$nametype]['width_properties'] = 30;
    $config['product'][$nametype]['height_properties'] = 30;
    $config['product'][$nametype]['thumb_properties'] = '100x100x1';
    $config['product'][$nametype]['img_type_properties'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    $nametype = "form";
    $config['product'][$nametype]['title_main'] = "Hình thức";
    $config['product'][$nametype]['option']=true;
    $config['product'][$nametype]['mau_images'] = true;
    $config['product'][$nametype]['mau_gia'] = false;
    $config['product'][$nametype]['mau_properties'] = false;
    $config['product'][$nametype]['mau_loai'] = false;
    $config['product'][$nametype]['width_properties'] = 30;
    $config['product'][$nametype]['height_properties'] = 30;
    $config['product'][$nametype]['thumb_properties'] = '30x30x1';
    $config['product'][$nametype]['img_type_properties'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.svg|.SVG';

    $nametype = "color";
    $config['product'][$nametype]['title_main'] = "Màu";
    $config['product'][$nametype]['option']=true;
    $config['product'][$nametype]['mau_images'] = false;
    $config['product'][$nametype]['mau_gia'] = false;
    $config['product'][$nametype]['mau_properties'] = true;
    $config['product'][$nametype]['mau_loai'] = false;
    $config['product'][$nametype]['width_properties'] = 30;
    $config['product'][$nametype]['height_properties'] = 30;
    $config['product'][$nametype]['thumb_properties'] = '100x100x1';
    $config['product'][$nametype]['img_type_properties'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    $nametype = "material";
    $config['product'][$nametype]['title_main'] = "Vật liệu";
    $config['product'][$nametype]['option']=true;
    $config['product'][$nametype]['mau_images'] = false;
    $config['product'][$nametype]['mau_gia'] = false;
    $config['product'][$nametype]['mau_properties'] = false;
    $config['product'][$nametype]['mau_loai'] = false;
    $config['product'][$nametype]['width_properties'] = 30;
    $config['product'][$nametype]['height_properties'] = 30;
    $config['product'][$nametype]['thumb_properties'] = '100x100x1';
    $config['product'][$nametype]['img_type_properties'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    /* Sản phẩm */
    $nametype = "san-pham";
    $config['product'][$nametype]['title_main'] = "Sản Phẩm";
    $config['product'][$nametype]['dropdown'] = true;
    $config['product'][$nametype]['list'] = true;
    $config['product'][$nametype]['cat'] = true;
    $config['product'][$nametype]['item'] = false;
    $config['product'][$nametype]['sub'] = false;
    $config['product'][$nametype]['brand'] = false;
    $config['product'][$nametype]['properties'] = true;
    $config['product'][$nametype]['properties_array'] = array('style'=>'Phong cách','render'=>'Kết xuất','format'=>'Định dạng','form'=>'Hình thức','color'=>'Màu sắc','material'=>'Vật liệu');
    $config['product'][$nametype]['size'] = false;
    $config['product'][$nametype]['tags'] = true;
    $config['product'][$nametype]['import'] = false;
    $config['product'][$nametype]['export'] = false;
    $config['product'][$nametype]['view'] = false;
    $config['product'][$nametype]['copy'] = false;
    $config['product'][$nametype]['copy_image'] = false;
    $config['product'][$nametype]['slug'] = true;
    $config['product'][$nametype]['check'] = array("moi" => "Mới",'noibat'=>'Nổi bật');
    $config['product'][$nametype]['images'] = true;
    $config['product'][$nametype]['show_images'] = true;
    $config['product'][$nametype]['show_gallery'] = true;
    $config['product'][$nametype]['gallery'] = array(
        $nametype => array
        (
            "title_main_photo" => "Hình ảnh sản phẩm",
            "title_sub_photo" => "Hình ảnh",
            "number_photo" => 3,
            "images_photo" => true,
            "cart_photo" => true,
            "avatar_photo" => true,
            "tieude_photo" => true,
            "width_photo" => 135*4,
            "height_photo" => 135*4,
            "thumb_photo" => '100x100x1',
            "img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF'
        )
    );
    $config['product'][$nametype]['link'] = false;
    $config['product'][$nametype]['file'] = true;
    $config['product'][$nametype]['ma'] = false;
    $config['product'][$nametype]['tinhtrang'] = true;
    $config['product'][$nametype]['video'] = false;
    $config['product'][$nametype]['gia'] = true;
    $config['product'][$nametype]['giamoi'] = false;
    $config['product'][$nametype]['giakm'] = false;
    $config['product'][$nametype]['mota'] = true;
    $config['product'][$nametype]['mota_cke'] = false;
    $config['product'][$nametype]['noidung'] = true;
    $config['product'][$nametype]['noidung_cke'] = true;
    $config['product'][$nametype]['seo'] = true;
    $config['product'][$nametype]['width'] = 600;
    $config['product'][$nametype]['height'] = 600;
    $config['product'][$nametype]['thumb'] = '600x600x1';
    $config['product'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
    $config['product'][$nametype]['file_type'] = '.fbx|.obj|.zip';

    


    $config['product'][$nametype]['title_main_list'] = "Sản phẩm cấp 1";
    $config['product'][$nametype]['images_list'] = true;
    $config['product'][$nametype]['show_images_list'] = true;
    $config['product'][$nametype]['slug_list'] = false;
    $config['product'][$nametype]['check_list'] = array();
    $config['product'][$nametype]['gallery_list'] = array();
    $config['product'][$nametype]['mota_list'] = false;
    $config['product'][$nametype]['seo_list'] = false;
    $config['product'][$nametype]['width_list'] = 36;
    $config['product'][$nametype]['height_list'] = 36;
    $config['product'][$nametype]['thumb_list'] = '100x100x1';
    $config['product'][$nametype]['img_type_list'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.svg|.SVG';

    /* Sản phẩm (Cat) */
    $config['product'][$nametype]['title_main_cat'] = "Sản phẩm cấp 2";
    $config['product'][$nametype]['images_cat'] = false;
    $config['product'][$nametype]['show_images_cat'] = false;
    $config['product'][$nametype]['slug_cat'] = false;
    $config['product'][$nametype]['check_cat'] = array();
    $config['product'][$nametype]['mota_cat'] = false;
    $config['product'][$nametype]['seo_cat'] = false;
    $config['product'][$nametype]['width_cat'] = 75*4;
    $config['product'][$nametype]['height_cat'] = 50*4;
    $config['product'][$nametype]['thumb_cat'] = '100x100x1';
    $config['product'][$nametype]['img_type_cat'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';


    /* Sản phẩm (Hãng) */
    $config['product'][$nametype]['title_main_brand'] = "Hãng sản phẩm";
    $config['product'][$nametype]['images_brand'] = true;
    $config['product'][$nametype]['show_images_brand'] = true;
    $config['product'][$nametype]['slug_brand'] = true;
    $config['product'][$nametype]['check_brand'] = array("noibat" => "Nổi bật");
    $config['product'][$nametype]['seo_brand'] = true;
    $config['product'][$nametype]['width_brand'] = 67*2;
    $config['product'][$nametype]['height_brand'] = 24*2;
    $config['product'][$nametype]['thumb_brand'] = '134x48x1';
    $config['product'][$nametype]['img_type_brand'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    

    /* Tags Sản phẩm */
    $nametype = "san-pham";
    $config['tags'][$nametype]['title_main'] = "Tags sản phẩm";
    $config['tags'][$nametype]['slug'] = false;
    $config['tags'][$nametype]['images'] = false;
    $config['tags'][$nametype]['show_images'] = false;
    $config['tags'][$nametype]['check'] = array("noibat" => "Nổi bật");
    $config['tags'][$nametype]['seo'] = false;
    $config['tags'][$nametype]['width'] = 75*4;
    $config['tags'][$nametype]['height'] = 50*4;
    $config['tags'][$nametype]['thumb'] = '100x100x1';
    $config['tags'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';


    /* Đăng ký nhận tin */
    $nametype = "dangkynhantin";
    $config['newsletter'][$nametype]['title_main'] = "Đăng ký nhận tin";
    $config['newsletter'][$nametype]['email'] = true;
    $config['newsletter'][$nametype]['guiemail'] = true;
    $config['newsletter'][$nametype]['ten'] = true;
    $config['newsletter'][$nametype]['dienthoai'] = true;
    $config['newsletter'][$nametype]['diachi'] = true;
    $config['newsletter'][$nametype]['chude'] = true;
    $config['newsletter'][$nametype]['noidung'] = true;
    $config['newsletter'][$nametype]['ghichu'] = true;
    $config['newsletter'][$nametype]['tinhtrang'] = array("0"=>"Mới ","1" => "Đã xem", "2" => "Đã liên hệ", "3" => "Đã thông báo");
    $config['newsletter'][$nametype]['showten'] = true;
    $config['newsletter'][$nametype]['showdienthoai'] = true;
    $config['newsletter'][$nametype]['showngaytao'] = true;
    $config['newsletter'][$nametype]['file_type'] = 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS';
   


    /* Hình thức thanh toán */
    $nametype = "hinh-thuc-thanh-toan";
    $config['news'][$nametype]['title_main'] = "Hình thức thanh toán";
    $config['news'][$nametype]['check'] = array();
    $config['news'][$nametype]['mota'] = true;
    $config['news'][$nametype]['width'] = 260*1;
    $config['news'][$nametype]['height'] = 30*1;
    $config['news'][$nametype]['width_icon'] = 30*2;
    $config['news'][$nametype]['height_icon'] = 30*2;
    $config['news'][$nametype]['images'] = true;
    $config['news'][$nametype]['show_images'] = true;
    $config['news'][$nametype]['thumb'] = '100x100x1';
    $config['news'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.svg|.SVG';



    $nametype = "terms-of-use";
    $config['static'][$nametype]['title_main'] = "Điều khoản sử dụng";
    $config['static'][$nametype]['images'] = false;
    $config['static'][$nametype]['link'] = false;
    $config['static'][$nametype]['file'] = false;
    $config['static'][$nametype]['video'] = false;
    $config['static'][$nametype]['tieude'] = false;
    $config['static'][$nametype]['mota'] = false;
    $config['static'][$nametype]['mota_cke'] = false;
    $config['static'][$nametype]['noidung'] = true;
    $config['static'][$nametype]['noidung_cke'] = true;
    $config['static'][$nametype]['seo'] = true;
    $config['static'][$nametype]['width'] = 75*4;
    $config['static'][$nametype]['height'] = 50*4;
    $config['static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
    $config['static'][$nametype]['file_type'] = 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP |PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS';


    $nametype = "3dmodel-license";
    $config['static'][$nametype]['title_main'] = "Giấy phép mô hình 3D";
    $config['static'][$nametype]['images'] = false;
    $config['static'][$nametype]['link'] = false;
    $config['static'][$nametype]['file'] = false;
    $config['static'][$nametype]['video'] = false;
    $config['static'][$nametype]['tieude'] = false;
    $config['static'][$nametype]['mota'] = false;
    $config['static'][$nametype]['mota_cke'] = false;
    $config['static'][$nametype]['noidung'] = true;
    $config['static'][$nametype]['noidung_cke'] = true;
    $config['static'][$nametype]['seo'] = true;
    $config['static'][$nametype]['width'] = 75*4;
    $config['static'][$nametype]['height'] = 50*4;
    $config['static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
    $config['static'][$nametype]['file_type'] = 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP |PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS';


    $nametype = "privacy-policy";
    $config['static'][$nametype]['title_main'] = "Chính sách bảo mật";
    $config['static'][$nametype]['images'] = false;
    $config['static'][$nametype]['link'] = false;
    $config['static'][$nametype]['file'] = false;
    $config['static'][$nametype]['video'] = false;
    $config['static'][$nametype]['tieude'] = false;
    $config['static'][$nametype]['mota'] = false;
    $config['static'][$nametype]['mota_cke'] = false;
    $config['static'][$nametype]['noidung'] = true;
    $config['static'][$nametype]['noidung_cke'] = true;
    $config['static'][$nametype]['seo'] = true;
    $config['static'][$nametype]['width'] = 75*4;
    $config['static'][$nametype]['height'] = 50*4;
    $config['static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
    $config['static'][$nametype]['file_type'] = 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP |PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS';


    /* Liên hệ */
    $nametype = "support";
    $config['static'][$nametype]['title_main'] = "Hỗ trợ";
    $config['static'][$nametype]['images'] = true;
    $config['static'][$nametype]['width'] = 545;
    $config['static'][$nametype]['height'] = 700;
    $config['static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    /* Footer */
    $nametype = "footer";
    $config['static'][$nametype]['title_main'] = "Footer";
    $config['static'][$nametype]['noidung'] = true;
    $config['static'][$nametype]['noidung_cke'] = true;


    $nametype = "helful-infomation";
    $config['static'][$nametype]['title_main'] = "Thông tin hữu ích";
    $config['static'][$nametype]['noidung'] = true;
    $config['static'][$nametype]['noidung_cke'] = true;


    /* Logo */
    $nametype = "logo";
    $config['photo']['photo_static'][$nametype]['title_main'] = "Logo";
    $config['photo']['photo_static'][$nametype]['images'] = true;
    $config['photo']['photo_static'][$nametype]['width'] = 131;
    $config['photo']['photo_static'][$nametype]['height'] = 57;
    $config['photo']['photo_static'][$nametype]['thumb'] = '131x57x1';
    $config['photo']['photo_static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF.svg|.SVG';

    /* Favicon */
    $nametype = "favicon";
    $config['photo']['photo_static'][$nametype]['title_main'] = "Favicon";
    $config['photo']['photo_static'][$nametype]['images'] = true;
    $config['photo']['photo_static'][$nametype]['width'] = 25;
    $config['photo']['photo_static'][$nametype]['height'] = 25;
    $config['photo']['photo_static'][$nametype]['thumb'] = '25x25x1';
    $config['photo']['photo_static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';



    /* Mạng xã hội */
    $nametype = "mangxahoi";
    $config['photo']['man_photo'][$nametype]['title_main_photo'] = "Mạng xã hội";
    $config['photo']['man_photo'][$nametype]['number_photo'] = 3;
    $config['photo']['man_photo'][$nametype]['images_photo'] = true;
    $config['photo']['man_photo'][$nametype]['avatar_photo'] = true;
    $config['photo']['man_photo'][$nametype]['link_photo'] = true;
    $config['photo']['man_photo'][$nametype]['width_photo'] = 40;
    $config['photo']['man_photo'][$nametype]['height_photo'] = 40;
    $config['photo']['man_photo'][$nametype]['thumb_photo'] = '30x30x1';
    $config['photo']['man_photo'][$nametype]['img_type_photo'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.svg|.SVG';


    /* Setting */
    $config['setting']['diachi'] = true;
    $config['setting']['dienthoai'] = true;
    $config['setting']['hotline'] = true;
    $config['setting']['zalo'] = true;
    $config['setting']['oaidzalo'] = true;
    $config['setting']['email'] = true;
    $config['setting']['website'] = true;
    $config['setting']['fanpage'] = true;
    $config['setting']['toado'] = true;
    $config['setting']['toado_iframe'] = true;
    $config['setting']['giafree'] = true;
    $config['setting']['giapro'] = true;
    $config['setting']['sofree'] = true;
    /* Seo page */
    $config['seopage']['page'] = array(
        "trang-chu" => "Home",
        "support" => "Support"
    );
    $config['seopage']['width'] = 75*4;
    $config['seopage']['height'] = 50*4;
    $config['seopage']['thumb'] = '250x250x1';
    $config['seopage']['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    /* Quản lý import */
    $config['import']['images'] = true;
    $config['import']['thumb'] = '100x100x1';
    $config['import']['img_type'] = ".jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF";

    /* Quản lý export */
    $config['export']['category'] = true;

    /* Quản lý tài khoản */
    $config['user']['active'] = true;
    $config['user']['admin'] = false;
    $config['user']['visitor'] = true;

    /* Quản lý phân quyền */
    $config['permission'] = false;

    /* Quản lý địa điểm */
    $config['places']['active'] = false;
    $config['places']['placesship'] = false;

    /* Quản lý giỏ hàng */
    $config['order']['active'] = true;
    $config['order']['search'] = true;
    $config['order']['excel'] = false;
    $config['order']['word'] = false;
    $config['order']['excelall'] = false;
    $config['order']['wordall'] = false;
    $config['order']['thumb'] = '100x100x1';

    /* Quản lý mã ưu đãi */
    $config['coupon'] = false;

    /* Quản lý thông báo đẩy */
    $config['onesignal'] = false;

    /* Quản lý mục (Không cấp) */
    if(count($config['news']))
    {
        foreach ($config['news'] as $key => $value)
        {
            if(isset($value['dropdown']) && $value['dropdown']==false)
            { 
                $config['shownews'] = 1;
                break;
            }
        }
    }
?>