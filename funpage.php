<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fun Page - UniShop</title>

  <!-- Bootstrap framework for layout and styling -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<!-- ================= HEADER ================= -->
<header class="container-fluid bg-white">
  <div class="row align-items-center p-4">
    <div class="col-md-2">
      <p class="h3 text-primary">UniShop</p>
      <a href="index.html">
        <img src="images/UniShop_logo.png" class="img-fluid">
      </a>
    </div>
<!--Search Part -->
    <div class="col-md-6">
  <form onsubmit="return validateSearch()">
    <div class="row">
      <div class="col-8">
        <input type="text" id="searchInput" class="form-control" placeholder="Search...">
      </div>
      <div class="col-4">
        <input type="submit" value="Search" class="btn btn-primary w-100">
      </div>
    </div>
  </form>
</div>

    <div class="col-md-4 text-end">
      <a href="login_and_registration.html" class="btn btn-outline-primary">Login / Register</a>
      <a href="cart.html" class="btn btn-outline-primary fs-4">🛒 <span>0</span></a>
    </div>
  </div>
</header>

<!-- ================= NAVBAR ================= -->
<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
  <div class="container-fluid">
    <div class="navbar-nav">
      <a class="nav-link" href="index.html">Home</a>
      <a class="nav-link" href="About_us.html">About Us</a>
      <a class="nav-link" href="academic_supplies.html">Academic Supplies</a>
      <a class="nav-link" href="medical-items.html">Medical & Laboratory Items</a>
      <a class="nav-link" href="contact_us.html">Contact Us</a>
      <a class="nav-link" href="cart.php">My Cart</a>
      <a class="nav-link" href="login_and_registration.php">Login</a>
      <a class="nav-link" href="order_tracking.html">Order Tracking</a>
      <a class="nav-link" href="questionnaire.html">Questionnaire</a>
      <a class="nav-link" href="calculator.html">Calculator</a>
      <a class="nav-link active" href="funpage.php">Fun Page</a>
      <a class="nav-link active" href="products.php">Products</a>
      <a class="nav-link " href="wish_list.html">Wish List</a>
  </div>
  </div>
</nav>

<!-- ================= WORD GAME SECTION ================= -->
<div class="container mt-5">

  <h2 class="text-center text-primary mb-3">Arrange the Words!</h2>

  <!-- Display current level -->
  <p class="text-center">Level: <span id="level">1</span></p>

  <!-- Container where word buttons are generated dynamically -->
  <div id="word-buttons" class="d-flex flex-wrap justify-content-center mb-3"></div>

  <!-- Control buttons -->
  <div class="text-center mb-3">
    <button id="check-btn" class="btn btn-success">Check</button>
    <button id="reset-btn" class="btn btn-warning">Reset</button>
    <button id="hint-btn" class="btn btn-info">Hint</button>
  </div>

  <!-- Result message -->
  <div id="result" class="text-center fs-5"></div>

  <hr>

  <!-- ================= DRAWING GAME ================= -->

  <h3 class="text-center text-primary mt-4">Draw Something 🎨</h3>

  <!-- Color picker allows user to choose drawing color -->
  <div class="text-center mb-2">
    <label>Choose Color: </label>
    <input type="color" id="color-picker" value="#000000">
  </div>

  <!-- Brush size control -->
  <div class="text-center mb-2">
    <label>Brush Size: </label>
    <input type="range" id="brush-size" min="1" max="10" value="3">
  </div>

  <!-- Canvas area for drawing -->
  <div class="text-center">
    <canvas id="canvas" width="400" height="300" class="border bg-white"></canvas>
  </div>

  <!-- Clear drawing button -->
  <div class="text-center mt-2">
    <button id="clear-btn" class="btn btn-danger">Clear</button>
  </div>

</div>

<!-- ================= FOOTER ================= -->
<footer class="bg-primary text-white text-center py-3 mt-5">
  &copy; 2026 UniShop. All rights reserved.
</footer>

<!-- ================= JAVASCRIPT ================= -->
<script>

// SENTENCES DATA (Game Levels)
// Each array represents a full correct sentence
// ===============================
const sentences = [
  ["UniShop", "offers", "the", "best", "academic", "supplies"],
  ["Students", "can", "buy", "books", "online"],
  ["High", "quality", "products", "for", "university"]
];

