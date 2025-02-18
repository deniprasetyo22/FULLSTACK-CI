<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title><?= $this->renderSection('title') ?></title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body>
        <!-- Header -->
        <header>
            <?= $this->include('partials/navbar') ?>
        </header>

        <!-- Main Content -->
        <main>
            <?= $this->renderSection('content') ?>
        </main>

        <!-- Footer -->
        <footer>
            <?= $this->include('partials/footer') ?>
        </footer>

        <!-- Scripts -->
        <?= $this->renderSection('scripts') ?>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    </body>

</html>