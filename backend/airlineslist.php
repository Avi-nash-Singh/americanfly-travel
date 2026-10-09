<!DOCTYPE html>
<html lang="en">
<head> 
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../frontend/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="../frontend/js/bootstrap.min.js"></script>
</head>
<body>


<div class="container">
    <h2>Airlines List</h2>
    <?php
    include_once("config.php");

    // Set the initial limit and offset
    $limit = 10;
    $offset = 0;

    // Check if the "Show More" button was clicked
    if (isset($_GET['offset'])) {
        $offset = (int)$_GET['offset'];
    }

    // Fetch data with limit and offset
    $query = "SELECT * FROM airlines LIMIT $limit OFFSET $offset";
    $result = $conn->query($query);
    ?>


    <div class="mt-4">
    <table class="table table-striped table-dark">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Icon</th>
      <th scope="col">Logo</th>
      <th scope="col">Airline_Code</th>
      <th scope="col">Airline_Name</th>
      <th scope="col">Status</th>

    </tr>
  </thead>
  <tbody>
  <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["Icon"] . "</td>";
                    echo "<td>" . $row["Logo"] . "</td>";
                    echo "<td>" . $row["Airline_Code"] . "</td>";
                    echo "<td>" . $row["Airline_Name"] . "</td>";
                    echo "<td>" . $row["Status"] . "</td>";
                    echo "</tr>";
                }
                ?>
  </tbody>
</table>
<?php
        // Check if there are more records in the database
        $nextOffset = $offset + $limit;
        $query = "SELECT COUNT(*) as count FROM airlines";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $totalRecords = $row['count'];

        if ($totalRecords > ($offset + $limit)) {
            echo '<a href="?offset=' . $nextOffset . '" class="btn btn-primary">Show More</a>';
        }
        ?>

    </div>
</div>


</body>
</html>


