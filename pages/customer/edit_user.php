<?php
include 'customer_header.php';
include 'current_user.php';
include 'sidebar.php';
$uid=$_GET['uid'];
if (isset($_POST['submit'])) {
    $name = $_POST['c_name'];
    $contact = $_POST['c_contact'];
    $address = $_POST['c_address'];
    $email = $_POST['c_email'];
    $updateSql = "UPDATE customer SET c_name='$name', c_contact='$contact', c_address='$address', c_email='$email' WHERE c_id='$uid'";
    if (mysqli_query($conn, $updateSql)) {
        echo '<script>
    alert("User details updated successfully!");
    window.location.href = "customer_detail.php";</script>';

    } else {
        echo '<script>alert("Error updating user details: ' . mysqli_error($conn) . '");</script>';
    }
}
$sql = "SELECT * FROM customer WHERE c_id='$uid'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Details</title>
    <style>
        .edit-user {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        form {
            margin-top: 20px;
        }

        label,
        input {
            display: block;
            width: 100%;
            margin-bottom: 15px;
        }

        .buton {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .buton:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="edit-user">
        <h1>Edit User Details</h1>
        <form  method="post">
            <label for="c_name">User Name:</label>
            <input type="text" id="c_name" name="c_name" value="<?php echo $row['c_name']; ?>" required>

            <label for="c_contact">Contact Detail:</label>
            <input type="text" id="c_contact" name="c_contact" value="<?php echo $row['c_contact']; ?>" required>

            <label for="c_address">Address:</label>
            <input type="text" id="c_address" name="c_address" value="<?php echo $row['c_address']; ?>" required>

            <label for="c_email">Email:</label>
            <input type="email" id="c_email" name="c_email" value="<?php echo $row['c_email']; ?>" required>

            <input type="submit" class="buton" value="Update" name="submit">
        </form>
    </div>
</body>

</html>
