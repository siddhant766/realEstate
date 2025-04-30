<?php
session_start();
if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Database connection
$host = 'localhost';
$dbname = 'j';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get total users count
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    $totalUsers = $stmt->fetchColumn();
    
    // Get total admins count
    $stmt = $pdo->query("SELECT COUNT(*) FROM admins");
    $totalAdmins = $stmt->fetchColumn();
    
    // Get recent activity logs
    $stmt = $pdo->query("SELECT * FROM activity_logs ORDER BY created_at DESC LIMIT 5");
    $recentActivities = $stmt->fetchAll();
    
    // Get site settings
    $stmt = $pdo->query("SELECT * FROM settings");
    $settings = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Montserrat', sans-serif;
        }
        .admin-dashboard {
            padding: 20px;
            max-width: 1200px;
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
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .dashboard-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .dashboard-card h2 {
            color: #512da8;
            margin-bottom: 15px;
            font-size: 18px;
        }
        .dashboard-card p {
            color: #666;
            margin-bottom: 10px;
        }
        .dashboard-card .count {
            font-size: 36px;
            font-weight: bold;
            color: #512da8;
            margin: 10px 0;
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
        .activity-list {
            list-style: none;
            padding: 0;
        }
        .activity-list li {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .activity-list li:last-child {
            border-bottom: none;
        }
        .activity-time {
            font-size: 12px;
            color: #999;
        }
        .welcome-message {
            margin-bottom: 20px;
            padding: 15px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .welcome-message h2 {
            color: #512da8;
            margin-bottom: 10px;
        }
        .welcome-message p {
            color: #666;
        }
    </style>
</head>
<body>
    <div class="admin-dashboard">
        <div class="admin-header">
            <h1>Admin Dashboard</h1>
            <div class="admin-nav">
                <a href="dashboard.php">Dashboard</a>
                <a href="users.php">Manage Users</a>
                <a href="admins.php">Manage Admins</a>
                <a href="settings.php">Settings</a>
                <a href="activity.php">Activity Logs</a>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>
        
        <div class="welcome-message">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['admin_name']); ?>!</h2>
            <p>You are logged in as a <?php echo htmlspecialchars($_SESSION['admin_role']); ?>.</p>
        </div>
        
        <div class="dashboard-grid">
            <div class="dashboard-card">
                <h2>Total Users</h2>
                <div class="count"><?php echo $totalUsers; ?></div>
                <p>Registered users on the platform</p>
                <a href="users.php">View Users →</a>
            </div>
            <div class="dashboard-card">
                <h2>Total Admins</h2>
                <div class="count"><?php echo $totalAdmins; ?></div>
                <p>Administrators with access to this panel</p>
                <a href="admins.php">Manage Admins →</a>
            </div>
            <div class="dashboard-card">
                <h2>Site Settings</h2>
                <p>Site Name: <?php echo htmlspecialchars($settings['site_name'] ?? 'Not set'); ?></p>
                <p>Maintenance Mode: <?php echo ($settings['maintenance_mode'] ?? '0') == '1' ? 'On' : 'Off'; ?></p>
                <a href="settings.php">Manage Settings →</a>
            </div>
        </div>
        
        <div class="dashboard-card" style="margin-top: 20px;">
            <h2>Recent Activity</h2>
            <ul class="activity-list">
                <?php foreach ($recentActivities as $activity): ?>
                <li>
                    <strong><?php echo htmlspecialchars($activity['action']); ?></strong>
                    <p><?php echo htmlspecialchars($activity['description']); ?></p>
                    <span class="activity-time"><?php echo date('M d, Y H:i', strtotime($activity['created_at'])); ?></span>
                </li>
                <?php endforeach; ?>
            </ul>
            <a href="activity.php">View All Activity →</a>
        </div>
    </div>
</body>
</html> 