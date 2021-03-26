
<!DOCTYPE html>
<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">
<?php 
    require_once '../static/functions/connect.php';
    require_once '../static/functions/function.php';
	 
    header("Content-Type: application/vnd.ms-excel"); // ประเภทของไฟล์
    header('Content-Disposition: attachment; filename=LCA Export '.date("j F Y His").".xls"); //กำหนดชื่อไฟล์
    header("Content-Type: application/force-download"); // กำหนดให้ถ้าเปิดหน้านี้ให้ดาวน์โหลดไฟล์
    header("Content-Type: application/octet-stream"); 
    header("Content-Type: application/download"); // กำหนดให้ถ้าเปิดหน้านี้ให้ดาวน์โหลดไฟล์
    header("Content-Transfer-Encoding: binary"); 
    
?>
<head>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <table >
        <tr>
            <th>#</th>
            <th>std_id</th>
            <th>name</th>
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
        for($o = 1; $o <= 91; $o++) {
            $user = explode("(", user($o, $conn));
            echo "<tr>";
            echo "<td>" . $o . "</td>";
            echo "<td>" . str_replace(")", "", $user[1]) . "</td>";
            echo "<td>" . $user[0] . "</td>";
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
</body>