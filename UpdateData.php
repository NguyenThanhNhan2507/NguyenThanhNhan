<!DOCTYPE html>
<html>
<body>

<h1>Update Product</h1>

<?php
ini_set('display_errors', 1);
echo "Update database!";
?>

<form name="update" action="UpdateData.php" method="POST">
    <label for="id">ID Product:</label><input type="text" name="id" placeholder="input id product"/>
    <label for="newname">New Name:</label><input type="text" name="newname" placeholder="input new product name"/><br>
    <input type="submit" value="Update">
</form>

<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
    "host=ec2-52-7-39-178.compute-1.amazonaws.com;port=5432;user=pywptpbruozrrv;password=
b35ae4e2595488eeda104cdb0b7ef15be8c3c8dd92cca70d6c576da8950cf8d5;dbname=d4rkh71lld4jfg",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  


$sql = "UPDATE products SET name = '$_POST[newname]' WHERE product_id = '$_POST[id]'";
      $stmt = $pdo->prepare($sql);
if($stmt->execute() == TRUE){
    echo "You have successfully updated";
} else {
    echo "You have failed to update";
}
    
?>
</body>
  <h1></h1>
    <button onclick="location.href='datacenter.php'">Cart</button>
</html>
