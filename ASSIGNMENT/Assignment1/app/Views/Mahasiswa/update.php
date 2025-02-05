<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Mahasiswa</title>
    </head>

    <body>
        <h2>Edit Mahasiswa</h2>
        <form method="post" action="/mahasiswa/saveUpdate">
            <input type="hidden" name="nim" value="<?= $student->getNIM(); ?>">
            <input type="text" name="nama" value="<?= $student->getNama(); ?>" required><br>
            <input type="text" name="jurusan" value="<?= $student->getJurusan(); ?>" required><br>
            <button type="submit">Update</button>
        </form>
        <a href="/mahasiswa">Kembali</a>
    </body>

</html>