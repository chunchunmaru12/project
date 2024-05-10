<?php
include 'current_user.php';
include 'customer_header.php';
include '../database/dbconnect.php';

$errors = [];

if(isset($_GET['bike_id'])){
    $bike_id = intval($_GET['bike_id']);
    $stmt = $conn->prepare("SELECT * FROM bike WHERE b_id = ?");
    $stmt->bind_param("i", $bike_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if(!$row) {
        $errors[] = "Invalid bike ID";
    }
    $imageURL = "../admin/".$row["b_image"];
    $bikeURL = "../admin/".$row["b_number_plate"];
}

$ssql = "SELECT * FROM rent WHERE customer_id = ? AND  r_status = ?";
$stmt = $conn->prepare($ssql);
$status_pending = 'pending'; 
$stmt->bind_param("is", $uid, $status_pending); 
$stmt->execute();
$rresult = $stmt->get_result();
$nnum = $rresult->num_rows;

if ($nnum > 0) {
    $errors[] = "Wait for your current request to be approved ";
}

$srsql = "SELECT * FROM rent WHERE customer_id = ? AND  r_status = ? ";
$sstmt = $conn->prepare($srsql);
$status_approved = 'approved';
$sstmt->bind_param("is", $uid, $status_approved); 
$sstmt->execute();
$rrresult = $sstmt->get_result();
$nnnum = $rrresult->num_rows;

if ($nnnum > 0) {
    $errors[] = "Return the bike to rent again ";
}

if (isset($_POST['submit'])) {
    $r_pickup_point = htmlspecialchars($_POST['pickup_point']); 
    $r_pickup_time = htmlspecialchars($_POST['pickup_time']);
    $r_start_date = htmlspecialchars($_POST['start_date']);
    $r_end_date = htmlspecialchars($_POST['end_date']);
    $r_drop_off_time = htmlspecialchars($_POST['drop_time']);
    $Picture = htmlspecialchars($_FILES['lpic']['name']);
    $temp = $_FILES['lpic']['tmp_name']; 
    $folder = "../admin/pics/" . $Picture; 
    move_uploaded_file($temp, $folder);
    
    if(empty($r_pickup_point) || empty($r_start_date) || empty($r_end_date) || empty($r_pickup_time) || empty($r_drop_off_time) || empty($Picture)){
        $errors[] = "All fields are required";
    }

    if(count($errors) == 0){
        $startDateTime = new DateTime($r_start_date . ' ' . $r_pickup_time);
        $endDateTime = new DateTime($r_end_date . ' ' . $r_drop_off_time);
        $duration = $startDateTime->diff($endDateTime);
        $totalMinutes = $duration->days * 24 * 60 + $duration->h * 60 + $duration->i; 
        $ratePerHour = $row['b_rate']; 
        $ratePerMinute = $ratePerHour / 60; 
        $totalAmount = $totalMinutes * $ratePerMinute;

        $stmt = $conn->prepare("INSERT INTO rent(r_pickup_point,r_start_date,r_end_date,r_pickup_time,r_drop_off_time,c_license_photo,customer_id,bike_id,total_amount) VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssiid", $r_pickup_point, $r_start_date, $r_end_date, $r_pickup_time, $r_drop_off_time, $folder, $uid, $bike_id, $totalAmount);
        
        if($stmt->execute()){
            $ssql = "UPDATE bike SET b_status='pending' WHERE b_id=?";
            $stmt = $conn->prepare($ssql);
            $stmt->bind_param("i", $bike_id);
            $stmt->execute();
            echo "<script>alert('Booking Successful'); 
            window.location.href = 'booking.php';</script>";
        } else {
            $errors[] = "Error: " . $stmt->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bike Gallery</title>
<style>
    /* CSS Styles */
    
    .container {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  }
  label {
    display: block;
    margin-bottom: 5px;
  }
  input[type="text"],
  input[type="file"],
  input[type="date"],
  input[type="time"],
  input[type="number"],
  input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-sizing: border-box;
  }
  input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
  }


</style>
</head>
<body>
<div class="container">
    <!-- Display Errors -->
    <?php if(!empty($errors)): ?>
        <div class="errors">
            <?php foreach($errors as $error): ?>
                <p style="color:red;"><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Display Bike Information -->
    <h1><?php echo $row['b_name']; ?></h1>
    <img src="<?php echo $imageURL; ?>" alt="" style="width:200px;height:100px;object-fit:cover;">
    <img src="<?php echo $bikeURL; ?>" alt="" style="width:200px;height:100px;object-fit:cover;">

    <!-- Booking Form -->
    <form method="post" enctype="multipart/form-data">
        <label for="pickup_point">Pickup Point:</label>
    <input type="text" id="pickup_point" name="pickup_point" required>
    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" required>
    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" required>
    <label for="pickup_time">Pickup Time:</label>
    <input type="time" id="pickup_time" name="pickup_time" required>
    <label for="drop_time">Drop Time:</label>
    <input type="time" id="drop_time" name="drop_time" required>
    <label for="lpic">License Picture</label>
    <input type="file" name="lpic" id="lpic" accept="image/*" required>
    <label for="rate">Rate:</label>
    <input type="number" id="rate" name="rate"  value="<?php echo $row['b_rate']; ?>" disabled >

        <input type="submit" name="submit" value="Book Now">
        <!-- Span to display total cost -->
        <span id="totalCost">Total Cost: RS: 0.00</span>
    </form>
</div>

<!-- JavaScript -->
<script>
    var currentDate = new Date();
    var currentDateString = currentDate.toISOString().slice(0,10); // Format: YYYY-MM-DD
    var currentTimeString = currentDate.toTimeString().slice(0,5); // Format: HH:MM
    
    var startDate = document.getElementById("start_date");
    startDate.min = currentDateString;
    startDate.addEventListener("change", updateTotalCost);
    var endDate = document.getElementById("end_date");
    endDate.min = currentDateString;
    endDate.addEventListener("change", updateTotalCost);

    var pickupTime = document.getElementById("pickup_time");
    pickupTime.addEventListener("change", updateTotalCost);
    var dropTime = document.getElementById("drop_time");
    dropTime.addEventListener("change", updateTotalCost);

    function updateTotalCost() {
        var startDateTime = new Date(startDate.value + ' ' + pickupTime.value);
        var endDateTime = new Date(endDate.value + ' ' + dropTime.value);
        var sd=startDateTime.toISOString().slice(0,10);
        if(sd<currentDateString){
            pickupTime.min = currentTimeString;
        }
        if (endDateTime <= startDateTime) {
            alert("End date and time must be after the start date and time.");
            // Reset the end date and time
            endDate.value = startDate.value;
            dropTime.value = pickupTime.value;
            return;
        }

        var duration = (endDateTime - startDateTime) / (1000 * 60); // Duration in minutes
        var ratePerHour = <?php echo $row['b_rate']; ?>; // Rate per hour from PHP
        if(duration > 600){ 
            // if rate is greater than 10 hrs then rate is decreased by 30%
            ratePerHour = ratePerHour * 0.7;
        }
        var ratePerMinute = ratePerHour / 60; // Rate per minute
        var totalAmount = duration * ratePerMinute;
        document.getElementById("totalCost").textContent = "Total Cost: RS " + totalAmount.toFixed(2);
    }

</script>

</body>
</html>
