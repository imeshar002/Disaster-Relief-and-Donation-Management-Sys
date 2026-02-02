<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied. Admins only.");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "disaster_mgt_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$donors = [];
$result = $conn->query("SELECT DonorID, DonorName FROM Donor");
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $donors[] = $row;
    }
}

if(isset($_POST['submit'])){
    $DonorID = $_POST['donor_id'];
    $sql = "DELETE FROM Donor WHERE DonorID = '$DonorID'";
    if($conn->query($sql) === TRUE){
        $success = "Donor deleted successfully!";
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Donor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2>Delete Donor</h2>

    <?php
    if(isset($success)) echo "<div class='alert alert-success'>$success</div>";
    if(isset($error)) echo "<div class='alert alert-danger'>$error</div>";
    ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label>Select Donor</label>
            <select name="donor_id" class="form-control" required>
                <option value="">--Select Donor--</option>
                <?php
                foreach($donors as $donor){
                    echo "<option value='{$donor['DonorID']}'>{$donor['DonorName']} (ID: {$donor['DonorID']})</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" name="submit" class="btn btn-danger">Delete Donor</button>
    </form>
</div>
</body>
</html>
