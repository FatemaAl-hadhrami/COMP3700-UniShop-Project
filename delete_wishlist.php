<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Item</title>
</head>
<body>
    <?php
$id= $_POST["id"];
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
}
$sql ="DELETE FROM wishlist WHERE id = $id";
mysqli_query($conn,$sql);

mysqli_close($conn);
header("Location: wish_list.php");
exit();







?>
</body>
</html>