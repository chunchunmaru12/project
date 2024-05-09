<?php
session_start();
$a_id=$_SESSION['admin'];
if(!isset($_SESSION['admin'])){
    header("Location: ../auth/login.php");
}
?>