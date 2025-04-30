<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - RealEstate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        .animate-slide-up {
            animation: slideUp 0.5s ease-out;
        }
        .animate-scale {
            animation: scale 0.3s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes scale {
            from { transform: scale(0.95); }
            to { transform: scale(1); }
        }
        .form-input:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="bg-gray-50">
    <?php 
    // Start session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Check if user is logged in
    $isLoggedIn = isset($_SESSION['user_id']);
    $userName = $isLoggedIn ? $_SESSION['user_name'] : 'Guest';
    $userEmail = $isLoggedIn ? $_SESSION['user_email'] : '';
    $userInitial = $isLoggedIn ? strtoupper(substr($_SESSION['user_name'], 0, 1)) : 'G';
    
    // Debugging code
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    // Check if file exists
    $navbarPath = 'includes/navbar.php';
    if (file_exists($navbarPath)) {
        include $navbarPath;
    } else {
        echo "Error: Navbar file not found at: " . $navbarPath;
    }
    ?>

    <!-- Add a spacer to prevent content from hiding under the fixed navbar -->
   

    <!-- Contact Section -->
    <div class="">
    <!-- Contact Hero Section -->
    <section class="relative  pt-20 pb-20 bg-gradient-to-r from-slate-900 via-blue-900 to-indigo-900">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf" alt="Contact Hero"
                class="w-full h-full object-cover opacity-40 filter saturate-150">
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/50 to-transparent"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl md:text-6xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-200 via-purple-200 to-pink-200 mb-6 animate-fade-in">
                Let's Connect Today
            </h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto mb-4 animate-slide-up">
                We're here to help you find your perfect property. Let's start your real estate journey together.
            </p>
            <p class="text-lg text-gray-300 max-w-3xl mx-auto mb-8 animate-slide-up" style="animation-delay: 0.1s;">
                Our dedicated team of real estate professionals is available 7 days a week to answer your questions and provide personalized guidance for all your property needs.
            </p>
            <div class="flex flex-wrap justify-center gap-4 animate-slide-up" style="animation-delay: 0.2s;">
                <a href="#contact-form" class="px-6 py-3 bg-white/10 backdrop-blur-sm rounded-full text-white hover:bg-white/20 transition-all duration-300 border border-white/30">
                    Send Message
                </a>
                <a href="tel:+1234567890" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full text-white hover:from-blue-600 hover:to-purple-600 transition-all duration-300 shadow-lg hover:shadow-xl">
                    Call Us Now
                </a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <!-- Contact Form -->
                <div class="bg-white rounded-2xl shadow-2xl p-8 transform transition-all duration-300 hover:shadow-3xl animate-scale">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        Send us a Message
                    </h2>
                    
                    <?php if (isset($_SESSION['success_message'])): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline"><?php echo $_SESSION['success_message']; ?></span>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 text-green-500" role="button" onclick="this.parentElement.parentElement.style.display='none'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <title>Close</title>
                                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                                </svg>
                            </span>
                        </div>
                        <?php unset($_SESSION['success_message']); ?>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])): ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <ul class="list-disc list-inside">
                                <?php foreach ($_SESSION['errors'] as $error): ?>
                                    <li><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 text-red-500" role="button" onclick="this.parentElement.parentElement.style.display='none'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <title>Close</title>
                                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                                </svg>
                            </span>
                        </div>
                        <?php unset($_SESSION['errors']); ?>
                    <?php endif; ?>

                    <form action="process_contact.php" method="POST" class="space-y-6">
                        <input type="hidden" name="subject" value="New Contact Form Submission - RealEstate">
                        <!-- Inquiry Type -->
                        <div class="animate-slide-up" style="animation-delay: 0.1s;">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Inquiry Type</label>
                            <select name="inquiryType" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 form-input">
                                <option value="" disabled selected>Select Location</option>
                                <option value="delhi">Delhi</option>
                                <option value="mumbai">Mumbai</option>
                                <option value="jaipur">Jaipur</option>
                                <option value="bengaluru">Bengaluru</option>
                            </select>
                        </div>

                        <!-- Information -->
                        <div class="animate-slide-up" style="animation-delay: 0.2s;">
                            <label class="block text-sm font-medium text-gray-700 mb-2">I'm a</label>
                            <select name="userType" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 form-input">
                                <option value="" disabled selected>Select your role</option>
                                <option value="buyer">Buyer</option>
                                <option value="seller">Seller</option>
                                <option value="agent">Agent</option>
                            </select>
                        </div>

                        <!-- Name Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="animate-slide-up" style="animation-delay: 0.3s;">
                                <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                <input type="text" name="firstName" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 form-input">
                            </div>
                            <div class="animate-slide-up" style="animation-delay: 0.3s;">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                <input type="text" name="lastName" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 form-input">
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="animate-slide-up" style="animation-delay: 0.4s;">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 form-input">
                        </div>

                        <!-- Phone -->
                        <div class="animate-slide-up" style="animation-delay: 0.4s;">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                            <input type="tel" name="phone" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 form-input">
                        </div>

                        <!-- City and Zip -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="animate-slide-up" style="animation-delay: 0.5s;">
                                <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                                <select name="city" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 form-input">
                                    <option value="" disabled selected>Select city</option>
                                    <option value="delhi">Delhi</option>
                                    <option value="mumbai">Mumbai</option>
                                    <option value="jaipur">Jaipur</option>
                                    <option value="bengaluru">Bengaluru</option>
                                </select>
                            </div>
                            <div class="animate-slide-up" style="animation-delay: 0.5s;">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Zip Code</label>
                                <input type="text" name="zipCode" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 form-input">
                            </div>
                        </div>

                        <!-- Property Details -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="animate-slide-up" style="animation-delay: 0.6s;">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Property Type</label>
                                <select name="propertyType" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 form-input">
                                    <option value="" disabled selected>Select property type</option>
                                    <option value="apartment">Apartment</option>
                                    <option value="house">House</option>
                                    <option value="villa">Villa</option>
                                    
                                </select>
                            </div>
                            <div class="animate-slide-up" style="animation-delay: 0.6s;">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Max Price</label>
                                <input type="number" name="maxPrice" placeholder="Enter max price" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 form-input">
                            </div>
                        </div>

                        <!-- Beds and Baths -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="animate-slide-up" style="animation-delay: 0.7s;">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bedrooms</label>
                                <select name="bedrooms" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 form-input">
                                    <option value="" disabled selected>Select beds</option>
                                    <option value="1">1 Bedroom</option>
                                    <option value="2">2 Bedrooms</option>
                                    <option value="3">3 Bedrooms</option>
                                    <option value="4">4+ Bedrooms</option>
                                </select>
                            </div>
                            <div class="animate-slide-up" style="animation-delay: 0.7s;">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bathrooms</label>
                                <select name="bathrooms" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 form-input">
                                    <option value="" disabled selected>Select baths</option>
                                    <option value="1">1 Bathroom</option>
                                    <option value="2">2 Bathrooms</option>
                                    <option value="3">3 Bathrooms</option>
                                    <option value="4">4+ Bathrooms</option>
                                </select>
                            </div>
                        </div>

                        <!-- Message -->
                        <div class="animate-slide-up" style="animation-delay: 0.8s;">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Additional Requirements</label>
                            <textarea name="message" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 form-input"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="animate-slide-up" style="animation-delay: 0.9s;">
                            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-4 rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105">
                                Submit Inquiry
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Contact Information -->
                <div class="space-y-8">
                    <div class="bg-white rounded-2xl p-8 shadow-xl contact-card transition-all duration-300 animate-slide-up">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-6 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            Our Office
                        </h3>
                        <div class="space-y-6">
                            <div class="flex items-start space-x-4 group">
                                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center group-hover:bg-blue-200 transition-colors duration-300">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Address</h4>
                                    <p class="text-gray-600">123 Business Street, New York, NY 10001</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4 group">
                                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center group-hover:bg-purple-200 transition-colors duration-300">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Phone</h4>
                                    <p class="text-gray-600">+1 (555) 123-4567</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4 group">
                                <div class="w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center group-hover:bg-pink-200 transition-colors duration-300">
                                    <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Email</h4>
                                    <p class="text-gray-600">info@realestate.com</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Map -->
                    <div class="rounded-2xl overflow-hidden shadow-xl h-[300px] animate-slide-up" style="animation-delay: 0.2s;">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387193.30596670663!2d-74.25986652089843!3d40.69714941932609!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY!5e0!3m2!1sen!2sus!4v1647881654803!5m2!1sen!2sus" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy"
                            class="transition-all duration-300 hover:scale-105">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Business Hours -->
    <section class="py-20 bg-gradient-to-r from-blue-50 to-purple-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                Business Hours
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 animate-slide-up">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Weekdays</h3>
                    <p class="text-gray-600">Monday - Friday</p>
                    <p class="text-gray-900 font-medium">9:00 AM - 6:00 PM</p>
                </div>
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 animate-slide-up" style="animation-delay: 0.1s;">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Saturday</h3>
                    <p class="text-gray-600">By Appointment</p>
                    <p class="text-gray-900 font-medium">10:00 AM - 4:00 PM</p>
                </div>
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 animate-slide-up" style="animation-delay: 0.2s;">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Sunday</h3>
                    <p class="text-gray-600">Closed</p>
                    <p class="text-gray-900 font-medium">Enjoy your weekend!</p>
                </div>
            </div>
        </div>
    </section>
    </div>
