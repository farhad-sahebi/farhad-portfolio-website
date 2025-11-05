<?php
// Start the session
session_start();

// Check if the user is logged in, if not redirect to the login page
if (!isset($_SESSION['reg']) || $_SESSION['reg'] != 'active') {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}

// Check if the user has logged out
if (isset($_GET['logout'])) {
    session_destroy(); // Destroy the session to log out
    header("Location: login.php"); // Redirect to the login page
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Monitoring Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body style="background-color: #e5e8e8;">
    <?php include 'Nav.php'; ?>

    <div class="container-fluid">
        <div class="row" style="margin-top: -40px;">
            <div class="col-md-1"></div>
            <div class="col-md-2" style="height: 100%; padding: 0 5px;">
                <!-- Filters Section -->
                <div class="mt-1"></div>
                <form id="filters" class="p-3">
                    <h3 class="mb-4">Sections</h3>

                    <!-- User Management Section -->
                    <div class="mb-3">
                        <label for="user-management-dropdown">User Section:</label>
                        <select id="user-management-dropdown" class="form-select">
                            <option value="" disabled selected>Select an option</option>
                            <option value="Reg.php">Add New User</option>
                            <option value="user_man.php">User Management</option>
                        </select>
                    </div>

                    <!-- Project Management Section -->
                    <div class="mb-3">
                        <label for="project-management-dropdown">Project Section:</label>
                        <select id="project-management-dropdown" class="form-select">
                            <option value="" disabled selected>Select an option</option>
                            <option value="add_project.php">Add New Project</option>
                            <option value="project_man.php">Project Dash Setting</option>
                        </select>
                    </div>

                    <!-- Insert Section -->
                    <div class="mb-3">
                        <label for="home-management-dropdown">Insert Section:</label>
                        <select id="home-management-dropdown" class="form-select">
                            <option value="" disabled selected>Select an option</option>
                            <option value="add_slide.php">Insert Slide in Home</option>
                            <option value="home_info.php">Insert to Home About</option>
                            <option value="home_insert_card.php">Insert Card</option>
                            <option value="insert_about.php">Insert About</option>
                            <option value="insert_Slide-Details_Visua.php">Insert Slide-Details Visua</option>
                            <option value="insert_card_visua.php">Insert Card Visua</option>
                            <option value="insert_data_analysis.php">Insert Info Data Analysis</option>
                        </select>
                    </div>

                    <!-- Settings Section -->
                    <div class="mb-3">
                        <label for="settings-dropdown">Settings Section:</label>
                        <select id="settings-dropdown" class="form-select">
                            <option value="" disabled selected>Select an option</option>
                            <option value="slide_man.php">Slides Setting</option>
                            <option value="home_info_set.php">Home Info Setting</option>
                            <option value="home_card_set.php">Home Card Setting</option>
                            <option value="about_set.php">About Setting</option>
                            <option value="Slide-Details-Visua-Setting.php">Slide-Details-Visua Setting</option>
                            <option value="Card-Visua-Visua-Setting.php">Card Visual- Setting</option>
                            <option value="Info-Data-Analysis-Setting.php">Info Data Analysis Setting</option>
                        </select>
                    </div>

                    <!-- Logout Section -->
                    <div class="mb-3">
                        <a href="Logout.php" class="btn btn-dark w-100">Log Out</a>
                    </div>
                </form>
            </div>

            <div class="col-md-8" id="main-content">
                <!-- Main Dashboard Content -->
                <div class="mt-5">
                    <h2 class="heading2 text-center">Platform Management Dashboard</h2>
                    <!-- Default content -->
                    <div id="dynamic-content"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Load default content (Reg.php) when the page loads
            $("#dynamic-content").load("Reg.php");

            // Handle dropdown change for dynamic content loading
            function handleDropdownChange(dropdownId) {
                $("#" + dropdownId).change(function () {
                    const selectedUrl = $(this).val();
                    if (selectedUrl) {
                        $("#dynamic-content").load(selectedUrl); // Load selected content dynamically
                    }
                });
            }

            // Initialize dropdowns
            handleDropdownChange("user-management-dropdown");
            handleDropdownChange("project-management-dropdown");
            handleDropdownChange("home-management-dropdown");
            handleDropdownChange("settings-dropdown");
        });
    </script>

</body>
</html>

<style>
    .form-select {
        font-size: 12px;
    }

    .mt-3, .form-label {
        color: #333;
        font-size: 17px;
    }

    .col-md-2 {
        background-color: white;
        margin-top: 50px;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .heading2 {
        padding: 7px;
        background-color: white;
        text-align: center;
        border-radius: 5px;
        font-size: 23px;
        font-family: Serif;
        color: black;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-danger {
        transition: 1s;
    }

    .btn-danger:hover {
        width: 200px;
        transition: 1s;
    }
</style>
