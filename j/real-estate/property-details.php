<?php
// Start session
session_start();

// Check if property ID and type are provided
$propertyId = isset($_GET['id']) ? $_GET['id'] : '';
$propertyType = isset($_GET['type']) ? $_GET['type'] : '';

// Sample property details array - In real application, this would come from a database
$properties = [
    '1' => [  // Property ID
        'type' => 'Apartment',
        'count' => 17,
        'description' => 'Luxurious apartments featuring modern amenities and stunning city views.',
        'features' => ['Modern Kitchen', 'Balcony', 'Parking Space', '24/7 Security'],
        'price_range' => '$200,000 - $500,000',
        'image' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688',
        'amenities' => ['Swimming Pool', 'Fitness Center', 'Community Lounge', 'Pet Friendly']
    ],
    '2' => [  // Property ID
        'type' => 'Single Family Home',
        'count' => 12,
        'description' => 'Spacious single-family homes perfect for growing families.',
        'features' => ['Large Backyard', 'Garage', 'Multiple Bedrooms', 'Modern Design'],
        'price_range' => '$400,000 - $800,000',
        'image' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c',
        'amenities' => ['Private Garden', 'Home Office Space', 'Smart Home Features', 'Energy Efficient']
    ],
    '3' => [  // Property ID
        'type' => 'Studio',
        'count' => 7,
        'description' => 'Cozy studio apartments ideal for singles or couples.',
        'features' => ['Open Floor Plan', 'Built-in Storage', 'Modern Appliances', 'City Location'],
        'price_range' => '$150,000 - $300,000',
        'image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7',
        'amenities' => ['Rooftop Access', 'Laundry Facilities', 'Bike Storage', 'High-Speed Internet']
    ],
    '4' => [  // Property ID
        'type' => 'Villa',
        'count' => 15,
        'description' => 'Elegant villas offering luxury living with premium amenities.',
        'features' => ['Private Pool', 'Landscaped Garden', 'Guest House', 'High Ceilings'],
        'price_range' => '$800,000 - $2,000,000',
        'image' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9',
        'amenities' => ['Wine Cellar', 'Home Theater', 'Spa Room', 'Smart Security System']
    ],
    '5' => [  // Property ID
        'type' => 'Office',
        'count' => 3,
        'description' => 'Professional office spaces in prime business locations.',
        'features' => ['Meeting Rooms', 'Reception Area', 'Break Room', 'IT Infrastructure'],
        'price_range' => '$300,000 - $700,000',
        'image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c',
        'amenities' => ['24/7 Access', 'Conference Facilities', 'Parking', 'High-Speed Internet']
    ],
    '6' => [  // Property ID
        'type' => 'Shops',
        'count' => 4,
        'description' => 'Retail spaces in high-traffic commercial areas.',
        'features' => ['Display Windows', 'Storage Room', 'HVAC System', 'Loading Area'],
        'price_range' => '$250,000 - $600,000',
        'image' => 'https://images.unsplash.com/photo-1565183928294-7063f23ce0f8',
        'amenities' => ['Security System', 'Customer Parking', 'Signage Space', 'Utilities Included']
    ]
];

