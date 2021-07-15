<?php
    require_once '../static/functions/connect.php';
    require_once '../static/functions/function.php';

    $id = "";
    if (isLogin()) {
        if (isset($_POST['problem'])) {
            $isCreate = $_POST['problem'] == "create" ? 1 : 0; //Create(true) or Edit(false)
            $probName = $_POST['name'];
            $probCodename = $_POST['codename'];
            $probAuthor = $_SESSION['user']->getUsername();
            
            $properties = json_encode(array(
                "hide" => (bool) $_POST['hide'],
                "last_hide_updated" => (int) $_POST['last_hide_updated'],
                "rating" => (int) $_POST['rating']
            ));
            
            $id = $isCreate ? latestIncrement($dbdatabase, 'problem') : $_GET['id'];

            if (!$isCreate && !isOwner($id)) {
                $_SESSION['swal_error'] = "ACCESS DENIED";
                $_SESSION['swal_error_msg'] = "You don't have enough permission!";
                header("Location: ../problem/");
            }

            
            if (isset($_FILES['pdfPreview']['name']) && $_FILES['pdfPreview']['name'] != "") {
                $file = glob($locate . $probCodename . "*.pdf");
                foreach($file as $f) unlink($f); //Remove all [testcase].[pdf] in problem directory before upload new
                $name_file = $probCodename . generateRandom(5) . ".pdf";
                $tmp_name = $_FILES['pdfPreview']['tmp_name'];
                $locate ="../file/judge/prob/$id/";
                if (!file_exists($locate))
                    if (!make_directory($locate))
                        die("Can't mkdir");
                
                if (!move_uploaded_file($tmp_name,$locate.$name_file)) die("Can't upload file");
            }

            $probAnswer = $_POST['answer'];
            $file = fopen("../file/judge/prob/$id/answer.txt","w");
            if (!fwrite($file,$probAnswer)) {
                $_SESSION['swal_error'] = "พบข้อผิดพลาด!";
                $_SESSION['swal_error_msg'] = "ไม่สามารถเขียน/อ่านไฟล์ได้";
            } else {
                fclose($file);
            }

            $probNumtol = (float) $_POST['numtol'];
            $file = fopen("../file/judge/prob/$id/numtol.txt","w");
            if (!fwrite($file,$probNumtol)) {
                $_SESSION['swal_error'] = "พบข้อผิดพลาด!";
                $_SESSION['swal_error_msg'] = "ไม่สามารถเขียน/อ่านไฟล์ได้";
            } else {
                fclose($file);
            }

            //INSERT INTO table (id, name, age) VALUES(1, "A", 19) ON DUPLICATE KEY UPDATE name="A", age=19
            print_r(array($probName, $probCodename, $probScore, $probMemory, $probTime, $properties, $probAuthor));
            if ($isCreate) {
                if ($stmt = $conn -> prepare("INSERT INTO `problem` (name, codename, author, properties) VALUES (?,?,?,?)")) {
                    $stmt->bind_param('ssss', $probName, $probCodename, $probAuthor, $properties);
                    if (!$stmt->execute()) {
                        $_SESSION['swal_error'] = "พบข้อผิดพลาด";
                        $_SESSION['swal_error_msg'] = "ERROR 40 : ไม่สามารถ Query Database ได้\n$conn->error";
                        echo $conn->error;
                    } else {
                        $_SESSION['swal_success'] = "สำเร็จ!";
                        $_SESSION['swal_success_msg'] = "เพิ่มโจทย์ $probCodename แล้ว!";
                        echo "Created";
                    }
                } else {
                    $_SESSION['swal_error'] = "พบข้อผิดพลาด";
                    $_SESSION['swal_error_msg'] = "ERROR 40 : ไม่สามารถ Query Database ได้\n$conn->error";
                    echo "Can't establish database";
                }
            } else {
                if ($stmt = $conn -> prepare("UPDATE `problem` SET name=?, codename=?, author=?, properties=? WHERE id = ?")) {
                    $stmt->bind_param('ssssi', $probName, $probCodename, $probAuthor, $properties, $id);
                    if (!$stmt->execute()) {
                        $_SESSION['swal_error'] = "พบข้อผิดพลาด";
                        $_SESSION['swal_error_msg'] = "ERROR 40 : ไม่สามารถ Query Database ได้";
                        die($conn->error);
                    } else {
                        $_SESSION['swal_success'] = "สำเร็จ!";
                        $_SESSION['swal_success_msg'] = "แก้ไขโจทย์ $probCodename แล้ว!";
                        echo "Created";
                    }
                } else {
                    $_SESSION['swal_error'] = "พบข้อผิดพลาด";
                    $_SESSION['swal_error_msg'] = "ERROR 40 : ไม่สามารถ Query Database ได้\n$conn->error";
                    echo "Can't establish database";
                }
            }
        }
    }
    header("Location: ../problem/$id");
?>