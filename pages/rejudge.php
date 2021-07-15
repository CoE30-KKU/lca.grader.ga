<?php
    require_once '../static/functions/connect.php';
    require_once '../static/functions/function.php';
    $problem_id = "";
    if (!isLogin()) {
        header("Location: ../home/");
    } else {
        if (isset($_GET['problem_id']) && isOwner($_GET['problem_id']) && !isset($_GET['method'])) {
            $problem_id = (int) $_GET['problem_id'];
            if ($stmt = $conn -> prepare("UPDATE `submission` SET result='W' WHERE problem = ?")) {
                $stmt->bind_param('i', $problem_id);
                if (!$stmt->execute()) {
                    $_SESSION['swal_error'] = "พบข้อผิดพลาด";
                    $_SESSION['swal_error_msg'] = "ERROR 40 : ไม่สามารถ Query Database ได้";
                } else {
                    $_SESSION['swal_success'] = "สำเร็จ!";
                    $_SESSION['swal_success_msg'] = "Rejudge โจทย์ข้อ #$problem_id แล้ว";
                }
            } else {
                $_SESSION['swal_error'] = "พบข้อผิดพลาด";
                $_SESSION['swal_error_msg'] = "ERROR 40 : ไม่สามารถ Query Database ได้";
            }
            header("Location: ../problem/$problem_id");
        } else if (isset($_GET['method']) && isAdmin()) {
            switch($_GET['method']) {
                case "JudgeError":
                    if ($stmt = $conn -> prepare("UPDATE `submission` SET result='W' WHERE result = 'JudgeError'")) {
                        if (!$stmt->execute()) {
                            $_SESSION['swal_error'] = "พบข้อผิดพลาด";
                            $_SESSION['swal_error_msg'] = "ERROR 40 : ไม่สามารถ Query Database ได้";
                        } else {
                            $_SESSION['swal_success'] = "สำเร็จ!";
                            $_SESSION['swal_success_msg'] = "Rejudge โจทย์ทุกข้อที่ JudgeError แล้ว";
                        }
                    } else {
                        $_SESSION['swal_error'] = "พบข้อผิดพลาด";
                        $_SESSION['swal_error_msg'] = "ERROR 40 : ไม่สามารถ Query Database ได้";
                    }
                    break;
                case "Submission":
                    if (!isset($_GET['id'])) break;
                    $id = (int) $_GET['id'];
                    if ($stmt = $conn -> prepare("UPDATE `submission` SET result='W' WHERE id = ?")) {
                        $stmt->bind_param('i', $id);
                        if (!$stmt->execute()) {
                            $_SESSION['swal_error'] = "พบข้อผิดพลาด";
                            $_SESSION['swal_error_msg'] = "ERROR 40 : ไม่สามารถ Query Database ได้";
                        } else {
                            $_SESSION['swal_success'] = "สำเร็จ!";
                            $_SESSION['swal_success_msg'] = "Rejudge Submission #$id แล้ว";
                        }
                    } else {
                        $_SESSION['swal_error'] = "พบข้อผิดพลาด";
                        $_SESSION['swal_error_msg'] = "ERROR 40 : ไม่สามารถ Query Database ได้";
                    }
                    break;
                case "Problem":
                    if (!isset($_GET['id'])) break;
                    $id = (int) $_GET['id'];
                    if ($stmt = $conn -> prepare("UPDATE `submission` SET result='W' WHERE problem = ?")) {
                        $stmt->bind_param('i', $id);
                        if (!$stmt->execute()) {
                            $_SESSION['swal_error'] = "พบข้อผิดพลาด";
                            $_SESSION['swal_error_msg'] = "ERROR 40 : ไม่สามารถ Query Database ได้";
                        } else {
                            $_SESSION['swal_success'] = "สำเร็จ!";
                            $_SESSION['swal_success_msg'] = "Rejudge โจทย์ข้อ #$problem_id แล้ว";
                        }
                    } else {
                        $_SESSION['swal_error'] = "พบข้อผิดพลาด";
                        $_SESSION['swal_error_msg'] = "ERROR 40 : ไม่สามารถ Query Database ได้";
                    }
                    break;
                default:
                    die("WRONG PARAMETER");
                    break;
            }
            header("Location: ../problem/");
        }
    }
?>