<?php include "header.php"; ?>
<main class="flex-grow-1" style="margin-left: 280px; transition: margin-left 0.3s;">
    <div class="container" style="margin-top: 15px;">
        <h3 style="line-height: 60px;">Account Registration</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">New Account</li>
            </ol>
        </nav>
        <form class="row g-3" method="post" action="./php/accountinsert.php" id="accountForm">
            <div class="col-md-6">
                <label for="inputid4" class="form-label">Customer Id</label>
                <input type="text" class="form-control" name="customerid" id="customerid" readonly>
            </div>
            <div class="col-md-6">
                <label for="inputname4" class="form-label">Customer Name</label>
                <input type="text" class="form-control" name="customername" id="customername" readonly>
                <small id="nameError" class="text-danger"></small>
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Account Number<span style="color: red;">*</span></label>
                <input type="text" class="form-control" name="accountid" id="accountid" readonly>
                <button type="button" id="generateButton">GenerateId</button>
            </div>
            <div class="col-md-6">
                <label for="inputname4" class="form-label">Phone Number</label>
                <input type="text" class="form-control" name="phonenumber" id="phonenumber">
                <small id="phoneError" class="text-danger"></small>
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Aadhar Number<span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="aadhar" name="aadhar" placeholder="1234 5678 9012" required>
                <small id="aadharError" class="text-danger"></small>
            </div>
            <div class="col-12">
                <label for="inputAddress2" class="form-label">Pan Card<span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="pancard" name="pancard" placeholder="ABCDE1234F" required>
                <small id="panError" class="text-danger"></small>
            </div>
            <div class="col-md-6">
                <label for="inputCity" class="form-label">Account Creation date<span style="color: red;">*</span></label>
                <input type="date" class="form-control" id="accountcreationdate" name="accoutcreationdate" required>
            </div>
            <div class="col-md-6">
                <label for="inputState" class="form-label">Account Type</label>
                <select id="accounttype" name="accounttype" class="form-select">
                    <option selected>Choose...</option>
                    <option value="Savings">Savings</option>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="button1" name="submit">Add Account</button>
            </div>
        </form>
    </div>
</main>
<script type="text/javascript">
  function generateAccountId() {
  // Get the current ID from local storage, or set it to 1 if it's not set
  var currentId = localStorage.getItem("AccountId");
  if (!currentId) {
    currentId = 1;
  } else {
    currentId = parseInt(currentId)+1;
  }

  // Store the new ID in local storage
  localStorage.setItem("AccountId", currentId);

  // Display the new ID in the input box
  document.getElementById("accountid").value ="ACC-"+ currentId;
}

/*// Call the function on page load and on every page refresh
window.onload = generateAccountId;*/
document.getElementById("generateButton").addEventListener("click", generateAccountId);

$(document).ready(function() {
   $("#customername").on("input", function() {
            const name = $(this).val();
            const namePattern = /^[A-Za-z\s]+$/; // Only letters and spaces
            if (name.length < 3) {
                $("#nameError").text("Name must be at least 3 characters long.").show();
            } else if (!namePattern.test(name)) {
                $("#nameError").text("Name must contain characters only.").show();
            } else {
                $("#nameError").hide();
            }
        });

        // Real-time validation for phone number
        $("#phonenumber").on("input", function() {
            const phone = $(this).val();
            const phonePattern = /^[0-9]{10}$/; // 10-digit number
            if (!phonePattern.test(phone)) {
                $("#phoneError").text("Phone number must be a valid 10-digit number.").show();
            } else {
                $("#phoneError").hide();
            }
        });

        // Real-time validation for Aadhar number
        $("#aadhar").on("input", function() {
            const aadhar = $(this).val();
            const aadharPattern = /^[0-9]{4}\s?[0-9]{4}\s?[0-9]{4}$/; // 12-digit number with optional spaces
            if (!aadharPattern.test(aadhar)) {
                $("#aadharError").text("Aadhar number must be a valid 12-digit number.").show();
            } else {
                $("#aadharError").hide();
            }
        });

        // Real-time validation for PAN card
        $("#panForm").on("input", function() {
                const pancard = $(this).val();
                const panPattern = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/; // Format: 5 letters, 4 digits, 1 letter
                if (!panPattern.test(pancard)) {
                    $("#panError").text("Please enter a valid PAN card number in the format: 5 letters, 4 digits, 1 letter (e.g., ABCDE1234F).").show();
                  } else {
                    $("#panError").hide();
                }
            });
    });
$(document).ready(function() {
    $('#phonenumber').on('input', function() {
        const phone = $(this).val().trim(); // Get the phone number and trim whitespace
        if (phone) { // Check if phone number is not empty
            $.ajax({
                url: './php/fetchdata.php',
                type: 'GET',
                data: { phonenumber: phone },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.customername && response.customerid) {
                        $('#customername').val(response.customername);
                        $('#customerid').val(response.customerid);
                        $('#error-message').text(''); // Clear any previous error message
                    } else {
                        $('#error-message').text('No Customer found');
                        $('#customername').val('');
                        $('#customerid').val('');
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
            $('#error-message').text('Please enter a phone number.'); // Alert if phone number is empty
        }
    });
});
</script>
<?php include "footer.php";?>