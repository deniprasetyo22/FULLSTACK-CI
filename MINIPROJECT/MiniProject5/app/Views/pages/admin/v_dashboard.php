<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="flex flex-col space-y-4 p-6 bg-white shadow h-full w-full">
    <?= $content ?? '' ?>
</div>
<?= $this->endSection() ?>