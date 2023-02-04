<body class="light theme-default theme-color-default theme-with-animation card-default">
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader animate__animated animate__fadeOut d-none">
          <div class="loader-body">
              <img src="assets/images/loader.webp" alt="loader" class="light-loader img-fluid w-25" width="200" height="200">
          </div>
      </div>
    </div>
    <!-- loader END -->
    <div class="wrapper">
    <section class="iq-auth-page" style="background: url(assets/images/dashboard/top-image.jpg); background-size: cover;background-repeat: no-repeat;">
        <div class="row d-flex align-items-center justify-content-center vh-100 w-100 m-0 p-0">
            <div class="col-md-4 col-xl-4">
                <div class="card p-4">
                    <div class="card-body ">
                        <h3 class="text-center">ĐĂNG NHẬP HỆ THỐNG</h3>
                        <p class="text-center">Đăng nhập để sử dụng trang quản trị</p>
                        <div class="form-group">
                            <label class="form-label" for="username">Tên đăng nhập</label>
                            <input type="text" required class="form-control mb-0" id="username" placeholder="Nhập tên đăng nhập">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password">Mật khẩu</label>
                            <div class="input-group">
                                <input type="password" required class="form-control mb-0" id="password" placeholder="Nhập mật khẩu">
                                <span class="input-group-text show-password"><span class="fas fa-eye cursor"></span></span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check d-inline-block pt-1 mb-0">
                                <input type="checkbox" class="form-check-input" id="customCheck11">
                                <label class="form-check-label" for="customCheck11">Ghi nhớ tài khoản</label>
                            </div>
                        </div>
                        <div class="text-center pb-3">
                            <button type="button" class="btn btn-primary btn-login" >Đăng Nhập <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                        </div>
                        <div class="mb-0 alert alert-left alert-login alert-dismissible show d-none" role="alert">
                            <span> This is a success alert—check it out!</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
    <?php include TEMPLATE.LAYOUT."style.php";?>
    <svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;"><defs id="SvgjsDefs1002"></defs><polyline id="SvgjsPolyline1003" points="0,0"></polyline><path id="SvgjsPath1004" d="M0 0 "></path></svg></body>



<script type="text/javascript">
    function login()
    {
        var username = $("#username").val();
        var password = $("#password").val();

        if($(".alert-login").hasClass("alert-danger") || $(".alert-login").hasClass("alert-success"))
        {
            $(".alert-login").removeClass("alert-danger alert-success");
            $(".alert-login").addClass("d-none");
            $(".alert-login span").html("");
        }
        if($(".show-password").hasClass("active"))
        {
            $(".show-password").removeClass("active");
            $("#password").attr("type","password");
            $(".show-password").find("span").toggleClass("fas fa-eye fas fa-eye-slash");
        }
        $(".show-password").addClass("disabled");
        $("#username").attr("disabled",true);
        $("#password").attr("disabled",true);

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'ajax/ajax_login.php',
            async: false,
            data: {username:username,password:password},
            success: function(result)
            {
                if(result.success)
                {
                    setTimeout(function(){
                        window.location = "index.php";
                    },1000);
                }
                else if(result.error)
                {
                    $(".alert-login").removeClass("d-none");
                    $(".show-password").removeClass("disabled");
                    $("#username").attr("disabled",false);
                    $("#password").attr("disabled",false);
                    $(".alert-login").removeClass("alert-success").addClass("alert-danger");
                    $(".alert-login span").html(result.error);
                    $(".btn-login").prop('disabled', false);
                }
            }
        });
    }
    $(document).ready(function(){
         $("#username, #password").focus(function(event) {
             $(".alert-login").addClass("d-none");
         });
        $("#username, #password").keypress(function(event){
            if(event.keyCode == 13 || event.which == 13) {
                $(".btn-login").prop('disabled', true);
                login();
            }
        })
        $(".btn-login").click(function(){
            $(this).prop('disabled', true);
            login();
        })
        $(".show-password").click(function(){
            if($(this).hasClass("active"))
            {
                $(this).removeClass("active");
                $("#password").attr("type","password");
            }
            else
            {
                $(this).addClass("active");
                $("#password").attr("type","text");
            }
            $(this).find("span").toggleClass("fas fa-eye fas fa-eye-slash");
        })
    })
</script>