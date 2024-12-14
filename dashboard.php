<?php include "header.php";?>
<?php
include "./php/dbconnection.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM mainbalance ORDER BY id DESC LIMIT 1"; 
$result = mysqli_query($conn, $sql);

if ($result) {
    if ($result->num_rows > 0) {
        // Output data of the last row
        $row = $result->fetch_assoc();
        $lastMainBalance = htmlspecialchars($row["mainbalance"]); // Use htmlspecialchars to prevent XSS
    } else {
        $lastMainBalance = ""; // No results found
    }
} else {
    echo "Error: " . mysqli_error($conn); // Display error message if query fails
    $lastMainBalance = ""; // Set to empty if there's an error
}
$sql = "SELECT COUNT(*) as total FROM customer";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    $row = $result->fetch_assoc();
    $totalEntries = $row['total']; // Get the total count
} else {
    echo "Error: " . mysqli_error($conn); // Display error message if query fails
    $totalEntries = 0; // Set to 0 if there's an error
}
$sql = "SELECT COUNT(*) as total FROM account";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    $row = $result->fetch_assoc();
    $totalaccounts = $row['total']; // Get the total count
} else {
    echo "Error: " . mysqli_error($conn); // Display error message if query fails
    $totalaccounts = 0; // Set to 0 if there's an error
}
$sql="SELECT SUM(paidamount) as total FROM mainbalance";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    $row = $result->fetch_assoc();
    $totalincome = $row['total']; // Get the total count
} else {
    echo "Error: " . mysqli_error($conn); // Display error message if query fails
    $totalincome = 0; // Set to 0 if there's an error
}

$sql = "SELECT COUNT(*) as total FROM loan";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    $row = $result->fetch_assoc();
    $totalloan = $row['total']; // Get the total count
} else {
    echo "Error: " . mysqli_error($conn); // Display error message if query fails
    $totalloan = 0; // Set to 0 if there's an error
}
$today = date('Y-m-d');

// Query to fetch today's account registrations
$query = "SELECT * FROM account WHERE DATE(accountcreationdate) = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $today);
$stmt->execute();
$result = $stmt->get_result();
$conn->close();
?>
<main class="flex-grow-1" style="margin-left: 280px; transition: margin-left 0.3s;">
        <div class="container" style="margin-top: 15px;">
            <h3 style="text-align: center;">Welcome to Dashboard</h3>
            <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Library</li>
  </ol>
  <div class="col-md-6">
    <label for="inputid4" class="form-label">Main Balance</label>
    <div class="input-group">
                    <span class="input-group-text">₹</span>
    <input type="text" class="form-control" name="mainbalance" id="mainbalance" value="<?php echo $lastMainBalance; ?>"readonly>
</div>
<button style="margin-top:10px;background: seagreen;"><a href="mainsheetlist.php" style="text-decoration:none;color: #fff;">Mainsheet list</a></button>
  </div><br>
</nav>
            <div class="row" style="display: flex; flex-direction: row;justify-content:space-evenly;">
            <div class="card" style="width:250px; height: 150px;">
  <div class="card-body">
    <h5 class="card-title"><img src="./images/icons8-customer-24.png"></h5>
    <h6 class="card-subtitle mb-2 text-body-secondary">No of Customers</h6>
    <p class="card-text"><?php echo $totalEntries;?></p>
  </div>
</div>
<div class="card" style="width:250px; height: 150px;">
  <div class="card-body">
    <h5 class="card-title"><img src="./images/icons8-bank-account-24.png"></h5>
    <h6 class="card-subtitle mb-2 text-body-secondary">No of Accounts</h6>
    <p class="card-text"><?php echo $totalaccounts;?></p>
  </div>
</div>
<div class="card" style="width:250px; height: 150px;">
  <div class="card-body">
    <h5 class="card-title"><img src="./images/icons8-fund-24.png"></h5>
    <h6 class="card-subtitle mb-2 text-body-secondary">No Of Loans</h6>
    <p class="card-text"><?php echo $totalloan;?></p>
  </div>
</div>
<div class="card" style="width:250px; height: 150px;">
  <div class="card-body">
    <h5 class="card-title"><img src="./images/icons8-money-bag-pounds-24.png"></h5>
    <h6 class="card-subtitle mb-2 text-body-secondary">Income</h6>
    <p class="card-text" style="color: darkgreen;font-weight: bold;">₹<?php echo $totalincome;?></p>
  </div>
</div>
</div>
<h3 style="margin-top:20px;text-align:center;">Today Account Status</h3>
<div class="table-responsive">

<table id="myTable" class="display">
    <thead>
        <tr>
           <th>Customer ID</th>
                    <th>Customer Name</th>
                    <th>Account Number</th>
                    <th>Phone Number</th>
                    <th>Aadhar Number</th>
                    <th>Pan Card</th>
                    <th>Creation Date</th>
                    <th>Account Type</th>
        </tr>
    </thead>
    <tbody>
        <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['customerid']}</td>
                                <td>{$row['customername']}</td>
                                <td>{$row['accountid']}</td>
                                <td>{$row['phonenumber']}</td>
                                <td>{$row['aadhar']}</td>
                                <td>{$row['pancard']}</td>
                                <td>{$row['accountcreationdate']}</td>
                                <td>{$row['accounttype']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>No Account Creation today.</td></tr>";
                }
                ?>
    </tbody>
</table>
</div>
        </div>
    </main>
    <?php include "footer.php"; ?>