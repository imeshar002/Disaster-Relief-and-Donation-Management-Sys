<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "disaster_mgt_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $UserName = $_POST['username'];
    $Password = $_POST['password'];
    $Role = $_POST['role'];

    $sql = "INSERT INTO User (UserName, Password, Role) 
            VALUES ('$UserName', '$Password', '$Role')";
    if ($conn->query($sql) === TRUE) {
        $success = "New user added successfully!";
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
    <div class="container">
        <h2>Add User</h2>

        <?php
        if (isset($success)) echo "<div class='alert alert-success'>$success</div>";
        if (isset($error)) echo "<div class='alert alert-danger'>$error</div>";
        ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control" required>
                    <option value="">--Select Role--</option>
                    <option value="Admin">Admin</option>
                    <option value="Staff">Staff</option>
                </select>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Add User</button>
            <a href="index.php" class="btn btn-secondary">Back to Dashboard</a>
        </form>
    </div>
</body>

</html>