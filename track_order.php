<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Tracking Result </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</head>
<body class="bg-light">


<header class="container-fluid bg-white">
    <div class="row align-items-center p-4">
        <div class="col-md-2">
            <p class="h3 text-primary">UniShop</p>
            <a href="index.html">
                <img src="images/UniShop_logo.png" alt="UniShop - Your Campus Store" class="img-fluid"/>
            </a>
        </div>
        <div class="col-md-4 text-end ms-auto">
            <a class="btn btn-outline-primary" href="login_and_registration.html">Login / Register</a>
        </div>
    </div>
</header>

<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <div class="navbar-nav flex-wrap">
                <a class="nav-link" href="index.html">Home</a>
                <a class="nav-link" href="About_us.html">About Us</a>
                <a class="nav-link" href="academic_supplies.html">Academic Supplies</a>
                <a class="nav-link" href="medical-items.html">Medical &amp; Laboratory Items</a>
                <a class="nav-link" href="contact_us.html">Contact Us</a>
                <a class="nav-link" href="cart.php">My Cart</a>
                <a class="nav-link" href="login_and_registration.php">Login</a>
                <a class="nav-link active" href="order_tracking.html">Order Tracking</a>
                <a class="nav-link" href="questionnaire.html">Questionnaire</a>
                <a class="nav-link" href="calculator.html">Calculator</a>
                <a class="nav-link" href="funpage.php">Fun Page</a>
                <a class="nav-link" href="products.php">Products</a>
                <a class="nav-link" href="wish_list.php">Wish List</a>
            </div>
        </div>
    </div>
</nav>

<!-- ===== PAGE CONTENT ===== -->
<div class="container mt-4 mb-5">
    <h1 class="fw-bold text-primary mb-1">Order Tracking Result</h1>
    <p class="text-muted mb-4">Below is the order information retrieved from our database.</p>

    <?php
    // Retrieve submitted form values
    $order_number = isset($_GET["order"]) ? trim($_GET["order"]) : "";
    $email        = isset($_GET["email"]) ? trim($_GET["email"]) : "";

    // Basic validation
    if ($order_number === "" || $email === "") {
        echo "<div class='alert alert-warning'>
                <strong>Missing Information:</strong> Please provide both an order number and an email address.
                <br><a href='order_tracking.html' class='btn btn-primary mt-2'>Go Back</a>
              </div>";
    } else {

        // Database connection
        $servername = "localhost";
        $username   = "root";
        $password   = "";
        $dbname     = "unishop";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("<div class='alert alert-danger'>Connection failed: " . mysqli_connect_error() . "</div>");
        }

        $safe_order = mysqli_real_escape_string($conn, $order_number);
        $safe_email = mysqli_real_escape_string($conn, $email);

        $sql    = "SELECT * FROM orders WHERE order_number = '$safe_order' AND email = '$safe_email'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $order = mysqli_fetch_assoc($result);

            $statusBadge = "bg-secondary";
            if ($order["status"] === "Confirmed")      $statusBadge = "bg-success";
            elseif ($order["status"] === "Shipped")    $statusBadge = "bg-info text-dark";
            elseif ($order["status"] === "Delivered")  $statusBadge = "bg-primary";
            elseif ($order["status"] === "Cancelled")  $statusBadge = "bg-danger";

            // ---- Order summary card ----
            echo "<div class='card shadow-sm border-0 mb-4'>";
            echo "<div class='card-body p-4'>";
            echo "<div class='d-flex align-items-center flex-wrap gap-2 mb-3'>";
            echo "<h5 class='fw-bold text-primary mb-0'>Order #" . htmlspecialchars($order["order_number"]) . "</h5>";
            echo "<span class='badge $statusBadge px-3 py-2'>" . htmlspecialchars($order["status"]) . "</span>";
            echo "</div>";

            echo "<div class='table-responsive'>";
            echo "<table class='table table-bordered table-striped align-middle'>";
            echo "<thead class='table-primary'>";
            echo "<tr><th>Field</th><th>Details</th></tr>";
            echo "</thead>";
            echo "<tbody>";
            echo "<tr><td class='fw-bold'>Order Number</td><td>" . htmlspecialchars($order["order_number"]) . "</td></tr>";
            echo "<tr><td class='fw-bold'>Customer Name</td><td>" . htmlspecialchars($order["customer_name"]) . "</td></tr>";
            echo "<tr><td class='fw-bold'>Email</td><td>" . htmlspecialchars($order["email"]) . "</td></tr>";
            echo "<tr><td class='fw-bold'>Order Date</td><td>" . htmlspecialchars($order["order_date"]) . "</td></tr>";
            echo "<tr><td class='fw-bold'>Status</td><td><span class='badge $statusBadge'>" . htmlspecialchars($order["status"]) . "</span></td></tr>";
            echo "<tr><td class='fw-bold'>Total Amount</td><td class='text-primary fw-bold'>" . number_format($order["total_amount"], 3) . " OMR</td></tr>";
            echo "<tr><td class='fw-bold'>Delivery Address</td><td>" . htmlspecialchars($order["delivery_address"]) . "</td></tr>";
            echo "</tbody>";
            echo "</table>";
            echo "</div>"; 

            echo "</div></div>";

        } else {
            echo "<div class='alert alert-danger'>";
            echo "<strong>Order Not Found.</strong> No order matched the number <em>" . htmlspecialchars($order_number) . "</em> and email <em>" . htmlspecialchars($email) . "</em>.";
            echo "<br>Please check your details and try again.";
            echo "</div>";
        }

        mysqli_close($conn);
    }
    ?>

    <a href="order_tracking.html" class="btn btn-outline-primary mt-3">← Back to Order Tracking</a>

</div>

<footer class="bg-primary text-white text-center py-3">
    <p class="mb-0">&copy; 2026 UniShop. All rights reserved.</p>
</footer>
</body>
</html>
