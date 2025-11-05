<?php
session_start();
if (!isset($_SESSION['reg'])) {
    header("Location: login.php"); // Redirect to login page if session is not active
    exit();
}
?>
<?php 
include 'conn.php';
$id = intval($_GET['id']);
$sql = "DELETE FROM home_slides WHERE id = '$id'";
if ($conn->query($sql) === TRUE) {
	echo 'The slide deleted successfully';
    header('Location: Platform_Managment.php');
    exit;
}
else {
    echo 'Error deleting slide: ' . $conn->error;
}
?>