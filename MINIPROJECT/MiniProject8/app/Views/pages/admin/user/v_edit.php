<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>Edit User<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="container mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 h-full">
    <div class="relative mb-5">
        <a href="<?= url_to('user') ?>"
            class="absolute left-0 transform -translate-y-1/2 text-blue-500 hover:text-blue-600 rounded flex items-center">
            <i class="fa-solid fa-arrow-left mr-2"></i> Back
        </a>
        <h2 class="text-2xl font-bold text-center mb-4 text-gray-700">Edit User</h2>
    </div>

    <form action="<?= url_to('update_user', $user->id) ?>" method="POST">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Full Name</label>
            <input type="text" name="full_name" value="<?= $user->full_name ?>"
                class="<?php if(session('errors.full_name')): echo 'border-red-500'; else: echo 'border-gray-300'; endif; ?> border rounded w-full py-2 px-3 text-gray-700">
            <?php if(session('errors.full_name')): ?>
            <p class="text-sm text-red-500"><?= session('errors.full_name') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
            <input type="text" name="username" value="<?= $user->username ?>"
                class="<?php if(session('errors.username')): echo 'border-red-500'; else: echo 'border-gray-300'; endif; ?> border rounded w-full py-2 px-3 text-gray-700">
            <?php if(session('errors.username')): ?>
            <p class="text-sm text-red-500"><?= session('errors.username') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" value="<?= $user->email ?>"
                class="<?php if(session('errors.email')): echo 'border-red-500'; else: echo 'border-gray-300'; endif; ?> border rounded w-full py-2 px-3 text-gray-700">
            <?php if(session('errors.email')): ?>
            <p class="text-sm text-red-500"><?= session('errors.email') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Password (kosongkan jika tidak ingin
                diubah)</label>
            <input type="password" name="password"
                class="<?php if(session('errors.password')): echo 'border-red-500'; else: echo 'border-gray-300'; endif; ?> border rounded w-full py-2 px-3 text-gray-700">
            <?php if(session('errors.password')): ?>
            <p class="text-sm text-red-500"><?= session('errors.password') ?></p>
            <?php endif; ?>
        </div>


        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Role</label>
            <select name="role" class="border rounded w-full py-2 px-3 text-gray-700">
                <option value="Customer" <?= $user->role === 'Customer' ? 'selected' : '' ?>>Customer</option>
                <option value="Admin" <?= $user->role === 'Admin' ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
            <select name="status" class="border rounded w-full py-2 px-3 text-gray-700">
                <option value="Active" <?= $user->status === 'Active' ? 'selected' : '' ?>>Active</option>
                <option value="Inactive" <?= $user->status === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>

        <div class="flex justify-center">
            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                <i class="fa-solid fa-save"></i>
                <span>Save</span>
            </button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>