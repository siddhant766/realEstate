<?php
// Database connection
$host = 'localhost';
$dbname = 'j';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create admins table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS admins (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql);
    echo "Admins table created successfully!<br>";

    // Check if admin already exists
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute(['admin123@gmail.com']);
    $admin = $stmt->fetch();

    if (!$admin) {
        // Insert admin user with hashed password
        $hashedPassword = password_hash('siddhant123', PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
        $stmt->execute(['admin123@gmail.com', $hashedPassword]);
        echo "Admin user created successfully!<br>";
        echo "Email: admin123@gmail.com<br>";
        echo "Password: siddhant123<br>";
    } else {
        echo "Admin user already exists!<br>";
    }

    echo "<br><a href='login.php'>Go to Admin Login</a>";

} catch(PDOException $e) {
    die("Error: " . $e->getMessage());
}
?> 