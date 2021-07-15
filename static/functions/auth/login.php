<?php
    require_once '../connect.php';
    require_once '../function.php';

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
                    header("Location: ../../../resetpassword/");
                }
            }
        } else {
            $_SESSION['error'] = ErrorMessage::AUTH_WRONG;
            echo ErrorMessage::AUTH_WRONG;
        }
    }
?>