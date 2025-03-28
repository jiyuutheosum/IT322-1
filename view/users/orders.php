<?php
session_start();
include '../../dB/config.php';

// Check if the user is logged in
if (!isset($_SESSION['authuser']) || !isset($_SESSION['authuser']['userId'])) {
    die("Session authuser not set! Please login again.");
}

$user_id = $_SESSION['authuser']['userId'];

// Fetch user orders
$query = "SELECT o.id, p.name, p.image, o.quantity, o.order_date, o.status 
          FROM orders o
          JOIN products p ON o.product_id = p.id
          WHERE o.user_id = '$user_id'
          ORDER BY o.order_date DESC";

$result = mysqli_query($conn, $query);

if (!$result) {
    // Log error for debugging
    file_put_contents('debug_log.txt', "Error fetching orders: " . mysqli_error($conn) . "\n", FILE_APPEND);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container mt-5">
<a href="../users/index.php" class="btn btn-primary mb-3">
        <i class="bi bi-arrow-left"></i> Dashboard
    </a>
    <h2 class="mb-4">Your Orders</h2>

    <?php if (isset($_SESSION['checkout_success'])) : ?>
        <script>
            Swal.fire({
                title: "Checkout Successful",
                text: "<?php echo $_SESSION['checkout_success']; ?>",
                icon: "success",
                confirmButtonText: "OK"
            });
        </script>
        <?php unset($_SESSION['checkout_success']); ?>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Order Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td><img src='{$row['image']}' width='50' height='50'></td>
                            <td>{$row['quantity']}</td>
                            <td>{$row['order_date']}</td>
                            <td>{$row['status']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>No orders found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
