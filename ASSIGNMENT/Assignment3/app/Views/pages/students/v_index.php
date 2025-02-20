<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Student List
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mx-auto pb-8">
    <?= $content ?? '' ?>
</div>
<?= $this->endSection() ?>