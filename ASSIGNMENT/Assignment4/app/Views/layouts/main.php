<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Title Section -->
        <title><?= $this->renderSection('title') ?></title>

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="flex flex-col min-h-screen h-screen">
        <!-- Header Section -->
        <?php if (empty($hideHeader)): ?>
        <header>
            <?= $this->include('partials/header') ?>
        </header>
        <?php endif; ?>

        <!-- Content Section -->
        <div class="flex flex-1">
            <?= $this->renderSection('content') ?>
        </div>

        <!-- Footer Section -->
        <footer class="bg-gray-700 text-white mt-auto">
            <?= $this->include('partials/footer') ?>
        </footer>

        <!-- Flowbite JS -->
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    </body>

</html>