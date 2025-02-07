<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Detail Mahasiswa<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <a href="/mahasiswa" class="bg-blue-500 text-white py-1 px-2 rounded-sm">
        <i class="fa-solid fa-arrow-left"></i>
        Back
    </a>
    <h2 class="text-2xl font-bold mb-4 text-center">Detail Mahasiswa</h2>
    <table class="w-full border-collapse bg-white shadow-md overflow-hidden">
        <tbody>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 text-left font-semibold">NIM</th>
                <td class="px-4 py-2">: <?= $student->getNIM(); ?></td>
            </tr>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 text-left font-semibold">Nama</th>
                <td class="px-4 py-2">: <?= $student->getNama(); ?></td>
            </tr>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 text-left font-semibold">Jurusan</th>
                <td class="px-4 py-2">: <?= $student->getJurusan(); ?></td>
            </tr>
        </tbody>
    </table>

</div>
<?= $this->endSection() ?>