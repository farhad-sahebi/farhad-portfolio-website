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

// Fetch ID from the URL and validate it
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id == 0) {
    die("Invalid ID.");
}

// Query to fetch data for the given ID
$sql = "SELECT * FROM home_card WHERE id = '$id'";
$result = $conn->query($sql);

if (!$result) {
    die("Error fetching card data: " . $conn->error);
}

$row = $result->num_rows > 0 ? $result->fetch_assoc() : null;

if (!$row) {
    die("No card found with this ID.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $text = mysqli_real_escape_string($conn, $_POST['text']);
    $link = mysqli_real_escape_string($conn, $_POST['link']);
    $id = intval($_POST['id']); // Sanitize ID again

    // Update query
    $update = $conn->query("UPDATE home_card SET Title='$title', Text='$text', link='$link' WHERE id='$id'");

    if ($update) {
        echo "<script>alert('The data has been updated!');</script>";
        header('Location: Platform_Managment.php');
        exit();
    } else {
        echo "<script>alert('The data is not updated!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Home Card</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
<form method="post" action="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" style="margin-top:50px;">
                <div class="form-control">
                    <label class="form-label" style="margin-top:18px;">Enter the Title for the Card</label>
                    <input type="text" class="form-control" placeholder="Enter The Title" name="title" value="<?php echo htmlspecialchars($row['Title']); ?>">

                    <label class="form-label" style="margin-top:18px;">Enter the Text for the Card</label>
                    <textarea class="form-control" id="description" placeholder="Enter The Text" rows="4" name="text"><?php echo htmlspecialchars($row['Text']); ?></textarea>

                    <label class="form-label" style="margin-top:18px;">Enter the Link for the Card</label>
                    <input type="text" class="form-control" placeholder="Link" name="link" value="<?php echo htmlspecialchars($row['link']); ?>">

                    <!-- Hidden field to pass the 'id' -->
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <input type="submit" value="Update" class="btn btn-info" style="margin-top:10px; margin-bottom: 20px;" name="btn">
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</form>
</body>
</html>
