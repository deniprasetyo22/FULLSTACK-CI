<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Produk<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-2 text-center">Product List</h2>

    <a href="<?= site_url('produk/new') ?>" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded">
        <i class="fa-solid fa-plus"></i> Add
    </a>

    <div class="overflow-x-auto mt-2">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 p-2">ID</th>
                    <th class="border border-gray-300 p-2">Nama</th>
                    <th class="border border-gray-300 p-2">Harga</th>
                    <th class="border border-gray-300 p-2">Stok</th>
                    <th class="border border-gray-300 p-2">Kategori</th>
                    <th class="border border-gray-300 p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produk as $p) : ?>
                <tr class="text-center">
                    <td class="border border-gray-300 p-2"><?= $p->getId() ?></td>
                    <td class="border border-gray-300 p-2"><?= $p->getNama() ?></td>
                    <td class="border border-gray-300 p-2">Rp.<?= number_format($p->getHarga(), 0, ',', '.') ?></td>
                    <td class="border border-gray-300 p-2">
                        <span id="stok-<?= $p->getId() ?>"><?= $p->getStok() ?></span>
                    </td>
                    <td class="border border-gray-300 p-2"><?= $p->getKategori() ?></td>
                    <td class="border border-gray-300 p-2">
                        <a href="<?= site_url('produk/' . $p->getId()) ?>"
                            class="text-blue-500 hover:text-blue-600 cursor-pointer">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="<?= site_url('produk/' . $p->getId() . '/edit') ?>" class="text-yellow-500">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="<?= site_url('produk/' . $p->getId()) ?>" method="post" class="inline-block">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="text-red-500">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>