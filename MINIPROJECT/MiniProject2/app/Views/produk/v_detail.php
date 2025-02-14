<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Detail Pesanan<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mx-auto p-4">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-lg border border-gray-200">
        <div class="relative mb-5">
            <a href="<?= url_to('produk') ?>"
                class="absolute left-0 transform -translate-y-1/2 text-blue-500 hover:text-blue-600 rounded flex items-center">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back
            </a>
            <h2 class="text-2xl font-bold text-center mb-4 text-gray-700">Detail Produk</h2>
        </div>

        <div class="mb-4">
            <strong class="text-gray-600">ID Produk:</strong>
            <span class="text-gray-800"><?= $produk->getId(); ?></span>
        </div>

        <div class="mb-4">
            <strong class="text-gray-600">Produk:</strong>
            <table class="w-full border-collapse border border-gray-300 mt-2">
                <tbody>
                    <tr class="hover:bg-gray-100 transition duration-300">
                        <th class="border border-gray-300 p-2 text-left">Nama Produk</th>
                        <td class="border border-gray-300 p-2"><?= $produk->getNama(); ?></td>
                    </tr>
                    <tr class="hover:bg-gray-100 transition duration-300">
                        <th class="border border-gray-300 p-2 text-left">Harga</th>
                        <td class="border border-gray-300 p-2">
                            Rp.<?= number_format($produk->getHarga(), 0, ',', '.'); ?></td>
                    </tr>
                    <tr class="hover:bg-gray-100 transition duration-300">
                        <th class="border border-gray-300 p-2 text-left">Stok</th>
                        <td class="border border-gray-300 p-2"><?= $produk->getStok(); ?></td>
                    </tr>
                    <tr class="hover:bg-gray-100 transition duration-300">
                        <th class="border border-gray-300 p-2 text-left">Kategori</th>
                        <td class="border border-gray-300 p-2"><?= $produk->getKategori(); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>