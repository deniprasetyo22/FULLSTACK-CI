<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>Edit Product<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="container mx-auto p-4">
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
        <div class="relative mb-5">
            <a href="<?= url_to('product') ?>"
                class="absolute left-0 transform -translate-y-1/2 text-blue-500 hover:text-blue-600 rounded flex items-center">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back
            </a>
            <h2 class="text-xl font-bold text-center">Edit Product</h2>
        </div>

        <form action="<?= url_to('update_product', $product->getSlug()) ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">

            <div class="mb-4">
                <label for="id" class="block font-medium">ID</label>
                <input type="text" id="id" name="id" required placeholder="ID product" value="<?= $product->getId(); ?>"
                    class="w-full border rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="name" class="block font-medium">Product Name</label>
                <input type="text" id="name" name="name" required placeholder="Product Name"
                    value="<?= $product->getName(); ?>"
                    class="w-full border rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="price" class="block font-medium">Price</label>
                <input type="text" id="price" name="price" required placeholder="Price"
                    value="<?= number_format($product->getPrice(), 0, ',', '.') ?>"
                    class="w-full border rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="stock" class="block font-medium">Stock</label>
                <input type="number" id="stock" name="stock" required placeholder="Stock"
                    value="<?= $product->getStock() ?>"
                    class="w-full border rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="category" class="block font-medium">Category</label>
                <select name="category" id="category"
                    class="w-full border rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <option value="">-- Choose Category --</option>
                    <?php foreach (['Food', 'Beverage'] as $kat): ?>
                    <option value="<?= $kat ?>" <?= $product->getCategory() === $kat ? 'selected' : '' ?>><?= $kat ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="slug" class="block font-medium">Slug</label>
                <input type="text" id="slug" name="slug" required placeholder="Slug" value="<?= $product->getSlug() ?>"
                    class="w-full border rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <div class="flex justify-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                    <i class="fa-solid fa-save"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById("harga").addEventListener("input", function(e) {
    let value = e.target.value.replace(/\D/g, "");
    e.target.value = value ? "Rp. " + new Intl.NumberFormat("id-ID").format(value) : "Rp. 0";
});

// Format harga saat submit
const form = document.querySelector("form");
form.addEventListener("submit", () => {
    const hargaInput = document.getElementById("harga");
    hargaInput.value = hargaInput.value.replace(/\D/g, "");
});
</script>

<?= $this->endSection() ?>