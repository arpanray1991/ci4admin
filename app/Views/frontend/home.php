<?= $this->extend('layouts/frontend/layout') ?>

<?= $this->section('content') ?>

<div class="bg-gradient-to-b from-blue-100 to-white flex justify-center items-start w-full p-4 gap-6">
  <div class="w-2/3 max-w-4xl text-center">
    <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-4">
      Easily create a <span class="text-blue-600">QR code</span> for any occasion in seconds!
    </h1>

    <!-- Form -->
    <div class="bg-white shadow-md rounded-lg p-6 mt-8">
      <div class="flex flex-col sm:flex-row items-center gap-4">
        <input 
          type="text" 
          placeholder="https://website.com"
          class="flex-1 px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
          id="qr_text"
        />
        <button onclick="generateQr()"
          class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition"
        >
          Generate QR Code
        </button>
      </div>

      <p class="text-sm text-gray-500 mt-2 text-left sm:text-center">
        Your QR code will open this URL
      </p>
    </div>

    <!-- Grid -->
    <div class="mt-12">
      <div class="text-lg font-semibold mb-4">Or select another type of QR code</div>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        
        <!-- Card -->
        <div class="bg-white shadow rounded-lg p-4 text-center hover:shadow-lg transition">
          <div class="text-blue-600 text-4xl mb-2">📄</div>
          <div class="font-bold text-lg">PDF</div>
          <div class="text-sm text-gray-500">Show a PDF</div>
        </div>

        <div class="bg-white shadow rounded-lg p-4 text-center hover:shadow-lg transition">
          <div class="text-blue-600 text-4xl mb-2">🔗</div>
          <div class="font-bold text-lg">List of Links</div>
          <div class="text-sm text-gray-500">Share multiple links</div>
        </div>

        <div class="bg-white shadow rounded-lg p-4 text-center hover:shadow-lg transition">
          <div class="text-blue-600 text-4xl mb-2">💳</div>
          <div class="font-bold text-lg">vCard</div>
          <div class="text-sm text-gray-500">Share a digital business card</div>
        </div>

        <div class="bg-white shadow rounded-lg p-4 text-center hover:shadow-lg transition">
          <div class="text-blue-600 text-4xl mb-2">🏢</div>
          <div class="font-bold text-lg">Business</div>
          <div class="text-sm text-gray-500">Share business info</div>
        </div>
      </div>
    </div>
  </div>
  <div class="w-1/3 bg-white border p-6 rounded shadow">
    <div class="flex flex-col items-center space-y-4 p-6 bg-white rounded-lg shadow w-full max-w-sm">
    <!-- QR Code Preview Box -->
    <div class="max-w-4xl bg-gray-100 border-2 border-dashed border-gray-300 flex items-center justify-center rounded">
        
        <!-- Example QR Icon (You can replace this with actual QR image) -->
            <!--<img src="<?= base_url('/assets/images/qr_demo.png') ?>" alt="QR Code" class="w-48 h-48"/>-->
            <img id="qr_image" src="<?= base_url('qr/' . urlencode('https://example.com')) ?>" alt="QR Code" class="w-48 h-48">
        
    </div>

    <!-- Download Button -->
    <button class="w-full flex items-center justify-center px-4 py-2 bg-gray-300 text-white font-semibold rounded disabled:opacity-60" disabled>
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v12a1 1 0 11-2 0V4H4v12h4a1 1 0 110 2H4a2 2 0 01-2-2V3zm9 10a1 1 0 00-2 0v3.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L12 16.586V13z" clip-rule="evenodd" />
        </svg>
        Download QR Code
    </button>
    </div>
  </div>
</div>

<?= $this->endSection() ?>