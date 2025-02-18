<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
<?= $pageTitle ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div>
    <!-- Simple Cell -->
    <?= view_cell('AlertMessage::show', ['type' => 'success', 'message' => 'Article created successfully!']) ?>
    <?= view_cell('NotificationCell::show', [
        'type' => 'success', 
        'message' => 'Article show successfully!',
        'icon' => '<i class="bi bi-check-circle"></i>'
        ]) ?>

    <!-- Controller Cell -->
    <?= view_cell('AlertMessageCell', 'type=warning, message=Failed.') ?>

    <!-- Computed Cell -->
    <?= view_cell('ComputedPropertiesCell', ['type' => 'success', 'message' => 'Computed Cell successfully!']) ?>

    <!-- View Cell Side Bar -->
    <?= view_cell('App\Cells\SidebarCell') ?>

    <?= view_cell('App\Cells\ProductCardCell', ['productId' => 123]) ?>

    <?= view_cell('App\Cells\CartCell') ?>



    <h1><?= $pageTitle ?></h1>
    <a href="<?= url_to('create_article') ?>">
        <button>Create New Article</button>
    </a>
    <br><br>
    <a href="/articles">
        <button>Refresh</button>
    </a>
    <br><br>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
            <tr>
                <td><?= $article->getId() ?></td>
                <td><?= esc($article->getTitle()) ?></td>
                <td><?= esc($article->getContent()) ?></td>
                <td class="actions">
                    <a href="<?= url_to('show_article', $article->getSlug()) ?>">
                        <button>Show</button>
                    </a>
                    <a href="<?= url_to('edit_article', $article->getSlug()) ?>">
                        <button>Edit</button>
                    </a>
                    <form action="<?= url_to('delete_article', $article->getSlug()) ?>" method="post"
                        style="display:inline;">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- <script src="/js/home.js"></script> -->

<style>
table {
    width: 100%;
    border-collapse: collapse;
}

th,
td {
    border: 1px solid black;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

.actions {
    display: flex;
    gap: 5px;
}
</style>
<?= $this->endSection() ?>