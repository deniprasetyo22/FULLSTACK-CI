<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Tambah Mahasiswa<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <a href="/"
        class="bg-blue-500 text-white py-1 px-3 rounded-md inline-flex items-center hover:bg-blue-600 transition">
        <i class="fa-solid fa-arrow-left mr-2"></i> Back
    </a>

    <h2 class="text-2xl font-bold mb-4 text-center">Tambah Mahasiswa</h2>

    <?php if (isset($errors)): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        <strong>Error:</strong>
        <ul>
            <?php foreach ($errors as $error): ?>
            <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <!-- Form Tambah Mahasiswa -->
    <!-- <form method="post" action="/mahasiswa/store" class="space-y-4"> -->
    <!-- Form untuk create menggunakan routing match -->
    <form method="post" action="/mahasiswa/create" class="space-y-4">
        <div>
            <label class="block font-semibold">NIM</label>
            <input type="text" name="nim" placeholder="Masukkan NIM" value="<?= old('nim') ?>"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            <?php if (isset($errors['nim'])): ?>
            <p class="text-red-500 text-sm"><?= esc($errors['nim']) ?></p>
            <?php endif; ?>
        </div>

        <div>
            <label class="block font-semibold">Nama</label>
            <input type="text" name="nama" placeholder="Masukkan Nama" value="<?= old('nama') ?>"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            <?php if (isset($errors['nama'])): ?>
            <p class="text-red-500 text-sm"><?= esc($errors['nama']) ?></p>
            <?php endif; ?>
        </div>

        <div>
            <label class="block font-semibold">Jurusan</label>
            <input type="text" name="jurusan" placeholder="Masukkan Jurusan" value="<?= old('jurusan') ?>"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            <?php if (isset($errors['jurusan'])): ?>
            <p class="text-red-500 text-sm"><?= esc($errors['jurusan']) ?></p>
            <?php endif; ?>
        </div>


        <div class="flex justify-center mt-4">
            <button type="submit"
                class="bg-green-500 text-white py-2 px-6 rounded-md hover:bg-green-600 transition cursor-pointer">
                <i class="fa-solid fa-save mr-2"></i> Submit
            </button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>