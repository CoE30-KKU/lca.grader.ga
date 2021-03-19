<?php 
    require_once '../static/functions/connect.php';
    require_once '../static/functions/function.php';

    $user = ""; $name = "";
    if (isLogin()) {
        $id = $_SESSION['id'];
        $user = getUserdata($id, 'username', $conn);
        $name = getUserdata($id, 'displayname', $conn);;
    }
?>
<form method="post" action="../pages/donation_submit_save.php" enctype="multipart/form-data">
    <?php if (isLogin()) { ?><input type="hidden" name="username" value="<?php echo $user; ?>"/><?php } ?>
    ชื่อ: <input required type="text" name="name" id="name" value="<?php echo $name; ?>" <?php if (isLogin()) echo " disabled";?>><br> 
    จำนวนเงิน: <input required type="number" name="amount" id="amount"><br>
    เวลาที่โอน: <input required type="date" name="date" id="date"/>&nbsp;<input type="time" name="time" id="time"><br>
    สลิปโอนเงิน: <input type="file" name="slip" id="slip" accept="image/*" required /><br><br><br>
    <input type="submit" value="บันทึก">
</form>