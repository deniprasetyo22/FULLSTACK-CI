<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Add Product<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mx-auto p-4">
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
        <div class="relative mb-5">
            <a href="/produk"
                class="absolute left-0 transform -translate-y-1/2 text-blue-500 hover:text-blue-600 rounded flex items-center">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back
            </a>
            <h2 class="text-xl font-bold text-center">Add New Product</h2>
        </div>

        <form action="/produk/store" method="post">
            <div class="mb-4">
                <label for="id" class="block font-medium">ID</label>
                <input type="text" id="id" name="id" required placeholder="ID"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="nama" class="block font-medium">Nama Produk</label>
                <input type="text" id="nama" name="nama" required placeholder="Nama Produk"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="harga" class="block font-medium">Harga</label>
                <input type="text" id="harga" name="harga" required placeholder="Harga"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="stok" class="block font-medium">Stok</label>
                <input type="number" id="stok" name="stok" required placeholder="Stok"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="kategori" class="block font-medium">Kategori</label>
                <select name="kategori" id="kategori"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach ($kategoriList as $kategori) : ?>
                    <option value="<?= $kategori ?>"><?= $kategori ?></option>
                    <?php endforeach; ?>
                </select>
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
document.getElementById("harga").addEventListener("input", function(e) {
    let value = e.target.value.replace(/[^\d]/g, ""); // Hanya angka
    if (value !== "") {
        e.target.value = "Rp. " + new Intl.NumberFormat("id-ID").format(value);
    } else {
        e.target.value = "Rp. 0";
    }
});

// Saat form dikirim, ubah format harga menjadi angka tanpa "Rp." dan "."
document.querySelector("form").addEventListener("submit", function(e) {
    let hargaInput = document.getElementById("harga");
    hargaInput.value = hargaInput.value.replace(/\D/g, ""); // Hanya angka
});
</script>

<?= $this->endSection() ?>