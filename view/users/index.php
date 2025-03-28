<?php
session_start();

// Role-based authentication
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: /IT322/view/admin/index.php");
    exit();
}

include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");

include("./includes/dashboard.php");

include("./includes/footer.php");
?>