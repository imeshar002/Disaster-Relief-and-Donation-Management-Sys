<?php
$conn = new mysqli("localhost", "root", "", "disaster_mgt_db");
if ($conn->connect_error) die("Connection failed");

$success = "";
$error = "";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $type = $_POST['type'];

    $sql = "INSERT INTO Donor (DonorName, ContactNo, Address, DonorType)
            VALUES ('$name','$contact','$address','$type')";

    if ($conn->query($sql)) {
        $success = "Donor added successfully";
        $_POST = [];
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Donor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2>Add Donor</h2>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?= $_POST['name'] ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label>Contact Info</label>
            <input type="text" name="contact" class="form-control" value="<?= $_POST['contact'] ?? '' ?>">
        </div>

        <div class="mb-3">
            <label>Address</label>
            <input type="text" name="address" class="form-control" value="<?= $_POST['address'] ?? '' ?>">
        </div>

        <div class="mb-3">
            <label>Type</label>
            <select name="type" class="form-control">
                <option value="Individual" <?= (($_POST['type'] ?? '') == 'Individual') ? 'selected' : '' ?>>Individual</option>
                <option value="Organization" <?= (($_POST['type'] ?? '') == 'Organization') ? 'selected' : '' ?>>Organization</option>
            </select>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Add Donor</button>
        <a href="index.php" class="btn btn-secondary">Back to Dashboard</a>
    </form>
</div>
</body>
</html>
