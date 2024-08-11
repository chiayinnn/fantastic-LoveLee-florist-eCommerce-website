<?php
require_once 'productconn.php';

// Check if $_POST data is set
if(isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // Prepare and execute the insert statement
    $insert_sql = "INSERT INTO cart (pname, pcolour, quantity, price, image) 
                   SELECT pname, pcolour, quantity, price, image
                   FROM orders 
                   WHERE order_id = ?";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("i", $order_id);

    // Execute the prepared statement
    if($insert_stmt->execute()) {
        echo '<script>alert("Re-Order Successfully!!");
        window.location.href = "cartpay.php";</script>';
        exit(); 
    } else {
        // Handle case where insertion fails
        echo "Failed to insert into cart.";
    }
} else {
    // Handle case where $_POST data is missing
    echo "Missing POST data.";
}
?>
