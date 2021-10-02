<?php
    require_once '../static/functions/connect.php';
    require_once '../static/functions/function.php';

    if (isset($_POST['id']) && isAdmin()) {
        $id = $_POST['id'];
        if ($stmt = $conn->prepare("DELETE FROM `user` WHERE id = ?")) {
            $stmt->bind_param('i', $id);
            echo ($stmt->execute()) ? "true" : "false ".$conn->error();
        }
    } else {
        echo "false";
    }
?>