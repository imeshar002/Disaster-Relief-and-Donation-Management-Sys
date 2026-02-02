<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied. Admins only.");
}

$conn = new mysqli("localhost", "root", "", "disaster_mgt_db");

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM Inventory WHERE InventoryID=$id");
$row = $result->fetch_assoc();
?>

<h2>Edit Inventory</h2>

<form action="update_inventory.php" method="post">
    <input type="hidden" name="id" value="<?= $row['InventoryID'] ?>">

    Item Name:
    <input type="text" name="item" value="<?= $row['ItemName'] ?>" required><br><br>

    Quantity:
    <input type="number" name="qty" value="<?= $row['Quantity'] ?>" required><br><br>

    <button type="submit">Update</button>
</form>

<br>
<a href="dashboard.php">⬅ Back to Dashboard</a>
