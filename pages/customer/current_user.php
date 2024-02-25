<?php
include '../database/dbconnect.php';
session_start();
$user=$_SESSION['email'];
$sql = "SELECT * FROM customer WHERE c_email = '$user'";
$result = mysqli_query($conn,$sql);
$num = mysqli_num_rows($result);
$row=mysqli_fetch_assoc($result);
$currentUser=$row['c_name'];
$uid = $row['c_id'];
?>