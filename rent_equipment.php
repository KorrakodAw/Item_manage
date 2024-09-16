<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent Equipment</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h1>การเช่า/ยืม อุปกรณ์</h1>
        <form action="rent_equipment_process.php" method="POST">
            <label for="id">ID อุปกรณ์:</label>
            <input type="number" id="id" name="id" required>

            <label for="quantity_rented">จำนวนที่ต้องการเช่า:</label>
            <input type="number" id="quantity_rented" name="quantity_rented" required>

            <label for="rental_date">วันที่ต้องการเช่า:</label>
            <input type="date" id="rental_date" name="rental_date" required>

            <label for="return_date">วันที่ต้องการคืน:</label>
            <input type="date" id="return_date" name="return_date" required>

            <input type="submit" value="ยืนยันการเช่า">
        </form>
    </div>

</body>

</html>