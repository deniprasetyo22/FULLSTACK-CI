<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Student List<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4 text-center">Student List</h2>

    <a href="/mahasiswa/create"
        class="inline-block bg-blue-600 text-white py-1 px-3 rounded-md hover:bg-blue-700 transition mb-4">
        <i class="fa-solid fa-plus"></i> Add
    </a>

    <ul class="space-y-4">
        <?php foreach ($students as $student) : ?>
        <li class="p-4 border rounded-lg flex justify-between items-center bg-gray-50 shadow-sm">
            <span class="text-gray-800"><?= $student->getFullInfo(); ?></span>
            <div class="space-x-2">
                <a href="/mahasiswa/detail/<?= $student->getNIM(); ?>" class="text-blue-500">
                    <i class="fa-solid fa-circle-info text-xl"></i>
                </a>
                <a href="/mahasiswa/update/<?= $student->getNIM(); ?>" class="text-yellow-500">
                    <i class="fa-solid fa-pen-to-square text-xl"></i>
                </a>
                <a href="/mahasiswa/delete/<?= $student->getNIM(); ?>" class="text-red-500"
                    onclick="return confirm('Yakin ingin menghapus?');">
                    <i class="fa-solid fa-trash text-xl"></i>
                </a>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<?= $this->endSection() ?>