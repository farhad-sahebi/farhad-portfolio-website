<?php
include 'conn.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title></title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
    }

    .hero {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      padding: 50px 20px;
      background-color: white;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .hero-content {
      max-width: 100%;
    }

    .hero-image img {
      max-width: 100%;
      height: auto;
      border-radius: 6px;
    }

    .cards-section {
      text-align: center;
      padding: 50px 20px;
      background-color: #f9f9f9;
    }

    .cards-container {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 20px;
    }

    .card {
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 20px;
      width: 90%;
      max-width: 300px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    }

    .footer-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }

    .footer-about, .footer-links, .footer-contact {
      margin-bottom: 20px;
    }

    @media (min-width: 768px) {
      .hero {
        flex-direction: row;
        text-align: left;
        justify-content: space-between;
      }
      .hero-content {
        max-width: 50%;
      }
      .footer-container {
        flex-direction: row;
        justify-content: space-between;
      }
    }
    
  </style>
</head>
<body>
 <?php $sql = "SELECT * FROM home_about";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
   while ($row =$result->fetch_assoc()) {
?>
<section class="hero">
  <div class="hero-content">
    <h5><?php echo htmlspecialchars($row['Title']); ?></h5>
    <p style="font-size: 13px; margin-right: 20px;"><?php echo htmlspecialchars($row['Text']); ?></p>
      <a href="Projects.php">
    <button class="btn btn-light" style="color: gray;">View My Work</button>
    </a>
  </div>
  <div class="hero-image mt-2">
    <img src="<?php echo htmlspecialchars($row['picture']); ?>" alt="Professional photo or graphic">
  </div>

</section>
<?php
   }
 }
?>
<section class="cards-section">
  <h2>What We Offer</h2>
  <div class="cards-container">
    <?php 
    $sqll = "SELECT * FROM home_card";
    $res = $conn->query($sqll);
    if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
    ?>
    <div class="card">
      <h3><?php echo htmlspecialchars($row['Title']);?></h3>
      <p><?php echo htmlspecialchars($row['Text']);?></p>
      <a href="<?php echo htmlspecialchars($row['link']);?>" target="_blank" class="btn btn-light">
      <i class="fas fa-database"></i> Learn More
      </a>
    </div>
    <?php    
  }
}
?>
</section>
<?php 
include 'footer.php';
?>
</body>
</html>
