<?php
include '../database/dbconnect.php';

if(isset($_GET['r_id']) && isset($_GET['b_id'])){
    $rid = $_GET['r_id'];
    $bid = $_GET['b_id'];
    $sql = "UPDATE rent SET r_status='rejected' WHERE r_id='$rid'";
    $result = mysqli_query($conn, $sql);
    $ssql = "UPDATE bike SET b_status='available' WHERE b_id='$bid'";
    $res = mysqli_query($conn, $ssql);
    header("Location: booking.php");
    exit();
} else {
    echo "Error";
}
?>
