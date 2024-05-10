<?php
include 'admin_header.php'; 
include '../auth/footer.php';
include '../database/dbconnect.php';
include 'session.php';
include 'sidebar.php';
$sql="SELECT 
*
FROM rent JOIN customer ON rent.customer_id = customer.c_id JOIN bike ON rent.bike_id = bike.b_id
where rent.r_status='pending' or rent.r_status='approved' or rent.r_status='rejected'
;";
$result= mysqli_query($conn,$sql);
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
            background-color: #fff;
        }
        .bt{
            display: inline-block;
            padding: 10px 20px;
            background-color: rgb(76, 175, 80);
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        .bt:hover {
            background-color: rgb(69, 160, 73);
        }
        
    </style>
</head>
<body>
    <div class="main-content">
        <h1>Rental Requests</h1>
        <?php
            while($row=mysqli_fetch_assoc($result)){
                ?>
                <div class="rental-request">
                    <p><strong>User Name:</strong> <?php echo $row['c_name']; ?></p>
                    <p><strong>Bike Name:</strong> <?php echo $row['b_name']; ?></p>
                    <p><strong>Pickup Date:</strong> <?php echo $row['r_start_date']; ?></p>
                    <p><strong>Return Date:</strong> <?php echo $row['r_end_date']; ?></p>
                    <?php if ($row['r_status'] == 'approved'): ?>
                        <span>Approved</span>
                    <?php elseif ($row['r_status'] == 'rejected'): ?>
                        <span>Rejected</span>
                    <?php else: ?>
                        <a href="approval.php?rental_id=<?php echo $row['r_id'];?>&bike_id=<?php echo $row['b_id'];?>&customer_id=<?php echo $row['c_id']; ?>"><button class="bt">Approve</button></a>
                        <a href="rejection.php?rental_id=<?php echo $row['r_id']; ?>&bike_id=<?php echo $row['b_id'];?>"><button class="bt">Reject</button></a>
                    <?php endif; ?>
                </div>
            <?php
            }
         ?>  
    </div><br><br>
</body>
</html>