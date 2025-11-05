<?php
session_start();
if (!isset($_SESSION['reg'])) {
    header("Location: login.php"); // Redirect to login page if session is not active
    exit();
}
?>
<?PHP
include 'conn.php';
$del = $_GET['id'];
$delete = "DELETE FROM reg WHERE ID = '$del'";
$run = mysqli_query($conn, $delete);

if ($run) {
	header('Location: Platform_Managment.php');
}

?>