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
<header class="container-fluid bg-white border-bottom">
  <div class="row align-items-center py-3 px-4">

    <!-- LOGO -->
    <div class="col-md-3 d-flex align-items-center">
      <a href="index.php" class="d-flex align-items-center text-decoration-none">
        <img src="images/UniShop_logo.png" style="height:70px;">
      </a>
    </div>

    <!-- SEARCH -->
    <div class="col-md-6">
      <form action="search.php" method="GET">
        <div class="row g-2">
          <div class="col-9">
            <input type="text" id="searchInput" name="query" class="form-control" placeholder="Search...">
          </div>
          <div class="col-3">
            <button class="btn btn-primary w-100">Search</button>
          </div>
        </div>
      </form>
    </div>

    <!-- LOGIN + CART -->
    <div class="col-md-3 d-flex justify-content-end align-items-center gap-2">

      <a href="login_and_registration.php" class="btn btn-outline-primary">
        Login / Register
      </a>

      <a href="cart.php" class="btn btn-outline-primary position-relative">
        🛒
        <span class="text-danger">0</span>
      </a>

    </div>

  </div>
</header>

<!-- ================= NAVBAR (مطابق للصورة) ================= -->
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
      <a class="nav-link text-white" href="wish_list.php">Wish List</a>
    </div>

  </div>
</nav>

<!-- ================= REGISTER CONTENT  ================= -->
<div class="container mt-5">

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $username = $conn->real_escape_string($_POST['username']);
    $phone    = $conn->real_escape_string($_POST['phone']);
    $college  = $conn->real_escape_string($_POST['college']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "INSERT INTO users (fullname, username, phone, password, college)
            VALUES ('$fullname', '$username', '$phone', '$password', '$college')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Account Created Successfully!</div>";
    }
}
?>

</div>

</body>
</html>
