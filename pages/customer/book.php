<?php
include 'customer_header.php';
include '../database/dbconnect.php';
include 'current_user.php';

// SQL query to fetch bikes
$sql = "SELECT * FROM bike";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);

// Redirect if the user has rented bikes
//r_status is not rejected and is_returned is false then cannot rent
$ssql = "SELECT * FROM rent WHERE customer_id = '$uid' AND r_status = 'approved' AND is_returned=0";
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
        .text {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Rent a Bike</h1>
        <div class="gallery">
            <?php
            if ($num > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $imageURL = "../admin/" . $row["b_image"];
                    $imageName = htmlspecialchars($row["b_name"]);
                    $rate = $row["b_rate"];
                    ?>
                    <div class="bike">
                        <a href="bikes.php?bike_id=<?php echo $row['b_id']; ?>">
                            <img class="bikeImg" src="<?php echo $imageURL; ?>" alt="<?php echo $imageName; ?>">
                            <div class="text">
                                <p><?php echo $imageName; ?></p>
                                <p>Rate: Rs <?php echo $rate; ?>/hour</p>
                            </div>
                        </a>
                        
                    </div>
                    <?php
                }
            } else {
                echo "No bikes found.";
            }
            ?>
        </div>
    </div>
</body>
</html>
