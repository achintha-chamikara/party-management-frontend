<?php
require '../Include/dbconnection.php';

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = trim($_POST['First_Name']);
    $last_name = trim($_POST['Last_Name']);
    $username = trim($_POST['UserName']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];
    

    if (empty($first_name) || empty($last_name) || empty($username) ||
     empty($password) || empty($confirm)) {
    $errors[] = "All fields are required.";
} elseif ($password !== $confirm) {
    $errors[] = "Passwords do not match.";
} else {
    // Check for duplicate username or email
    $stmt = $conn->prepare("SELECT * FROM admin WHERE UserName = ? ");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $errors[] = "Username already exists.";
    } else {
        // Proceed with insertion
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $admin_id = uniqid('admin_id');


        $insert = $conn->prepare("
            INSERT INTO admin (admin_id, First_Name, Last_Name, UserName, Password)
            VALUES (?, ?, ?, ?, ?)
        ");
        $insert->bind_param(
            "issss",
            $admin_id,
            $first_name,
            $last_name,
            $username,
            $hashedPassword,
            
        );

        if ($insert->execute()) {
            $success = "Account created successfully!.";
            header("Location: admindashboard.php");
            exit;
        } else {
            $errors[] = "Error inserting data: " . $insert->error;
        }
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Admin</title>
    <<style>
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
        <h2>Admin Register</h2>
    <main class="main-content">
        <div class="signin-container">
            <h2 class="signin-title">Create an Account</h2>

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

            <form method="POST" action="registeradmin.php" id="signin-form">
            <div class="input-group">
                <label for="First_Name">First Name</label>
                <input type="text" name="First_Name" required>
            </div>
            <div class="input-group">
                <label for="Last_Name">Last Name</label>
                <input type="text" name="Last_Name" required>
                </div>
            <div class="input-group">   
                <label for="UserName">Username</label>
                <input type="text" name="UserName" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" required>
            </div>
                <div class="input-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" required>
            </div>
            <div class="input-group"> 
                <button type="submit">Register</button>
                </div>
                <?php if (!empty($errors)): ?>
                <div class="error-message">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            </form>

           
            
        </div>
    </main>
    <?php
        include 'back.php'
        ?>
    
</body>
</html>