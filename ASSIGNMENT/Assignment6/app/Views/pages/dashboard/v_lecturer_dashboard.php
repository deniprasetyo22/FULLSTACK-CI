<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
Lecturer Dashboard
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="flex flex-col space-y-4 p-6 bg-white shadow rounded-lg">
    <!-- Dashboard Content -->
    <h1 class="text-2xl font-bold text-gray-800">Welcome to Lecturer Dashboard</h1>
    <p class="text-gray-600">Manage your site from this central dashboard.</p>
</div>
<?= $this->endSection() ?>