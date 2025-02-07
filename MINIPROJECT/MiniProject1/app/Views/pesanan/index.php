<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>E-Commerce System<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-2 text-center">Order List</h2>

    <a href="/pesanan/create" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded">
        <i class="fa-solid fa-plus"></i> Add
    </a>

    <div class="overflow-x-auto mt-2">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 p-2">ID</th>
                    <th class="border border-gray-300 p-2">Produk</th>
                    <th class="border border-gray-300 p-2">Total</th>
                    <th class="border border-gray-300 p-2">Status</th>
                    <th class="border border-gray-300 p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!$pesanan) : ?>
                <tr>
                    <td colspan="5" class="border border-gray-300 p-4 text-center text-gray-500">
                        <span>Tidak ada pesanan tersedia.</span>
                    </td>
                </tr>
                <?php else : ?>
                <?php foreach ($pesanan as $p) : ?>
                <tr class="text-center">
                    <td class="border border-gray-300 p-2"><?= $p->getId() ?></td>
                    <td class="border border-gray-300 p-2">
                        <ul>
                            <?php $produkData = $p->getProduk();
                                if (is_array($produkData)) { 
                                    $produkList = $produkData; 
                                } elseif (is_string($produkData)) { 
                                    $produkList = explode(', ', $produkData); 
                                } else {
                                    $produkList = []; 
                                }
                                foreach ($produkList as $produk) : 
                            ?>
                            <li>- <?= $produk ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                    <td class="border border-gray-300 p-2">Rp. <?= number_format($p->getTotal(), 0,',','.') ?></td>
                    <td class="border border-gray-300 p-2"><?= $p->getStatus() ?></td>
                    <td class="border border-gray-300 p-2">
                        <div class="flex justify-center space-x-2">
                            <a href="/pesanan/detail/<?= $p->getId() ?>" class="text-blue-500 hover:text-blue-600">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="/pesanan/edit/<?= $p->getId() ?>" class="text-blue-500 hover:text-blue-600">
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
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function() {
            let pesananId = this.getAttribute("data-id");

            Swal.fire({
                title: "Are you sure?",
                text: "This order will be deleted permanently!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/pesanan/delete/" + pesananId;
                }
            });
        });
    });
});
</script>
<?= $this->endSection() ?>