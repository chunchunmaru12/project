<?php
include 'admin_header.php';
include '../database/dbconnect.php';
include '../auth/footer.php';
include 'session.php';
include 'sidebar.php';

$sql = "SELECT * FROM bike";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bikes</title>
    <style>
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .container {
            max-width: 1100px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 15px;
            border: 1px solid #e0e0e0;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .bike {
            width: 150px;
            height: 90px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Bikes</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Bike Image</th>
                    <th>Bike Number Plate</th>
                    <th>Color</th>
                    <th>Rate</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $imageURL = $row["b_image"];
                        $plateUrl = $row['b_number_plate'];
                ?>
                        <tr>
                            <td><?php echo $row['b_name']; ?></td>
                            <td><?php echo $row['b_brand']; ?></td>
                            <td><img class="bike" src="<?php echo $imageURL; ?>" alt="Bike Image"></td>
                            <td><img class="bike" src="<?php echo $plateUrl; ?>" alt="Bike Number Plate"></td>
                            <td><?php echo $row['b_color']; ?></td>
                            <td><?php echo $row['b_rate']; ?></td>
                            <td><?php echo $row['b_status']; ?></td>
                            <td><a href="admin_bike.php?bike_id=<?php echo $row['b_id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                            <td><a href="delete.php?bike_id=<?php echo $row['b_id']; ?>"><i class="fa-solid fa-trash"></i></a></td>
                        </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="9">No bikes found</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
