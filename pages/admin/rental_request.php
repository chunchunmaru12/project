<?php
include 'admin_header.php'; 
include '../database/dbconnect.php';
$sql="SELECT * FROM rent ";
$result= mysqli_query($conn,$sql);
$num=mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        .main-content {
            max-width: 800px;
            margin: 20px auto;
             padding: 0 20px;
        }
        .rental-request {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            
        }
    </style>
</head>
<body>
    <div class="main-content">
        <h1>Rental Requests</h1>
        <?php if($num>0){
            while($row=mysqli_fetch_assoc($result)){
                ?>
                <div class="rental-request">
                    <p><strong>User Name:</strong> <?php echo $row['r_id']; ?></p>
                    <p><strong>Car Model:</strong> <?php echo $row['r_pickup_point']; ?></p>
                    <p><strong>Pickup Date:</strong> <?php echo $row['customer_id']; ?></p>
                    <p><strong>Return Date:</strong> <?php echo $row['bike_id']; ?></p>
                    <?php if ($row['r_status'] == 'approved'): ?>
                        <span>Approved</span>
                    <?php elseif ($row['r_status'] == 'rejected'): ?>
                        <span>Rejected</span>
                    <?php else: ?>
                        <a href="approval.php?rental_id=<?php echo $row['r_id']; ?>"><button>Approve</button></a>
                        <a href="rejection.php?rental_id=<?php echo $row['r_id']; ?>"><button>Reject</button></a>
                    <?php endif; ?>
                </div>
            <?php
            }
        } ?>  
    </div>

</body>
</html>