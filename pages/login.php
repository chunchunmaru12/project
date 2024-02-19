<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../asset/css/lstyle.css">
</head>
<body>
    <div class="box"><h1>Login</h1>
    <form action="" method="post">
        <label for="mail">Email</label>
        <input type="email" name="mail" id="mail" required>
        <label for="pass">Password</label>
        <input type="password" name="pass" id="pass">
        <input type="submit" name="submit" value="Login">
    </form>
    </div>
<?php
include "../database/dbconnect.php";
if(isset($_POST['submit'])){
    $email = $_POST['mail'];
    $pass = $_POST['pass'];
    $sql = "SELECT * FROM admin WHERE a_email = '$email' AND a_password = '$pass'";
    $result=mysqli_query($conn,$sql);
    if($result){
        if (mysqli_num_rows($result) > 0) {
            header("Location: admin.php");
        } else {
           $ssql = "SELECT * FROM customer WHERE c_email = '$email' AND c_password = '$pass'";
           $rresult=mysqli_query($conn,$ssql);
           if($rresult){
                if(mysqli_num_rows($rresult)>0){
                    header("Location: user.php");
                }
           }echo "Invalid credentials";
        }
    }
}
?>
</body>
</html>