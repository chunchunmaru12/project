<?php
include 'admin_header.php';
include '../database/dbconnect.php';
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <style>
    section {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 20px;
    }

    h1 {
      text-align: center;
    }

    .container {
      max-width: 800px;
      margin: 20px auto;
      padding: 0 20px;
    }

    table {
      border-collapse: collapse;
    }

    tr,
    td {
      padding: 20px;
    }
  </style>
</head>

<body>

  <h1>Bikes </h1>
  <section>
    <div class="container">
      <div class="gallery">
        <table border="">
          <tr>
            <th>Name</th>
            <th>Brand</th>
            <th>Image</th>
            <th>Color</th>
            <th>Rate</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php

          $sql = "SELECT * FROM bike";
          $result = mysqli_query($conn, $sql);
          $num = mysqli_num_rows($result);
          if ($num > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $imageURL = $row["b_image"];
              $imageName = $row["b_name"];
              $rate = $row["b_rate"];
          ?>
              <tr>
                <td><?php echo $row['b_name']; ?></td>
                <td> <?php echo $row['b_brand']; ?> </td>
                <td><img class="bike" src="<?php echo $imageURL; ?>" alt="" style="width:200px;height:100px;object-fit:cover;">
                <td> <?php echo $row['b_color']; ?> </td>
                <td> <?php echo $row['b_rate']; ?> </td>
                <td> <?php echo $row['b_status']; ?> </td>
                <td><a href="admin_bike.php?bike_id=<?php echo $row['b_id'] ?>">Edit</a></td>
                <td><a href="delete.php?bike_id=<?php echo $row['b_id'] ?>">Delete</a></td>
              </tr>

          <?php }
          }
          ?>
        </table>

      </div>
        </div>
  </section>
</body>

</html>