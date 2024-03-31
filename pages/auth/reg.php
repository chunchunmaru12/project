<?php
include 'header.php';
include 'footer.php';
include '../database/dbconnect.php';

if (isset($_POST['register'])) {
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $hashPasskey = password_hash($_POST['pass'], PASSWORD_BCRYPT);
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $Picture = $_FILES['lpic']['name'];
    $temp = $_FILES['lpic']['tmp_name'];
    $folder = "../admin/pics/" . $Picture;
    move_uploaded_file($temp, $folder);
    try {
        // Using prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO customer(c_contact, c_name, c_address, c_email, c_password, license_picture) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $contact, $fname, $address, $email, $hashPasskey, $folder);
        
        if ($stmt->execute()) {
            echo '<script>alert("Registered successfully"); window.location.href = "login.php"</script>';
        } 
        $stmt->close();
    } catch (Exception $e) {
        echo '<script>alert("Cannot register: User already exists ");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

       
    </style>
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
           
        </form>
    </div>

</body>

</html>