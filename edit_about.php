<?php
session_start();
if (!isset($_SESSION['reg'])) {
    header("Location: login.php"); // Redirect to login page if session is not active
    exit();
}
?>
<?php
include 'conn.php'; // Include the database connection

// Fetch the ID from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Check if the ID is valid
if ($id <= 0) {
    die("Invalid ID! Please provide a valid record ID in the URL.");
}

// Fetch the current data for the given ID
$sql = "SELECT * FROM about WHERE id = '$id'";
$result = $conn->query($sql);

if (!$result || $result->num_rows == 0) {
    die("No record found with the given ID.");
}

$row = $result->fetch_assoc(); // Fetch the data

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $picture = $_FILES['picture']['name'];
    $uploadOk = true;

    // Handle picture upload if a new file is uploaded
    if (!empty($picture)) {
        $targetDir = 'Pictures/'; // Specify the directory for uploads
        $targetFile = $targetDir . basename($picture);

        // Check if the file is uploaded successfully
        if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetFile)) {
            $image_url = $targetFile;
        } else {
            $uploadOk = false;
            echo "<script>alert('File upload failed.');</script>";
        }
    } else {
        // Use the existing picture if no new file is uploaded
        $image_url = $row['picture'];
    }

    if ($uploadOk) {
        // Update the record
        $update = $conn->query("UPDATE about SET Title='$title', Text='$description', picture='$image_url' WHERE id='$id'");

        if ($update) {
            echo "<script>alert('Record updated successfully.');</script>";
            header("Location: Platform_Managment.php"); // Redirect to a list or manage page
            exit();
        } else {
            echo "<script>alert('Failed to update the record.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit About</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
<form method="post" action="" enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="row">
            <div class="form-control">
                <label class="form-label" style="margin-top:18px;">Enter The Title</label>
                <div>
                    <input type="text" class="form-control" placeholder="Title" name="title" value="<?php echo htmlspecialchars($row['Title']); ?>" required>
                </div>

                <label class="form-label" style="margin-top:18px;">Enter The Description...</label>
                <div>
                    <textarea id="description" name="description" class="form-control" rows="4" placeholder="Write the info about..." required><?php echo htmlspecialchars($row['Text']); ?></textarea>
                </div>

                <label class="form-label" style="margin-top:18px;">Upload Picture (optional)</label>
                <div>
                    <input type="file" class="form-control" name="picture">
                </div>

                <div style="margin-top:10px;">
                    <img src="<?php echo htmlspecialchars($row['picture']); ?>" alt="Current Picture" style="max-width: 200px;">
                </div>

                <div>
                    <input type="submit" value="Update" class="btn btn-info" style="margin-top:10px; margin-bottom: 20px;">
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>
