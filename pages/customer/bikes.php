<?php
include 'current_user.php';
include 'customer_header.php';
include '../database/dbconnect.php';
if($_GET['bike_id']){
  $bike_id=$_GET['bike_id'];
}
$sql = "SELECT * FROM bike where b_id = '$bike_id'";
$result= mysqli_query($conn,$sql);
$num = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
$imageURL = "../admin/".$row["b_image"];
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
    <h1><?php
    echo $row['b_name'];
    ?></h1>
    <img src="<?php echo $imageURL?>" alt="" style="width:200px;height:100px;object-fit:cover;">
    <form action="" method="post" enctype="multipart/form-data" >
    <label for="pickup_point">Pickup Point:</label>
    <input type="text" id="pickup_point" name="pickup_point" required>
    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" required>
    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" required>
    <label for="pickup_time">Pickup Time:</label>
    <input type="time" id="pickup_time" name="pickup_time" required>
    <label for="destination_point">DropOff Point:</label>
    <input type="text" id="destination_point" name="destination_point" required>
    <label for="drop_time">Drop Time:</label>
    <input type="time" id="drop_time" name="drop_time" required>
    <label for="lpic">License Picture</label>
    <input type="file" name="lpic" id="lpic" accept="image/*" required>
    <label for="rate">Rate:</label>
    <input type="number" id="rate" name="rate"  value="<?php echo $row['b_rate']; ?>" disabled >

    <input type="submit" name="submit" value="Book Now">
  </form>
</div>
<?php
    
    if(isset($_POST['submit'])){
        $r_pickup_point=$_POST['pickup_point'];
        $r_pickup_time=$_POST['pickup_time'];
        $r_start_date=$_POST['start_date'];
        $r_end_date=$_POST['end_date'];
        $r_drop_off=$_POST['destination_point'];
        $r_drop_off_time=$_POST['drop_time'];
        $Picture = $_FILES['lpic']['name'];
        $temp = $_FILES['lpic']['tmp_name']; 
        $folder = "../admin/pics/" . $Picture; move_uploaded_file($temp, $folder);
        $ssql="UPDATE bike set b_status='pending' where b_id='$bike_id'";
        $res=mysqli_query($conn,$ssql);
        $sql="INSERT INTO rent(r_pickup_point,r_start_date,r_end_date,r_pickup_time,r_drop_off_point,r_drop_off_time,c_license_photo,customer_id,bike_id)
        values ('$r_pickup_point','$r_start_date','$r_end_date','$r_pickup_time','$r_drop_off','$r_drop_off_time','$folder','$uid','$bike_id')";
        $result=mysqli_query($conn,$sql);
        if($result){
          echo "<script>alert('Booked');</script>";
          echo "<script>window.location.href = 'booking.php';</script>";
        }
    }
?>
<script>
  // JavaScript code to ensure dates and times cannot be before the current ones
  var currentDate = new Date();
  var currentDateString = currentDate.toISOString().slice(0,10); // Format: YYYY-MM-DD
  var currentTimeString = currentDate.toTimeString().slice(0,5); // Format: HH:MM
  document.getElementById("start_date").min = currentDateString;
  document.getElementById("end_date").min = currentDateString;
  document.getElementById("pickup_time").min = currentTimeString;
  document.getElementById("drop_time").min = currentTimeString;
</script>
</body>
</html>