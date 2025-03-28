<?php
include('../../db/config.php');  // Include your database configuration

// Query to get product count
$sql_products = "SELECT COUNT(*) as product_count FROM products";
$result_products = $conn->query($sql_products);
$product_count = ($result_products->num_rows > 0) ? $result_products->fetch_assoc()['product_count'] : 0;

// Query to get orders count
$sql_orders = "SELECT COUNT(*) as order_count FROM orders";
$result_orders = $conn->query($sql_orders);
$order_count = ($result_orders->num_rows > 0) ? $result_orders->fetch_assoc()['order_count'] : 0;

// Query to get user count
$sql_users = "SELECT COUNT(*) as user_count FROM users";
$result_users = $conn->query($sql_users);
$user_count = ($result_users->num_rows > 0) ? $result_users->fetch_assoc()['user_count'] : 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trendly - Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <!-- Dashboard Title -->
        <div class="row">
            <div class="col-12">
                <h1 class="mt-4">Admin Dashboard</h1>
            </div>
        </div>

        <!-- Dashboard Stats Row -->
        <div class="row">
            <!-- Orders Count -->
            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-2">
                                <i class="fas fa-boxes fa-2x text-primary"></i>
                            </div>
                            <div class="col-10 text-right">
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Orders: <?php echo $order_count; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Count -->
            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-2">
                                <i class="fas fa-cogs fa-2x text-success"></i>
                            </div>
                            <div class="col-10 text-right">
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Products: <?php echo $product_count; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Count -->
            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-2">
                                <i class="fas fa-users fa-2x text-warning"></i>
                            </div>
                            <div class="col-10 text-right">
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Users: <?php echo $user_count; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sales Analytics -->
            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-2">
                                <i class="fas fa-chart-line fa-2x text-danger"></i>
                            </div>
                            <div class="col-10 text-right">
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Sales</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Discounts Section -->
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Active Vouchers</h5>
                    </div>
                    <div class="card-body">
                        <!-- Discount Table -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Vouchers Code</th>
                                    <th>Description</th>
                                    <th>Expiration Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>DISCOUNT50</td>
                                    <td>50% Off Storewide</td>
                                    <td>2025-12-31</td>
                                    <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                </tr>
                                <tr>
                                    <td>WELCOME20</td>
                                    <td>20% Off First Purchase</td>
                                    <td>2025-06-30</td>
                                    <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                </tr>
                                <tr>
                                    <td>TRENDLY</td>
                                    <td>5% Off Storewide</td>
                                    <td>2025-08-30</td>
                                    <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                </tr>
                                <tr>
                                    <td>SHOPFUN</td>
                                    <td>10% Off Storewide</td>
                                    <td>2025-07-30</td>
                                    <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php
// Close connection
$conn->close();
?>