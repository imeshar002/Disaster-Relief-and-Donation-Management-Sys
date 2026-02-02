<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied. Admins only.");
}

$conn = new mysqli("localhost", "root", "", "disaster_mgt_db");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$id) { header("Location: view_donor.php"); exit(); }

$result = $conn->query("SELECT * FROM Donor WHERE DonorID = $id");
$donor = $result->fetch_assoc();
if (!$donor) { header("Location: view_donor.php"); exit(); }

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $type = $_POST['type'];

    $sql = "UPDATE Donor SET DonorName='$name', ContactNo='$contact', Address='$address', DonorType='$type' WHERE DonorID=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: view_donor.php");
        exit();
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Donor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
<h2>Edit Donor</h2>
<?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
<form method="POST" action="">
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="<?= $donor['DonorName'] ?>" required>
    </div>
    <div class="mb-3">
        <label>Contact Info</label>
        <input type="text" name="contact" class="form-control" value="<?= $donor['ContactNo'] ?>">
    </div>
    <div class="mb-3">
        <label>Address</label>
        <input type="text" name="address" class="form-control" value="<?= $donor['Address'] ?>">
    </div>
    <div class="mb-3">
        <label>Type</label>
        <select name="type" class="form-control">
            <option value="Individual" <?= $donor['DonorType']=='Individual'?'selected':'' ?>>Individual</option>
            <option value="Organization" <?= $donor['DonorType']=='Organization'?'selected':'' ?>>Organization</option>
        </select>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Update Donor</button>
    <a href="view_donor.php" class="btn btn-secondary">Cancel</a>
</form>
</div>
</body>
</html>
