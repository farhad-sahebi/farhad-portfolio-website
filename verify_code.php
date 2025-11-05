<?php
ob_start();
require 'conn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verify_code'])) {
    // Sanitize the code input
    $entered_code = mysqli_real_escape_string($conn, $_POST['code']);
    
    // Check if the entered code matches the session code
    if ($entered_code == $_SESSION['reset_code']) {
        // Proceed to the next page to update the password
        header("Location: reset_password.php");
        exit();
    } else {
        $error_message = "The code entered is incorrect. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify Code</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="col-md-6 offset-md-3">
            <h3>Enter the Reset Code</h3>
            <form method="POST">
                <div class="form-group">
                    <label for="code">Reset Code</label>
                    <input type="text" name="code" class="form-control" required>
                </div>
                <button type="submit" name="verify_code" class="btn btn-primary">Verify Code</button>
                <?php if (isset($error_message)) { echo '<div class="alert alert-danger mt-3">' . $error_message . '</div>'; } ?>
            </form>
        </div>
    </div>
</body>
</html>
