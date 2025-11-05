<?php
session_start();
if (!isset($_SESSION['reg'])) {
    header("Location: login.php"); // Redirect to login page if session is not active
    exit();
}
?>
<?php
include 'conn.php';

// Initialize variables
$id = $title = $description = $Pic_card = $dataset_path = $dashboard_path = $description_path = $pdf_path = "";
$successMessage = $errorMessage = "";

// Check if it's a POST request (update operation)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate ID
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        $errorMessage = "Error: No ID provided.";
    } else {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];

        // File upload handling
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $Pic_card = !empty($_FILES['Pic_card']['name']) ? $uploadDir . basename($_FILES['Pic_card']['name']) : null;
        $dataset_path = !empty($_FILES['dataset_path']['name']) ? $uploadDir . basename($_FILES['dataset_path']['name']) : null;
        $dashboard_path = !empty($_FILES['dashboard_path']['name']) ? $uploadDir . basename($_FILES['dashboard_path']['name']) : null;
        $description_path = !empty($_FILES['description_path']['name']) ? $uploadDir . basename($_FILES['description_path']['name']) : null;
        $pdf_path = !empty($_FILES['pdf_path']['name']) ? $uploadDir . basename($_FILES['pdf_path']['name']) : null;

        // Upload new files if provided
        if ($Pic_card) move_uploaded_file($_FILES['Pic_card']['tmp_name'], $Pic_card);
        if ($dataset_path) move_uploaded_file($_FILES['dataset_path']['tmp_name'], $dataset_path);
        if ($dashboard_path) move_uploaded_file($_FILES['dashboard_path']['tmp_name'], $dashboard_path);
        if ($description_path) move_uploaded_file($_FILES['description_path']['tmp_name'], $description_path);
        if ($pdf_path) move_uploaded_file($_FILES['pdf_path']['tmp_name'], $pdf_path);

        // Update query
        $query = "UPDATE dashboards 
                  SET title = ?, description = ?, Pic_card = COALESCE(?, Pic_card), 
                      dataset_path = COALESCE(?, dataset_path), dashboard_path = COALESCE(?, dashboard_path), 
                      description_path = COALESCE(?, description_path), pdf_path = COALESCE(?, pdf_path)
                  WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            "sssssssi",
            $title,
            $description,
            $Pic_card,
            $dataset_path,
            $dashboard_path,
            $description_path,
            $pdf_path,
            $id
        );

        if ($stmt->execute()) {
            $successMessage = "Dashboard updated successfully.";
            header("Location: Platform_Managment.php");
        } else {
            $errorMessage = "Error: " . $stmt->error;
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') { 
    // Check if ID is provided for fetching data
    if (!isset($_GET['id'])) {
        die("Error: No ID provided.");
    }

    $id = $_GET['id'];

    // Fetch the existing record
    $query = "SELECT * FROM dashboards WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("Error: No record found with this ID.");
    }

    $data = $result->fetch_assoc();
    $title = $data['title'];
    $description = $data['description'];
    $Pic_card = $data['Pic_card'];
    $dataset_path = $data['dataset_path'];
    $dashboard_path = $data['dashboard_path'];
    $description_path = $data['description_path'];
    $pdf_path = $data['pdf_path'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Dashboard</h2>

    <!-- Display success or error messages -->
    <?php if ($successMessage): ?>
        <div class="alert alert-success"><?php echo $successMessage; ?></div>
    <?php endif; ?>
    <?php if ($errorMessage): ?>
        <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <!-- Hidden field to store ID -->
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

        <div class="mb-3">
            <label for="title" class="form-label">Dashboard Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" required>
        </div>

        <div class="mb-3">
            <label for="Pic_card" class="form-label">Card Picture</label>
            <input type="file" class="form-control" id="Pic_card" name="Pic_card">
            <small>Current: <?php echo htmlspecialchars($Pic_card); ?></small>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($description); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="dataset_path" class="form-label">Dataset Path (CSV)</label>
            <input type="file" class="form-control" id="dataset_path" name="dataset_path">
            <small>Current: <?php echo htmlspecialchars($dataset_path); ?></small>
        </div>

        <div class="mb-3">
            <label for="dashboard_path" class="form-label">Dashboard Path (PBIX)</label>
            <input type="file" class="form-control" id="dashboard_path" name="dashboard_path">
            <small>Current: <?php echo htmlspecialchars($dashboard_path); ?></small>
        </div>

        <div class="mb-3">
            <label for="description_path" class="form-label">Description Path (DOCX)</label>
            <input type="file" class="form-control" id="description_path" name="description_path">
            <small>Current: <?php echo htmlspecialchars($description_path); ?></small>
        </div>

        <div class="mb-3">
            <label for="pdf_path" class="form-label">PDF Path</label>
            <input type="file" class="form-control" id="pdf_path" name="pdf_path">
            <small>Current: <?php echo htmlspecialchars($pdf_path); ?></small>
        </div>

        <button type="submit" class="btn btn-primary">Update Dashboard</button>
    </form>
</div>
</body>
</html>
