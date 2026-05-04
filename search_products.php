<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Products</title>
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
            <a class="btn btn-outline-primary" href="login_and_registration.php">Login / Register</a>
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
                <a class="nav-link" href="order_tracking.html">Order Tracking</a>
                <a class="nav-link" href="questionnaire.html">Questionnaire</a>
                <a class="nav-link" href="calculator.html">Calculator</a>
                <a class="nav-link" href="funpage.php">Fun Page</a>
                <a class="nav-link active" href="search_products.php">Search</a>
                <a class="nav-link" href="wish_list.php">Wish List</a>
            </div>
        </div>
    </div>
</nav>


<div class="container mt-4 mb-5">
    <h1 class="fw-bold text-primary mb-1"> Search Products</h1>
    <p class="text-muted mb-4">Search our database by product name, category, or maximum price.</p>


    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold text-primary mb-3">Search Criteria</h5>
            <form method="post" action="search_products.php">
                <div class="row g-3 align-items-end">

                    <div class="col-sm-6 col-lg-4">
                        <label for="keyword" class="form-label fw-bold small text-primary">
                            Product Name
                        </label>
                        <input type="text" id="keyword" name="keyword" class="form-control"
                               placeholder="e.g. notebook, gloves"
                               value="<?php echo isset($_POST['keyword']) ? htmlspecialchars($_POST['keyword']) : ''; ?>">
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <label for="category" class="form-label fw-bold small text-primary">
                            Category
                        </label>
                        <select id="category" name="category" class="form-select">
                            <option value="">-- All Categories --</option>
                            <option value="Academic"
                                <?php echo (isset($_POST['category']) && $_POST['category'] === 'Academic') ? 'selected' : ''; ?>>
                                Academic
                            </option>
                            <option value="Medical"
                                <?php echo (isset($_POST['category']) && $_POST['category'] === 'Medical') ? 'selected' : ''; ?>>
                                Medical
                            </option>
                        </select>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <label for="max_price" class="form-label fw-bold small text-primary">
                            Max Price (OMR)
                        </label>
                        <input type="number" id="max_price" name="max_price" class="form-control"
                               placeholder="e.g. 5.000" min="0" step="0.001"
                               value="<?php echo isset($_POST['max_price']) ? htmlspecialchars($_POST['max_price']) : ''; ?>">
                    </div>

                    <div class="col-sm-6 col-lg-2">
                        <button type="submit" class="btn btn-primary w-100 fw-bold">Search</button>
                    </div>

                </div>
            </form>
        </div>
    </div>


    <?php

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $keyword   = isset($_POST["keyword"])   ? trim($_POST["keyword"])   : "";
        $category  = isset($_POST["category"])  ? trim($_POST["category"])  : "";
        $max_price = isset($_POST["max_price"]) ? trim($_POST["max_price"]) : "";

        // Database connection
        $servername = "localhost";
        $username   = "root";
        $password   = "";
        $dbname     = "unishop";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("<div class='alert alert-danger'>Connection failed: " . mysqli_connect_error() . "</div>");
        }

        
        $sql = "SELECT * FROM products WHERE 1=1";

        if ($keyword !== "") {
            $safe_keyword = mysqli_real_escape_string($conn, $keyword);
            $sql .= " AND name LIKE '%$safe_keyword%'";
        }

        
        if ($category !== "") {
            $safe_category = mysqli_real_escape_string($conn, $category);
            $sql .= " AND category = '$safe_category'";
        }

        if ($max_price !== "" && is_numeric($max_price)) {
            $safe_price = floatval($max_price);
            $sql .= " AND price <= $safe_price";
        }

        $sql .= " ORDER BY category, price";

        $result = mysqli_query($conn, $sql);

        
        echo "<div class='card shadow-sm border-0'>";
        echo "<div class='card-body p-4'>";
        echo "<h5 class='fw-bold text-primary mb-3'>Query Results</h5>";

        if ($result && mysqli_num_rows($result) > 0) {
            $count = mysqli_num_rows($result);
            echo "<p class='text-muted small mb-3'>Found <strong>$count</strong> matching product(s).</p>";

            echo "<div class='table-responsive'>";
            echo "<table class='table table-bordered table-striped table-hover align-middle'>";
            echo "<thead class='table-primary'>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Product Name</th>";
            echo "<th>Category</th>";
            echo "<th>Price (OMR)</th>";
            echo "<th>Stock</th>";
            echo "<th>Add to Wish List</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td class='fw-semibold'>" . $row["name"] . "</td>";
                echo "<td>" . $row["category"] . "</td>";
                echo "<td class='text-primary fw-bold'>" . number_format($row["price"], 3) . " OMR</td>";
                echo "<td>" . $row["stock"] . "</td>";
                echo "<td>
                    <form method='post' action='add_wishlist.php'>
                        <input type='hidden' name='item_name' value='" . $row["name"] . "'>
                        <input type='hidden' name='price'     value='" . $row["price"] . "'>
                        <input type='hidden' name='category'  value='" . $row["category"] . "'>
                        <button type='submit' class='btn btn-outline-primary btn-sm'>+ Wish List</button>
                    </form>
                </td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
            echo "</div>";

        } else {
            echo "<div class='alert alert-warning'>No products matched your search. Try different criteria.</div>";
        }

        echo "</div>";
        echo "</div>";

        mysqli_close($conn);
    }
    ?>

</div>

<footer class="bg-primary text-white text-center py-3">
    <p class="mb-0">&copy; 2026 UniShop. All rights reserved.</p>
</footer>
</body>
</html>
