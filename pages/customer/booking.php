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
$historyBookings = [];

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    if ($row['r_status'] == 'pending') {
      $pendingBookings[] = $row;
    } elseif ($row['r_status'] == 'approved') {
      $activeBookings[] = $row;
    } elseif ($row['r_status'] == 'rejected') {
      $cancelledBookings[] = $row;
    } elseif ($row['r_status'] == 'returned') {
      $historyBookings[] = $row;
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
    }

    .booking-item.completed {
      border-left: 5px solid #28a745;

    }

    .booking-item.cancelled {
      border-left: 5px solid #dc3545;

    }

    .booking-item.history {
      border-left: 5px solid grey;

    }

    @media print {

      button {
        display: none;
      }

      body {
        font-family: Arial, sans-serif;
        font-size: 12px;
      }

      .cont {
        max-width: none;
        margin: 0 auto;
        padding: 0;
        box-shadow: none;
        border-radius: 0;
      }

      .booking-status {
        margin-bottom: 20px;
      }

      .booking-item {
        margin-bottom: 20px;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 5px;
        box-shadow: none;
        border-left: none;
      }
      .print-only {
        display: none;
      }
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
          ?><br><button onclick="confirmCancellation(<?php echo $booking['r_id']; ?>, <?php echo $booking['bike_id']; ?>)">Cancel</button>
          <?php }
          ?>

        </li>
      </ul>
    </div>

    <div class="booking-status">
      <h2>Active Bookings</h2>
      <ul class="booking-list">
        <li class="booking-item completed" id="active-booking">
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
        <button class="print-only" onclick="printBill()">Print Bill</button>
      </ul>
    </div>
    <div class="booking-status">
      <h2>Cancelled Bookings</h2>
      <ul class="booking-list">
        <li class="booking-item cancelled">
          <?php
          $bikeNames = array_column($cancelledBookings, 'b_name');
          $uniqueBikeNames = array_unique($bikeNames);
          foreach ($uniqueBikeNames as $bikeName) {
            echo $bikeName;
            echo '<br>';
          }
          ?>
        </li>
      </ul>
    </div>
    <div class="booking-status">
      <h2>Booking History</h2>
      <ul class="booking-list">
        <li class="booking-item history">
          <?php
          $bikeNames = array_column($historyBookings, 'b_name');
          // Output the unique bike names
         foreach ($bikeNames as $bikeName) {
            echo $bikeName;
            echo '<br>';
          }
          ?>
        </li>
      </ul>
    </div>
  </div>
  <script>
    function printBill() {
      var printContents = document.getElementById("active-booking").innerHTML; // Get content of active booking
      var originalContents = document.body.innerHTML; // Save original content of the page
      document.body.innerHTML = printContents; // Set content to be printed
      window.print(); 
      document.body.innerHTML = originalContents; // Restore original content after printing
    }
    function confirmCancellation(rid, bid) {
    var confirmCancel = confirm("Are you sure you want to cancel this booking?");
    if (confirmCancel) {
        window.location.href = "cancel.php?r_id=" + rid + "&b_id=" + bid;
    }
}
  </script>

</body>

</html>