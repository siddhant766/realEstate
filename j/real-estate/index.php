<?php
// Start session
session_start();

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $isLoggedIn ? $_SESSION['user_name'] : 'Guest';
$userEmail = $isLoggedIn ? $_SESSION['user_email'] : '';
$userInitial = $isLoggedIn ? strtoupper(substr($_SESSION['user_name'], 0, 1)) : 'G';

$conn = new mysqli("localhost", "root", "", "j");

// Initialize appointment count
$appointmentCount = 0;

// Fetch the number of appointments for the logged-in user
if ($isLoggedIn) {
    $stmt = $conn->prepare("SELECT COUNT(*) as appointment_count FROM appointments WHERE user_email = ?");
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $stmt->bind_result($appointmentCount);
    $stmt->fetch();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Premium Real Estate</title>
  <!-- Tailwind CSS via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Custom Tailwind Configuration -->
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
  <!-- Custom Styles -->
  <style>
    @layer utilities {
      .backdrop-blur {
        backdrop-filter: blur(8px);
      }

      .transition-transform {
        transition: transform 0.3s ease;
      }

      .slide-enter {
        animation: slideIn 0.3s ease-out;
      }

      .animate-fade-in {
        animation: fadeIn 0.5s ease-in;
      }

      .animate-slide-up {
        animation: slideUp 0.5s ease-out;
      }

      @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
      }

      @keyframes slideUp {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
      }

      @keyframes slideIn {
        from {
          transform: translateY(-100%);
          opacity: 0;
        }

        to {
          transform: translateY(0);
          opacity: 1;
        }
      }
    }
  </style>
</head>

