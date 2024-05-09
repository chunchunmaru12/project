<?php
$folderPath = '/path/to/your/folder/';
include 'session.php';
$user = $_SESSION['admin']; // Assuming you have user authentication and session management

// Check if the user has access to the folder
if (userHasAccess($user, $folderPath)) {
    // User has access, serve the content
    // For example, display a list of files in the folder
    $files = scandir($folderPath);
    foreach ($files as $file) {
        echo $file . "<br>";
    }
} else {
    // User doesn't have access, deny access
    echo "Access Denied";
}

function userHasAccess($user, $folderPath) {
    // Perform your logic to determine if the user has access
    // For example, you can check against a whitelist of allowed users or user roles
    // This is a basic example, you may need to adjust it based on your specific requirements
    $allowedUsers = ['admin', 'user1', 'user2'];
    return in_array($user, $allowedUsers) && is_readable($folderPath);
}
?>
