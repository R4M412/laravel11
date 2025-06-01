<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us | Watashi Travel</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="font-sans text-gray-800">

  <!-- Header -->
  <header class="bg-white shadow-md">
    <div class="container mx-auto flex justify-between items-center px-4 py-3">
      <div class="text-2xl font-bold text-indigo-600">Watashi Travel</div>
      <nav class="space-x-4">
        <a href="{{ url('/home') }}" class="text-indigo-600 font-semibold">Home</a>
        <a href="{{ url('/about') }}" class="text-gray-600 hover:text-indigo-600">About Us</a>
        <a href="{{ url('/destinations') }}" class="text-gray-600 hover:text-indigo-600">Destinations</a>
        <a href="{{ url('/contact') }}" class="text-gray-600 hover:text-indigo-600">Contact</a>
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="bg-cover bg-center h-96" style="background-image: url('https://source.unsplash.com/featured/?travel')">
    <div class="bg-black bg-opacity-50 h-full flex items-center justify-center">
      <h1 class="text-white text-4xl md:text-6xl font-bold">About Us</h1>
    </div>
  </section>

  <!-- About Content -->
  <section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 md:px-8">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-semibold text-gray-800">Who We Are</h2>
        <p class="mt-4 text-gray-600">Watashi Travel is a passionate team of travel enthusiasts dedicated to making your dream vacations come true.</p>
      </div>

      <div class="grid md:grid-cols-2 gap-10 items-center">
        <img src="https://source.unsplash.com/600x400/?team,travel" alt="Our Team" class="rounded-xl shadow-lg" />
        <div>
          <h3 class="text-2xl font-bold mb-4">Our Mission</h3>
          <p class="text-gray-600 mb-4">
            We aim to create unforgettable travel experiences by providing top-notch service, curated destinations, and a seamless journey for every traveler.
          </p>
          <h3 class="text-2xl font-bold mb-4">Why Choose Us</h3>
          <ul class="list-disc pl-6 text-gray-600 space-y-2">
            <li>Experienced and friendly team</li>
            <li>Unique and curated travel experiences</li>
            <li>Customer satisfaction guaranteed</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-white border-t mt-12">
    <div class="container mx-auto px-4 py-6 flex justify-between text-sm text-gray-600">
      <p>&copy; 2025 Watashi Travel. All rights reserved.</p>
      <div class="space-x-4">
        <a href="#" class="hover:underline">Privacy Policy</a>
        <a href="#" class="hover:underline">Terms</a>
      </div>
    </div>
  </footer>

  <!-- Visi dan Misi -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 md:px-8">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-semibold text-gray-800">Visi & Misi</h2>
      </div>
      <div class="md:flex md:space-x-10 space-y-10 md:space-y-0">
        <div class="md:w-1/2 bg-indigo-50 p-6 rounded-lg shadow-md">
          <h3 class="text-xl font-bold text-indigo-700 mb-2">Visi</h3>
          <p class="text-gray-700">
            Menjadi perusahaan travel terpercaya di Asia yang dikenal karena layanan terbaik, inovasi, dan pengalaman pelanggan yang luar biasa.
          </p>
        </div>
        <div class="md:w-1/2 bg-indigo-50 p-6 rounded-lg shadow-md">
          <h3 class="text-xl font-bold text-indigo-700 mb-2">Misi</h3>
          <ul class="list-disc pl-5 text-gray-700 space-y-2">
            <li>Memberikan pengalaman perjalanan yang aman, nyaman, dan menyenangkan.</li>
            <li>Menghadirkan destinasi yang unik dan tak terlupakan.</li>
            <li>Membangun hubungan jangka panjang dengan pelanggan melalui pelayanan yang profesional.</li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Kenapa Memilih Kami -->
  <section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 md:px-8 text-center">
      <h2 class="text-3xl font-semibold text-gray-800 mb-8">Kenapa Memilih Watashi Travel?</h2>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="p-6 bg-white rounded-xl shadow-lg">
          <img src="https://img.icons8.com/ios-filled/50/4a90e2/airplane-take-off.png" class="mx-auto mb-4" alt="Airplane icon" />
          <h3 class="text-xl font-bold mb-2">Layanan Terpercaya</h3>
          <p class="text-gray-600">Kami berpengalaman menangani ribuan perjalanan domestik dan internasional.</p>
        </div>
        <div class="p-6 bg-white rounded-xl shadow-lg">
          <img src="https://img.icons8.com/ios-filled/50/4a90e2/globe--v1.png" class="mx-auto mb-4" alt="Globe icon" />
          <h3 class="text-xl font-bold mb-2">Destinasi Global</h3>
          <p class="text-gray-600">Kami menawarkan berbagai destinasi eksotis dari seluruh dunia.</p>
        </div>
        <div class="p-6 bg-white rounded-xl shadow-lg">
          <img src="https://img.icons8.com/ios-filled/50/4a90e2/headset.png" class="mx-auto mb-4" alt="Support icon" />
          <h3 class="text-xl font-bold mb-2">Support 24/7</h3>
          <p class="text-gray-600">Tim kami siap membantu kapan pun Anda butuh bantuan.</p>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Tim Kami -->
  <section class="py-16 bg-white">
    <div class="container mx-auto px-4 md:px-8 text-center">
      <h2 class="text-3xl font-semibold text-gray-800 mb-12">Tim Kami</h2>
      <div class="grid md:grid-cols-3 gap-8">
        <!-- Card Anggota Tim -->
        <div class="bg-gray-50 p-6 rounded-xl shadow-md">
          <img src="https://source.unsplash.com/200x200/?person,1" alt="Team member" class="rounded-full mx-auto mb-4" />
          <h3 class="text-lg font-bold text-gray-800">Yuki Tanaka</h3>
          <p class="text-indigo-600">CEO & Founder</p>
          <p class="text-gray-600 mt-2">Berpengalaman lebih dari 10 tahun di industri pariwisata global.</p>
        </div>
        <div class="bg-gray-50 p-6 rounded-xl shadow-md">
          <img src="https://source.unsplash.com/200x200/?person,2" alt="Team member" class="rounded-full mx-auto mb-4" />
          <h3 class="text-lg font-bold text-gray-800">Hiroshi Sato</h3>
          <p class="text-indigo-600">Head of Operations</p>
          <p class="text-gray-600 mt-2">Memastikan setiap perjalanan Anda berjalan dengan lancar dan aman.</p>
        </div>
        <div class="bg-gray-50 p-6 rounded-xl shadow-md">
          <img src="https://source.unsplash.com/200x200/?person,3" alt="Team member" class="rounded-full mx-auto mb-4" />
          <h3 class="text-lg font-bold text-gray-800">Emiko Nakamura</h3>
          <p class="text-indigo-600">Customer Support</p>
          <p class="text-gray-600 mt-2">Selalu siap membantu pelanggan dengan sepenuh hati.</p>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Call to Action -->
  <section class="py-16 bg-indigo-600 text-white text-center">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl font-semibold mb-4">Siap Menjelajahi Dunia Bersama Watashi Travel?</h2>
      <p class="mb-6 text-lg">Ayo rencanakan perjalanan Anda hari ini juga!</p>
      <a href="contact.html" class="inline-block bg-white text-indigo-600 font-semibold px-6 py-3 rounded-full hover:bg-gray-100 transition">
        Hubungi Kami
      </a>
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
