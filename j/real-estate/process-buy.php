<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['property_id'])) {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "j";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create purchases table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS purchases (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        property_id INT NOT NULL,
        purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id),
        FOREIGN KEY (property_id) REFERENCES properties(id)
    )";

    if (!$conn->query($sql)) {
        die("Error creating table: " . $conn->error);
    }

    // Get property details
    $property_id = intval($_POST['property_id']);
    $user_id = $_SESSION['user_id'];

    // Check if property is already purchased
    $check_sql = "SELECT * FROM purchases WHERE user_id = ? AND property_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ii", $user_id, $property_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo "<script>alert('You have already purchased this property!');</script>";
        echo "<script>window.location.href = 'properties.php';</script>";
        exit();
    }

    // Insert purchase record
    $stmt = $conn->prepare("INSERT INTO purchases (user_id, property_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $property_id);

    if ($stmt->execute()) {
        echo "<script>alert('Property purchased successfully!');</script>";
        echo "<script>window.location.href = 'my-properties.php';</script>";
    } else {
        echo "<script>alert('Error purchasing property: " . $stmt->error . "');</script>";
        echo "<script>window.location.href = 'properties.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: properties.php');
    exit();
}
?> 