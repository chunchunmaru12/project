<?php
include 'admin_header.php';
include '../auth/footer.php';
include 'session.php';
include '../database/dbconnect.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $b_name = trim(htmlspecialchars(mysqli_real_escape_string($conn, $_POST['b_name'])));
$b_brand = trim(htmlspecialchars(mysqli_real_escape_string($conn, $_POST['b_brand'])));
$b_color = trim(htmlspecialchars(mysqli_real_escape_string($conn, $_POST['b_color'])));

    $b_rate = intval($_POST['b_rate']);

    if (empty($b_name) || empty($b_brand) || empty($b_color) || empty($b_rate)) {
        $errors[] = "All fields are required";
    } elseif ($b_rate < 0) {
        $errors[] = "Bike rate cannot be negative";
    }

    // Validate uploaded images
    $allowed_types = ['image/jpeg', 'image/png'];
    $max_size = 5 * 1024 * 1024; // 5MB

    if (!in_array($_FILES['b_image']['type'], $allowed_types) || $_FILES['b_image']['size'] > $max_size) {
        $errors[] = "Invalid image file for bike image.";
    }

    if (!in_array($_FILES['b_number_plate']['type'], $allowed_types) || $_FILES['b_number_plate']['size'] > $max_size) {
        $errors[] = "Invalid image file for bike number plate.";
    }

    // Upload images
    $BPicture = $_FILES['b_number_plate']['name'];
    $ttemp = $_FILES['b_number_plate']['tmp_name'];
    $ffolder = "pics/" . $BPicture;
    move_uploaded_file($ttemp, $ffolder);

    $Picture = $_FILES['b_image']['name'];
    $temp = $_FILES['b_image']['tmp_name'];
    $folder = "pics/" . $Picture;
    move_uploaded_file($temp, $folder);

    if (count($errors) == 0) {
        // Insert into database using prepared statements
        $stmt = $conn->prepare("INSERT INTO bike(b_name, b_brand, b_image, b_number_plate, b_color, b_rate) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $b_name, $b_brand, $folder, $ffolder, $b_color, $b_rate);

        if ($stmt->execute()) {
            echo "<script>
                alert('New bike " . htmlspecialchars($b_name) . " added successfully');
                window.location.href = 'admin.php';
            </script>";
        } else {
            $errors[] = "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Bike Listing</title>
    <style>
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
        <?php if (!empty($errors)): ?>
            <div class="errors">
                <?php foreach ($errors as $error): ?>
                    <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

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
            <label for="b_number_plate">Bike Number Plate Photo :</label>
            <input type="file" id="b_number_plate" name="b_number_plate" accept="image/*" required>
            <input type="submit" name="submit" value="Add Listing">
        </form>
    </div>
</body>
</html>
