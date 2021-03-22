<div class="container-fluid" style="padding-top: 88px;">
    <div class="mb-3" id="container">
        <table class="table-responsive table-bordered text-nowrap">
        <tr>
            <th>User ID</th>
            <th>P011 (29)</th>
            <th>P012 (33)</th>
            <th>P021 (24)</th>
            <th>P022 (25)</th>
            <th>P031 (18)</th>
            <th>P032 (19)</th>
            <th>P041 (21)</th>
            <th>P042 (23)</th>
            <th>P051 (22)</th>
            <th>P052 (36)</th>
            <th>P061 (30)</th>
            <th>P062 (31)</th>
            <th>P071 (34)</th>
            <th>P072 (35)</th>
            <th>P081 (37)</th>
            <th>P082 (38)</th>
            <th>P091 (20)</th>
            <th>P092 (39)</th>
            <th>P101 (27)</th>
            <th>P102 (28)</th>
        </tr>
        <?php 
        for($o = 1; $o <= 5; $o++) {
            echo "<tr>";
            echo "<td>" . user($o, $conn) . "</td>";
            echo "<td>" . lastResult($o,29,$conn) . "</td>";
            echo "<td>" . lastResult($o,33,$conn) . "</td>";
            echo "<td>" . lastResult($o,24,$conn) . "</td>";
            echo "<td>" . lastResult($o,25,$conn) . "</td>";
            echo "<td>" . lastResult($o,18,$conn) . "</td>";
            echo "<td>" . lastResult($o,19,$conn) . "</td>";
            echo "<td>" . lastResult($o,21,$conn) . "</td>";
            echo "<td>" . lastResult($o,23,$conn) . "</td>";
            echo "<td>" . lastResult($o,22,$conn) . "</td>";
            echo "<td>" . lastResult($o,36,$conn) . "</td>";
            echo "<td>" . lastResult($o,30,$conn) . "</td>";
            echo "<td>" . lastResult($o,31,$conn) . "</td>";
            echo "<td>" . lastResult($o,34,$conn) . "</td>";
            echo "<td>" . lastResult($o,35,$conn) . "</td>";
            echo "<td>" . lastResult($o,37,$conn) . "</td>";
            echo "<td>" . lastResult($o,38,$conn) . "</td>";
            echo "<td>" . lastResult($o,20,$conn) . "</td>";
            echo "<td>" . lastResult($o,39,$conn) . "</td>";
            echo "<td>" . lastResult($o,27,$conn) . "</td>";
            echo "<td>" . lastResult($o,28,$conn) . "</td>";      
            echo "</tr>";
        }
        ?>
        </table>
    </div>
</div>
