<?php
include 'customer_header.php';
include '../database/dbconnect.php';
include 'current_user.php';
include 'sidebar.php';

// SQL query to fetch bikes using prepared statements
$sql = "SELECT * FROM bike WHERE b_status <> 'pending'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$num = $result->num_rows;

// Redirect if the user has rented bikes
$ssql = "SELECT * FROM rent WHERE customer_id = ? AND r_status = 'approved'";
$stmt = $conn->prepare($ssql);
$stmt->bind_param("i", $uid);
$stmt->execute();
$rresult = $stmt->get_result();
$nnum = $rresult->num_rows;

if ($nnum > 0) {
    echo "<script>alert('Return the bike to rent again');
          window.location.href = 'booking.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bike Gallery</title>
    <style>
        .container {
            max-width: 800px;
            margin: 20px auto;
        }
        .gallery {
            display: grid;
            grid-template-columns: auto auto;
            grid-gap: 30px;
            background-color: #f0f0f0;
        }
        .bikeImg {
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            width: 400px;
            height: 100px;
            object-fit: cover;
        }
    </style>
</head>
<body>
<?php
include 'rental.php';
?>
</body>
</html>
