<!DOCTYPE html>
<html>

    <head>
        <title><?= esc($article->getTitle()) ?></title>
    </head>

    <body>
        <h1><?= esc($article->getTitle()) ?></h1>
        <p><?= esc($article->getContent()) ?></p>
        <a href="/articles">Back to List</a>
    </body>

</html>