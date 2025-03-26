<?php
session_start();
include '../dB/config.php';

// Check if the user is logged in
if (!isset($_SESSION['authuser']) || !isset($_SESSION['authuser']['userId'])) {
    die(json_encode(['error' => 'User not logged in']));
}

$user_id = $_SESSION['authuser']['userId'];

// Fetch orders for the logged-in user
$query = "SELECT o.id, p.name, p.image, p.price, o.quantity, o.status, o.order_date 
          FROM orders o
          JOIN products p ON o.product_id = p.id
          WHERE o.user_id = '$user_id' 
          ORDER BY o.order_date DESC";

$result = mysqli_query($conn, $query);
$orders = [];

while ($row = mysqli_fetch_assoc($result)) {
    $orders[] = $row;
}

// Return data as JSON
echo json_encode($orders);
?>
