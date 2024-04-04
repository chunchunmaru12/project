<?php
include 'customer_header.php';
include '../database/dbconnect.php';
include 'current_user.php';
include 'sidebar.php';

// SQL query to fetch bikes
$sql = "SELECT * FROM bike where b_status<>'pending' ";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);

// Redirect if the user has rented bikes
//r_status is not rejected and is_returned is false then cannot rent
$ssql = "SELECT * FROM rent WHERE customer_id = '$uid' AND r_status = 'approved' ";
$rresult = mysqli_query($conn, $ssql);
$nnum = mysqli_num_rows($rresult);
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