// Current level index (starts from 0)
let currentLevel = 0;

// Correct sentence for current level
let correctSentence = sentences[currentLevel];

// Shuffled words displayed to user
let shuffledWords = [...correctSentence];

// User selected words
let userSelection = [];

// Shuffle function
// Randomly rearranges array elements
// ===============================
function shuffleArray(array) {
  for (let i = array.length - 1; i > 0; i--) {
    let j = Math.floor(Math.random() * (i + 1));
    [array[i], array[j]] = [array[j], array[i]];
  }
}

// Render Word Buttons
// Creates clickable buttons dynamically for each word
// ===============================
function renderButtons() {
  const container = document.getElementById("word-buttons");
  container.innerHTML = "";

  shuffledWords.forEach((word, index) => {

    let btn = document.createElement("button");
    btn.textContent = word;
    btn.className = "btn btn-outline-primary m-2";

    // When user clicks a word, move it to their sentence
    btn.onclick = () => {
      userSelection.push(word);
      shuffledWords.splice(index, 1);
      renderButtons();
      showSelection();
    };

    container.appendChild(btn);
  });
}

// Show user current sentence
// ===============================
function showSelection() {
  document.getElementById("result").textContent =
    "Your sentence: " + userSelection.join(" ");
}

// Load Level Function
// Resets game for next level
// ===============================
function loadLevel() {

  correctSentence = sentences[currentLevel];
  shuffledWords = [...correctSentence];
  userSelection = [];

  shuffleArray(shuffledWords);
  renderButtons();

  document.getElementById("level").textContent = currentLevel + 1;
  document.getElementById("result").textContent = "";
}

// Check Answer Button
// Compares user sentence with correct one
// ===============================
document.getElementById("check-btn").onclick = () => {

  const result = document.getElementById("result");

  result.classList.remove("text-success", "text-danger");

  // Ensure user selected all words
  if (userSelection.length !== correctSentence.length) {
    result.textContent = "⚠️ Select all words!";
    return;
  }

  // Compare sentences
  if (userSelection.join(" ") === correctSentence.join(" ")) {

    result.textContent = "🎉 Correct!";
    result.classList.add("text-success");

    currentLevel++;

    // Move to next level if available
    if (currentLevel < sentences.length) {
      setTimeout(loadLevel, 1200);
    } else {
      result.textContent = "🏆 You finished all levels!";
    }

  } else {
    result.textContent = "❌ Try again!";
    result.classList.add("text-danger");
  }
};

// Hint System
// Helps user by showing next correct word
// ===============================
document.getElementById("hint-btn").onclick = () => {

  const result = document.getElementById("result");

  if (userSelection.length === 0) {
    result.textContent = "💡 Starts with: " + correctSentence[0];
    return;
  }

  const nextWord = correctSentence[userSelection.length];
  result.textContent = "💡 Next word: " + nextWord;
};

//Reset Game
// ===============================
document.getElementById("reset-btn").onclick = loadLevel;


// Start first level
loadLevel();

//DRAWING GAME (CANVAS)
// ===============================

// Get canvas element and drawing context
const canvas = document.getElementById("canvas");
const ctx = canvas.getContext("2d");

// Track if user is currently drawing
let drawing = false;

// Color and brush inputs
const colorPicker = document.getElementById("color-picker");
const brushSize = document.getElementById("brush-size");


// Start drawing when mouse is pressed
canvas.addEventListener("mousedown", () => drawing = true);


// Stop drawing when mouse is released
canvas.addEventListener("mouseup", () => {
  drawing = false;
  ctx.beginPath(); // reset drawing path
});


// Draw on canvas when mouse moves
canvas.addEventListener("mousemove", (e) => {

  if (!drawing) return;

  ctx.lineWidth = brushSize.value;
  ctx.lineCap = "round";
  ctx.strokeStyle = colorPicker.value;

  ctx.lineTo(e.offsetX, e.offsetY);
  ctx.stroke();

  ctx.beginPath();
  ctx.moveTo(e.offsetX, e.offsetY);
});


// Clear canvas button
document.getElementById("clear-btn").onclick = () => {
  ctx.clearRect(0, 0, canvas.width, canvas.height);
};

</script>

</body>
</html>
