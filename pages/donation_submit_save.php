<?php 
    require_once '../static/functions/connect.php';
    require_once '../static/functions/function.php';

    if (isset($_POST)) {
        if (file_exists('../file/donation/')) mkdir('../file/donation/');
        $date = $_POST['date'];
        $time = str_replace(":","-", $_POST['time']);
        $name = isset($_POST['name']) ? $_POST['name'] : $_POST['username'];
        $amount = $_POST['amount'];

        if (isset($_FILES['slip']['name']) && $_FILES['slip']['name'] != "") {
            $path = $_FILES['slip']['name'];
            $nam = pathinfo($path, PATHINFO_FILENAME);
            $ext = pathinfo($path, PATHINFO_EXTENSION);

            $name_file = $date."_".$time."_$name.$ext";
            $tmp_name = $_FILES['slip']['tmp_name'];
            if (!move_uploaded_file($tmp_name,"../file/donation/$name_file")) die("อัพไฟล์ไม่ได้ง่า บอกแอดมินที");
        }

        $string = "Name: $name\nAmount: $amount\nTime: $date $time";

        $file = fopen("../file/donation/$date" . "_$time" . "_$name.txt","w");
        if (!fwrite($file,$string)) {
            die("เขียนไฟล์ไม่ได้ง่า บอกแอดมินที");
        } else {
            fclose($file);
            echo "เสร็จเรียบร้อยแล้ว... รอแอดมินมาตรวจนะ~! (สามารถปิดได้เลย)";
        }
    }
    sleep(3);
    echo '<script>setTimeout("window.close()",3000)</script>';
?>