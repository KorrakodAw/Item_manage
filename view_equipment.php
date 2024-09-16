<?php
include("server.php");

// SQL สำหรับการดึงข้อมูลอุปกรณ์
$sql = "SELECT * FROM equipment";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment List</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h1>รายการอุปกรณ์</h1>
        <table>
            <tr>
                <th>รหัสอุปกรณ์</th>
                <th>ชื่ออุปกรณ์</th>
                <th>จำนวน</th>
                <th>วันที่ซื้อ</th>
                <th>จัดการข้อมูล</th> <!-- คอลัมน์ใหม่สำหรับปุ่มแก้ไข/ลบ -->
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["equipment_name"] . "</td>
                            <td>" . $row["quantity"] . "</td>
                            <td>" . $row["purchase_date"] . "</td>
                            <td>
                                <a href='edit_equipment.php?id=" . $row["id"] . "'>
                                    <button style='padding: 5px 10px; background-color: #007bff; color: white; border: none;  cursor: pointer;'>แก้ไข</button>
                                </a>
                                <a href='delete_equipment.php?id=" . $row["id"] . "' onclick='return confirm(\"คุณต้องการลบข้อมูลนี้ใช่หรือไม่?\")'>
                                    <button style='padding: 5px 10px; background-color: #dc3545; color: white; border: none;  cursor: pointer;'>ลบ</button>
                                </a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>ยังไม่มีรายการที่บันทึก</td></tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>

<?php
$conn->close();
?>