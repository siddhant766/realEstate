<?php
// Database connection
$host = 'localhost';
$dbname = 'j';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h2>Admin Panel Database Setup</h2>";
    
    // 1. Create admins table
    $sql = "CREATE TABLE IF NOT EXISTS admins (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        full_name VARCHAR(255),
        role ENUM('super_admin', 'admin', 'moderator') DEFAULT 'admin',
        last_login DATETIME,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql);
    echo "✅ Admins table created successfully!<br>";
    
    // 2. Create users table (if not exists)
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('buyer', 'seller', 'admin') DEFAULT 'buyer',
        status ENUM('active', 'inactive', 'suspended') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql);
    echo "✅ Users table created successfully!<br>";
    
    // 3. Create activity_logs table
    $sql = "CREATE TABLE IF NOT EXISTS activity_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        user_type ENUM('admin', 'user') NOT NULL,
        action VARCHAR(255) NOT NULL,
        description TEXT,
        ip_address VARCHAR(45),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES admins(id) ON DELETE SET NULL
    )";
    
    $pdo->exec($sql);
    echo "✅ Activity logs table created successfully!<br>";
    
    // 4. Create settings table
    $sql = "CREATE TABLE IF NOT EXISTS settings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        setting_key VARCHAR(255) NOT NULL UNIQUE,
        setting_value TEXT,
        setting_description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql);
    echo "✅ Settings table created successfully!<br>";
    
    // 5. Insert default admin user if not exists
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->execute(['admin@example.com']);
    $admin = $stmt->fetch();
    
    if (!$admin) {
        $hashedPassword = password_hash('admin123', PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO admins (username, email, password, full_name, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(['admin', 'admin@example.com', $hashedPassword, 'Admin User', 'super_admin']);
        echo "✅ Default admin user created successfully!<br>";
    } else {
        echo "ℹ️ Admin user already exists!<br>";
    }
    
    // 6. Insert default settings
    $defaultSettings = [
        ['site_name', 'Real Estate Platform', 'The name of your website'],
        ['site_description', 'A platform for buying and selling real estate', 'Description of your website'],
        ['admin_email', 'admin@example.com', 'Email address for admin notifications'],
        ['items_per_page', '10', 'Number of items to display per page'],
        ['maintenance_mode', '0', 'Whether the site is in maintenance mode (0=off, 1=on)']
    ];
    
    foreach ($defaultSettings as $setting) {
        $stmt = $pdo->prepare("INSERT IGNORE INTO settings (setting_key, setting_value, setting_description) VALUES (?, ?, ?)");
        $stmt->execute($setting);
    }
    
    echo "✅ Default settings inserted successfully!<br>";
    
    echo "<br><strong>Setup completed successfully!</strong><br>";
    echo "<br>Admin Login Credentials:<br>";
    echo "Email: admin@example.com<br>";
    echo "Password: admin123<br>";
    echo "<br><a href='login.php' style='display:inline-block; margin-top:20px; padding:10px 20px; background:#512da8; color:white; text-decoration:none; border-radius:5px;'>Go to Admin Login</a>";
    
} catch(PDOException $e) {
    die("Error: " . $e->getMessage());
}
?> 