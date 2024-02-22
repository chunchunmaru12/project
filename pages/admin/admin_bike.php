<?php
include 'admin_header.php';
include '../database/dbconnect.php';
if($_GET['bike_id']){
  $bike_id=$_GET['bike_id'];
}
$sql = "SELECT * FROM bike where b_id = '$bike_id' ";
$result= mysqli_query($conn,$sql);
$num = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result)
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Bike Details</title>
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
    padding: 0 20px;
  }
  .bike-form {
    margin-bottom: 20px;
    padding: 10px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  }
  .bike-form label {
    font-weight: bold;
  }
  .bike-form input[type="text"],
  .bike-form input[type="number"] {
    width: 100%;
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc;
  }
  .bike-form input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
  }
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }
  input[type=number]{
    -moz-appearance: textfield;
    }
</style>
</head>
<body>

<div class="container">
  <h1>Edit Bike Details</h1>
  
    <div class="bike-form">
    <form action="" method="post">
        <label for="b_name">Bike Name:</label>
        <input type="text" id="b_name" name="b_name" value="<?php echo $row['b_name']; ?>" required>
        <label for="b_brand">Bike Brand:</label>
        <input type="text" id="b_brand" name="b_brand" value="<?php echo $row['b_brand']; ?>" required>
        <label for="b_color">Bike Color:</label>
        <input type="text" id="b_color" name="b_color" value="<?php echo $row['b_color']; ?>" required>
        <label for="b_rate">Bike Rate:</label>
        <input type="number"  id="b_rate" name="b_rate" value="<?php echo $row['b_rate']; ?>" required>
        <input type="submit" name="submit" value="Update" >
      </form>
    </div>
</div>
<?php
if(isset($_POST['submit'])){
  $b_name = $_POST['b_name'];
  $b_brand = $_POST['b_brand'];
  $b_color = $_POST['b_color'];
  $b_rate = $_POST['b_rate'];
  $sql="UPDATE bike SET b_name = '$b_name', b_brand = '$b_brand', b_color = '$b_color', b_rate = '$b_rate' WHERE b_id = '$bike_id'";
  $result=mysqli_query($conn,$sql);
  if($result){
    header('Location: admin.php');
  }
}

?>
</body>
</html>
