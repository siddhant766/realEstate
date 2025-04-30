<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Check if property ID is provided
if (!isset($_GET['id'])) {
    header('Location: my-properties.php?error=No property ID provided');
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "j";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get property ID and user ID
$property_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Delete the purchase record
$sql = "DELETE FROM purchases WHERE property_id = ? AND user_id = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $property_id, $user_id);

if ($stmt->execute() && $stmt->affected_rows > 0) {
    header('Location: my-properties.php?message=Property removed from your list successfully');
} else {
    header('Location: my-properties.php?error=Failed to remove property from your list');
}

$conn->close();
?>