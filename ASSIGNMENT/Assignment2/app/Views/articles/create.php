<!DOCTYPE html>
<html>

    <head>
        <title>Create New Article</title>
    </head>

    <body>
        <h1>Create New Article</h1>
        <?php if (session()->has('errors')): ?>
        <ul>
            <?php foreach (session('errors') as $error): ?>
            <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <form action="<?= url_to('store_article') ?>" method="post">
            <?= csrf_field() ?>
            <label for="id">ID:</label>
            <input type="text" name="id" id="id" value="<?= old('id') ?>">
            <br>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?= old('title') ?>">
            <br>
            <label for="content">Content:</label>
            <textarea name="content" id="content"><?= old('content') ?></textarea>
            <br>
            <button type="submit">Create</button>
        </form>
        <a href="/articles">Back to List</a>
    </body>

</html>