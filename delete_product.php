<?php
require_once 'productconn.php';

if(isset($_POST["product_id"])) {
    $productId = $_POST["product_id"];
    
    // Prepare and execute the SQL query to delete the product
    $sql = "DELETE FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $productId);
    
    if($stmt->execute()) {
        // Return a success response if deletion is successful
        echo json_encode(["success" => true]);
    } else {
        // Return an error response if deletion fails
        echo json_encode(["success" => false, "error" => "Error deleting product"]);
    }
} else {
    // Return an error response if product_id parameter is not provided
    echo json_encode(["success" => false, "error" => "Product ID not provided"]);
}
?>
