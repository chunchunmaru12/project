<?php
include 'admin_header.php';
include '../auth/footer.php';
include '../database/dbconnect.php';
include 'session.php';

$errors = [];

if (isset($_GET['bike_id'])) {
    $bike_id = intval($_GET['bike_id']); 
} else {
    $errors[] = "Bike ID is required";
}

$sql = "SELECT * FROM bike WHERE b_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bike_id); 
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Bike Details</title>
    <style>
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
        .bike-form select,
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

        input[type=number] {
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
                <input type="text" id="b_name" name="b_name" value="<?php echo htmlspecialchars($row['b_name']); ?>" required>
                <label for="b_brand">Bike Brand:</label>
                <input type="text" id="b_brand" name="b_brand" value="<?php echo htmlspecialchars($row['b_brand']); ?>" required>
                <label for="b_color">Bike Color:</label>
                <input type="text" id="b_color" name="b_color" value="<?php echo htmlspecialchars($row['b_color']); ?>" required>
                <label for="b_rate">Bike Rate:</label>
                <input type="number" id="b_rate" name="b_rate" value="<?php echo htmlspecialchars($row['b_rate']); ?>" required>
                <!-- <label for="b_status">Bike Status:</label> -->
                <!-- <select id="b_status" name="b_status" required>
                    <option value="unavailable"  #if ($row['b_status'] == 'unavailable') echo 'selected';>Unavailable</option>
                    <option value="available" #if ($row['b_status'] == 'available') echo 'selected'; >Available</option>
                </select> -->

                <input type="submit" name="submit" value="Update">
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $b_name = htmlspecialchars($_POST['b_name']);
        $b_brand = htmlspecialchars($_POST['b_brand']);
        $b_color = htmlspecialchars($_POST['b_color']);
        $b_rate = intval($_POST['b_rate']);
        $b_status = htmlspecialchars($_POST['b_status']); 
        $sql = "UPDATE bike SET b_name = ?, b_brand = ?, b_color = ?, b_rate = ? WHERE b_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $b_name, $b_brand, $b_color, $b_rate, $bike_id); // "sssssi" stands for string, string, string, string, string, integer
        if ($stmt->execute()) {
            
            echo "<script>alert('Updated ');</script>";
            echo "<script>window.location.href = 'admin.php';</script>";
        } else {
            $errors[] = "Error updating record: " . $stmt->error;
        }
    }
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>" . htmlspecialchars($error) . "</p>";
        }
    }
    ?>

</body>

</html>
