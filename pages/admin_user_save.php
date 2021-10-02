<?php
    require_once '../static/functions/connect.php';
    require_once '../static/functions/function.php';
    
    if(isset($_POST)) {
        $name = $_POST['name'];
        $std_id = $_POST['std_id'];
        $id = $_POST['id'];
        $email = $_POST['email']; 
        $role = $_POST['role'];
        $year = $_POST['year'];
        $sems = $_POST['sems'];

        $properties = array();
        if ($stmt = $conn->prepare("SELECT `properties` FROM `user` WHERE id = ? LIMIT 1;")) {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                while ($row = $result->fetch_assoc()) {
                    $properties = json_decode($row['properties'], true);
                }
            }
        }

        $properties['admin'] = (int) $role;
        $properties = json_encode($properties);
        if ($stmt = $conn->prepare("UPDATE `user` SET `name` = ?, `std_id` = ?, `email` = ?, `year` = ?, `sems` = ?, properties = ? WHERE id = ?")) {
            $stmt->bind_param('sssiisi', $name, $std_id, $email, $year, $sems, $properties, $id);
            if ($stmt->execute()) {
                $stmt->free_result();
                $stmt->close();  
                echo "true";
            } else {
                $stmt->free_result();
                $stmt->close();  
                echo "false | " . $conn->error;
            }
        }
    }
?>