<?php
include 'admin_header.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>
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
        <?php
        $sql = "SELECT * FROM bike";
        $result= mysqli_query($conn,$sql);
        $num = mysqli_num_rows($result);
        if($num>0){
            while($row = mysqli_fetch_assoc($result)){
                $imageURL = $row["b_image"];
                $imageName= $row["b_name"];
                $rate= $row["b_rate"];
            }
        }
        ?>
        <img src="<?php echo $imageURL;?>" alt="" style="width:200px;">
        <p><?php echo $imageName;?></p>
        <p>rate: Rs <?php echo $rate; ?>/hour</p>
    </div>
        <div class="request">
        </div>
        
    </section>
</body>
</html>