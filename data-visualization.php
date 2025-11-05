<?php include 'Nav.php'; 
include 'conn.php';
$sql = "SELECT * FROM dashboards";
$sqll = "SELECT * FROM slide_det_visu";
$run = $conn->query($sqll);
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Visualization Dashboards</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color: #e5e8e8;">
    <div class="container mt-2">
        <!-- Header -->
        <header class="text-center mb-5 d-flex flex-wrap justify-content-between">
            <?php 
            if ($run->num_rows > 0) {
                while ($roww = $run->fetch_assoc()) {
            ?>
            <div class="text-section" style="flex: 1; padding-right: 20px; text-align: left;">
                <h1 class="display-4" style="font-size: 25px;"><?php echo htmlspecialchars($roww['Main_Title']) ?></h1>
                <p class="lead" style="font-size:12px;"><?php echo htmlspecialchars($roww['desc']); ?></p>
            </div>
            
            <!-- Carousel Section (Slideshow) -->
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" style="flex: 1;">
                <h2 style="font-size: 22px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 10px; background-color: white; border-radius:5px;"><?php echo htmlspecialchars($roww['Slide_title']) ?></h2>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?php echo htmlspecialchars($roww['slide1']) ?>" class="d-block w-100" alt="First Slide">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo htmlspecialchars($roww['slide2']) ?>" class="d-block w-100" alt="Second Slide">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo htmlspecialchars($roww['slide3']) ?>" class="d-block w-100" alt="Third Slide">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <?php   
                }
            }
            ?>
        </header>

        <!-- Cards Section -->
        <section class="row g-4">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
            ?>
                <div class="col-md-4 col-sm-12">
                    <div class="card text-center">
                        <img src="<?php echo htmlspecialchars($row['Pic_card']); ?>" class="card-img-top mx-auto" alt="Dashboard Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <a href="<?php echo htmlspecialchars($row['dataset_path']); ?>" class="text-dark text-decoration-none small" download>
                                        <i class="bi bi-file-earmark-spreadsheet me-1"></i> Dataset / Source
                                    </a>
                                    <br>
                                    <a href="<?php echo htmlspecialchars($row['dashboard_path']); ?>" class="text-dark text-decoration-none small" download>
                                        <i class="bi bi-bar-chart me-1"></i> Dashboard
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="<?php echo htmlspecialchars($row['description_path']); ?>" class="text-dark text-decoration-none small" download>
                                        <i class="bi bi-file-earmark-word me-1"></i> Description
                                    </a>
                                    <br>
                                    <a href="<?php echo htmlspecialchars($row['pdf_path']); ?>" class="text-dark text-decoration-none small" download>
                                        <i class="bi bi-file-earmark-pdf me-1"></i> Report
                                    </a>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="https://github.com/farhad-sahebi" class="text-dark text-decoration-none small">
                                    <i class="bi bi-github me-1"></i> For more info, see my GitHub
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
            } else {
                echo "No dashboards available.";
            }
            ?>
        </section>

        <?php include 'footer.php'; ?>
    </div>
</body>
</html>
<style>
body {
    background-color: #f4f6f9;
    font-family: 'Arial', sans-serif;
}

.container {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 30px;
    margin-top: 20px;
}

.card {
    border: none;
    border-radius: 10px;
    transition: transform 0.3s, box-shadow 0.3s;
    overflow: hidden;
    position: relative;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

.card img {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.card-body {
    padding: 20px;
}

.card-title {
    font-weight: bold;
    font-size: 1.25rem;
}

.card-text {
    font-size: 1rem;
    color: #555;
}

.btn-download {
    background-color: #909497;
    color: white;
    border-radius: 7px;
    font-size: 1rem;
    transition: background-color 0.3s;
}

.btn-download:hover {
    background-color: #cacfd2;
}

.btn-download i {
    margin-right: 5px;
}

.carousel-item img {
    object-fit: cover;
    height: 250px;
}

/* Responsive Styles */
@media (max-width: 768px) {
    /* Adjusting header layout for mobile */
    header {
        text-align: center;
        padding: 10px;
    }

    .carousel-inner img {
        height: 100%;
        object-fit: contain;
    }

    /* Adjusting card section */
    .row {
        display: block; /* Stack cards vertically */
    }

    .card {
        margin-bottom: 15px;
    }

    .card-img-top {
        height: 150px;
        object-fit: cover;
    }

    /* Ensure text in carousel is centered */
    .carousel-item h2 {
        text-align: center;
        font-size: 18px;
    }

    /* Mobile view for text section */
    .text-section {
        padding-right: 0;
        text-align: center;
    }
    
    /* Reducing padding for small screens */
    .card-body {
        padding: 15px;
    }

    .btn-download {
        font-size: 0.9rem;
        padding: 5px 10px;
    }

    /* Smaller carousel and card images for better view on mobile */
    .carousel-item img {
        object-fit: cover;
        height: 200px;
    }
}

</style>