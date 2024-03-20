
<!DOCTYPE html>
<html lang="en">
<?php
include 'customer_header.php';
include 'sidebar.php';  
?>
<head>
  <title>Customer Dashboard</title>
  <style>
   
    .container {
      max-width: 800px;
      margin: 20px auto;
      text-align: center;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
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

    </div>
    <a href="book.php">
      <div class="dashboard-section">
        <p>Book your ride now!</p>
        <h2>Book Now</h2>
      </div>
    </a>
  </div>
  <div class="bikes">
    <?php

    include 'rental.php';

    ?>
  </div>

</body>

</html>


