<?php
session_start();
include '../dB/config.php';

if (!isset($_SESSION['authuser']) || !isset($_SESSION['authuser']['userId'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit;
}

$user_id = $_SESSION['authuser']['userId'];
$cart_ids = isset($_POST['cart_ids']) ? $_POST['cart_ids'] : null;

if ($cart_ids) {
    $cart_ids_array = explode(',', $cart_ids); // Convert comma-separated string to array

    // Debugging: Log the received cart IDs
    error_log("Received cart IDs: " . print_r($cart_ids_array, true));

    $placeholders = implode(',', array_fill(0, count($cart_ids_array), '?')); // Create placeholders for prepared statement

    $query = "DELETE FROM cart WHERE id IN ($placeholders) AND user_id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement.']);
        error_log("Error in remove_cart.php: " . $conn->error); // Log detailed error for debugging
        exit;
    }

    // Bind parameters dynamically
    $types = str_repeat('i', count($cart_ids_array)) . 'i'; // 'i' for integers
    $params = array_merge($cart_ids_array, [$user_id]); // Combine cart IDs and user ID
    $stmt->bind_param($types, ...$params);

    // Debugging: Log the query and parameters
    error_log("Executing query: $query with parameters: " . print_r($params, true));

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Items removed successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to remove items.']);
        error_log("Error in remove_cart.php: " . $stmt->error); // Log detailed error for debugging
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'No cart IDs provided.']);
    error_log("Error in remove_cart.php: No cart IDs provided.");
}

$conn->close();
?>
