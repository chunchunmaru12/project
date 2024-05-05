<?php
include 'current_user.php';
include 'customer_header.php';
include '../database/dbconnect.php';
include 'sidebar.php';

$sql = "SELECT r.*, b.b_name 
        FROM rent r 
        JOIN bike b ON r.bike_id = b.b_id
        WHERE r.customer_id ='$uid'
        
        ";

$result = mysqli_query($conn, $sql);
$pendingBookings = [];
$activeBookings = [];
$cancelledBookings = [];

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    if ($row['r_status'] == 'pending') {
      $pendingBookings[] = $row;
    } elseif ($row['r_status'] == 'approved') {
      $activeBookings[] = $row;
    } elseif ($row['r_status'] == 'rejected') {
      $cancelledBookings[] = $row;
    }
  }
}
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
          foreach ($pendingBookings as $booking) {
            echo $booking['b_name'];
            ?><button><a href="cancel.php?r_id=<?php echo $booking['r_id']; ?>&b_id=<?php echo $booking['bike_id'] ?>">Cancel</a></button>
          <?php }
          ?>
          
        </li>
      </ul>
    </div>

    <div class="booking-status">
      <h2>Active Bookings</h2>
      <ul class="booking-list">
        <li class="booking-item completed">
          <?php
          foreach ($activeBookings as $booking) {
            echo
            $booking['b_name'] . '<br>' .
              'From: ' . $booking['r_pickup_point'] . ' ' . $booking['r_start_date'] . ' ' . $booking['r_pickup_time'] . '<br>' .
              'To:  ' . $booking['r_drop_off_time'] . ' ' . $booking['r_end_date'] . '<br>' .
              'Total rent: Rs ' . $booking['total_amount'];
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
          $bikeNames = array_column($cancelledBookings, 'b_name');

          // Remove duplicates
          $uniqueBikeNames = array_unique($bikeNames);

          // Output the unique bike names
          foreach ($uniqueBikeNames as $bikeName) {
            echo $bikeName;
            echo '<br>';
          }
          ?>


        </li>
      </ul>
    </div>
  </div>

</body>

</html>