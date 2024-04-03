<!DOCTYPE html>
<html lang="en">
<head>
    <style>
       
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 150px;
            height: 100%;
            background-color: #333;
            padding-top:26px;
            margin-top: 30px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            padding: 10px;
            color: #fff;
            cursor: pointer;
            
        }

        .sidebar ul li:hover {
            background-color: #555;
        }
        .sd{
            text-decoration: none;
            color:white;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <ul>
        <a href="customer_dashboard.php" class="sd"><li>Home</li></a>
        <a href="customer_detail.php" class="sd"><li>Account</li></a>
        <a href="booking.php" class="sd"><li>Bookings</li></a>
        
    </ul>
</div>

</body>
</html>