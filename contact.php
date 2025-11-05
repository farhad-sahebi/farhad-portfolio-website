<?php
include 'Nav.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect data from the form
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    $to = "farhadsahebi2244@gmail.com"; // Your email address
    $subject = "New Contact Form Submission";

    // Email headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Email content
    $body = "You have received a new message from your contact form.\n\n";
    $body .= "Name: $name\n";
    $body .= "Email: $email\n\n";
    $body .= "Message:\n$message\n";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        $successMessage = '<div class="alert alert-success mt-4 text-center">Thank you! Your message has been sent successfully.</div>';
    } else {
        $errorMessage = '<div class="alert alert-danger mt-4 text-center">Sorry, there was an issue sending your message. Please try again later.</div>';
    }
}
ini_set('display_errors', 1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Me</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body style="background-color: #e5e8e8;">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" style="box-shadow:0 6px 8px rgba(0, 0, 0, 0.1); background-color: white;  border-radius: 10px;">
                <h1 class="text-center" style="margin-top:20px;">Contact Me</h1>
                <p class="text-center">Feel free to send me a message using the form below.</p>
                
                <?php if (isset($successMessage)) { echo $successMessage; } ?>
                <?php if (isset($errorMessage)) { echo $errorMessage; } ?>

                <form action="contact.php" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Your Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Write your message here" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="margin-bottom: 20px;">Send Message</button>
                    </div>
                </form>

                <footer class="footer" style="justify-content: center; text-align: center; border-radius: 10px; margin-bottom: 20px;">
                    <div class="footer-container">
                        <!-- Contact Section -->
                        <div class="footer-contact">
                            <h3>Contact</h3>
                            <p>Email: <a href="mailto:farhadsahebi2244@gmail.com">farhadsahebi2244@gmail.com</a></p>
                            <p>Phone: <a href="tel:+0788971748">0788971748</a></p>
                            <div class="footer-social">
                                <a href="https://www.linkedin.com/in/farhad-sahebi-ab20b2241?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app" target="_blank"><i class="fab fa-linkedin"></i></a>
                                <a href="https://github.com/farhad-sahebi" target="_blank"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Bottom -->
                    <div class="footer-bottom">
                        <p>© 2025 Farhad Sahebi. All Rights Reserved.</p>
                    </div>
                </footer>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>

<style>
    .footer-about P{
        color: #5d6d7e;
        transition: 1s;
    }
    .footer-about P:hover{
        color: white;
        transition: 1s;
    }
    .mb-3{
        margin-left: 30px;
        margin-right: 30px;
    }
    .footer {
        background-color: #1a1a1a;
        color: #f0f0f0;
        font-family: 'Arial', sans-serif;
        padding: 40px 20px;
    }

    .footer-container {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        max-width: 1200px;
        margin: 0 auto;
    }

    .footer-about, .footer-links, .footer-contact {
        flex: 1;
        margin: 0 20px;
        min-width: 200px;
    }

    .footer h3 {
        font-size: 1.2rem;
        color: White;
        margin-bottom: 15px;
    }

    .footer p, .footer ul {
        margin: 0;
        line-height: 1.6;
    }

    .footer ul {
        list-style: none;
        padding: 0;
    }

    .footer ul li {
        margin: 8px 0;
    }

    .footer ul li a {
        text-decoration: none;
        color: #5d6d7e;
        transition: color 0.3s;
    }

    .footer ul li a:hover {
        color: #f4f6f7;
    }

    .footer-contact a {
        text-decoration: none;
        color: #bdc3c7;
        transition: 1s;
    }

    .footer-contact a:hover {
        color: white;
        transition: 1s;
    }

    .footer-social {
        margin-top: 15px;
    }

    .footer-social a {
        margin: 0 10px;
        font-size: 1.5rem;
        color: #bdc3c7;
        transition: color 0.3s;
    }

    .footer-social a:hover {
        color: white;
    }

    .footer-bottom {
        margin-top: 20px;
        text-align: center;
        border-top: 1px solid #333;
        padding-top: 15px;
        font-size: 0.9rem;
        color: #aaa;
    }
</style>
