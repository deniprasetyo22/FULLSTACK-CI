<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Detail Mahasiswa</title>
    </head>

    <body>
        <h2>Detail Mahasiswa</h2>
        <p><?= $student->getFullInfo(); ?></p>
        <a href="/mahasiswa">Kembali</a>
    </body>

</html>