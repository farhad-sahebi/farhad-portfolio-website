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
    // Get the form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $slide_title = $_POST['slide_title'];

    // Handle file uploads
    $target_dir = "Pictures/";
    $slide1 = $target_dir . basename($_FILES["slide1"]["name"]);
    $slide2 = $target_dir . basename($_FILES["slide2"]["name"]);
    $slide3 = $target_dir . basename($_FILES["slide3"]["name"]);

    // Upload the files
    if (move_uploaded_file($_FILES["slide1"]["tmp_name"], $slide1) && 
        move_uploaded_file($_FILES["slide2"]["tmp_name"], $slide2) && 
        move_uploaded_file($_FILES["slide3"]["tmp_name"], $slide3)) {
        
        // Prepare the SQL query to insert the data into the database
        $sql = "INSERT INTO data_analysis (Title, description, slide_title, slide1, slide2, slide3)
                VALUES ('$title', '$description', '$slide_title', '$slide1', '$slide2', '$slide3')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Data inserted successfully.'); window.location.href='Platform_Managment.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your files.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Insert</title>
	<link rel="stylesheet" href="styles.css">
    <!-- Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Custom styles -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<form method="POST" action="insert_data_analysis.php" enctype="multipart/form-data">
	<div class="container-fluid" style="background-color: white; border-radius: 7px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 18px;">
		<label class="form-label">Title</label>
		<input type="text" name="title" placeholder="Enter The Title" class="form-control" required>
		
		<label class="form-label">Description</label>
		<textarea name="description" placeholder="Enter the Description" class="form-control" required></textarea>
		
		<label class="form-label">Slide Title</label>
		<input type="text" name="slide_title" placeholder="Enter the Title for Slides" class="form-control" required>
		
		<label class="form-label">First Slide</label>
		<input type="file" name="slide1" class="form-control" required>
		
		<label class="form-label">Second Slide</label>
		<input type="file" name="slide2" class="form-control" required>
		
		<label class="form-label">Third Slide</label>
		<input type="file" name="slide3" class="form-control" required>
		
		<input type="submit" name="btn" class="btn btn-info" value="Insert" style="margin-top: 20px;">
	</div>
</form>

</body>
</html>
<style type="text/css">
	.form-label{
		margin-top: 10px;
	}
</style>