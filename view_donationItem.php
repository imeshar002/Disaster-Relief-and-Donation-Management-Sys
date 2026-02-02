<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "disaster_mgt_db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$result = $conn->query("
    SELECT di.DonationItemID, d.DonationTimeStamp, i.ItemName, di.Quantity
    FROM DonationItem di
    JOIN Donation d ON di.DonationID = d.DonationID
    JOIN Item i ON di.ItemID = i.ItemID
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Donation Items</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2>Donation Items</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Donation Timestamp</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['DonationItemID'] ?></td>
                <td><?= $row['DonationTimeStamp'] ?></td>
                <td><?= $row['ItemName'] ?></td>
                <td><?= $row['Quantity'] ?></td>
                <td>
                    <a href="update_donationItem.php?id=<?= $row['DonationItemID'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                    <a href="delete_donationItem.php?id=<?= $row['DonationItemID'] ?>" class="btn btn-sm btn-outline-danger">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="index.php" class="btn btn-secondary mt-2">Back to Dashboard</a>
</div>
</body>
</html>
