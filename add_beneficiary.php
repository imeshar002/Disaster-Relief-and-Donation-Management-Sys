<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "disaster_mgt_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $location = $_POST['location'];

    $sql = "INSERT INTO Beneficiary (Name, ContactNo, Location)
            VALUES ('$name', '$contact', '$location')";

    if ($conn->query($sql) === TRUE) {
        $success = "Beneficiary added successfully!";
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Beneficiary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
    <h2 class="mb-4">Add Beneficiary</h2>

    <?php
    if (isset($success)) {
        echo "<div class='alert alert-success'>$success</div>";
    }
    if (isset($error)) {
        echo "<div class='alert alert-danger'>$error</div>";
    }
    ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label class="form-label">Beneficiary Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Contact Number</label>
            <input type="text" name="contact" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" name="location" class="form-control" required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Add Beneficiary</button>
        <a href="index.php" class="btn btn-secondary">Back to Dashboard</a>
    </form>
</div>

</body>
</html>
