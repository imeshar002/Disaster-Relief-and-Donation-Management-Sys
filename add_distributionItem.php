<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "disaster_mgt_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$distributions = [];
$result = $conn->query("SELECT DistributionID, DistributionTimeStamp, DistributionLocation FROM Distribution");
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $distributions[] = $row;
    }
}

$items = [];
$result = $conn->query("SELECT ItemID, ItemName FROM Item");
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

if(isset($_POST['submit'])){
    $DistributionID = $_POST['distribution_id'];
    $ItemID = $_POST['item_id'];
    $QuantityDistributed = $_POST['quantity'];

    $sql = "INSERT INTO DistributionItem (DistributionID, ItemID, QuantityDistributed) 
            VALUES ('$DistributionID', '$ItemID', '$QuantityDistributed')";
    if($conn->query($sql) === TRUE){
        $success = "New Distribution Item added successfully!";
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Distribution Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2>Add Distribution Item</h2>

    <?php
    if(isset($success)) echo "<div class='alert alert-success'>$success</div>";
    if(isset($error)) echo "<div class='alert alert-danger'>$error</div>";
    ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label>Distribution</label>
            <select name="distribution_id" class="form-control" required>
                <option value="">--Select Distribution--</option>
                <?php
                foreach($distributions as $dist){
                    echo "<option value='{$dist['DistributionID']}'>ID: {$dist['DistributionID']} | {$dist['DistributionTimeStamp']} | {$dist['DistributionLocation']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Item</label>
            <select name="item_id" class="form-control" required>
                <option value="">--Select Item--</option>
                <?php
                foreach($items as $item){
                    echo "<option value='{$item['ItemID']}'>{$item['ItemName']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Quantity Distributed</label>
            <input type="number" name="quantity" class="form-control" min="1" required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Add Distribution Item</button>
        <a href="index.php" class="btn btn-secondary">Back to Dashboard</a>
    </form>
</div>
</body>
</html>
