<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/0f0259d364.js" crossorigin="anonymous"></script>
    <style>
        a{
            text-decoration: none;
            color:black
        }

        .right{
            display: flex;
            float: right;
            gap:20px;
        }
        img{
            width: 20px;
        }
        section{
            display: flex;
            justify-content: center;
            align-items: center; 
            gap:20px;
        }
        .request{
            width: 200px;
            height: 200px;
            border: 2px solid black;
        }
        .bikes{
            width: 200px;
            height: 200px;
            border: 2px solid black;
        }
        h1{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <i class="fa-brands fa-gratipay"></i>  Online bike rental system
            <div class="right"><a href="#">Dashboard</a>
            <a href="#">Bike</a>
            <a href="#">Rentals</a>
            <a href="#">Users</a>
          <div class="btn"> <button>Create new listing</button></div> 
          <a href="#"><img src="../asset/pic/1.png" alt=""></a>
        </div>
    </div>
    <h1>Welcome <?php 
    include '../database/dbconnect.php';
    session_start();
    $name=$_SESSION['email'];
    $sql = "SELECT a_name FROM admin WHERE a_email = '$name'";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result); 
    if($num>0){
        while($row = mysqli_fetch_assoc($result)){
            echo $row['a_name'];
        }
    }
    
    ?> </h1>
    <section>
    <div class="bikes">
        
    </div>
        <div class="request">
        </div>
        
    </section>
</body>
</html>