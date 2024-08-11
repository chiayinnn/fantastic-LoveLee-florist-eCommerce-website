<?php
require_once 'productconn.php';

// Retrieve order information from the form
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$paymentMethod = $_POST['method'];
$fname = $_POST['fname'];
$lname = $_POST['lname']; 
$address = $_POST['address']; 
$fullname = $fname . " " . $lname; 

if(isset($_POST['shippingOption'])) {
    $shippingOption = $_POST['shippingOption'];
    $choices = ($shippingOption === 'pickUp') ? 'Pick Up' : 'Shipping';
}

// Retrieve the maximum order_id from the orders table
$insert_order_sql = "SELECT MAX(order_id) AS maxorder_id FROM orders";
$result = $conn->query($insert_order_sql);
$row = $result->fetch_assoc();

// Calculate the next order_id
$next_order_id = ($row['maxorder_id'] !== null) ? $row['maxorder_id'] + 1 : 1;

// Insert order information into the orders table
$insert_order_sql = "INSERT INTO orders (order_id, name, telephone, email, address, method, choices, pname, pcolour, quantity, price, image) 
                     SELECT ?, ?, ?, ?, ?, ?, ?, pname, pcolour, quantity, price, image 
                     FROM cart";
$stmt_order = $conn->prepare($insert_order_sql);
$stmt_order->bind_param("issssss", $next_order_id, $fullname, $telephone, $email, $address, $paymentMethod, $choices);
$stmt_order->execute();

echo '<script>alert("Payment Successfully!!");
 window.location.href = "order.php";</script>';
 exit();
 
$conn->close();
?>
