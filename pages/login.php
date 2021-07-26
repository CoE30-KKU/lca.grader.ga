<?php if (isLogin()) header("Location: ../"); ?>
<div class="container" id="container" style="padding-top: 88px">
    <div class="center">
    <h1 class="display-5 font-weight-bold text-center text-coekku">LOGIN <i class="fas fa-sign-in-alt"></i></h1>
    <div class="alert alert-info" role="alert">สำหรับผู้ที่เข้ามาครั้งแรก <br>Email คือ <text class="font-weight-bold">KKUMail ของนักศึกษา</text><br>รหัสผ่าน คือ <text class="font-weight-bold">รหัสประจำตัวนักศึกษา<u>มีขีด</u></text></div>
    <form id="loginForm" method="post" action="../static/functions/auth/login.php" enctype="multipart/form-data">
        <div class="card z-depth-1">
            <!--Body-->
            <div class="card-body">
                <?php if (isset($_SESSION['error'])) {echo '<div class="alert alert-danger" role="alert">'. $_SESSION['error'] .'</div>'; $_SESSION['error'] = null;} ?>
                <div class="md-form form-sm mb-5">
                    <i class="fas fa-user prefix text-coekku"></i>
                    <input type="text" name="login_username" id="login_username"
                        class="form-control form-control-sm validate" required>
                    <label for="login_username">Email</label>
                </div>
                <div class="md-form form-sm mb-4">
                    <i class="fas fa-lock prefix text-coekku"></i>
                    <input type="password" name="login_password" id="login_password"
                        class="form-control form-control-sm validate" required>
                    <label for="login_password">Password</label>
                </div>
                <div class="h-captcha" data-sitekey="d9826c31-b8d7-4648-b04f-c5595ffb8c22"></div>
                <button type="submit" class="btn btn-block btn-coekku mb-3">Login</button>
                <input type="hidden" name="method" value="loginPage">
                <div class=" text-center"><a href="../forgetpassword/" class="text-danger">ลืมรหัสผ่าน</a></div>
                <input type="hidden" name="referent" value="<?php $referent = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null; echo $referent;?>">
            </div>
        </div>
    </form>
    <div class="alert alert-warning mt-3 blink" role="alert">บัญชีที่ใช้งานไม่ได้ใช้ร่วมกับ grader.ga</div>
    </div>
</div>
<script>
    document.querySelector("#loginForm").addEventListener("submit", function(event) {
        var hcaptchaVal = document.querySelector('[name="h-captcha-response"]').value;
        if (hcaptchaVal === "") {
            event.preventDefault();
            swal("Oops","Please complete captcha!", "error");
        }
    });
</script>