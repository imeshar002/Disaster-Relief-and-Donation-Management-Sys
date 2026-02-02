<?php
$conn = new mysqli("localhost", "root", "", "disaster_mgt_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM Distribution");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Distributions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
    <h2 class="mb-3">Distribution Records</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Timestamp</th>
                <th>Location</th>
                <th>Beneficiary ID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['DistributionID']) ?></td>
                    <td><?= htmlspecialchars($row['DistributionTimeStamp']) ?></td>
                    <td><?= htmlspecialchars($row['DistributionLocation']) ?></td>
                    <td><?= htmlspecialchars($row['BeneficiaryID']) ?></td>
                    <td>
                        <a href="update_distribution.php?id=<?= $row['DistributionID'] ?>" 
                           class="btn btn-sm btn-outline-primary">Edit</a>

                        <a href="delete_distribution.php?id=<?= $row['DistributionID'] ?>" 
                           class="btn btn-sm btn-outline-danger"
                           onclick="return confirm('Are you sure you want to delete this record?');">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">No distribution records found</td>
            </tr>
        <?php endif; ?>

        </tbody>
    </table>

    <a href="index.php" class="btn btn-secondary mt-2">Back to Dashboard</a>
</div>

</body>
</html>
