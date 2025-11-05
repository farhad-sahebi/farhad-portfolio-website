<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Projects</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body style="background-color:#f8f9fa;">
    <?php include 'Nav.php'; ?>
    
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-2"></div> <!-- Left empty space -->
			<div class="col-md-8 mt-4">
				<h2 class="text-center bg-white shadow-sm py-2 rounded mb-2" style="font-size: 27px; margin-top: -25px;">My Portfolio</h2>
				<div class="row">
					<?php
					// Include the database connection
					include 'conn.php';

					// Fetch projects from the database
					$sql = "SELECT * FROM projects";
					$result = $conn->query($sql);
					
					// Check if there are any projects in the database
					if ($result->num_rows > 0) {
						// Loop through each project and display it
						while ($row = $result->fetch_assoc()) {
					?>
					<div class="col-md-4 mb-4">
						<div class="card shadow-lg border-0">
							<a href="<?php echo htmlspecialchars($row['link']); ?>" target="_blank" rel="noopener noreferrer">
								<img src="uploads/<?php echo htmlspecialchars($row['picture']); ?>" class="card-img-top img-fluid" alt="Project Image" style="height: 200px; object-fit: cover;">
							</a>
							<div class="card-body">
								<h5 class="card-title text-truncate"><?php echo htmlspecialchars($row['Project_Name']); ?></h5>
								<p class="card-text text-muted text-truncate description" title="<?php echo htmlspecialchars($row['description']); ?>">
								    <?php echo htmlspecialchars($row['description']); ?>
								</p>
								<style>
								.description {
									display: -webkit-box;
									-webkit-line-clamp: 3; /* Display 3 lines */
									-webkit-box-orient: vertical;
									overflow: hidden;
									text-overflow: ellipsis;
									white-space: normal; /* Allows wrapping of text */
								}
								</style>

								<a class="btn btn-light btn-sm" target="_blank" href="Project_Details.php?id=<?php echo $row['ID']; ?>" 
							   style="border: 1px solid #bdc3c7; border-radius: 7px; color: #5d6d7e; display: flex; justify-content: center; align-items: center; padding: 8px 12px;">
							   <i class="fas fa-chart-line" style="margin-right: 5px;"></i>
							   View Project
							</a>
							</div>
						</div>
					</div>
					<?php
						}
					} else {
						echo "<p class='text-center text-muted'>No projects available. Add new projects to display here.</p>";
					}
					?>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
	
    <!-- Footer (if needed) -->
    <?php include 'footer.php'; ?>

    <!-- Closing the connection -->
    <?php $conn->close(); ?>

</body>
</html>
