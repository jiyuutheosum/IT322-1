<?php
session_start();
include '../../dB/config.php';

// Handle Order Confirmation
if (isset($_GET['confirm'])) {
    $order_id = $_GET['confirm'];
    $new_status = 'Delivery';

    // Update order status in the database
    $sql = "UPDATE orders SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $new_status, $order_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Order #$order_id marked as Delivery.";
    } else {
        $_SESSION['error'] = "Error updating order #$order_id.";
    }
    
    // Redirect back to the page to avoid form resubmission
    header("Location: orders.php");
    exit();
}

// Fetch orders
$sql = "SELECT o.id AS order_id, u.firstname, u.lastname, o.status, o.order_date
        FROM orders o
        JOIN users u ON o.user_id = user_Id";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container-fluid">
        <h1 class="mt-4">Manage Orders</h1>

        <!-- Display Session Messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <script>
                Swal.fire({
                    title: "Success!",
                    text: "<?= $_SESSION['success']; ?>",
                    icon: "success",
                    timer: 2000,
                    showConfirmButton: false
                });
            </script>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <script>
                Swal.fire({
                    title: "Error!",
                    text: "<?= $_SESSION['error']; ?>",
                    icon: "error"
                });
            </script>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h5>All Orders</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th>Order Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result->num_rows > 0): ?>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= $row['order_id']; ?></td>
                                            <td><?= $row['firstname'] . ' ' . $row['lastname']; ?></td>
                                            <td><?= $row['status']; ?></td>
                                            <td><?= $row['order_date']; ?></td>
                                            <td>
                                                <?php if ($row['status'] === 'Pending'): ?>
                                                    <a href="orders.php?confirm=<?= $row['order_id']; ?>"
                                                       class="btn btn-primary btn-sm">
                                                        <i class="fas fa-truck"></i> Confirm Delivery
                                                    </a>
                                                <?php else: ?>
                                                    <span class="badge badge-success">Delivered</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No orders found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
