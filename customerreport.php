<?php
include "./php/dbconnection.php";

                    if (isset($_POST['submit'])) {
                        // Sanitize user input
                        $customerid = mysqli_real_escape_string($conn, $_POST['customerid']);
                        $loanno = mysqli_real_escape_string($conn, $_POST['loanno']);

                        // Construct the SQL query
                        $sql = "SELECT * FROM repayment WHERE loanno='$loanno' AND customerid='$customerid'";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                        	while($row=mysqli_fetch_assoc($result))
                        	{
                        		$customername=$row['customername'];
                        	}

                        }
                    }

?>
<?php include "header.php"; ?>
<main class="flex-grow-1" style="margin-left: 280px; transition: margin-left 0.3s;">
    <div class="container" style="margin-top: 15px;">
        <h3 style="line-height: 60px;">Welcome MR/MRS. <?php echo htmlspecialchars($customername); ?></h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Customer Report</li>
            </ol>
        </nav>
        <div class="table-responsive">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th style="text-align:center;">Customer ID</th>
                        <th style="text-align:center;">Customer Name</th>
                        <th style="text-align:center;">Loan No</th>
                        <th style="text-align:center;">Total Payable</th>
                        <th style="text-align:center;">Balance</th>
                        <th style="text-align:center;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "./php/dbconnection.php";

                    if (isset($_POST['submit'])) {
                        // Sanitize user input
                        $customerid = mysqli_real_escape_string($conn, $_POST['customerid']);
                        $loanno = mysqli_real_escape_string($conn, $_POST['loanno']);

                        // Construct the SQL query
                        $sql = "SELECT * FROM repayment WHERE loanno='$loanno' AND customerid='$customerid'";
                        $result = mysqli_query($conn, $sql);

                        // Check for query execution errors
                        if (!$result) {
                            echo "<tr><td colspan='6'>Error executing query: " . htmlspecialchars(mysqli_error($conn)) . "</td></tr>";
                        } else {
                            // Fetch and display results
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td style='text-align:center;'>" . htmlspecialchars($row['customerid']) . "</td>";
                                echo "<td  style='text-align:center;'>" . htmlspecialchars($row['customername']) . "</td>";
                                echo "<td  style='text-align:center;'>" . htmlspecialchars($row['loanno']) . "</td>";
                                echo "<td style='text-align:center;'>" . htmlspecialchars($row['totalpayable']) . "</td>";
                                echo "<td style='text-align:center;'>" . htmlspecialchars($row['balancepayable']) . "</td>";
                                echo "<td style='color:red;font-weight:bold;'>" . htmlspecialchars($row['closedloan']) . "</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    // Close the database connection
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php include "footer.php"; ?>