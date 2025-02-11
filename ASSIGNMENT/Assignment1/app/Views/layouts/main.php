<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Title -->
        <title><?= $this->renderSection('title') ?></title>

        <!-- Tailwind CSS -->
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

        <!-- FontAwesome -->
        <script src="https://kit.fontawesome.com/c4fc535117.js" crossorigin="anonymous"></script>
    </head>

    <body class="bg-gray-100 flex flex-col min-h-screen">

        <!-- Navbar -->
        <nav class="bg-blue-500 p-4 text-white">
            <div class="container mx-auto">
                <a href="/">
                    <h1 class="text-lg font-bold">
                        <i class="fa-brands fa-free-code-camp"></i> Student Management System
                    </h1>
                </a>
            </div>
        </nav>

        <!-- Content -->
        <div class="container mx-auto mt-5 p-5">
            <?= $this->renderSection('content') ?>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white text-center p-4 mt-auto">
            &copy; <?= date('Y') ?> Deni Prasetyo
        </footer>

    </body>

</html>