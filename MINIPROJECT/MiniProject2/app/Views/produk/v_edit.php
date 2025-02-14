<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Edit Product<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mx-auto p-4">
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
        <div class="relative mb-5">
            <a href="<?= site_url('produk') ?>"
                class="absolute left-0 transform -translate-y-1/2 text-blue-500 hover:text-blue-600 rounded flex items-center">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back
            </a>
            <h2 class="text-xl font-bold text-center">Edit Product</h2>
        </div>

        <form action="<?= site_url('produk/update/' . $produk->getId()) ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">

            <div class="mb-4">
                <label for="id" class="block font-medium">ID</label>
                <input type="text" id="id" name="id" required placeholder="ID Produk" value="<?= $produk->getId(); ?>"
                    class="w-full border rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="nama" class="block font-medium">Nama Produk</label>
                <input type="text" id="nama" name="nama" required placeholder="Nama Produk"
                    value="<?= $produk->getNama(); ?>"
                    class="w-full border rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="harga" class="block font-medium">Harga</label>
                <input type="text" id="harga" name="harga" required placeholder="Harga"
                    value="<?= number_format($produk->getHarga(), 0, ',', '.') ?>"
                    class="w-full border rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="stok" class="block font-medium">Stok</label>
                <input type="number" id="stok" name="stok" required placeholder="Stok" value="<?= $produk->getStok() ?>"
                    class="w-full border rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="kategori" class="block font-medium">Kategori</label>
                <select name="kategori" id="kategori"
                    class="w-full border rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach (['Makanan', 'Minuman', 'Elektronik', 'Fashion'] as $kat): ?>
                    <option value="<?= $kat ?>" <?= $produk->getKategori() === $kat ? 'selected' : '' ?>><?= $kat ?>
                    </option>
                    <?php endforeach; ?>
                </select>
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