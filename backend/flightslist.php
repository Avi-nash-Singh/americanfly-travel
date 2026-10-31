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
    <h2>Flights List</h2>
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
    $query = "SELECT * FROM flights LIMIT $limit OFFSET $offset";
    $result = $conn->query($query);
    ?>


    <div class="mt-4">
    <table class="table table-striped table-dark">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Airline</th>
      <th scope="col">Source</th>
      <th scope="col">Destination</th>
      <th scope="col">Route</th>
      <th scope="col">Start Date</th>
      <th scope="col">End Date</th>
      <th scope="col">Adult Fare</th>

    </tr>
  </thead>
  <tbody>
  <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["airline"] . "</td>";
                    echo "<td>" . $row["source"] . "</td>";
                    echo "<td>" . $row["destination"] . "</td>";
                    echo "<td>" . $row["route"] . "</td>";
                    echo "<td>" . $row["start_date"] . "</td>";
                    echo "<td>" . $row["end_date"] . "</td>";
                    echo "<td>" . $row["adult_fare"] . "</td>";
                    echo "</tr>";
                }
                ?>
  </tbody>
</table>
<?php
        // Check if there are more records in the database
        $nextOffset = $offset + $limit;
        $query = "SELECT COUNT(*) as count FROM flights";
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


