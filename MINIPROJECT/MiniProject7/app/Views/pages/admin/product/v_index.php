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

    <div class="mb-4">
        <a href="<?= url_to('create_product') ?>" class="bg-blue-500 hover:bg-blue-600 text-white py-1.5 px-3 rounded">
            <i class="fa-solid fa-plus"></i> Add
        </a>
    </div>

    <form action="<?= $baseUrl ?>" method="get" class="space-y-4">
        <div class="flex flex-wrap gap-4">
            <div class="w-full md:w-4/12">
                <div class="flex rounded-md shadow-sm">
                    <input type="text" name="search" value="<?= $params->search ?>"
                        class="flex-1 p-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Search by ID, Name, Description, Price, Stock, Category, or Status...">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700">Cari</button>
                </div>
            </div>
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
                    <option value="0-20000" <?= $params->price == "0-20000" ? 'selected' : '' ?>>
                        Rp0 - Rp20.000
                    </option>
                    <option value="20000-40000" <?= $params->price == "20000-40000" ? 'selected' : '' ?>>
                        Rp20.000 - Rp40.000
                    </option>
                    <option value="40000-60000" <?= $params->price == "40000-60000" ? 'selected' : '' ?>>
                        Rp40.000 - Rp60.000
                    </option>
                    <option value="60000-80000" <?= $params->price == "60000-80000" ? 'selected' : '' ?>>
                        Rp60.000 - Rp80.000
                    </option>
                    <option value="80000-100000" <?= $params->price == "80000-100000" ? 'selected' : '' ?>>
                        Rp80.000 - Rp100.000
                    </option>
                </select>
            </div>
            <div class="w-full md:w-2/12">
                <select name="perPage"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                    onchange="this.form.submit()">
                    <?php foreach ([5, 10, 25, 50] as $perPage): ?><option value="<?= $perPage ?>"
                        <?= ($params->perPage == $perPage) ? 'selected' : '' ?>><?= $perPage ?> per page</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="w-full md:w-1/12">
                <a href="<?= $params->getResetUrl($baseUrl) ?>"
                    class="block text-center px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Reset</a>
            </div>
        </div>
        <input type="hidden" name="sort" value="<?= $params->sort; ?>">
        <input type="hidden" name="order" value="<?= $params->order; ?>">
    </form>

    <div class="overflow-x-auto mt-2">
        <table class="min-w-full bg-white rounded-lg shadow-md">
            <thead>
                <tr class="bg-blue-500">
                    <th class="border border-gray-300 p-2 text-white">ID</th>
                    <th class="border border-gray-300 p-2 text-white">
                        <a href="<?= $params->getSortUrl('name', $baseUrl) ?>">
                            Name
                            <?= $params->isSortedBy('name') ? ($params->getSortDirection() == 'asc' ? '↑' : '↓') : '↕' ?>
                        </a>
                    </th>
                    <th class="border border-gray-300 p-2 text-white">Description</th>
                    <th class="border border-gray-300 p-2 text-white">
                        <a href="<?= $params->getSortUrl('price', $baseUrl) ?>">
                            Price
                            <?= $params->isSortedBy('price') ? ($params->getSortDirection() == 'asc' ? '↑' : '↓') : '↕' ?>
                        </a>
                    </th>
                    <th class="border border-gray-300 p-2 text-white">Stock</th>
                    <th class="border border-gray-300 p-2 text-white">Category</th>
                    <th class="border border-gray-300 p-2 text-white">Status</th>
                    <th class="border border-gray-300 p-2 text-white">Image</th>
                    <th class="border border-gray-300 p-2 text-white">
                        <a href="<?= $params->getSortUrl('created_at', $baseUrl) ?>">
                            Date
                            <?= $params->isSortedBy('created_at') ? ($params->getSortDirection() == 'asc' ? '↑' : '↓') : '↕' ?>
                        </a>
                    </th>
                    <th class="border border-gray-300 p-2 text-white">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)) : ?>
                <tr>
                    <td colspan="9" class="py-4 px-4 text-center text-gray-500">No items available.</td>
                </tr>
                <?php endif ?>
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
                        <img src="<?= base_url('productImage/'.$product->id.'/'.$product->image_url) ?>"
                            alt="<?= esc($product->name) ?>" class="w-20 h-20">
                    </td>
                    <td class="border border-gray-300"><?= $product->created_at ?></td>
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
        <div class="flex justify-center mt-2">
            <?= $pager->links('products', 'custom_pager') ?>
        </div>
        <div class="text-center mt-2">
            <small>Menampilkan <?= count($products) ?> dari <?= $total ?>
                total data (Halaman <?= $params->page ?>)</small>
        </div>
    </div>
</div>
<?= $this->endSection() ?>