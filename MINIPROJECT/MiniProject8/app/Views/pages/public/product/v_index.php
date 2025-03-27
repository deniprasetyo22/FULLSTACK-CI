<?= $this->extend('layouts/public_layout'); ?>

<?= $this->section('title') ?>
<?= esc($page_title) ?>
<?= $this->endSection() ?>

<?= $this->section('content'); ?>
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Product List</h1>

    <form action="<?= $baseUrl ?>" method="get" class="space-y-4">

        <div class="w-full">
            <div class="flex rounded-md shadow-sm">
                <input type="text" name="search" value="<?= $params->search ?>"
                    class="flex-1 p-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Search by Name or Category...">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700">Cari</button>
            </div>
        </div>

        <div class="flex flex-wrap gap-5">
            <div class="w-full md:w-2/12">
                <select name="category"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                    onchange="this.form.submit()">
                    <option value="">All Category</option>
                    <?php foreach ($category as $c): ?>
                    <option value="<?= $c->id ?>" <?= ($params->category == $c->id) ? 'selected' : '' ?>>
                        <?= ucfirst($c->name) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="w-full md:w-2/12">
                <select name="price"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                    onchange="this.form.submit()">
                    <option value="">All Price</option>
                    <?php foreach ($price as $p) : ?>
                    <option value="<?= $p ?>" <?= $params->price == $p ? 'selected' : '' ?>>
                        Rp<?= number_format(explode('-', $p)[0], 0, ',', '.') ?> -
                        Rp<?= number_format(explode('-', $p)[1], 0, ',', '.') ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="w-full md:w-2/12">
                <select name="perPage"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                    onchange="this.form.submit()">
                    <?php foreach ([4, 8, 16, 32] as $perPage): ?>
                    <option value="<?= $perPage ?>" <?= ($params->perPage == $perPage) ? 'selected' : '' ?>>
                        <?= $perPage ?> per page
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="w-full md:w-2/12">
                <select name="sort"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                    onchange="this.form.submit()">
                    <option value="">Sort By</option>
                    <option value="name" <?= ($params->sort == 'name') ? 'selected' : '' ?>>Name</option>
                    <option value="price" <?= ($params->sort == 'price') ? 'selected' : '' ?>>Price</option>
                    <option value="created_at" <?= ($params->sort == 'created_at') ? 'selected' : '' ?>>Date</option>
                </select>
            </div>

            <div class="w-full md:w-2/12">
                <select name="order"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                    onchange="this.form.submit()">
                    <option value="asc" <?= ($params->order == 'asc') ? 'selected' : '' ?>>Ascending</option>
                    <option value="desc" <?= ($params->order == 'desc') ? 'selected' : '' ?>>Descending</option>
                </select>
            </div>

            <div class="w-full md:w-1/12">
                <a href="<?= $params->getResetUrl($baseUrl) ?>"
                    class="block text-center px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Reset
                </a>
            </div>
        </div>
    </form>


    <?php if(empty($products)) : ?>
    <div class="mt-4 border border-gray-300 rounded-lg py-10">
        <p class="text-center text-gray-500">No products found.</p>
    </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-4">
        <?php foreach ($products as $product) : ?>
        <div class="bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden">
            <a href="product-detail/<?= esc($product->id) ?>" class="block relative">
                <?php base_url('productImage/'.$product->id.'/'.$product->image_url) ?>
                <img src="<?= base_url('productImage/'.$product->id.'/'.$product->image_url) ?>"
                    alt="<?= esc($product->name) ?>" class="w-full h-48 object-cover">

                <!-- Label New -->
                <?php if ($product->isNew()) : ?>
                <span
                    class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">New</span>
                <?php endif; ?>

                <!-- Label Sale -->
                <?php if ($product->isSale()) : ?>
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
                        Add to cart
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="flex justify-center mt-4">
        <?= $pager->links('products', 'custom_pager') ?>
    </div>

    <div class="text-center mt-2">
        <small>Menampilkan <?= count($products) ?> dari <?= $total ?> total data (Halaman <?= $params->page ?>)</small>
    </div>
</div>
<?= $this->endSection(); ?>