<?php
session_start();
if (!isset($_SESSION['reg'])) {
    header("Location: login.php"); // Redirect to login page if session is not active
    exit();
}
?>
<?php
include 'conn.php';
$id = $_GET['id'];
$select = mysqli_query($conn,"SELECT * FROM reg WHERE ID = '$id'");
$row = mysqli_fetch_assoc($select);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit_User</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body style="background-color: #e5e8e8;">
<form method="post">
<div class="container-fluid">
	<div class="row">
		<div class="center-image">
    			<img src="Pictures/logo.png" alt="Image" style="max-width: 100%; height: 40px; margin-top: 20px;">
		</div>
		<div class="col-md-2"></div>
		<div class="col-md-4" style="margin-top: 30px">
		<div class="mt-3">
			<label class="form-label">Full Name</label>
		<input type="tex" name="full_name", class="form-control" placeholder="Please Enter The Full Name" required value="<?php echo $row['Full Name']?>">
		</div>
		<div class="mt-3">
			<label class="form-label">Password</label>
		<input type="tex" name="pswd", class="form-control" placeholder="Please Enter The Password" required value="<?php echo $row['Password'];?>">
		</div>
		<div class="mt-3">
			<label class="form-label">Project</label>
		<input type="tex" name="project_name", class="form-control" placeholder="Please Enter The Project Name" required value="<?php echo $row['Project'];?>">
		</div>
		<div class="mt-3">
			<label class="form-label">Position</label>
		<input type="tex" name="En_Us", class="form-control" placeholder="Enter the Position" required value="<?php echo $row['Enternal_User'];?>">
		</div>
		<button class="btn btn-primary btn-sm" style="margin-top: 15px; padding-left:20px; padding-right:20px; padding-bottom:7px" name="upd">Update</button>
		</div>
		<div class="col-md-4" style="margin-top: 30px">
			<div class="mt-3">
			<label class="form-label">Offical Email</label>
		<input type="tex" name="email_address", class="form-control" placeholder="Please Enter The Offical Email address" required value="<?php echo $row['Offical_Email'];?>">
		</div>
		<div class="mt-3">
			<label class="form-label">Phone Number</label>
		<input type="tex" name="Phone_number", class="form-control" placeholder="Please Enter The Phone Number" required value="<?php echo $row['Phone_Number'];?>">
		</div>
		<div class="mt-3">
			<label class="form-label">Organization</label>
		<input type="tex" name="Organization_name", class="form-control" placeholder="Please Enter The Organization Name" required value="<?php echo $row['Organization'];?>">
		</div>
		<div class="mt-3">
			<label class="form-label">Access Limit</label>
		<input type="tex" name="Access_Limit", class="form-control" placeholder="Please Enter The Access Limits" required value="<?php echo $row['Access_Limit']?>">
		</div>
			<p style="font-size:10px; text-align:center; margin-top:16px;">Welcome to the registration page. Please provide accurate information. If you wish to return to the admin page, <a href="http://localhost/ARTF/Platform_Managment.php">click here</a>.</p>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>
</form>
</body>
</html>
<?php
include 'conn.php'; // Ensure you include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET['id']; // Ensure you send the ID from the form or URL
    $full_name = $_POST['full_name'];
    $official_email = $_POST['email_address'];
    $password = $_POST['pswd'];
    $project = $_POST['project_name'];
    $phone_number = $_POST['Phone_number'];
    $organization = $_POST['Organization_name'];
    $access_limit = $_POST['Access_Limit'];
    $enternal_user = $_POST['En_Us'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE reg SET `Full Name` = ?, `Offical_Email` = ?, `Password` = ?, `Project` = ?, `Phone_Number` = ?, `Organization` = ?, `Access_Limit` = ?, `Enternal_User` = ? WHERE ID = ?");
    $stmt->bind_param("ssssssssi", $full_name, $official_email, $password, $project, $phone_number, $organization, $access_limit, $enternal_user, $id);

    if ($stmt->execute()) {
        echo "<script>alert('This account successfully updated!');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>


<style>
.center-image{
		align-items: center;
		justify-content: center;
		display: flex;
		margin-top: 30px;
}
.col-md-4{
	background-color: white;
	border-radius: 2px;
	padding: 15px;
	padding-bottom: 50px;
	box-shadow: 0  4px rgba(0, 0, 0, 0.1);
}

</style>