<?php
    require_once '../static/functions/connect.php';
    require_once '../static/functions/function.php';

    function usergen($name, $properties) {
        if (empty($properties)) return $name;
        $dec = json_decode($properties, true);
        $rainbow = array_key_exists("rainbow", $dec) ? (bool) $dec['rainbow'] : false;
        if ($rainbow)
            return '<text class="rainbow">'. $name . '</text>';
        return $name;
    }

    function probgen($name, $codename) {
        return "$name <span class='badge badge-coekku'>$codename</span>";
    }

    $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $limit = 100; //How many post per page
    $start_id = ($current_page - 1) * $limit;

    $logged_in = isLogin();
    $admin = $logged_in ? isAdmin() : false;

    global $conn;
    if ($stmt = $conn -> prepare("SELECT `submission`.`id` as id, `submission`.`user` as user, `submission`.`problem` as problem, `submission`.`result` as result, `submission`.`score` as score, `submission`.`maxScore` as maxScore, `submission`.`uploadtime` as uploadtime, `problem`.`id` as probID, `problem`.`score` as probScore, `problem`.`name` as probName, `problem`.`codename` as probCodename, `user`.`name` as userDisplayname, `user`.`properties` as userProperties FROM `submission` INNER JOIN `problem` ON `problem`.`id` = `submission`.`problem` INNER JOIN `user` ON `user`.`id` = `submission`.`user` ORDER BY `submission`.`id` DESC LIMIT ?,?")) {
        $stmt->bind_param('ii', $start_id, $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $subID = $row['id'];
                $subUser = usergen($row['userDisplayname'], $row['userProperties']);
                $subProb = probgen($row['probName'], $row['probCodename']);
                $subResult = $row['result'] != 'W' ? $row['result']: 'รอผลตรวจ...';
                $subScore = $row['maxScore'] != 0 ? ($row['score']/$row['maxScore'])*$row['probScore'] : "UNDEFINED";
                //$subRuntime = $row['runningtime']/1000;
                $subUploadtime = $row['uploadtime']; 
                $clfl = (isLogin() && $_SESSION['id'] == $row['user']) ? "ThisIsMine" : "ThisIsNotMine";
                $i++; ?>
                <tr style="cursor: pointer;" onclick='launchSubmissionModal(<?php echo $subID; ?>);' class='<?php echo $clfl; ?>' id='sub<?php echo $subID;?>' data-toggle='modal' data-target='#modalPopup'>
                    <th scope='row' data-order='<?php echo $i; ?>'><?php echo $subID; ?></th>
                    <td data-order='<?php echo $i; ?>'><?php echo $subUploadtime; ?></td>
                    <td><?php echo $subUser; ?></td>
                    <td><a href="../problem/<?php echo $row['probID']; ?>"><?php echo $subProb; ?></a></td>
                    <td <?php if ($row['result'] == 'W') echo "data-wait=true data-sub-id='$subID'"; ?>><code><?php echo $subResult . " ($subScore)";?></code></td>
                </tr>
            <?php }
            if ($result->num_rows < $limit) { ?>
            <div id="EOF"></div>
            <?php } 
            $stmt->free_result();
            $stmt->close();  
        } else { ?>
        <div id="EOF"></div>
        <?php }
    }
?>