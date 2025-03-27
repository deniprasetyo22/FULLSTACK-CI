<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
<?= $page_title ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="container mx-auto p-4 h-full bg-white p-6 rounded-lg shadow">
    <div class="relative mb-5">
        <a href="<?= url_to('product') ?>"
            class="absolute left-0 transform -translate-y-1/2 text-blue-500 hover:text-blue-600 rounded flex items-center">
            <i class="fa-solid fa-arrow-left mr-2"></i> Back
        </a>
        <h2 class="text-2xl font-bold text-center mb-4 text-gray-700">Detail Product</h2>
    </div>

    <div class="mb-4">
        <strong class="text-gray-600">Product ID:</strong>
        <span class="text-gray-800"><?= $product->id ?></span>
    </div>

    <div class="mb-4">
        <strong class="text-gray-600">Product:</strong>
        <table class="w-full border-collapse border border-gray-300 mt-2">
            <tbody>
                <tr class="hover:bg-gray-100 transition duration-300">
                    <th class="border border-gray-300 p-2 text-left">Product Name</th>
                    <td class="border border-gray-300 p-2"><?= $product->name ?></td>
                </tr>
                <tr class="hover:bg-gray-100 transition duration-300">
                    <th class="border border-gray-300 p-2 text-left">Price</th>
                    <td class="border border-gray-300 p-2">
                        <?= $product->getFormattedPrice(); ?>
                    </td>
                </tr>
                <tr class="hover:bg-gray-100 transition duration-300">
                    <th class="border border-gray-300 p-2 text-left">Stock</th>
                    <td class="border border-gray-300 p-2"><?= $product->stock ?></td>
                </tr>
                <tr class="hover:bg-gray-100 transition duration-300">
                    <th class="border border-gray-300 p-2 text-left">Category</th>
                    <td class="border border-gray-300 p-2"><?= $product->category_name ?></td>
                </tr>
                <tr class="hover:bg-gray-100 transition duration-300">
                    <th class="border border-gray-300 p-2 text-left">Status</th>
                    <td class="border border-gray-300 p-2"><?= $product->status ?></td>
                </tr>
                <tr class="hover:bg-gray-100 transition duration-300">
                    <th class="border border-gray-300 p-2 text-left">New Product</th>
                    <td class="border border-gray-300 p-2"><?= $product->is_new ? 'Yes' : 'No' ?></td>
                </tr>
                <tr class="hover:bg-gray-100 transition duration-300">
                    <th class="border border-gray-300 p-2 text-left">Is Sale</th>
                    <td class="border border-gray-300 p-2"><?= $product->is_sale ? 'Yes' : 'No' ?></td>
                </tr>
                <tr class="hover:bg-gray-100 transition duration-300">
                    <th class="border border-gray-300 p-2 text-left">Images</th>
                    <td class="border border-gray-300 p-2">
                        <?php if (!empty($product->image_url)): ?>
                        <img src="<?= base_url('productImage/'.$product->id.'/'.$product->image_url) ?>"
                            alt="<?= esc($product->name) ?>" class="w-20 h-20">
                        <?php endif; ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>