// Get details for the selected property based on type
$details = null;
foreach ($properties as $id => $property) {
    if (strtolower($property['type']) === strtolower($propertyType)) {
        $details = $property;
        $propertyId = $id;
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $details ? $details['type'] : 'Property'; ?> Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.section').forEach(section => {
                section.classList.add('hidden');
            });
            // Show selected section
            document.getElementById(sectionId).classList.remove('hidden');
        }

        $(document).ready(function() {
            // Show photos section by default
            showSection('photos');

            // Handle form submission
            $('#propertyInquiryForm').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                
                $.ajax({
                    url: 'process_contact.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        alert('Thank you for your inquiry. We will contact you soon!');
                        $('#propertyInquiryForm')[0].reset();
                    },
                    error: function() {
                        alert('An error occurred. Please try again later.');
                    }
                });
            });
        });
    </script>
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar with Back Button -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <a href="index.php" class="flex items-center text-gray-700 hover:text-gray-900">
                        <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <?php if ($details): ?>
    <!-- Property Details Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Property Navigation -->
            <div class="bg-gray-100 p-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Property ID: <?php echo $propertyId; ?></h2>
                <div class="flex space-x-4">
                    <button class="text-blue-600 hover:text-blue-800" onclick="showSection('photos')">Photos</button>
                    <button class="text-blue-600 hover:text-blue-800" onclick="showSection('details')">Details</button>
                   
                </div>
            </div>
            <!-- Photo Gallery Section -->
            <div id="photos" class="section">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 p-4">
                    <div class="col-span-2 md:col-span-3 h-96 relative">
                        <img src="<?php echo $details['image']; ?>" alt="Main View" class="w-full h-full object-cover rounded-lg">
                    </div>
                    <!-- Additional sample images -->
                    <div class="h-48">
                        <img src="https://images.unsplash.com/photo-1560448204-603b3fc33ddc" alt="Living Room" class="w-full h-full object-cover rounded-lg">
                    </div>
                    <div class="h-48">
                        <img src="https://images.unsplash.com/photo-1560185893-a55cbc8c57e8" alt="Kitchen" class="w-full h-full object-cover rounded-lg">
                    </div>
                    <div class="h-48">
                        <img src="https://images.unsplash.com/photo-1560185127-6ed189bf02f4" alt="Bedroom" class="w-full h-full object-cover rounded-lg">
                    </div>
                </div>
            </div>

            <!-- Details Section -->
            <div id="details" class="section p-8 hidden">
                <h1 class="text-4xl font-bold text-gray-900 mb-4"><?php echo $details['type']; ?></h1>
                <p class="text-xl text-gray-600 mb-8"><?php echo $details['description']; ?></p>
                
                <!-- Interior Details -->
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Interior Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h3 class="font-semibold mb-2">Living Room</h3>
                            <ul class="list-disc pl-4 text-gray-600">
                                <li>Spacious open concept design</li>
                                <li>Large windows for natural lighting</li>
                                <li>Hardwood flooring</li>
                            </ul>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h3 class="font-semibold mb-2">Kitchen</h3>
                            <ul class="list-disc pl-4 text-gray-600">
                                <li>Modern appliances</li>
                                <li>Granite countertops</li>
                                <li>Custom cabinetry</li>
                            </ul>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h3 class="font-semibold mb-2">Bedrooms</h3>
                            <ul class="list-disc pl-4 text-gray-600">
                                <li>Walk-in closets</li>
                                <li>En-suite bathrooms</li>
                                <li>Ceiling fans</li>
                            </ul>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h3 class="font-semibold mb-2">Bathrooms</h3>
                            <ul class="list-disc pl-4 text-gray-600">
                                <li>Modern fixtures</li>
                                <li>Dual vanities</li>
                                <li>Heated floors</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Price Range -->
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Price Range</h2>
                    <p class="text-3xl text-blue-600 font-bold"><?php echo $details['price_range']; ?></p>
                </div>

                <!-- Features -->
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Key Features</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <?php foreach ($details['features'] as $feature): ?>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span class="text-gray-700"><?php echo $feature; ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Amenities Section -->
                <div id="amenities" class="section hidden">
                    <div class="p-8">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Premium Amenities</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <?php foreach ($details['amenities'] as $amenity): ?>
                            <div class="p-4 bg-gray-50 rounded-lg flex items-start">
                                <i class="fas fa-star text-blue-500 mr-3 mt-1"></i>
                                <div>
                                    <h3 class="font-semibold mb-2"><?php echo $amenity; ?></h3>
                                    <p class="text-sm text-gray-600">Premium quality amenity with modern features and maintenance.</p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Contact Section -->
                <div id="contact" class="section hidden">
                    <div class="p-8">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-6">Contact Us About This Property</h2>
                        <form id="propertyInquiryForm" class="space-y-6">
                            <input type="hidden" name="property_id" value="<?php echo $propertyId; ?>">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                                    <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                                    <input type="tel" name="phone" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Preferred Visit Date</label>
                                    <input type="date" name="visit_date" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                                <textarea name="message" rows="4" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors duration-300">
                                    Send Inquiry
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <!-- Error Message -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
            <div class="mb-6">
                <svg class="h-16 w-16 text-red-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Property Not Found</h2>
            <p class="text-lg text-gray-600 mb-8">Sorry, the property type you selected is not available. Please return to the home page to view other properties.</p>
            <a href="index.php" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-full hover:bg-blue-700 transition-colors duration-300">
                Return to Home Page
            </a>
        </div>
    </div>
    <?php endif; ?>
</body>
</html>