<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "disaster_mgt_db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$result = $conn->query("SELECT * FROM Donor");
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Donors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
    <div class="container">
        <h2>Donors</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['DonorID'] ?></td>
                        <td><?= $row['DonorName'] ?></td>
                        <td><?= $row['ContactNo'] ?></td>
                        <td><?= $row['Address'] ?></td>
                        <td><?= $row['DonorType'] ?></td>
                        <td>
                            <a href="update_donor.php?id=<?= $row['DonorID'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                            <a href="delete_donor.php?id=<?= $row['DonorID'] ?>" class="btn btn-sm btn-outline-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-secondary mt-2">Back to Dashboard</a>
    </div>
</body>

</html>