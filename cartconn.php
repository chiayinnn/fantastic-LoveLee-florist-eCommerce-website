<?php
    require_once 'productconn.php';
    $cart_id = $_POST['cart_id'];
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_color = $_POST['product_color']; 
    $quantity = $_POST['quantity']; 
    
    $pid = $product_id;
    $pname = $product_name;
    $pcolour = $product_color;
    $price = $product_price;
    $image = $product_image;

    $sql = "INSERT INTO cart (product_id, pname, pcolour, price, quantity, image) VALUES ( ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiis", $product_id, $product_name, $product_color, $product_price, $quantity, $product_image);
    $stmt->execute();
    
    echo '<script>alert("Payment Successfully!!");
    window.location.href = "cartpay.php";</script>';
    exit();
?>