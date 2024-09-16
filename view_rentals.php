<?php
// การเชื่อมต่อกับฐานข้อมูล
include("server.php");

// ดึงข้อมูลการเช่าจากตาราง rentals และเชื่อมโยงกับข้อมูลในตาราง equipment
$sql = "SELECT rentals.rental_id, rentals.id, equipment.equipment_name, rentals.quantity_rented, rentals.rental_date, rentals.return_date 
        FROM rentals
        JOIN equipment ON rentals.id = equipment.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental List</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include("navbar.php"); ?>
    <div class="container">
        <h1>รายการการเช่า</h1>

        <table>
            <tr>
                <th>รหัสเช่า</th>
                <th>ชื่ออุปกรณ์</th>
                <th>จำนวนที่เช่า</th>
                <th>วันที่เช่า</th>
                <th>วันที่คืน</th>
                <th>คืนอุปกรณ์</th>
            </tr>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['rental_id'] . "</td>";
                    echo "<td>" . $row['equipment_name'] . "</td>";
                    echo "<td>" . $row['quantity_rented'] . "</td>";
                    echo "<td>" . $row['rental_date'] . "</td>";
                    echo "<td>" . $row['return_date'] . "</td>";
                    echo "<td>
                    <form method='POST' action='return_equipment.php'>
                        <input type='hidden' name='rental_id' value='" . $row['rental_id'] . "'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <input type='hidden' name='quantity_rented' value='" . $row['quantity_rented'] . "'>
                        <button type='submit'>คืนอุปกรณ์</button>
                    </form>
                  </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>ไม่มีรายการเช่า</td></tr>";
            }
            ?>
        </table>

        <?php
        $conn->close();
        ?>
    </div>


</body>
</html>

