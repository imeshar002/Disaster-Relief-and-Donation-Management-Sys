<?php
$conn = new mysqli("localhost","root","","disaster_mgt_db");
if($conn->connect_error) die("Connection failed: ".$conn->connect_error);

$result = $conn->query("SELECT d.DonationID, d.DonationTimeStamp, dn.DonorName 
                        FROM Donation d 
                        JOIN Donor dn ON d.DonorID = dn.DonorID");
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Donations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2>All Donations</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Donation ID</th>
                <th>Timestamp</th>
                <th>Donor Name</th>
            </tr>
        </thead>
        <tbody>
            <?php if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "<tr>
                            <td>{$row['DonationID']}</td>
                            <td>{$row['DonationTimeStamp']}</td>
                            <td>{$row['DonorName']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No donations found</td></tr>";
            } ?>
        </tbody>
    </table>
    <a href="index.php" class="btn btn-secondary mt-2">Back to Dashboard</a>
</div>
</body>
</html>
