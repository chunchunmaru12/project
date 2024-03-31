
<?php
// Start the session
session_start();

// Check if the admin is logged in
if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    // Unset admin session variables
    $_SESSION['admin'] = false;
    // Destroy admin session
    unset($_SESSION['admin']); 
}
// Check if the user is logged in
if (isset($_SESSION['user']) && $_SESSION['user'] === true) {
    // Unset user session variables
    $_SESSION['user'] = false;
    // Destroy user session
    unset($_SESSION['user']);
}
// Redirect to the login page with a logout message
header("Location: login.php");
exit();
?>
