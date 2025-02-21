<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>Product<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-2 text-center">Product List</h2>

    <a href="<?= url_to('create_product') ?>" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded">
        <i class="fa-solid fa-plus"></i> Add
    </a>

    <div class="overflow-x-auto mt-2">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 p-2">ID</th>
                    <th class="border border-gray-300 p-2">Name</th>
                    <th class="border border-gray-300 p-2">Price</th>
                    <th class="border border-gray-300 p-2">Stock</th>
                    <th class="border border-gray-300 p-2">Category</th>
                    <th class="border border-gray-300 p-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $item) : ?>
                <tr class="text-center">
                    <td class="border border-gray-300 p-2"><?= $item->getId() ?></td>
                    <td class="border border-gray-300 p-2"><?= $item->getName() ?></td>
                    <td class="border border-gray-300 p-2">Rp.<?= number_format($item->getPrice(), 0, ',', '.') ?></td>
                    <td class="border border-gray-300 p-2">
                        <span id="stok-<?= $item->getId() ?>"><?= $item->getStock() ?></span>
                    </td>
                    <td class="border border-gray-300 p-2"><?= $item->getCategory() ?></td>
                    <td class="border border-gray-300 p-2">
                        <a href="<?= url_to('detail_product',$item->getSlug()) ?>"
                            class="text-blue-500 hover:text-blue-600 cursor-pointer">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="<?= url_to('edit_product', $item->getSlug()) ?>" class="text-yellow-500">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="<?= url_to('delete_product', $item->getSlug()) ?>" method="post"
                            class="inline-block">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="text-red-500"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus product ini?')">
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