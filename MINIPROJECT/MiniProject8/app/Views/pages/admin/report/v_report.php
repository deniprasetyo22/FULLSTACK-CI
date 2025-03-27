<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
<?= $page_title ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="container mx-auto p-4 h-full bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4 text-center">Report</h2>

    <div class="mb-4">
        <label for="category" class="block mb-2 text-sm font-bold text-gray-900">Product List by Category:</label>
        <form action="<?= url_to('export-product-excel') ?>" method="post" target="_blank"
            class="flex items-center gap-2">
            <select name="category" id="category" class="w-full p-2 border border-gray-300 rounded-md">
                <option value="">All Category</option>
                <?php foreach ($category as $c): ?>
                <option value="<?= $c->id ?>"><?= $c->name ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit"
                class="bg-green-500 hover:bg-green-600 text-white py-1.5 px-3 rounded flex items-center gap-1">
                <i class="fa-solid fa-file-export"></i> Export
            </button>
        </form>
    </div>

    <?php if(in_groups('administrator')) : ?>
    <div class="mb-4">
        <label for="user" class="block mb-2 text-sm font-bold text-gray-900">User List:</label>
        <form action="<?= url_to('auth-export-user') ?>" method="post" target="_blank" class="flex items-center gap-2">
            <select name="user" id="user"
                class="w-full p-2 border border-gray-300 rounded-md cursor-not-allowed bg-gray-200" disabled>
                <option value="">All Users</option>
            </select>
            <button type="submit"
                class="bg-green-500 hover:bg-green-600 text-white py-1.5 px-3 rounded flex items-center gap-1">
                <i class="fa-solid fa-file-export"></i> Export
            </button>
        </form>
    </div>
    <?php endif; ?>

</div>
<?= $this->endSection() ?>