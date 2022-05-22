<div class="container mb-3" style="padding-top: 88px;" id="container">
    <h1 class="display-4 font-weight-bold text-center text-coekku">Problem</h1>
    <?php if (isLogin()) { ?><a href="../problem/create" class="btn btn-coekku btn-sm">+ Add Problem</a><?php } ?>
    <div class="table-responsive">
        <table class="table table-sm table-striped w-100 d-block d-md-table" id="problemTable">
            <thead>
                <tr class="text-nowrap">
                    <th scope="col" class="font-weight-bold text-coekku text-right">ID</th>
                    <th scope="col" class="font-weight-bold text-coekku">Task</th>
                    <th scope="col" class="font-weight-bold text-coekku">Author</th>
                    <th scope="col" class="font-weight-bold text-coekku">Rate</th>
                    <th scope="col" class="font-weight-bold text-coekku">Result</th>
                </tr>
            </thead>
            <tbody class="text-nowrap">
                <?php

                $tempUser = array();
                function getNameFromID($id) {
                    if (array_key_exists($id, $tempUser)) {
                        return $tempUser[$id];
                    } else {
                        if ($stmt = $conn -> prepare("SELECT `user`.`name` as username FROM `user` WHERE `user`.`std_id` = ?" LIMIT 1) {
                            $stmt->bind_param('s', $id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result->num_rows > 0) {
                                $tempUser[$id] = $result['username'];
                                return $result['username'];
                            }
                        }
                        $tempUser[$id] = null;
                        return null;
                    }
                }
                $userID = isLogin() ? $_SESSION['user']->getID() : 0;
                $admin = isAdmin();
                if ($stmt = $conn -> prepare("SELECT `problem`.`ratingCalculated` as ratingCalculated, `problem`.`id` as probID, `problem`.`name` as probName, `problem`.`properties` as probProp, `problem`.`codename` as probCode, `problem`.`author` as probAuthor, (select `submission`.`result` as `subResult` FROM `submission` WHERE `submission`.`user` = ? AND `submission`.`problem` = `problem`.`id` ORDER BY `submission`.`id` DESC LIMIT 1) as subResult FROM `problem` ORDER BY `problem`.`id` DESC")) {
                    $stmt->bind_param('i', $userID);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id = $row['probID']; $name = $row['probName']; $codename = $row['probCode']; $author = $row['probAuthor']; $user = getNameFromID($author);                            
                            $prop = json_decode($row['probProp'],true);
                            $hide = array_key_exists("hide", $prop) ? $prop["hide"] : false;
                            $ratingCalculated = (float) $row['ratingCalculated'];

                            $hideMessage = ($hide) ? "<span class='badge badge-danger'>ซ่อน</span>" : "";

                            $lastResult = $row['subResult'];
                            $color;
                            if (empty($lastResult)) $color = "";
                            else if (str_contains($lastResult, "-") || str_contains($lastResult, "X") || str_contains($lastResult, "T"))
                                $color = "yellow lighten-4";
                            else $color = "green accent-1";
                            
                            if (!$hide || (isLogin() && $admin)) {
                                echo "<tr style='cursor: pointer;' onmousedown='window.open(\"../problem/$id\")'>
                                    <th class='text-right' scope='row'>$id</th>
                                    <td>$name <span class='badge badge-coekku'>$codename</span> $hideMessage</td>
                                    <td>$user <span class='badge badge-coekku'>$author</span></td>
                                    <td data-order='".$ratingCalculated."'>".rating($ratingCalculated)."</td>
                                    <td><code>$lastResult</code></td>
                                </tr>";
                            }
                        }
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
            $('#problemTable').DataTable({
                "lengthMenu": [ [15, 50, 100, -1], [15, 50, 100, "All"] ],
                'columnDefs': [ {
                    'targets': [1,3], // column index (start from 0)
                    'orderable': false, // set orderable false for selected columns
                }],
                "order": [[ 0, "desc" ]]
            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
</div>