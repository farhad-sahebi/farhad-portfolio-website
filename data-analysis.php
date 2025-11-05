<?php include 'Nav.php'; 
include 'conn.php';
$sql = "SELECT * FROM data_analysis";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Analysis Resources</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Custom styles -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body style="background-color: #e5e8e8;">
    <div class="container mt-2" style="background-color: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 30px;">
        <!-- Header -->
        <header class="text-center mb-5">
            <h1 class="display-4">Data Analysis Resources</h1>
            <p class="lead">Master the art of transforming raw data into meaningful insights through advanced techniques, tools, and best practices.</p>
        </header>

        <!-- Description Section -->
        <?php 
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
             ?>
            
        <section class="content-section">
            <h4><?php echo htmlspecialchars($row['Title']); ?></h4>
            <p>
               <?php echo htmlspecialchars($row['description']); ?>
            </p>
        </section>

        <!-- Visualization Slideshow -->
        <section class="content-section mt-5">
            <h4 class="mb-4"><?php echo htmlspecialchars($row['slide_title']); ?></h4>
            <div id="visualizationCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?php echo htmlspecialchars($row['slide1']);?>" class="d-block w-100" alt="Visualization 1">
                    </div>
                    <div class="carousel-item active">
                        <img src="<?php echo htmlspecialchars($row['slide2']);?>" class="d-block w-100" alt="Visualization 1">
                    </div>
                    <div class="carousel-item active">
                        <img src="<?php echo htmlspecialchars($row['slide3']);?>" class="d-block w-100" alt="Visualization 1">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#visualizationCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#visualizationCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>
<?php
            }
        }

        ?>
        <!-- Resources Section -->
<section class="resource-section mt-5 p-4 bg-light rounded shadow-sm">
    <div class="container">
        <h2 class="text-center mb-4">Resources</h2>

        <!-- Tutorials -->
        <div class="mb-5">
            <h3 class="h4">Tutorials and Guides</h3>
            <p>Explore comprehensive, step-by-step tutorials to master essential data analysis techniques:</p>
            <ul class="list-unstyled ps-3">
                <li class="mb-2">
                    <a href="https://www.datacamp.com/courses/cleaning-data-in-r" class="text-decoration-none text-primary" target="_blank">
                        <i class="bi bi-book"></i> Learn the fundamentals of data cleaning in R.
                    </a>
                </li>
                <li class="mb-2">
                    <a href="https://support.microsoft.com/en-us/excel" class="text-decoration-none text-primary" target="_blank">
                        <i class="bi bi-bar-chart"></i> Statistical Analysis Basics
                    </a>
                </li>
                <li class="mb-2">
                    <a href="https://www.coursera.org/learn/data-science-python" class="text-decoration-none text-primary" target="_blank">
                        <i class="fab fa-python"></i> Introduction to Data Science in Python
                    </a>
                </li>
            </ul>
        </div>

        <!-- Datasets -->
        <div class="mb-5">
            <h3 class="h4">Sample Datasets</h3>
            <p>Access and download curated datasets to practice and refine your analysis skills:</p>
            <ul class="list-unstyled ps-3">
                <li class="mb-2">
                    <a href="https://www.kaggle.com/c/titanic/data" class="text-decoration-none text-primary" target="_blank" download>
                        <i class="bi bi-filetype-csv"></i> Download Titanic Dataset - Kaggle
                    </a>
                </li>
                <li class="mb-2">
                    <a href="https://www.kaggle.com/c/new-york-city-taxi-fare-prediction" class="text-decoration-none text-primary" target="_blank" download>
                        <i class="bi bi-filetype-csv"></i>NYC Taxi Trip Data
                    </a>
                </li>
                <li class="mb-2">
                    <a href="https://www.kaggle.com/datasets/rounakbanik/ecommerce-sales-data" class="text-decoration-none text-primary" target="_blank" download>
                        <i class="bi bi-filetype-csv"></i>Download Sales Data - Kaggle
                    </a>
                </li>
            </ul>
        </div>

        <!-- Files -->
        <div class="mb-5">
            <h3 class="h4">R Scripts and Files</h3>
            <p>Download pre-written R scripts designed for specific stages of data analysis:</p>
            <ul class="list-unstyled ps-3">
                <li class="mb-2">
                    <a href="https://github.com/farhad-sahebi" class="text-decoration-none text-primary" download>
                        <i class="bi bi-code"></i> R Data Cleaning Script - GitHub
                    </a>
                </li>
                <li class="mb-2">
                    <a href="https://github.com/farhad-sahebi" class="text-decoration-none text-primary" download>
                        <i class="bi bi-graph-up"></i> R Data Visualization Script - GitHub
                    </a>
                </li>
                <li class="mb-2">
                    <a href="https://github.com/farhad-sahebi" class="text-decoration-none text-primary" download>
                        <i class="bi bi-pie-chart"></i> R Statistical Analysis Script - GitHub
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>

        <!-- Footer -->
        <?php include 'footer.php';?>
    </div>

</body>
</html>
<style>
        .carousel-inner img {
            max-height: 400px;
            object-fit: cover;
        }
        .content-section {
            margin-top: 50px;
        }
        .resource-section {
            margin-top: 30px;
        }
        .footer {
            margin-top: 50px;
            background-color: #f8f9fa;
            padding: 20px 0;
        }
    </style>
