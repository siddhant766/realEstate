<?php
session_start();

// Check if user is logged in and is a seller
$isLoggedIn = isset($_SESSION['user_id']);
$isSeller = isset($_SESSION['role']) && $_SESSION['role'] === 'seller';

if (!$isLoggedIn || !$isSeller) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "j";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create properties table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS properties (
        id INT AUTO_INCREMENT PRIMARY KEY,
        seller_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        location VARCHAR(255) NOT NULL,
        property_type VARCHAR(50) NOT NULL,
        images TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (seller_id) REFERENCES users(id)
    )";

    if (!$conn->query($sql)) {
        die("Error creating table: " . $conn->error);
    }

    // Process form data
    $seller_id = $_SESSION['user_id'];
    $title = htmlspecialchars(trim($_POST['title']));
    $description = htmlspecialchars(trim($_POST['description']));
    $price = floatval($_POST['price']);
    $location = htmlspecialchars(trim($_POST['location']));
    $property_type = htmlspecialchars(trim($_POST['property_type']));

    // Handle image uploads
    $uploadedImages = [];
    $uploadDir = 'uploads/properties/';

    // Create upload directory if it doesn't exist
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (isset($_FILES['images'])) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES['images']['name'][$key];
            $file_size = $_FILES['images']['size'][$key];
            $file_tmp = $_FILES['images']['tmp_name'][$key];
            $file_type = $_FILES['images']['type'][$key];

            // Generate unique filename
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $unique_file_name = uniqid() . '.' . $file_ext;
            $target_file = $uploadDir . $unique_file_name;

            // Move uploaded file
            if (move_uploaded_file($file_tmp, $target_file)) {
                $uploadedImages[] = $target_file;
            }
        }
    }

    // Convert image paths array to JSON string
    $images_json = json_encode($uploadedImages);

    // Insert property data into database
    $stmt = $conn->prepare("INSERT INTO properties (seller_id, title, description, price, location, property_type, images) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issdsss", $seller_id, $title, $description, $price, $location, $property_type, $images_json);

    if ($stmt->execute()) {
        echo "<script>alert('Property added successfully!');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Error adding property: " . $stmt->error . "');</script>";
        echo "<script>window.location.href = 'add-property.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>