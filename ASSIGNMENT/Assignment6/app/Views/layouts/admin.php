<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="flex flex-1 h-full">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow h-screen">
        <?= $this->include('partials/sidebar') ?>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 p-6 overflow-auto bg-gray-100">
        <?= $this->renderSection('admin_content') ?>
    </div>
</div>
<?= $this->endSection() ?>