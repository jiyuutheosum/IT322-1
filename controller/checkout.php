<?php
session_start();
include '../dB/config.php';

if (!isset($_SESSION['authuser']) || !isset($_SESSION['authuser']['userId'])) {
    echo json_encode(['status' => 'error', 'message' => 'Session authuser not set! Please login again.']);
    exit;
}

$user_id = $_SESSION['authuser']['userId']; // Get the logged-in user ID

if (isset($_POST['selected_cart']) && !empty($_POST['selected_cart'])) {
    $selected_cart_ids = $_POST['selected_cart']; // Get selected cart items

    foreach ($selected_cart_ids as $cart_id) {
        $query = "SELECT product_id, quantity FROM cart WHERE id = '$cart_id' AND user_id = '$user_id'";
        $result = mysqli_query($conn, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['product_id'];
            $quantity = $row['quantity'];

            $insert_order = "INSERT INTO orders (user_id, product_id, quantity, status) 
                             VALUES ('$user_id', '$product_id', '$quantity', 'Pending')";
            mysqli_query($conn, $insert_order);

            $delete_cart = "DELETE FROM cart WHERE id = '$cart_id'";
            mysqli_query($conn, $delete_cart);
        }
    }

    echo json_encode(['status' => 'success', 'message' => 'Order placed successfully!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No items selected for checkout!']);
}
exit;
?>