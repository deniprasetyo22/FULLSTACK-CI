<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="admin-container">
    <div class="sidebar">
        <?= $this->include('admin/sidebar') ?>
    </div>
    <div class="main-content">
        <?= $this->renderSection('admin_content') ?>
    </div>
</div>
<?= $this->endSection() ?>