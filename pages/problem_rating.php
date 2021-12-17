<?php
    require_once '../static/functions/connect.php';
    require_once '../static/functions/function.php';
    if (isset($_POST['problemID']) && isset($_POST['userID']) && isset($_POST['rate'])) {
        $newRate = (int) $_POST['rate'];
        $uid = (int) $_POST['userID'];
        $id = (int) $_POST['problemID'];
        $rating = array();
        $ratingCalculated = 0.00;
        if ($stmt = $conn -> prepare("SELECT `rating`,`ratingCalculated` FROM `problem` WHERE id = ?")) {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                while ($row = $result->fetch_assoc()) {
                    $ratingCalculated = (float) $row['ratingCalculated'];
                    $rating = json_decode($row['rating'],true);
                }
            }
        }

        if (!empty($rating) && isLogin() && array_key_exists($uid, $rating)) {
            echo number_format((float) $ratingCalculated, 2, '.', '');
        } else {
            $totalUserRate = (empty($rating)) ? 0 : count($rating);
            $newCal = (($ratingCalculated*$totalUserRate)+($newRate))/($totalUserRate+1);
            $rating[$uid] = $newRate;
            $ratingJSON = json_encode($rating);
            if ($newCal > 3) $newCal = 3;

            if ($stmt = $conn -> prepare("UPDATE `problem` SET `rating`=?, `ratingCalculated`=? WHERE id=?")) {
                $stmt->bind_param('sdi', $ratingJSON, $newCal, $id);
                if ($stmt->execute()) {
                    echo number_format((float) $newCal, 2, '.', '');
                } else {
                    echo "ERROR";
                }
            }
        }
    }
?>