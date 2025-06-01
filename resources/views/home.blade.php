<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home | Watashi Travel</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="font-sans text-gray-800">

<!-- Header -->
<header class="absolute w-full z-10">
  <div class="container mx-auto flex justify-between items-center px-6 py-4">
    <div class="text-2xl font-bold text-white">WATASHI TRAVEL</div>
    <nav class="flex items-center space-x-6 text-white text-sm">
      <a href="#" class="hover:underline">Press Release</a>
      <a href="#" class="hover:underline">Articles</a>
      <a href="#" class="hover:underline">Events</a>
      <div class="ml-8 flex space-x-6">
        <a href="{{ url('/home') }}" class="font-semibold border-b-2 border-white">Home</a>
        <a href="{{ url('/services') }}" class="hover:text-gray-200">Services</a>
        <a href="{{ url('/about') }}" class="hover:text-gray-200">About Us</a>
        <a href="{{ url('/contact') }}" class="hover:text-gray-200">Contact Us</a>
      </div>
      <div class="ml-8 flex items-center space-x-4">
        <a href="#" class="hover:underline">ENG</a><span>|</span><a href="#" class="hover:underline">ID</a>
        <a href="#" class="bg-white text-indigo-600 font-semibold px-4 py-1 rounded-full">Registrasi</a>
        <a href="#" class="bg-white text-indigo-600 font-semibold px-4 py-1 rounded-full">Login</a>
      </div>
    </nav>
  </div>
</header>

<!-- Hero Section with Custom Background -->
<section class="h-screen bg-cover bg-center relative" style="background-image: url('{{ asset('img/baground.home.png') }}');">
  <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-center items-center text-center px-4">
    <h1 class="text-4xl md:text-6xl font-bold text-white mb-4">Discover Your Next Adventure <br> with Watashi Travel</h1>
    <p class="text-lg text-gray-200 mb-6 max-w-2xl">At Watashi Travel, we curate unforgettable experiences that connect you with the beauty of Indonesia. Join us as we explore breathtaking landscapes and rich cultural heritage.</p>
    <a href="#" class="bg-white text-teal-600 font-semibold px-6 py-3 rounded-full hover:bg-gray-100 transition">View Packages</a>
  </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-white py-6">
  <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center">
    <p class="text-sm">&copy; 2025 Watashi Travel. All rights reserved.</p>
    <div class="space-x-4 text-sm mt-4 md:mt-0">
      <a href="#" class="hover:underline">Privacy Policy</a>
      <a href="#" class="hover:underline">Terms of Service</a>
    </div>
  </div>
</footer>

</body>
</html>