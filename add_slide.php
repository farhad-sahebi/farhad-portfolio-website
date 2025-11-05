<?php
session_start();
if (!isset($_SESSION['reg'])) {
    header("Location: login.php"); // Redirect to login page if session is not active
    exit();
}
?>
<?php
include 'conn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Retrieve data from form
    $description = $conn->real_escape_string($_POST['description']);
    $project_Name = $conn->real_escape_string($_POST['project_name']);
    $link = $conn->real_escape_string($_POST['link']);

    // Handle file upload
    $target_dir = "Pictures/";
    $target_file = $target_dir . basename($_FILES["picture"]["name"]);
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Upload file
    if (!move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
        die("Sorry, there was an error uploading your file.");
    }

    // Insert data into table
    $sql = "INSERT INTO home_slides (image_url, caption_title, caption_text, link)
            VALUES ('$target_file', '$project_Name', '$description', '$link')";

    if ($conn->query($sql) === TRUE) { // Check for successful query
        echo "New record submitted successfully.";
        header('Location: Platform_Managment.php');
        exit;
    } else {
        // Improved error handling
        error_log("SQL Error: " . $conn->error); 
        echo "An error occurred. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add_Project</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<form method="post" action="add_slide.php" enctype="multipart/form-data">
<div class="container-fluid">
	<div class="row">
			<div class="form-control">
				<label class="form-label" style="margin-top:18px;">Enter The Description About Slide...</label>
				<div><textarea id="description" name="description" class="form-control" rows="1" placeholder="Write the info about this slide..." required></textarea></div>


				<label class="form-label" style="margin-top:18px;">Enter The Slide Title</label>
				<div><input type="tex" class="form-control" placeholder="Slide Title" name="project_name"></div>


				<label class="form-label" style="margin-top:18px;">Enter The link for Slide...</label>
				<div><input type="tex" class="form-control" placeholder="Link..." name="link"></div>
				<label class="form-label" style="margin-top:18px;">Enter The Picture Slide</label>
				<div><input type="file" class="form-control" name="picture"></div>
				<div><input type="submit" value="Submit" class="btn btn-info" style="margin-top:10px; margin-bottom: 20px;"></div>
			</div>
		</div>
	</div>
</form>
</body>
</html>
<style>

</style>