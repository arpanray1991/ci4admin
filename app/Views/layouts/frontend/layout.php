<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= isset($title) ? esc($title) : 'My CI4 App' ?></title>
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url('assets/js/common.js') ?>"></script>
    <!-- You can add additional CSS or fonts here -->
</head>
<body class="bg-gray-50 min-h-screen font-sans text-gray-900" data-base-url="<?= base_url() ?>">

    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="<?= base_url() ?>" class="text-2xl font-bold text-blue-600">Markytek QR App</a>
            <nav class="space-x-4">
                <a href="<?= base_url() ?>" class="text-gray-700 hover:text-blue-600">Home</a>
                <a href="<?= base_url('qr-generator') ?>" class="text-gray-700 hover:text-blue-600">Login</a>
                <!-- Add more links as needed -->
            </nav>
        </div>
    </header>

    <!-- Main content -->
    <main class="max-w-7xl mx-auto px-4 py-8">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-inner mt-12 py-6 text-center text-gray-500 text-sm">
        &copy; <?= date('Y') ?> My CI4 App. All rights reserved.
    </footer>

</body>
</html>