
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
    <table>
        <tr>
            <th>#</th>
            <th>Student ID</th>
            <th>Name</th>
            <th>C3 Q1</th>
            <th>C3 Q2</th>
            <th>C3 Q3</th>
            <th>C3 Q4</th>
            <th>C3 Q5</th>
            <th>C3 Q6</th>
            <th>C3 Q7</th>
            <th>C3 Q8</th>
            <th>Total</th>
        </tr>
        <?php 
            $std = array(2,34,52,57,58,62,67,77,83,84,87);
            foreach($std as $o) {
                $user = explode("(", user($o));
                echo "<tr>";
                echo "<td>" . $o . "</td>";
                echo "<td>" . str_replace(")", "", $user[1]) . "</td>";
                echo "<td>" . $user[0] . "</td>";
                $total = 0;
                for($i = 65; $i <= 72; $i++) {
                    $score = (int) lastResult2($o,$i);
                    $total += $score;
                    echo "<td>$score</td>";
                }
                echo "<td>$total</td>";
                echo "</tr>";
            }
        ?>
        </table>
</body>