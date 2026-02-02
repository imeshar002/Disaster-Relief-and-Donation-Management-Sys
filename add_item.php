<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "disaster_mgt_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if(isset($_POST['submit'])){
    $ItemName = $_POST['name'];
    $Unit = $_POST['unit'];
    $Category = $_POST['category'];

    $sql = "INSERT INTO Item (ItemName, Unit, Category) VALUES ('$ItemName', '$Unit', '$Category')";
    if($conn->query($sql) === TRUE) $success = "New item added successfully!";
    else $error = "Error: " . $conn->error;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2>Add Item</h2>

    <?php if(isset($success)) echo "<div class='alert alert-success'>$success</div>";
          if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label>Item Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Unit</label>
            <input type="text" name="unit" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Category</label>
            <input type="text" name="category" class="form-control" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Add Item</button>
        <a href="index.php" class="btn btn-secondary">Back to Dashboard</a>
    </form>
</div>
</body>
</html>
