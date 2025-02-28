<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>Add Product<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="container mx-auto p-4 h-full">
    <div class="mx-auto bg-white p-6 rounded-lg shadow">
        <div class="relative mb-5">
            <a href="<?= url_to('product') ?>"
                class="absolute left-0 transform -translate-y-1/2 text-blue-500 hover:text-blue-600 rounded flex items-center">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back
            </a>
            <h2 class="text-xl font-bold text-center">Add New Product</h2>
        </div>

        <form action="<?= url_to('store_product') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-4">
                <label for="name" class="block font-medium">Product Name</label>
                <input type="text" id="name" name="name" placeholder="Product Name" value="<?= old('name') ?>"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500 <?= session('errors.name') ? 'border-red-500' : 'border-gray-300' ?>">
                <?php if(session('errors.name')): ?>
                <p class="text-sm text-red-500"><?= session('errors.name') ?></p>
                <?php endif; ?>
            </div>

            <div class="mb-4">
                <label for="description" class="block font-medium">Description</label>
                <textarea id="description" rows="4" name="description" placeholder="Description"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500 <?= session('errors.description') ? 'border-red-500' : 'border-gray-300' ?>"><?= old('description') ?></textarea>
                <?php if(session('errors.description')): ?>
                <p class="text-sm text-red-500"><?= session('errors.description') ?></p>
                <?php endif; ?>
            </div>


            <div class="mb-4">
                <label for="price" class="block font-medium">Price</label>
                <input type="text" id="price" name="price" placeholder="Price" value="<?= old('price') ?>"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500 <?= session('errors.price') ? 'border-red-500' : 'border-gray-300' ?>">
                <?php if(session('errors.price')): ?>
                <p class="text-sm text-red-500"><?= session('errors.price') ?></p>
                <?php endif; ?>
            </div>

            <div class="mb-4">
                <label for="stock" class="block font-medium">Stock</label>
                <input type="number" id="stock" name="stock" placeholder="Stock" value="<?= old('stock') ?>"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500 <?= session('errors.stock') ? 'border-red-500' : 'border-gray-300' ?>">
                <?php if(session('errors.stock')): ?>
                <p class="text-sm text-red-500"><?= session('errors.stock') ?></p>
                <?php endif; ?>
            </div>

            <div class="mb-4">
                <label for="category_id" class="block font-medium">Category</label>
                <select name="category_id" id="category_id"
                    class="w-full border border-gray-300 rounded p-2 <?= session('errors.category_id') ? 'border-red-500' : 'border-gray-300'  ?>">
                    <option value="" disabled selected>-- Choose Category --</option>
                    <?php foreach ($categoryList as $category) : ?>
                    <option value="<?= esc($category['id']) ?>"
                        <?= old('category_id') == $category['id'] ? 'selected' : '' ?>>
                        <?= esc($category['name']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <?php if(session('errors.category_id')): ?>
                <p class="text-sm text-red-500"><?= session('errors.category_id') ?></p>
                <?php endif; ?>
            </div>

            <div class="flex justify-center">
                <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded cursor-pointer">
                    <i class="fa-solid fa-save"></i> Submit
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById("price").addEventListener("input", function(e) {
    let value = e.target.value.replace(/[^\d]/g, ""); // Hanya angka
    if (value !== "") {
        e.target.value = "Rp. " + new Intl.NumberFormat("id-ID").format(value);
    } else {
        e.target.value = "Rp. 0";
    }
});

// Saat form dikirim, ubah format harga menjadi angka tanpa "Rp." dan "."
document.querySelector("form").addEventListener("submit", function(e) {
    let hargaInput = document.getElementById("price");
    hargaInput.value = hargaInput.value.replace(/\D/g, ""); // Hanya angka
});
</script>

<?= $this->endSection() ?>