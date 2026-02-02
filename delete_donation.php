<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied. Admins only.");
}

$conn = new mysqli("localhost", "root", "", "disaster_mgt_db");
if ($conn->connect_error) die("Connection failed");

$donations = [];
$result = $conn->query("SELECT DonationID, DonationTimeStamp FROM Donation");
while ($row = $result->fetch_assoc()) $donations[] = $row;

if (isset($_POST['delete'])) {
    $id = $_POST['donation_id'];
    if ($conn->query("DELETE FROM Donation WHERE DonationID='$id'")) {
        $success = "Donation deleted successfully!";
    } else {
        $error = "Delete failed";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Delete Donation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
    <div class="container">
        <h2>Delete Donation</h2>

        <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

        <form method="POST">
            <div class="mb-3">
                <label>Select Donation</label>
                <select name="donation_id" class="form-control" required>
                    <option value="">--Select Donation--</option>
                    <?php foreach ($donations as $d) {
                        echo "<option value='{$d['DonationID']}'>ID {$d['DonationID']} - {$d['DonationTimeStamp']}</option>";
                    } ?>
                </select>
            </div>

            <button name="delete" class="btn btn-danger">Delete</button>
        </form>
    </div>
</body>

</html>