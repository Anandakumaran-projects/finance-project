<?php include "header.php"; ?>
<main class="flex-grow-1" style="margin-left: 280px; transition: margin-left 0.3s;">
    <div class="container" style="margin-top: 15px;">
        <h3 style="line-height: 60px;">Customer Registration</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">New Customer</li>
            </ol>
        </nav>
        <form class="row g-3" method="post" action="./php/customerinsert.php">
            <div class="col-md-6">
                <label for="inputid4" class="form-label">Customer Id</label>
                <input type="text" class="form-control" name="customerid" id="customerid" readonly>
                <button type="button" id="generateButton">Generate Customer ID</button>
            </div>
            <div class="col-md-6">
                <label for="inputname4" class="form-label">Customer Name</label>
                <input type="text" class="form-control" name="customername" id="customername" required>
                <span class="error" id="nameError" style="color: red; display: none;">Name must be at least 3 characters long.</span>
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" required>
                <span class="error" id="emailError" style="color: red; display: none;">Please enter a valid email address.</span>
            </div>
            <div class="col-md-6">
                <label for="inputname4" class="form-label">Phone Number</label>
                <input type="text" class="form-control" name="phonenumber" id="phonenumber" required>
                <span class="error" id="phoneError" style="color: red; display: none;">Please enter a valid phone number.</span>
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" class="form-control" id="address1" name="address1" placeholder="1234 Main St" required>
            </div>
            <div class="col-12">
                <label for="inputAddress2" class="form-label">Address 2</label>
                <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartment, studio, or floor" required>
            </div>
            <div class="col-md-6">
                <label for="inputCity" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">State</label>
                <select id="state" name="state" class="form-select">
                    <option selected>Choose...</option>
                    <option value="Tamilnadu">Tamilnadu</option>
                    <option value="Kerala">Kerala</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">Pincode</label>
                <input type="text" class="form-control" id="pincode" name="pincode" required>
                <span class="error" id="pincodeError" style="color: red; display: none;">Please enter a valid pincode.</span>
            </div>
            <div class="col-12">
                <button type="submit" class="button1" id="addCustomerButton" name="submit">Add Customer</button>
            </div>
        </form>
    </div>
</main>
<script type="text/javascript">
  function generateCustomerId() {
  // Get the current ID from local storage, or set it to 1 if it's not set
  var currentId = localStorage.getItem("CustomerId");
  if (!currentId) {
    currentId = 1;
  } else {
    currentId = parseInt(currentId) + 1;
  }

  // Store the new ID in local storage
  localStorage.setItem("CustomerId", currentId);

  // Display the new ID in the input box
  document.getElementById("customerid").value ="Cus-"+ currentId;
}

/*// Call the function on page load and on every page refresh
window.onload = generateAccountId;*/
document.getElementById("generateButton").addEventListener("click", generateCustomerId);

$(document).ready(function() {
        // Real-time validation for customer name
       $('#customername').on('input', function() {
        const name = $(this).val();
        const namePattern = /^[A-Za-z\s]+$/; // Regular expression to allow only letters and spaces
        if (name.length < 3) {
            $('#nameError').text('Name must be at least 3 characters long.').show(); // Show error for length
        } else if (!namePattern.test(name)) {
            $('#nameError').text('Name must contain Alphabets only.').show(); // Show error for invalid characters
        } else {
            $('#nameError').hide(); // Hide error if valid
        }
    });

        // Real-time validation for email
        $('#email').on('input', function() {
            const email = $(this).val();
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                $('#emailError').show();
            } else {
                $('#emailError').hide();
            }
        });

        // Real-time validation for phone number
        $('#phonenumber').on('input', function() {
            const phone = $(this).val();
            const phonePattern = /^[0-9]{10}$/; // Assuming a 10-digit phone number
            if (!phonePattern.test(phone)) {
                $('#phoneError').show();
            } else {
                $('#phoneError').hide();
            }
        });

        // Real-time validation for pincode
        $('#pincode').on('input', function() {
            const pincode = $(this).val();
            const pincodePattern = /^[0-9]{6}$/; // Assuming a 6-digit pincode
            if (!pincodePattern.test(pincode)) {
                $('#pincodeError').show();
            } else {
                $('#pincodeError').hide();
            }
        });

        // Handle the "Add Customer" button click
        /*$('#addCustomerButton').on('click', function() {
            const nameValid = $('#customername').val().length >= 3;
            const emailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test($('#email').val());
            const phoneValid = /^[0-9]{10}$/.test($('#phonenumber').val());
            const pincodeValid = /^[0-9]{6}$/.test($('#pincode').val());

            if (nameValid && emailValid && phoneValid && pincodeValid) {
                // If all fields are valid, you can proceed with your logic here
                alert('All fields are valid! You can proceed to submit the form or perform any action.');
                // Optionally, you can submit the form via AJAX or any other method
            } else {
                alert('Please fix the errors before proceeding.');
            }
        });*/
    });
</script>
<?php include "footer.php";?>