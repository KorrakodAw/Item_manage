<?php
// การเชื่อมต่อฐานข้อมูล
include("server.php");

// รับข้อมูลจากฟอร์ม
$rental_id = $_POST['rental_id'];
$id = $_POST['id'];
$quantity_rented = $_POST['quantity_rented'];

// เพิ่มจำนวนอุปกรณ์ในตาราง equipment
$sql_update_equipment = "UPDATE equipment SET quantity = quantity + ? WHERE id = ?";
$stmt_update = $conn->prepare($sql_update_equipment);

if ($stmt_update === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt_update->bind_param("ii", $quantity_rented, $id);
$stmt_update->execute();

// ลบรายการเช่าจากตาราง rentals
$sql_delete_rental = "DELETE FROM rentals WHERE rental_id = ?";
$stmt_delete = $conn->prepare($sql_delete_rental);

if ($stmt_delete === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt_delete->bind_param("i", $rental_id);
$stmt_delete->execute();

echo "<script>alert('คืนอุปกรณ์สำเร็จและลบรายการเช่าเรียบร้อย!'); window.location.href='view_rentals.php';</script>";

// ปิดการเชื่อมต่อ
$conn->close();
?>
