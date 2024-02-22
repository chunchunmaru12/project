<?php
include 'customer_header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bike Gallery</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
  }
  .container {
    max-width: 800px;
    margin: 20px auto;
   
  }
  .gallery{
    display: grid;
    grid-template-columns: auto auto; /* Two columns with auto sizing */
    grid-gap: 30px; /* Gap between grid items */
    background-color: #f0f0f0;

  }
  .text {
    text-align: center;
  }
  .bike {
    border-radius: 5px;
    
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);

  }
</style>
</head>
<body>
<br>
<div class="container">
  <h1>Rent a Bike </h1>
  <div class="gallery">
    <?php
    include '../database/dbconnect.php';
    $sql = "SELECT * FROM bike";
        $result= mysqli_query($conn,$sql);
        $num = mysqli_num_rows($result);
        if($num>0){
            while($row = mysqli_fetch_assoc($result)){
                $imageURL = "../admin/".$row["b_image"];
                $imageName= $row["b_name"];
                $rate= $row["b_rate"];
           ?><td>
            <div class="bike">  
                <a href="bikes.php?bike_id=<?php echo $row['b_id'] ?>"><img class="bike" src="<?php echo $imageURL;?>" alt="" style="width:400px;height:100px;object-fit:cover ;">
                <div class="text"> <p> <?php echo $imageName;?></p>
                <p>rate: Rs <?php echo $rate; ?>/hour</p></a>
                </div>
             </div> 
            <?php }
        }
        ?>
    
  </div>
</div>

</body>
</html>
