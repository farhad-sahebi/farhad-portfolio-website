<?php
session_start();
if (!isset($_SESSION['reg'])) {
    header("Location: login.php"); // Redirect to login page if session is not active
    exit();
}
?>
<?php
include 'conn.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Ensure $id is an integer for security

if ($id == 0) {
    die("Invalid ID.");
}

$sql = "SELECT * FROM home_slides WHERE id = '$id'";
$result = $conn->query($sql);

if (!$result) {
    die("Error fetching slide data: " . $conn->error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Slide</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
<form method="post" action="" enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" style="margin-top:50px;">
                <div class="form-control">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <label class="form-label" style="margin-top:18px;">Enter The Description About Slide...</label>
                            <textarea id="description" name="caption_text" class="form-control" rows="1" placeholder="Write the info about this slide..."><?php echo htmlspecialchars($row['caption_text']); ?></textarea>

                            <label class="form-label" style="margin-top:18px;">Enter The Slide Title</label>
                            <input type="text" class="form-control" placeholder="Slide Title" name="caption_title" value="<?php echo htmlspecialchars($row['caption_title']); ?>">

                            <label class="form-label" style="margin-top:18px;">Enter The Link for Slide...</label>
                            <input type="text" class="form-control" placeholder="Link..." name="link" value="<?php echo htmlspecialchars($row['link']); ?>">

                            <div>
                                <img src="<?php echo htmlspecialchars($row['image_url']); ?>" style="width: 200px; height: auto; margin-top: 20px;">
                            </div>

                            <label class="form-label" style="margin-top:18px;">Enter The Picture Slide</label>
                            <input type="file" class="form-control" name="picture">

                            <!-- Hidden field to pass the 'id' -->
                            <input type="hidden" name="id" value="<?php echo $id; ?>">

                            <input type="submit" value="Update" class="btn btn-info" style="margin-top:10px; margin-bottom: 20px;" name="btn">
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No slide found with this ID.</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</form>

<?php
if (isset($_POST['btn'])) {
    // Get POST data
    $tiel = mysqli_real_escape_string($conn, $_POST['caption_title']);
    $text = mysqli_real_escape_string($conn, $_POST['caption_text']);
    $link = mysqli_real_escape_string($conn, $_POST['link']);
    $id = intval($_POST['id']); // Sanitize ID again

    // File upload logic
    $pic = $_FILES['picture']['name'];
    $uploadOk = true;
    $targetDir = 'Pictures/';
    $targetFile = $targetDir . basename($pic);

    if (!empty($pic)) {
        if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetFile)) {
            $image_url = $targetFile;
        } else {
            $uploadOk = false;
            echo "<script>alert('File upload failed.');</script>";
        }
    } else {
        $image_url = $row['image_url']; // Retain old image if no new image is uploaded
    }

    if ($uploadOk) {
        $update = $conn->query("UPDATE home_slides SET caption_title='$tiel', caption_text='$text', link='$link', image_url='$image_url' WHERE id='$id'");

        if ($update) {
            echo "<script>alert('The data has been updated!');</script>";
            header('Location: Platform_Managment.php');
            exit();
        } else {
            echo "<script>alert('The data is not updated!');</script>";
        }
    }
}
?>
</body>
</html>
