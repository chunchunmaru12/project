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
            background-color: rgb(240, 240, 240);
        }

        a {
            text-decoration: none;
            color: black
        }

        .header {
            position: fixed;
            width: 1450px;
            background-color: white;
        }

        .right {
            display: flex;
            float: right;
            gap: 40px;
        }

        .profile-img {
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
    </style>
</head>
<body>
    <div class="header">
        <i class="fa-brands fa-gratipay"></i> Online bike rental system
        <div class="right">
            <a href="customer_dashboard.php">Dashboard</a>
            <a href="customer_detail.php">Account</a>
            <a href="booking.php">My Booking</a>
            <div class="btn"><button onclick="book()">Book Now</button></div>
            <div class="profile-container">
                <a href="customer_detail.php"><img src="../asset/pic/1.png" alt="Profile Picture" class="profile-img" id="profile-img"></a>
                <div class="logout" id="logout"><a href="../auth/logout.php">Logout</a></div>
            </div>
        </div>
    </div>
    <script>
        function book() {
            window.location.href = "book.php";
        }
    </script>
    <br>
</body>

</html>