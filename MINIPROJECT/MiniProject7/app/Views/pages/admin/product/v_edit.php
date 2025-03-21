<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>Edit Product<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="container mx-auto p-4 h-full bg-white p-6 rounded-lg shadow">
    <div class="relative mb-5">
        <a href="<?= url_to('product') ?>"
            class="absolute left-0 transform -translate-y-1/2 text-blue-500 hover:text-blue-600 rounded flex items-center">
            <i class="fa-solid fa-arrow-left mr-2"></i> Back
        </a>
        <h2 class="text-xl font-bold text-center">Edit Product</h2>
    </div>

    <form action="<?= url_to('update_product', $product->id) ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">

        <div class="mb-4">
            <label for="name" class="block font-medium">Product Name</label>
            <input type="text" id="name" name="name" placeholder="Product Name" value="<?= $product->name ?>"
                class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500 <?= session('errors.name') ? 'border-red-500' : 'border-gray-300' ?>">
            <?php if(session('errors.name')): ?>
            <p class="text-sm text-red-500"><?= session('errors.name') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label for="description" class="block font-medium">Description</label>
            <textarea id="description" rows="4" name="description" placeholder="Description"
                class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500 <?= session('errors.description') ? 'border-red-500' : 'border-gray-300' ?>"><?= $product->description ?></textarea>
            <?php if(session('errors.description')): ?>
            <p class="text-sm text-red-500"><?= session('errors.description') ?></p>
            <?php endif; ?>
        </div>


        <div class="mb-4">
            <label for="price" class="block font-medium">Price</label>
            <input type="text" id="price" name="price" placeholder="Price" value="<?= $product->price ?>"
                class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500 <?= session('errors.price') ? 'border-red-500' : 'border-gray-300' ?>">
            <?php if(session('errors.price')): ?>
            <p class="text-sm text-red-500"><?= session('errors.price') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label for="stock" class="block font-medium">Stock</label>
            <input type="number" id="stock" name="stock" placeholder="Stock" value="<?= $product->stock ?>"
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
                    <?= $product->category_id == $category['id'] ? 'selected' : '' ?>>
                    <?= esc($category['name']) ?>
                </option>
                <?php endforeach; ?>
            </select>
            <?php if(session('errors.category_id')): ?>
            <p class="text-sm text-red-500"><?= session('errors.category_id') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label for="status" class="block font-medium">Status</label>
            <select name="status" id="status"
                class="w-full border border-gray-300 rounded p-2 <?= session('errors.status') ? 'border-red-500' : 'border-gray-300' ?>">
                <option value="Active" <?= $product->status == 'Active' ? 'selected' : '' ?>>Active</option>
                <option value="Inactive" <?= $product->status == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
            </select>
            <?php if(session('errors.status')): ?>
            <p class="text-sm text-red-500"><?= session('errors.status') ?></p>
            <?php endif; ?>
        </div>

        <!-- Hidden input untuk memastikan nilai default jika checkbox tidak dicentang -->
        <input type="hidden" name="is_new" value="0">
        <input type="hidden" name="is_sale" value="0">

        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="is_new" value="1" <?= $product->is_new ? 'checked' : '' ?>
                    class="mr-2 border-gray-300 rounded focus:ring-blue-500">
                New Product
            </label>
        </div>

        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="is_sale" value="1" <?= $product->is_sale ? 'checked' : '' ?>
                    class="mr-2 border-gray-300 rounded focus:ring-blue-500">
                On Sale
            </label>
        </div>


        <div class="flex justify-center">
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">
                <i class="fa-solid fa-save"></i> Update
            </button>
        </div>
    </form>
</div>

<script>
document.getElementById("price").addEventListener("input", function(e) {
    let value = e.target.value.replace(/\D/g, "");
    e.target.value = value ? "Rp. " + new Intl.NumberFormat("id-ID").format(value) : "Rp. 0";
});

// Format price saat submit
const form = document.querySelector("form");
form.addEventListener("submit", () => {
    const priceInput = document.getElementById("price");
    priceInput.value = priceInput.value.replace(/\D/g, "");
});
</script>

<?= $this->endSection() ?>