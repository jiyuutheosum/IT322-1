<?php
session_start();
include '../dB/config.php';

// Ensure session user is set
if (!isset($_SESSION['authuser']['userId'])) {
    echo "<script>alert('Please login first!'); window.location.href='../view/users/login.php';</script>";
    exit();
}

$user_id = $_SESSION['authuser']['userId'];
$product_id = $_POST['product_id'] ?? null;
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

if (!$product_id) {
    $_SESSION['message'] = "Invalid product!";
    $_SESSION['code'] = "error";
    header("Location: ../view/users/nikelist.php"); // ✅ Corrected path
    exit();
}

// Check if product is already in the cart
$check_query = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
$stmt = $conn->prepare($check_query);
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // If product exists, update quantity
    $update_query = "UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("iii", $quantity, $user_id, $product_id);
    $stmt->execute();
} else {
    // Insert new record
    $insert_query = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("iii", $user_id, $product_id, $quantity);
    $stmt->execute();
}

$stmt->close();
$conn->close();

// Set session message
$_SESSION['message'] = "Product added to cart!";
$_SESSION['code'] = "success";

// ✅ Corrected redirection path
header("Location: ../view/users/nikelist.php");
exit();