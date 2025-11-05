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
    $title = $_POST['title'];
    $text = $_POST['description'];
    $picture = $_FILES['picture']['name'];
    $target = 'Pictures/' . basename($picture);

    // Handle file upload
    if (move_uploaded_file($_FILES['picture']['tmp_name'], $target)) {
        // Save the full path (Pictures/filename.jpg) into the database
        $sql = "INSERT INTO about (Title, Text, picture) VALUES ('$title', '$text', '$target')";
        
        if ($conn->query($sql)) {
            echo "<script>alert('Added successfully!');
            window.location.href = 'Platform_Managment.php';
            </script>";
        } else {
            echo "<script>alert('Not Added!');
            window.location.href = 'Platform_Managment.php';
            </script>";
        }
    } else {
        echo "<script>alert('File upload failed!');
        window.location.href = 'Platform_Managment.php';
        </script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<form method="post" action="insert_about.php" enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="row">
            <div class="form-control">
                <label class="form-label" style="margin-top:18px;">Enter The Title</label>
                <div><input type="text" class="form-control" placeholder="Title" name="title" required></div>

                <label class="form-label" style="margin-top:18px;">Enter The Description...</label>
                <div><textarea id="description" name="description" class="form-control" rows="4" placeholder="Write the info about..." required></textarea></div>

                <label class="form-label" style="margin-top:18px;">Enter The Picture</label>
                <div><input type="file" class="form-control" name="picture" required></div>

                <div>
                    <input type="submit" value="Submit" class="btn btn-info" style="margin-top:10px; margin-bottom: 20px;">
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>
