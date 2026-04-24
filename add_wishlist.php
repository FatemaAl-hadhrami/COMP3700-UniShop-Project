<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wish List</title>
</head>
<body>
    <?php    
$name = $_POST["item_name"];
$price =$_POST["price"];
$category =$_POST["category"];

// Data base connection 
$servername= "localhost";
$username = "root";
$password = "";
$dbname = "unishop";

// create a connection 
$conn = mysqli_connect($servername,$username,$password,$dbname);

// check the connection 
if(!$conn){
    die("Connection failed: " .mysqli_connect_error());
}else{
    print "Connected successfully </br>";
}

//To insert the data into the database
$sql = "INSERT INTO wishlist (item_name, price, category ) 
VALUES ('$name','$price','$category')";

$result = mysqli_query($conn,$sql);

if($result){
    print "<h2>Item added successfully! </h2>";
    print "<p>Name: $name </p>";
    print "<p>Price: $price  </p>";
    print "<p>Category: $category  </p>";
}else{
    print "Error: " .mysqli_error($conn);

}




// close the connecton
mysqli_close($conn);

?>
<a href="wish_list.php">Back to Wish List </a>

</body>
</html>