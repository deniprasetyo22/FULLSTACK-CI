<?= $this->extend('layouts/public_layout') ?>

<?= $this->section('title') ?>
User Detail
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= $content ?? '' ?>
<?= $this->endSection() ?>