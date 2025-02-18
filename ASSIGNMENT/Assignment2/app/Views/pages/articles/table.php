<h2><?= $category ?></h2>
<?php foreach ($products as $product) : ?>
<div>
    <h1><?= esc($product['name']) ?></h1>
    <h2><?= number_format($product['price'], 0, ',', '.') ?></h2>
</div>
<?php endforeach; ?>