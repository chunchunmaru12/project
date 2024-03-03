
<!DOCTYPE html>
<html lang="en">
<?php
include 'customer_header.php';
include 'sidebar.php';  

?>
<head>
  <title>Customer Dashboard</title>
  <style>
    .cont {
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
      width: 395px;
      height: 200px;
      object-fit: cover;
    }

    .text {
      text-align: center;
    }

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

    include '../auth/footer.php';
    ?>
  </div>

</body>

</html>
