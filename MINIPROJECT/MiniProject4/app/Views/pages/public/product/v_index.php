<?= $this->extend('layouts/public_layout'); ?>

<?= $this->section('title') ?>
<?= esc($page_title) ?>
<?= $this->endSection() ?>

<?= $this->section('content'); ?>
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Product List</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php foreach ($products as $product) : ?>
        <div class="bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden">
            <a href="product-detail/<?= esc($product->id) ?>" class="block relative">
                <?php $image = !empty($product->image_url) ? base_url($product->image_url) : null; ?>
                <img src="<?= esc($image) ?>" alt="<?= esc($product->name) ?>" class="w-full h-48 object-cover">

                <!-- Label New & Sale -->
                <?php if ($product->is_new) : ?>
                <span
                    class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">New</span>
                <?php endif; ?>
                <?php if ($product->is_sale) : ?>
                <span
                    class="absolute top-2 left-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded">Sale</span>
                <?php endif; ?>
            </a>

            <div class="p-5">
                <h5 class="text-xl font-bold text-gray-900 mb-2"><?= esc($product->name) ?></h5>
                <p class="text-gray-600 text-sm mb-2"><?= esc($product->description) ?></p>
                <p class="text-gray-700 text-sm"><strong>Category:</strong> <?= esc($product->category_name) ?></p>
                <p class="text-gray-700 text-sm"><strong>Stock:</strong> <?= esc($product->stock) ?></p>
                <p class="text-gray-700 text-sm"><strong>Status:</strong> <?= esc($product->status) ?></p>

                <div class="flex justify-between items-center mt-4">
                    <span class="text-lg font-bold text-gray-900"><?= esc($product->formatted_price) ?></span>
                    <a href="product-detail/<?= esc($product->id) ?>"
                        class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                        <i class="fa-solid fa-plus"></i>
                        Add to chart
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection(); ?>