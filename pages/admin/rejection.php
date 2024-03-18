<?php
include '../database/dbconnect.php';
if($_GET['rental_id']){
    $r_id=$_GET['rental_id'];
    $b_id=$_GET['bike_id'];
}
$ssql="UPDATE bike set b_status='available' where b_id='$b_id'";
$res=mysqli_query($conn,$ssql);
$sql="UPDATE rent SET r_status='rejected' WHERE r_id='$r_id'";
$result=mysqli_query($conn,$sql);
header('Location:rental_request.php');
?>