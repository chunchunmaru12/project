<?php
include 'admin_header.php';
include '../auth/footer.php';

include '../database/dbconnect.php';
include 'session.php';
include 'sidebar.php';

$name = $_SESSION['admin'];
$sql = "SELECT a_name FROM admin WHERE a_email = '$name'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$adminName = $row['a_name'];

$userSql = "SELECT * FROM customer";
$userResult = mysqli_query($conn, $userSql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User and Rentals</title>
    <style>
        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .box {
            width: 850px;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        img {
            width: 100px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome <?php echo $adminName; ?></h1>
        <div class="box">
            <h2><i class="fa-solid fa-user"></i> Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>License Photo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($userResult) > 0) {
                        while ($row = mysqli_fetch_assoc($userResult)) {
                            ?>
                            <tr>
                                <td><?php echo $row['c_name']; ?></td>
                                <td><?php echo $row['c_contact']; ?></td>
                                <td><?php echo $row['c_address']; ?></td>
                                <td><?php echo $row['c_email']; ?></td>
                                <td><img src="<?php echo $row['license_picture']; ?>" alt=""></td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='5'>No users found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
