<?php
session_start();
if (!isset($_SESSION['reg'])) {
    header("Location: login.php"); // Redirect to login page if session is not active
    exit();
}
?>
<?php 
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pwd'])) {
    $full_name = $_POST['full_name'];
    $official_email = $_POST['email_address'];
    $password = $_POST['pswd'];
    $project = $_POST['project_name'];
    $phone_number = $_POST['Phone_number'];
    $organization = $_POST['Organization_name'];
    $access_limit = $_POST['Access_Limit'];
    $enternal_user = $_POST['En_Us'];

   $stmt = $conn->prepare("INSERT INTO reg (`Full Name`, `Offical_Email`, `Password`, `Project`, `Phone_Number`, `Organization`, `Access_Limit`, `Enternal_User`) 
	VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("ssssisss", $full_name, $official_email, $password, $project, $phone_number, $organization, $access_limit, $enternal_user);

    if ($stmt->execute()) {
        echo '<script>alert("Registration successful!");
         window.location.href = "Platform_Managment.php";
        </script>';
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registeration</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body style="background-color: #e5e8e8;">
<form method="post" action="Reg.php">
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
		<div class="mt-3">
			<label class="form-label">Full Name</label>
		<input type="tex" name="full_name" class="form-control" placeholder="Please Enter The Full Name" required>
		</div>
		<div class="mt-3">
			<label class="form-label">Password</label>
		<input type="tex" name="pswd" class="form-control" placeholder="Please Enter The Password" required>
		</div>
		<div class="mt-3">
			<label class="form-label">Project</label>
		<input type="tex" name="project_name" class="form-control" placeholder="Please Enter The Project Name" required>
		</div>
		<div class="mt-3">
			<label class="form-label">Position</label>
		<input type="tex" name="En_Us" class="form-control" placeholder="Please Enter The Position" required>
		</div>
		<input type="submit" class="btn btn-info" style="margin-top: 15px; padding-left:10px; padding-right:10px; padding-bottom:7px; color:black;" name="pwd" value="Submit">

		</div>
		<div class="col-md-6">
			<div class="mt-3">
			<label class="form-label">Offical Email</label>
		<input type="tex" name="email_address" class="form-control" placeholder="Please Enter The Offical Email address" required>
		</div>
		<div class="mt-3">
			<label class="form-label">Phone Number</label>
		<input type="tex" name="Phone_number" class="form-control" placeholder="Please Enter The Phone Number" required>
		</div>
		<div class="mt-3">
			<label class="form-label">Organization</label>
		<input type="tex" name="Organization_name" class="form-control" placeholder="Please Enter The Organization Name" required>
		</div>
		<div class="mt-3">
			<label class="form-label">Access Limit</label>
		<input type="tex" name="Access_Limit" class="form-control" placeholder="Please Enter The Access Limits" required>
		</div>
			<p style="font-size:10px; text-align:center; margin-top:16px;">Welcome to the registration section. Please provide accurate information.</p>
		</div>
		
	</div>
</div>
</form>
</body>
</html>
<style>
.col-md-6{
	font-size: 13px;
	background-color: white;
	border-radius: 2px;
	padding: 1px;
	padding-right: 20px;
	padding-left: 20px;
	padding-bottom: 50px;
	box-shadow: 0  4px rgba(0, 0, 0, 0.1);
}
.form-label{
	font-size: 13px;
}
</style>