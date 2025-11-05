<?php 
include 'Nav.php';
include 'conn.php';

$sql = "SELECT * FROM about";
$run = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        #about img {
            border: 2px solid #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            height: auto;
            max-width: 350px;
            object-fit: cover;
        }
        .about-container {
            background-color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            padding: 15px;
        }
        .about-text {
            color: gray;
            font-size: 13px;
            text-align: justify;
        }
    </style>
</head>
<body style="background-color: white;">
<section id="about" class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12 about-container">
                <?php 
                if ($run->num_rows > 0) {
                    while($row = $run->fetch_assoc()) {
                ?>
                <div class="row align-items-center">
                    <div class="col-md-4 text-center">
                        <img class="mb-4" src="<?php echo htmlspecialchars($row['picture']); ?>" 
                             alt="<?php echo htmlspecialchars($row['Title']); ?>" 
                             class="img-fluid">
                    </div>
                    <div class="col-md-8 text-center text-md-start">
                        <h2 class="mb-4" style="color: #5d6d7e;"> <?php echo htmlspecialchars($row['Title']); ?></h2>
                        <p class="about-text"> <?php echo htmlspecialchars($row['Text']); ?></p>
                        <a href="contact.php" class="btn btn-light mt-2">Get in Touch</a>
                    </div>
                </div>
                <?php 
                    }
                } else {
                    echo "<p class='text-center'>No information available at the moment.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</section>
<?php include 'footer.php';?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
