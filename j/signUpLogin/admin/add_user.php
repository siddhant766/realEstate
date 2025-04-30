<?php
session_start();
if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = 'localhost';
    $dbname = 'j';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Validate input
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $role = $_POST['role'];
        $status = $_POST['status'];

        if (empty($name) || empty($email) || empty($password)) {
            throw new Exception("All fields are required");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }

        // Check if email already exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetchColumn() > 0) {
            throw new Exception("Email already exists");
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role, status, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$name, $email, $hashedPassword, $role, $status]);

        // Log activity
        $stmt = $pdo->prepare("INSERT INTO activity_logs (user_id, user_type, action, description, ip_address, created_at) VALUES (?, 'admin', 'create_user', ?, ?, NOW())");
        $stmt->execute([$_SESSION['admin_id'], "Created new user: $email", $_SERVER['REMOTE_ADDR']]);

        $message = "User created successfully!";
        
        // Redirect after successful creation
        header("refresh:2;url=users.php");

    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User - Admin Panel</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Montserrat', sans-serif;
        }
        .admin-dashboard {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 20px;
            background: linear-gradient(to right, #5c6bc0, #512da8);
            color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .admin-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .admin-nav {
            display: flex;
            gap: 20px;
        }
        .admin-nav a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .admin-nav a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        .logout-btn {
            background: #ff4081;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .logout-btn:hover {
            background: #f50057;
        }
        .content-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .content-card h2 {
            color: #512da8;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: 500;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #512da8;
        }
        .password-container {
            position: relative;
            width: 100%;
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #666;
            padding: 5px;
        }
        .password-toggle:hover {
            color: #512da8;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background: linear-gradient(to right, #5c6bc0, #512da8);
            color: white;
        }
        .btn-primary:hover {
            background: linear-gradient(to right, #512da8, #5c6bc0);
            transform: translateY(-2px);
        }
        .btn-secondary {
            background: #f5f5f5;
            color: #333;
            text-decoration: none;
        }
        .btn-secondary:hover {
            background: #e0e0e0;
        }
        .message {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .message.success {
            background-color: #4caf50;
            color: white;
        }
        .message.error {
            background-color: #f44336;
            color: white;
        }
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="admin-dashboard">
        <div class="admin-header">
            <h1>Add New User</h1>
            <div class="admin-nav">
                <a href="dashboard.php">Dashboard</a>
                <a href="users.php">Manage Users</a>
                <a href="admins.php">Manage Admins</a>
                <a href="settings.php">Settings</a>
                <a href="activity.php">Activity Logs</a>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>
        
        <div class="content-card">
            <h2>Create New User</h2>
            
            <?php if ($message): ?>
            <div class="message success"><?php echo $message; ?></div>
            <?php endif; ?>
            
            <?php if ($error): ?>
            <div class="message error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-container">
                        <input type="password" id="password" name="password" required>
                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                            👁️
                        </button>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="suspended">Suspended</option>
                    </select>
                </div>
                
                <div class="button-group">
                    <button type="submit" class="btn btn-primary">Create User</button>
                    <a href="users.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const toggleButton = passwordInput.nextElementSibling;
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.textContent = '👁️‍🗨️';
            } else {
                passwordInput.type = 'password';
                toggleButton.textContent = '👁️';
            }
        }
    </script>
</body>
</html> 