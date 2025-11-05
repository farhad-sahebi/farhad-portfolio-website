<?php
include 'conn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $text = $_POST['text'];
    $picture = $_FILES['pic']['name'];
    $target = "Pictures/" . basename($picture);

    if (move_uploaded_file($_FILES['pic']['tmp_name'], $target)) {
        // Use prepared statements to insert data
        $stmt = $conn->prepare("INSERT INTO home_about (Title, Text, picture) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $text, $target);

        if ($stmt->execute()) {
            echo "<script>alert('Added Successfully!')
            window.location.href = 'Platform_Managment.php';
            </script>";

        } else {
            echo "<script>alert('Added Successfully!')
            window.location.href = 'Platform_Managment.php';
            </script>" . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Failed to upload the picture.";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home About</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div style="padding: 15px; min-height: 100%; background-color: white;">    
<form method="post" enctype="multipart/form-data" action="home_info.php">
<div class="form-control">
<label>Title for Home</label>
<div class="new">
<input type="tex" class="form-control" placeholder="Enter The title" name="title">
</div>
<label>About for Home</label>
<div class="new">
<textarea class="form-control" id="description" placeholder="Enter The Text" rows="1" name="text"></textarea>
</div>
<label>Choose The Picture for home</label>
<div class="new">
<input type="file" name="pic" class="form-control">
</div>
<div class="new" style="margin-top: 20px; margin-bottom: 20px;">
<input type="submit" name="btn" class="btn btn-info" id="btn" style="color: black;">
</div>
</div>
</form>
</div>
</body>
</html>
<style>
	label{
		padding-top: 20px;
	}
</style>