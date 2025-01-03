<?php include "header.php"; ?>
<main class="flex-grow-1" style="margin-left: 280px; transition: margin-left 0.3s;">
    <div class="container" style="margin-top: 15px;">
        <h3 style="line-height: 60px;">Closed Loans</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Closed loan</li>
            </ol>
        </nav>
        <div class="table-responsive">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>Customer Name</th>
                        <th>Loan No</th>
                        <th>Total Payable</th>
                        <th>Balance</th>
                        <th>Closed Loan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "./php/dbconnection.php";

                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $query = "SELECT customerid, customername, loanno, totalpayable, balancepayable, closedloan FROM repayment WHERE closedloan = 'closed'";
                    $result = mysqli_query($conn, $query);

                    if (!$result) {
                        die("Query failed: " . mysqli_error($conn));
                    }

                   while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['customerid']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['customername']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['loanno']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['totalpayable']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['balancepayable']) . "</td>";
                        
                        // Check the value of closedloan
                        if ($row['closedloan'] === 'opened') {
                            // If the value is 'opened', set the text color to green
                            echo "<td style='color:green;font-weight:bold;'>" . htmlspecialchars($row['closedloan']) . "</td>";
                        } else {
                            // Otherwise, set the text color to red
                            echo "<td style='color:red;font-weight:bold;'>" . htmlspecialchars($row['closedloan']) . "</td>";
                        }
                        
                        echo "</tr>";
                    }


                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php include "footer.php"; ?>