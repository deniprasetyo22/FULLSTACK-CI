<?= $this->extend('layouts/public_layout') ?>

<?= $this->section('title') ?>
Product List
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= $content ?? '' ?>
<?= $this->endSection() ?>