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

$userSql = "
SELECT 
*
from customer 
;

";

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

        h1,
        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
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
                        <th>Current Rentals</th>
                        <th>Bike Status</th>
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
                                <td><img src="<?php echo $row['license_picture']; ?>"></td>
                                <td>
                                    <?php
                                    if ($row['is_rented'] == 0) {
                                        echo "-";
                                    } else {
                                        $bikeSql = "select * from rent where r_status = 'approved' and customer_id =" . $row['c_id'] . "";
                                        $bikeResult = mysqli_query($conn, $bikeSql);
                                        $rrow = mysqli_fetch_assoc($bikeResult);
                                        $bid = $rrow['bike_id'];
                                        $bikeName = "select * from bike where b_id='$bid'";
                                        $res = mysqli_query($conn, $bikeName);
                                        $rrrow = mysqli_fetch_assoc($res);
                                        echo $rrrow['b_name'];
                                    }
                                    ?>
                                </td>
                                <td>
                                <?php
                                    if ($row['is_rented'] == 1) {
                                        echo "<form method='post'>";
                                        echo "<input type='hidden' name='userId' value='" . $row['c_id'] . "'/>";
                                        echo "<button type='submit' name='returned' onclick=\"return confirm('Are you sure the bike has been returned?');\">Returned</button>";
                                        echo "</form>";
                                    } else {
                                        echo "No rentals";
                                    }
                                    ?>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='7'>No users found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php

    if (isset($_POST['returned'])) {
        $userId = $_POST['userId'];
      
        $updatedSql="UPDATE customer
        JOIN rent on customer.c_id=rent.customer_id 
        JOIN bike on bike.b_id=rent.bike_id
        SET is_rented = 0,b_status='available',r_status='returned',is_returned=1  WHERE rent.r_status='approved' and c_id = $userId" ;
        $updateResult = mysqli_query($conn, $updatedSql);
        if ($updateResult) {
            
            echo "<script>alert('Rental status updated successfully');
            window.location.href='admin_dashboard.php';
            </script>";
    
        } else {
            echo "<script>alert('Failed to update rental status');</script>";
        }
    }

?>
</body>

</html>