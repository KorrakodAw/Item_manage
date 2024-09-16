<?php
include("server.php");
// รับข้อมูลจากฟอร์ม
$equipment_name = $_POST['equipment_name'];
$quantity = $_POST['quantity'];
$purchase_date = $_POST['purchase_date'];

// ตรวจสอบว่ามีข้อมูลซ้ำหรือไม่
$sql_check_duplicate = "SELECT * FROM equipment WHERE equipment_name = ?";
$stmt = $conn->prepare($sql_check_duplicate);
$stmt->bind_param("s", $equipment_name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // หากพบข้อมูลซ้ำ
    echo "<script>alert('อุปกรณ์นี้มีอยู่ในระบบแล้ว!'); window.location.href='index.php';</script>";
} else {
    // หากไม่พบข้อมูลซ้ำ ให้เพิ่มข้อมูลใหม่
    $sql_insert = "INSERT INTO equipment (equipment_name, quantity, purchase_date) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("sis", $equipment_name, $quantity, $purchase_date);

    if ($stmt->execute()) {
        echo "<script>alert('เพิ่มอุปกรณ์สำเร็จ!'); window.location.href='view_equipment.php';</script>";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}

// ปิดการเชื่อมต่อฐานข้อมูล
$stmt->close();
$conn->close();
?>
