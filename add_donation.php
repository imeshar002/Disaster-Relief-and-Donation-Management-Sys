<?php
$conn = new mysqli("localhost", "root", "", "disaster_mgt_db");
if ($conn->connect_error) die("Connection failed");

$success = "";
$error = "";

$donors = [];
$result = $conn->query("SELECT DonorID, DonorName FROM Donor");
while ($row = $result->fetch_assoc()) {
    $donors[] = $row;
}

if (isset($_POST['submit'])) {
    $timestamp = $_POST['timestamp'];
    $donor_id = $_POST['donor_id'];

    $sql = "INSERT INTO Donation (DonationTimeStamp, DonorID)
            VALUES ('$timestamp', '$donor_id')";

    if ($conn->query($sql)) {
        $success = "Donation added successfully";
        $_POST = [];
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Donation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2>Add Donation</h2>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label>Donation Timestamp</label>
            <input type="datetime-local" name="timestamp" class="form-control"
                   value="<?= $_POST['timestamp'] ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label>Donor</label>
            <select name="donor_id" class="form-control" required>
                <option value="">-- Select Donor --</option>
                <?php foreach ($donors as $d): ?>
                    <option value="<?= $d['DonorID'] ?>"
                        <?= (($_POST['donor_id'] ?? '') == $d['DonorID']) ? 'selected' : '' ?>>
                        <?= $d['DonorName'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Add Donation</button>
        <a href="index.php" class="btn btn-secondary">Back to Dashboard</a>
    </form>
</div>
</body>
</html>
