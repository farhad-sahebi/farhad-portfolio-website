<?php
session_start();
if (!isset($_SESSION['reg'])) {
    header("Location: login.php"); // Redirect to login page if session is not active
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Email_Verification_Page</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
</head>
<body style="background-color: #e5e8e8;">	
	<form method="post" action="">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4 form-container">
				<div class="mt-3">
				<div class="center-image">
    			<img src="Pictures/logo.png" alt="Image" style="max-width: 100%; height: 40px;">
				</div>
				<div class="input-group">
					<input type="tex" name="emai-ver" placeholder="Enter the code" class="form-control">
				</span>
				<div class="input-group">
						<button type="button" class="btn btn-primary btn-sm btn-block">Submit Your Request</button>
					</div>
					<p> We send an email to your official email address with a code please write it in the above text box and in case of any issue please contact <a href="mailto:farhad.sahebi@atr-consulting.com">farhad.sahebi@atr-consulting.com</a></p>
				</div>
				</div>	
			</div>
			<div class="col-md-4"></div>	
		</div>
	</div>
</form>
</body>
</html>
<style>
	P{
	font-size: 11px;
	margin-top: 10px;
	}
	.center-image {
    display: flex;
    justify-content: center;
    align-items: center;
}
.input-group{
	margin-top: 20px;
}
.form-container{
		background-color: white;
		margin-top: 110px;
		box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
		border-radius: 10px;
		height: 300px;
	}
</style>