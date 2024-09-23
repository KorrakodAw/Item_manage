<link rel="stylesheet" href="style.css">
<?php
include("server.php");

// ตรวจสอบว่ามี ID ที่ส่งเข้ามาหรือไม่
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL สำหรับการลบข้อมูล
    $sql = "DELETE FROM equipment WHERE id = $id";


    if ($conn->query($sql) === TRUE) {
        echo '<script type="text/javascript">
        window.onload = function () { 
            alert("ข้อมูลถูกลบแล้ว!");
            window.location.href = "view_equipment.php";
        }
    </script>';
    } else {
        echo "" . $conn->error;
    }
}

$conn->close();
?>
