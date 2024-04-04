
<?php
include '../database/dbconnect.php';
// SQL query to fetch bikes
$sql = "SELECT * FROM bike where b_status='available'";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);

?>
<style>  
   .cont {
      max-width: 800px;
      margin: 20px auto;
    }

    .gallery {
      display: grid;
      grid-template-columns: auto auto;
      grid-gap: 30px;
      background-color: #f0f0f0;
    }

    .bikeImg {
      border-radius: 5px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
      width: 395px;
      height: 200px;
      object-fit: cover;
    }

    .text-p{
            text-align: center;
        }

    

</style>
<body>
<div class="cont">
        <h1>Rent a Bike</h1>
        <div class="gallery">
            <?php
            if ($num > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $imageURL = "../admin/" . $row["b_image"];
                    $imageName =$row["b_name"];
                    $rate = $row["b_rate"];
                    ?>
                    <div class="bike">
                        <a href="bikes.php?bike_id=<?php echo $row['b_id']; ?>">
                            <img class="bikeImg" src="<?php echo $imageURL; ?>" alt="<?php echo $imageName; ?>">
                            <div class="text">
                                <p><?php echo $imageName; ?></p>
                                <p>Rate: Rs <?php echo $rate; ?>/hour</p>
                            </div>
                        </a>
                        
                    </div>
                    <?php
                }
            } else {
                echo "No bikes found.";
            }
            ?>
        </div>
    </div>
</body>
</html>