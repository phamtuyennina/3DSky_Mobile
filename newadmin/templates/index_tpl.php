<?php
    $month_get = (isset($_GET['month'])) ? $_GET['month']:'';
    $year_get = (isset($_GET['year'])) ? $_GET['year']:'';
    if($month_get!='' && $year_get!='')
    {
        $time = $year_get.'-'.$month_get.'-1';
        $date = strtotime($time);
    }
    else
    {
        $date = strtotime(date('y-m-d')); 
    }
    $day = date('d', $date);
    $month = date('m', $date);
    $year = date('Y', $date);
    $firstDay = mktime(0,0,0,$month, 1, $year);
    $title = strftime('%B', $firstDay);
    $dayOfWeek = date('D', $firstDay);
    $daysInMonth = cal_days_in_month(0, $month, $year);
    $timestamp = strtotime('next Sunday');
    $weekDays = array();
    for($i=0;$i<7;$i++)
    {
        $weekDays[] = strftime('%a', $timestamp);
        $timestamp = strtotime('+1 day', $timestamp);
    }
    $blank = date('w', strtotime("{$year}-{$month}-01"));
?>
<div class="content-inner container-fluid pb-0" id="page_layout">
    <div>
        <div class="card">
            <div class="p-5">
                <form class="form-filter-charts row align-items-center" action="index.php" method="get" name="form-thongke" accept-charset="utf-8">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="d-flex flex-column">
                            <h3>Thống kê truy cập</h3>
                            <p class="text-primary mb-0">Số người dùng truy cập vào website</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center rounded flex-wrap gap-3">
                            <div class="form-group mb-0">
                                <select class="select2-basic-single js-states form-control" name="month" id="month" style="width: 100%;">
                                    <option value="">Chọn tháng</option>
                                    <?php for($i=1; $i<=12 ;$i++) { ?>
                                        <?php
                                        if($year_get) $selected = ($i==$month_get) ? 'selected':'';
                                        else $selected = ($i==$month_get) ? 'selected':'';
                                        ?>
                                        <option value="<?=$i?>" <?=$selected?>>Tháng <?=$i?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <select class="select2-basic-single js-states form-control" name="year" id="year" style="width: 100%;">
                                    <option value="">Chọn năm</option>
                                    <?php for($i=date('Y');$i>=2000;$i--) { ?>
                                        <?php
                                        if($year_get) $selected = ($i==$year_get) ? 'selected':'';
                                        else $selected = ($i==date('Y')) ? 'selected':'';
                                        ?>
                                        <option value="<?=$i?>" <?=$selected?>>Năm <?=$i?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary hvr-rectangle-out">Thống kê</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card card-block card-stretch card-height">
        <div class="card-body">
            <div id="thongke-line-chart" ></div>
        </div>
    </div>
</div>
<!-- Main content -->
<section class="content mb-3 d-none">
    <div class="container-fluid">
        <h5 class="pt-3 pb-2">Dashboard</h5>
        <div class="row mb-2 text-sm">
            <div class="col-12 col-sm-6 col-md-3">
                <a class="my-info-box info-box" href="index.php?com=setting&act=capnhat" title="Cấu hình website">
                    <span class="my-info-box-icon info-box-icon bg-primary"><i class="fas fa-cogs"></i></span>
                    <div class="info-box-content text-dark">
                        <span class="info-box-text text-capitalize">Cấu hình website</span>
                        <span class="info-box-number">View more</span>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <a class="my-info-box info-box" href="index.php?com=user&act=admin_edit" title="Tài khoản">
                    <span class="my-info-box-icon info-box-icon bg-danger"><i class="fas fa-user-cog"></i></span>
                    <div class="info-box-content text-dark">
                        <span class="info-box-text text-capitalize">Tài khoản</span>
                        <span class="info-box-number">View more</span>
                    </div>
                </a>
            </div>
            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3">
                <a class="my-info-box info-box" href="index.php?com=user&act=admin_edit&changepass=1" title="Đổi mật khẩu">
                    <span class="my-info-box-icon info-box-icon bg-success"><i class="fas fa-key"></i></span>
                    <div class="info-box-content text-dark">
                        <span class="info-box-text text-capitalize">Đổi mật khẩu</span>
                        <span class="info-box-number">View more</span>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <a class="my-info-box info-box" href="index.php?com=contact&act=man" title="Thư liên hệ">
                    <span class="my-info-box-icon info-box-icon bg-info"><i class="fas fa-address-book"></i></span>
                    <div class="info-box-content text-dark">
                        <span class="info-box-text text-capitalize">Thư liên hệ</span>
                        <span class="info-box-number">View more</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="content pb-4 d-none">
   <div class="container-fluid">
       <div class="card">
           <div class="card-header">
               <h5 class="mb-0">Thống kê truy cập tháng <?=$month?>/<?=$year?></h5>
           </div>
           <div class="card-body">
            <form class="form-filter-charts row align-items-center mb-1" action="index.php" method="get" name="form-thongke" accept-charset="utf-8">
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="form-control select2" name="month" id="month">
                            <option>Chọn tháng</option>
                            <?php for($i=1; $i<=12 ;$i++) { ?>
                                <?php
                                if($year_get) $selected = ($i==$month_get) ? 'selected':'';
                                else $selected = ($i==date('m')) ? 'selected':'';
                                ?>
                                <option value="<?=$i?>" <?=$selected?>>Tháng <?=$i?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="form-control select2" name="year" id="year">
                            <option>Chọn năm</option>
                            <?php for($i=2000;$i<=date(Y)+20;$i++) { ?>
                                <?php
                                if($year_get) $selected = ($i==$year_get) ? 'selected':'';
                                else $selected = ($i==date('Y')) ? 'selected':'';
                                ?>
                                <option value="<?=$i?>" <?=$selected?>>Năm <?=$i?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><button type="submit" class="btn btn-success">Thống Kê</button></div>
                </div>
            </form>
               <div id="apexMixedChart"></div>
           </div>
       </div>
   </div>
</section>


<script type="text/javascript">
    var series_thongke = [{
        name: 'Thống kê truy cập tháng <?=$month?>',
        data: [
            <?php for($i = 1; $i <= $daysInMonth; $i++) {
                $k = $i+1;
                $begin = strtotime($year.'-'.$month.'-'.$i);
                $end = strtotime($year.'-'.$month.'-'.$k);
                $todayrc = $d->rawQueryOne("SELECT COUNT(*) AS todayrecord FROM #_counter WHERE tm >= ? and tm < ?",array($begin,$end));
                $today_visitors = $todayrc['todayrecord']; ?>
                <?=$today_visitors?>,
            <?php } ?>
        ]
    }];
    var xaxis_categories=[
        <?php for($i = 1; $i <= $daysInMonth; $i++) {
            $k = $i+1;
            $begin = strtotime($year.'-'.$month.'-'.$i);
            $end = strtotime($year.'-'.$month.'-'.$k);
            $todayrc = $d->rawQueryOne("SELECT COUNT(*) AS todayrecord FROM #_counter WHERE tm >= ? and tm < ?",array($begin,$end));
            $today_visitors = $todayrc['todayrecord']; ?>
            'Ngày <?=$i?>',
        <?php } ?>
    ];
</script>
