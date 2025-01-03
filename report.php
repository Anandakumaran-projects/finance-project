<?php include "header.php";?>
<main class="flex-grow-1" style="margin-left: 280px; transition: margin-left 0.3s;">
    <div class="container" style="margin-top: 15px;">
        <h3 style="line-height: 60px;">Get Customer Report</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Customer Report</li>
            </ol>
        </nav>
        <form class="row g-3" method="post" action="customerreport.php">
            <div class="col-md-6">
                <label for="customerid" class="form-label">Customer Id</label>
                <input type="text" class="form-control" name="customerid" id="customerid">
            </div>
            <div class="col-md-6">
                <label for="customerid" class="form-label">Loan Number</label>
                <input type="text" class="form-control" name="loanno" id="loanno">
            </div>
            <div class="col-12">
                <button type="submit" class="button1" name="submit">Get Report</button>
            </div>
            
        </form>
    </div>
</main>
<?php include "footer.php";?>