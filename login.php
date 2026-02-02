<?php
session_start();
if (isset($_SESSION['UserID'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Disaster Relief System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container" style="max-width: 400px;">
    <h2 class="mb-4 text-center">Login</h2>
    <?php if(isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= $_GET['error'] ?></div>
    <?php endif; ?>
    <form method="POST" action="authenticate.php">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>
</body>
</html>
