<?php
    $countNotify = 0;
    $contactNotify = $d->rawQuery("SELECT id FROM#contact WHERE hienthi=0");

    $countNotify += count($contactNotify);
    if(isset($config['newsletter']) && count($config['newsletter'])>0)
    {
        foreach($config['newsletter'] as $k => $v) 
        {
            $emailNotify = $d->rawQuery("SELECT id FROM #_newsletter WHERE hienthi=0 AND type = ?",array($k));
            $countNotify += count($emailNotify);
        }
    }

    if($config['order']['active'])
    {
        $orderNotify = $d->rawQuery("SELECT id FROM #_order WHERE tinhtrang=1");
    }
?>
<nav class="nav navbar navbar-expand-xl navbar-light iq-navbar">
    <div class="container-fluid navbar-inner">
        <a href="index.php" class="navbar-brand">
        <!--Logo start-->
            <div class="logo-main">
                <div class="logo-normal">
                    <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"></rect>
                        <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"></rect>
                        <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"></rect>
                        <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"></rect>
                    </svg>
                </div>
                <div class="logo-mini">
                    <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"></rect>
                        <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"></rect>
                        <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"></rect>
                        <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"></rect>
                    </svg>
                </div>
            </div>
            <!--logo End-->         
            <h4 class="logo-title d-block d-xl-none" data-setting="app_name">Hope UI</h4>
        </a>
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
            <i class="icon d-flex">
                <svg class="icon-20" width="20" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>
                </svg>
            </i>
        </div>
        <div class="d-flex align-items-center justify-content-between product-offcanvas">
            <div class="breadcrumb-title me-3 pe-3 d-none d-xl-block">
                <small class="mb-0 text-capitalize">Xin chào, <?=$_SESSION[$login_admin]['username']?>!</small>
            </div>
            <div class="offcanvas offcanvas-end shadow-none iq-product-menu-responsive" tabindex="-1" id="offcanvasBottom">
                
            </div>
        </div>
        <div class="d-flex align-items-center">
            <button id="navbar-toggle" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                <span class="navbar-toggler-bar bar1 mt-1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">
                <?php if($config['order']['active']){?>
                <li class="nav-item">
                    <a href="index.php?com=order&act=man" class="nav-link ps-3" id="notification-drop" >
                        <div class="btn btn-primary btn-icon btn-sm rounded-pill btn-action">
                            <span class="btn-inner">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                   <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M5.91064 20.5886C5.91064 19.7486 6.59064 19.0686 7.43064 19.0686C8.26064 19.0686 8.94064 19.7486 8.94064 20.5886C8.94064 21.4186 8.26064 22.0986 7.43064 22.0986C6.59064 22.0986 5.91064 21.4186 5.91064 20.5886ZM17.1606 20.5886C17.1606 19.7486 17.8406 19.0686 18.6806 19.0686C19.5106 19.0686 20.1906 19.7486 20.1906 20.5886C20.1906 21.4186 19.5106 22.0986 18.6806 22.0986C17.8406 22.0986 17.1606 21.4186 17.1606 20.5886Z" fill="currentColor"></path>
                                   <path fill-rule="evenodd" clip-rule="evenodd" d="M20.1907 6.34909C20.8007 6.34909 21.2007 6.55909 21.6007 7.01909C22.0007 7.47909 22.0707 8.13909 21.9807 8.73809L21.0307 15.2981C20.8507 16.5591 19.7707 17.4881 18.5007 17.4881H7.59074C6.26074 17.4881 5.16074 16.4681 5.05074 15.1491L4.13074 4.24809L2.62074 3.98809C2.22074 3.91809 1.94074 3.52809 2.01074 3.12809C2.08074 2.71809 2.47074 2.44809 2.88074 2.50809L5.26574 2.86809C5.60574 2.92909 5.85574 3.20809 5.88574 3.54809L6.07574 5.78809C6.10574 6.10909 6.36574 6.34909 6.68574 6.34909H20.1907ZM14.1307 11.5481H16.9007C17.3207 11.5481 17.6507 11.2081 17.6507 10.7981C17.6507 10.3781 17.3207 10.0481 16.9007 10.0481H14.1307C13.7107 10.0481 13.3807 10.3781 13.3807 10.7981C13.3807 11.2081 13.7107 11.5481 14.1307 11.5481Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?=count($orderNotify)?></span>
                        </div>
                    </a>
                </li>
                <?php }?>
                <li class="nav-item dropdown" id="itemdropdown1">
                    <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <div class="btn btn-primary btn-icon btn-sm rounded-pill">
                         <span class="btn-inner">
                            <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                               <path d="M11.997 15.1746C7.684 15.1746 4 15.8546 4 18.5746C4 21.2956 7.661 21.9996 11.997 21.9996C16.31 21.9996 19.994 21.3206 19.994 18.5996C19.994 15.8786 16.334 15.1746 11.997 15.1746Z" fill="currentColor"></path>
                               <path opacity="0.4" d="M11.9971 12.5838C14.9351 12.5838 17.2891 10.2288 17.2891 7.29176C17.2891 4.35476 14.9351 1.99976 11.9971 1.99976C9.06008 1.99976 6.70508 4.35476 6.70508 7.29176C6.70508 10.2288 9.06008 12.5838 11.9971 12.5838Z" fill="currentColor"></path>
                            </svg>
                         </span>
                      </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="index.php?com=user&act=admin_edit">Thông tin admin</a></li>
                        <li><a class="dropdown-item" href="index.php?com=user&act=admin_edit&changepass=1">Đổi mật khẩu</a></li>
                        <li><a class="dropdown-item" href="index.php?com=user&act=logout">Đăng xuất</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown" id="itemdropdown2">
                    <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="btn btn-primary btn-icon btn-sm rounded-pill">
                            <span class="btn-inner">
                                <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.7695 11.6453C19.039 10.7923 18.7071 10.0531 18.7071 8.79716V8.37013C18.7071 6.73354 18.3304 5.67907 17.5115 4.62459C16.2493 2.98699 14.1244 2 12.0442 2H11.9558C9.91935 2 7.86106 2.94167 6.577 4.5128C5.71333 5.58842 5.29293 6.68822 5.29293 8.37013V8.79716C5.29293 10.0531 4.98284 10.7923 4.23049 11.6453C3.67691 12.2738 3.5 13.0815 3.5 13.9557C3.5 14.8309 3.78723 15.6598 4.36367 16.3336C5.11602 17.1413 6.17846 17.6569 7.26375 17.7466C8.83505 17.9258 10.4063 17.9933 12.0005 17.9933C13.5937 17.9933 15.165 17.8805 16.7372 17.7466C17.8215 17.6569 18.884 17.1413 19.6363 16.3336C20.2118 15.6598 20.5 14.8309 20.5 13.9557C20.5 13.0815 20.3231 12.2738 19.7695 11.6453Z" fill="currentColor"></path>
                                    <path opacity="0.4" d="M14.0088 19.2283C13.5088 19.1215 10.4627 19.1215 9.96275 19.2283C9.53539 19.327 9.07324 19.5566 9.07324 20.0602C9.09809 20.5406 9.37935 20.9646 9.76895 21.2335L9.76795 21.2345C10.2718 21.6273 10.8632 21.877 11.4824 21.9667C11.8123 22.012 12.1482 22.01 12.4901 21.9667C13.1083 21.877 13.6997 21.6273 14.2036 21.2345L14.2026 21.2335C14.5922 20.9646 14.8734 20.5406 14.8983 20.0602C14.8983 19.5566 14.4361 19.327 14.0088 19.2283Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?=$countNotify?></span>
                       </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown1">
                        <li>
                            <a href="index.php?com=contact&act=man" class="dropdown-item d-flex align-items-center justify-content-between">Liên hệ <span class="badge bg-danger rounded-circle ml-1"><?=count($contactNotify)?></span></a>
                        </li>
                        <?php if(isset($config['newsletter']) && count($config['newsletter'])>0) { $emailNotify = $d->rawQuery("SELECT id FROM #_newsletter WHERE hienthi=0 AND type = ?",array($k)); ?>
                        <?php foreach($config['newsletter'] as $k => $v) {?>
                        <li>
                            <a href="index.php?com=newsletter&act=man&type=<?=$k?>" class="dropdown-item d-flex align-items-center justify-content-between"><?=$v['title_main']?> <span class="badge bg-danger rounded-circle ms-2"><?=count($emailNotify)?></span></a>
                        </li>
                        <?php }?>
                        <?php }?>
                    </ul>
                </li>
                <li class="nav-item iq-full-screen d-none d-xl-block" id="fullscreen-item">
                    <a href="#" class="nav-link" id="btnFullscreen" data-bs-toggle="dropdown">
                       <div class="btn btn-primary btn-icon btn-sm rounded-pill">
                            <span class="btn-inner">
                                <svg class="normal-screen icon-24" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                   <path d="M18.5528 5.99656L13.8595 10.8961" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                   <path d="M14.8016 5.97618L18.5524 5.99629L18.5176 9.96906" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                   <path d="M5.8574 18.896L10.5507 13.9964" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                   <path d="M9.60852 18.9164L5.85775 18.8963L5.89258 14.9235" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <svg class="full-normal-screen d-none icon-24" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                   <path d="M13.7542 10.1932L18.1867 5.79319" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                   <path d="M17.2976 10.212L13.7547 10.1934L13.7871 6.62518" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                   <path d="M10.4224 13.5726L5.82149 18.1398" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                   <path d="M6.74391 13.5535L10.4209 13.5723L10.3867 17.2755" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                       </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Nav Header Component Start -->
