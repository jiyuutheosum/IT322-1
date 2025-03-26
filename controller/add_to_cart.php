<?php
include '../dB/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to add to cart.");
}

$user_id = $_SESSION['user_id'];  // Get user ID from session
$product_id = $_POST['product_id'];  

// Check if product is already in cart
$checkCart = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
$result = $conn->query($checkCart);

if ($result->num_rows > 0) {
    // If exists, just increase quantity
    $updateCart = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $conn->query($updateCart);
} else {
    // If not exists, insert new
    $insertCart = "INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', 1)";
    $conn->query($insertCart);
}

header("Location: ..nikelist.html"); // Redirect back
exit();
?>
