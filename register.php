<?php
require 'dbconnect.php';

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $age = trim($_POST['age']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];
    

    if (empty($first_name) || empty($last_name) || empty($age) || empty($username) ||
    empty($email) || empty($phone) || empty($password) || empty($confirm)) {
    $errors[] = "All fields are required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
} elseif ($password !== $confirm) {
    $errors[] = "Passwords do not match.";
} else {
    // Check for duplicate username or email
    $stmt = $conn->prepare("SELECT * FROM customer WHERE UserName = :username OR Email = :email");
    $stmt->execute(['username' => $username, 'email' => $email]);

    if ($stmt->rowCount() > 0) {
        $errors[] = "Username or email already exists.";
    } else {
        // Proceed with insertion
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $cus_id = uniqid('cus_');

        $insert = $conn->prepare("
            INSERT INTO customer (cus_id, First_Name, Last_Name, Age, UserName, Password, Email, phone_number, admin_id)
            VALUES (:cus_id, :first_name, :last_name, :age, :username, :password, :email, :phone, NULL)
        ");

        $insert->execute([
            'cus_id' => $cus_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'age' => $age,
            'username' => $username,
            'password' => $hashedPassword,
            'email' => $email,
            'phone' => $phone
        ]);

       
        $success = "Account created successfully! <a href='signing.php'>Log in here</a>.";
        header("Location: signing.php");
        exit;
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - VIBEMAKERS</title>
    <link rel="stylesheet" href="signing.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <header class="navbar-header">
                <div class="logo">VIBEMAKERS</div>
            </header>
            <button class="theme-toggle" id="themeToggle">
                <i class="fas fa-moon moon-icon"></i>
                <i class="fas fa-sun sun-icon"></i>
            </button>
        </div>
    </nav>

    <main class="main-content">
        <div class="signin-container">
            <h2 class="signin-title">Create an Account</h2>
            <p class="signin-subtitle">Register below to access VIBEMAKERS services.</p>

            <?php if (!empty($errors)): ?>
                <div class="error">
                    <?php foreach ($errors as $error): ?>
                        <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="success">
                    <p><?= $success ?></p>
                </div>
            <?php endif; ?>

            <form method="POST" action="register.php" id="signin-form">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" required>

                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" required>

                <label for="age">Age</label>
                <input type="number" name="age" min="1" required>

                <label for="username">Username</label>
                <input type="text" name="username" required>

                <label for="email">Email Address</label>
                <input type="email" name="email" required>

                <label for="phone">Phone Number</label>
                <input type="tel" name="phone" required>

                <label for="password">Password</label>
                <input type="password" name="password" required>

                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" required>

                <button type="submit">Register</button>
            </form>

           

            <footer>
                <p>By registering, you agree to our 
                    <a href="#">Terms & Conditions</a> and 
                    <a href="#">Privacy Policy</a>.
                </p>
                <p class="copyright">
                    All rights reserved.<br>
                    Copyright (2006 - 2025) - Booking.com™
                </p>
            </footer>
        </div>
    </main>

    <script>
        const themeToggle = document.getElementById('themeToggle');
        const moonIcon = document.querySelector('.moon-icon');
        const sunIcon = document.querySelector('.sun-icon');

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