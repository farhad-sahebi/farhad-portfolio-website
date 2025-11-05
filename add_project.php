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
    // Collect form data
    $projectName = $_POST['project_name'];
    $description = $_POST['description'];
    $link = $_POST['link'];
    $keyFeatures = $_POST['key_features'];
    $tools = $_POST['tools'];
    $results = $_POST['results'];
    $roleAndResponsibilities = $_POST['role_and_responsibilities'];

    // File upload directory
    $uploadsDir = "uploads/";

    // Ensure the uploads directory exists
    if (!is_dir($uploadsDir)) {
        mkdir($uploadsDir, 0777, true);
    }

    // Upload function
    function uploadFile($fileInput, $uploadsDir) {
        if (isset($_FILES[$fileInput]) && $_FILES[$fileInput]['error'] === UPLOAD_ERR_OK) {
            $fileName = basename($_FILES[$fileInput]['name']);
            $targetPath = $uploadsDir . $fileName;

            // Move uploaded file to target directory
            if (move_uploaded_file($_FILES[$fileInput]['tmp_name'], $targetPath)) {
                return $fileName; // Return the file name to store in the database (not the full path)
            }
        }
        return null; // Return null if upload fails
    }

    // Process file uploads
    $picture = uploadFile('picture', $uploadsDir);
    $reportPdf = uploadFile('report_pdf_path', $uploadsDir);
    $wordDoc = uploadFile('word_doc_path', $uploadsDir);
    $rFile = uploadFile('r_file_path', $uploadsDir);
    $htmlFile = uploadFile('html_file_path', $uploadsDir);
    $powerBiFile = uploadFile('power_bi_file_path', $uploadsDir);
    $slide1 = uploadFile('slide1', $uploadsDir);
    $slide2 = uploadFile('slide2', $uploadsDir);
    $slide3 = uploadFile('slide3', $uploadsDir);

    // SQL Insert Query
    $sql = "INSERT INTO projects (Project_Name, description, link, picture, Key_Features, Tools, Results, Role_and_Responsibilities, report_pdf_path, word_doc_path, r_file_path, html_file_path, power_bi_file_path, slide1, slide2, slide3) 
            VALUES ('$projectName', '$description', '$link', '$picture', '$keyFeatures', '$tools', '$results', '$roleAndResponsibilities', '$reportPdf', '$wordDoc', '$rFile', '$htmlFile', '$powerBiFile', '$slide1', '$slide2', '$slide3')";

    // Execute query and check for success
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Project added successfully!');
        window.location.href = 'Platform_Managment.php';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-1 mb-4" style="padding: 15px; background-color: white; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h2>Add New Project</h2>
        <form method="post" action="add_project.php" enctype="multipart/form-data">
            <!-- Project Name -->
            <label for="project_name" class="form-label">Project Name:</label>
            <input type="text" name="project_name" id="project_name" class="form-control" required>

            <!-- Description -->
            <label for="description" class="form-label mt-3">Description:</label>
            <textarea name="description" id="description" class="form-control" rows="4" required></textarea>

            <!-- Link -->
            <label for="link" class="form-label mt-3">Project Dashboard Link:</label>
            <input type="url" name="link" id="link" class="form-control">

            <!-- Picture -->
            <label for="picture" class="form-label mt-3">Main Picture:</label>
            <input type="file" name="picture" id="picture" class="form-control" accept="image/*" required>

            <!-- Key Features -->
            <label for="key_features" class="form-label mt-3">Key Features:</label>
            <textarea name="key_features" id="key_features" class="form-control" rows="3"></textarea>

            <!-- Tools -->
            <label for="tools" class="form-label mt-3">Tools Used:</label>
            <textarea name="tools" id="tools" class="form-control" rows="3"></textarea>

            <!-- Results -->
            <label for="results" class="form-label mt-3">Results:</label>
            <textarea name="results" id="results" class="form-control" rows="3"></textarea>

            <!-- Role and Responsibilities -->
            <label for="role_and_responsibilities" class="form-label mt-3">Role and Responsibilities:</label>
            <textarea name="role_and_responsibilities" id="role_and_responsibilities" class="form-control" rows="4"></textarea>

            <!-- File Inputs -->
            <label for="report_pdf_path" class="form-label mt-3">Report PDF:</label>
            <input type="file" name="report_pdf_path" id="report_pdf_path" class="form-control" accept=".pdf">

            <label for="word_doc_path" class="form-label mt-3">Word Document:</label>
            <input type="file" name="word_doc_path" id="word_doc_path" class="form-control" accept=".docx">

            <label for="r_file_path" class="form-label mt-3">R Script File:</label>
            <input type="file" name="r_file_path" id="r_file_path" class="form-control" accept=".R">

            <label for="html_file_path" class="form-label mt-3">Data set:</label>
            <input type="file" name="html_file_path" id="html_file_path" class="form-control" accept=".csv, .xls, .xlsx">

            <label for="power_bi_file_path" class="form-label mt-3">Power BI File:</label>
            <input type="file" name="power_bi_file_path" id="power_bi_file_path" class="form-control" accept=".pbix">

            <label for="slide1" class="form-label mt-3">Slide 1:</label>
            <input type="file" name="slide1" id="slide1" class="form-control">
            <label for="slide2" class="form-label mt-3">Slide 2:</label>
            <input type="file" name="slide2" id="slide2" class="form-control">
            <label for="slide3" class="form-label mt-3">Slide 3:</label>
            <input type="file" name="slide3" id="slide3" class="form-control">

            <!-- Submit Button -->
            <button type="submit" class="btn btn-info mt-4" style="color: black;">Submit</button>
        </form>
    </div>
</body>
</html>
