<div class="container mb-3" style="padding-top: 88px;" id="container">
    <h1 class="display-4 font-weight-bold text-center text-coekku">Submission</h1>
    <?php if (isLogin()) { ?>
    <div class="switch switch-danger mb-1">
        <label>
            <input type="checkbox" name="onlyme" id="onlyme">
            <span class="lever"></span>Only My Submission
        </label>
    </div>
    <?php } ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped w-100 d-block d-md-table" id="submissionTable">
            <thead>
                <tr class="text-nowrap me">
                    <th scope="col" class="font-weight-bold text-coekku">ID</th>
                    <th scope="col" class="font-weight-bold text-coekku">Timestamp</th>
                    <th scope="col" class="font-weight-bold text-coekku">User</th>
                    <th scope="col" class="font-weight-bold text-coekku">Problem ID</th>
                    <th scope="col" class="font-weight-bold text-coekku">Result</th>
                </tr>
            </thead>
            <tbody class="text-nowrap">
                <?php

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

                    if ($stmt = $conn -> prepare("SELECT `submission`.`id` as id, `submission`.`user` as user, `submission`.`problem` as problem, `submission`.`result` as result, `submission`.`score` as score, `submission`.`maxScore` as maxScore, `submission`.`uploadtime` as uploadtime, `problem`.`score` as probScore, `problem`.`name` as probName, `problem`.`codename` as probCodename, `user`.`name` as userDisplayname, `user`.`properties` as userProperties FROM `submission` INNER JOIN `problem` ON `problem`.`id` = `submission`.`problem` INNER JOIN `user` ON `user`.`id` = `submission`.`user` ORDER BY `submission`.`id` DESC")) {
                        //$stmt->bind_param('ii', $page, $limit);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            $i = 0;
                            while ($row = $result->fetch_assoc()) {
                                $me = (isLogin() && ($_SESSION['id'] == $row['user'] || isAdmin($_SESSION['id'], $conn))) ? "data-owner='true'" : "data-owner='false'";
                                $subID = $row['id'];
                                $subUser = usergen($row['userDisplayname'], $row['userProperties']);
                                $subProb = probgen($row['probName'], $row['probCodename']);
                                $subResult = $row['result'] != 'W' ? $row['result'] : 'รอผลตรวจ...';
                                $subScore = sprintf("%.2f", ($row['score']/$row['maxScore'])*$row['probScore']);
                                //$subRuntime = $row['runningtime']/1000;
                                $subUploadtime = $row['uploadtime']; 
                                $i++; ?>
                                <tr style="cursor: pointer;" class='launchModal' <?php echo $me;?> id='sub<?php echo $subID;?>' onclick='javascript:;' data-toggle='modal' data-target='#modalPopup' data-title='Submission #<?php echo $subID; ?>' data-id='<?php echo $subID; ?>' data-uid='<?php echo $subUser; ?>'>
                                    <th scope='row' data-order='<?php echo $i; ?>'><?php echo $subID; ?></th>
                                    <td data-order='<?php echo $i; ?>'><?php echo $subUploadtime; ?></td>
                                    <td><?php echo $subUser ?></td>
                                    <td><?php echo $subProb; ?></td>
                                    <td <?php if ($row['result'] == 'W') echo "data-wait=true data-sub-id='$subID'"; ?>><code><?php echo $subResult . " ($subScore)";?></code></td>
                                </tr>
                            <?php }
                            $stmt->free_result();
                            $stmt->close();  
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function () {
            var submission_table = $('#submissionTable').DataTable({
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "ทั้งหมด"] ]
            });
            $('.dataTables_length').addClass('bs-select');
            $("#onlyme").change(function() {
                if ($(this).is(':checked')) {
                    submission_table.search("<?php if (isset($_SESSION['id'])) echo getUserdata($_SESSION['id'],'name', $conn); else echo ""; ?>").draw();
                } else {
                    submission_table.search("").draw();
                }
            });
        });
    </script>
</div>
