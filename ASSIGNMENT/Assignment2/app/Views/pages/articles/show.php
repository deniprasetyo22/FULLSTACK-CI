<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
<?= esc($article->getTitle()) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div>
    <h1><?= esc($article->getTitle()) ?></h1>
    <p><?= esc($article->getContent()) ?></p>
    <a href="/articles">Back to List</a>
</div>
<?= $this->endSection() ?>