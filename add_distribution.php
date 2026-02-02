<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "disaster_mgt_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$beneficiaries = [];
$result = $conn->query("SELECT BeneficiaryID, Name FROM Beneficiary");
if ($result->num_rows > 0) while($row = $result->fetch_assoc()) $beneficiaries[] = $row;

if(isset($_POST['submit'])){
    $DistributionTimeStamp = $_POST['timestamp'];
    $DistributionLocation = $_POST['location'];
    $BeneficiaryID = $_POST['beneficiary_id'];

    $sql = "INSERT INTO Distribution (DistributionTimeStamp, DistributionLocation, BeneficiaryID) 
            VALUES ('$DistributionTimeStamp', '$DistributionLocation', '$BeneficiaryID')";
    if($conn->query($sql) === TRUE) $success = "New distribution added successfully!";
    else $error = "Error: " . $conn->error;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Distribution</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2>Add Distribution</h2>

    <?php
    if(isset($success)) echo "<div class='alert alert-success'>$success</div>";
    if(isset($error)) echo "<div class='alert alert-danger'>$error</div>";
    ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label>Distribution Timestamp</label>
            <input type="datetime-local" name="timestamp" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Distribution Location</label>
            <input type="text" name="location" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Beneficiary</label>
            <select name="beneficiary_id" class="form-control" required>
                <option value="">--Select Beneficiary--</option>
                <?php
                foreach($beneficiaries as $b){
                    echo "<option value='{$b['BeneficiaryID']}'>{$b['Name']}</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Add Distribution</button>
        <a href="index.php" class="btn btn-secondary">Back to Dashboard</a>
    </form>
</div>
</body>
</html>
