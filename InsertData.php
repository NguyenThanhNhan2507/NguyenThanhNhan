<!DOCTYPE html>
<html>
    <head>
<title>Insert data to PostgreSQL with php - creating a simple web application</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
li {
list-style: none;
}
</style>
</head>
<body>
<h1>Add data in product table</h1>
    <ul>
        <form name="InsertData" action="InsertData.php" method="POST" >
            <li>products_id:</li><li><input type="text" name="products_id" /></li>
            <li>name:</li><li><input type="text" name="name" /></li>
            <li>price:</li><li><input type="text" name="price" /></li>
            <li><input type="submit" value="Add" /></li>
        </form>
    </ul>

<?php

if (empty(getenv("DATABASE_URL"))){
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', 'postgres', '123456');
}  else {
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
    "host=ec2-3-216-129-140.compute-1.amazonaws.com;port=5432;user=
ejfbherakktsuo;password=77a12eb6182890c121f787f8b000a159b74b88cd554011ec4c08173c230c667e;dbname=dct0jqk5rbgl75",
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

if($pdo === false){
     echo "ERROR: Could not connect Database";
}

//Khởi tạo Prepared Statement
//$stmt = $pdo->prepare('INSERT INTO student (stuid, fname, email, classname) values (:id, :name, :email, :class)');

//$stmt->bindParam(':id','SV03');
//$stmt->bindParam(':name','Ho Hong Linh');
//$stmt->bindParam(':email', 'Linhhh@fpt.edu.vn');
//$stmt->bindParam(':class', 'GCD018');
//$stmt->execute();
//$sql = "INSERT INTO student(stuid, fname, email, classname) VALUES('SV02', 'Hong Thanh','thanhh@fpt.edu.vn','GCD018')";
$sql = "INSERT INTO products(products_id, name, price) VALUES ('$_POST[products_id]','$_POST[name]', '$_POST[price]')";
$stmt = $pdo->prepare($sql);
echo ($sql);
    if($stmt->execute() == TRUE){
        echo "Thank you for your add";
    } else {
        echo "You have entered the wrong product";
    }

?>
</body>
</html>
