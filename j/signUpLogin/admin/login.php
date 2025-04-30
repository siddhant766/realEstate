<?php
session_start();
if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .admin-login-container {
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            padding: 40px;
            width: 400px;
            max-width: 100%;
            margin: 50px auto;
        }
        .admin-login-container h1 {
            color: #512da8;
            margin-bottom: 30px;
            text-align: center;
        }
        .admin-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .admin-form input {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            font-size: 14px;
            border-radius: 8px;
            width: 100%;
            outline: none;
        }
        .admin-form button {
            background: linear-gradient(to right, #5c6bc0, #512da8);
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .admin-form button:hover {
            background: linear-gradient(to right, #512da8, #5c6bc0);
            transform: translateY(-2px);
        }
        .back-to-site {
            text-align: center;
            margin-top: 20px;
        }
        .back-to-site a {
            color: #512da8;
            text-decoration: none;
            font-size: 14px;
        }
        .back-to-site a:hover {
            text-decoration: underline;
        }
        .error-message {
            color: #ff4081;
            text-align: center;
            margin-bottom: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="admin-login-container">
        <h1>Admin Login</h1>
        <?php if(isset($_GET['error'])): ?>
            <div class="error-message">Invalid email or password</div>
        <?php endif; ?>
        <form action="process_admin_login.php" method="POST" class="admin-form">
            <input type="email" name="email" placeholder="Admin Email" required>
            <input type="password" name="password" placeholder="Admin Password" required>
            <button type="submit">Login to Admin Panel</button>
        </form>
        <div class="back-to-site">
            <a href="../login.html">← Back to Main Site</a>
        </div>
    </div>
</body>
</html> 