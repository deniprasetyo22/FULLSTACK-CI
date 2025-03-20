<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>Edit User<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="container mx-auto p-6 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 h-full">
    <form action="<?= url_to('auth-update-user', $user->id) ?>" method="POST" id="formData">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">

        <div class="relative mb-5">
            <a href="<?= url_to('auth-user') ?>"
                class="absolute left-0 transform -translate-y-1/2 text-blue-500 hover:text-blue-600 rounded flex items-center">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back
            </a>
            <h2 class="text-2xl font-bold text-center mb-4 text-gray-700">Edit User</h2>
        </div>

        <?php if(session()->getFlashdata('errors')): ?>
        <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100" role="alert">
            <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
            <div>
                <span class="font-medium">Validation Errors:</span>
                <ul class="mt-2 text-sm">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Full Name</label>
            <input type="text" name="full_name" value="<?= old('full_name', $user->full_name) ?>"
                class="border rounded w-full py-2 px-3 text-gray-700 <?= session('errors.full_name') ? 'border-red-500' : 'border-gray-300' ?>">
            <?php if(session('errors.full_name')): ?>
            <p class="text-sm text-red-500"><?= session('errors.full_name') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
            <input type="text" name="username" value="<?= old('username', $user->username) ?>"
                class="border rounded w-full py-2 px-3 text-gray-700">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" value="<?= old('email', $user->email) ?>"
                class="border rounded w-full py-2 px-3 text-gray-700">
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
            <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
            <select name="status" class="border rounded w-full py-2 px-3 text-gray-700">
                <?php foreach($status as $s): ?>
                <option value="<?= $s ?>" <?= $user->status === $s ? 'selected' : '' ?>>
                    <?= $s ?>
                </option>
                <?php endforeach; ?>
            </select>
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