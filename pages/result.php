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
                        <th>A04Q1 (#41)</th>
                        <th>A04Q2 (#42)</th>
                        <th>A04Q3 (#43)</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <?php 
                for($o = 1; $o <= 91; $o++) {
                    $user = explode("(", user($o, $conn));
                    $score_41 = (int) lastResult2($o,41,$conn);
                    $score_42 = (int) lastResult2($o,42,$conn);
                    $score_43 = (int) lastResult2($o,43,$conn);
                    $total = $score_41 + $score_42 + $score_43;
                    echo "<tr>";
                    echo "<td>" . $o . "</td>";
                    echo "<td>" . str_replace(")", "", $user[1]) . "</td>";
                    echo "<td>" . $user[0] . "</td>";
                    echo "<td data-order=$score_41>$score_41</td>";
                    echo "<td data-order=$score_42>$score_42</td>";
                    echo "<td data-order=$score_43>$score_43</td>";  
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
