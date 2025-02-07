<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Detail Pesanan<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mx-auto p-4">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-lg border border-gray-200">
        <div class="relative mb-5">
            <a href="/pesanan"
                class="absolute left-0 transform -translate-y-1/2 text-blue-500 hover:text-blue-600 rounded flex items-center">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back
            </a>
            <h2 class="text-2xl font-bold text-center mb-4 text-gray-700">Detail Pesanan</h2>
        </div>

        <div class="mb-4">
            <strong class="text-gray-600">ID Pesanan:</strong>
            <span class="text-gray-800"><?= $pesanan->getId(); ?></span>
        </div>

        <div class="mb-4">
            <strong class="text-gray-600">Produk:</strong>
            <table class="w-full border-collapse border border-gray-300 mt-2">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border border-gray-300 p-2 text-left">No</th>
                        <th class="border border-gray-300 p-2 text-left">Nama Produk</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pesanan->getProduk() as $index => $produk) : ?>
                    <tr class="hover:bg-gray-100 transition duration-300">
                        <td class="border border-gray-300 p-2"><?= $index + 1; ?></td>
                        <td class="border border-gray-300 p-2"><?= $produk; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mb-4">
            <strong class="text-gray-600">Total Harga:</strong>
            <span class="text-green-600 font-semibold">Rp.
                <?= number_format($pesanan->getTotal(), 0, ',', '.'); ?></span>
        </div>

        <div class="mb-4">
            <strong class="text-gray-600">Status:</strong>
            <span
                class="px-2 py-1 rounded-full text-white <?= $pesanan->getStatus() == 'Pending' ? 'bg-yellow-500' : 'bg-green-500'; ?>">
                <?= ucfirst($pesanan->getStatus()); ?>
            </span>
        </div>
    </div>
</div>
<?= $this->endSection() ?>