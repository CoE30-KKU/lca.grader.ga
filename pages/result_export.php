
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
            <th>A04Q1 (#41)</th>
            <th>A04Q2 (#42)</th>
            <th>A04Q3 (#43)</th>
        </tr>
        <?php 
        for($o = 1; $o <= 91; $o++) {
            $user = explode("(", user($o, $conn));
            echo "<tr>";
            echo "<td>" . $o . "</td>";
            echo "<td>" . str_replace(")", "", $user[1]) . "</td>";
            echo "<td>" . $user[0] . "</td>";
            echo "<td>" . lastResult2($o,41,$conn) . "</td>";
            echo "<td>" . lastResult2($o,42,$conn) . "</td>";
            echo "<td>" . lastResult2($o,43,$conn) . "</td>";     
            echo "</tr>";
        }
        ?>
        </table>
</body>