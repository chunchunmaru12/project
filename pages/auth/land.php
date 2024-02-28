<?php include 'header.php'; ?>
<html lang="en">
<head>
    <title>Online Bike Rental System</title>
    <style>
        .main{
            display: flex;
            padding: 0px 20px;
        }
        img{
            width: 45rem;
            height: 45rem;  
            transform: rotateY(180deg);
        }
        .text{
            width: 60rem;
            margin-top: 200px;
            padding:20px;
        }
        
    </style>
</head>
<body>
    <div class="main">
        <div class="text">
            <h1>BIKE RENTAL</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam facere nulla quisquam, ratione delectus praesentium adipisci ex dignissimos velit dolore, unde iusto nam corrupti deleniti ab blanditiis exercitationem accusantium assumenda!</p>
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