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
            <li>customer_id:</li><li><input type="text" name="customer_id" /></li>
            <li>Email:</li><li><input type="text" name="email" /></li>
            <li>Password:</li><li><input type="text" name="password" /></li>
            <li><input type="submit" value="OK" /></li>
        </form>
    </ul>

<?php

if (empty(getenv("DATABASE_URL"))){
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=d4rkh71lld4jfg', 'postgres', '123456');
}  else {
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
    "host=ec2-52-7-39-178.compute-1.amazonaws.com;port=5432;user=
pywptpbruozrrv;password=b35ae4e2595488eeda104cdb0b7ef15be8c3c8dd92cca70d6c576da8950cf8d5;dbname=d4rkh71lld4jfg",
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
$sql = "INSERT INTO customers(customer_id,email,pasword) VALUES ('$_POST[customer_id]',$_POST[email]','$_POST[password]')";
$stmt = $pdo->prepare($sql);
echo ($sql);
    if($stmt->execute() == TRUE){
        echo "Record inserted successfully.";
    } else {
        echo "Error inserting record: ";
    }

?>
</body>
</html>


<h1>ATN's Store</h1>
    <button onclick="location.href='index.php'">Home</button>
    <div class="container">
        <div class="grid-view">
            <div class="grid-item">
                <a href="#" onClick="displayData()"><b>View Invoice Database</b></a>
            </div>
            <div id ="displaychange" class="grid-item">
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th>customer_id</th>
                        <th>email</th>
                        <th>password</th>
                    </tr>
                    </thead>
                    <tbody>
