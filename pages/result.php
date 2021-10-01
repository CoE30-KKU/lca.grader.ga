<div class="container-fluid" style="padding-top: 88px;">
    <div class="mb-3" id="container">
        <a href="../pages/result_export.php" class="btn btn-success"><i class="fas fa-file-excel"></i> Export as Excel</a>
        <div class="table-responsive">
            <table class="table-bordered table-striped text-nowrap d-table" id="result">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>C4 Q1</th>
                        <th>C4 Q2</th>
                        <th>C4 Q3</th>
                        <th>C4 Q4</th>
                        <th>C4 Q5</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <?php 
                $std = array(2,34,52,57,58,62,67,77,83,84,87);
                foreach($std as $o) {
                    $user = explode("(", user($o));
                    echo "<tr>";
                    echo "<td>" . $o . "</td>";
                    echo "<td>" . str_replace(")", "", $user[1]) . "</td>";
                    echo "<td>" . $user[0] . "</td>";
                    $total = 0;
                    for($i = 73; $i <= 77; $i++) {
                        $score = (int) lastResult2($o,$i);
                        $total += $score;
                        echo "<td data-order=$score>$score</td>";
                    }
                    echo "<td data-order=$total>$total</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#result').DataTable({
            "lengthMenu": [ [25, 50, -1], [25, 50, "ทั้งหมด"] ],
            'columnDefs': [ {
                'targets': [2], // column index (start from 0)
                'orderable': false // set orderable false for selected columns
            }]
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>
