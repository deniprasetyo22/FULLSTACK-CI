<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
<?= $page_title ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="container mx-auto p-6 h-full bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4 text-center text-gray-800">User List</h2>

    <?php if (session()->getFlashdata('message')) : ?>
    <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
        <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div>
            <span class="font-medium"><?= session()->getFlashdata('message') ?></span>
        </div>
    </div>
    <?php endif; ?>

    <a href="<?= url_to('create_user') ?>" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded">
        <i class="fa-solid fa-plus"></i> Add
    </a>

    <div class="overflow-x-auto mt-2">
        <table class="min-w-full bg-white rounded-lg shadow-md">
            <thead class="bg-blue-500">
                <tr>
                    <th class="p-2 text-center font-semibold text-white border border-gray-300">ID</th>
                    <th class="p-2 text-center font-semibold text-white border border-gray-300">Full Name</th>
                    <th class="p-2 text-center font-semibold text-white border border-gray-300">Username</th>
                    <th class="p-2 text-center font-semibold text-white border border-gray-300">Role</th>
                    <th class="p-2 text-center font-semibold text-white border border-gray-300">Status</th>
                    <th class="p-2 text-center font-semibold text-white">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)): ?>
                <tr>
                    <td colspan="7" class="py-4 px-4 text-center text-gray-500">Tidak ada data user</td>
                </tr>
                <?php else: ?>
                <?php foreach ($users as $user): ?>
                <tr class="hover:bg-gray-100 transition">
                    <td class="p-2 border border-gray-300"><?= esc($user->id) ?></td>
                    <td class="p-2 border border-gray-300"><?= esc($user->full_name) ?></td>
                    <td class="p-2 border border-gray-300"><?= esc($user->username) ?></td>
                    <td class="p-2 border border-gray-300"><?= esc($user->role) ?></td>
                    <td class="p-2 border border-gray-300"><?= esc($user->status) ?></td>
                    <td class="p-2 flex justify-center space-x-2 border border-gray-300">
                        <a href="<?= esc(url_to('user_profile', $user->id)) ?>"
                            class="text-blue-500 hover:text-blue-600">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="<?= esc(url_to('edit_user', $user->id)) ?>"
                            class="text-yellow-500 hover:text-yellow-600">
                            <i class="fa-solid fa-edit"></i>
                        </a>
                        <form action="<?= esc(url_to('delete_user', $user->id)) ?>" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="text-red-500 hover:text-red-600"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>