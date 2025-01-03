<?php include "header.php"; ?>
<?php
include "./php/dbconnection.php";

// Define how many results you want per page
$results_per_page = 4; // Change this to the number of results you want per page

// Find out the number of results stored in database
$sql = "SELECT COUNT(*) AS total FROM loan";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_results = $row['total'];

// Determine the total number of pages available
$total_pages = ceil($total_results / $results_per_page);

// Determine which page number visitor is currently on
if (!isset($_GET['page']) || $_GET['page'] <= 0) {
    $current_page = 1; // Default to the first page
} else {
    $current_page = (int)$_GET['page'];
}

// Calculate the starting limit for the results on the current page
$starting_limit = ($current_page - 1) * $results_per_page;

// Retrieve the selected results from the database
$sql = "SELECT * FROM loan LIMIT $starting_limit, $results_per_page";
$result = $conn->query($sql);
?>
<main class="flex-grow-1" style="margin-left: 280px; transition: margin-left 0.3s;">
    <div class="container" style="margin-top: 15px;">
        <h3 style="text-align: center;">Loan List</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Loan List</li>
            </ol>
        </nav>
        <div class="card-wrapper">
            <?php
            // Check if there are results and display them in cards
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="cardtable" style="width: 18rem;">
                        <div class="card-bodytable">
                            <h5 class="card-titletable">CustomerId:&nbsp;' . htmlspecialchars($row["customerid"]) . '</h5>
                            <h6 class="card-subtitletable mb-2 text-body-secondary">Customer Name:&nbsp;<span style="color:red;">' . htmlspecialchars($row["customername"]) . '</span></h6>
                            <p class="card-texttable">Phone Number:&nbsp;' . htmlspecialchars($row["phonenumber"]) . '<br>
                            Aadhar No:&nbsp;' . htmlspecialchars($row["aadhar"]) . '<br>
                            Loan No:&nbsp;' . htmlspecialchars($row["loanno"]) . '<br>
                            Loan Amount:&nbsp;₹&nbsp;' . htmlspecialchars($row["loanamount"]) . '<br>
                            Issue Date:&nbsp;' . htmlspecialchars($row["issuedate"]) . '<br>
                            Interest:&nbsp;' . htmlspecialchars($row["interest"]) . '<br>
                            Tenure:&nbsp;' . htmlspecialchars($row["tenure"]) . '<br>
                            Monthly Payable:&nbsp; ₹&nbsp;' . htmlspecialchars($row["payableamount"]) . '</p>
                            <button class="delete"><img src="./images/icons8-trash-24.png"></button>
                            <button class="edit"><img src="./images/icons8-edit-24.png"></button>
                        </div>
                    </div>';
                }
            } else {
                echo '<p>No data found.</p>';
            }
            // Close the database connection
            $conn->close();
            ?>
        </div>

        <!-- Pagination Links -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php
                // Previous Page Link
                if ($current_page > 1) {
                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . '">Previous</a></li>';
                }

                // Page Number Links
                for ($page = 1; $page <= $total_pages; $page++) {
                    if ($page == $current_page) {
                        echo '<li class="page-item active"><a class="page-link" href="#">' . $page . '</a></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="?page=' . $page . '">' . $page . '</a></li>';
                    }
                }

                                // Next Page Link
                if ($current_page < $total_pages) {
                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . '">Next</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
</main>
<?php include "footer.php"; ?>