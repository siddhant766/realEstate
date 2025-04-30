<?php
session_start();

// Check if user is logged in and is a seller
$isLoggedIn = isset($_SESSION['user_id']);
$isSeller = isset($_SESSION['role']) && $_SESSION['role'] === 'seller';

// Redirect if not logged in or not a seller
if (!$isLoggedIn || !$isSeller) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: my-properties.php');
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

// Get property ID and seller ID
$property_id = $_POST['property_id'];
$seller_id = $_SESSION['user_id'];

// Verify property belongs to seller
$check_sql = "SELECT images FROM properties WHERE id = ? AND seller_id = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("ii", $property_id, $seller_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows === 0) {
    header('Location: my-properties.php?error=Property not found');
    exit();
}

$property = $check_result->fetch_assoc();
$existing_images = explode(',', $property['images']);

// Process form data
$title = htmlspecialchars(trim($_POST['title']));
$description = htmlspecialchars(trim($_POST['description']));
$price = floatval($_POST['price']);
$location = htmlspecialchars(trim($_POST['location']));
$property_type = htmlspecialchars(trim($_POST['property_type']));

// Handle new image uploads
$uploadedImages = [];
if (!empty($_FILES['images']['name'][0])) {
    $uploadDir = 'uploads/properties/';
    
    // Create upload directory if it doesn't exist
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        $file_name = $_FILES['images']['name'][$key];
        $file_size = $_FILES['images']['size'][$key];
        $file_tmp = $_FILES['images']['tmp_name'][$key];
        $file_type = $_FILES['images']['type'][$key];
        
        // Generate unique filename
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $unique_file = uniqid() . '.' . $file_ext;
        $upload_path = $uploadDir . $unique_file;
        
        // Move uploaded file
        if (move_uploaded_file($file_tmp, $upload_path)) {
            $uploadedImages[] = $upload_path;
        }
    }
}

// Combine existing and new images
$all_images = array_merge($existing_images, $uploadedImages);
$images_string = implode(',', $all_images);

// Update property in database
$update_sql = "UPDATE properties SET title = ?, description = ?, price = ?, location = ?, property_type = ?, images = ? WHERE id = ? AND seller_id = ?";
$update_stmt = $conn->prepare($update_sql);
$update_stmt->bind_param("ssdsssii", $title, $description, $price, $location, $property_type, $images_string, $property_id, $seller_id);

if ($update_stmt->execute()) {
    header('Location: my-properties.php?message=Property updated successfully');
    exit();
} else {
    header('Location: edit-property.php?id=' . $property_id . '&error=Failed to update property');
    exit();
}

$conn->close();
?>