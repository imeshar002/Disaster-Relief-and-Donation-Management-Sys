<?php
session_start();
$conn = new mysqli("localhost", "root", "", "disaster_mgt_db");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT UserID, UserName, Role FROM User WHERE UserName=? AND Password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $_SESSION['UserID'] = $row['UserID'];
        $_SESSION['UserName'] = $row['UserName'];
        $_SESSION['Role'] = $row['Role'];
        header("Location: index.php");
        exit();
    } else {
        header("Location: login.php?error=Invalid credentials");
        exit();
    }
}
?>
