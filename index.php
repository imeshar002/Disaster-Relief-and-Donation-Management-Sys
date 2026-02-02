<?php
session_start();
if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit();
}
?>

<!doctype html>
<html>
<head>
  <title>Disaster Relief and Donation Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-center flex-grow-1">Disaster Relief and Donation Management System</h1>
        <div class="text-end">
            <p class="mb-1">Welcome, <?= htmlspecialchars($_SESSION['UserName']) ?></p>
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>

    <div class="row g-4">

      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Donor Management</h5>
            <a href="add_donor.php" class="btn btn-primary w-100 mb-2">Add Donor</a>
            <a href="view_donor.php" class="btn btn-secondary w-100 mb-1">View Donors</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Donation Management</h5>
            <a href="add_donation.php" class="btn btn-primary w-100 mb-2">Add Donation</a>
            <a href="view_donation.php" class="btn btn-secondary w-100 mb-1">View Donations</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Donation Items</h5>
            <a href="add_donationItem.php" class="btn btn-primary w-100 mb-2">Add Donation Item</a>
            <a href="view_donationItem.php" class="btn btn-secondary w-100 mb-1">View Donation Items</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Inventory Management</h5>
            <a href="add_inventory.php" class="btn btn-primary w-100 mb-2">Add Inventory</a>
            <a href="view_inventory.php" class="btn btn-secondary w-100 mb-1">View Inventory</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Distribution Management</h5>
            <a href="add_distribution.php" class="btn btn-primary w-100 mb-2">Add Distribution</a>
            <a href="view_distribution.php" class="btn btn-secondary w-100 mb-1">View Distributions</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Distribution Items</h5>
            <a href="add_distributionItem.php" class="btn btn-primary w-100 mb-2">Add Distribution Item</a>
            <a href="view_distributionItem.php" class="btn btn-secondary w-100 mb-1">View Distribution Items</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">User Management</h5>
            <a href="add_user.php" class="btn btn-primary w-100 mb-2">Add User</a>
            <a href="view_user.php" class="btn btn-secondary w-100 mb-1">View Users</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Beneficiary Management</h5>
            <a href="add_beneficiary.php" class="btn btn-primary w-100 mb-2">Add Beneficiary</a>
            <a href="view_beneficiary.php" class="btn btn-secondary w-100 mb-1">View Beneficiary</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Item Management</h5>
            <a href="add_item.php" class="btn btn-primary w-100 mb-2">Add Item</a>
            <a href="view_item.php" class="btn btn-secondary w-100 mb-1">View Item</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</body>
</html>
