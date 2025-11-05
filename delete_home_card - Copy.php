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
$sql = "DELETE FROM home_card WHERE ID = '$id'";
$run = $conn->query($sql);
if ($run) {
	header("Location: Platform_Managment.php");
}

?>