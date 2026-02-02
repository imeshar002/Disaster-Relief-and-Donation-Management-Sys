<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied. Admins only.");
}

$conn = new mysqli("localhost", "root", "", "disaster_mgt_db");

$id  = $_POST['id'];
$item = $_POST['item'];
$qty  = $_POST['qty'];

$sql = "UPDATE Inventory 
        SET ItemName='$item', Quantity=$qty 
        WHERE InventoryID=$id";

$conn->query($sql);

header("Location: view_inventory.php");
