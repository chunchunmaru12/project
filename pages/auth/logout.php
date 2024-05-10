<?php
session_start();

if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
    $_SESSION['admin'] = false;
    unset($_SESSION['admin']); 
}
if (isset($_SESSION['user']) && $_SESSION['user'] == true) {
    $_SESSION['user'] = false;
    unset($_SESSION['user']);
}
header("Location: login.php");
exit();
?>
