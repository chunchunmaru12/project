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
  /* Basic CSS for layout */
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
  }
  .container {
    max-width: 800px;
    margin: 20px auto;
    padding: 0 20px;
  }
  .gallery {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    grid-gap: 20px;
  }
  .bike {
    display: block;
    width: 100%;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
  }
  .bike:hover {
    transform: scale(1.05);
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
                $imageURL = $row["b_image"];
                $imageName= $row["b_name"];
                $rate= $row["b_rate"];
                ?>
            <div class="bike">  
                <img class="bike" src="<?php echo $imageURL;?>" alt="" style="width:100%;height:100%;object-fit:contain;">
                <p> <?php echo $imageName;?></p>
                <p>rate: Rs <?php echo $rate; ?>/hour</p>
             </div> 
            <?php }
        }
        ?>
    
  </div>
</div>

</body>
</html>
