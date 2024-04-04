<?php
include 'customer_header.php';
include 'current_user.php';
include 'sidebar.php';

$sql = "SELECT * FROM customer WHERE c_id='$uid'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

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
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            border: 1px solid #e0e0e0;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        img {
            width: 200px;
            height: 100px;
            object-fit: cover;
            margin-top: 15px;
        }

        .edit-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: rgb(76, 175, 80);
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .edit-btn:hover {
            background-color: rgb(69, 160, 73);
        }
    </style>
</head>

<body>
    <div class="user">
        <h1>User Details</h1>
        <table>
            <tr>
                <th>Field</th>
                <th>Information</th>
            </tr>
            <tr>
                <td>User Name</td>
                <td><?php echo $row['c_name']; ?></td>
            </tr>
            <tr>
                <td>Contact Detail</td>
                <td><?php echo $row['c_contact']; ?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?php echo $row['c_address']; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?php echo $row['c_email']; ?></td>
            </tr>
            <tr>
                <td>License Photo</td>
                <td><img src="<?php echo $row['license_picture']; ?>" alt="License Photo"></td>
            </tr>
        </table>
        <button class="edit-btn" onclick="window.location.href='edit_user.php?uid=<?php echo $uid; ?>'">Edit Information</button>
    </div>
</body>

</html>
