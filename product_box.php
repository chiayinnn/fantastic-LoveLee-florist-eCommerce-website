<?php
    @include 'productconn.php';
?>
<html>
    <body>
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
    <script src="script.js"></script>
    </body>
</html>