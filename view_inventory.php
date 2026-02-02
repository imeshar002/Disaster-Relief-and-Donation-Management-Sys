<?php
$conn = new mysqli("localhost", "root", "", "disaster_mgt_db");
if ($conn->connect_error) die("Connection failed");

$result = $conn->query(
    "SELECT i.ItemName, inv.CurrentStock, inv.LastUpdatedTimeStamp
 FROM Inventory inv
 JOIN Item i ON inv.ItemID = i.ItemID"
);
?>
<!DOCTYPE html>
<html>

<head>
    <title>View Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
    <div class="container">
        <h2>Inventory</h2>

        <table class="table table-bordered">
            <tr>
                <th>Item</th>
                <th>Stock</th>
                <th>Last Updated</th>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
            <td>{$row['ItemName']}</td>
            <td>{$row['CurrentStock']}</td>
            <td>{$row['LastUpdatedTimeStamp']}</td>
          </tr>";
            }
            ?>
        </table>
        <a href="index.php" class="btn btn-secondary mt-2">Back to Dashboard</a>
    </div>
</body>

</html>