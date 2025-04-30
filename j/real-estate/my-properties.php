<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$userName = $_SESSION['user_name'];
$userEmail = $_SESSION['user_email'];
$userInitial = strtoupper(substr($_SESSION['user_name'], 0, 1));

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "j";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user's purchased properties
$user_id = $_SESSION['user_id'];
$sql = "SELECT p.*, pu.purchase_date 
        FROM properties p 
        JOIN purchases pu ON p.id = pu.property_id 
        WHERE pu.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Properties - Premium Real Estate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#1E40AF',
                            light: '#3B82F6',
                            dark: '#1E3A8A',
                        },
                        secondary: {
                            DEFAULT: '#10B981',
                            light: '#34D399',
                            dark: '#059669',
                        },
                    }
                }
            }
        }
    </script>
    <?php include 'includes/animations.php'; ?>
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg animate-fade-in">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="index.php" class="text-xl font-bold text-primary hover-scale">Premium Real Estate</a>
                </div>
                <div class="flex items-center">
                    <span class="mr-4">Welcome, <?php echo htmlspecialchars($userName); ?></span>
                    <a href="logout.php" class="text-primary hover:text-primary-dark hover-lift">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8 scroll-animate" data-animation="animate-fade-in">My Properties</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if ($result->num_rows > 0): 
                $delay = 0;
                while($property = $result->fetch_assoc()): 
                    $delay += 100;
                    $delayClass = "delay-" . $delay;
            ?>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden scroll-animate hover-lift hover-card" data-animation="animate-fade-in" data-delay="<?php echo $delayClass; ?>">
                        <?php 
                        $images = json_decode($property['images'], true);
                        $firstImage = !empty($images) ? $images[0] : 'uploads/default-property.jpg';
                        ?>
                        <div class="overflow-hidden">
                            <img src="<?php echo htmlspecialchars($firstImage); ?>" 
                                alt="<?php echo htmlspecialchars($property['title']); ?>"
                                class="w-full h-48 object-cover hover-scale transition-transform duration-700">
                        </div>
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-2">
                                <?php echo htmlspecialchars($property['title']); ?>
                            </h2>
                            <p class="text-gray-600 mb-2"><?php echo htmlspecialchars($property['description']); ?></p>
                            <p class="text-primary font-bold mb-2">$<?php echo number_format($property['price']); ?></p>
                            <p class="text-sm text-gray-500 mb-2">Location: <?php echo htmlspecialchars($property['location']); ?></p>
                            <p class="text-sm text-gray-500 mb-4">Purchased on: <?php echo date('F j, Y', strtotime($property['purchase_date'])); ?></p>
                            
                            <div class="flex justify-center items-center">
                                <button onclick="confirmDelete(<?php echo $property['id']; ?>, '<?php echo htmlspecialchars(addslashes($property['title'])); ?>')"
                                        class="text-red-600 hover:text-red-800 transition-colors duration-300 hover-lift px-4 py-2 border border-red-200 rounded-lg hover:bg-red-50">
                                    Delete Property
                                </button>
                            </div>
                        </div>
                    </div>
            <?php 
                endwhile; 
            else: 
            ?>
                <div class="col-span-full text-center py-8 animate-fade-in">
                    <p class="text-gray-600 mb-4">You haven't purchased any properties yet.</p>
                    <a href="properties.php" class="mt-4 inline-block bg-primary text-white py-2 px-6 rounded-md hover:bg-primary-dark transition-colors hover-lift">
                        Browse Properties
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-auto animate-scale">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Confirm Delete</h3>
                    <p class="text-gray-600 mb-6">Are you sure you want to delete <span id="propertyTitle" class="font-semibold"></span>? This action cannot be undone.</p>
                    <div class="flex justify-end space-x-4">
                        <button onclick="closeDeleteModal()" class="px-4 py-2 text-gray-600 hover:text-gray-800 hover-lift">
                            Cancel
                        </button>
                        <a id="deleteLink" href="#" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors hover-lift">
                            Delete
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const deleteModal = document.getElementById('deleteModal');
        const deleteLink = document.getElementById('deleteLink');
        const propertyTitle = document.getElementById('propertyTitle');

        function confirmDelete(id, title) {
            propertyTitle.textContent = title;
            deleteLink.href = `delete-property.php?id=${id}`;
            deleteModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            deleteModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        deleteModal.addEventListener('click', (e) => {
            if (e.target === deleteModal) {
                closeDeleteModal();
            }
        });
    </script>

    <?php $conn->close(); ?>
</body>
</html>