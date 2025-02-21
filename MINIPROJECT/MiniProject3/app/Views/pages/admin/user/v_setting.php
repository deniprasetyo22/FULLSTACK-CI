<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>Edit User<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="container mx-auto p-4">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-lg border border-gray-200">
        <div class="relative mb-5">
            <a href="<?= url_to('user') ?>"
                class="absolute left-0 transform -translate-y-1/2 text-blue-500 hover:text-blue-600 flex items-center">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back
            </a>
            <h2 class="text-2xl font-bold text-center mb-4 text-gray-700">Edit User</h2>
        </div>

        <?php if(session()->has('errors')): ?>
        <div class="text-red-500 mb-4">
            <ul>
                <?php foreach(session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <form action="<?= url_to('update_user', esc($user->getUserSlug())) ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="POST">
            <table class="w-full border border-gray-300">
                <tbody>
                    <tr>
                        <th class="p-2 text-left">ID</th>
                        <td class="p-2"><input type="text" name="id" value="<?= esc($user->getUserId()) ?>"
                                class="w-full border rounded px-2 py-1"></td>
                    </tr>
                    <tr>
                        <th class="p-2 text-left">Nama Lengkap</th>
                        <td class="p-2"><input type="text" name="fullName" value="<?= esc($user->getFullName()) ?>"
                                class="w-full border rounded px-2 py-1"></td>
                    </tr>
                    <tr>
                        <th class="p-2 text-left">Username</th>
                        <td class="p-2"><input type="text" name="userName" value="<?= esc($user->getUserName()) ?>"
                                class="w-full border rounded px-2 py-1"></td>
                    </tr>
                    <tr>
                        <th class="p-2 text-left">Jenis Kelamin</th>
                        <td class="p-2"><select name="sex" class="w-full border rounded px-2 py-1">
                                <option value="Laki-laki" <?= $user->getSex() === 'Laki-laki' ? 'selected' : '' ?>>
                                    Laki-laki</option>
                                <option value="Perempuan" <?= $user->getSex() === 'Perempuan' ? 'selected' : '' ?>>
                                    Perempuan</option>
                            </select></td>
                    </tr>
                    <tr>
                        <th class="p-2 text-left">Tanggal Lahir</th>
                        <td class="p-2"><input type="date" name="dob" value="<?= esc($user->getDob()) ?>"
                                class="w-full border rounded px-2 py-1"></td>
                    </tr>
                    <tr>
                        <th class="p-2 text-left">Role</th>
                        <td class="p-2"><select name="role" class="w-full border rounded px-2 py-1">
                                <option value="user" <?= $user->getRole() === 'user' ? 'selected' : '' ?>>User</option>
                                <option value="admin" <?= $user->getRole() === 'admin' ? 'selected' : '' ?>>Admin
                                </option>
                            </select></td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-4 flex justify-center gap-4">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Simpan</button>
                <a href="/user" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Batal</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>