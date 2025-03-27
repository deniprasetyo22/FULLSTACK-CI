<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
<?= $page_title ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="container mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 h-full">
    <div class="relative mb-5">
        <a href="<?= url_to('role') ?>"
            class="absolute left-0 transform -translate-y-1/2 text-blue-500 hover:text-blue-600 rounded flex items-center">
            <i class="fa-solid fa-arrow-left mr-2"></i> Back
        </a>
        <h2 class="text-2xl font-bold text-center mb-4 text-gray-700">Edit Role</h2>
    </div>

    <form action="<?= url_to('update-role', $role->id) ?>" method="POST">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
            <input type="text" name="name" value="<?= $role->name ?>"
                class="<?php if(session('errors.name')): echo 'border-red-500'; else: echo 'border-gray-300'; endif; ?> border rounded w-full py-2 px-3 text-gray-700">
            <?php if(session('errors.name')): ?>
            <p class="text-sm text-red-500"><?= session('errors.name') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <input type="text" name="description" value="<?= $role->description ?>"
                class="<?php if(session('errors.description')): echo 'border-red-500'; else: echo 'border-gray-300'; endif; ?> border rounded w-full py-2 px-3 text-gray-700">
            <?php if(session('errors.description')): ?>
            <p class="text-sm text-red-500"><?= session('errors.description') ?></p>
            <?php endif; ?>
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