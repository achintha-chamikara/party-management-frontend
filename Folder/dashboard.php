<?php
// dashboard.php
session_start();

// Ensure the user is logged in for accessing the dashboard
if (!isset($_SESSION['user'])) {
    header('Location: signin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Dashboard - VIBEMAKERS</title>
        <link rel="stylesheet" href="dashboard.css">
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    </head>
    <body>
        <nav>
            <div class="navbar">
                <div class="left-section">
                    <div class="logo">
                        <a href="#">VIBEMAKERS</a>
                    </div>
                </div>
                <ul class="nav-links">
                    <li><a href="abouts.html">About Us</a></li>
                    <li><a href="#">Event</a></li>
                    <li><a href="#">Packages</a></li>
                    <li><a href="#">Bookings</a></li>
                    <li><a href="#">Hotels</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
                <div class="right-section">
                    <div class="search-box">
                        <form>  
                            <input type="text" placeholder="Search...">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <button class="theme-toggle">
                        <i class='bx bx-moon moon-icon'></i>
                        <i class='bx bx-sun sun-icon'></i>
                    </button>
                    <button class="signin-btn" onclick="window.location.href='signing.php'">
                         SignIn
                    </button>
                    <button class="register-btn" onclick="window.location.href='register.php'">
                        Register
                    </button>
                </div>
            </div>
        </nav>
        
        <div class="image-container">
            <img src="Backend/images/party.jpg" alt="Centered Image" width="500">
            <div class="image-text">Welcome to VIBEMAKERS</div>
            <div class="image-text2">Crafting the perfect party atmosphere</div>
        </div>
        <button class="admin-login-btn" onclick="window.location.href='adminsignin.php'">
            Admin Login
        </button>
        

        <script src="script.js"></script>
    </body>
</html>
