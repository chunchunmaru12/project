<?php
include 'header.php';
include 'footer.php';
session_start();
if(isset($_SESSION['admin'])){
    header("Location: ../admin/admin_dashboard.php");
}
if(isset($_SESSION['user'])){
    header("Location: ../customer/customer_dashboard.php");
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>

<body>
    <div class="box">
        <h1>Login</h1>
        <form action="" method="post">
            <label for="mail">Email</label>
            <input type="email" name="mail" id="mail" required>
            <label for="pass">Password</label>
            <input type="password" name="pass" id="pass">
            <select name="usertype">
                <option value="2">Customer</option>
                <option value="1">Admin</option>
            </select>
            <input type="submit" name="submit" value="Login">
            <label for="login">Not a registered user? <button class="bu" onclick="login()">Register</button></label>
        </form>
    </div>
    <script>
        function login() {
            window.location.href = "reg.php";
        }
    </script>
    <?php
    include "../database/dbconnect.php";
    if (isset($_POST['submit'])) {
        
        $usertype = $_POST['usertype'];
        $email = $_POST['mail'];
        $pass = $_POST['pass'];
        if ($usertype == 1) {
            $sql = "SELECT * FROM admin WHERE a_email = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "SQL statement failed!";
            } else {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if ($row = mysqli_fetch_assoc($result)) {
                    $passwordHash = $row['a_password'];
                    if (password_verify($pass, $passwordHash)){
                        $_SESSION['admin'] = $email;
                        $_SESSION['admin_logged']=true;
                        header("Location: ../admin/admin_dashboard.php");
                        exit();
                    } else {
                        echo "<script>alert('Invalid Password')</script>";
                    }
                } else {
                    echo "<script>alert('Invalid Credentials')</script>";
                }
            }
        } else if ($usertype == 2) {
            $sql = "SELECT * FROM customer WHERE c_email = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "SQL statement failed!";
            } else {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if ($row = mysqli_fetch_assoc($result)) {
                    $passwordHash = $row['c_password'];
                    if (password_verify($pass, $passwordHash)) {
                        $_SESSION['user'] = $email;
                        $_SESSION['user_logged']=true;
                        header("Location: ../customer/customer_dashboard.php");
                        exit();
                    } else {
                        echo "<script>alert('Invalid Password')</script>";
                    }
                } else {
                    echo "<script>alert('Invalid Credentials')</script>";
                }
            }
        }
    }
    ?>
</body>

</html>