</body>
<script>
    // Profile Modal
    const profileModal = document.createElement('div');
    profileModal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden';
    profileModal.innerHTML = `
        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md animate-scale">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-gray-900">Profile</h3>
                <button onclick="closeProfileModal()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="space-y-4">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center text-2xl font-bold text-blue-600">
                        <?php echo $userInitial; ?>
                    </div>
                    <div>
                        <h4 class="text-lg font-medium text-gray-900"><?php echo htmlspecialchars($userName); ?></h4>
                        <p class="text-gray-500"><?php echo htmlspecialchars($userEmail); ?></p>
                    </div>
                </div>
                <div class="border-t border-gray-200 pt-4">
                    <h4 class="text-sm font-medium text-gray-500 mb-2">Account Actions</h4>
                    <div class="space-y-2">
                        <?php if ($isLoggedIn): ?>
                            <a href="my-properties.php" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <span>My Properties</span>
                            </a>
                            <a href="../signUpLogin/logout.php" class="flex items-center space-x-2 text-gray-700 hover:text-red-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <span>Logout</span>
                            </a>
                        <?php else: ?>
                            <a href="#" onclick="openLoginModal(); return false;" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                <span>Login</span>
                            </a>
                            <a href="../signUpLogin/signup.html" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                                <span>Sign Up</span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    `;
    document.body.appendChild(profileModal);

    // Login Modal
    const loginModal = document.createElement('div');
    loginModal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden';
    loginModal.innerHTML = `
        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md animate-scale">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-gray-900">Login</h3>
                <button onclick="closeLoginModal()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form action="../signUpLogin/process_login.php" method="POST" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Login
                </button>
            </form>
            <div class="mt-4 text-center">
                <p class="text-sm text-gray-600">Don't have an account? <a href="../signUpLogin/signup.html" class="text-blue-600 hover:text-blue-700">Sign up</a></p>
            </div>
        </div>
    `;
    document.body.appendChild(loginModal);

    function openProfileModal() {
        profileModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    function closeProfileModal() {
        profileModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function openLoginModal() {
        loginModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    function closeLoginModal() {
        loginModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    loginModal.addEventListener('click', (e) => {
        if (e.target === loginModal) {
            closeLoginModal();
        }
    });
    
    // Close profile modal when clicking outside
    profileModal.addEventListener('click', (e) => {
        if (e.target === profileModal) {
            closeProfileModal();
        }
    });
</script>

<!-- Footer Section -->
<footer class="bg-gray-900 text-white py-12 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div class="animate-fade-in">
                <h3 class="text-2xl font-bold mb-4 bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">RealEstate</h3>
                <p class="text-gray-400 mb-4">Your trusted partner in finding the perfect property. We make real estate simple and accessible for everyone.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="animate-fade-in" style="animation-delay: 0.2s">
                <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="index.php" class="text-gray-400 hover:text-white transition-colors duration-300">Home</a></li>
                    <li><a href="properties.php" class="text-gray-400 hover:text-white transition-colors duration-300">Properties</a></li>
                    <li><a href="services.php" class="text-gray-400 hover:text-white transition-colors duration-300">Services</a></li>
                    <li><a href="about.php" class="text-gray-400 hover:text-white transition-colors duration-300">About Us</a></li>
                    <li><a href="contact.php" class="text-gray-400 hover:text-white transition-colors duration-300">Contact</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div class="animate-fade-in" style="animation-delay: 0.4s">
                <h4 class="text-lg font-semibold mb-4">Services</h4>
                <ul class="space-y-2">
                    <li class="text-gray-400">Property Sales</li>
                    <li class="text-gray-400">Property Rentals</li>
                    <li class="text-gray-400">Property Management</li>
                    <li class="text-gray-400">Investment Consulting</li>
                    <li class="text-gray-400">Market Analysis</li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="animate-fade-in" style="animation-delay: 0.6s">
                <h4 class="text-lg font-semibold mb-4">Contact Info</h4>
                <div class="space-y-4">
                    <p class="flex items-start space-x-3">
                        <i class="fas fa-map-marker-alt mt-1 text-blue-400"></i>
                        <span class="text-gray-400">123 Business Street, New York, NY 10001</span>
                    </p>
                    <p class="flex items-start space-x-3">
                        <i class="fas fa-phone-alt mt-1 text-blue-400"></i>
                        <span class="text-gray-400">+1 (555) 123-4567</span>
                    </p>
                    <p class="flex items-start space-x-3">
                        <i class="fas fa-envelope mt-1 text-blue-400"></i>
                        <span class="text-gray-400">info@realestate.com</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-800 mt-12 pt-8 text-center animate-fade-in" style="animation-delay: 0.8s">
            <p class="text-gray-400">&copy; 2024 RealEstate. All rights reserved.</p>
        </div>
    </div>
</footer>
</html>