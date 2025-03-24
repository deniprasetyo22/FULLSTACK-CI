<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
<?= $page_title ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="flex flex-col space-y-4 p-6 bg-white shadow rounded-lg h-full">
    <h2 class="text-2xl font-semibold mb-4 text-center mb-2"><?= $page_title ?></h2>

    <?php if (session()->getFlashdata('message')) : ?>
    <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
        <span class="font-medium"><?= session()->getFlashdata('message') ?></span>
    </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')) : ?>
    <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100" role="alert">
        <span class="font-medium"><?= session()->getFlashdata('errors') ?></span>
    </div>
    <?php endif; ?>

    <div>
        <a href="<?= base_url('admin/users/create') ?>"
            class="bg-blue-500 hover:bg-blue-600 rounded text-white py-1.5 px-3">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah User</span>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="table-auto w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="border border-gray-300 py-2 px-4 text-center">No</th>
                    <th class="border border-gray-300 py-2 px-4 text-center">Username</th>
                    <th class="border border-gray-300 py-2 px-4 text-center">Email</th>
                    <th class="border border-gray-300 py-2 px-4 text-center">Status</th>
                    <th class="border border-gray-300 py-2 px-4 text-center">Grup</th>
                    <th class="border border-gray-300 py-2 px-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($users as $user) : ?>
                <tr class="border-b hover:bg-gray-100">
                    <td class="border border-gray-300 py-2 px-4 text-center"><?= $i++; ?></td>
                    <td class="border border-gray-300 py-2 px-4 text-center"><?= $user->username; ?></td>
                    <td class="border border-gray-300 py-2 px-4 text-center"><?= $user->email; ?></td>
                    <td class="border border-gray-300 py-2 px-4 text-center">
                        <span class="px-2 py-1 rounded text-white <?= $user->active ? 'bg-green-500' : 'bg-red-500' ?>">
                            <?= $user->active ? 'Aktif' : 'Nonaktif' ?>
                        </span>
                    </td>
                    <td class="border border-gray-300 py-2 px-4 text-center">
                        <?php 
                        $groupModel = new \Myth\Auth\Models\GroupModel();
                        $groups = $groupModel->getGroupsForUser($user->id);
                        foreach ($groups as $group) {
                            echo '<span class="badge bg-blue-500 text-white px-2 py-1 rounded mr-1">' . $group['name'] . '</span>';
                        }
                        ?>
                    </td>
                    <td class="border border-gray-300 py-2 px-4">
                        <div class="flex justify-center space-x-2">
                            <a href="<?= base_url('admin/users/edit/' . $user->id); ?>"
                                class="text-yellow-500 hover:text-yellow-600">
                                <i class="fa-solid fa-edit"></i>
                            </a>
                            <form action="<?= base_url('admin/users/delete/' . $user->id); ?>" method="post"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="text-red-500 hover:text-red-600">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>

                <?php if (empty($users)) : ?>
                <tr>
                    <td colspan="6" class="text-center py-4">Tidak ada data user</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>