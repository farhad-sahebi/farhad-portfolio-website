<?php
ob_start();
require 'conn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_password'])) {
    // Sanitize inputs
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if ($new_password === $confirm_password) {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $email = $_SESSION['reset_email'];
        $query = "UPDATE reg SET Password = '$hashed_password' WHERE Offical_Email = '$email'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo '<div class="alert alert-success text-center">Your password has been successfully updated.</div>';
            session_unset(); // Clear session variables
            session_destroy(); // Destroy session after successful update
        } else {
            echo '<div class="alert alert-danger text-center">Failed to update the password. Please try again.</div>';
        }
    } else {
        $error_message = "Passwords do not match. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="col-md-6 offset-md-3">
            <h3>Enter New Password</h3>
            <form method="POST">
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" required>
                </div>
                <button type="submit" name="update_password" class="btn btn-primary">Update Password</button>
                <?php if (isset($error_message)) { echo '<div class="alert alert-danger mt-3">' . $error_message . '</div>'; } ?>
            </form>
        </div>
    </div>
</body>
</html>
