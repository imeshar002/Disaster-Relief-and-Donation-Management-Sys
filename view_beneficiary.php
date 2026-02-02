<?php
$conn = new mysqli("localhost", "root", "", "disaster_mgt_db");
if ($conn->connect_error) die("Connection failed");

$result = $conn->query("SELECT * FROM Beneficiary");
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Beneficiaries</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
  <h2>Beneficiaries</h2>

  <table class="table table-bordered">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Contact</th>
      <th>Location</th>
    </tr>

    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
      <td><?= $row['BeneficiaryID'] ?></td>
      <td><?= $row['Name'] ?></td>
      <td><?= $row['ContactNo'] ?></td>
      <td><?= $row['Location'] ?></td>
    </tr>
    <?php } ?>
  </table>

  <a href="index.php" class="btn btn-secondary">Back to Dashboard</a>
</div>
</body>
</html>
