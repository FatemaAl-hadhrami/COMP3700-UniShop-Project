<?php
$conn = new mysqli("localhost", "root", "", "unishop");

class User {
    public $fullname; public $username; public $college;
    public function __construct($f, $u, $c) {
        $this->fullname = $f;
        $this->username = $u;
        $this->college = $c;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Registration - UniShop</title>
</head>

<body class="bg-light">

<!-- ================= HEADER  ================= -->
<header class="container-fluid bg-white">
  <div class="row align-items-center p-4">

    <!-- LOGO -->
    <div class="col-md-2">
      <p class="h3 text-primary mb-1">UniShop</p>

      <a href="index.php">
        <img src="images/UniShop_logo.png" class="img-fluid">
      </a>
    </div>

    <!-- SEARCH -->
    <div class="col-md-6">
      <form onsubmit="return validateSearch()">
        <div class="row">
          <div class="col-8">
            
            <input type="text" id="searchInput" class="form-control">
          </div>
          <div class="col-4">
            <input type="submit" value="Search" class="btn btn-primary"/>
          </div>
        </div>
      </form>
    </div>

    
    <div class="col-md-4 text-end">

      <a href="login_and_registration.php" class="btn btn-outline-primary">
        Login / Register
      </a>

      <a href="cart.php" class="btn btn-outline-primary fs-4">
        🛒 <span class="text-danger">0</span>
      </a>

    </div>

  </div>
</header>

<!-- ================= NAVBAR ================ -->
<nav class="navbar navbar-expand bg-primary py-1">
  <div class="container-fluid px-4">

    <div class="navbar-nav w-100 d-flex justify-content-between">

      <a class="nav-link text-white" href="index.php">Home</a>
      <a class="nav-link text-white" href="About_us.php">About Us</a>
      <a class="nav-link text-white" href="academic_supplies.php">Academic Supplies</a>
      <a class="nav-link text-white" href="medical-items.php">Medical & Laboratory Items</a>
      <a class="nav-link text-white" href="contact_us.php">Contact Us</a>
      <a class="nav-link text-white" href="cart.php">My Cart</a>
      <a class="nav-link text-white active" href="login_and_registration.php">Login</a>
      <a class="nav-link text-white" href="order_tracking.php">Order Tracking</a>
      <a class="nav-link text-white" href="questionnaire.php">Questionnaire</a>
      <a class="nav-link text-white" href="calculator.php">Calculator</a>
      <a class="nav-link text-white" href="funpage.php">Fun Page</a>
        <a class="nav-link text-white" href="products.php">Products</a>
      <a class="nav-link text-white" href="wish_list.php">Wish List</a>
    </div>

  </div>
</nav>

<!-- ================= REGISTER CONTENT  ================= -->
<div class="container mt-5" class="container mt-4 mb-4 flex-grow-1">

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $conn->real_escape_string($_POST['fullname']);
    $username = $conn->real_escape_string($_POST['username']);
    $phone    = $conn->real_escape_string($_POST['phone']);
    $college  = $conn->real_escape_string($_POST['college']);

    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    if ($password !== $confirm) {
        die("<div class='alert alert-danger'>Passwords do not match!</div>");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (fullname, username, phone, password, college)
            VALUES (
                '$fullname',
                '$username',
                '$phone',
                '$hashed_password',
                '$college'
            )";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Account Created Successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}
?>

</div>

<footer class="bg-primary text-white text-center py-3">
    <p class="mb-0">&copy; 2026 UniShop. All rights reserved.</p>
</footer>

</body>
</html>
