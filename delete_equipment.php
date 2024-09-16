<link rel="stylesheet" href="style.css">
<?php
include("server.php");

// ตรวจสอบว่ามี ID ที่ส่งเข้ามาหรือไม่
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL สำหรับการลบข้อมูล
    $sql = "DELETE FROM equipment WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Equipment deleted successfully!";
        echo "<br><a href='view_equipment.php'><button>กลับหน้ารายการอุปกรณ์</button></a>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
