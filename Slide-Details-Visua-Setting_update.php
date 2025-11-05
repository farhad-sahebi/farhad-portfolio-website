<?php
session_start();
if (!isset($_SESSION['reg'])) {
    header("Location: login.php"); // Redirect to login page if session is not active
    exit();
}
?>
<?php
include 'Nav.php';
include 'conn.php'; // Include your database connection file

// Retrieve data from the database based on ID (passed via GET request)
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    die("Invalid ID.");
}

$sql = "SELECT * FROM slide_det_visu WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("No record found.");
}

$row = $result->fetch_assoc();

// Handle form submission for updates
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $title_slide = $_POST['title_slide'];

    // Directory to upload images
    $uploadDir = "uploads/";
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Create directory if it doesn't exist
    }

    // Initialize slide paths
    $slide1Path = $row['slide1'];
    $slide2Path = $row['slide2'];
    $slide3Path = $row['slide3'];

    // Handle file uploads (only update if a new file is uploaded)
    if (isset($_FILES['slide1']) && $_FILES['slide1']['error'] == UPLOAD_ERR_OK) {
        $slide1Path = $uploadDir . basename($_FILES['slide1']['name']);
        move_uploaded_file($_FILES['slide1']['tmp_name'], $slide1Path);
    }
    if (isset($_FILES['slide2']) && $_FILES['slide2']['error'] == UPLOAD_ERR_OK) {
        $slide2Path = $uploadDir . basename($_FILES['slide2']['name']);
        move_uploaded_file($_FILES['slide2']['tmp_name'], $slide2Path);
    }
    if (isset($_FILES['slide3']) && $_FILES['slide3']['error'] == UPLOAD_ERR_OK) {
        $slide3Path = $uploadDir . basename($_FILES['slide3']['name']);
        move_uploaded_file($_FILES['slide3']['tmp_name'], $slide3Path);
    }

    // Update the database
    $updateSql = "UPDATE slide_det_visu SET Main_Title = ?, `desc` = ?, Slide_title = ?, slide1 = ?, slide2 = ?, slide3 = ? WHERE ID = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ssssssi", $title, $description, $title_slide, $slide1Path, $slide2Path, $slide3Path, $id);

    if ($updateStmt->execute()) {
        echo "Record updated successfully.";
        header("Location: Platform_Managment.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
    <div class="col-md-8">
<form method="post" enctype="multipart/form-data" style="background-color: white; border-radius: 7px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 15px;">
    <div class="container-fluid">
        <label class="form-label">Enter The Title</label>
        <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($row['Main_Title']); ?>">

        <label class="form-label">Enter The Description</label>
        <textarea class="form-control" name="description" rows="4"><?php echo htmlspecialchars($row['desc']); ?></textarea>

        <label class="form-label">Slide Show Title</label>
        <input type="text" name="title_slide" class="form-control" value="<?php echo htmlspecialchars($row['Slide_title']); ?>">

        <label class="form-label">Upload The First Slide</label>
        <input type="file" class="form-control" name="slide1">
        <img src="<?php echo htmlspecialchars($row['slide1']); ?>" alt="Slide 1" style="width: 100px; margin-top: 10px;">

        <label class="form-label">Upload The Second Slide</label>
        <input type="file" class="form-control" name="slide2">
        <img src="<?php echo htmlspecialchars($row['slide2']); ?>" alt="Slide 2" style="width: 100px; margin-top: 10px;">

        <label class="form-label">Upload The Third Slide</label>
        <input type="file" class="form-control" name="slide3">
        <img src="<?php echo htmlspecialchars($row['slide3']); ?>" alt="Slide 3" style="width: 100px; margin-top: 10px;">

        
    </div>
    <input type="submit" name="btn" class="btn btn-info" style="margin-top:20px; margin-bottom:30px;" value="Update">
</form>
</div>
<div class="col-md-2"></div>        
        </div>
    </div>

    
</body>
</html>
