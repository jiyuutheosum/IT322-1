<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nike Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>


<div class="container mt-5">
    <h2 class="mb-4">Nike Products</h2>
    <div class="row">
        <?php
        include '../../dB/config.php';
        $brand_id = 1; // Nike brand ID
        $sql = "SELECT * FROM products WHERE brand_id = '$brand_id' AND is_removed = 0";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='col-md-4 mb-4'>
                        <div class='card'>
                            <img src='{$row['image']}' class='card-img-top' alt='{$row['name']}' style='height:200px; object-fit:cover;'>
                            <div class='card-body'>
                                <h5 class='card-title'>{$row['name']}</h5>
                                <p class='card-text'>{$row['description']}</p>
                                <p class='card-text'>Price: ₱{$row['price']}</p>
                                <p class='card-text'>Stock: {$row['stock']}</p>

                                <form action='../../controller/process_cart.php' method='POST'>
                                    <input type='hidden' name='product_id' value='{$row['id']}'>
                                    <input type='hidden' name='quantity' value='1'>
                                    <button type='submit' class='btn btn-success'>Add to Cart</button>
                                </form>
                            </div>
                        </div>
                      </div>";
            }
        } else {
            echo "<p class='text-center'>No Nike products found.</p>";
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Run SweetAlert after the page fully loads
document.addEventListener("DOMContentLoaded", function() {
    <?php if (isset($_SESSION['message'])): ?>
        Swal.fire({
            title: '<?php echo ($_SESSION['code'] == "success" ? "Success!" : "Error!"); ?>',
            text: '<?php echo $_SESSION['message']; ?>',
            icon: '<?php echo $_SESSION['code']; ?>',
            confirmButtonText: 'OK'
        });
        <?php 
        unset($_SESSION['message']);
        unset($_SESSION['code']);
        ?>
    <?php endif; ?>
});
</script>

</body>
</html>
