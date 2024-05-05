<?php
include '../database/dbconnect.php';
if($_GET['r_id']){
    $rid=$_GET['r_id'];
    $bid=$_GET['b_id'];
}
$sql="UPDATE rent set r_status='rejected' where r_id='$rid'";
$result=mysqli_query($conn,$sql);
$ssql="UPDATE bike set b_status='available' where b_id='$bid'";
$res=mysqli_query($conn,$ssql);

?>