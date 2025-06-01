<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us | Watashi Travel</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans text-gray-800">

<!-- Header -->
<header class="bg-white shadow-md">
  <div class="container mx-auto flex justify-between items-center px-4 py-3">
    <div class="text-2xl font-bold text-indigo-600">Watashi Travel</div>
    <nav class="space-x-4">
      <a href="{{ url('/home') }}" class="text-gray-600 hover:text-indigo-600">Home</a>
      <a href="{{ url('/about') }}" class="text-gray-600 hover:text-indigo-600">About Us</a>
      <a href="{{ url('/destinations') }}" class="text-gray-600 hover:text-indigo-600">Destinations</a>
      <a href="{{ url('/contact') }}" class="text-indigo-600 font-semibold">Contact</a>
    </nav>
  </div>
</header>

<!-- Contact Section -->
<section class="py-20 bg-gray-50">
  <div class="container mx-auto px-4 max-w-7xl">
    <div class="text-center mb-12">
      <h2 class="text-3xl font-semibold text-gray-800">Hubungi Kami</h2>
      <p class="text-gray-600 mt-2 max-w-xl mx-auto">Ada pertanyaan atau ingin merencanakan perjalanan? Silakan hubungi kami melalui form atau info di bawah.</p>
    </div>

    <div class="grid md:grid-cols-2 gap-10">
      <!-- Form -->
      <form class="bg-white p-8 rounded-xl shadow-md space-y-6">
        <div>
          <label class="block text-sm font-medium mb-1">Nama</label>
          <input type="text" placeholder="Nama Anda" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Email</label>
          <input type="email" placeholder="email@example.com" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Subjek</label>
          <input type="text" placeholder="Subjek Pesan" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Pesan</label>
          <textarea rows="5" placeholder="Tulis pesan Anda..." class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
        </div>
        <button type="submit" class="w-full bg-indigo-600 text-white font-semibold px-6 py-3 rounded-md hover:bg-indigo-700 transition">Kirim Pesan</button>
      </form>

      <!-- Contact Info -->
      <div class="space-y-6 text-gray-700">
        <div class="bg-white p-6 rounded-xl shadow-md">
          <h3 class="text-xl font-semibold mb-2">Alamat</h3>
          <p>Jl. Sakura No.12, Tokyo, Jepang</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md">
          <h3 class="text-xl font-semibold mb-2">Telepon</h3>
          <p>+81 123 4567 890</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md">
          <h3 class="text-xl font-semibold mb-2">Email</h3>
          <p>info@watashitravel.jp</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-white py-6 mt-12">
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
