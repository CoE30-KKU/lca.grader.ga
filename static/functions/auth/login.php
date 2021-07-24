<?php
    require_once '../connect.php';
    require_once '../function.php';

    $data = array(
        'secret' => "0xE838c11950365625476E7a2d3fD0353F1bd467f0",
        'response' => $_POST['h-captcha-response']
    );

    $verify = curl_init();
    curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
    curl_setopt($verify, CURLOPT_POST, true);
    curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($verify);
    // var_dump($response);

    $responseData = json_decode($response);
    if ($responseData->success) {
        //Only accept validated captcha.

        if (isset($_POST['method']) && $_POST['method'] == 'loginPage') {
            $user = $_POST['login_username'];
            $pass = md5($_POST['login_password']);

            //ดึงข้อมูลมาเช็คว่า $User ที่ตั้งรหัสผ่านเป็น $Pass มีในระบบรึเปล่า
            $login = login($user, $pass);
            if (!empty($login)) {
                $_SESSION['user'] = $login;
                $_SESSION['swal_success'] = "เข้าสู่ระบบสำเร็จ";
                $_SESSION['swal_success_msg'] = "ยินดีต้อนรับ! " . $_SESSION['user']->getName();
            
                if (isset($_POST['method'])) {
                    if ($_POST['method'] == "loginPage") header("Location: ../../../home/");
                    else if ($_POST['method'] == "loginNav") back();
                    else header("Location: ../../../home/");
                } else {
                    back();
                }
            } else {
                $_SESSION['error'] = ErrorMessage::AUTH_WRONG;
                header("Location: ../../../login/");
            }
        }

        if (isset($_GET['user']) && isset($_GET['pass'])) {
            $user = $_GET['user'];
            $pass = md5($_GET['pass']);
            if (isset($_GET['method']) && $_GET['method'] == "reset")
                $pass = $_GET['pass'];
        
            //ดึงข้อมูลมาเช็คว่า $User ที่ตั้งรหัสผ่านเป็น $Pass มีในระบบรึเปล่า
            $login = login($user, $pass);
            if (!empty($login)) {
                $_SESSION['user'] = $login;
                echo "ACCEPT";
                if (isset($_GET['method'])) {
                    if ($_GET['method'] == "reset") {
                        $_SESSION['allowAccessResetpasswordPage'] = true;
                        header("Location: ../../../resetpassword/");
                    }
                }
            } else {
                $_SESSION['error'] = ErrorMessage::AUTH_WRONG;
                echo ErrorMessage::AUTH_WRONG;
            }
        }
    }
?>