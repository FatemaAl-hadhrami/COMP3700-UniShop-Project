<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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

<!-- ===== NAVBAR ===== -->
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
                <a class="nav-link active" href="products.php">Products</a>
                <a class="nav-link" href="wish_list.php">Wish List</a>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-4 mb-5">
    <h1 class="fw-bold text-primary mb-1">UniShop Products</h1>
    <p class="text-muted mb-4">Browse all available products stored in our database.</p>

    <?php
    class Product {
        // Attributes
        private $id;
        private $name;
        private $price;
        private $category;
        private $stock;

        public function __construct($id, $name, $price, $category, $stock) {
            $this->id       = $id;
            $this->name     = $name;
            $this->price    = $price;
            $this->category = $category;
            $this->stock    = $stock;
        }

        
        public function getId()       { return $this->id; }
        public function getName()     { return $this->name; }
        public function getPrice()    { return $this->price; }
        public function getCategory() { return $this->category; }
        public function getStock()    { return $this->stock; }

        
        public function setPrice($price)   { $this->price = $price; }
        public function setStock($stock)   { $this->stock = $stock; }

        public function getFormattedPrice() {
            return number_format($this->price, 3) . " OMR";
        }

        public function getStockBadge() {
            if ($this->stock > 10) {
                return "<span class='badge bg-success'>In Stock</span>";
            } elseif ($this->stock > 0) {
                return "<span class='badge bg-warning text-dark'>Low Stock</span>";
            } else {
                return "<span class='badge bg-danger'>Out of Stock</span>";
            }
        }
    }

    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "unishop";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("<div class='alert alert-danger'>Connection failed: " . mysqli_connect_error() . "</div>");
    }

    $sql    = "SELECT * FROM products ORDER BY category, name";
    $result = mysqli_query($conn, $sql);

    $products = [];   

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = new Product(
                $row["id"],
                $row["name"],
                $row["price"],
                $row["category"],
                $row["stock"]
            );
        }
    }

    mysqli_close($conn);

    
    function displayProductsTable($productsArray) {
        if (count($productsArray) === 0) {
            echo "<div class='alert alert-info'>No products found in the database.</div>";
            return;
        }

        echo "<div class='table-responsive shadow-sm rounded'>";
        echo "<table class='table table-bordered table-striped table-hover align-middle mb-0'>";
        echo "<thead class='table-primary'>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Product Name</th>";
        echo "<th>Category</th>";
        echo "<th>Price</th>";
        echo "<th>Stock</th>";
        echo "<th>Availability</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        foreach ($productsArray as $product) {
            echo "<tr>";
            echo "<td>" . $product->getId() . "</td>";
            echo "<td class='fw-semibold'>" . $product->getName() . "</td>";
            echo "<td>" . $product->getCategory() . "</td>";
            echo "<td class='text-primary fw-bold'>" . $product->getFormattedPrice() . "</td>";
            echo "<td>" . $product->getStock() . "</td>";
            echo "<td>" . $product->getStockBadge() . "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
        echo "</div>";

        echo "<p class='text-muted small mt-2'>Showing " . count($productsArray) . " product(s).</p>";
    }

    displayProductsTable($products);
    ?>

</div>

<footer class="bg-primary text-white text-center py-3">
    <p class="mb-0">&copy; 2026 UniShop. All rights reserved.</p>
</footer>
</body>
</html>
