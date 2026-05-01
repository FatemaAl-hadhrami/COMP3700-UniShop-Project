<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Result</title>
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
            <a href="index.html"><img src="images/UniShop_logo.png" alt="UniShop" class="img-fluid"/></a>
        </div>
        <div class="col-md-4 text-end ms-auto">
            <a class="btn btn-outline-primary" href="login_and_registration.html">Login / Register</a>
        </div>
    </div>
</header>

<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
    <div class="container-fluid">
        <div class="navbar-nav flex-wrap">
            <a class="nav-link" href="index.html">Home</a>
            <a class="nav-link" href="About_us.html">About Us</a>
            <a class="nav-link" href="academic_supplies.html">Academic Supplies</a>
            <a class="nav-link" href="medical-items.html">Medical &amp; Laboratory Items</a>
            <a class="nav-link" href="contact_us.html">Contact Us</a>
            <a class="nav-link" href="cart.html">My Cart</a>
            <a class="nav-link" href="login_and_registration.html">Login</a>
            <a class="nav-link" href="order_tracking.html">Order Tracking</a>
            <a class="nav-link" href="questionnaire.html">Questionnaire</a>
            <a class="nav-link active" href="calculator.html">Calculator</a>
            <a class="nav-link" href="funpage.html">Fun Page</a>
            <a class="nav-link" href="wish_list.php">Wish List</a>
        </div>
    </div>
</nav>

