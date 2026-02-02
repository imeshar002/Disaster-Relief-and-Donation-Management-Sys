<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied. Admins only.");
}

$conn = new mysqli("localhost", "root", "", "disaster_mgt_db");

$id = $_GET['id'];

$conn->query("DELETE FROM Inventory WHERE InventoryID=$id");

header("Location: view_inventory.php");
