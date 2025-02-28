<?= $this->extend('layouts/public_layout') ?>

<?= $this->section('title') ?>
User List
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= $content ?? '' ?>
<?= $this->endSection() ?>