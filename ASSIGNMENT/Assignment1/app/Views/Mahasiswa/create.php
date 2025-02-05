<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Mahasiswa</title>
    </head>

    <body>
        <h2>Tambah Mahasiswa</h2>
        <form method="post" action="/mahasiswa/store">
            <input type="text" name="nim" placeholder="NIM" required><br>
            <input type="text" name="nama" placeholder="Nama" required><br>
            <input type="text" name="jurusan" placeholder="Jurusan" required><br>
            <button type="submit">Simpan</button>
        </form>
        <a href="/mahasiswa">Kembali</a>
    </body>

</html>