<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Finance Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" style="color: #fff;">SRI BALA FINANCE</a>
            <button class="toggle-button btn" type="button" aria-label="Toggle sidebar">
                <img src="./images/icons8-menu-24.png" alt="Menu">
            </button>
            <form class="d-flex ms-auto" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit" style="color: #000;background: #fff;">Search</button>
            </form>
        </div>
    </nav>
    <aside>
    <nav class="sidebar" id="sidebar-hidden">
        <ul class="list-unstyled">
            <li><a href="dashboard.php" class="active"><img src="./images/icons8-dashboard-layout-24.png" alt="Dashboard icon">Dashboard</a></li>
            <li><a href="newcustomer.php"><img src="./images/icons8-customer-24.png" alt="New Customer icon">New Customer</a></li>
            <li><a href="newaccount.php"><img src="./images/icons8-bank-account-24.png" alt="New Account icon">New Account</a></li>
            <li><a href="customer_list.php"><img src="./images/icons8-list-24.png" alt="Customer List icon">Customer List</a></li>
            <li><a href="Account_list.php"><img src="./images/icons8-list-24.png" alt="Account List icon">Account Lists</a></li>
            <li><a href="loan.php"><img src="./images/icons8-fund-24.png" alt="Loan icon">Apply For Loan</a></li>
            <li><a href="loan_list.php"><img src="./images/icons8-list-24.png" alt="Loan List icon">Loan Lists</a></li>
            <li><a href="repayment.php"><img src="./images/icons8-transaction-24.png" alt="Outstanding icon">Loan Repayment</a></li>
            <li><a href="repaymentlist.php"><img src="./images/icons8-list-24.png" alt="Loan List icon">Repayment Lists</a></li>
            <!-- <li><a href=""><img src="./images/icons8-analytics-24.png" alt="Loan List icon">Report & Analytics</a></li> -->
            <li><a href="closedloan.php"><img src="./images/icons8-closed-24.png" alt="Closed Loan icon">Closed Loans</a></li>
        </ul>
    </nav>
</aside>
<main>
    
</main>
<script>
        $(document).ready(function() {
            $('.toggle-button').click(function() {
                $('#sidebar-hidden').toggleClass('active');
                // Adjust main content margin based on sidebar visibility
                if ($('#sidebar-hidden').hasClass('active')) {
                    $('main').css('margin-left', '0');
                } else {
                    $('main').css('margin-left', '280px');
                }
            });
        });
        $(document).ready(function(){
            let table = new DataTable('#myTable');
        });
       $(document).ready(function() {
    $(".button").on('click', function() {
        window.location.href = "repaymentlist.php";
    });
});
        $(document).ready(function() {
            // Validate Phone Number
        $('#phonenumber').on('keyup', function() {
            const phonePattern = /^\d{10}$/; // 10-digit phone number
            const phoneValue = $(this).val();
            if (!phonePattern.test(phoneValue)) {
                $('#phoneError').text('Please enter a valid 10-digit phone number.');
            } else {
                $('#phoneError').text('');
            }
        });

        // Validate Aadhar Number
        $('#aadhar').on('keyup', function() {
            const aadharPattern = /^\d{4} \d{4} \d{4} \d{4}$/; // Format: 1234 5678 9012 3456
            const aadharValue = $(this).val();
            if (!aadharPattern.test(aadharValue)) {
                $('#aadharError').text('Please enter a valid Aadhar number in the format: 1234 5678 9012 3456');
            } else {
                $('#aadharError').text('');
            }
        });

        // Validate PAN Card
        $('#pancard').on('keyup', function() {
            const pancardPattern = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/; // Format: CTC1234567
            const pancardValue = $(this).val();
            if (!pancardPattern.test(pancardValue)) {
                $('#panError').text('Please enter a valid PAN card number in the format: CTC1234567');
            } else {
                $('#panError').text('');
            }
        });

        // Form submission validation
        $('#registrationForm').on('submit', function(e) {
            // Check if there are any error messages
            if ($('#phoneError').text() || $('#aadharError').text() || $('#panError').text()) {
                e.preventDefault(); // Prevent form submission
                alert('Please correct the errors before submitting the form.');
            }
        });
    });


    </script>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>