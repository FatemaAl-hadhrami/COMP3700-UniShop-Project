
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Response</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" 
crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" 
crossorigin="anonymous"></script>
  
  <script type="text/javascript">
  // Function to handle search action
  function validateSearch(){
      let searchBox = document.getElementById("searchInput");
      let word = searchBox.value.trim().toLowerCase();
      // check if the search box is empty
      if (word== "") {
        alert("Please enter a search word");
        searchBox.focus();
        return false;

      }
  // For academic items
  if(word.includes("pen")){
    window.location.href="academic_supplies.html#pens";
    return false;
  }
   if(word.includes("notebook")){
window.location.href="academic_supplies.html#notebooks";
    return false;
   }
      if(word.includes("single book") || word.includes("book") ){
window.location.href="academic_supplies.html#singlebook";
    return false;
   }

  if(word.includes("graphing calculator")|| word.includes("graphing")){
window.location.href="academic_supplies.html#calculator911";
    return false;
   }
   
     if(word.includes("calculator" )){
window.location.href="academic_supplies.html#calculator82";
    return false;
   }
   
   if(word.includes("note")||word.includes("study") ){
window.location.href="academic_supplies.html#studynotes";

    return false;
   }
   if(word.includes("gray bag") || word.includes("grey bag")){
    window.location.href="academic_supplies.html#graybag";
    return false;
   }
      if(word.includes("brown bag")){
    window.location.href="academic_supplies.html#brownbag";
    return false;
   }
      if(word.includes("laptop") || word.includes("computer")){
window.location.href="academic_supplies.html#laptop";

    return false;
   }
    if(word.includes("bag")){
window.location.href="academic_supplies.html";

    return false;
   }
      if(word.includes("lab coat") ){
window.location.href="medical-items.html#labcoat";

    return false;
   }
      if(word.includes("scrubs")){
window.location.href="medical-items.html#scrubs";

    return false;
   }
   
         if(word.includes("stethoscope")){
window.location.href="medical-items.html#stethoscope";

    return false;
   }
            if(word.includes("mask") ){
window.location.href="medical-items.html#mask";

    return false;
   }
            if(word.includes("gloves")|| word.includes("glove")){
window.location.href="medical-items.html#gloves";

    return false;
   }
            if(word.includes("syringe")){
window.location.href="medical-items.html#syringe";

    return false;
   }
   // If item is not found
      alert("Item not found");
    return false;
    }

    //validation for each form element
    function validReview(){
        let emailadd = document.getElementById("email"); 
        let username = document.getElementById("name");
        let password = document.getElementById("password");
        let passcheck = document.getElementById("confirmpass");
        var radios;
        var x = 0;
        var y;
        var checker = false;
        document.getElementById("errorname").innerText="";
        document.getElementById("erroremail").innerText="";
        document.getElementById("errorpass").innerText="";
        document.getElementById("errorconfirm").innerText="";
        document.getElementById("rating").innerText="";
        document.getElementById("errorother").innerText = "";
        //indicate if username field is empty and focus on username 
        if (username.value == ""){
            document.getElementById("errorname").innerText="Please enter your full name.";
    
            username.focus();
            return false;
        }
        //indicate if username characters are invalid and focus on username 
        if (username.value.search(/\d+/) !== -1){
            document.getElementById("errorname").innerText="Usernames cannot contain numbers. Please enter a valid username.";
    
            username.focus();
            return false;
        }

        //indicate if email field is empty and focus on email
        if (emailadd.value == ""){
            document.getElementById("erroremail").innerText="Please enter an email address.";
            emailadd.focus();
            return false;
        }
        //indicate if email format is incorrect (email cannot exclude @ or .) and focus on email
        if ((emailadd.value.search(/@/) == -1) || (emailadd.value.search(/\./) == -1 )){
            document.getElementById("erroremail").innerText="Please enter a valid email address.";
            emailadd.focus();
            return false;
        }
        
        //indicate if password field is empty and focus on the field 
        if (password.value==""){
            document.getElementById("errorpass").innerText="Please enter your password.";
            password.focus();
            return false;
        }
        //indicate if confirm password field is empty
        if (passcheck.value == ""){
            document.getElementById("errorconfirm").innerText="Please confirm your password.";
            passcheck.focus();
            return false;
        }
        //indicate if passwords don't match
        if (passcheck.value != password.value){
            document.getElementById("errorconfirm").innerText="Passwords do not match.";
            passcheck.focus();
            return false;
        }

        //indicate if no option for job is selected
        radios = document.getElementsByName("job");
        if (radiochecker(radios) == false){
            return false;
        }
        //indicate if no option for gender is selected
        radios = document.getElementsByName("Gender");
        if (radiochecker(radios) == false){
            return false;
        }
        //indicate if no options were selected for rating layout of the website
        radios = document.getElementsByName("Layout");
        if (radiochecker(radios) == false){
            return false;
        }
        //indicate if no options were selected for rating navigation
        radios = document.getElementsByName("navigation");
        if (radiochecker(radios) == false){
            return false;
        }
        //indicate if no options were selected for rating design of the website
        radios = document.getElementsByName("design");
        if (radiochecker(radios) == false){
            return false;
        }
        //indicate if no options were selected for rating product quality
        radios = document.getElementsByName("products");
        if (radiochecker(radios) == false){
            return false;
        }
        //indicate if no options were selected for rating delivery services
        radios = document.getElementsByName("delivery");
        if (radiochecker(radios) == false){
            return false;
        }
        //indicate if no options were selected for rating customer service 
        radios = document.getElementsByName("services");
        if (radiochecker(radios) == false){
            return false;
        }
        // indicate if "other" was picked for "how did you find out about unishop" and nothing was entered in the textbox
        let otherCheck = document.getElementById("other");
        let otherContent = document.getElementById("optBox");
        if ((otherCheck.checked)&&(otherContent.value =="")){
          document.getElementById("errorother").innerText = "Please specify how you found out about UniShop.";
          otherContent.focus();
          return false;
        }
      //indicate if "other" textbox does not contain any word characters
        if ((otherContent.value != "")&&(otherContent.value.search(/\w+/)==-1)){
          
          document.getElementById("errorother").innerText = "Please enter valid (word) characters.";
          otherContent.focus();
          return false;
        }
        return true;

    } 

    //function to check radio button groups and alert if no options are chosen
    function radiochecker(radiogroup){
        let checker = false;
        for (let radio of radiogroup){
            if (radio.checked){
                checker = true;
                break;
            }
        }
        if(checker == false){
            y = radiogroup[0].name;
            document.getElementById("rating").innerText = "Please rate our "+ y + ".";
        }
        return checker;
    }

    //show the selected age group from the dropdown menu
    function ageselect(agegroup){
        const agedisplay = document.getElementById("ageGroup");
        agedisplay.innerText = agegroup;
        document.getElementById("ageInput").value = agegroup;
    }
    function askbox(){
        document.getElementById("optBox").style.display = "block";
        
    }
    </script>
  
