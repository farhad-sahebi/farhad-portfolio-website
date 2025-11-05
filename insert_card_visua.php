<?php
session_start();
if (!isset($_SESSION['reg'])) {
    header("Location: login.php"); // Redirect to login page if session is not active
    exit();
}
?>
<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Handle file uploads
    $uploadsDir = "uploads/";
    $picture = $uploadsDir . basename($_FILES['picture']['name']);
    $datasetPath = $uploadsDir . basename($_FILES['dataset']['name']);
    $dashboardPath = $uploadsDir . basename($_FILES['dashboard']['name']);
    $descriptionPath = $uploadsDir . basename($_FILES['descriptionFile']['name']);
    $pdfPath = $uploadsDir . basename($_FILES['pdf']['name']);

    if (move_uploaded_file($_FILES['picture']['tmp_name'], $picture) &&
        move_uploaded_file($_FILES['dataset']['tmp_name'], $datasetPath) &&
        move_uploaded_file($_FILES['dashboard']['tmp_name'], $dashboardPath) &&
        move_uploaded_file($_FILES['descriptionFile']['tmp_name'], $descriptionPath) &&
        move_uploaded_file($_FILES['pdf']['tmp_name'], $pdfPath)) {

        // Insert into database
        $sql = "INSERT INTO dashboards (title, Pic_card ,description, dataset_path, dashboard_path, description_path, pdf_path) 
                VALUES (?,?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind the parameters
        $stmt->bind_param('sssssss', $title, $picture , $description, $datasetPath, $dashboardPath, $descriptionPath, $pdfPath);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('Data inserted successfully.'); window.location.href='Platform_Managment.php';</script>";
        } else {
            echo "Error inserting data.";
        }
    } else {
        echo "Error uploading files.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Card Visu</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
	<form action="insert_card_visua.php" method="POST" enctype="multipart/form-data" style="background-color: white; border-radius:7px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 20px;">
    <div class="mb-3">
        <label for="title" class="form-label">Dashboard Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="mb-3">
        <label for="dashboard" class="form-label">Picture For Card</label>
        <input type="file" class="form-control" id="dashboard" name="picture" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Dashboard Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="dataset" class="form-label">Dataset File (CSV)</label>
        <input type="file" class="form-control" id="dataset" name="dataset" required>
    </div>
    <div class="mb-3">
        <label for="dashboard" class="form-label">Dashboard File (PBIX)</label>
        <input type="file" class="form-control" id="dashboard" name="dashboard" required>
    </div>
    <div class="mb-3">
        <label for="descriptionFile" class="form-label">Description File (DOCX)</label>
        <input type="file" class="form-control" id="descriptionFile" name="descriptionFile" accept=".docx" required>
    </div>
    <div class="mb-3">
        <label for="pdf" class="form-label">PDF Report</label>
        <input type="file" class="form-control" id="pdf" name="pdf" accept=".pdf" required>
    </div>
    <button type="submit" class="btn btn-info">Upload</button>
</form>

</div>
</body>
</html>