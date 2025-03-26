<?php
// Include the database connection
include('../dB/config.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get product details from the form
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $brand_id = $_POST['brand_id'];

    // Specify the path to the uploads folder
    $upload_dir = 'E:\xampp\htdocs\IT322\uploads';

    // Get the uploaded image details
    $image_name = basename($_FILES['image']['name']);
    $image_path = $upload_dir . $image_name;

    // Check if image file is valid and upload the image
    if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
        // Prepare the SQL query to insert the product
        $sql = "INSERT INTO products (name, description, price, stock, brand_id, image) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdiis", $name, $description, $price, $stock, $brand_id, $image_name);
        
        // Execute the query
        if ($stmt->execute()) {
            echo "Product added successfully!";
            header("Location: ../view/admin/nikelist.php ");
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error uploading image.";
    }

    // Close the connection
    $conn->close();
}
?>