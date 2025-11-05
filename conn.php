<?php
// Enable error reporting for debugging (remove in production)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$servername = "sql104.infinityfree.com";
$username = "if0_38200371";
$password = "2244Farhad";  // Consider storing credentials securely
$dbname = "if0_38200371_atr";

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Set charset to UTF-8
    $conn->set_charset("utf8mb4");

    // If no exception is thrown, connection is successful
    echo "";
} catch (Exception $e) {
    exit("Database connection failed: " . $e->getMessage());
}
?>
