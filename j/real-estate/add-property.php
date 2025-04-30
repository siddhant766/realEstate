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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Property - RealEstate</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex space-x-4">
                    <a href="index.php" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600">Home</a>
                    <a href="my-properties.php" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600">List Properties</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Add New Property</h2>
        
        <form action="process-property.php" method="POST" enctype="multipart/form-data" class="space-y-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Property Title</label>
                <input type="text" id="title" name="title" required
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4" required
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" id="price" name="price" required
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" id="location" name="location" required
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
            </div>

            <div>
                <label for="property_type" class="block text-sm font-medium text-gray-700">Property Type</label>
                <select id="property_type" name="property_type" required
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="house">Houses</option>
                    <option value="apartment">Apartments</option>
                    <option value="villa">Villas</option>
                </select>
            </div>

            <div>
                <label for="images" class="block text-sm font-medium text-gray-700">Property Images</label>
                <input type="file" id="images" name="images[]" multiple accept="image/*" required
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>

            <div class="flex justify-end space-x-4">
                <a href="index.php" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">Cancel</a>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Add Property</button>
            </div>
        </form>
    </div>
</body>
</html>