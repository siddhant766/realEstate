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
    
    // Get users with pagination
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = 10;
    $offset = ($page - 1) * $limit;
    
    $stmt = $pdo->prepare("SELECT * FROM users ORDER BY created_at DESC LIMIT ? OFFSET ?");
    $stmt->bindValue(1, $limit, PDO::PARAM_INT);
    $stmt->bindValue(2, $offset, PDO::PARAM_INT);
    $stmt->execute();
    $users = $stmt->fetchAll();
    
    // Get total users count for pagination
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    $totalUsers = $stmt->fetchColumn();
    $totalPages = ceil($totalUsers / $limit);
    
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Admin Panel</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        th {
            background-color: #f9f9f9;
            font-weight: 600;
            color: #333;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .status-active {
            color: #4caf50;
            font-weight: 600;
        }
        .status-inactive {
            color: #f44336;
            font-weight: 600;
        }
        .status-suspended {
            color: #ff9800;
            font-weight: 600;
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination a {
            color: #512da8;
            text-decoration: none;
            padding: 8px 12px;
            margin: 0 5px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .pagination a:hover {
            background-color: #f0f0f0;
        }
        .pagination .active {
            background-color: #512da8;
            color: white;
        }
        .action-btn {
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            margin-right: 5px;
        }
        .edit-btn {
            background-color: #2196f3;
            color: white;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
        }
        .add-user-btn {
            display: inline-block;
            background: linear-gradient(to right, #5c6bc0, #512da8);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        .add-user-btn:hover {
            background: linear-gradient(to right, #512da8, #5c6bc0);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="admin-dashboard">
        <div class="admin-header">
            <h1>Manage Users</h1>
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
            <h2>User Management</h2>
            <a href="add_user.php" class="add-user-btn">Add New User</a>
            
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo ucfirst($user['role']); ?></td>
                        <td>
                            <span class="status-<?php echo $user['status']; ?>">
                                <?php echo ucfirst($user['status']); ?>
                            </span>
                        </td>
                        <td><?php echo date('M d, Y', strtotime($user['created_at'])); ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="action-btn edit-btn">Edit</a>
                            <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <?php if ($totalPages > 1): ?>
            <div class="pagination">
                <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>">Previous</a>
                <?php endif; ?>
                
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" class="<?php echo $i == $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
                
                <?php if ($page < $totalPages): ?>
                <a href="?page=<?php echo $page + 1; ?>">Next</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html> 