<?php include "header.php"; ?>
<main class="flex-grow-1" style="margin-left: 280px; transition: margin-left 0.3s;">
    <div class="container" style="margin-top: 15px;">
        <h3 style="line-height: 60px;"> Repayment List</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Repayment list</li>
            </ol>
            <button style="background: blue; border: none; width: 100px;">
                <a href="repayment.php" style="text-decoration: none; color: #FFF;">back</a>
            </button>
        </nav>
        <div class="table-responsive">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>Customer Name</th>
                        <th>Loan No</th>
                        
                        <th>Total Payable</th>
                        <th>Paid</th>
                        <th>Paid Date</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Database connection
                    include './php/dbconnection.php'; // Ensure this file handles your database connection

                    // Fetch all repayment records
                    $query = "SELECT customerid, customername, loanno,  totalpayable, paidamount, paiddate, balancepayable FROM repayment";
                    $result = $conn->query($query);

                    // Check if the query was successful
                    if ($result === false) {
                        // Output the error message
                        echo "Error executing query: " . $conn->error;
                    } else {
                        // Check if there are results
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['customerid']}</td>
                                        <td>{$row['customername']}</td>
                                        <td>{$row['loanno']}</td>
                                        
                                        <td> ₹ {$row['totalpayable']}</td>
                                        <td> ₹ {$row['paidamount']}</td>
                                        <td>{$row['paiddate']}</td>
                                        <td> ₹ {$row['balancepayable']}</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>No records found</td></tr>";
                        }
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php include "footer.php"; ?>