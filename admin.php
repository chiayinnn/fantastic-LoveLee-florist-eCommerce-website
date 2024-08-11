<?php
require_once 'productconn.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="navbar.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        h1{
            text-align: center;
        }

        body {
            background-color: #F8F4EC;
            font-family: Arial, sans-serif;
        }

        .button-container {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            align-items: center;
        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center; 
            margin-top: 30px; 
        }

        .form-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 2px solid black; 
            width: 50%; 
            height: 340px; 
        }

        input[type="text"],
        input[type="file"] {
            width: 50%; 
            padding: 10px; 
            margin-bottom: 10px; 
        }

        input[type="submit"] {
            width: 30%;
            padding: 10px;
            margin-left:70%; 
            background-color: orange; 
            color: white; 
            border: none; 
            border-radius: 5px; 
        }

        form {
            display: flex;
            flex-wrap: wrap;
        }
        .form-col {
            width: 70%;
            padding: 20px;
        }
        .form-row {
            margin-bottom: 10px;
        }
        .image-col {
            width: 30%;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .image-container {
            width: 100%;
            max-width: 200px;
        }

        #stock {
          width: 90%;
          margin: 0 auto;
        }

        #stock-list {
          width: 100%;
          border-collapse: collapse;
          border:2px solid #57200a;
        }

        #stock-list th {
          font-weight: bold;
          padding: 10px;
          text-align: center;
          background-color: #b86531;
          border-bottom: 2px solid #57200a;
          border-right: 2px solid #57200a;
        }

        #stock-list td {
          padding: 10px;
          border-bottom: 2px solid #57200a;
          border-right: 2px solid #57200a;
        }

        #stock-list tr:nth-child(even) {
          background-color: #b86531;
        }

        #stock-list tfoot td {
          font-weight: bold;
          background-color: #ddd;
        }
    </style>
</head>
<body>
<h1>LoveLee Florist<hr></h1>

    <div class="button-container">
        <form action="logindex.php" method="post">
            <button type="submit" class="logout-btn">
                <img src="exit.png" alt="Logout">
            </button>
        </form>
    </div>
    <div class="form-container">
            <div class="form-box">
                <h3>Add a New Product</h3>
                <form action="adminconn.php" method="POST" enctype="multipart/form-data">
                <input type="text" id="productId" name="productId" placeholder="PRODUCT ID"><br>
                <input type="text" id="productName" name="productName" placeholder="PRODUCT NAME"><br>
                <input type="text" id="price" name="price" placeholder="PRICE"><br>
                <input type="text" id="category" name="category" placeholder="CATEGORY"><br>
                <input type="file" id="image" name="image"><br>
                <input type="submit" name="submit" value="ADD">
                </form>
            </div>
    </div>
    <div id="Product Stock">
        <br><br><h1>Product Stock<hr></h1>
        <table id="stock-list">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price(RM)</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
            <?php
             $sql = "SELECT * FROM products";
             $stmt = $conn->prepare($sql);
             $stmt->execute();
             $result = $stmt->get_result();

             if (mysqli_num_rows($result) > 0) {
                 while ($row = mysqli_fetch_assoc($result)) {
                    
                    echo "<tr>";
                    echo "<td>{$row['product_id']}</td>";
                    echo "<td><img src='{$row['image']}' alt='{$row['name']}' width='100' height='100'></td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['category']}</td>";
                    echo "<td>{$row['price']}</td>";
                    echo "<td class='delete-button-cell'><button class='delete-button'>Delete</button></td>";
                    echo "</tr>";
                }}
                ?>
            </tbody>
        </table>
    </div>
    <script src="admin.js"></script>
</body>
</html>