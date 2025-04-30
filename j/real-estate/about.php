<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>



  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - RealEstate</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            'display': ['Playfair Display', 'serif'],
            'body': ['Inter', 'sans-serif'],
          },
          colors: {
            'primary': {
              50: '#f0f9ff',
              100: '#e0f2fe',
              500: '#0ea5e9',
              600: '#0284c7',
              700: '#0369a1',
            },
          },
        },
      },
    }
  </script>
  <?php include 'includes/animations.php'; ?>
</head>

<body class="bg-gray-50">
  <?php include 'includes/navbar.php'; ?>

  <!-- Rest of the content -->
  <div >
    <!-- Hero Section -->
    <section class="relative pt-32 pb-24 bg-gradient-to-r from-slate-900 via-blue-900 to-indigo-900 overflow-hidden">
      <div class="absolute inset-0 overflow-hidden">
        <img src="https://images.unsplash.com/photo-1497366811353-6870744d04b2" alt="About Us Hero"
          class="w-full h-full object-cover opacity-60 scale-105 hover:scale-110 transition-transform duration-3000 ease-out">
        <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/60 to-black/30"></div>
      </div>
      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-6xl md:text-7xl font-display font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-200 via-purple-200 to-pink-200 mb-8 animate-fade-in leading-tight">About RealEstate</h1>
        <p class="text-xl text-gray-200 max-w-3xl mx-auto mb-4 animate-slide-up">Your trusted partner in finding the perfect property since 2010.</p>
        <p class="text-lg text-gray-300 max-w-3xl mx-auto mb-8 animate-slide-up" style="animation-delay: 0.1s;">With over a decade of excellence in the real estate market, we've helped thousands of families find their dream homes and investors secure valuable properties.</p>
        <div class="flex flex-wrap justify-center gap-4 animate-slide-up" style="animation-delay: 0.2s;">
          <a href="#our-story" class="px-6 py-3 bg-white/10 backdrop-blur-sm rounded-full text-white hover:bg-white/20 transition-all duration-300 border border-white/30">
            Our Story
          </a>
          <a href="contact.php" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full text-white hover:from-blue-600 hover:to-purple-600 transition-all duration-300 shadow-lg hover:shadow-xl">
            Contact Us
          </a>
        </div>
      </div>
    </section>

    <!-- Our Story Section -->
    <section id="our-story" class="py-24 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
          <div class="space-y-8 animate-slide-up">
            <h2 class="text-4xl font-display font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Our Story</h2>
            <p class="text-lg text-gray-600">Founded in 2010, RealEstate has grown from a small local agency to one of the most trusted names in property services. Our journey began with a simple mission: to make property transactions transparent, efficient, and satisfying for all parties involved.</p>
            <p class="text-lg text-gray-600">Today, we're proud to have helped thousands of clients find their perfect properties and achieve their real estate goals.</p>
          </div>
          <div class="relative h-96 rounded-xl overflow-hidden shadow-xl animate-fade-in">
            <img src="https://images.unsplash.com/photo-1497215842964-222b430dc094" alt="Office Building" class="absolute inset-0 w-full h-full object-cover">
          </div>
        </div>
      </div>
    </section>

    <!-- Mission & Values Section -->
    <section class="py-24 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-display font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 mb-6">Our Mission & Values</h2>
          <p class="text-xl text-gray-600">Guided by integrity, innovation, and client satisfaction</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 animate-slide-up card-hover">
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Trust & Integrity</h3>
            <p class="text-gray-600">We build lasting relationships through honest, transparent dealings and ethical business practices.</p>
          </div>
          <div class="bg-white p-6 rounded-xl shadow-lg animate-slide-up" style="animation-delay: 0.1s;">
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Innovation</h3>
            <p class="text-gray-600">We leverage cutting-edge technology to provide efficient, modern solutions for our clients.</p>
          </div>
          <div class="bg-white p-6 rounded-xl shadow-lg animate-slide-up" style="animation-delay: 0.2s;">
            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Client Focus</h3>
            <p class="text-gray-600">Your success is our success. We're dedicated to exceeding your expectations at every step.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Stats Section -->
   
  </div>

  <!-- Footer -->
  <footer class="bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div class="space-y-4">
          <div class="flex items-center  space-x-2">
            <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12.71 2.29a1 1 0 00-1.42 0l-9 9a1 1 0 000 1.42A1 1 0 003 13h1v7a2 2 0 002 2h12a2 2 0 002-2v-7h1a1 1 0 00.71-1.71l-9-9zM9 20v-5a1 1 0 011-1h4a1 1 0 011 1v5H9zm10-8h-1v7h-2v-5a3 3 0 00-3-3h-4a3 3 0 00-3 3v5H4v-7H3l9-9 9 9z" />
            </svg>
            <span class="text-2xl font-bold">RealEstate</span>
          </div>
          <p class="text-gray-400">Your trusted partner in finding the perfect property.</p>
          <div class="flex space-x-4">
            <a href="#" class="text-gray-400 hover:text-white transition-colors">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
            </a>
          </div>
        </div>
        <div>
          <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
          <ul class="space-y-2">
            <li><a href="index.php" class="text-gray-400 hover:text-white transition-colors">Home</a></li>
            <li><a href="properties.php" class="text-gray-400 hover:text-white transition-colors">Properties</a></li>
            <li><a href="about.php" class="text-gray-400 hover:text-white transition-colors">About Us</a></li>
            <li><a href="contact.php" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
          </ul>
        </div>
        <div>
          <h3 class="text-lg font-semibold mb-4">Services</h3>
          <ul class="space-y-2">
            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Property Sales</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Property Rental</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Property Management</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Investment Consulting</a></li>
          </ul>
        </div>
        <div>
          <h3 class="text-lg font-semibold mb-4">Contact Info</h3>
          <ul class="space-y-2 text-gray-400">
            <li class="flex items-center space-x-2">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
              <span>123 Business Street, City, Country</span>
            </li>
            <li class="flex items-center space-x-2">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
              </svg>
              <span>info@realestate.com</span>
            </li>
            <li class="flex items-center space-x-2">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
              </svg>
              <span>+1 234 567 890</span>
            </li>
          </ul>
        </div>
      </div>
      <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
        <p>&copy; 2023 RealEstate. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <!-- Profile Modal -->
  <div id="profileModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
      <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-auto animate-scale">
        <div class="p-6">
          <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-gray-800">Profile</h3>
            <button onclick="closeProfileModal()" class="text-gray-500 hover:text-gray-700">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          
          <?php if (isset($_SESSION['user_id'])): ?>
            <div class="text-center mb-6">
              <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-3xl font-bold text-blue-600"><?php echo strtoupper(substr($_SESSION['user_name'], 0, 1)); ?></span>
              </div>
              <h4 class="text-xl font-semibold text-gray-800"><?php echo $_SESSION['user_name']; ?></h4>
              <p class="text-gray-600"><?php echo $_SESSION['user_email']; ?></p>
            </div>
            
            <div class="space-y-4">
              <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'seller'): ?>
                <a href="my-properties.php" class="block w-full px-4 py-2 text-center bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                  My Properties
                </a>
              <?php endif; ?>
              <a href="../signUpLogin/logout.php" class="block w-full px-4 py-2 text-center bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                Logout
              </a>
            </div>
          <?php else: ?>
            <div class="text-center">
              <p class="text-gray-600 mb-6">Please log in to view your profile.</p>
              <button onclick="openLoginModal()" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                Login
              </button>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Login Modal -->
  <div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
      <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-auto animate-scale">
        <div class="p-6">
          <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-gray-800">Login</h3>
            <button onclick="closeLoginModal()" class="text-gray-500 hover:text-gray-700">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <form action="../signUpLogin/login.php" method="POST" class="space-y-4">
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
              <input type="email" id="email" name="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
              <input type="password" id="password" name="password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
              Login
            </button>
          </form>
          <p class="mt-4 text-center text-sm text-gray-600">
            Don't have an account? <a href="../signUpLogin/signup.html" class="text-blue-600 hover:text-blue-800">Sign up</a>
          </p>
        </div>
      </div>
    </div>
  </div>

  <script>
    const profileModal = document.getElementById('profileModal');
    const loginModal = document.getElementById('loginModal');

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
</body>
</html>