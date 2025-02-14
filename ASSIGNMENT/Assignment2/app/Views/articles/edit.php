<!DOCTYPE html>
<html>

    <head>
        <title>Edit Article</title>
    </head>

    <body>
        <h1>Edit Article</h1>
        <?php if (session()->has('errors')): ?>
        <ul>
            <?php foreach (session('errors') as $error): ?>
            <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <form action="<?= url_to('update_article', $article->getSlug()) ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <label for="id">ID:</label>
            <input type="text" name="id" id="id" value="<?= esc($article->getId()) ?>">
            <br>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?= esc($article->getTitle()) ?>">
            <br>
            <label for="content">Content:</label>
            <textarea name="content" id="content"><?= esc($article->getContent()) ?></textarea>
            <br>
            <button type="submit">Update</button>
        </form>
        <a href="/articles">Back to List</a>
    </body>

</html>