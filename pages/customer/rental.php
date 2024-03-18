
<?php
include '../database/dbconnect.php';
// SQL query to fetch bikes
$sql = "SELECT * FROM bike where b_status='available'";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);

?>
<body>
<div class="container">
        <h1>Rent a Bike</h1>
        <div class="gallery">
            <?php
            if ($num > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $imageURL = "../admin/" . $row["b_image"];
                    $imageName = htmlspecialchars($row["b_name"]);
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