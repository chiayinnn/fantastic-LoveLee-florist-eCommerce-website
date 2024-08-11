<?php
// Assuming this PHP code is in a file named 'category.php'

// Include database connection and any other necessary files
include 'productconn.php';

// Define the categories
$categories = ['LoveRomance', 'graduation', 'birthday', 'CareSupport', 'AddOn'];

// Loop through each category
foreach ($categories as $category) {
    // Query products for the current category
    $select_products = mysqli_query($conn, "SELECT * FROM products WHERE category='$category'");
    
    // Check if any products were found
    if (mysqli_num_rows($select_products) > 0) {
        // Display the category section with products
        echo "<div id='$category' style='display: none; max-width: 1500px; width: 95%; margin: 30px auto; align-items: center; margin: auto;'>";
        echo "<h2>" . ucfirst($category) . "</h2>";
        echo "<hr>";
        echo "<div style='display:flex; flex-wrap: wrap; justify-content: space-between;'>";

        // Loop through each product in the current category
        while ($fetch_product = mysqli_fetch_assoc($select_products)) {
            // Include the product box template for each product
            include 'product_box.php';
        }

        echo "</div></div>"; // Close the category section
    } else {
        // Display a message if no products were found for the category
        echo "<div id='$category' style='display: none; max-width: 1500px; width: 95%; margin: 30px auto; align-items: center; margin: auto;'>";
        echo "<h2>" . ucfirst($category) . "</h2>";
        echo "<hr>";
        echo "<p>No products found.</p>";
        echo "</div>"; // Close the category section
    }
}
?>
<!-- Include the JavaScript file at the end -->
<script src="script.js"></script>
