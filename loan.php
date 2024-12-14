<?php include("header.php"); ?>
<main class="flex-grow-1" style="margin-left: 280px; transition: margin-left 0.3s;">
    <div class="container" style="margin-top: 15px;">
        <h3 style="line-height: 60px;">Loan Registration</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Loan Account</li>
            </ol>
        </nav>
        <form class="row g-3" method="post" action="./php/loaninsert.php">
            <div class="col-md-6">
                <label for="customerid" class="form-label">Customer Id</label>
                <input type="text" class="form-control" name="customerid" id="customerid" readonly>
            </div>
            <div class="col-md-6">
                <label for="customername" class="form-label">Customer Name</label>
                <input type="text" class="form-control" name="customername" id="customername" readonly>
            </div>
            <div class="col-md-6">
                <label for="phonenumber" class="form-label">Phone Number</label>
                <input type="text" class="form-control" name="phonenumber" id="phonenumber" required>
            </div>
            <div class="col-md-6">
                <label for="aadhar" class="form-label">Aadhar Number</label>
                <input type="text" class="form-control" name="aadhar" id="aadhar" placeholder="1232 2345 5677 8989" readonly>
            </div>
            <div class="col-md-6">
                <label for="loanno" class="form-label">Loan No</label>
                <input type="text" class="form-control" name="loanno" id="loanno" readonly>
                <button type="button" id="generateButton">Generate Loan ID</button>
            </div>
            <div class="col-md-6">
                <label for="interest" class="form-label">Interest (%)</label>
                <input type="number" class="form-control" name="interest" id="interest" required>
            </div>
            <div class="col-md-6">
                <label for="tenure" class="form-label">Tenure (in months)</label>
                <input type="number" class="form-control" name="tenure" id="tenure" required>
            </div>
            <div class="col-md-6">
                <label for="loanamount" class="form-label">Loan Amount</label>
                <div class="input-group">
                    <span class="input-group-text">₹</span>
                    <input type="number" class="form-control" name="loanamount" id="loanamount" required>
                </div>
            </div>
            <div class="col-md-6">
                <label for="issuedate" class="form-label">Loan Issue Date</label>
                <input type="date" class="form-control" name="issuedate" id="issuedate" required>
            </div>
            <div class="col-md-6">
                <label for="payableamount" class="form-label">Payable Amount (each month)</label>
                <div class="input-group">
                    <span class="input-group-text">₹</span>
                    <input type="text" class="form-control" name="payableamount" id="payableamount" required readonly>
                </div>
            </div>
                        <div class="col-md-12">
                <label for="totalpayable" class="form-label">Total Payable</label>
                <div class="input-group">
                    <span class="input-group-text">₹</span>
                    <input type="text" class="form-control" name="totalpayable" id="totalpayable" required readonly>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="button1" name="submit">Add Loan Account</button>
            </div>
        </form>
    </div>
</main>

<script>
    function calculateLoan() {
        // Get input values
        const loanAmount = parseFloat(document.getElementById('loanamount').value);
        const interestRate = parseFloat(document.getElementById('interest').value) / 100; // Convert percentage to decimal
        const tenure = parseInt(document.getElementById('tenure').value);

        // Check if inputs are valid
        if (isNaN(loanAmount) || isNaN(interestRate) || isNaN(tenure) || tenure <= 0) {
            document.getElementById('payableamount').value = '';
            document.getElementById('totalpayable').value = '';
            return;
        }

        // Calculate monthly interest rate
        const monthlyInterestRate = interestRate / 12;

        // Calculate monthly payment using the formula
        const monthlyPayment = loanAmount * (monthlyInterestRate * Math.pow(1 + monthlyInterestRate, tenure)) / (Math.pow(1 + monthlyInterestRate, tenure) - 1);

        // Calculate total payable amount
        const totalPayable = monthlyPayment * tenure;

        // Update the fields with calculated values
        document.getElementById('payableamount').value = monthlyPayment.toFixed(2); // Format to 2 decimal places
        document.getElementById('totalpayable').value = totalPayable.toFixed(2); // Format to 2 decimal places
    }

    // Attach event listeners to the input fields
    document.getElementById('loanamount').addEventListener('input', calculateLoan);
    document.getElementById('interest').addEventListener('input', calculateLoan);
    document.getElementById('tenure').addEventListener('input', calculateLoan);



    function generateLoanId() {
  // Get the current ID from local storage, or set it to 1 if it's not set
  var currentId = localStorage.getItem("LoanId");
  if (!currentId) {
    currentId = 1;
  } else {
    currentId = parseInt(currentId)+1;
  }

  // Store the new ID in local storage
  localStorage.setItem("LoanId", currentId);

  // Display the new ID in the input box
  document.getElementById("loanno").value ="SRI-"+ currentId;
}

/*// Call the function on page load and on every page refresh
window.onload = generateAccountId;*/
document.getElementById("generateButton").addEventListener("click", generateLoanId);

$(document).ready(function() {
    $('#phonenumber').on('input', function() {
        const phone = $(this).val().trim(); // Get the phone number and trim whitespace
        if (phone) { // Check if phone number is not empty
            $.ajax({
                url: './php/fetchaccountdata.php',
                type: 'GET',
                data: { phonenumber: phone },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.customername && response.customerid && response.aadhar) {
                        $('#customername').val(response.customername);
                        $('#customerid').val(response.customerid);
                        $('#aadhar').val(response.aadhar)
                        $('#error-message').text(''); // Clear any previous error message
                    } else {
                        $('#error-message').text('No Customer found');
                        $('#customername').val('');
                        $('#customerid').val('');
                        $('#aadhar').val('');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                    $('#error-message').text('An error occurred while fetching customer details. Please try again.');
                }
            });
        } else {
            $('#customername').val('');
            $('#customerid').val('');
            $('#aadhar').val('');
            $('#error-message').text('Please enter a phone number.'); // Alert if phone number is empty
        }
    });
});
</script>
  
<?php include "footer.php"; ?>