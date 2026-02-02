<?php
$conn = new mysqli("localhost", "root", "", "disaster_mgt_db");
if ($conn->connect_error) die("DB Error");

$donations = $conn->query("SELECT DonationID, DonationTimeStamp FROM Donation");
$items = $conn->query("SELECT ItemID, ItemName FROM Item");

$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $DonationID = $_POST["donation_id"];
    $ItemID = $_POST["item_id"];
    $Quantity = $_POST["quantity"];

    if ($conn->query("INSERT INTO DonationItem (DonationID, ItemID, Quantity) VALUES ($DonationID, $ItemID, $Quantity)")) {
        $success = "Donation Item added successfully";
    } else {
        $error = "Insert failed";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Donation Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h3>Add Donation Item</h3>

    <?php if ($success) echo "<div class='alert alert-success'>$success</div>"; ?>
    <?php if ($error) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <form method="post">
        <div class="mb-3">
            <label>Donation</label>
            <select name="donation_id" class="form-control" required>
                <option value="">Select</option>
                <?php while ($d = $donations->fetch_assoc()) { ?>
                    <option value="<?= $d['DonationID'] ?>">
                        <?= $d['DonationID'] ?> | <?= $d['DonationTimeStamp'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Item</label>
            <select name="item_id" class="form-control" required>
                <option value="">Select</option>
                <?php while ($i = $items->fetch_assoc()) { ?>
                    <option value="<?= $i['ItemID'] ?>"><?= $i['ItemName'] ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" min="1" required>
        </div>

        <button class="btn btn-primary">Add Donation Item</button>
        <a href="index.php" class="btn btn-secondary">Back to Dashboard</a>
    </form>
</div>
</body>
</html>
