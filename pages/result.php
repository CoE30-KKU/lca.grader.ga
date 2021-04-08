<div class="container-fluid" style="padding-top: 88px;">
    <div class="mb-3" id="container">
        <a href="../pages/result_export.php" class="btn btn-success"><i class="fas fa-file-excel"></i> Export as Excel</a>
        <table class="table-responsive table-bordered text-nowrap">
        <tr>
            <th>User ID</th>
            <th>A04Q1 (#41)</th>
            <th>A04Q2 (#42)</th>
            <th>A04Q3 (#43)</th>
        </tr>
        <?php 
        for($o = 1; $o <= 91; $o++) {
            echo "<tr>";
            echo "<td>" . user($o, $conn) . "</td>";
            echo "<td>" . lastResult2($o,41,$conn) . "</td>";
            echo "<td>" . lastResult2($o,42,$conn) . "</td>";
            echo "<td>" . lastResult2($o,43,$conn) . "</td>";  
            echo "</tr>";
        }
        ?>
        </table>
    </div>
</div>
