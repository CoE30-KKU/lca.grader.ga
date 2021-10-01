<?php needAdmin(); ?>
<div class="container-fluid mb-3" style="padding-top: 88px;" id="container">
    <h1 class="display-4 font-weight-bold text-center text-coekku">Report</h1>
    <div class="container">
        <form method="POST" enctype="multipart/form-data">
        <?php
        function AmIInProblemList(int $i) {
            return isset($_POST['problem']) ? (in_array($i, $_POST['problem']) ? "selected" : "") : "";
        }
        function AmIaSelectedYear(int $i) {
            return isset($_POST['year']) ? (($i == $_POST['year']) ? "selected" : "") : "";
        }
        function AmIaSelectedSemester(int $i) {
            return isset($_POST['semester']) ? (($i == $_POST['semester']) ? "selected" : "") : "";
        }
        ?>
        <div class="row">
            <div class="col-12 col-md-4 col-xl-5">
                <select class="mdb-select md-form" multiple searchable="Search here.. 🔎" required name="problem[]">
                    <option value="" disabled selected>Select Problem</option>
                    <?php
                    if ($stmt = $conn->prepare("SELECT `problem`.`id` as probID, `problem`.`name` as probName, `problem`.`properties` as probProp, `problem`.`codename` as probCode FROM `problem` ORDER BY `problem`.`id` DESC")) {
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $id = $row['probID']; $name = $row['probName']; $codename = $row['probCode'];
                                $prop = json_decode($row['probProp'],true);
                                $hide = array_key_exists("hide", $prop) ? $prop["hide"] : false;
                                $hideMessage = ($hide) ? "(ซ่อน)" : ""; ?>
                                <option <?php echo AmIInProblemList($id); ?> value="<?php echo $id; ?>">ข้อที่ <?php echo $id; ?> - <?php echo $name; ?> [<?php echo $codename; ?>] <?php echo $hideMessage; ?></option>
                            <?php }
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-12 col-md-4 col-xl-2">
                <select class="mdb-select md-form" searchable="Search here.. 🔎" required name="year">
                    <option value="" disabled selected>Select Year</option>
                    <?php
                        $current_year = (int) date("Y") + 543;
                        for($i = $current_year; $i >= 2563; $i--) { ?>
                        <option value="<?php echo $i; ?>" <?php echo AmIaSelectedYear($i); ?>><?php echo $i; ?></option>
                    <?php } ?>  
                </select>
            </div>
            <div class="col-12 col-md-4 col-xl-2">
                <select class="mdb-select md-form" searchable="Search here.. 🔎" required name="semester">
                    <option value="" disabled selected>Select Semester</option>
                    <option value="1" <?php echo AmIaSelectedSemester(1); ?>>1</option>
                    <option value="2" <?php echo AmIaSelectedSemester(2); ?>>2</option>
                    <option value="3" <?php echo AmIaSelectedSemester(3); ?>>3</option>
                </select>
            </div>
            <div class="col-12 col-md-12 col-xl-2">
                <div class="text-center">
                    <button type="submit" class="btn btn-success mt-3"><i class="fas fa-search"></i> Query</button>
                </div>
            </div>
        </div>
        </form>
    </div>
    <?php if (isset($_POST['problem']) && isset($_POST['year']) && isset($_POST['semester'])) {
        $prob = $_POST['problem']; sort($prob); $probs = array();
        $year = $_POST['year'];
        $sems = $_POST['semester'];
        $niceProb = join(',', $prob);
        if ($stmt = $conn->prepare("SELECT `id`,`codename` FROM `problem` WHERE id in ($niceProb)")) {
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($probs, array("id"=>$row['id'],"code"=>$row['codename']));
                }
            }
        }
        $users = array();
        if ($stmt = $conn->prepare("SELECT `std_id`,`id`,`name` FROM `user` WHERE year = ? and sems = ?")) {
            $stmt->bind_param('ii', $year, $sems);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($users, array("id"=>$row['id'],"name"=>$row['name'],"std_id"=>$row['std_id']));
                }
            }
        }
    ?>
        <div class="table-responsive">
            <table class="table table-sm table-striped w-100 d-block d-md-table" id="result">
                <thead>
                    <tr class="text-nowrap">
                        <th>#</th>
                        <th>Student ID</th>
                        <th>Name</th>
                        <?php foreach($probs as $p) { ?>
                        <th><?php echo "[".$p["id"]."] ".$p["code"]; ?></th>
                        <?php } ?>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody class="text-nowrap">
                <?php 
                foreach($users as $u) {
                    echo "<tr>";
                    echo "<td>" . $u['id'] . "</td>";
                    echo "<td>" . $u['std_id'] . "</td>";
                    echo "<td>" . $u['name'] . "</td>";
                    $total = 0;
                    foreach($probs as $p) {
                        $score = (int) lastResult2($u['id'],$p['id']);
                        $total += $score;
                        echo "<td data-order=$score>$score</td>";
                    }
                    echo "<td data-order=$total>$total</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>
<script>
    function n(n){
        return n > 9 ? "" + n: "0" + n;
    }

    var d = new Date();
    var strDate = d.getFullYear()+543 + "" + n(d.getMonth()+1) + "" + n(d.getDate()) + "_" + n(d.getHours()) + "" + n(d.getMinutes()) + "" + n(d.getSeconds());
    $(document).ready(function () {
        $('#result').DataTable({
            "lengthMenu": [ [25], [25] ],
            'columnDefs': [ {
                'targets': [2], // column index (start from 0)
                'orderable': false // set orderable false for selected columns
            }],
            "dom": 'Bfrtip',
            'buttons': [
                {
                    extend: 'excelHtml5',
                    title: 'LCA Export ' + strDate
                },
                {
                    extend: 'print',
                    title: 'LCA Export (' + (d.getFullYear()+543) + "/" + n(d.getMonth()+1) + "/" + n(d.getDate()) + " " + n(d.getHours()) + ":" + n(d.getMinutes()) + ":" + n(d.getSeconds()) + ')'
                }
            ]
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>
