<?php
    @include 'productconn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoveLee Florist</title>
    <style>
        body {
            text-align: center;
            background-color: #F8F4EC;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
            text-align: center;
        }

        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            display: flex;
            justify-content: center;
        }

        .navbar li {
            display: inline;
            list-style-type: none;
        }

        .navbar li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar li a:hover {
            background-color: #FDB9C8;
        }

        .button-container {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            align-items: center;
        }

        .button-container form {
            margin-left: 10px;
        }

        .logout-btn {
            border: none;
            background: none;
            cursor: pointer;
        }

        .logout-btn img {
            width: 50px;
            height: 50px;
        }

        .catebar {
            background-color: #008DDA;
            overflow: hidden;
            text-align: center;
        }

        .catebar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            display: flex;
            justify-content: center;
        }

        .catebar li {
            display: inline;
            list-style-type: none;
        }

        .catebar li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .catebar li a:hover {
            background-color: #FDB9C8;
        }

        .product-list {
            max-width: 1500px;
            width: 95%;
            margin: 30px auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: auto;
        }

        .box {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            text-align: center;
        }

        .box img {
            width: 210px;
            height: 240px;
        }

        .color-container {
            display: flex;
            justify-content: center;
        }

        .button {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            margin-bottom: 10px;
            margin-right: 10px;
        }

        /* Pink button */
        .pink {
            background-color: #FF3EA5;
        }

        /* Yellow button */
        .yellow {
            background-color: #F5DD61;
        }

        /* Blue button */
        .blue {
            background-color: #5356FF;
        }

        .selected {
            border: 2px solid black;
        }

    </style>
</head>
<body>
<h1>LoveLee Florist</h1>
    <!-- Logout and Cart buttons -->
    <div class="button-container">
        <form action="logindex.php" method="post">
            <button type="submit" class="logout-btn">
                <img src="exit.png" alt="Logout">
            </button>
        </form>
        <form action="cartpay.php" method="post">
            <button type="submit" class="logout-btn">
                <img src="cart.png" alt="Cart">
            </button>
        </form>
    </div>
    <hr>
    <!-- Navigation Bar -->
    <div class="navbar">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="#products">All Products</a></li>
            <li><a href="cartpay.php">Cart</a></li> 
            <li><a href="order.php">Orders</a></li>
        </ul>
    </div>
    <!-- Welcome Image -->
    <img src="welcome.png" alt="Welcome" width="100%">
    <h2>All Products<hr></h2>
    <!-- Category Bar -->
    <div class="catebar">
        <ul>
            <li><a href="#products" onclick="hidePreviousCategory(); toggleCategory('LoveRomance')">Love & Romance</a></li>
            <li><a href="#products" onclick="hidePreviousCategory(); toggleCategory('graduation')">Graduation</a></li>
            <li><a href="#products" onclick="hidePreviousCategory(); toggleCategory('birthday')">Birthday</a></li>
            <li><a href="#products" onclick="hidePreviousCategory(); toggleCategory('CareSupport')">Care & Support</a></li>
            <li><a href="#products" onclick="hidePreviousCategory(); toggleCategory('AddOn')">Add-On Gift</a></li>
        </ul>
    </div>
    <!-- Product List -->
    <div id="products" class="product-list">
        <?php
        $select_products = mysqli_query($conn, "SELECT * FROM products");
        if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                $product_color_id = 'product_color_' . $fetch_product['product_id'];

        ?>
            <form action="cartconn.php" method="POST"> 
                <div class="box">
                    <img src="<?php echo $fetch_product['image']; ?>" alt="<?php echo $fetch_product['name']; ?>">
                    <h3><?php echo $fetch_product['name']; ?></h3>
                    <h3><?php echo "RM " . $fetch_product['price'] . ".00"; ?></h3>
                    <div class="color-container">
                        <div class="button pink" id="<?php echo 'pink_button_' . $fetch_product['product_id']; ?>" onclick="selectColor('<?php echo $fetch_product['product_id']; ?>', 'pink')"></div>
                        <div class="button yellow" id="<?php echo 'yellow_button_' . $fetch_product['product_id']; ?>" onclick="selectColor('<?php echo $fetch_product['product_id']; ?>', 'yellow')"></div>
                        <div class="button blue" id="<?php echo 'blue_button_' . $fetch_product['product_id']; ?>" onclick="selectColor('<?php echo $fetch_product['product_id']; ?>', 'blue')"></div>
                    </div>
                    <input type="hidden" name="product_id" value="<?php echo $fetch_product['product_id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                    <input type="hidden" name="product_color" id="<?php echo $product_color_id; ?>">
                    <input type="number" name="quantity" value="1" min="1" max="10" class="quantity-input"><br><br>
                    <input type="submit" class="btnCart" name="add_to_cart" value="ADD TO CART">
                </div>
            </form>
                
                <?php
                        }
                    } else {
                        echo "<p>No products found.</p>";
                    }
                ?>
    </div>

    <?php include 'category.php'; ?>
    <script src="script.js"></script>
    </body>
</html>






