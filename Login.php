<?php 
ob_start();
require 'conn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['regg'])) {
    // Sanitize user input
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['pwd']);

    // Query to check user credentials
    $query = "SELECT * FROM reg WHERE Offical_Email = '$email'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Database query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // Check if password matches (use password_verify if password is hashed)
        if ($password === $user['Password']) {  // Replace with password_verify() if passwords are hashed
            $_SESSION['reg'] = 'active';
            header("Location: Platform_Managment.php");
            exit();
        } else {
            $error_message = "Email or password is incorrect.";
        }
    } else {
        $error_message = "Email or password is incorrect.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body style="background-color: #e5e8e8;">   
    <form method="post" action="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 form-container">
                <div class="mt-3">
                <div class="center-image">
                    <img src="Pictures/Logo.png" alt="Image" style="max-width: 100%; height: 40px;">
                </div>
                <?php 
                // Show error message if login fails
                if (isset($error_message)) {
                    echo '<div class="alert alert-danger text-center" role="alert">' . $error_message . '</div>';
                }
                ?>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input type="text" name="email" placeholder="Enter Your Email" class="form-control" required>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" name="pwd" placeholder="Enter Your password" class="form-control" required>
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-eye" id="toggle-password"></i></span>
                    </div>
                </div>
                <script>
                document.getElementById('toggle-password').addEventListener('click', function () {
                    const passwordField = document.querySelector('input[name="pwd"]');
                    const type = passwordField.type === 'password' ? 'text' : 'password';
                    passwordField.type = type;
                    this.classList.toggle('fa-eye-slash');
                });
                </script>
                <div class="input-group">
                    <button type="submit" name="regg" class="btn btn-primary btn-sm btn-block">Login</button>
                </div>
                <p>For any issue with signing in, please contact <a href="mailto:farhadsahebi2244@gmail.com">farhadsahebi2244@gmail.</a> And if you forgot your password, <a href="forgot_password.php">click here.</a></p>
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
    P {
        font-size: 11px;
        margin-top: 10px;
    }
    .center-image {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .input-group {
        margin-top: 20px;
    }
    .form-container {
        background-color: white;
        margin-top: 110px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 20px;
    }
    .input-group .input-group-text {
        background-color: #fff;
        border: 1px solid #ccc;
    }
    .input-group .form-control {
        border-left: none;
    }
    .input-group .input-group-append .input-group-text {
        cursor: pointer;
    }
</style>
