<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "baraocoraguaviva";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    file_put_contents('debug_log.txt', "Database connection failed: " . $conn->connect_error . "\n", FILE_APPEND);
    die("Connection failed: " . $conn->connect_error);
}
?>