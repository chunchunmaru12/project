<?php
include 'customer_header.php'

?><br><br><br>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Customer Dashboard</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
  }
  .container {
    text-align: center;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  }
  .dashboard-header {
    margin-bottom: 20px;
  }
  .dashboard-header h1 {
    margin-top: 0;
  }
  .dashboard-section {
    margin-bottom: 20px;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  }
  .dashboard-section h2 {
    margin-top: 0;
  }
  .dashboard-section ul {
    list-style-type: none;
    padding: 0;
  }
  .dashboard-section li {
    margin-bottom: 10px;
  }
</style>
</head>
<body>
<div class="container">
  <div class="dashboard-header">
  <h1>Welcome <?php 
            include 'current_user.php'; 
            echo $currentUser;
            ?></h1>
    <p>Your Dashboard</p>
  </div>

  <div class="dashboard-section">
    <h2>My Booking</h2>
    <ul>
      <li>
        <table>
        <?php
        include '../database/dbconnect.php';
        $sql="SELECT * FROM rent WHERE customer_id = '$uid'";
        $result=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($result);
        if($num>0){
          while($row=mysqli_fetch_assoc($result)){
            
          }
        }
        ?>
        </table>
      </li>
    </ul>
  </div>
  <div class="dashboard-section">
    <h2>Book Now</h2>
    <p>Book your next ride now!</p>
  </div>
</div>

</body>
</html>
