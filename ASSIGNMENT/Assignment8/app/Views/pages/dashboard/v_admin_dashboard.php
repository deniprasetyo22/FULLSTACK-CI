<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
Admin Dashboard
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="flex flex-col space-y-4 p-6 bg-white shadow rounded-lg h-full">
    <!-- Dashboard Content -->
    <h1 class="text-2xl font-bold text-gray-800">Welcome to Admin Dashboard, <?= user()->username ?></h1>
</div>
<?= $this->endSection() ?>