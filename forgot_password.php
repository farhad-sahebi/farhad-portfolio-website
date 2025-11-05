<?php
ob_start();
require 'conn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_email'])) {
    // Sanitize the email input
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if the email exists in the database
    $query = "SELECT * FROM reg WHERE Offical_Email = '$email'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        // Email exists, send a 6-digit code to the user
        $reset_code = rand(100000, 999999);  // Generate a random 6-digit code

        // Save the reset code in the session and email for verification
        $_SESSION['reset_code'] = $reset_code;
        $_SESSION['reset_email'] = $email;

        // Send email with the reset code
        $subject = "Password Reset Code";
        $message = "Your password reset code is: $reset_code";
        $headers = "From: no-reply@yourdomain.com";

        if (mail($email, $subject, $message, $headers)) {
            header("Location: verify_code.php");
            exit();
        } else {
            $error_message = "Failed to send the reset code. Please try again later.";
        }
    } else {
        $error_message = "This email is not registered.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="col-md-6 offset-md-3">
            <h3>Enter Your Email</h3>
            <form method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <button type="submit" name="submit_email" class="btn btn-primary">Send Reset Code</button>
                <?php if (isset($error_message)) { echo '<div class="alert alert-danger mt-3">' . $error_message . '</div>'; } ?>
            </form>
        </div>
    </div>
</body>
</html>
