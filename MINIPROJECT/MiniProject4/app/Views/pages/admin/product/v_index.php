<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
<?= $page_title ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="container mx-auto p-4 h-full bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-2 text-center">Product List</h2>

    <?php if (session()->getFlashdata('message')) : ?>
    <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
        <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div>
            <span class="font-medium"><?= session()->getFlashdata('message') ?></span>
        </div>
    </div>
    <?php endif; ?>

    <a href="<?= url_to('create_product') ?>" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded">
        <i class="fa-solid fa-plus"></i> Add
    </a>

    <div class="overflow-x-auto mt-2">
        <table class="min-w-full bg-white rounded-lg shadow-md">
            <thead>
                <tr class="bg-blue-500">
                    <th class="border border-gray-300 p-2 text-white">ID</th>
                    <th class="border border-gray-300 p-2 text-white">Name</th>
                    <th class="border border-gray-300 p-2 text-white">Description</th>
                    <th class="border border-gray-300 p-2 text-white">Price</th>
                    <th class="border border-gray-300 p-2 text-white">Stock</th>
                    <th class="border border-gray-300 p-2 text-white">Category</th>
                    <th class="border border-gray-300 p-2 text-white">Status</th>
                    <th class="border border-gray-300 p-2 text-white">Image</th>
                    <th class="border border-gray-300 p-2 text-white">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                <tr class="text-center hover:bg-gray-100">
                    <td class="border border-gray-300 p-2"><?= $product->id ?></td>
                    <td class="border border-gray-300 p-2"><?= $product->name?></td>
                    <td class="border border-gray-300 p-2"><?= $product->description?></td>
                    <td class="border border-gray-300 p-2"><?= $product->getFormattedPrice() ?></td>
                    <td class="border border-gray-300 p-2"><?= $product->stock ?></td>
                    <td class="border border-gray-300 p-2"><?= $product->category_name ?></td>
                    <td class="border border-gray-300 p-2"><?= $product->status ?></td>
                    <td class="border border-gray-300 p-2 flex justify-center">
                        <?php $image = !empty($product->image_url) ? base_url($product->image_url) : '' ?>
                        <img src="<?= esc($image) ?>" alt="<?= esc($product->name) ?>" class="w-20 h-20">
                    </td>
                    <td class="border border-gray-300 p-2">
                        <div class="grid grid-cols-3 gap-2 justify-center">
                            <a href="<?= url_to('product_detail', $product->id) ?>"
                                class="text-blue-500 hover:text-blue-600 cursor-pointer">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="<?= url_to('edit_product', $product->id) ?>" class="text-yellow-500">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="<?= url_to('delete_product', $product->id) ?>" method="post"
                                class="inline-block">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="text-red-500"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus product ini?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>