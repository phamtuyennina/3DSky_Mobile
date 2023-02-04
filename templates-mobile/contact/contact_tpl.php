<div class="wrap-support py-5">
    <div class="container">
        <div class="row !-mx-[15px]">
            <div class="col-12 col-lg-12">
                <div class="form-support">
                    <div class="text-support">
                        <h2 class="text-clolor inline-block">You Need Support?</h2>
                        <p>Leave your information below. We will contact you as soon as possible.</p>
                    </div>
                    <form class="w-full" method="post" action="support" enctype="multipart/form-data">
                        <div class="input-contact mb-xl-3">
                            <input type="text" class="form-control" id="ten" name="ten" placeholder="Name *" required />
                            <span></span>
                        </div>
                        <div class="input-contact mb-xl-3">
                            <input type="number" class="form-control" id="dienthoai" name="dienthoai" placeholder="Phone *" required />
                            <span></span>
                        </div>
                         <div class="input-contact mb-xl-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email *" required />
                            <span></span>
                        </div>         
                        <div class="input-contact mb-xl-3">
                            <textarea class="form-control" id="noidung" name="noidung" placeholder="Messege" required /></textarea>
                            <span></span>
                        </div>
                        <button type="submit" name="submit-contact" value="ok"><span>Send</span></button>
                        <input type="hidden" name="recaptcha_response_contact" id="recaptchaResponseContact">
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
