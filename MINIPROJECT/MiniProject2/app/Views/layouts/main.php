<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Title -->
        <title><?= $this->renderSection('title') ?></title>

        <!-- Tailwind CSS -->
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

        <!-- FontAwesome -->
        <script src="https://kit.fontawesome.com/c4fc535117.js" crossorigin="anonymous"></script>

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body class="flex flex-col min-h-screen">

        <!-- Navbar -->
        <nav class="bg-blue-500 p-4 text-white">
            <div class="container mx-auto flex justify-between">
                <div>
                    <a href="/">
                        <h1 class="text-xl font-bold">
                            User & Product Management System
                        </h1>
                    </a>
                </div>
                <div class="space-x-4">
                    <a href="/">
                        Home
                    </a>
                    <a href="<?= url_to('about') ?>">
                        About
                    </a>
                    <a href="<?= url_to('produk') ?>">
                        Produk
                    </a>
                    <a href="<?= url_to('user') ?>">
                        User
                    </a>
                    <a href="<?= url_to('api') ?>">
                        API
                    </a>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <div class="container mx-auto p-4">
            <?= $this->renderSection('content') ?>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-800 p-4 text-white text-center mt-auto">
            <div class="container mx-auto">
                <p class="text-sm">&copy; 2025 E-Commerce System. All rights reserved.</p>
            </div>
        </footer>

    </body>

</html>