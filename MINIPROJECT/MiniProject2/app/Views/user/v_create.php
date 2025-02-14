<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Tambah User<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4 text-center text-gray-800">Tambah User</h2>
    <?php if(session()->has('errors')): ?>
    <div class="text-red-500">
        <ul>
            <?php foreach(session('errors') as $error): ?>
            <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <form action="<?= url_to('store_user') ?>" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <?= csrf_field() ?>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">ID</label>
            <input type="text" name="id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
            <input type="text" name="fullName"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
            <input type="text" name="userName"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Jenis Kelamin</label>
            <select name="sex" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Lahir</label>
            <input type="date" name="dob" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Role</label>
            <select name="role" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Simpan
            </button>
            <a href="/user" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                Batal
            </a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>