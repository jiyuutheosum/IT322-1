<?php
session_start();
include '../../dB/config.php';

// Check if the user is logged in
if (!isset($_SESSION['authuser']) || !isset($_SESSION['authuser']['userId'])) {
    die("Session authuser not set! Please login again.");
}

$user_id = $_SESSION['authuser']['userId']; // Get the logged-in user ID

// Get cart items for the logged-in user
$query = "SELECT c.id, p.name, p.image, p.price, c.quantity 
          FROM cart c
          JOIN products p ON c.product_id = p.id
          WHERE c.user_id = '$user_id'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Your Cart</h2>

    <form id="checkoutForm" action="/IT322/controller/checkout.php" method="POST">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Select</th>
                <th>Product</th>
                <th>Image</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_price = 0;
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $subtotal = $row['price'] * $row['quantity'];
                    $total_price += $subtotal;
                    echo "<tr>
                            <td><input type='checkbox' class='itemCheckbox' name='selected_cart[]' value='{$row['id']}'></td>
                            <td>{$row['name']}</td>
                            <td><img src='{$row['image']}' width='50' height='50'></td>
                            <td>₱{$row['price']}</td>
                            <td>{$row['quantity']}</td>
                            <td>₱{$subtotal}</td>
                            <td>
                                <form action='../../controller/remove_cart.php' method='POST'>
                                    <input type='hidden' name='cart_id' value='{$row['id']}'>
                                    <button type='submit' class='btn btn-danger btn-sm'>Remove</button>
                                </form>
                            </td>
                          </tr>";
                }
                echo "<tr>
                        <td colspan='5' class='text-end'><strong>Total:</strong></td>
                        <td><strong>₱{$total_price}</strong></td>
                        <td></td>
                      </tr>";
            } else {
                echo "<tr><td colspan='7' class='text-center'>Your cart is empty.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="../products/nikelist.php" class="btn btn-primary">Continue Shopping</a>
    <button type="submit" name="checkout" class="btn btn-success">Proceed to Checkout</button>
</form>

<script>
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        let selected = document.querySelectorAll('.itemCheckbox:checked');
        if (selected.length === 0) {
            e.preventDefault();
            Swal.fire({
                title: "Please select at least one item to checkout!",
                icon: "warning",
                confirmButtonText: "OK"
            });
        }
    });
</script>
</body>
</html>