</head>
<body class="bg-light">
    <header class="container-fluid bg-white">
        <div class="row align-items-center p-4">
             <div class="col-md-2">
                 <p class="h3 text-primary">UniShop</p>
                  <a href="index.html">
                      <img src="images/UniShop_logo.png" alt="UniShop - Your Campus Store" class="img-fluid" />
                  </a>
             </div>
            <div class="col-md-6">
                <form action="https://httpbin.org/get" name="searchForm"method="get" onsubmit="return validateSearch()" novalidate>
                    <div class="row">
                         <div class="col-8">
                             <input type="text" id="searchInput" name="query" class="form-control"/>
                         </div>
                        <div class="col-4">
                             <input type="submit" value="Search" class="btn btn-primary" />
                        </div>
                   </div>
                </form>
            </div>
            <div class="col-md-4 text-end">
                <a href="login_and_registration.php" class="btn btn-outline-primary">Login / Register</a>
                <a class="btn btn-outline-primary fs-4" href="cart.php"  >
                    🛒
                    <span class="text-danger">0</span>
                </a>
            </div>
        </div>
    </header>
    
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
        <div class="container-fluid">
            <div class="navbar-nav flex-wrap">
                <a class="nav-link"  href="index.html">Home</a>
                <a class="nav-link" href="About_us.html">About Us</a>
                <a class="nav-link" href="academic_supplies.html">Academic Supplies</a>
                <a class="nav-link"  href="medical-items.html">Medical & Laboratory Items</a>
                <a class="nav-link" href="contact_us.html">Contact Us</a>
                <a class="nav-link" href="cart.php">My Cart</a>
                <a class="nav-link"  href="login_and_registration.php">Login</a>
                <a class="nav-link" href="order_tracking.html">Order Tracking</a>
                <a class="nav-link " href="questionnaire.html">Questionnaire</a>
                <a class="nav-link" href="calculator.html">Calculator</a>
                <a class="nav-link" href="funpage.php">Fun Page</a>
                <a class="nav-link " href="products.php">Products</a>
                <a class="nav-link " href="wish_list.php">Wish List</a>
            </div>
        </div>
    </nav>
    <?php
    //connect to database 
    $servername = "localhost"; $username="root"; $password = ""; $dbname = "unishop";

    //connect to unishop database
    $conn = mysqli_connect($servername,$username,$password,$dbname);

    //check connection 
    if(!$conn){
        die("Connection failed: " .mysqli_connect_error());
    }
    //get input from questionnaire form
    $myEmail = $_POST['email']; $myUser = $_POST['user']; $myJob = $_POST['job']; $myGender = $_POST['Gender']; $myAge = $_POST['age_group'];
    $mySources ="";
    if(isset($_POST['sources'])){
        $mySources = implode(", ",$_POST['sources']);
    }
    if (!empty($_POST['other_source'])){
        $mySources .= " ". $_POST['other_source'];
    }
    $myLayout = $_POST['Layout']; $myNavigation = $_POST['navigation']; $myDesign = $_POST['design']; $myProducts = $_POST['products']; $myDelivery = $_POST['delivery']; $myServices = $_POST['services'];
    $myComment = $_POST['comment'];

    //add to table
    $sql = "insert into responses (email, name, job, gender, age_group, sources, layout_rating, navigation_rating, design_rating, product_rating, delivery_rating, services_rating, comment)
            values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param( $stmt,
        "sssssssssssss", $myEmail, $myUser, $myJob, $myGender, $myAge, $mySources, $myLayout, $myNavigation, $myDesign, $myProducts, $myDelivery, $myServices, $myComment
    );
    if (mysqli_stmt_execute($stmt)){
        echo "<p style='background-color: lightgreen;'>Your response has been saved successfully. Thank you!</p>";
    } else {echo "<h1 class='text-danger text-center'>Error: " . mysqli_error($conn) . "</h1>";}
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
    ?>

        <br>
    <footer class="bg-primary text-white text-center py-3">
        <p  class="mb-0">&copy; 2026 UniShop. All rights reserved.</p>
    </footer>

    
</body>
</html>
