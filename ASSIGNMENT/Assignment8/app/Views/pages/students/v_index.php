<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Student List
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mx-auto">
    <?= $content ?? '' ?>
</div>
<?= $this->endSection() ?>