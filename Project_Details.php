<?php
include 'Nav.php';
include 'conn.php'; // Include your database connection

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize the 'id' to prevent SQL injection

    // Query the database for the project details
    $query = "SELECT * FROM projects WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the project exists
    if ($result->num_rows > 0) {
        $project = $result->fetch_assoc();
    } else {
        die("Project not found.");
    }
} else {
    die("Invalid request.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($project['Project_Name']); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body style="background-color: #e5e8e8;">
    <!-- Header Section -->
    <div class="container mt-2">
        <header class="text-center mb-1" style="margin-top: -10px; background-color: white; border-radius: 5px; padding: 3px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <h3 style="padding-top: 5px;"><?php echo htmlspecialchars($project['Project_Name']); ?></h3>
        </header>
        <div class="row">
            <!-- Slideshow Section -->
            <div class="col-md-6">
                <div id="projectSlideshow" class="carousel slide shadow-sm rounded" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="uploads/<?php echo htmlspecialchars($project['slide1']); ?>" class="d-block w-100 rounded" alt="Slide 1">
                        </div>
                        <div class="carousel-item">
                            <img src="uploads/<?php echo htmlspecialchars($project['slide2']); ?>" class="d-block w-100 rounded" alt="Slide 2">
                        </div>
                        <div class="carousel-item">
                            <img src="uploads/<?php echo htmlspecialchars($project['slide3']); ?>" class="d-block w-100 rounded" alt="Slide 3">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#projectSlideshow" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#projectSlideshow" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <!-- Description Section -->
            <div class="col-md-2" style="background-color: white; border-radius: 5px; padding: 13px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); width: 650px;">
                <h2 style="font-size: 22px;">Project Overview</h2>
                <p style="font-size: 12px;"><?php echo nl2br(htmlspecialchars($project['description'])); ?></p>

                <h4 style="font-size: 22px;">Key Features</h4>
                <ul style="font-size: 12px;">
                    <?php
                    $features = explode("\n", $project['Key_Features']);
                    foreach ($features as $feature) {
                        echo "<li>" . htmlspecialchars($feature) . "</li>";
                    }
                    ?>
                </ul>

                <h4 style="font-size: 22px;">Tools and Technologies Used</h4>
                <p style="font-size: 12px;"><?php echo htmlspecialchars($project['Tools']); ?></p>
            </div>
        </div>

        <!-- Results and Outcomes -->
        <div class="row mt-1">
            <div class="col-md-12">
                <div style="background-color: white; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <h4 style="font-size: 22px;">Results and Outcomes</h4>
                    <p style="font-size: 12px;"><?php echo nl2br(htmlspecialchars($project['Results'])); ?></p>

                    <h4 style="font-size: 22px;">Role and Responsibilities</h4>
                    <p style="font-size: 12px;"><?php echo nl2br(htmlspecialchars($project['Role_and_Responsibilities'])); ?></p>
                </div>
            </div>
        </div>

        <!-- Download Section -->
        <div class="download-section mt-2 p-4 bg-white rounded shadow-sm">
    <h4 class="text-center mb-4">Downloadable Resources</h4>
    <div class="row justify-content-center" style="color: black;">
        <?php
        // Define an array of file paths from the database
        $files = [
            ['path' => $project['report_pdf_path'], 'icon' => 'bi-file-earmark-pdf', 'label' => 'Project Report'],
            ['path' => $project['word_doc_path'], 'icon' => 'bi-file-earmark-word', 'label' => 'Project Description'],
            ['path' => $project['r_file_path'], 'icon' => 'bi-file-earmark-code', 'label' => 'R Scripts'],
            ['path' => $project['html_file_path'], 'icon' => 'bi bi-file-earmark-excel', 'label' => 'Data Set'],
            ['path' => $project['power_bi_file_path'], 'icon' => 'bi-file-earmark-bar-graph', 'label' => 'Dashboards'],
        ];

        // Loop through the files and render them
        foreach ($files as $file) {
            if (!empty($file['path'])) {
                ?>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center mb-3">
                    <a href="uploads/<?php echo htmlspecialchars($file['path']); ?>" download style="text-decoration: none;">
                        <i class="bi <?php echo $file['icon']; ?>" style="font-size: 2rem; color: black;"></i>
                        <p style="color: black;"><?php echo $file['label']; ?></p>
                    </a>
                </div>
                <?php
            }
        }
        ?>
        <div class="mt-5">
            <h4>Explore the Code</h4>
            <p>
                Access the complete source code and documentation on my
                <a href="<?php echo htmlspecialchars($project['link']); ?>" target="_blank" class="text-primary">GitHub Repository</a>.
            </p>
        </div>
    </div>
</div>

    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
<style type="text/css">
    img{
        height: 355px;
    }
    .container .row {
    display: flex;
    align-items: stretch; /* Ensures both sections have the same height */
}

.col-md-2 {
    height: 355px; /* Match the slideshow height */
    overflow-y: auto; /* Enables scrolling if content overflows */
}

</style>
