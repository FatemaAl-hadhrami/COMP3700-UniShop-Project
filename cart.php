<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Cart - UniShop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    
    .qty-btn { width: 35px; }
    .qty-input { width: 50px; text-align: center; border: 1px solid #ddd; margin: 0 5px; }
  </style>
</head>

<body class="bg-light" onload="loadCart()">

<header class="container-fluid bg-white">
  <div class="row align-items-center p-4">
    <div class="col-md-2">
      <p class="h3 text-primary">UniShop</p>
      <a href="index.html">
        <img src="images/UniShop_logo.png" class="img-fluid">
      </a>
    </div>
    
    <div class="col-md-6">
      <form onsubmit="return validateSearch()">
        <div class="row">
          <div class="col-8">
            <input type="text" id="headerSearch" class="form-control" placeholder="Search...">
          </div>
          <div class="col-4">
            <input type="submit" value="Search" class="btn btn-primary w-100">
          </div>
        </div>
      </form>
    </div>

    <div class="col-md-4 text-end">
      <a href="login_and_registration.html" class="btn btn-outline-primary">Login / Register</a>
      <a href="cart.html" class="btn btn-outline-primary fs-4">
        🛒 <span class="text-danger" id="cartCount">0</span>
      </a>
    </div>
  </div>
</header>

<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
  <div class="container-fluid">
    <div class="navbar-nav">
      <a class="nav-link" href="index.html">Home</a>
      <a class="nav-link" href="About_us.html">About Us</a>
      <a class="nav-link" href="academic_supplies.html">Academic Supplies</a>
      <a class="nav-link" href="medical-items.html">Medical & Laboratory Items</a>
      <a class="nav-link" href="contact_us.html">Contact Us</a>
      <a class="nav-link active" href="cart.html">My Cart</a>
      <a class="nav-link" href="login_and_registration.php">Login</a>
      <a class="nav-link" href="order_tracking.html">Order Tracking</a>
      <a class="nav-link" href="questionnaire.html">Questionnaire</a>
      <a class="nav-link" href="calculator.html">Calculator</a>
      <a class="nav-link" href="funpage.php">Fun Page</a>
      <a class="nav-link active" href="products.php">Products</a>
      <a class="nav-link " href="wish_list.html">Wish List</a>
    </div>
  </div>
</nav>

<div class="container mt-5">

  <h2 class="text-center text-primary mb-4">Review Your Cart</h2>

  <div class="row mb-4">
    <div class="col-md-6 offset-md-3">
      <input type="text" id="searchInput" class="form-control" placeholder="Search product..." onkeyup="searchCart()">
    </div>
  </div>

  <p id="searchMessage" class="text-center text-danger fw-bold"></p>

  <div class="table-responsive">
    <table class="table table-bordered text-center align-middle bg-white shadow-sm">
      <thead class="table-primary">
        <tr>
          <th>Product</th>
          <th>Unit Price</th>
          <th>Quantity</th>
          <th>Subtotal</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="cartTable">
        </tbody>
    </table>
  </div>

  <div class="row mt-4 align-items-center">
    <div class="col-md-6">
        <a href="calculator.html" class="btn btn-outline-secondary">← Back to Shopping</a>
    </div>
    <div class="col-md-6 text-end">
        <h4>Grand Total: <span id="grandTotal" class="text-primary">0</span> OMR</h4>
        <button class="btn btn-success btn-lg px-5 mt-2" onclick="checkout()">Proceed to Checkout</button>
    </div>
  </div>

</div>

<footer class="bg-primary text-white text-center py-3 mt-5">
  &copy; 2026 UniShop. All rights reserved.
</footer>

<script type="text/javascript">

function Product(name, price, qty) {
    this.name = name;
    this.price = price;
    this.qty = qty;
}

let cart = [];

function loadCart() {
    let savedCart = localStorage.getItem("cart");

    if (savedCart != null) {
        let data = JSON.parse(savedCart);

        for (let i = 0; i < data.length; i++) {
            cart.push(new Product(data[i].name, data[i].price, data[i].qty));
        }
    }

    displayCart(cart);
}

function displayCart(data) {
    let table = document.getElementById("cartTable");
    let total = 0;

    table.innerHTML = "";

    for (let i = 0; i < data.length; i++) {
        let itemTotal = data[i].price * data[i].qty;
        total = total + itemTotal;

        table.innerHTML += "<tr>" +
            "<td>" + data[i].name + "</td>" +
            "<td>" + data[i].price + "</td>" +
            "<td>" + data[i].qty + "</td>" +
            "<td>" + itemTotal + "</td>" +
            "<td><button class='btn btn-danger btn-sm' onclick='deleteItem(" + i + ")'>Delete</button></td>" +
            "</tr>";
    }

    document.getElementById("grandTotal").innerHTML = total;
    document.getElementById("cartCount").innerHTML = cart.length;
}

function addProduct() {
    let name = document.getElementById("name").value;
    let price = parseFloat(document.getElementById("price").value);
    let qty = parseInt(document.getElementById("qty").value);

    if (name == "" || isNaN(price) || isNaN(qty)) {
        alert("Please fill all fields");
        return;
    }

    cart.push(new Product(name, price, qty));
    localStorage.setItem("cart", JSON.stringify(cart));

    displayCart(cart);

    document.getElementById("name").value = "";
    document.getElementById("price").value = "";
    document.getElementById("qty").value = "";
}

function deleteItem(index) {
    cart.splice(index, 1);
    localStorage.setItem("cart", JSON.stringify(cart));
    displayCart(cart);
}

function searchCart() {
    let value = document.getElementById("searchInput").value.toLowerCase();
    let filtered = [];
    let message = document.getElementById("searchMessage");

    if (value == "") {
        message.innerHTML = "";
        displayCart(cart);
        return;
    }

    for (let i = 0; i < cart.length; i++) {
        if (cart[i].name.toLowerCase().indexOf(value) != -1) {
            filtered.push(cart[i]);
        }
    }

    if (filtered.length == 0) {
        message.innerHTML = "No products found in cart";
    } else {
        message.innerHTML = "";
    }

    displayCart(filtered);
}

</script>

</body> 
</html>