<div class="container mt-4 mb-5">
    <h1 class="fw-bold text-primary mb-1">🧮 Bill Calculation Result</h1>
    <p class="text-muted mb-4">Here is your detailed bill summary processed by our server.</p>

    <?php
    $age            = isset($_POST["age"])            ? intval($_POST["age"])            : 0;
    $promo_discount = isset($_POST["promo_discount"]) ? floatval($_POST["promo_discount"]) : 0;
    $delivery_fee   = isset($_POST["delivery_fee"])   ? floatval($_POST["delivery_fee"])   : 1.5;
    $delivery_label = isset($_POST["delivery_label"]) ? $_POST["delivery_label"]           : "Standard Delivery";

    $item_names  = isset($_POST["item_name"])  ? $_POST["item_name"]  : [];
    $item_prices = isset($_POST["item_price"]) ? $_POST["item_price"] : [];
    $item_qtys   = isset($_POST["item_qty"])   ? $_POST["item_qty"]   : [];

    $selected = [];
    $subtotal = 0;

    for ($i = 0; $i < count($item_names); $i++) {
        $qty = intval($item_qtys[$i]);
        if ($qty > 0) {
            $price     = floatval($item_prices[$i]);
            $line      = $qty * $price;
            $subtotal += $line;
            $selected[] = [
                "name"  => $item_names[$i],
                "qty"   => $qty,
                "price" => $price,
                "total" => $line
            ];
        }
    }

    if (count($selected) === 0) {
        echo "<div class='alert alert-warning'>
                <strong>No items selected.</strong> Please go back and choose at least one item.
                <br><a href='calculator.html' class='btn btn-primary mt-2'>← Back to Calculator</a>
              </div>";
        echo "</div></body></html>";
        exit();
    }

    $age_discount    = 0;
    $age_label       = "";

    if ($age > 0 && $age < 25) {
        $age_discount = 10;
        $age_label    = "Student Discount (under 25)";
    } elseif ($age >= 60) {
        $age_discount = 15;
        $age_label    = "Senior Citizen Discount (60+)";
    }

    $total_discount_pct = $age_discount + $promo_discount;
    $discount_amount    = $subtotal * ($total_discount_pct / 100);
    $after_discount     = $subtotal - $discount_amount;
    $vat                = $after_discount * 0.05;
    $grand_total        = $after_discount + $vat + $delivery_fee;

    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "unishop";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $db_ok = false;

    if ($conn) {
        $safe_delivery = mysqli_real_escape_string($conn, $delivery_label);
        $sql = "INSERT INTO bills (subtotal, discount_pct, discount_amount, delivery_fee, vat, total, age, delivery_option)
                VALUES ($subtotal, $total_discount_pct, $discount_amount, $delivery_fee, $vat, $grand_total, $age, '$safe_delivery')";
        $db_ok = mysqli_query($conn, $sql);
        mysqli_close($conn);
    }

    echo "<div class='card shadow-sm border-0 mb-4'>";
    echo "<div class='card-body p-4'>";
    echo "<h5 class='fw-bold text-primary mb-3'>Items Ordered</h5>";
    echo "<div class='table-responsive'>";
    echo "<table class='table table-bordered table-striped table-hover align-middle'>";
    echo "<thead class='table-primary'>";
    echo "<tr><th>Product</th><th class='text-center'>Qty</th><th class='text-end'>Unit Price</th><th class='text-end'>Line Total</th></tr>";
    echo "</thead><tbody>";

    foreach ($selected as $item) {
        echo "<tr>";
        echo "<td class='fw-semibold'>" . htmlspecialchars($item["name"]) . "</td>";
        echo "<td class='text-center'>" . $item["qty"] . "</td>";
        echo "<td class='text-end'>" . number_format($item["price"], 3) . " OMR</td>";
        echo "<td class='text-end text-primary fw-bold'>" . number_format($item["total"], 3) . " OMR</td>";
        echo "</tr>";
    }

    echo "</tbody></table></div>";
    echo "</div></div>";

    
    echo "<div class='card shadow-sm border-0 mb-4'>";
    echo "<div class='card-body p-4'>";
    echo "<h5 class='fw-bold text-primary mb-3'>Bill Summary</h5>";

    // Discount badge
    if ($total_discount_pct > 0) {
        $badge_text = "";
        if ($age_discount > 0 && $promo_discount > 0) {
            $badge_text = $age_label . " (" . $age_discount . "%) + Promo (" . $promo_discount . "%) = " . $total_discount_pct . "% total";
        } elseif ($age_discount > 0) {
            $badge_text = $age_label . ": " . $age_discount . "% off";
        } else {
            $badge_text = "Promo Code: " . $promo_discount . "% off";
        }
        echo "<div class='mb-3'><span class='badge bg-success fs-6'>" . htmlspecialchars($badge_text) . "</span></div>";
    }

    echo "<div class='table-responsive'>";
    echo "<table class='table table-bordered align-middle'>";
    echo "<thead class='table-primary'><tr><th>Description</th><th class='text-end'>Amount (OMR)</th></tr></thead>";
    echo "<tbody>";
    echo "<tr><td>Items Subtotal</td><td class='text-end'>" . number_format($subtotal, 3) . " OMR</td></tr>";

    if ($total_discount_pct > 0) {
        echo "<tr><td>Discount (" . $total_discount_pct . "%)</td>";
        echo "<td class='text-end text-success fw-bold'>– " . number_format($discount_amount, 3) . " OMR</td></tr>";
    }

    echo "<tr><td>Delivery (" . htmlspecialchars($delivery_label) . ")</td><td class='text-end'>" . number_format($delivery_fee, 3) . " OMR</td></tr>";
    echo "<tr><td>VAT (5%)</td><td class='text-end'>" . number_format($vat, 3) . " OMR</td></tr>";
    echo "<tr class='table-primary fw-bold fs-5'><td>Grand Total</td><td class='text-end text-primary'>" . number_format($grand_total, 3) . " OMR</td></tr>";
    echo "</tbody></table></div>";

    // Formula note
    echo "<div class='p-3 bg-light rounded border mt-3'>";
    echo "<p class='fw-bold text-primary small mb-2'>Formula Used:</p>";
    echo "<p class='text-muted mb-1'>After Discount = Subtotal × (1 – " . $total_discount_pct . "%) = " . number_format($after_discount, 3) . " OMR</p>";
    echo "<p class='text-muted mb-1'>VAT = After Discount × 0.05 = " . number_format($vat, 3) . " OMR</p>";
    echo "<p class='text-muted mb-0'>Grand Total = After Discount + VAT + Delivery = " . number_format($grand_total, 3) . " OMR</p>";
    echo "</div>";

    if ($db_ok) {
        echo "<div class='alert alert-success mt-3 mb-0'> Bill saved to database successfully.</div>";
    }

    echo "</div></div>";
    ?>

    <a href="calculator.html" class="btn btn-outline-primary">← Back to Calculator</a>
</div>

<footer class="bg-primary text-white text-center py-3">
    <p class="mb-0">&copy; 2026 UniShop. All rights reserved.</p>
</footer>
</body>
</html>
