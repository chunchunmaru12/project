<!DOCTYPE html>
<html lang="en">
<head>
    <style>
       
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 200px;
            height: 100%;
            background-color: #333;
            padding-top:26px;
            margin-top: 26px;
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
        <li><a href="admin_dashboard.php" class="sd">Home</a></li>
        <li><a href="admin.php" class="sd">Bike</a></li>
        <li><a href="rental_request.php" class="sd">Requests</a></li>
        
    </ul>
</div>

</body>
</html>
