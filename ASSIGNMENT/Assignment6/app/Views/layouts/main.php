<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Title Section -->
        <title><?= $this->renderSection('title') ?></title>

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- FontAwesome -->
        <script src="https://kit.fontawesome.com/c4fc535117.js" crossorigin="anonymous"></script>
    </head>

    <body class="flex flex-col min-h-screen">
        <!-- Header Section -->
        <?php if (empty($hideHeader)): ?>
        <header>
            <?= $this->include('partials/header') ?>
        </header>
        <?php endif; ?>

        <!-- Content Section -->
        <div class="flex flex-1 grow">
            <?= $this->renderSection('content') ?>
        </div>

        <!-- Footer Section -->
        <footer class="bg-gray-700 text-white mt-auto">
            <?= $this->include('partials/footer') ?>
        </footer>

        <!-- Flowbite JS -->
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

        <!-- Pristine JS -->
        <script src="<?= base_url('assets/js/pristine.js') ?>"></script>
    </body>

</html>