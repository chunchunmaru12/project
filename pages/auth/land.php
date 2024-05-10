<?php include 'header.php';
include 'footer.php';
session_start();
if(isset($_SESSION['admin'])){
    header("Location: ../admin/admin_dashboard.php");
}
if(isset($_SESSION['user'])){
    header("Location: ../customer/customer_dashboard.php");
}
?>
<html lang="en">
<head>
    <title>Online Bike Rental System</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>
<body>
    <div class="main">
        <div class="text">
            <h1>BIKE RENTAL</h1>
            <p>Experience the joy of riding a bike without the hassle of ownership. Join us at Online Bike Rental and embark on your next biking adventure today!</p>
            <button class="btn" onclick="go()">GET STARTED</button>
        </div>
            <img src="../asset/pic/33814530.jpg" alt="">
        </div>
    </div>
    <script>
        function go(){
            window.location.href="reg.php";
        }
    </script>
</body>
</html>