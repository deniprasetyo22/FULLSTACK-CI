<?= $this->extend('layouts/public_layout') ?>

<?= $this->section('title') ?>
Product Detail
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= $content ?? '' ?>
<?= $this->endSection() ?>