<?php
include 'admin_header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User and Rentals</title>
    <style>
        .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .box {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }
        h1{
            text-align: center;
        }
        h2 {
            margin-top: 0;
            text-align: center;
        }
        .users {
            width: auto;
            background-color: #f0f0f0;
        }
        .detail{
            margin: auto;
            border-collapse: collapse;
        }
        
    </style>
</head>
<body>
    <?php 
    include '../database/dbconnect.php';
   session_start();
   $name=$_SESSION['email'];
   $sql = "SELECT a_name FROM admin WHERE a_email = '$name'";
   $result = mysqli_query($conn,$sql);
   $num = mysqli_num_rows($result); 
   if($num>0){       
       while($row = mysqli_fetch_assoc($result)){
          
           ?>

    <div class="container">

   <h1>Welcome  <?php  echo $row['a_name'];
           }
        }  
        ?></h1>
        <div class="box users">
            <h2><i class="fa-solid fa-user"></i> Users</h2>
            <table class="detail" border="">
                <tr>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>License Photo</th>
                </tr>
                <?php 
                $sql= "SELECT * FROM customer";
                $result=mysqli_query($conn,$sql);
                $num=mysqli_num_rows($result);
                if($num>0){
                    while($row=mysqli_fetch_assoc($result)){
                ?>
                
                <tr>
                    <td><?php echo $row['c_name']; ?> </td>
                    <td><?php echo $row['c_contact']; ?></td>
                    <td><?php echo $row['c_address']; ?></td>
                    <td><?php echo $row['c_email']; ?></td>
                    <td><img src="<?php echo $row['license_picture']; ?>" alt="" style="width:200px;height:100px;object-fit:cover;"></td>
                    <?php    }
                }
                ?>
                </tr>
                
            </table>
        </div>
    </div>
</body>
</html>
