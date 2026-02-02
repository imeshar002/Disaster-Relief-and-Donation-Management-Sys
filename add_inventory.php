<?php
$conn = new mysqli("localhost", "root", "", "disaster_mgt_db");
if ($conn->connect_error) die("Connection failed");

$items = [];
$r = $conn->query("SELECT ItemID, ItemName FROM Item");
while ($row = $r->fetch_assoc()) $items[] = $row;

if (isset($_POST['submit'])) {
    $item = $_POST['item_id'];
    $stock = $_POST['stock'];
    $time = date("Y-m-d H:i:s");

    $check = $conn->query("SELECT * FROM Inventory WHERE ItemID='$item'");
    if ($check->num_rows > 0) {
        $sql = "UPDATE Inventory 
                SET CurrentStock='$stock', LastUpdatedTimeStamp='$time' 
                WHERE ItemID='$item'";
    } else {
        $sql = "INSERT INTO Inventory (ItemID, CurrentStock, LastUpdatedTimeStamp)
                VALUES ('$item','$stock','$time')";
    }

    if ($conn->query($sql)) $success = "Inventory updated successfully!";
    else $error = "Operation failed";
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Manage Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
    <div class="container">
        <h2>Manage Inventory</h2>

        <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

        <form method="POST">
            <div class="mb-3">
                <label>Item</label>
                <select name="item_id" class="form-control" required>
                    <option value="">--Select Item--</option>
                    <?php foreach ($items as $i) {
                        echo "<option value='{$i['ItemID']}'>{$i['ItemName']}</option>";
                    } ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Current Stock</label>
                <input type="number" name="stock" class="form-control" min="0" required>
            </div>

            <button name="submit" class="btn btn-primary">Save</button>
            <a href="index.php" class="btn btn-secondary">Back to Dashboard</a>
        </form>
    </div>
</body>

</html>