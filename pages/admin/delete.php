<?php
include '../database/dbconnect.php';
if($_GET['bike_id']){
    $bike_id=$_GET['bike_id'];
}
$sql="DELETE FROM bike WHERE b_id='$bike_id'";
$result=mysqli_query($conn,$sql);
if($result){
    header('Location: admin.php');
}
?>