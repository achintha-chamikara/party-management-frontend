<?php
session_start();
require '../Include/dbconnection.php'; // this should be your database connection file

$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $errors[] = "Please enter both Admin ID and Password.";
    } else {
        // Use named placeholders for safety and clarity
        $stmt = $conn->prepare("SELECT * FROM admin WHERE UserName = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $admin = $result->fetch_assoc();

         // Verify user and password
         if ($admin && password_verify($password, $admin['Password'])) {
            $_SESSION['admin'] = $admin['UserName'];
            header("Location: /party-management-frontend/Backend/admindashboard.php");
            exit;
        } else {
            $errors[] = "Invalid username or password.";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Sign-In</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #1e1e2f;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(0,0,0,0.6);
            width: 100%;
            max-width: 400px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            outline: none;
            background-color: #2e2e3e;
            color: #fff;
        }

        .input-group button {
            width: 100%;
            padding: 12px;
            background-color: #00c9a7;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .input-group button:hover {
            background-color: #00a68f;
        }

        .error-message {
            margin-top: 10px;
            background-color: #ff4f4f;
            padding: 10px;
            border-radius: 8px;
            color: white;
            text-align: center;
        }

        .error-message p {
            margin: 0;
        }
    </style>
    <script>
       
        window.onload = function() {
            document.getElementById('admin_id').focus();
        };
    </script>
</head>
<body>

    <div class="login-container">
        <h2>Admin Login</h2>
        <form action="adminsignin.php" method="POST">
            <div class="input-group">
            <label for="username">Username</label>
                <input type="text" id="UserName" name="username"  required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password"  id="Password" name="password" required>
            </div>
            <div class="input-group">
                <button type="submit">Sign In</button>
            </div>
            <?php if (!empty($errors)): ?>
                <div class="error-message">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </form>

        <?php
        include '../Backend/back.php'
        ?>
    </div>
    
    
</body>
</html>