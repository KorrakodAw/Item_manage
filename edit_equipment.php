<?php
include("server.php");

// ตรวจสอบว่ามีการส่ง ID เข้ามาหรือไม่
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL สำหรับดึงข้อมูลอุปกรณ์ที่ต้องการแก้ไข
    $sql = "SELECT * FROM equipment WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

// เมื่อผู้ใช้ส่งข้อมูลที่แก้ไขแล้ว
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $equipment_name = $_POST['equipment_name'];
    $quantity = $_POST['quantity'];
    $purchase_date = $_POST['purchase_date'];

    // SQL สำหรับการอัปเดตข้อมูล
    $sql = "UPDATE equipment SET equipment_name='$equipment_name', quantity='$quantity', purchase_date='$purchase_date' WHERE id=$id";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Equipment</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h1>แก้ไขข้อมูลอุปกรณ์</h1>
        <form method="POST" action="edit_equipment.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <label for="equipment_name">ชื่ออุปกรณ์:</label>
            <input type="text" name="equipment_name" value="<?php echo $row['equipment_name']; ?>" required>

            <label for="quantity">จำนวน:</label>
            <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" required>

            <label for="purchase_date">วันที่จัดซื้อ:</label>
            <input type="date" name="purchase_date" value="<?php echo $row['purchase_date']; ?>" required>

            <input type="submit" value="ยืนยันการแก้ไข">
        </form>
    </div>
    <?php if ($conn->query($sql) === TRUE) {
        echo "ข้อมูลถูกแก้ไขแล้ว!";
        echo "<br><a href='view_equipment.php'><button>กลับหน้ารายการอุปกรณ์</button></a>";
    } else {
        echo "" . $conn->error;
    } ?>
</body>

</html>

<?php
$conn->close();
?>