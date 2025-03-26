<?php
session_start();
include '../dB/config.php';

if (!isset($_SESSION['authuser']) || !isset($_SESSION['authuser']['userId'])) {
    die("Session authuser not set! Please login again.");
}

$user_id = $_SESSION['authuser']['userId']; // Get the logged-in user ID

if (isset($_POST['selected_cart']) && !empty($_POST['selected_cart'])) {
    $selected_cart_ids = $_POST['selected_cart']; // Get selected cart items

    // Prepare query execution
    foreach ($selected_cart_ids as $cart_id) {
        // Get item details from the cart
        $query = "SELECT product_id, quantity FROM cart WHERE id = '$cart_id' AND user_id = '$user_id'";
        $result = mysqli_query($conn, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['product_id'];
            $quantity = $row['quantity'];

            // Insert into orders table
            $insert_order = "INSERT INTO orders (user_id, product_id, quantity, status) 
                             VALUES ('$user_id', '$product_id', '$quantity', 'Pending')";
            mysqli_query($conn, $insert_order);

            // Remove the item from the cart after checkout
            $delete_cart = "DELETE FROM cart WHERE id = '$cart_id'";
            mysqli_query($conn, $delete_cart);
        }
    }

    // Set session message for success
    $_SESSION['message'] = "Order placed successfully!";
    $_SESSION['code'] = "success";
    $redirect_url = "dashboard.php"; // Redirect sa dashboard
} else {
    // Set session message for error
    $_SESSION['message'] = "No items selected for checkout!";
    $_SESSION['code'] = "error";
    $redirect_url = "cart.php"; // Stay on the cart page if no item is selected
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processing Order</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<script>
    Swal.fire({
        title: "<?php echo ($_SESSION['code'] == 'success') ? 'Success!' : 'Error!'; ?>",
        text: "<?php echo $_SESSION['message']; ?>",
        icon: "<?php echo $_SESSION['code']; ?>",
        confirmButtonText: "OK"
    }).then(() => {
        window.location.href = "<?php echo $redirect_url; ?>"; // Redirect to dashboard.php or cart.php
    });
</script>
</body>
</html>
