<?php
require_once 'productconn.php';

if(isset($_POST["submit"])) {
    // Retrieve form data
    $productId = $_POST["productId"];
    $productName = $_POST["productName"];
    $price = $_POST["price"];
    $category = $_POST["category"];

    // File upload handling
    $fileName = $_FILES["image"]["name"];
    $tmpName = $_FILES["image"]["tmp_name"];
    $fileError = $_FILES["image"]["error"];

    // Specify the target directory (uploads)
    $targetPath = 'img/'. basename($fileName);

    // Check for file upload errors
    if($fileError === UPLOAD_ERR_OK) {
        // Move the uploaded file to the target directory
        if(move_uploaded_file($tmpName, $targetPath)) {
            // File uploaded successfully, insert data into database
            $sql = "INSERT INTO products (product_id, name, price, category, image) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssiss", $productId, $productName, $price, $category, $targetPath);
            if($stmt->execute()) {
                echo '<script>alert("Product Added Successfully!!");
                window.location.href = "admin.php";</script>';
                exit();
            } else {
                echo "Error inserting product into database: " . $stmt->error;
            }
        } else {
            echo "Error moving uploaded file to target directory";
        }
    } else {
        echo "Error uploading file: " . $fileError;
    }
}
?>
