<?php
$conn = new mysqli("localhost", "root", "", "unishop");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login Result - UniShop</title>
    
    <style>
        .navbar-nav .nav-link { color:white !important; font-weight:500; padding:10px 14px; }
        .navbar-nav .nav-link:hover { background: rgba(255,255,255,0.15); border-radius:6px; }
        header img { height:60px; }
    </style>
</head>
<body class="bg-light">

<header class="container-fluid bg-white border-bottom shadow-sm">
  <div class="row align-items-center p-3">
    <div class="col-md-3 d-flex align-items-center">
      <a href="index.php" class="text-decoration-none d-flex align-items-center">
        <img src="images/UniShop_logo.png" alt="Logo">
        <span class="ms-3 h3 text-primary mb-0 fw-bold">UniShop</span>
      </a>
    </div>

    <div class="col-md-6">
      <form action="search.php" method="GET" onsubmit="return validateSearch()">
        <div class="input-group">
          <input type="text" id="searchInput" name="query" class="form-control form-control-lg border-2 border-primary" placeholder="Search product category...">
          <button class="btn btn-primary btn-lg px-4" type="submit">Search</button>
        </div>
      </form>
    </div>

    <div class="col-md-3 d-flex align-items-center justify-content-end gap-2">
      <a href="login_and_registration.php" class="btn btn-outline-primary btn-lg px-3">Login / Register</a>
      
      <a href="cart.php" class="btn btn-outline-primary btn-lg position-relative px-3 bg-white text-primary">
        🛒
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
      </a>
    </div>
  </div>
</header>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="mainNav">
      <div class="navbar-nav">
        <a class="nav-link" href="index.php">Home</a>
        <a class="nav-link" href="About_us.php">About Us</a>
        <a class="nav-link" href="academic_supplies.php">Academic Supplies</a>
        <a class="nav-link" href="medical-items.php">Medical & Laboratory Items</a>
        <a class="nav-link" href="contact_us.php">Contact Us</a>
        <a class="nav-link" href="cart.php">My Cart</a>
        <a class="nav-link active" href="login_and_registration.php">Login</a>
        <a class="nav-link" href="order_tracking.php">Order Tracking</a>
        <a class="nav-link" href="questionnaire.php">Questionnaire</a>
        <a class="nav-link" href="calculator.php">Calculator</a>
        <a class="nav-link" href="funpage.php">Fun Page</a>
        <a class="nav-link active" href="products.php">Products</a>
        <a class="nav-link" href="wish_list.php">Wish List</a>
      </div>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $conn->real_escape_string($_POST['username']);
                $password = $conn->real_escape_string($_POST['password']);
                $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();
                    
                    echo "<div class='alert alert-white border border-success border-3 p-5 shadow-sm text-center bg-white'>
                            <h2 class='text-success fw-bold'>Welcome back, " . htmlspecialchars($user['fullname']) . "!</h2>
                            <p class='lead'>Login successful. Redirecting to your dashboard...</p>
                            <a href='index.php' class='btn btn-success btn-lg mt-3'>Go to Store</a>
                          </div>";
                } else {
                    
                    echo "<div class='alert alert-white border border-danger border-3 p-5 shadow-sm text-center bg-white'>
                            <h2 class='text-danger fw-bold'>Login Failed</h2>
                            <p class='lead'>Invalid credentials. Please try again.</p>
                            <a href='login_and_registration.php' class='btn btn-danger btn-lg mt-3'>Back to Login</a>
                          </div>";
                }
            }
            ?>
        </div>
    </div>
</div>

<script>
function validateSearch(){
    let word = document.getElementById("searchInput").value.trim();
    if(word == ""){
        alert("Please enter something to search");
        return false;
    }
    return true;
}
</script>

</body>
</html>
