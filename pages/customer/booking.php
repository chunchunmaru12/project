<?php
include 'current_user.php';
include 'customer_header.php';
include '../database/dbconnect.php';
include 'sidebar.php';
?>
<html lang="en">

<head>
  <title>Document</title>
  <style>
    .cont {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    h1,
    h2 {
      margin-top: 0;
    }

    .booking-status {
      margin-bottom: 20px;
    }

    .booking-status h2 {
      margin-bottom: 10px;
    }

    .booking-list {
      list-style-type: none;
      padding: 0;
    }

    .booking-item {
      margin-bottom: 20px;
      padding: 20px;
      background-color: #f9f9f9;
      border-radius: 5px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .booking-item.pending {
      border-left: 5px solid #ffc107;
      /* Yellow */
    }

    .booking-item.completed {
      border-left: 5px solid #28a745;
      /* Green */
    }

    .booking-item.cancelled {
      border-left: 5px solid #dc3545;
      /* Red */
    }
  </style>
</head>

<body>
  </div>

  <div class="cont">
    <h1>Booking Status</h1>

    <div class="booking-status">
      <h2>Pending Bookings</h2>
      <ul class="booking-list">
        <li class="booking-item pending">
          <?php

          $sql = "SELECT * FROM rent WHERE customer_id ='$uid'";
          $result = mysqli_query($conn, $sql);
          $num = mysqli_num_rows($result);

          if ($num > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              if ($row['r_status'] == 'pending') {
                $bid = $row['bike_id'];
                $ssql = "SELECT * from bike where b_id = '$bid'";
                $rresult = mysqli_query($conn, $ssql);
                $nnum = mysqli_num_rows($rresult);
                $rrow = mysqli_fetch_assoc($rresult);
                echo $rrow['b_name'];
              }
            }
          }
          ?>
        </li>
      </ul>
    </div>

    <div class="booking-status">
      <h2>Completed Bookings</h2>
      <ul class="booking-list">
        <li class="booking-item completed">
          <?php
          $sql = "SELECT * FROM rent WHERE customer_id ='$uid'";
          $result = mysqli_query($conn, $sql);
          $num = mysqli_num_rows($result);
          if ($num > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              if ($row['r_status'] == 'approved') {
                $bid = $row['bike_id'];
                $ssql = "SELECT * from bike where b_id = '$bid'";
                $rresult = mysqli_query($conn, $ssql);
                $nnum = mysqli_num_rows($rresult);
                $rrow = mysqli_fetch_assoc($rresult);
                echo $rrow['b_name'];
                echo "<br>";
                echo "From: ".$row['r_pickup_point'];
                echo " ".$row['r_pickup_time'];
                echo "<br>";
                echo "To: ".$row['r_drop_off_point'];
                echo " ".$row['r_drop_off_time'];
              }
            }
          }
          ?>
        </li>
  
      </ul>
    </div>
    <div class="booking-status">
      <h2>Cancelled Bookings</h2>
      <ul class="booking-list">
        <li class="booking-item cancelled">
          <?php
          $sql = "SELECT * FROM rent WHERE customer_id ='$uid'";
          $result = mysqli_query($conn, $sql);
          $num = mysqli_num_rows($result);
          if ($num > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              if ($row['r_status'] == 'rejected') {
                $bid = $row['bike_id'];
                $ssql = "SELECT * from bike where b_id = '$bid'";
                $rresult = mysqli_query($conn, $ssql);
                $nnum = mysqli_num_rows($rresult);
                $rrow = mysqli_fetch_assoc($rresult);
                echo $rrow['b_name'];
                echo "<br>";
                
              }
            }
          }
          ?>
        </li>
      </ul>
    </div>
  </div>
</body>

</html>