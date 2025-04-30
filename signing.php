<?php
session_start();
require 'dbconnect.php';

$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $errors[] = "Please enter both username and password.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM customer WHERE UserName = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['Password'])) {
            $_SESSION['user'] = $user['UserName'];
            $success = true;
            echo "<script>
                alert('Welcome, " . htmlspecialchars($user['UserName']) . "!');
                setTimeout(function() {
                    window.location.href = 'dashboard.php';
                }, 1500);
            </script>";
            exit;
        } else {
            $errors[] = "Invalid username or password.";
        }
    }
}
?>

<?php
// Optional error handler
$errors = []; // Example error list
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - VIBEMAKERS</title>

    <!-- External Styles -->
    <link rel="stylesheet" href="signing.css">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <header class="navbar-header">
                <div class="logo">VIBEMAKERS</div>
                
            </header>
            <!-- Theme Toggle Button -->
            <button class="theme-toggle" id="themeToggle">
                <i class="fas fa-moon moon-icon"></i>
                <i class="fas fa-sun sun-icon"></i>
            </button>
        </div>
    </nav>

    <main class="main-content">
        <div class="signin-container">
            <h2 class="signin-title">Sign in or create an account</h2>
            <p class="signin-subtitle">You can sign in using your VIBEMAKERS account to access our services.</p>

            <!-- PHP Error Block -->
            <?php if (!empty($errors)): ?>
                <div class="error">
                    <?php foreach ($errors as $error): ?>
                        <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Sign-in Form -->
            <form id="signin-form" action="signin.php" method="POST">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email address" required>

                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter password" required>

                <button type="submit">Continue</button>
            </form>
            <p class="register-link">Don't have an account? <a href="register.php">Register here</a></p>
            

            <!-- Footer -->
            <footer>
                <p>By signing in or creating an account, you agree with our 
                    <a href="#">Terms & conditions</a> and 
                    <a href="#">Privacy statement</a>.
                </p>
                <p class="copyright">
                    All rights reserved.<br>
                    Copyright (2006 - 2025) - Booking.com™
                </p>
            </footer>
        </div>
    </main>

    <!-- JavaScript for Theme Toggle -->
    <script>
        const themeToggle = document.getElementById('themeToggle');
        const moonIcon = document.querySelector('.moon-icon');
        const sunIcon = document.querySelector('.sun-icon');

        // Load theme preference
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
            moonIcon.style.display = 'none';
            sunIcon.style.display = 'inline-block';
        } else {
            sunIcon.style.display = 'none';
        }

        themeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            const isDark = document.body.classList.contains('dark-mode');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            moonIcon.style.display = isDark ? 'none' : 'inline-block';
            sunIcon.style.display = isDark ? 'inline-block' : 'none';
        });
    </script>
</body>
</html>

