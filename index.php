<?php
include 'conn.php'; // Include your database connection file

// Test query to check if the connection works
$result = $conn->query("SHOW TABLES");

if ($result) {
    echo "✅ Database connected successfully!<br>";
    if ($result->num_rows > 0) {
        echo "Tables found in the database.";
    } else {
        echo "Database is empty (no tables found).";
    }
} else {
    echo "❌ Query failed: " . $conn->error;
}
?>
