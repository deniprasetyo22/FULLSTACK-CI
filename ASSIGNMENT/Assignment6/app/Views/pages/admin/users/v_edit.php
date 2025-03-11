<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
<?= $page_title ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="flex flex-col space-y-4 p-6 bg-white shadow rounded-lg h-full">
    <div>
        <a href="<?= base_url('admin/users') ?>" class="text-blue-500 hover:underline">
            <i class="fa-solid fa-arrow-left"></i>
            Back
        </a>
    </div>

    <h2 class="text-2xl font-semibold text-center mb-2"><?= esc($page_title) ?></h2>

    <?php if (session()->has('errors')) : ?>
    <div class="p-4 bg-red-100 border border-red-400 text-red-700 rounded">
        <ul>
            <?php foreach (session('errors') as $error) : ?>
            <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <form action="<?= base_url('admin/users/update/' . esc($user->id)) ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">

        <div class="mb-4">
            <label class="block text-gray-700">Username</label>
            <input type="text" name="username" value="<?= old('username', esc($user->username)) ?>"
                class="w-full p-2 border rounded <?= session('errors.username') ? 'border-red-500' : '' ?>">
            <?php if (session('errors.username')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.username') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" value="<?= old('email', esc($user->email)) ?>"
                class="w-full p-2 border rounded <?= session('errors.email') ? 'border-red-500' : '' ?>">
            <?php if (session('errors.email')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.email') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Password (kosongkan jika tidak ingin mengubah)</label>
            <input type="password" name="password"
                class="w-full p-2 border rounded <?= session('errors.password') ? 'border-red-500' : '' ?>">
            <?php if (session('errors.password')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.password') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Konfirmasi Password</label>
            <input type="password" name="pass_confirm"
                class="w-full p-2 border rounded <?= session('errors.pass_confirm') ? 'border-red-500' : '' ?>">
            <?php if (session('errors.pass_confirm')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.pass_confirm') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Grup</label>
            <select name="group"
                class="w-full p-2 border rounded <?= session('errors.group') ? 'border-red-500' : '' ?>" required>
                <option value="">Pilih Grup</option>
                <?php foreach ($groups as $group) : ?>
                <option value="<?= $group->id; ?>"
                    <?= in_array($group->id, array_column($userGroups, 'group_id')) ? 'selected' : ''; ?>>
                    <?= esc($group->name); ?>
                </option>
                <?php endforeach; ?>
            </select>
            <?php if (session('errors.group')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.group') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4 flex items-center">
            <input class="mr-2" type="checkbox" id="status" name="status" <?= ($user->active == 1) ? 'checked' : ''; ?>>
            <label for="status" class="text-gray-700">Aktif</label>
        </div>

        <div class="flex justify-center">
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">
                <i class="fa-solid fa-save"></i> Update
            </button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>