<?php include 'header.php';
include 'footer.php';
?>
<html lang="en">
<head>
    <title>Online Bike Rental System</title>
    <style>
        .main{
            display: flex;
            padding: 0px 20px;
            max-width: 100vw;
        }
        img{
            width: 40rem;
            height: 40rem;  
            transform: rotateY(180deg);
        }
        .text{
            width: 60rem;
            margin-top: 200px;
            padding:20px;
        }
        button{
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
        button:hover {
            background-color: rgb(69, 160, 73);
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="text">
            <h1>BIKE RENTAL</h1>
            <p>Experience the joy of riding a bike without the hassle of ownership. Join us at Online Bike Rental and embark on your next biking adventure today!</p>
            <button class="btn" onclick="go()">GET STARTED</button>
        </div>
            <img src="../asset/pic/33814530.jpg" alt="">
        </div>
    </div>
    <script>
        function go(){
            window.location.href="reg.php";
        }
    </script>
</body>
</html>