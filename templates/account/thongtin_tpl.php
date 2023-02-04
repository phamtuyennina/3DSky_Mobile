<section class="page-account py-5">
    <div class="container">
        <div class="row row-account">
            <div class="col-3 col-lg-3 col-account col-left-account">
                <div class="bgBg">
                    <?php include TEMPLATE.LAYOUT."left-account.php" ?>
                </div>
            </div>
            <div class="col-9 col-lg-9 col-account col-right-account">
                <form id="m-edit-account" method="POST" action="account/profile">
                    <div class="bgBg">
                        <div class="ttile-account">
                            <h2>Personal information</h2>
                        </div>
                        <div class="info mb-5">
                            <div class="form">
                                <div class="form-group">
                                    <div class="form-floating">
                                        <input value="<?=$rowUser['username']?>" type="text" autocomplete="off" disabled required="required" class="form-control ng-touched ng-dirty ng-valid" placeholder="Username">
                                        <label for="inputLogin">Username</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-floating">
                                        <input value="<?=$rowUser['email']?>" type="text" autocomplete="off" disabled required="required" class="form-control ng-touched ng-dirty ng-valid" placeholder="Email">
                                        <label for="inputLogin">Email</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-floating">
                                        <input value="<?=$rowUser['ten']?>" type="text" autocomplete="off" name="data[ten]" required="required" class="form-control ng-touched ng-dirty ng-valid" placeholder="First and last name">
                                        <label for="inputLogin">First and last name</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-floating">
                                        <input value="<?=$rowUser['dienthoai']?>" type="text" autocomplete="off" name="data[dienthoai]" required="required" class="form-control ng-touched ng-dirty ng-valid" placeholder="Phone Number">
                                        <label for="inputLogin">Phone Number</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-floating">
                                        <input value="<?=$rowUser['diachi']?>" type="text" autocomplete="off" name="data[diachi]" required="required" class="form-control ng-touched ng-dirty ng-valid" placeholder="Address">
                                        <label for="inputLogin">Address</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ttile-account">
                            <h2>change password</h2>
                        </div>
                        <div class="info">
                            <div class="form">
                                <div class="form-group">
                                    <div class="form-floating">
                                        <input id="inputPassword" name="old-password" type="password" autocomplete="old-password" class="form-control ng-untouched ng-pristine ng-invalid" placeholder="Enter password">
                                        <label for="inputPassword">Enter password</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-floating">
                                        <input id="inputPassword"  name="password" type="password" autocomplete="new-password" class="form-control ng-untouched ng-pristine ng-invalid" placeholder="Enter new password">
                                        <label for="inputPassword">Enter new password</label>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <div class="form-floating">
                                        <input id="inputRePassword"  name="rePassword" type="password" autocomplete="new-password" class="form-control ng-untouched ng-pristine ng-invalid" placeholder="Enter new password again">
                                        <label for="inputRePassword">Enter new password again</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="button-user" value="yes" name="capnhatthongtin"><span>Save change</span></button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
