<?php
include '../database/dbconnect.php';
if($_GET['rental_id']){
    $r_id=$_GET['rental_id'];
}
$sql="UPDATE rent SET r_status='rejected' WHERE r_id='$r_id'";
$result=mysqli_query($conn,$sql);
header('Location:rental_request.php');
?>