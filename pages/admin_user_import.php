<?php
    require_once '../static/functions/connect.php';
    require_once '../static/functions/function.php';

    if (isset($_FILES['uploadCSV']) && $_FILES['uploadCSV']['name'] != "" && isAdmin()) {
        $file = fopen($_FILES['uploadCSV']['tmp_name'], "r");

        $count = 0;
        $year = 0;
        $sems = 0;
        $match = "";
        $std_list = array();

        while(!feof($file)) {
            $line = fgetcsv($file);
            if (gettype($line) != "boolean") {
                if (preg_match("/[0-9]{9}-[0-9]{1}/", $line[1])) {
                    $count++;
                    array_push($std_list, array("std_id"=>$line[1], "name"=>$line[2], "email"=>$line[3]));
                } else if (preg_match("/[0-9]\/[0-9]{4}/", $line[6], $match)) {
                    $m = explode("/", $match[0]);
                    $sems = $m[0];
                    $year = $m[1];
                }
            }
        }
        fclose($file);

        echo "Year : $year<br>";
        echo "Sems : $sems<br>";
        echo "Total : $count";
        $query = "";
        $error = false;
        for($i = 0; $i < count($std_list); $i++) {
            echo "<pre>";
            print_r($std_list[$i]);
            echo "</pre>";
            $std_id = $std_list[$i]['std_id'];
            $std_id_md5 = md5($std_id);
            $std_name = $std_list[$i]['name'];
            $std_email = $std_list[$i]['email'];
            $query .= "INSERT INTO `user` (`std_id`, `password`, `name`, `email`, `year`, `sems`) SELECT * FROM (SELECT '$std_id', '$std_id_md5', '$std_name', '$std_email', $year, $sems) AS tmp WHERE NOT EXISTS (SELECT `std_id` FROM `user` WHERE `std_id` = '$std_id') LIMIT 1;";

            if ($i%20 == 0 && $i != 0) {
                //Do fast query to save memory.
                if ($conn->multi_query($query)) $query = ""; //Clear query queue
                else {
                    $error = true;
                    break; //Shit, can't query, break it.
                }
            }
        }

        if ($query != "" && !$conn->multi_query($query)) $error = true;

        if ($error) {
            $_SESSION['swal_error'] = "พบข้อผิดพลาด";
            $_SESSION['swal_error_msg'] = "ERROR 40 : ไม่สามารถ Query Database ได้\n$conn->error";
        } else {
            $_SESSION['swal_success'] = "สำเร็จ";
            $_SESSION['swal_success_msg'] = "นำเข้าข้อมูลนักศึกษา $count รายการแล้ว";
        }
    }
    header("Location: ../admin/user");
?>