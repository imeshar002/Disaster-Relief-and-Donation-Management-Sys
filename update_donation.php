<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied. Admins only.");
}

$conn = new mysqli("localhost", "root", "", "disaster_mgt_db");
if ($conn->connect_error) die("Connection failed");

$donations = [];
$donors = [];

$r1 = $conn->query("SELECT DonationID, DonationTimeStamp, DonorID FROM Donation");
while ($row = $r1->fetch_assoc()) $donations[] = $row;

$r2 = $conn->query("SELECT DonorID, DonorName FROM Donor");
while ($row = $r2->fetch_assoc()) $donors[] = $row;

$selectedDonation = null;

if (isset($_POST['load'])) {
    $id = $_POST['donation_id'];
    $res = $conn->query("SELECT * FROM Donation WHERE DonationID='$id'");
    $selectedDonation = $res->fetch_assoc();
}

if (isset($_POST['update'])) {
    $id = $_POST['donation_id'];
    $timestamp = $_POST['timestamp'];
    $donor = $_POST['donor_id'];

    if ($conn->query("UPDATE Donation SET DonationTimeStamp='$timestamp', DonorID='$donor' WHERE DonationID='$id'")) {
        $success = "Donation updated successfully!";
    } else {
        $error = "Update failed";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Update Donation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
    <div class="container">
        <h2>Update Donation</h2>

        <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

        <form method="POST">
            <div class="mb-3">
                <label>Select Donation</label>
                <select name="donation_id" class="form-control" required>
                    <option value="">--Select--</option>
                    <?php foreach ($donations as $d) {
                        $sel = ($selectedDonation && $selectedDonation['DonationID'] == $d['DonationID']) ? "selected" : "";
                        echo "<option value='{$d['DonationID']}' $sel>ID {$d['DonationID']} - {$d['DonationTimeStamp']}</option>";
                    } ?>
                </select>
            </div>
            <button name="load" class="btn btn-secondary mb-3">Load Donation</button>
        </form>

        <?php if ($selectedDonation) { ?>
            <form method="POST">
                <input type="hidden" name="donation_id" value="<?= $selectedDonation['DonationID'] ?>">

                <div class="mb-3">
                    <label>Donation Timestamp</label>
                    <input type="datetime-local" name="timestamp" class="form-control"
                        value="<?= date('Y-m-d\TH:i', strtotime($selectedDonation['DonationTimeStamp'])) ?>" required>
                </div>

                <div class="mb-3">
                    <label>Donor</label>
                    <select name="donor_id" class="form-control" required>
                        <?php foreach ($donors as $dn) {
                            $sel = ($dn['DonorID'] == $selectedDonation['DonorID']) ? "selected" : "";
                            echo "<option value='{$dn['DonorID']}' $sel>{$dn['DonorName']}</option>";
                        } ?>
                    </select>
                </div>

                <button name="update" class="btn btn-primary">Update</button>
            </form>
        <?php } ?>
    </div>
</body>

</html>