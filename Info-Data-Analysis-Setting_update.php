<?php
session_start();
if (!isset($_SESSION['reg'])) {
    header("Location: login.php"); // Redirect to login page if session is not active
    exit();
}
?>
<?php
// Include the database connection
include 'conn.php'; // Replace with your database connection file

// Initialize variables for error handling
$message = "";

// Check if an ID is provided for editing
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the current data for the given ID
    $query = "SELECT * FROM data_analysis WHERE ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        $message = "No data found for the given ID.";
    }
}

// Check if the form is submitted to update data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $slide_title = $_POST['slide_title'];
    
    // Define the upload directory
    $upload_dir = "Pictures/";
    
    // Get current slide paths if not updated
    $slide1 = $row['slide1'];
    $slide2 = $row['slide2'];
    $slide3 = $row['slide3'];
    
    // File upload handling (only if new files are selected)
    if (!empty($_FILES['slide1']['name'])) {
        $slide1 = $upload_dir . basename($_FILES['slide1']['name']);
        move_uploaded_file($_FILES['slide1']['tmp_name'], $slide1);
    }
    if (!empty($_FILES['slide2']['name'])) {
        $slide2 = $upload_dir . basename($_FILES['slide2']['name']);
        move_uploaded_file($_FILES['slide2']['tmp_name'], $slide2);
    }
    if (!empty($_FILES['slide3']['name'])) {
        $slide3 = $upload_dir . basename($_FILES['slide3']['name']);
        move_uploaded_file($_FILES['slide3']['tmp_name'], $slide3);
    }

    // Update the database
    $update_query = "UPDATE data_analysis SET Title = ?, description = ?, slide_title = ?, slide1 = ?, slide2 = ?, slide3 = ? WHERE ID = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ssssssi", $title, $description, $slide_title, $slide1, $slide2, $slide3, $id);

    if ($update_stmt->execute()) {
        $message = "Data updated successfully.";
        header("Location: Platform_Managment.php");
    } else {
        $message = "Failed to update data: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Edit Data</h2>
    <?php if ($message): ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>
    <?php if (isset($row)): ?>
        <form method="POST" enctype="multipart/form-data">
            <label class="form-label">Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($row['Title']); ?>" class="form-control" required>

            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required><?php echo htmlspecialchars($row['description']); ?></textarea>

            <label class="form-label">Slide Title</label>
            <input type="text" name="slide_title" value="<?php echo htmlspecialchars($row['slide_title']); ?>" class="form-control" required>

            <label class="form-label">First Slide</label>
            <input type="file" name="slide1" class="form-control">
            <small>Current file: <?php echo $row['slide1']; ?></small>

            <label class="form-label">Second Slide</label>
            <input type="file" name="slide2" class="form-control">
            <small>Current file: <?php echo $row['slide2']; ?></small>

            <label class="form-label">Third Slide</label>
            <input type="file" name="slide3" class="form-control">
            <small>Current file: <?php echo $row['slide3']; ?></small>

            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    <?php else: ?>
        <p>No data available for editing.</p>
    <?php endif; ?>
</div>
</body>
</html>
