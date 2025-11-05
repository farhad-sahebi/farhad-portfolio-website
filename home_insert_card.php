<?php
session_start();
if (!isset($_SESSION['reg'])) {
    header("Location: login.php"); // Redirect to login page if session is not active
    exit();
}
?>
<?php
include 'conn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$title = $_POST['title'];
	$text = $_POST['text'];
	$link = $_POST['link'];
	$sql = "INSERT INTO home_card (Title, Text, link) VALUES('$title', '$text', '$link')";
	if ($conn->query($sql)) {
		echo "<script>alert('Added Successfully!')
            window.location.href = 'Platform_Managment.php';
            </script>";
	}else{
		echo "<script>alert('Not Added Successfully!')
            window.location.href = 'Platform_Managment.php';
            </script>";
	}
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Card</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<form method="post" enctype="multipart/form-data" action="home_insert_card.php">
<div class="form-control">
<label>Title for Card</label>
<div class="new">
<input type="tex" class="form-control" placeholder="Enter The title" name="title">
</div>
<label>Text For Card</label>
<div class="new">
<textarea class="form-control" id="description" placeholder="Enter The Text" rows="4" name="text"></textarea>
</div>
<label>Enter the link for Card</label>
<div class="new">
<input type="text" name="link" class="form-control">
</div>
<div class="new" style="margin-top: 20px; margin-bottom: 20px;">
<input type="submit" name="btn" class="btn btn-info" id="btn" style="color: black;">
</div>
</div>
</form>


</body>
</html>
<style type="text/css">
	label{
		padding-top: 20px;
	}
</style>