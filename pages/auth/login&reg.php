<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../asset/css/lstyle.css">
</head>
<body>
    <div class="box">
        <h1>Sign Up</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="fname">Full Name</label>
            <input type="text" name="fname" id="fname" required>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            <label for="address">Address</label>
            <input type="text" name="address" id="address" required>
            <label for="contact">Contact</label>
            <input type="tel" name="contact" id="contact" pattern="[0-9]{10}" required>
            <label for="lpic">License Picture</label>
            <input type="file" name="lpic" id="lpic" accept="image/*" required>
            <label for="pass">Password</label>
            <input type="password" name="pass" id="pass" required>
            <input type="submit" name="register" value="Register">
            <label for="login">Already registered user? <button onclick="login()">Login</button></label>
        </form>
    </div>
    <script>
        function login(){
            window.location.href="login.php";
        }
    </script>
 <?php
 include '../database/dbconnect.php';
 if(isset($_POST['register'])){
    $fname=$_POST['fname'];
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $address=$_POST['address'];
    $contact=$_POST['contact'];
    $Picture = $_FILES['lpic']['name'];
    $temp = $_FILES['lpic']['tmp_name'];
    $folder = "../admin/pics/" . $Picture; move_uploaded_file($temp, $folder);
    $sql = "insert into customer(c_contact,c_name,c_address,c_email,c_password,license_picture) values('$contact','$fname','$address','$email','$pass','$folder')";
    $result = mysqli_query($conn, $sql); 
    if ($result) {
        echo "Registered successfully";
        } else {
        echo "cannot register"; }
    }
 
 ?>   
</body>
</html>