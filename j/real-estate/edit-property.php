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

// Check if property ID is provided
if (!isset($_GET['id'])) {
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

// Get property details
$property_id = $_GET['id'];
$seller_id = $_SESSION['user_id'];

$sql = "SELECT * FROM properties WHERE id = ? AND seller_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $property_id, $seller_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: my-properties.php');
    exit();
}

$property = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Property - RealEstate</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="max-w-2xl mx-auto mt-20 p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Edit Property</h2>
        
        <form action="update-property.php" method="POST" enctype="multipart/form-data" class="space-y-6">
            <input type="hidden" name="property_id" value="<?php echo $property['id']; ?>">
            
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Property Title</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($property['title']); ?>" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"><?php echo htmlspecialchars($property['description']); ?></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" id="price" name="price" value="<?php echo $property['price']; ?>" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($property['location']); ?>" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
            </div>

            <div>
                <label for="property_type" class="block text-sm font-medium text-gray-700">Property Type</label>
                <select id="property_type" name="property_type" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="house" <?php echo $property['property_type'] === 'house' ? 'selected' : ''; ?>>House</option>
                    <option value="apartment" <?php echo $property['property_type'] === 'apartment' ? 'selected' : ''; ?>>Apartment</option>
                    <option value="condo" <?php echo $property['property_type'] === 'condo' ? 'selected' : ''; ?>>Condo</option>
                    <option value="land" <?php echo $property['property_type'] === 'land' ? 'selected' : ''; ?>>Land</option>
                </select>
            </div>

            <div>
                <label for="images" class="block text-sm font-medium text-gray-700">Add New Images (Optional)</label>
                <input type="file" id="images" name="images[]" multiple accept="image/*"
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>

            <div class="flex justify-end space-x-4">
                <a href="my-properties.php" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">Cancel</a>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Update Property</button>
            </div>
        </form>
    </div>
</body>
</html>