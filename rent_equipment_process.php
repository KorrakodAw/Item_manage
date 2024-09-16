<?php
// การเชื่อมต่อกับฐานข้อมูล
include("server.php");

// รับข้อมูลจากฟอร์ม
$id = $_POST['id'];
$quantity_rented = $_POST['quantity_rented'];
$rental_date = $_POST['rental_date'];
$return_date = $_POST['return_date'];

// ตรวจสอบวันที่เช่าและวันที่คืน
if (strtotime($return_date) <= strtotime($rental_date)) {
    echo "<script>alert('วันคืนต้องอยู่หลังจากวันที่เช่า!'); window.location.href='rent_equipment.php';</script>";
    exit();
}

// ตรวจสอบจำนวนที่เช่าให้ไม่เกินจากจำนวนที่มีอยู่ในสต็อก
$sql_check_quantity = "SELECT quantity FROM equipment WHERE id = ?";
$stmt = $conn->prepare($sql_check_quantity);

if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($quantity_rented <= $row['quantity']) {
        // บันทึกข้อมูลการเช่า
        $sql_insert = "INSERT INTO rentals (id, quantity_rented, rental_date, return_date, returned) VALUES (?, ?, ?, ?, 0)";
        $stmt = $conn->prepare($sql_insert);

        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("iiss", $id, $quantity_rented, $rental_date, $return_date);

        if ($stmt->execute()) {
            // อัพเดทจำนวนอุปกรณ์ที่เหลือในตาราง equipment
            $sql_update_quantity = "UPDATE equipment SET quantity = quantity - ? WHERE id = ?";
            $stmt_update = $conn->prepare($sql_update_quantity);

            if ($stmt_update === false) {
                die("Error preparing statement: " . $conn->error);
            }

            $stmt_update->bind_param("ii", $quantity_rented, $id);
            $stmt_update->execute();

            echo "<script>alert('เช่าอุปกรณ์สำเร็จ!'); window.location.href='view_rentals.php';</script>";
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('จำนวนอุปกรณ์ไม่เพียงพอ!'); window.location.href='rent_equipment.php';</script>";
    }
} else {
    echo "<script>alert('ไม่พบอุปกรณ์ที่มี ID นี้!'); window.location.href='rent_equipment.php';</script>";
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>
