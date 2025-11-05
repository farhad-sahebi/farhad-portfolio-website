<?php
include 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color: #e5e8e8;">
    <!-- Include Navigation -->
    <?php include 'Nav.php' ?>

    <div class="container-fluid">
        <div class="row" style="margin-top: -40px;">
            <div class="col-md-1"></div>
            <div class="col-md-10 mt-5">
                <!-- Slide Show Home Page -->
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <!-- Indicators will update dynamically -->
                        <?php
                        $query = "SELECT * FROM home_slides";
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            $i = 0;
                            while ($i < $result->num_rows) {
                                ?>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $i; ?>" 
                                class="<?php echo $i === 0 ? 'active' : ''; ?>" 
                                aria-current="<?php echo $i === 0 ? 'true' : 'false'; ?>" 
                                aria-label="Slide <?php echo $i + 1; ?>"></button>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                    </div>
                    <div class="carousel-inner">
                        <?php
                        if ($result->num_rows > 0) {
                            $isFirst = true; // Track the first item for the 'active' class
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <div class="carousel-item <?php echo $isFirst ? 'active' : ''; ?>">
                                    
                                    <img src="<?php echo htmlspecialchars($row['image_url']); ?>" class="d-block w-100" alt="Image" style="object-fit: cover; height: 400px; width: 100%; padding-bottom: 10px; padding-top: 10px;">

                                    <div class="carousel-caption d-none d-md-block">
                                        <a target="_blank" href="<?php echo htmlspecialchars($row['link']); ?>" style="text-decoration: none; color: black;">
                                            <h5><?php echo htmlspecialchars($row['caption_text']); ?></h5>
                                            <p><?php echo htmlspecialchars($row['caption_title']); ?></p>
                                        </a>
                                    </div>
                                </div>
                                <?php
                                $isFirst = false; // Only the first item should have the 'active' class
                            }
                        } else {
                            // Handle the case where no results are found
                            echo "<p>No slides available.</p>";
                        }
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <?php include 'Home_Card.php';?>
            </div>
        </div>
    </div>
    
    <!-- External JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>

<style>
    .heading2 {
        padding: 7px;
        background-color: white;
        text-align: center;
        border-radius: 5px;
        font-size: 23px;
        font-family: Serif Fonts;
        color: black;
    }
    .carousel-caption {
        background-color: rgba(255, 255, 255, 0.7);
        color: black;
        text-decoration: none;
        border-radius: 4px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        opacity: 90%;
    }
    @media (max-width: 768px) {
        .carousel-inner img {
            height: 300px; /* Adjusted for smaller screens */
        }
    }
    @media (min-width: 768px) {
        .carousel-inner img {
            height: 500px; /* Adjusted for larger screens */
        }
    }
</style>
