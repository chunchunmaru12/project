<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/0f0259d364.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        a {
            text-decoration: none;
            color: black
        }

        .right {
            display: flex;
            float: right;
            gap: 20px;
        }

        img {
            width: 20px;
        }

        .logout {
            position: absolute;
            border: 1px solid black;
            border-radius: 2px;
            padding: 2px;
            display: none;
        }

        .profile-container:hover .logout {
            right: 0;
            display: block;
        }
        .header{
            position: fixed;
            width: 1450px;
            background-color: white;
        }
    </style>
</head>

<body>
    <div class="header">
        <i class="fa-brands fa-gratipay"></i> Online bike rental system
        <div class="right"><a href="admin_dashboard.php">Dashboard</a>
            <a href="admin.php">Bike</a>
            <a href="rental_request.php">Rentals</a>
            <div class="btn"> <button onclick="newList()">Create new listing</button></div>
            <div class="profile-container">
                <img src="../asset/pic/1.png" alt="Profile Picture" class="profile-img" id="profile-img">
                <div class="logout" id="logout"><a href="../auth/logout.php">Logout</a></div>
            </div>
        </div>
    </div>
    <script>
        function newList() {
            window.location.href = "admin_listing.php";
        }
    </script>
    <br>
</body>

</html>