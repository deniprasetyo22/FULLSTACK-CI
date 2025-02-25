<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
Student List
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="flex flex-col space-y-4 p-6 bg-white shadow rounded-lg">
    <?= $content ?? '' ?>
</div>
<?= $this->endSection() ?>