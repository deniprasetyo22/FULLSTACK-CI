<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
<?= $page_title ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="container mx-auto p-6 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 h-full">
    <form action="<?= url_to('auth-update-role', $user->id) ?>" method="POST" id="formData">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">

        <div class="relative mb-5">
            <a href="<?= url_to('auth-user') ?>"
                class="absolute left-0 transform -translate-y-1/2 text-blue-500 hover:text-blue-600 rounded flex items-center">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back
            </a>
            <h2 class="text-2xl font-bold text-center mb-4 text-gray-700"><?= $page_title ?></h2>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Full Name</label>
            <input type="text" name="full_name" value="<?= old('full_name', $user->full_name) ?>"
                class="border rounded w-full py-2 px-3 text-gray-700 bg-gray-200" readonly>
            <?php if(session('errors.full_name')): ?>
            <p class="text-sm text-red-500"><?= session('errors.full_name') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
            <input type="text" name="username" value="<?= old('username', $user->username) ?>"
                class="border rounded w-full py-2 px-3 text-gray-700 bg-gray-200" readonly>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" value="<?= old('email', $user->email) ?>"
                class="border rounded w-full py-2 px-3 text-gray-700 bg-gray-200" readonly>
        </div>

        <div class="mb-4">
            <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Role</label>
            <select name="role" class="border rounded w-full py-2 px-3 text-gray-700">
                <?php foreach($roles as $role): ?>
                <option value="<?= $role['id'] ?>" <?= $user->role == $role['name'] ? 'selected' : '' ?>>
                    <?= $role['name'] ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
            <input type="text" name="status" value="<?= $user->status ?>"
                class="border rounded w-full py-2 px-3 text-gray-700 bg-gray-200" readonly>
        </div>

        <div class="flex justify-center">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                <i class="fa-solid fa-save"></i>
                <span>Update</span>
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>