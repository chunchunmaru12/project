<?php
include 'admin_header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add New Bike Listing</title>
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
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  form {
    display: grid;
    grid-gap: 10px;
  }
  label {
    font-weight: bold;
  }
  input[type="text"],
  input[type="number"],
  input[type="file"] {
    width: 100%;
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc;
  }
  input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
  }
</style>
</head>
<body>

<div class="container">
  <h1>Add New Bike</h1>
  <form method="post" enctype="multipart/form-data">
    <label for="b_name">Bike Name:</label>
    <input type="text" id="b_name" name="b_name" required>
    <label for="b_brand">Bike Brand:</label>
    <input type="text" id="b_brand" name="b_brand" required>
    <label for="b_color">Bike Color:</label>
    <input type="text" id="b_color" name="b_color" required>
    <label for="b_rate">Bike Rate:</label>
    <input type="number" id="b_rate" name="b_rate" required>
    <label for="b_image">Bike Image :</label>
    <input type="file" id="b_image" name="b_image" accept="image/*" required>
    <input type="submit" name="submit" value="Add Listing">
  </form>
</div>
<?php
include '../database/dbconnect.php';
if(isset($_POST['submit'])){
    $b_name = $_POST['b_name'];
    $b_brand = $_POST['b_brand'];
    $b_color = $_POST['b_color'];
    $b_rate = $_POST['b_rate'];
    $Picture = $_FILES['b_image']['name'];
    $temp = $_FILES['b_image']['tmp_name'];
    $folder = "pics/" . $Picture; 
    move_uploaded_file($temp, $folder);
    $sql="INSERT INTO bike(b_name, b_brand, b_image,b_color,b_rate,b_status) VALUES('$b_name','$b_brand','$folder','$b_color','$b_rate',1)";
    $result=mysqli_query($conn,$sql);
    if($result){
        header('Location: admin.php');
    }
}
?>

</body>
</html>
