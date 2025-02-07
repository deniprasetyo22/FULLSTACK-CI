<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Edit Mahasiswa<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <a href="/mahasiswa"
        class="bg-blue-500 text-white py-1 px-3 rounded-md inline-flex items-center hover:bg-blue-600 transition">
        <i class="fa-solid fa-arrow-left mr-2"></i> Back
    </a>

    <h2 class="text-2xl font-bold mb-4 text-center">Edit Mahasiswa</h2>

    <!-- Form Edit Mahasiswa -->
    <form method="post" action="/mahasiswa/saveUpdate" class="space-y-4">
        <input type="hidden" name="nim" value="<?= $student->getNIM(); ?>">
        <div>
            <label class="block font-semibold">NIM</label>
            <input type="text" name="nim" value="<?= $student->getNIM(); ?>" readonly
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div>
            <label class="block font-semibold">Nama</label>
            <input type="text" name="nama" value="<?= $student->getNama(); ?>" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div>
            <label class="block font-semibold">Jurusan</label>
            <input type="text" name="jurusan" value="<?= $student->getJurusan(); ?>" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="flex justify-center">
            <button type="submit"
                class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 transition cursor-pointer">
                <i class="fa-solid fa-save mr-2"></i> Update
            </button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>