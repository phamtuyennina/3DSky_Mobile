<div class="wrap-dangky">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-sm-9 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
                        <div class="auth-form d-flex flex-column align-items-center">
                            <h2 class="main-header mb-4">Sign up</h2>
                            <form method="post" action="account/sign-up" enctype="multipart/form-data" >
                                <div class="form-group">
                                    <div class="form-floating">
                                        <input id="inputLogin" name="username" type="text" autocomplete="off" required="required" class="form-control ng-touched ng-dirty ng-valid" placeholder="Enter username">
                                        <label for="inputLogin">Enter username</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-floating">
                                        <input id="inputEmail" name="email" type="email" required="required" class="form-control ng-untouched ng-pristine ng-invalid" placeholder="Enter email">
                                        <label for="inputEmail">Enter email</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-floating">
                                        <input id="inputPassword"  name="password" required="required" type="password" autocomplete="new-password" class="form-control ng-untouched ng-pristine ng-invalid" placeholder="Enter password">
                                        <label for="inputPassword">Enter password</label>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <div class="form-floating">
                                        <input id="inputRePassword"  name="rePassword" required="required" type="password" autocomplete="new-password" class="form-control ng-untouched ng-pristine ng-invalid" placeholder="Enter password again">
                                        <label for="inputRePassword">Enter password again</label>
                                    </div>
                                </div>
                                <div class="sky-form-agreement">By clicking "Sign Up" you agree to <a href="terms-of-use" target="_blank">The Terms of Use for Customers</a> and agree to <a href="privacy-policy" target="_blank">The Privacy policy</a></div>
                                <div class="mt-4" style="text-align: center;">
                                    <button type="submit" name="dangky" value="ok" class="sky-btn sky-btn-std" > Sign Up </button>
                                    <div class="sky-form-small-text mt-3"><a href="account/login">Sign In</a></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
