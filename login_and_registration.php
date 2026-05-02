<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login & Register - UniShop</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.error-msg {
  color: red;
  font-size: 0.85rem;
  margin-top: 4px;
  display: block;
}
</style>
</head>

<body class="bg-light">

<!-- ================= HEADER ================= -->
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
      <form onsubmit="return validateSearch()">
        <div class="row g-2">
          <div class="col-9">
            <input type="text" id="searchInput" class="form-control" placeholder="Search...">
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

<!-- ================= NAVBAR ================= -->
<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
           <div class="container-fluid">
      <div class="navbar-nav">

      <a class="nav-link"  href="index.html">Home</a>
          
            <a class="nav-link " href="About_us.html">About Us</a>
           
            <a  class="nav-link" href="academic_supplies.html">Academic Supplies</a>
           
            <a class="nav-link"  href="medical-items.html">Medical & Laboratory Items</a>
          
            <a  class="nav-link" href="contact_us.html">Contact Us</a>
            <a  class="nav-link" href="cart.php">My Cart</a>
            <a class="nav-link active"  href="login_and_registration.php">Login</a>
            <a  class="nav-link" href="order_tracking.html">Order Tracking</a>
             <a  class="nav-link" href="questionnaire.html">Questionnaire</a>
             <a  class="nav-link" href="calculator.html">Calculator</a>
            <a  class="nav-link" href="funpage.php">Fun Page</a>
          <a class="nav-link" href="products.php">Products</a>
             <a class="nav-link " href="wish_list.php">Wish List</a>
        </div>
    </div>

          </nav>

<!-- ================= MAIN ================= -->
<div class="container mt-5 mb-5">
  <div class="row g-5">

    <!-- LOGIN -->
    <div class="col-md-6">
      <div class="p-4 bg-white rounded shadow-sm border">
        <h3 class="text-primary mb-3">Login</h3>

        <form method="POST" action="login.php">

          <input type="text" name="username" class="form-control mb-3" placeholder="Username" required>

          <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

          <button class="btn btn-primary w-100">Login</button>

        </form>
      </div>
    </div>

    <!-- REGISTER -->
    <div class="col-md-6">
      <div class="p-4 bg-white rounded shadow-sm border">
        <h3 class="text-success mb-3">Register</h3>

        <form method="POST" action="register.php">

          <input type="text" name="fullname" class="form-control mb-2" placeholder="Full Name" required>

          <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>

          <input type="text" name="phone" class="form-control mb-2" placeholder="968XXXXXXXX" required>

          <select name="college" class="form-control mb-2" required>
            <option value="">Select College</option>
            <option>Engineering</option>
            <option>Science</option>
            <option>Medicine</option>
          </select>

          <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

          <button class="btn btn-success w-100">Register</button>

        </form>

      </div>
    </div>

  </div>
</div>

<!-- ================= FOOTER ================= -->
<footer class="bg-primary text-white text-center py-3">
  <p class="mb-0">&copy; 2026 UniShop</p>
</footer>

</body>
</html>
