<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Our Services - RealEstate</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .service-card {
      display: none;
      opacity: 0;
      transform: translateY(20px);
      transition: all 0.5s ease;
    }
    .service-card.show {
      display: block;
      opacity: 1;
      transform: translateY(0);
    }
    .filter-btn.active {
     
     
    }
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
  </style>
  <?php include 'includes/animations.php'; ?>
</head>

<body class="bg-gray-50 text-black">
  <?php include 'includes/navbar.php'; ?>

  <!-- Hero Section -->
 
  <div class="">
    <!-- Services Hero Section -->
    <section class="relative bg-gradient-to-r from-slate-900 via-blue-900 to-indigo-900 text-white py-28">
      <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2" alt="Luxury Real Estate Services"
          class="w-full h-full object-cover opacity-60 filter saturate-150 hover-bright">
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/50 to-transparent"></div>
      </div>
      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-pink-200 mb-6 scroll-animate" data-animation="animate-fade-in">Our Services</h1>
        <p class="text-xl text-gray-200 max-w-3xl mx-auto mb-4 scroll-animate" data-animation="animate-slide-up">Comprehensive real estate solutions tailored to your needs</p>
        <p class="text-lg text-gray-300 max-w-3xl mx-auto mb-8 scroll-animate" data-animation="animate-slide-up" data-delay="delay-200">From property management to investment consulting, we offer a wide range of services to help you achieve your real estate goals.</p>
        <div class="flex flex-wrap justify-center gap-4 scroll-animate" data-animation="animate-slide-up" data-delay="delay-300">
          <a href="#property-management" class="px-6 py-3 bg-white/10 backdrop-blur-sm rounded-full text-white hover:bg-white/20 transition-all duration-300 border border-white/30 hover-lift">
            Property Management
          </a>
          <a href="contact.php" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full text-white hover:from-blue-600 hover:to-purple-600 transition-all duration-300 shadow-lg hover:shadow-xl hover-lift">
            Get Started
          </a>
        </div>
      </div>
  
  </div>
   
  </section>

  <!-- Services Grid -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Property Sales -->
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 animate-fade-in">
          <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Property Sales</h3>
          <p class="text-gray-600 mb-4">Expert guidance through the entire property buying and selling process, from market analysis to closing deals.</p>
          <ul class="text-gray-600 space-y-2">
            <li class="flex items-center"><span class="mr-2">•</span>Market value assessment</li>
            <li class="flex items-center"><span class="mr-2">•</span>Property listing optimization</li>
            <li class="flex items-center"><span class="mr-2">•</span>Negotiation support</li>
            <li class="flex items-center"><span class="mr-2">•</span>Transaction management</li>
          </ul>
        </div>

        <!-- Property Rental -->
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 animate-fade-in" style="animation-delay: 0.1s;">
          <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Property Rental</h3>
          <p class="text-gray-600 mb-4">Comprehensive rental services for both landlords and tenants, ensuring smooth and profitable tenancies.</p>
          <ul class="text-gray-600 space-y-2">
            <li class="flex items-center"><span class="mr-2">•</span>Tenant screening</li>
            <li class="flex items-center"><span class="mr-2">•</span>Lease preparation</li>
            <li class="flex items-center"><span class="mr-2">•</span>Rent collection</li>
            <li class="flex items-center"><span class="mr-2">•</span>Property inspections</li>
          </ul>
        </div>

        <!-- Property Management -->
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 animate-fade-in" style="animation-delay: 0.2s;">
          <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Property Management</h3>
          <p class="text-gray-600 mb-4">Full-service property management solutions for residential and commercial properties.</p>
          <ul class="text-gray-600 space-y-2">
            <li class="flex items-center"><span class="mr-2">•</span>Maintenance coordination</li>
            <li class="flex items-center"><span class="mr-2">•</span>Financial reporting</li>
            <li class="flex items-center"><span class="mr-2">•</span>Vendor management</li>
            <li class="flex items-center"><span class="mr-2">•</span>24/7 emergency support</li>
          </ul>
        </div>

        <!-- Investment Consulting -->
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 animate-fade-in" style="animation-delay: 0.3s;">
          <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Investment Consulting</h3>
          <p class="text-gray-600 mb-4">Strategic investment advice and portfolio management for real estate investors.</p>
          <ul class="text-gray-600 space-y-2">
            <li class="flex items-center"><span class="mr-2">•</span>Market analysis</li>
            <li class="flex items-center"><span class="mr-2">•</span>Investment strategy</li>
            <li class="flex items-center"><span class="mr-2">•</span>Portfolio optimization</li>
            <li class="flex items-center"><span class="mr-2">•</span>ROI forecasting</li>
          </ul>
        </div>

        <!-- Property Valuation -->
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 animate-fade-in" style="animation-delay: 0.4s;">
          <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Property Valuation</h3>
          <p class="text-gray-600 mb-4">Professional property valuation services using advanced market analysis tools.</p>
          <ul class="text-gray-600 space-y-2">
            <li class="flex items-center"><span class="mr-2">•</span>Comparative market analysis</li>
            <li class="flex items-center"><span class="mr-2">•</span>Property inspection</li>
            <li class="flex items-center"><span class="mr-2">•</span>Value estimation</li>
            <li class="flex items-center"><span class="mr-2">•</span>Detailed reporting</li>
          </ul>
        </div>

        <!-- Legal Services -->
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 animate-fade-in" style="animation-delay: 0.5s;">
          <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Legal Services</h3>
          <p class="text-gray-600 mb-4">Expert legal assistance for all real estate transactions and disputes.</p>
          <ul class="text-gray-600 space-y-2">
            <li class="flex items-center"><span class="mr-2">•</span>Contract review</li>
            <li class="flex items-center"><span class="mr-2">•</span>Due diligence</li>
            <li class="flex items-center"><span class="mr-2">•</span>Title search</li>
            <li class="flex items-center"><span class="mr-2">•</span>Legal documentation</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Why Choose Us Section -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Why Choose Us</h2>
        <p class="text-xl text-gray-600">Experience the difference of working with industry leaders</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="text-center">
          <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Expertise</h3>
          <p class="text-gray-600">Over a decade of experience in real estate services</p>
        </div>
        <div class="text-center">
          <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Efficiency</h3>
          <p class="text-gray-600">Quick response times and streamlined processes</p>
        </div>
        <div class="text-center">
          <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Client Focus</h3>
          <p class="text-gray-600">Personalized attention to every client's needs</p>
        </div>
      </div>
    </div>
  </section>
    <!-- Footer -->
  <footer class="bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div class="space-y-4">
          <div class="flex items-center space-x-2">
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
          
          <?php if ($isLoggedIn): ?>
            <div class="text-center mb-6">
              <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-3xl font-bold text-blue-600"><?php echo $userInitial; ?></span>
              </div>
              <h4 class="text-xl font-semibold text-gray-800"><?php echo $userName; ?></h4>
              <p class="text-gray-600"><?php echo $userEmail; ?></p>
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