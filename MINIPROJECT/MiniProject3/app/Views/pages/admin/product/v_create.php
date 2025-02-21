<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>Add Product<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="container mx-auto p-4">
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
        <div class="relative mb-5">
            <a href="<?= url_to('product') ?>"
                class="absolute left-0 transform -translate-y-1/2 text-blue-500 hover:text-blue-600 rounded flex items-center">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back
            </a>
            <h2 class="text-xl font-bold text-center">Add New Product</h2>
        </div>

        <form action="<?= url_to('store_product') ?>" method="post">
            <div class="mb-4">
                <label for="id" class="block font-medium">ID</label>
                <input type="text" id="id" name="id" required placeholder="ID"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="name" class="block font-medium">Product Name</label>
                <input type="text" id="name" name="name" required placeholder="Product Name"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="price" class="block font-medium">Price</label>
                <input type="text" id="price" name="price" required placeholder="Price"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="stock" class="block font-medium">Stock</label>
                <input type="number" id="stock" name="stock" required placeholder="Stock"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="category" class="block font-medium">Category</label>
                <select name="category" id="category"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <option value="">-- Choose Category --</option>
                    <?php foreach ($categoryList as $category) : ?>
                    <option value="<?= $category ?>"><?= $category ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="slug" class="block font-medium">Slug</label>
                <input type="text" id="slug" name="slug" required placeholder="Slug"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
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