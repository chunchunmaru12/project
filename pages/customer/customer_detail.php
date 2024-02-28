<?php
include 'customer_header.php';
include '../database/dbconnect.php';
include 'current_user.php';
?><br>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <style>
        .user {
            max-width: 800px;
            margin: 20px auto;
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <div class="user">
        <h1>User Details</h1>
        <table border=""></table>
        <?php
        $sql = "SELECT * FROM customer WHERE c_id='$uid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <p>User Name: <?php echo $row['c_name'] ?> </p>
        <p>Contact Detail: <?php echo $row['c_contact'] ?></p>
        <p>Address: <?php echo $row['c_address'] ?></p>
        <p>Email:<?php echo $row['c_email'] ?></p>
        <p>License Photo: </p><img src="<?php echo $row['license_picture']; ?>" style='width:200px;height:100px;object-fit:cover;'>
        <tr></tr>
    </div>
</body>

</html>