<div class="iq-navbar-header" style="height: 215px;">
    <div class="container-fluid iq-container">
        <div class="row">
            <div class="col-md-12">
                <div class="flex-wrap d-flex justify-content-between align-items-center">
                    <div>
                        <h1>Quản Trị Website</h1>
                        <p><span id="gio">00</span>:<span id="phut">00</span>:<span id="giay">00</span> - <?=$func->make_Onedate(time())?>, ngày <?=date('d',time())?> tháng <?=(date('m',time()))?> năm <?=(date('Y',time()))?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="iq-header-img">
        <img src="assets/images/dashboard/top-header.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX" loading="lazy">
        <img src="assets/images/dashboard/top-header1.png" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX" loading="lazy">
        <img src="assets/images/dashboard/top-header2.png" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX" loading="lazy">
        <img src="assets/images/dashboard/top-header3.png" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX" loading="lazy">
        <img src="assets/images/dashboard/top-header4.png" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX" loading="lazy">
        <img src="assets/images/dashboard/top-header5.png" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX" loading="lazy">
    </div>
</div> 
<script>
    function Dong_ho() {
        var gio = document.getElementById("gio");
        var phut = document.getElementById("phut");
        var giay = document.getElementById("giay");
        var Gio_hien_tai = new Date().getHours();
        var Phut_hien_tai = new Date().getMinutes();
        var Giay_hien_tai = new Date().getSeconds();
        gio.innerHTML = (Gio_hien_tai<10)?('0'+Gio_hien_tai):Gio_hien_tai;
        phut.innerHTML = (Phut_hien_tai<10)?('0'+Phut_hien_tai):Phut_hien_tai;
        giay.innerHTML = (Giay_hien_tai<10)?('0'+Giay_hien_tai):Giay_hien_tai;
     }
    var Dem_gio = setInterval(Dong_ho, 1000);
</script>