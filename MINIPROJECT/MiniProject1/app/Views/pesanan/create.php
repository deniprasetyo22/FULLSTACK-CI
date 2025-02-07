<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Tambah Pesanan<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mx-auto p-4">
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
        <div class="relative mb-5">
            <a href="/pesanan"
                class="absolute left-0 transform -translate-y-1/2 text-blue-500 hover:text-blue-600 rounded flex items-center">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back
            </a>
            <h2 class="text-xl font-bold text-center">Add New Order</h2>
        </div>

        <form action="/pesanan/store" method="post">
            <div class="mb-4">
                <label for="id" class="block font-medium">ID</label>
                <input type="text" id="id" name="id" required placeholder="ID"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <!-- Container untuk input produk -->
            <div id="productContainer">
                <div class="product-group mb-2">
                    <label class="block font-medium">Product</label>
                    <div class="flex gap-2">
                        <select name="produk[]"
                            class="productSelect w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <option value="">-- Select Product --</option>
                            <?php foreach ($products as $product) : ?>
                            <option value="<?= $product->getNama(); ?>" data-harga="<?= $product->getHarga(); ?>">
                                <?= $product->getNama(); ?> - Rp.
                                <?= number_format($product->getHarga(), 0, ',', '.'); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="button"
                            class="removeProduct bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">
                            Remove
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tombol Tambah Produk -->
            <button type="button" id="addProduct"
                class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mb-4">
                Add Another Product
            </button>

            <div class="mb-4">
                <label for="total" class="block font-medium">Total</label>
                <input type="text" id="total" required placeholder="Total"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500 bg-gray-100 cursor-not-allowed"
                    readonly>
                <input type="hidden" id="totalRaw" name="total">
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
document.addEventListener("DOMContentLoaded", function() {
    const productContainer = document.getElementById("productContainer");
    const addProductButton = document.getElementById("addProduct");

    // Fungsi untuk menambahkan dropdown produk
    addProductButton.addEventListener("click", function() {
        const productGroup = document.createElement("div");
        productGroup.classList.add("product-group", "mb-4");

        productGroup.innerHTML = `
            <label class="block font-medium">Product</label>
            <div class="flex gap-2">
                <select name="produk[]" class="productSelect w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <option value="">-- Select Product --</option>
                    <?php foreach ($products as $product) : ?>
                    <option value="<?= $product->getNama(); ?>" data-harga="<?= $product->getHarga(); ?>"> <?= $product->getNama(); ?> - Rp. <?= number_format($product->getHarga(), 0, ',', '.'); ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="button" class="removeProduct bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">
                    Remove
                </button>
            </div>
        `;

        productContainer.appendChild(productGroup);

        // Tambahkan event listener ke tombol hapus yang baru dibuat
        productGroup.querySelector(".removeProduct").addEventListener("click", function() {
            productGroup.remove();
        });
    });

    // Event listener untuk menghapus produk yang pertama kali ada
    document.querySelector(".removeProduct").addEventListener("click", function() {
        this.closest(".product-group").remove();
    });


    // Fungsi untuk menghitung total
    function updateTotal() {
        let total = 0;
        document.querySelectorAll(".productSelect").forEach(select => {
            let harga = select.options[select.selectedIndex].getAttribute("data-harga");
            if (harga) total += parseInt(harga);
        });
        document.getElementById("total").value = total;
    }

    document.querySelectorAll(".productSelect").forEach(select => {
        select.addEventListener("change", updateTotal);
    });

    document.getElementById("productContainer").addEventListener("change", updateTotal);


    // Fungsi untuk menghitung total
    function updateTotal() {
        let total = 0;
        document.querySelectorAll(".productSelect").forEach(select => {
            let harga = select.options[select.selectedIndex].getAttribute("data-harga");
            if (harga) total += parseInt(harga);
        });

        // Format angka ke format Rupiah
        let formattedTotal = total > 0 ? "Rp. " + new Intl.NumberFormat("id-ID").format(total) : "Rp. 0";

        // Tampilkan di input
        document.getElementById("total").value = formattedTotal;
        // Simpan angka tanpa separator ke totalRaw
        document.getElementById("totalRaw").value = total;
    }

    // Update total ketika produk dipilih
    document.querySelectorAll(".productSelect").forEach(select => {
        select.addEventListener("change", updateTotal);
    });

    // Update total ketika ada perubahan dalam container
    document.getElementById("productContainer").addEventListener("change", updateTotal);
});
</script>

<?= $this->endSection() ?>