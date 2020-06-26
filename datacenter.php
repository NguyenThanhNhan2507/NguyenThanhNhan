<!DOCTYPE html>
<html lang="vn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./mainstyle.css"/>
    <title>ATN's Store</title>
</head>
<body>
        <?php
        ini_set('display_errors', 1);
        if (empty(getenv("DATABASE_URL"))){
            $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', 'postgres', '123456');
        }  else {
            echo getenv("dbname");
        $db = parse_url(getenv("DATABASE_URL"));
        $pdo = new PDO("pgsql:" . sprintf(
                "host=ec2-52-7-39-178.compute-1.amazonaws.com;port=5432;user=pywptpbruozrrv;password=b35ae4e2595488eeda104cdb0b7ef15be8c3c8dd92cca70d6c576da8950cf8d5;dbname=d4rkh71lld4jfg",
                $db["port"],
                $db["user"],
                $db["pass"],
                ltrim($db["path"], "/")
        ));
        }  

        $sql = "SELECT * FROM products ORDER BY product_id";
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $resultSet = $stmt->fetchAll();
    ?>
    <h1>ATN's Store</h1>
    <button onclick="location.href='index.php'">Home</button>
    <div class="container">
            <div class="grid-item">
                <a href="./DeleteData.php" target="framename"><b>Delete Toy</b></a>
            </div>
            <div class="grid-item">
                <a href="UpdateData.php" target="framename"><b>Update Toy</b></a>
            </div>
            <div id ="displaychange" class="grid-item">
               
               <table width="400" height="200" border="2">  
                    <thead>
                    <tr>
                        <td>product_id</td>
                    </tr>
                    <tr>
                        <td>name</td>
                    </tr>
                    <tr>
                        <td>price</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                   
                            foreach ($resultSet as $row) {
                    ?>
                    
                    <tr>
                        <td scope="row"><?php echo $row['product_id'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['price'] ?></td>     
                    </tr>
                    
                    <?php
                            }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="./data.js"></script>
</body>
</html>