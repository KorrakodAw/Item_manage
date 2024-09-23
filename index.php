<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Equipment</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <!-- เรียกใช้งาน Navbar -->
    <?php include 'navbar.php' ?>

    <div class="container">
        <h1>เพิ่มข้อมูลอุปกรณ์</h1>
        <form action="add_equipment.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>" >

            <label for="equipment_name">ชื่ออุปกรณ์:</label>
            <input type="text" id="equipment_name" name="equipment_name" required>

            <label for="quantity">จำนวน:</label>
            <input type="number" id="quantity" name="quantity" required>

            <label for="purchase_date">วันที่จัดซื้อ:</label>
            <input type="date" id="purchase_date" name="purchase_date" required>

            <input type="submit" value="เพิ่มข้อมูล">
        </form>
    </div>

</body>

</html>