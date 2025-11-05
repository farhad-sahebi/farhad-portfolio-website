<?php
session_start();
if (!isset($_SESSION['reg'])) {
    header("Location: login.php"); // Redirect to login page if session is not active
    exit();
}
?>
<?php
include 'conn.php';
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $main_title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $slide_title = $_POST['title_slide'] ?? '';

    // File uploads
    $upload_dir = 'Pictures/'; 

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $slide1 = $_FILES['slide1']['name'] ?? '';
    $slide2 = $_FILES['slide2']['name'] ?? '';
    $slide3 = $_FILES['slide3']['name'] ?? '';

    $slide1_path = $upload_dir . basename($slide1);
    $slide2_path = $upload_dir . basename($slide2);
    $slide3_path = $upload_dir . basename($slide3);

    // Move uploaded files to the upload directory
    move_uploaded_file($_FILES['slide1']['tmp_name'], $slide1_path);
    move_uploaded_file($_FILES['slide2']['tmp_name'], $slide2_path);
    move_uploaded_file($_FILES['slide3']['tmp_name'], $slide3_path);

    // Insert data into the database
    $sql = "INSERT INTO slide_det_visu (Main_Title, `desc`, Slide_title, slide1, slide2, slide3) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssss", $main_title, $description, $slide_title, $slide1_path, $slide2_path, $slide3_path);

        if ($stmt->execute()) {
            echo "<script>alert('Data inserted successfully.'); window.location.href='Platform_Managment.php';</script>";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing the statement: " . $conn->error;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<form method="post" enctype="multipart/form-data" action="insert_Slide-Details_Visua.php" style="background-color: white; border-radius: 7px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 15px;">
	<div class="container-fluid">
		<label class="form-label">Enter The Title</label>
		<input type="tex" name="title" placeholder="Enter The Title for Description" class="form-control">
		<label class="form-label">Enter The Description</label>
		<textarea class="form-control" placeholder="Enter the Description" rows="4" name="description"></textarea>
		<label class="form-label">Slide Show Title</label>
		<input type="tex" name="title_slide" class="form-control" placeholder="Enter The Title for Slide Show">
		<label class="form-label">Upload The First Slide</label>
		<input type="file" class="form-control" name="slide1">
		<label class="form-label">Upload The Second Slide</label>
		<input type="file" class="form-control" name="slide2">
		<label class="form-label">Upload The Third Slide</label>
		<input type="file" class="form-control" name="slide3">
		<input type="submit" name="btn" class="btn btn-info" style="margin-top:20px; margin-bottom:30px;">
	</div> 
</form>
</body>
</html>
<style type="text/css">
	.form-label{
		margin-top: 22px;
	}
</style>