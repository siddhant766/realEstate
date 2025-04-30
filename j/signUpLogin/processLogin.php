<?php
// Start session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "j";

// Create connection
$conn = new mysqli($servername, $username, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

// Process login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST["password"]);
    $role = htmlspecialchars(trim($_POST["role"]));
    
    // Validate inputs
    $errors = [];
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required";
    }
    
    if (empty($role) || !in_array($role, ['buyer', 'seller'])) {
        $errors[] = "Valid role is required";
    }
    
    // If there are validation errors, redirect back
    if (!empty($errors)) {
        $errorMessage = implode(", ", $errors);
        header('Location: login.html?error=' . urlencode($errorMessage));
        exit();
    }

    // Check if user exists and verify password
    $stmt = $conn->prepare("SELECT id, name, email, password, role FROM users WHERE email = ? AND role = ?");
    if (!$stmt) {
        header('Location: login.html?error=' . urlencode('Database error'));
        exit();
    }

    $stmt->bind_param("ss", $email, $role);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Generate new session ID to prevent session fixation
            session_regenerate_id(true);
            
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            
            // Set session timeout to 30 minutes
            $_SESSION['last_activity'] = time();
            $_SESSION['expire_time'] = 30 * 60;
            
            // Redirect based on user role
            $redirectUrl = '../real-estate/index.php';
            header('Location: ' . $redirectUrl);
            exit();
        } else {
            header('Location: login.html?error=' . urlencode('Invalid email or password'));
            exit();
        }
    } else {
        header('Location: login.html?error=' . urlencode('Invalid email or password'));
        exit();
    }
    
    $stmt->close();
    $conn->close();
}
?>