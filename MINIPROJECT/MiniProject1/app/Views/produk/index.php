<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>E-Commerce System<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-2 text-center">Product List</h2>

    <a href="/produk/create" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded">
        <i class="fa-solid fa-plus"></i> Add
    </a>

    <div class="overflow-x-auto mt-2">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 p-2">ID</th>
                    <th class="border border-gray-300 p-2">Nama</th>
                    <th class="border border-gray-300 p-2">Harga</th>
                    <th class="border border-gray-300 p-2">Stok</th>
                    <th class="border border-gray-300 p-2">Kategori</th>
                    <th class="border border-gray-300 p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produk as $p) : ?>
                <tr class="text-center">
                    <td class="border border-gray-300 p-2"><?= $p->getId() ?></td>
                    <td class="border border-gray-300 p-2"><?= $p->getNama() ?></td>
                    <td class="border border-gray-300 p-2">Rp.<?= number_format($p->getHarga(), 0, ',', '.') ?></td>
                    <td class="border border-gray-300 p-2">
                        <div class="flex items-center justify-center space-x-2">
                            <button class="bg-red-500 text-white px-2 py-1 rounded decrease-stock cursor-pointer"
                                data-id="<?= $p->getId() ?>">
                                <i class="fa-solid fa-minus"></i>
                            </button>
                            <span id="stok-<?= $p->getId() ?>"><?= $p->getStok() ?></span>
                            <button class="bg-green-500 text-white px-2 py-1 rounded increase-stock cursor-pointer"
                                data-id="<?= $p->getId() ?>">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                    </td>
                    <td class="border border-gray-300 p-2"><?= $p->getKategori() ?></td>
                    <td class="border border-gray-300 p-2">
                        <div class="flex justify-center space-x-2">
                            <a href="/produk/detail/<?= $p->getId() ?>" class="text-blue-500 hover:text-blue-600 cur">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="/produk/edit/<?= $p->getId() ?>" class="text-blue-500 hover:text-blue-600">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="javascript:void(0);" class="text-red-500 hover:text-red-600 delete-btn"
                                data-id="<?= $p->getId(); ?>">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function() {
            let productId = this.getAttribute("data-id");

            Swal.fire({
                title: "Are you sure?",
                text: "This product will be deleted permanently!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/produk/delete/" + productId;
                }
            });
        });
    });


    // Fungsi untuk update stok
    function updateStock(productId, action) {
        fetch(`/produk/updateStock/${productId}/${action}`, {
                method: "POST",
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`stok-${productId}`).textContent = data.newStock;
                } else {
                    alert("Gagal memperbarui stok!");
                }
            })
            .catch(error => console.error("Error:", error));
    }

    document.querySelectorAll(".increase-stock").forEach(button => {
        button.addEventListener("click", function() {
            let productId = this.getAttribute("data-id");
            updateStock(productId, "increase");
        });
    });

    document.querySelectorAll(".decrease-stock").forEach(button => {
        button.addEventListener("click", function() {
            let productId = this.getAttribute("data-id");
            updateStock(productId, "decrease");
        });
    });
});
</script>
<?= $this->endSection() ?>