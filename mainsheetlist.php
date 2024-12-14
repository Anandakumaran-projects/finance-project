<?php include "header.php"; ?>
<main class="flex-grow-1" style="margin-left: 280px; transition: margin-left 0.3s;">
    <div class="container" style="margin-top: 15px;">
        <h3 style="line-height: 60px;">Available Balance</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mainsheet</li>
            </ol>
        </nav>
        <div class="table-responsive">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Outcome</th>
                        <th>Income</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Database connection
                    include './php/dbconnection.php'; // Ensure this file handles your database connection

                    // Fetch all repayment records
                    $query = "SELECT id, loanamount, paidamount, newbalance FROM mainbalance";
                    $result = $conn->query($query);

                    // Check if the query was successful
                    if ($result === false) {
                        // Log the error message instead of displaying it
                        error_log("Error executing query: " . $conn->error);
                        echo "<tr><td colspan='4'>An error occurred while fetching records.</td></tr>";
                    } else {
                        // Check if there are results
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['id']}</td>
                                        <td style='color:red; font-weight:bold;'>- ₹ {$row['loanamount']}</td>
                                        <td style='color:darkgreen;font-weight:bold;'>+ ₹ {$row['paidamount']}</td>
                                        <td style='color:blue;font-weight:bold;'> ₹ {$row['newbalance']}</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No records found</td></tr>";
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