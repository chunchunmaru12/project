<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
            top:25;
            display: block;
            background-color: white;
        }
        .header{
            position: fixed;
            width: 99.5%;
            background-color: white;
            padding: 5px;
        }
        .btn{
            background: rgba(43, 46, 74, 0.2);
            border: 1px solid #000000;
            border-radius: 50px;

        }
        .btn:hover{
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="header">
        <i class="fa-brands fa-gratipay"></i> Online bike rental system
        <div class="right"><a href="admin_dashboard.php">Dashboard</a>
            <a href="admin.php">Bike</a>
            <a href="rental_request.php">Rentals</a>
            <div > <button class="btn" onclick="newList()">Create new listing</button></div>
            <div class="profile-container">
            <i class="fa-solid fa-user"></i>
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