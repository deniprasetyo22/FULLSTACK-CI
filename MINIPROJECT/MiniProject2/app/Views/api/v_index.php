<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>API<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4 text-center text-gray-800">API</h2>

    <div class="container relative flex justify-center gap-4">
        <div class="overflow-x-auto mt-2">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead class="bg-gray-100">
                    <tr>
                        <th colspan="2" class="py-3 px-4 text-center font-semibold">USER</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Get All User</td>
                        <td>
                            <a href="<?= url_to('get_all_users') ?>"
                                class="px-3 py-1 text-sm font-semibold text-white bg-blue-500 hover:bg-blue-600 rounded">
                                View
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Get User By ID</td>
                        <td>
                            <form method="get" action="<?= url_to('get_user_by_id') ?>" class="flex items-center gap-2">
                                <input type="number" name="id" placeholder="Enter User ID"
                                    class="px-2 py-1 border border-gray-300 rounded text-sm" required>
                                <button type="submit"
                                    class="px-3 py-1 text-sm font-semibold text-white bg-blue-500 hover:bg-blue-600 rounded">
                                    View
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="overflow-x-auto mt-2">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead class="bg-gray-100">
                    <tr>
                        <th colspan="2" class="py-3 px-4 text-center font-semibold">PRODUCT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Get All Products</td>
                        <td>
                            <a href="<?= url_to('get_all_products') ?>"
                                class="px-3 py-1 text-sm font-semibold text-white bg-blue-500 hover:bg-blue-600 rounded">
                                View
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Get Product By ID</td>
                        <td>
                            <form method="get" action="<?= url_to('get_product_by_id') ?>"
                                class="flex items-center gap-2">
                                <input type="number" name="id" placeholder="Enter User ID"
                                    class="px-2 py-1 border border-gray-300 rounded text-sm" required>
                                <button type="submit"
                                    class="px-3 py-1 text-sm font-semibold text-white bg-blue-500 hover:bg-blue-600 rounded">
                                    View
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?= $this->endSection() ?>