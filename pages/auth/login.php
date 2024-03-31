<?php
include 'header.php';
include 'footer.php';
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .box {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="file"],
        input[type="submit"],
        input[type="tel"],
        input[type="password"] {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        select {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        button {
            width: 60px;
            height: 40px;
        }
    </style>
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
                <option value="1">Admin</option>
                <option value="2">Customer</option>
            </select>
            <input type="submit" name="submit" value="Login">
            <label for="login">Not a registered user? <button onclick="login()">Register</button></label>
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
        session_start();
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