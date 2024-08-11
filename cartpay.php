<?php
require_once 'productconn.php';

if(isset($_POST['cart_id'])) {
    $cart_id = $_POST['cart_id'];
    
    // Prepare and execute the DELETE query
    $delete_query = "DELETE FROM cart WHERE cart_id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $cart_id); // Assuming cart_id is an integer
    if ($stmt->execute()) {
        // Deletion successful
        echo json_encode(array("success" => true));
    } else {
        // Error in deletion
        echo json_encode(array("success" => false, "error" => "Error deleting item"));
    }
    exit(); // Stop further execution
}

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="navbar.css">
    <style>
        body {
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
            width: 90%;
            text-align: center;
        }

        thead {
            background-color: #B2FFFF;
            font-size: 18px; 
            line-height: 30px; 
        }

        .buttons {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .btnPay {
            background-color: #4CAF50;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .btnPay:hover {
            background-color: #45a049;
        }

        .btnDone {
            background-color: #4CAF50;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .btnDone:hover {
            background-color: #45a049;
        }

        .product-info {
            display: flex;
            align-items: center;
        }

        .product-details {
            margin-left: 10px; 
            text-align: left;
        }

        .product-details p {
            margin: 0; /* Remove default margin for paragraphs */
        }

        .delete-button-cell {
            border: none; /* Remove border for the delete button column */
        }

        .billing-info{
            display:none;
        }

    </style>
</head>
<body>
<h1 style="text-align:center;">LoveLee Florist</h1>
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
<div class="navbar">
    <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="home.php#products">All Products</a></li>
        <li><a href="cartpay.php">Cart</a></li>
        <li><a href="order.php">Orders</a></li>
    </ul>
</div>
<div id="cart">
    <table id="cart-list" border="3">
        <thead>
        <tr>
            <th>Product</th>
            <th>Price (RM)</th>
            <th>Quantity</th>
            <th>Amount (RM)</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $total = 0;

        $result = mysqli_query($conn, "SELECT * FROM cart");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $sub_total = $row['price'] * $row['quantity'];
                $total += $sub_total;
                $product = "<div class='product-info'>
                <img src='{$row['image']}' alt='{$row['pname']}' width='130' height='140'>
                <div class='product-details'>
                    <p>{$row['pname']}</p>
                    <p>Colour: {$row['pcolour']}</p>
                </div>
            </div>";
            
                echo "<tr>";
                echo "<td>{$product}</td>";
                echo "<td>{$row['price']}</td>";
                echo "<td>{$row['quantity']}</td>";
                echo "<td>" . number_format($sub_total) . "</td>";
                echo "<td class='delete-button-cell'><button onclick='deleteCartItem({$row['cart_id']})'>Delete</button></td>";
                echo "</tr>";
            }
            // Display total row outside the loop
            echo "<tr>";
            echo "<td colspan='3' style='text-align: right;'><strong>Total:</strong></td>";
            echo "<td><strong>" . number_format($total,2) . "</strong></td>";
            echo "</tr>";
        } else {
            echo "<tr><td colspan='6'>No items in cart</td></tr>";
        }
        mysqli_close($conn);
        ?>
        </tbody>
    </table>
</div>

<div class="buttons">
    <button class="btnPay" onclick="toggleBillingInfo()">Pay Now</button>
</div>

<form action="orderconn.php" method="POST">
    <div class="billing-info">
        <table>
            <tr>
                <h2>Billing Information</h2><hr>
            </tr>
            <tr>
                <h3>Contact:</h3>
                <input type="text" name="email" placeholder="Email">&nbsp
                <input type="text" name="telephone" placeholder="Tel"><br><br>
            </tr>
            <tr>
                <h3>Logistics Choices:</h3>
                <label><input type="radio" name="shippingOption" value="pickUp" class="shipping-option"/> Pick Up &nbsp&nbsp&nbsp&nbsp</label>
                <label><input type="radio" name="shippingOption" value="shipping" class="shipping-option"/> Shipping</label><br/>
            </tr>
            <tr>
                <h3>Payment By:</h3>
                    <button type="button" class="card-btn" onclick="selectPaymentMethod('Card')">
                        <img src="Card.png" alt="Logout">
                    </button>
                    <button type="button" class="master-btn" onclick="selectPaymentMethod('MasterCard')">
                        <img src="MasterCard.png" alt="Logout">
                    </button>
                    <button type="button" class="TouchnGo-btn" onclick="selectPaymentMethod('TouchnGo')">
                        <img src="TouchnGo.png" alt="Logout">
                    </button>
                    <input type="hidden" name="method" id="paymentMethod">            
            </tr>
            <tr>
                <h3>Personal Details:</h3>
                <input type="text" name="fname" placeholder="First Name">&nbsp
                <input type="text" name="lname" placeholder="Last Name"><br><br>
                <input type="text" name="address" placeholder="Address">
            </tr>
        </table>
        <button class="btnDone">Done</button>
    </div>
</form>

<script>
    function deleteCartItem(cart_id) {
        if (confirm("Are you sure you want to delete this item?")) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            // Item deleted successfully, reload the page or update the cart content
                            location.reload(); // You can replace this with code to update the cart content dynamically
                        } else {
                            // Handle error
                            console.error('Error deleting item:', response.error);
                        }
                    } else {
                        // Handle HTTP error
                        console.error('HTTP error:', xhr.statusText);
                    }
                }
            };
            xhr.open('POST', 'cartpay.php'); // Send the request to the same page
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('cart_id=' + cart_id);
        }
    }
    // Toggle billing information section visibility
    function toggleBillingInfo() {
    var billingInfo = document.querySelector(".billing-info");
    billingInfo.style.display = "block";
    // Scroll to the billing information section
    billingInfo.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

</script>
</body>
</html>
