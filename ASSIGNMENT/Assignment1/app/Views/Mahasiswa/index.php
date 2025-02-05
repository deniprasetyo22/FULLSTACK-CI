<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mahasiswa</title>
    </head>

    <body>
        <h2>Daftar Mahasiswa</h2>
        <a href="/mahasiswa/create">Tambah Mahasiswa</a>
        <ul>
            <?php foreach ($students as $student) : ?>
            <li>
                <?= $student->getFullInfo(); ?>
                <a href="/mahasiswa/detail/<?= $student->getNIM(); ?>">Detail</a>
                <a href="/mahasiswa/update/<?= $student->getNIM(); ?>">Edit</a>
                <a href="/mahasiswa/delete/<?= $student->getNIM(); ?>">Hapus</a>
            </li>
            <?php endforeach; ?>
        </ul>
    </body>

</html>