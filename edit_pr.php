<?php
session_start();
if (!isset($_SESSION['reg'])) {
    header("Location: login.php"); // Redirect to login page if session is not active
    exit();
}
?>
<?php
include 'Nav.php';
include 'conn.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (!$id) {
    die("Invalid project ID.");
}

// Fetch project data
$select = mysqli_query($conn, "SELECT * FROM projects WHERE ID = '$id'");
$row = mysqli_fetch_assoc($select);

if (!$row) {
    die("Project not found.");
}

$old_image = $row['picture'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
<form method="post" action="" enctype="multipart/form-data" style="margin-top:30px;">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="form-control">
                <label class="form-label" style="margin-top:18px;">Enter The Info About Project</label>
                <textarea id="description" name="description" class="form-control" rows="1" placeholder="Write the info about this project..." required><?php echo htmlspecialchars($row['description']); ?></textarea>
                
                <label class="form-label" style="margin-top:18px;">Enter The Project Name</label>
                <input type="text" class="form-control" placeholder="Project Name" name="project_name" value="<?php echo htmlspecialchars($row['Project_Name']); ?>" required>
                
                <label class="form-label" style="margin-top:18px;">Enter The Link for Project Dashboard</label>
                <input type="text" class="form-control" placeholder="Link..." name="link" value="<?php echo htmlspecialchars($row['link']); ?>" required>
                
                <div>
                    <img src="<?php echo "uploads/" . htmlspecialchars($old_image); ?>" style="height: 100px; width:120px; margin-top: 20px; border-radius: 3px;">
                </div>
                
                <label class="form-label" style="margin-top:18px;">Update the Picture of the Project (Optional)</label>
                <input type="file" class="form-control" name="picture">
                
                <input type="submit" value="Update" class="btn btn-info" style="margin-top:10px; margin-bottom: 20px;" name="btn">
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>    
</form>
</body>
</html>

<?php
if (isset($_POST['btn'])) {
    // Sanitize inputs
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $project_Name = mysqli_real_escape_string($conn, $_POST['project_name']);
    $link = mysqli_real_escape_string($conn, $_POST['link']);

    $profile_name = $old_image; // Default to old image

    if (!empty($_FILES['picture']['name'])) {
        $temp = $_FILES['picture']['tmp_name'];
        $profile_name = basename($_FILES['picture']['name']);
        $file_type = strtolower(pathinfo($profile_name, PATHINFO_EXTENSION));

        // Validate file type
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($file_type, $allowed_types)) {
            $upload_path = "uploads/$profile_name"; // Save in `uploads` directory
            if (!move_uploaded_file($temp, $upload_path)) {
                echo "<script>alert('Failed to upload the image.');</script>";
                $profile_name = $old_image;
            }
        } else {
            echo "<script>alert('Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.');</script>";
            $profile_name = $old_image;
        }
    }

    // Update project data
    $update = mysqli_query($conn, "UPDATE Projects SET Project_Name='$project_Name', description='$description', link='$link', picture='$profile_name' WHERE ID='$id'");

    if ($update) {
        echo "<script>alert('The data was updated successfully!'); window.location.href='Platform_Managment.php';</script>";
    } else {
        echo "<script>alert('Failed to update the data.');</script>";
    }
}
?>
