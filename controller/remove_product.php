<?php
// Include the database connection
include('../dB/config.php');

// Get the product ID from the URL
$product_id = isset($_GET['id']) ? $_GET['id'] : 0;

if ($product_id) {
    // Check if the product exists in the database
    $check_sql = "SELECT * FROM products WHERE id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $product_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows === 0) {
        echo "Product not found.";
        exit; // Stop further execution if the product is not found
    }

    // Update the 'is_removed' column to 1 (removed)
    $sql = "UPDATE products SET is_removed = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id); // "i" means integer type for product_id

    if ($stmt->execute()) {
        // Redirect to the product list page
        header("Location: ../nikelist.php"); // Adjust the path as needed
        exit;
    } else {
        echo "Error: Unable to remove product. Please try again later.";
        error_log("Error in remove_product.php: " . $stmt->error); // Log detailed error for debugging
    }

    $stmt->close();
    $check_stmt->close();
} else {
    echo "Invalid product ID.";
}

$conn->close();
?>
