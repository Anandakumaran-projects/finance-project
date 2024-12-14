<?php include "header.php";?>
<main class="flex-grow-1" style="margin-left: 280px; transition: margin-left 0.3s;">
        <div class="container" style="margin-top: 15px;">
            <h3 style="line-height: 60px;">Loan Repayment</h3>
            <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Repayment</li>
  </ol>
</nav>
<form class="row g-3" method="post" action="./php/repaymentinsert.php">
	<div class="col-md-6">
    <label for="inputid4" class="form-label">Loan Number</label>
    <input type="text" class="form-control" name="loanno" id="loanno" required>
  </div>
	<div class="col-md-6">
    <label for="inputid4" class="form-label">Customer Id</label>
    <input type="text" class="form-control" name="customerid" id="customerid" readonly>
  </div>
  <div class="col-md-6">
    <label for="inputid4" class="form-label">Customer Name</label>
    <input type="text" class="form-control" name="customername" id="customername" readonly>
  </div>
  <div class="col-md-6">
    <label for="inputid4" class="form-label">Loan amount</label>
    <div class="input-group">
                    <span class="input-group-text">₹</span>
    <input type="text" class="form-control" name="loanamount" id="loanamount" readonly>
  </div>
  </div>
  <div class="col-md-6">
    <label for="inputid4" class="form-label">Interest(%)</label>
    <input type="text" class="form-control" name="interest" id="interest" readonly>
  </div>
  <div class="col-md-6">
    <label for="inputid4" class="form-label">Tenure(in months)</label>
    <input type="text" class="form-control" name="tenure" id="tenure" readonly>
  </div>
  <div class="col-md-6">
                <label for="payableamount" class="form-label">Payable Amount (each month)</label>
                <div class="input-group">
                    <span class="input-group-text">₹</span>
                    <input type="text" class="form-control" name="payableamount" id="payableamount" required readonly>
                </div>
            </div>
  <div class="col-md-6">
    <label for="inputid4" class="form-label">Paid amount</label>
    <div class="input-group">
                    <span class="input-group-text">₹</span>
    <input type="text" class="form-control" name="paid" id="paid" required>
  </div>
</div>
  <div class="col-md-6">
    <label for="inputid4" class="form-label">Paid Date</label>
    <input type="date" class="form-control" name="paiddate" id="paiddate" required>
  </div>
  <div class="col-md-6">
    <label for="inputid4" class="form-label">Total Payable</label>
   <div class="input-group">
                    <span class="input-group-text">₹</span>
    <input type="text" class="form-control" name="totalpayable" id="totalpayable" readonly>
  </div>
  </div>
  <div class="col-md-12">
    <label for="inputid4" class="form-label">Balance Payable</label>
    <div class="input-group">
                    <span class="input-group-text">₹</span>
    <input type="text" class="form-control" name="balancepayable" id="balancepayable" readonly>
  </div>
  </div>
<div class="col-12">
    <button type="submit" class="button1" name="submit">Add Income Source</button>
    <button type="button" class="button">Repayment List</button>
  </div>
</form>
</div>
</main>
<script type="text/javascript">
 $(document).ready(function() {
    $('#loanno').on('input', function() {
        const loanno = $(this).val().trim(); // Get the loan number and trim whitespace
        if (loanno) { // Check if loan number is not empty
            $.ajax({
                url: './php/fetchloandata.php',
                type: 'GET',
                data: { loanno: loanno },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.customername && response.customerid && response.loanamount && response.interest && response.tenure && response.payableamount && response.totalpayable) {
                        $('#customername').val(response.customername);
                        $('#customerid').val(response.customerid);
                        $('#loanamount').val(response.loanamount);
                        $('#interest').val(response.interest);
                        $('#tenure').val(response.tenure);
                        $('#payableamount').val(response.payableamount);
                        $('#totalpayable').val(response.totalpayable);
                        $('#error-message').text(''); // Clear any previous error message
                    } else {
                        $('#error-message').text('No Customer found');
                        $('#customername').val('');
                        $('#customerid').val('');
                        $('#loanamount').val('');
                        $('#interest').val('');
                        $('#tenure').val('');
                        $('#payableamount').val('');
                        $('#totalpayable').val('');
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
            $('#loanamount').val('');
            $('#interest').val('');
            $('#tenure').val('');
            $('#payableamount').val('');
            $('#totalpayable').val('');
            $('#error-message').text('Please enter a loan number.'); // Alert if loan number is empty
        }
    });
 $('#paid').on('input', function() {
        calculateBalance();
    });

    function calculateBalance() {
        const totalPayable = parseFloat($('#totalpayable').val()) || 0;
        const paidAmount = parseFloat($('#paid').val()) || 0;
        const balancePayable = totalPayable - paidAmount;
        $('#balancepayable').val(balancePayable.toFixed(2)); // Show balance payable with 2 decimal places
    }

    function clearFields() {
        $('#customername').val('');
        $('#customerid').val('');
        $('#loanamount').val('');
        $('#interest').val('');
        $('#tenure').val('');
        $('#payableamount').val('');
        $('#totalpayable').val('');
        $('#balancepayable').val('');
    }
});
</script>
<?php include"footer.php";?>