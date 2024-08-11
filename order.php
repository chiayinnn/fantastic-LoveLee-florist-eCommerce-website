<?php
require_once 'productconn.php';

$result = mysqli_query($conn, "SELECT * FROM orders ORDER BY order_id");

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="navbar.css">
    <style>
        body {
            text-align: center;
            background-color: #F8F4EC; 
        }

        .button-container {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            align-items: center;
        }

        table {
            margin: 0 auto;
            margin-top: 20px;
            width: 50%;
            text-align: left;
        }

        .buttons {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button {
            background-color: #F7418F;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            width: 100px;
            height: 30px;
        }

        .button:hover {
            background-color: #FFD0EC;
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
    <form action="cartpay.php" method="post">
        <button type="submit" class="logout-btn">
            <img src="cart.png" alt="Cart">
        </button>
    </form>
</div>

<div class="navbar">
    <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="#products">All Products</a></li>
        <li><a href="cartpay.php">Cart</a></li> 
        <li><a href="order.php">Orders</a></li>
    </ul>
</div>

<?php
$current_order_id = null; // Initialize current order_id variable

while ($row = mysqli_fetch_assoc($result)) {
    if ($row['order_id'] !== $current_order_id) {
        // Start new table for each order_id
        if ($current_order_id !== null) {
            // Output total price for the order
            echo "<tr><td>TOTAL:</td><td colspan='3'>" . $total . "</td></tr>";
            echo "</table>";
            // Output reorder button
            echo "</br><form action='reorder.php' method='post'>";
            echo "<input type='hidden' name='order_id' value='" . $current_order_id . "'>";
            echo "<input type='submit' class='button' name='Re-order' value='Re-Order'>";
            echo "</form>";
        }
        echo "<table border='1'>";
        // Output shared order information
        echo "<tr><td>NAME:</td><td colspan='3'>" . $row['name'] . "</td></tr>";
        echo "<tr><td>TEL NO:</td><td>" . $row['telephone'] . "</td><td>EMAIL:</td><td>" . $row['email'] . "</td></tr>";
        echo "<tr><td>ADDRESS:</td><td colspan='3'>" . $row['address'] . "</td></tr>";
        echo "<tr><td>PAYMENT METHOD:</td><td colspan='3'>" . $row['method'] . "</td></tr>";
        echo "<tr><td>LOGISTICS CHOICES:</td><td colspan='3'>" . $row['choices'] . "</td></tr>";
        echo "<tr><td>YOUR ORDERS:</td><td colspan='3'>";
        $total = 0; // Initialize total price for the current order
    }
    // Output product details for each order
    echo $row['pname'] . " x " . $row['quantity'] . "<br>";
    $total += ($row['price'] * $row['quantity']); // Add the price of each product to the total
    $current_order_id = $row['order_id'];
}
// Output total price for the last order
echo "<tr><td>TOTAL:</td><td colspan='3'>" . $total . "</td></tr>";
echo "</table>";
// Output reorder button for the last order
echo "</br><form action='reorder.php' method='post'>";
echo "<input type='hidden' name='order_id' value='" . $current_order_id . "'>";
echo "<input type='submit' class='button' name='Re-order' value='Re-Order'>";
echo "</form>";
?>

</body>
</html>
