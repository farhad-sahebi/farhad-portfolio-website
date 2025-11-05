<?php
session_start();
if (!isset($_SESSION['reg'])) {
    header("Location: login.php"); // Redirect to login page if session is not active
    exit();
}
?>
<?php
include 'conn.php';
$id = $_GET['id'];

$delete = "DELETE FROM home_about WHERE ID = '$id'";
$run = $conn->query($delete);

if ($run) {
	header('Location: Platform_Managment.php');
}
?>