<?php
include 'customer_header.php'

?><br><br><br>
<!DOCTYPE html>
<html lang="en">
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
   
  </div>

  <a href="book.php"><div class="dashboard-section">
    <p>Book your ride now!</p>
    <h2>Book Now</h2>
  </div></a>
</div>

</body>
</html>
