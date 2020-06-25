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
                "host=ec2-3-216-129-140.compute-1.amazonaws.com;port=5432;user=ejfbherakktsuo;password=77a12eb6182890c121f787f8b000a159b74b88cd554011ec4c08173c230c667e;dbname=dct0jqk5rbgl75",
                $db["host"],
                $db["port"],
                $db["user"],
                $db["pass"],
                ltrim($db["path"], "/")
        ));
        }  

        $sql = "SELECT * FROM products ORDER BY products_id";
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $resultSet = $stmt->fetchAll();
    ?>
    <h1>ATN's Store</h1>
    <button onclick="location.href='index.php'">Back to Homepage</button>
    <div class="container">
        <div class="grid-view">
            <div class="grid-item">
                <a href="./AddDB.php" target="framename"><b>Add Toy</b></a>
            </div>
            <div class="grid-item">
                <a href="./DeleteData.php" target="framename"><b>Delete Toy</b></a>
            </div>
            <div class="grid-item">
                <a href="UpdateData.php" target="framename"><b>Update Toy</b></a>
            </div>
            <div id ="displaychange" class="grid-item">
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th>products_id</th>
                        <th>name</th>
                        <th>price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                   
                            foreach ($resultSet as $row) {
                    ?>
                    
                    <tr>
                        <td scope="row"><?php echo $row['products_id'] ?></td>
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