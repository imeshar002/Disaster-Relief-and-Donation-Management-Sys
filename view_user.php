<?php
$conn = new mysqli("localhost", "root", "", "disaster_mgt_db");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$result = $conn->query("SELECT * FROM User");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2>Users</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['UserID'] ?></td>
                <td><?= $row['UserName'] ?></td>
                <td><?= $row['Password'] ?></td>
                <td><?= $row['Role'] ?></td>
                <td>
                    <a href="update_user.php?id=<?= $row['UserID'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                    <a href="delete_user.php?id=<?= $row['UserID'] ?>" class="btn btn-sm btn-outline-danger">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="index.php" class="btn btn-secondary mt-2">Back to Dashboard</a>
</div>
</body>
</html>