<body class="bg-gray-50">
  <?php include 'includes/navbar.php'; ?>

  <!-- Hero Section with Slider -->
  <div class="relative h-[600px] mt-0">
    <div id="heroSlider" class="relative h-full overflow-hidden">
      <!-- Slider images will be inserted here by JavaScript -->
      <div class="absolute inset-0 bg-gradient-to-r from-black/80 to-black/60 z-10"></div>
      <div class="absolute inset-0 flex items-center z-20">
        <div class="max-w-7xl mx-auto px-4 w-full">
          <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 animate-fade-in drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">
            Luxury Living Awaits You
          </h1>
          <p class="text-xl text-white mb-4 animate-slide-up drop-shadow-[0_1px_2px_rgba(0,0,0,0.8)]">
            Discover exceptional properties curated by the region's most trusted real estate experts
          </p>
          <p class="text-lg text-white mb-8 animate-slide-up drop-shadow-[0_1px_2px_rgba(0,0,0,0.8)]" style="animation-delay: 0.1s;">
            From modern urban apartments to sprawling suburban estates — find your perfect match with our premium listings
          </p>
          <div class="flex flex-wrap gap-4 animate-slide-up" style="animation-delay: 0.2s;">
            <a href="#search-section" class="px-6 py-3 bg-white/20 backdrop-blur-sm rounded-full text-white hover:bg-white/30 transition-all duration-300 border border-white/40 shadow-md">
              Search Properties
            </a>
            <a href="properties.php" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full text-white hover:from-blue-600 hover:to-purple-600 transition-all duration-300 shadow-lg hover:shadow-xl">
              View All Listings
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <!-- Property Search Form Section with Background Image -->

  <!-- Quick Appointment Booking Section -->


  <!-- Best Deals Section -->
  <section class="py-16">
    <div class="max-w-7xl mx-auto px-4">
      <!-- Section Headers -->
      <div class="text-center mb-12">
        <h2 class="text-[50px] text-black font-[Trebuchet MS] leading-tight mb-4">
          Discover Our Best Deals
        </h2>
        <p class="text-[25px] font-[Trebuchet MS] text-gray-600">
          Exclusive properties with unbeatable value
        </p>
      </div>

      <!-- Deals Container -->
      <div class="flex flex-wrap justify-center gap-8">
        <!-- Deal Card 1 -->
        <div class="w-full sm:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.5rem)] max-w-[400px] group">
          <div
            class="bg-white rounded-xl overflow-hidden shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
            <div class="relative">
              <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&h=360"
                alt="Modern Villa Deal" class="w-full h-[180px] object-cover">
              <div class="absolute top-4 right-4 bg-red-500 text-white px-4 py-1 rounded-full text-sm font-bold">
                -20% OFF
              </div>
            </div>
            <div class="p-6 bg-gray-100">
              <h3 class="text-lg font-semibold mb-2 text-center">Luxury Villa in Beverly Hills</h3>
              <p class="text-gray-600 text-center">Starting from $2.4M</p>
            </div>
          </div>
        </div>

        <!-- Deal Card 2 -->
        <div class="w-full sm:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.5rem)] max-w-[400px] group">
          <div
            class="bg-white rounded-xl overflow-hidden shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
            <div class="relative">
              <img src="https://images.unsplash.com/photo-1567496898669-ee935f5f647a?auto=format&fit=crop&w=800&h=360"
                alt="Penthouse Deal" class="w-full h-[180px] object-cover">
              <div class="absolute top-4 right-4 bg-red-500 text-white px-4 py-1 rounded-full text-sm font-bold">
                -15% OFF
              </div>
            </div>
            <div class="p-6 bg-gray-100">
              <h3 class="text-lg font-semibold mb-2 text-center">Downtown Penthouse</h3>
              <p class="text-gray-600 text-center">Starting from $1.8M</p>
            </div>
          </div>
        </div>

        <!-- Deal Card 3 -->
        <div class="w-full sm:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.5rem)] max-w-[400px] group">
          <div
            class="bg-white rounded-xl overflow-hidden shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
            <div class="relative">
              <img src="https://images.unsplash.com/photo-1574362848149-11496d93a7c7?auto=format&fit=crop&w=800&h=360"
                alt="Beachfront Apartment Deal" class="w-full h-[180px] object-cover">
              <div class="absolute top-4 right-4 bg-red-500 text-white px-4 py-1 rounded-full text-sm font-bold">
                -25% OFF
              </div>
            </div>
            <div class="p-6 bg-gray-100">
              <h3 class="text-lg font-semibold mb-2 text-center">Beachfront Apartment</h3>
              <p class="text-gray-600 text-center">Starting from $950K</p>
            </div>
          </div>
        </div>

        <!-- Deal Card 4 -->
        <div class="w-full sm:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.5rem)] max-w-[400px] group">
          <div
            class="bg-white rounded-xl overflow-hidden shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
            <div class="relative">
              <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&h=360"
                alt="Family Home Deal" class="w-full h-[180px] object-cover">
              <div class="absolute top-4 right-4 bg-red-500 text-white px-4 py-1 rounded-full text-sm font-bold">
                -10% OFF
              </div>
            </div>
            <div class="p-6 bg-gray-100">
              <h3 class="text-lg font-semibold mb-2 text-center">Modern Family Home</h3>
              <p class="text-gray-600 text-center">Starting from $780K</p>
            </div>
          </div>
        </div>

        <!-- Deal Card 5 -->
        <div class="w-full sm:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.5rem)] max-w-[400px] group">
          <div
            class="bg-white rounded-xl overflow-hidden shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
            <div class="relative">
              <img src="https://images.unsplash.com/photo-1565182999561-18d7dc61c393?auto=format&fit=crop&w=800&h=360"
                alt="Mountain Retreat Deal" class="w-full h-[180px] object-cover">
              <div class="absolute top-4 right-4 bg-red-500 text-white px-4 py-1 rounded-full text-sm font-bold">
                -30% OFF
              </div>
            </div>
            <div class="p-6 bg-gray-100">
              <h3 class="text-lg font-semibold mb-2 text-center">Mountain Retreat</h3>
              <p class="text-gray-600 text-center">Starting from $650K</p>
            </div>
          </div>
        </div>

        <!-- Deal Card 6 -->
        <div class="w-full sm:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.5rem)] max-w-[400px] group">
          <div
            class="bg-white rounded-xl overflow-hidden shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
            <div class="relative">
              <img src="https://images.unsplash.com/photo-1523217582562-09d0def993a6?auto=format&fit=crop&w=800&h=360"
                alt="Urban Loft Deal" class="w-full h-[180px] object-cover">
              <div class="absolute top-4 right-4 bg-red-500 text-white px-4 py-1 rounded-full text-sm font-bold">
                -20% OFF
              </div>
            </div>
            <div class="p-6 bg-gray-100">
              <h3 class="text-lg font-semibold mb-2 text-center">Urban Loft</h3>
              <p class="text-gray-600 text-center">Starting from $420K</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>




  <!-- Featured Properties Section -->
  <section class="bg-gray-100">
    <div class="w-full h-screen  flex flex-col items-center gap-4 pt-16 pb-20">
      <h1 class="font-serif text-4xl text-[#292424] font-light">Explore Our Properties</h1>
      <p class="text-[#201c1c]">Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>


      <div class="w-full h-full  mt-8 px-16 flex flex-row gap-8 items-center justify-center  " id="items">


        <div
          class="h-[390px] w-[200px] bg-[#312525] rounded shadow-orange-50 shadow-2xs relative z-10 group transition-all duration-300 hover:scale-105"
          id="firstitem">


          <div
            class="absolute top-10 left-2.5 z-20 transition-all duration-200 group-hover:opacity-100 group-hover:scale-105">
            <p class="font-extrabold text-white">17 Properties</p>
            <p class=" text-white"
              style="font-size: 20px; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
              Appartment</p>
          </div>


          <div
            class="absolute bottom-4 left-2.5 z-20 transition-all duration-200 group-hover:opacity-100 group-hover:scale-105">
            <a href="property-details.php?type=apartment" class="text-white" style="font-size: 12px;">MORE DETAILS</a>

          </div>


          <img src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688"
            class="object-cover opacity-60 w-full h-full transition-all duration-300 rounded group-hover:opacity-100 group-hover:scale-105"
            alt="image">
        </div>


        <div
          class="h-[390px] w-[200px] bg-[#312525] rounded shadow-orange-50 shadow-2xs relative z-10 group transition-all duration-300 hover:scale-105 "
          id="item2">
          <div
            class="absolute top-10 left-2.5 z-20 transition-all duration-200 group-hover:opacity-100 group-hover:scale-105">
            <p class="font-extrabold text-white">12 Properties</p>
            <p class=" text-white"
              style="font-size: 20px; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
              Single Family<br>Home</p>
          </div>
          <div
            class="absolute bottom-4 left-2.5 z-20 transition-all duration-200 group-hover:opacity-100 group-hover:scale-105"
            id="item7">
            <a href="property-details.php?type=single-family" class="text-white" style="font-size: 12px;">MORE DETAILS</a>
          </div>
          <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c"
            class="object-cover opacity-60 w-full h-full transition-all duration-300 rounded group-hover:opacity-100 group-hover:scale-105"
            alt="image">
        </div>

        <div
          class="h-[390px] w-[200px] bg-[#312525] rounded shadow-orange-50 shadow-2xs relative z-10 group transition-all duration-300 hover:scale-105"
          id="item6">
          <div
            class="absolute top-10 left-2.5 z-20 transition-all duration-200 group-hover:opacity-100 group-hover:scale-105">
            <p class="font-extrabold text-white">7 Properties</p>
            <p class=" text-white"
              style="font-size: 20px; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
              Studio</p>
          </div>
          <div
            class="absolute bottom-4 left-2.5 z-20 transition-all duration-200 group-hover:opacity-100 group-hover:scale-105">
            <a href="property-details.php?type=studio" class="text-white" style="font-size: 12px;">MORE DETAILS</a>
          </div>
          <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7"
            class="object-cover opacity-60 w-full h-full transition-all duration-300 rounded group-hover:opacity-100 group-hover:scale-105"
            alt="image">
        </div>

        <div
          class="h-[390px] w-[200px] bg-[#312525] rounded shadow-orange-50 shadow-2xs relative z-10 group transition-all duration-300 hover:scale-105"
          id="item3">
          <div
            class="absolute top-10 left-2.5 z-20 transition-all duration-200 group-hover:opacity-100 group-hover:scale-105">
            <p class="font-extrabold text-white">15 Properties</p>
            <p class=" text-white"
              style="font-size: 20px; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
              Villa</p>
          </div>
          <div
            class="absolute bottom-4 left-2.5 z-20 transition-all duration-200 group-hover:opacity-100 group-hover:scale-105">
            <a href="property-details.php?type=villa" class="text-white" style="font-size: 12px;">MORE DETAILS</a>
          </div>
          <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9"
            class="object-cover opacity-60 w-full h-full transition-all duration-300 rounded group-hover:opacity-100 group-hover:scale-105"
            alt="image">
        </div>

        <div
          class="h-[390px] w-[200px] bg-[#312525] rounded shadow-orange-50 shadow-2xs relative z-10 group transition-all duration-300 hover:scale-105"
          id="item4">
          <div
            class="absolute top-10 left-2.5 z-20 transition-all duration-200 group-hover:opacity-100 group-hover:scale-105">
            <p class="font-extrabold text-white">3 Properties</p>
            <p class=" text-white"
              style="font-size: 20px; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
              Office</p>
          </div>
          <div
            class="absolute bottom-4 left-2.5 z-20 transition-all duration-200 group-hover:opacity-100 group-hover:scale-105">
            <a href="property-details.php?type=office" class="text-white" style="font-size: 12px;">MORE DETAILS</a>
          </div>
          <img src="https://images.unsplash.com/photo-1497366216548-37526070297c"
            class="object-cover opacity-60 w-full h-full transition-all duration-300 rounded group-hover:opacity-100 group-hover:scale-105"
            alt="image">
        </div>
        <div
          class="h-[390px] w-[200px] bg-[#312525] rounded shadow-orange-50 shadow-2xs relative z-10 group transition-all duration-300 hover:scale-105"
          id="item5">
          <div
            class="absolute top-10 left-2.5 z-20 transition-all duration-200 group-hover:opacity-100 group-hover:scale-105">
            <p class=" text-sm text-gray-300">4 Properties</p>
            <p class=" text-white"
              style="font-size: 20px; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
              Shops</p>
          </div>
          <div
            class="absolute bottom-4 left-2.5 z-20 transition-all duration-200 group-hover:opacity-100 group-hover:scale-105">
            <a href="property-details.php?type=shop" class="text-white " style="font-size: 12px;">MORE DETAILS</a>
          </div>
          <img src="https://images.unsplash.com/photo-1565183928294-7063f23ce0f8" 
            class="object-cover opacity-60 w-full h-full transition-all duration-300 rounded group-hover:opacity-100 group-hover:scale-105"
            alt="image">
        </div>

      </div>
    </div>
  </section>

  <!-- Blog Section -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Read From Our Blog</h2>
        <p class="text-lg text-gray-600">Stay informed with our latest insights, market trends, and expert advice in
          real estate.</p>
      </div>

      <!-- Blog Posts Slider Container -->
      <div class="relative">
        <!-- Navigation Buttons -->
        <div class="absolute inset-y-0 left-0 z-10 flex items-center">
          <button id="prevButton"
            class="bg-white/80 backdrop-blur-sm -ml-4 lg:-ml-6 p-3 rounded-full shadow-lg hover:bg-white transition-all duration-300 focus:outline-none">
            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
          </button>
        </div>
        <div class="absolute inset-y-0 right-0 z-10 flex items-center">
          <button id="nextButton"
            class="bg-white/80 backdrop-blur-sm -mr-4 lg:-mr-6 p-3 rounded-full shadow-lg hover:bg-white transition-all duration-300 focus:outline-none">
            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </button>
        </div>

        <!-- Slider -->
        <div class="overflow-hidden" id="blogSlider">
          <div class="flex transition-transform duration-500 ease-out" id="blogSliderTrack">
            <!-- Blog Post 1 -->
            <div class="w-full md:w-1/2 lg:w-1/3 flex-none px-4">
              <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="relative">
                  <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa" alt="Modern Home"
                    class="w-full h-56 object-cover">
                  <span class="absolute top-4 left-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm">Real
                    Estate</span>
                </div>
                <div class="p-6">
                  <div class="flex items-center text-sm text-gray-500 mb-4">
                    <a href="./blog-details.html" class="text-blue-600 hover:text-blue-800 font-medium">MORE DETAILS</a>
                    <span class="flex items-center ml-4">
                      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                      </svg>
                      March 15, 2024
                    </span>
                  </div>
                  <h3 class="text-xl font-semibold mb-3">
                    <a href="#" class="text-gray-900 hover:text-blue-600 transition-colors">The Future of Real Estate
                      Investment</a>
                  </h3>
                  <p class="text-gray-600 mb-4 line-clamp-2">Discover the latest trends and opportunities in the real
                    estate market for savvy investors.</p>
                  <div class="flex items-center">
                    <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Author"
                      class="w-10 h-10 rounded-full mr-3">
                    <div>
                      <p class="text-sm font-medium text-gray-900">John Smith</p>
                      <p class="text-sm text-gray-500">Real Estate Expert</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="w-full md:w-1/2 lg:w-1/3 flex-none px-4">
              <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="relative">
                  <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa" alt="Modern Home"
                    class="w-full h-56 object-cover">
                  <span class="absolute top-4 left-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm">Real
                    Estate</span>
                </div>
                <div class="p-6">
                  <div class="flex items-center text-sm text-gray-500 mb-4">
                    <a href="blog-details.html" class="text-blue-600 hover:text-blue-800 font-medium">MORE DETAILS</a>
                    <span class="flex items-center ml-4">
                      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                      </svg>
                      March 15, 2024
                    </span>
                  </div>
                  <h3 class="text-xl font-semibold mb-3">
                    <a href="#" class="text-gray-900 hover:text-blue-600 transition-colors">The Future of Real Estate
                      Investment</a>
                  </h3>
                  <p class="text-gray-600 mb-4 line-clamp-2">Discover the latest trends and opportunities in the real
                    estate market for savvy investors.</p>
                  <div class="flex items-center">
                    <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Author"
                      class="w-10 h-10 rounded-full mr-3">
                    <div>
                      <p class="text-sm font-medium text-gray-900">John Smith</p>
                      <p class="text-sm text-gray-500">Real Estate Expert</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="w-full md:w-1/2 lg:w-1/3 flex-none px-4">
              <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="relative">
                  <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa" alt="Modern Home"
                    class="w-full h-56 object-cover">
                  <span class="absolute top-4 left-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm">Real
                    Estate</span>
                </div>
                <div class="p-6">
                  <div class="flex items-center text-sm text-gray-500 mb-4">
                    <a href="blog-details.html" class="text-blue-600 hover:text-blue-800 font-medium">MORE DETAILS</a>
                    <span class="flex items-center ml-4">
                      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                      </svg>
                      March 15, 2024
                    </span>
                  </div>
                  <h3 class="text-xl font-semibold mb-3">
                    <a href="#" class="text-gray-900 hover:text-blue-600 transition-colors">The Future of Real Estate
                      Investment</a>
                  </h3>
                  <p class="text-gray-600 mb-4 line-clamp-2">Discover the latest trends and opportunities in the real
                    estate market for savvy investors.</p>
                  <div class="flex items-center">
                    <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Author"
                      class="w-10 h-10 rounded-full mr-3">
                    <div>
                      <p class="text-sm font-medium text-gray-900">John Smith</p>
                      <p class="text-sm text-gray-500">Real Estate Expert</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="w-full md:w-1/2 lg:w-1/3 flex-none px-4">
              <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="relative">
                  <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa" alt="Modern Home"
                    class="w-full h-56 object-cover">
                  <span class="absolute top-4 left-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm">Real
                    Estate</span>
                </div>
                <div class="p-6">
                  <div class="flex items-center text-sm text-gray-500 mb-4">
                    <a href="blog-details.html" class="text-blue-600 hover:text-blue-800 font-medium">MORE DETAILS</a>
                    <span class="flex items-center ml-4">
                      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                      </svg>
                      March 15, 2024
                    </span>
                  </div>
                  <h3 class="text-xl font-semibold mb-3">
                    <a href="#" class="text-gray-900 hover:text-blue-600 transition-colors">The Future of Real Estate
                      Investment</a>
                  </h3>
                  <p class="text-gray-600 mb-4 line-clamp-2">Discover the latest trends and opportunities in the real
                    estate market for savvy investors.</p>
                  <div class="flex items-center">
                    <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Author"
                      class="w-10 h-10 rounded-full mr-3">
                    <div>
                      <p class="text-sm font-medium text-gray-900">John Smith</p>
                      <p class="text-sm text-gray-500">Real Estate Expert</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Blog Post 2 -->
            <div class="w-full md:w-1/2 lg:w-1/3 flex-none px-4">
              <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="relative">
                  <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750" alt="Luxury Home"
                    class="w-full h-56 object-cover">
                  <span
                    class="absolute top-4 left-4 bg-green-600 text-white px-3 py-1 rounded-full text-sm">Investment</span>
                </div>
                <div class="p-6">
                  <div class="flex items-center text-sm text-gray-500 mb-4">
                    <span class="flex items-center">
                      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                      </svg>
                      March 12, 2024
                    </span>
                  </div>
                  <h3 class="text-xl font-semibold mb-3">
                    <a href="#" class="text-gray-900 hover:text-blue-600 transition-colors">Market Trends for 2024</a>
                  </h3>
                  <p class="text-gray-600 mb-4 line-clamp-2">Analysis of emerging real estate trends and market
                    predictions for the coming year.</p>
                  <div class="flex items-center">
                    <img src="https://randomuser.me/api/portraits/women/1.jpg" alt="Author"
                      class="w-10 h-10 rounded-full mr-3">
                    <div>
                      <p class="text-sm font-medium text-gray-900">Sarah Johnson</p>
                      <p class="text-sm text-gray-500">Market Analyst</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Blog Post 3 -->
            <div class="w-full md:w-1/2 lg:w-1/3 flex-none px-4">
              <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="relative">
                  <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c" alt="Modern Interior"
                    class="w-full h-56 object-cover">
                  <span
                    class="absolute top-4 left-4 bg-purple-600 text-white px-3 py-1 rounded-full text-sm">Design</span>
                </div>
                <div class="p-6">
                  <div class="flex items-center text-sm text-gray-500 mb-4">
                    <span class="flex items-center">
                      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                      </svg>
                      March 10, 2024
                    </span>
                  </div>
                  <h3 class="text-xl font-semibold mb-3">
                    <a href="#" class="text-gray-900 hover:text-blue-600 transition-colors">Interior Design Trends</a>
                  </h3>
                  <p class="text-gray-600 mb-4 line-clamp-2">Latest interior design trends that can increase your
                    property's value.</p>
                  <div class="flex items-center">
                    <img src="https://randomuser.me/api/portraits/men/2.jpg" alt="Author"
                      class="w-10 h-10 rounded-full mr-3">
                    <div>
                      <p class="text-sm font-medium text-gray-900">Michael Chen</p>
                      <p class="text-sm text-gray-500">Interior Designer</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Dots Navigation -->
        <div class="flex justify-center mt-8 space-x-2" id="sliderDots">
          <button class="w-3 h-3 rounded-full bg-blue-600"></button>
          <button class="w-3 h-3 rounded-full bg-gray-300"></button>
          <button class="w-3 h-3 rounded-full bg-gray-300"></button>
        </div>
      </div>
    </div>
  </section>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const slider = document.getElementById('blogSliderTrack');
      const slides = slider.children;
      const dotsContainer = document.getElementById('sliderDots');
      const dots = dotsContainer.children;
      const prevButton = document.getElementById('prevButton');
      const nextButton = document.getElementById('nextButton');

      let currentSlide = 0;
      const slidesToShow = window.innerWidth >= 1024 ? 3 : window.innerWidth >= 768 ? 2 : 1;
      const slideWidth = 100 / slidesToShow;

      // Initialize slider
      slider.style.transform = `translateX(0%)`;

      // Update dots
      function updateDots() {
        Array.from(dots).forEach((dot, index) => {
          dot.classList.remove('bg-blue-600', 'bg-gray-300');
          dot.classList.add(index === currentSlide ? 'bg-blue-600' : 'bg-gray-300');
        });
      }

      // Next slide
      function nextSlide() {
        currentSlide = (currentSlide + 1) % (slides.length - slidesToShow + 1);
        slider.style.transform = `translateX(-${currentSlide * slideWidth}%)`;
        updateDots();
      }

      // Previous slide
      function prevSlide() {
        currentSlide = currentSlide === 0 ? slides.length - slidesToShow : currentSlide - 1;
        slider.style.transform = `translateX(-${currentSlide * slideWidth}%)`;
        updateDots();
      }

      // Event listeners
      nextButton.addEventListener('click', nextSlide);
      prevButton.addEventListener('click', prevSlide);

      // Autoplay
      let autoplayInterval = setInterval(nextSlide, 5000);

      // Pause autoplay on hover
      slider.addEventListener('mouseenter', () => clearInterval(autoplayInterval));
      slider.addEventListener('mouseleave', () => autoplayInterval = setInterval(nextSlide, 5000));

      // Dot navigation
      Array.from(dots).forEach((dot, index) => {
        dot.addEventListener('click', () => {
          currentSlide = index;
          slider.style.transform = `translateX(-${currentSlide * slideWidth}%)`;
          updateDots();
        });
      });

      // Handle window resize
      window.addEventListener('resize', () => {
        const newSlidesToShow = window.innerWidth >= 1024 ? 3 : window.innerWidth >= 768 ? 2 : 1;
        if (newSlidesToShow !== slidesToShow) {
          location.reload();
        }
      });
    });
  </script>

  <style>
    .line-clamp-2 {
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
  </style>

  <section class="py-16 bg-gray-100 text-black">
    <div class="max-w-6xl mx-auto px-6 mb-12">
      <h1 class="text-5xl font-serif text-[#292424] font-light mb-4">Meet Our Real Estate Agents</h1>
      <h3 class="text-xl md:text-2xl font-serif text-[#292424] font-light">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit donec sollicitudin
      </h3>
    </div>

    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
      <!-- Agent Card -->
      <div class="bg-white rounded-xl shadow-md p-5 text-center hover:shadow-xl transition-all duration-300">
        <div class="mb-4">
          <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d" alt="Brittany Watkins"
            class="w-full h-64 object-cover rounded-lg">
        </div>
        <h3 class="text-lg font-semibold text-gray-800">Brittany Watkins</h3>
        <p class="text-sm text-gray-600">Company Agent, All American Real Estate</p>
        <p class="text-sm text-gray-500 mt-2">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus porta justo eget risus consectetur...
        </p>
        <a href="#" class="text-blue-600 hover:underline mt-2 inline-block">View Profile</a>
      </div>

      <!-- Copy the same structure for each agent -->
      <div class="bg-white rounded-xl shadow-md p-5 text-center hover:shadow-xl transition-all duration-300">
        <div class="mb-4">
          <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330" alt="Michelle Ramirez"
            class="w-full h-64 object-cover rounded-lg">
        </div>
        <h3 class="text-lg font-semibold text-gray-800">Michelle Ramirez</h3>
        <p class="text-sm text-gray-600">Company Agent, Modern House Real Estate</p>
        <p class="text-sm text-gray-500 mt-2">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus porta justo eget risus consectetur...
        </p>
        <a href="#" class="text-blue-600 hover:underline mt-2 inline-block">View Profile</a>
      </div>

      <div class="bg-white rounded-xl shadow-md p-5 text-center hover:shadow-xl transition-all duration-300">
        <div class="mb-4">
          <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e" alt="Samuel Palmer"
            class="w-full h-64 object-cover rounded-lg">
        </div>
        <h3 class="text-lg font-semibold text-gray-800">Samuel Palmer</h3>
        <p class="text-sm text-gray-600">Company Agent, Modern House Real Estate</p>
        <p class="text-sm text-gray-500 mt-2">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus porta justo eget risus consectetur...
        </p>
        <a href="#" class="text-blue-600 hover:underline mt-2 inline-block">View Profile</a>
      </div>

      <div class="bg-white rounded-xl shadow-md p-5 text-center hover:shadow-xl transition-all duration-300">
        <div class="mb-4">
          <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80" alt="Vincent Fuller"
            class="w-full h-64 object-cover rounded-lg">
        </div>
        <h3 class="text-lg font-semibold text-gray-800">Vincent Fuller</h3>
        <p class="text-sm text-gray-600">Company Agent, Country House Real Estate</p>
        <p class="text-sm text-gray-500 mt-2">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus porta justo eget risus consectetur...
        </p>
        <a href="#" class="text-blue-600 hover:underline mt-2 inline-block">View Profile</a>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-4">
      <!-- Section Header -->
      <div class="text-center mb-12">
        <h2 class="font-serif font-light text-4xl mb-4">What Our Clients Say</h2>
        <p class="text-gray-600 max-w-2xl mx-auto mb-8">
          Read what our satisfied clients have to say about their experience with us
        </p>
      </div>

      <!-- Testimonials Slider Container -->
      <div class="relative overflow-hidden">
        <!-- Previous Button -->
        <button
          class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white/80 p-2 rounded-full shadow-lg hover:bg-white transition-all duration-200 -ml-4 hidden md:block"
          id="prevButton">
          <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
        </button>

        <div class="slider-container" id="testimonialSlider">
          <div class="flex transition-transform duration-500 gap-6">
            <!-- Testimonial 1 -->
            <div class="min-w-[calc(33.333%-1rem)] p-4">
              <div class="bg-white rounded-xl shadow-lg p-6 h-full">
                <div class="flex items-center mb-6">
                  <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="John Doe"
                    class="w-14 h-14 rounded-full object-cover mr-4">
                  <div>
                    <h3 class="font-semibold text-lg">John Doe</h3>
                    <p class="text-gray-600">Home Buyer</p>
                  </div>
                </div>
                <p class="text-gray-700 italic mb-4">"Amazing experience working with this team. They helped me find my
                  dream home!"</p>
                <p class="text-gray-500 text-sm">Purchased in Delhi</p>
              </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="min-w-[calc(33.333%-1rem)] p-4">
              <div class="bg-white rounded-xl shadow-lg p-6 h-full">
                <div class="flex items-center mb-6">
                  <img src="https://randomuser.me/api/portraits/women/1.jpg" alt="Sarah Johnson"
                    class="w-14 h-14 rounded-full object-cover mr-4">
                  <div>
                    <h3 class="font-semibold text-lg">Sarah Johnson</h3>
                    <p class="text-gray-600">Property Investor</p>
                  </div>
                </div>
                <p class="text-gray-700 italic mb-4">"Professional service and excellent investment opportunities.
                  Highly recommended!"</p>
                <p class="text-gray-500 text-sm">Invested in Mumbai</p>
              </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="min-w-[calc(33.333%-1rem)] p-4">
              <div class="bg-white rounded-xl shadow-lg p-6 h-full">
                <div class="flex items-center mb-6">
                  <img src="https://randomuser.me/api/portraits/men/2.jpg" alt="Michael Chen"
                    class="w-14 h-14 rounded-full object-cover mr-4">
                  <div>
                    <h3 class="font-semibold text-lg">Michael Chen</h3>
                    <p class="text-gray-600">First-time Buyer</p>
                  </div>
                </div>
                <p class="text-gray-700 italic mb-4">"The team made my first home buying experience smooth and
                  stress-free!"</p>
                <p class="text-gray-500 text-sm">Purchased in Bengaluru</p>
              </div>
            </div>

            <!-- Testimonial 4 -->
            <div class="min-w-[calc(33.333%-1rem)] p-4">
              <div class="bg-white rounded-xl shadow-lg p-6 h-full">
                <div class="flex items-center mb-6">
                  <img src="https://randomuser.me/api/portraits/women/2.jpg" alt="Emma Wilson"
                    class="w-14 h-14 rounded-full object-cover mr-4">
                  <div>
                    <h3 class="font-semibold text-lg">Emma Wilson</h3>
                    <p class="text-gray-600">Luxury Home Buyer</p>
                  </div>
                </div>
                <p class="text-gray-700 italic mb-4">"Found my perfect luxury villa thanks to their exceptional
                  service!"</p>
                <p class="text-gray-500 text-sm">Purchased in Jaipur</p>
              </div>
            </div>

            <!-- Testimonial 5 -->
            <div class="min-w-[calc(33.333%-1rem)] p-4">
              <div class="bg-white rounded-xl shadow-lg p-6 h-full">
                <div class="flex items-center mb-6">
                  <img src="https://randomuser.me/api/portraits/men/3.jpg" alt="Raj Patel"
                    class="w-14 h-14 rounded-full object-cover mr-4">
                  <div>
                    <h3 class="font-semibold text-lg">Raj Patel</h3>
                    <p class="text-gray-600">Property Seller</p>
                  </div>
                </div>
                <p class="text-gray-700 italic mb-4">"Got the best value for my property. Their market knowledge is
                  outstanding!"</p>
                <p class="text-gray-500 text-sm">Sold in Mumbai</p>
              </div>
            </div>

            <!-- Testimonial 6 -->
            <div class="min-w-[calc(33.333%-1rem)] p-4">
              <div class="bg-white rounded-xl shadow-lg p-6 h-full">
                <div class="flex items-center mb-6">
                  <img src="https://randomuser.me/api/portraits/women/3.jpg" alt="Priya Sharma"
                    class="w-14 h-14 rounded-full object-cover mr-4">
                  <div>
                    <h3 class="font-semibold text-lg">Priya Sharma</h3>
                    <p class="text-gray-600">Real Estate Agent</p>
                  </div>
                </div>
                <p class="text-gray-700 italic mb-4">"Great platform for agents. The tools and support are exceptional!"
                </p>
                <p class="text-gray-500 text-sm">Partner Agent</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Next Button -->
        <button
          class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white/80 p-2 rounded-full shadow-lg hover:bg-white transition-all duration-200 -mr-4 hidden md:block"
          id="nextButton">
          <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </button>

        <!-- Navigation Dots -->
        <div class="flex justify-center gap-2 mt-8" id="sliderDots"></div>
      </div>
    </div>
  </section>

  <!-- Newsletter Section -->
  

  <!-- Footer Section -->
  <footer class="bg-gray-900 text-gray-300">
    <!-- Main Footer -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Company Info -->
        <div class="space-y-4">
          <div class="flex items-center space-x-2">
            <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
              <path
                d="M12.71 2.29a1 1 0 00-1.42 0l-9 9a1 1 0 000 1.42A1 1 0 003 13h1v7a2 2 0 002 2h12a2 2 0 002-2v-7h1a1 1 0 00.71-1.71l-9-9zM9 20v-5a1 1 0 011-1h4a1 1 0 011 1v5H9zm10-8h-1v7h-2v-5a3 3 0 00-3-3h-4a3 3 0 00-3 3v5H4v-7H3l9-9 9 9z" />
            </svg>
            <span class="text-xl font-bold text-white">RealEstate</span>
          </div>
          <p class="text-sm text-gray-400 leading-relaxed">
            Your trusted partner in finding the perfect property. We make real estate simple, efficient, and accessible
            to everyone.
          </p>
          <!-- Social Media Icons -->
          <div class="flex space-x-4">
            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
              <span class="sr-only">Facebook</span>
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
              </svg>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
              <span class="sr-only">Instagram</span>
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" />
              </svg>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
              <span class="sr-only">Twitter</span>
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
              </svg>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
              <span class="sr-only">LinkedIn</span>
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
              </svg>
            </a>
          </div>
        </div>

        <!-- Quick Links -->
        <div>
          <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Quick Links</h3>
          <ul class="space-y-2 text-sm">
            <li><a href="index.php" class="text-gray-400 hover:text-white transition-colors duration-300">Home</a></li>
            <li><a href="properties.php" class="text-gray-400 hover:text-white transition-colors duration-300">Properties</a></li>
            <li><a href="about.php" class="text-gray-400 hover:text-white transition-colors duration-300">About Us</a></li>
            <li><a href="blog-details.html" class="text-gray-400 hover:text-white transition-colors duration-300">Blog</a></li>
            <li><a href="contact.php" class="text-gray-400 hover:text-white transition-colors duration-300">Contact</a></li>
          </ul>
        </div>

        <!-- Contact Info -->
        <div>
          <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Contact Info</h3>
          <ul class="space-y-3 text-sm">
            <li class="flex items-start space-x-3">
              <svg class="w-5 h-5 text-gray-400 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              <span class="text-gray-400">123 Real Estate Street<br>City, State 12345</span>
            </li>
            <li class="flex items-center space-x-3">
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
              </svg>
              <span class="text-gray-400">(555) 123-4567</span>
            </li>
            <li class="flex items-center space-x-3">
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
              <span class="text-gray-400">info@realestate.com</span>
            </li>
          </ul>
        </div>

        <!-- Newsletter -->
       

    <!-- Bottom Footer -->
    <div class="border-t border-gray-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div
          class="flex flex-col md:flex-row justify-between items-center space-y-2 md:space-y-0 text-xs text-gray-400">
          <p>&copy; 2024 RealEstate. All rights reserved.</p>
          <div class="flex space-x-6">
            <a href="#" class="hover:text-white transition-colors duration-300">Privacy Policy</a>
            <a href="#" class="hover:text-white transition-colors duration-300">Terms of Service</a>
            <a href="#" class="hover:text-white transition-colors duration-300">Cookie Policy</a>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Floating Contact Button (Mobile) -->
  <div class="fixed bottom-6 right-6 md:hidden">
    <button
      class="bg-primary text-white w-14 h-14 rounded-full shadow-lg flex items-center justify-center hover:bg-primary-dark transition-colors">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
      </svg>
    </button>
  </div>

  <!-- Profile Modal -->
  <div id="profileModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="min-h-screen flex items-center justify-center p-4">
      <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-2xl font-semibold">User Profile</h2>
          <button onclick="closeProfileModal()" class="text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="space-y-6">
          <!-- Profile Picture -->
          <div class="flex justify-center">
            <?php if ($isLoggedIn): ?>
            <div class="h-24 w-24 rounded-full bg-blue-600 overflow-hidden flex items-center justify-center text-white text-4xl font-bold">
              <?php echo htmlspecialchars($userInitial); ?>
            </div>
            <?php else: ?>
            <div class="h-24 w-24 rounded-full bg-gray-200 overflow-hidden">
              <svg class="w-full h-full text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 14.75c2.67 0 8 1.34 8 4v1.25H4v-1.25c0-2.66 5.33-4 8-4zm0-9.5c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4z" />
              </svg>
            </div>
            <?php endif; ?>
          </div>
          
          <!-- User Info -->
          <div class="text-center">
            <h3 class="text-xl font-bold text-gray-900"><?php echo htmlspecialchars($userName); ?></h3>
            <p class="text-gray-600 mt-1"><?php echo htmlspecialchars($userEmail); ?></p>
            <p class="text-gray-600 mt-1 capitalize"><?php echo isset($_SESSION['role']) ? htmlspecialchars($_SESSION['role']) : 'Role not set'; ?></p>
          </div>
          
          <!-- User Stats -->
          <div class="grid grid-cols-3 gap-4 mt-6">
            <div class="bg-gray-50 p-3 rounded-lg text-center">
              <h4 class="text-sm font-medium text-gray-700">Saved Properties</h4>
              <p class="text-xl font-bold text-blue-600 mt-1">12</p>
            </div>
            <div class="bg-gray-50 p-3 rounded-lg text-center">
              <h4 class="text-sm font-medium text-gray-700">Notifications</h4>
              <p class="text-xl font-bold text-blue-600 mt-1">5</p>
            </div>
            <div class="bg-gray-50 p-3 rounded-lg text-center">
              <h4 class="text-sm font-medium text-gray-700">Appointments</h4>
              <p class="text-xl font-bold text-blue-600 mt-1"><?= $appointmentCount ?></p>
            </div>
          </div>
          
          <!-- Quick Links -->
          <div class="space-y-2">
            <a href="my-properties.php" class="block w-full text-left px-4 py-2 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
              <div class="flex items-center">
                <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span>My Properties</span>
              </div>
            </a>
            <a href="appointments.php" class="block w-full text-left px-4 py-2 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
              <div class="flex items-center">
                <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>My Appointments</span>
              </div>
            </a>
            <a href="#" class="block w-full text-left px-4 py-2 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
              <div class="flex items-center">
                <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>Account Settings</span>
              </div>
            </a>
          </div>
          
          <!-- Logout Button -->
          <?php if ($isLoggedIn): ?>
          <a href="../signUpLogin/logout.php" class="w-full bg-red-100 text-red-600 py-2 rounded-lg hover:bg-red-200 transition-colors mt-4 block text-center">
            <div class="flex items-center justify-center">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
              </svg>
              <span>Logout</span>
            </div>
          </a>
          <?php else: ?>
          <a href="../signUpLogin/login.html" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors mt-4 block text-center">
            <div class="flex items-center justify-center">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
              </svg>
              <span>Login</span>
            </div>
          </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Login Modal -->
  <div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="min-h-screen flex items-center justify-center p-4">
      <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-2xl font-semibold">Login</h2>
          <button onclick="closeLoginModal()" class="text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <form class="space-y-4" action="../signUpLogin/processLogin.php" method="POST">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" name="password" required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          </div>
          <div class="flex items-center justify-between">
            <label class="flex items-center">
              <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
              <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>
            <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Forgot password?</a>
          </div>
          <button type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors">
            Login
          </button>
        </form>
        <div class="mt-4 text-center text-sm text-gray-600">
          Don't have an account?
          <a href="../signUpLogin/signup.html" class="text-blue-600 hover:text-blue-800">Sign up</a>
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const loginModal = document.getElementById('loginModal');

    mobileMenuBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', (e) => {
      if (!mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
        mobileMenu.classList.add('hidden');
      }
    });

    // Login modal functions
    function openLoginModal() {
      loginModal.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }

    function closeLoginModal() {
      loginModal.classList.add('hidden');
      document.body.style.overflow = 'auto';
    }
    
    // Profile modal functions
    const profileModal = document.getElementById('profileModal');
    
    function openProfileModal() {
      profileModal.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }
    
    function closeProfileModal() {
      profileModal.classList.add('hidden');
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

    // Hero Slider
    const heroSlider = document.getElementById('heroSlider');
    const images = [
      'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxfDB8MXxyYW5kb218MHx8aG91c2V8fHx8fHwxNjgzNDcyNjIw&ixlib=rb-4.0.3&q=80&w=1080',
      'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxfDB8MXxyYW5kb218MHx8aG91c2V8fHx8fHwxNjgzNDcyNjIw&ixlib=rb-4.0.3&q=80&w=1080',
      'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxfDB8MXxyYW5kb218MHx8aG91c2V8fHx8fHwxNjgzNDcyNjIw&ixlib=rb-4.0.3&q=80&w=1080'
    ];

    let currentSlide = 0;

    function createSlide(imageUrl) {
      const img = document.createElement('img');
      img.src = imageUrl;
      img.className = 'absolute inset-0 w-full h-full object-cover transition-opacity duration-200 z-0';
      return img;
    }

    function nextSlide() {
      const currentImg = heroSlider.querySelector('img');
      currentSlide = (currentSlide + 1) % images.length;
      const newImg = createSlide(images[currentSlide]);
      newImg.style.opacity = '0';
      heroSlider.appendChild(newImg);

      setTimeout(() => {
        newImg.style.opacity = '1';
        if (currentImg) {
          currentImg.style.opacity = '0';
          setTimeout(() => currentImg.remove(), 500);
        }
      }, 50);
    }

    // Initialize first slide
    heroSlider.appendChild(createSlide(images[0]));

    // Auto-advance slides
    setInterval(nextSlide, 5000);

    // Lazy loading images
    document.addEventListener('DOMContentLoaded', () => {
      const images = document.querySelectorAll('img[data-src]');
      const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const img = entry.target;
            img.src = img.dataset.src;
            img.removeAttribute('data-src');
            observer.unobserve(img);
          }
        });
      });

      images.forEach(img => imageObserver.observe(img));
    });

    document.addEventListener('DOMContentLoaded', function () {
      const slider = document.getElementById('testimonialSlider').firstElementChild;
      const slides = slider.children;
      const dotsContainer = document.getElementById('sliderDots');
      const prevButton = document.getElementById('prevButton');
      const nextButton = document.getElementById('nextButton');

      let currentGroup = 0;
      const slidesPerGroup = 3;
      const totalGroups = Math.ceil(slides.length / slidesPerGroup);
      const slideInterval = 5000; // 5 seconds

      // Create navigation dots
      for (let i = 0; i < totalGroups; i++) {
        const dot = document.createElement('button');
        dot.className = `w-3 h-3 rounded-full transition-all duration-200 ${i === 0 ? 'bg-blue-600' : 'bg-gray-300'}`;
        dot.onclick = () => goToGroup(i);
        dotsContainer.appendChild(dot);
      }

      function updateSlider() {
        const offset = currentGroup * (100 / slidesPerGroup);
        slider.style.transform = `translateX(-${offset}%)`;

        // Update dots
        const dots = dotsContainer.children;
        for (let i = 0; i < dots.length; i++) {
          dots[i].className = `w-3 h-3 rounded-full transition-all duration-200 ${i === currentGroup ? 'bg-blue-600' : 'bg-gray-300'}`;
        }
      }

      function nextGroup() {
        currentGroup = (currentGroup + 1) % totalGroups;
        updateSlider();
      }

      function previousGroup() {
        currentGroup = (currentGroup - 1 + totalGroups) % totalGroups;
        updateSlider();
      }

      function goToGroup(groupIndex) {
        currentGroup = groupIndex;
        updateSlider();
      }

      // Event listeners for navigation buttons
      prevButton.addEventListener('click', () => {
        previousGroup();
        resetInterval();
      });

      nextButton.addEventListener('click', () => {
        nextGroup();
        resetInterval();
      });

      // Auto advance slides
      let slideTimer = setInterval(nextGroup, slideInterval);

      function resetInterval() {
        clearInterval(slideTimer);
        slideTimer = setInterval(nextGroup, slideInterval);
      }

      // Initial setup
      updateSlider();

      // Responsive handling
      window.addEventListener('resize', updateSlider);
    });
  </script>

  <!-- Optional: Add custom scrollbar styling -->
  <style>
    /* Hide scrollbar but maintain functionality */
    .scrollbar-hide {
      -ms-overflow-style: none;
      /* IE and Edge */
      scrollbar-width: none;
      /* Firefox */
    }

    .scrollbar-hide::-webkit-scrollbar {
      display: none;
      /* Chrome, Safari and Opera */
    }

    .slider-container {
      overflow: hidden;
    }

    .slider-container>div {
      transition: transform 0.5s ease-in-out;
    }

    @media (max-width: 768px) {
      .min-w-[calc(33.333%-1rem)] {
        min-width: calc(100% - 2rem);
      }
    }

    @media (min-width: 769px) and (max-width: 1024px) {
      .min-w-[calc(33.333%-1rem)] {
        min-width: calc(50% - 1rem);
      }
    }
  </style>
</body>

</html>