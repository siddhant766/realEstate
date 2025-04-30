<?php
session_start();

// Database connection
$host = 'localhost';
$dbname = 'j';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        // Set session variables
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_email'] = $admin['email'];
        $_SESSION['admin_name'] = $admin['full_name'];
        $_SESSION['admin_role'] = $admin['role'];
        
        // Update last login time
        $updateStmt = $pdo->prepare("UPDATE admins SET last_login = NOW() WHERE id = ?");
        $updateStmt->execute([$admin['id']]);
        
        // Log the login activity
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $logStmt = $pdo->prepare("INSERT INTO activity_logs (user_id, user_type, action, description, ip_address) VALUES (?, 'admin', 'login', 'Admin logged in successfully', ?)");
        $logStmt->execute([$admin['id'], $ipAddress]);
        
        header("Location: dashboard.php");
        exit();
    } else {
        // Log failed login attempt
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $logStmt = $pdo->prepare("INSERT INTO activity_logs (user_type, action, description, ip_address) VALUES ('admin', 'login_failed', 'Failed login attempt with email: " . $email . "', ?)");
        $logStmt->execute([$ipAddress]);
        
        header("Location: login.php?error=1");
        exit();
    }
}
?> 