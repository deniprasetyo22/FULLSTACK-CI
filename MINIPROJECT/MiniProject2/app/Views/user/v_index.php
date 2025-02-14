<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>User<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4 text-center text-gray-800">User List</h2>

    <a href="<?= url_to('create_user') ?>" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded">
        <i class="fa-solid fa-plus"></i> Add
    </a>

    <div class="overflow-x-auto mt-2">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">ID</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Nama Lengkap</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Username</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Jenis Kelamin</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Tanggal Lahir</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Role</th>
                    <th class="py-3 px-4 text-center font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)): ?>
                <tr>
                    <td colspan="7" class="py-4 px-4 text-center text-gray-500">Tidak ada data user</td>
                </tr>
                <?php else: ?>
                <?php foreach ($users as $user): ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="py-3 px-4 text-gray-700"><?= esc($user->getUserId()) ?></td>
                    <td class="py-3 px-4 text-gray-700"><?= esc($user->getFullName()) ?></td>
                    <td class="py-3 px-4 text-gray-700"><?= esc($user->getUserName()) ?></td>
                    <td class="py-3 px-4 text-gray-700"><?= esc($user->getSex()) ?></td>
                    <td class="py-3 px-4 text-gray-700"><?= esc($user->getDob()) ?></td>
                    <td class="py-3 px-4">
                        <a href="<?= url_to('role_user', $user->getUserName()) ?>"
                            class="px-3 py-1 text-sm font-semibold text-white bg-blue-500 hover:bg-blue-600 rounded">
                            View
                        </a>
                    </td>
                    <td class="py-3 px-4 flex justify-center space-x-2">
                        <a href="<?= url_to('profile_user', $user->getUserId()) ?>"
                            class="px-3 py-1 text-sm font-semibold text-white bg-blue-500 hover:bg-blue-600 rounded">
                            View
                        </a>
                        <a href="<?= url_to('setting_user', strtolower(str_replace(' ', '', $user->getFullName()))) ?>"
                            class="px-3 py-1 text-sm font-semibold text-white bg-yellow-500 hover:bg-yellow-600 rounded">
                            Edit
                        </a>
                        <form action="<?= url_to('delete_user', $user->getUserSlug()) ?>" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit"
                                class="px-3 py-1 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 rounded"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                Hapus
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