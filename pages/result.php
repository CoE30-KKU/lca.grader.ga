<div class="container-fluid" style="padding-top: 88px;">
    <div class="mb-3" id="container">
        <a href="../pages/result_export.php" class="btn btn-success"><i class="fas fa-file-excel"></i> Export as Excel</a>
        <table class="table-responsive table-bordered table-striped text-nowrap d-table">
        <tr>
            <th>User ID</th>
            <th>A04Q1 (#41)</th>
            <th>A04Q2 (#42)</th>
            <th>A04Q3 (#43)</th>
            <th>Total</th>
        </tr>
        <?php 
        for($o = 30; $o <= 40; $o++) {
            $score_41 = (int) lastResult2($o,41,$conn);
            $score_42 = (int) lastResult2($o,42,$conn);
            $score_43 = (int) lastResult2($o,43,$conn);
            $total = $score_41 + $score_42 + $score_43;
            echo "<tr>";
            echo "<td>" . user($o, $conn) . "</td>";
            echo "<td>$score_41</td>";
            echo "<td>$score_42</td>";
            echo "<td>$score_43</td>";  
            echo "<td>$total</td>";
            echo "</tr>";
        }
        ?>
        </table>
    </div>
</div>
