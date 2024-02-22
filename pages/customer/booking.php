<?php
include 'customer_header.php';
?><br>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
  } 
  .cont {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  }
  h1, h2 {
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
    border-left: 5px solid #ffc107; /* Yellow */
  }
  .booking-item.completed {
    border-left: 5px solid #28a745; /* Green */
  }
  /* .booking-item.cancelled {
    border-left: 5px solid #dc3545; /* Red */
 /* } */
    </style>
</head>
<body>
</div>

<div class="cont">
  <h1>Booking Status</h1>

  <div class="booking-status">
    <h2>Pending Bookings</h2>
    <ul class="booking-list">
      <li class="booking-item pending"></li>
    </ul>
  </div>

  <div class="booking-status">
    <h2>Completed Bookings</h2>
    <ul class="booking-list">
      <li class="booking-item completed"></li>
    </ul>
  </div>

  <!-- <div class="booking-status">
    <h2>Cancelled Bookings</h2>
    <ul class="booking-list">
      <li class="booking-item cancelled"></li>
    </ul>
  </div> -->
</div>
</body>
</html>