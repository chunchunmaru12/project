<?php
include 'session.php';
include '../database/dbconnect.php';
if(isset($_GET['bike_id']) && $_SESSION['admin']){
    $bike_id = $_GET['bike_id'];

    // Check if the user confirmed deletion
    if(isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
        // Perform deletion
        $sql = "DELETE FROM bike WHERE b_id='$bike_id'";
        $result = mysqli_query($conn, $sql);
        if($result){
            
            header('Location: admin.php');
            exit(); 
        }
    } else {
        
        // Ask for confirmation
        echo "<script>
                if(confirm('Are you sure you want to remove this bike?')) {
                    window.location.href = 'delete.php?bike_id=$bike_id&confirm=true'; // Confirm deletion
                } else {
                    window.location.href = 'admin.php'; // Cancel deletion
                }
              </script>";
    }
}
?>
