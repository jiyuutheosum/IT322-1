<?php
// Include the database connection
include('../../dB/config.php'); 

// Get the brand_id from the URL (in this case, 1 for Nike)
$brand_id = isset($_GET['brand_id']) ? $_GET['brand_id'] : 1;

// Fetch products based on brand_id using mysqli
$sql = "SELECT * FROM products WHERE brand_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $brand_id); // "i" means integer type for brand_id
$stmt->execute();
$result = $stmt->get_result();

// Fetch all products
$products = $result->fetch_all(MYSQLI_ASSOC);

// Close the statement and connection
$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add and View Nike Products</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for form and product list */
        .form-container {
            border-right: 2px solid #ddd;
            padding-right: 20px;
        }

        .back-btn {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="row">
            <!-- Left Column - Form to Add Product -->
            <div class="col-md-6 form-container">
                <!-- Back Button -->
                <a href="javascript:history.back()" class="btn btn-secondary back-btn">Back</a>

                <h2 class="text-center mb-4">Add New Product</h2>
                <form action="../../controller/add_product.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price (PHP)</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock Quantity</label>
                        <input type="number" class="form-control" id="stock" name="stock" required>
                    </div>
                    <div class="form-group">
                        <label for="brand_id">Brand ID</label>
                        <input type="number" class="form-control" id="brand_id" name="brand_id" value="1" readonly>
                    </div>
                    <div class="form-group">
                        <label for="image">Product Image</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Add Product</button>
                </form>
            </div>

            <!-- Right Column - Product List -->
            <div class="col-md-6">
                <h2 class="text-center mb-4">Nike Products</h2>
                <div class="row">
                    <?php foreach ($products as $product): ?>
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card text-center">
                            <img src="images/<?php echo $product['image']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product['name']; ?></h5>
                                <p class="card-text"><?php echo $product['price']; ?> PHP</p>
                                <a href="../../controller/remove_product.php" class="btn btn-danger">Remove Product</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
