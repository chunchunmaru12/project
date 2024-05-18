<?php
include '../database/dbconnect.php';
if($_GET['rental_id']){
    $r_id=$_GET['rental_id'];
    $bike_id=$_GET['bike_id'];
    $customer_id=$_GET['customer_id'];
    $total=$_GET['amount'];
}
$sssql="UPDATE customer set is_rented=1 where c_id='$customer_id'";
$resu=mysqli_query($conn,$sssql);
$ssql="UPDATE bike set b_status='unavailable' where b_id='$bike_id'";
$res=mysqli_query($conn,$ssql);
$sql="UPDATE rent SET r_status='approved',is_returned = 0 WHERE r_id='$r_id'";
$result=mysqli_query($conn,$sql);
$Psql="insert into payment(p_amount,c_id) values('$total','$customer_id')";
$Presult=mysqli_query($conn,$Psql);

header('Location:rental_request.php');
?>